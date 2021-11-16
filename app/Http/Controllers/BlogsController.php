<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Session;
use App\Mail\BlogPublished;
use Illuminate\Support\Facades\Mail;


class BlogsController extends Controller
{
    public function __construct(){
        $this->middleware('author', ['only' => ['create', 'insert', 'edit', 'update']]);
        $this->middleware('admin', ['only' => ['delete', 'trash', 'restore', 'permanentDelete']]);
    }

    public function index(){
        $blogs = Blog::where('status', 1)->latest()->get();
        //$blogs = Blog::latest()->get();
        //$blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }

    public function create(){
        $categories = Category::latest()->get();
        return view('blogs.create', compact('categories'));
    }

    public function insert(Request $request){
        //validation
        $rules = [
           'title' => ['required', 'min:20', 'max:160'],
           'body' => ['required', 'min: 160'],
        ];

        $this->validate($request, $rules);


        $input = $request->all();
        
        $input['slug'] = str_slug($request->title, '-');
        $input['meta_title'] = str_limit($request->title, 55);
        $input['meta_description'] = str_limit($request->body, 155);

        //upload image
        if($file = $request->file('featured_image')){
            $fileName = uniqid() . $file->getClientOriginalName();
            $name = strtolower(str_replace(' ', '-', $fileName));
            $file->move('images/featured_images/', $name);
            $input['featured_image'] = $name;
        }
        
        $blogByUser = $request->user()->blog()->create($input);
        //$blog = Blog::create($input);
        //Sync with categories
        if($request->category_id){
            $blogByUser->category()->sync($request->category_id);
        }
        

        /* $blog = new Blog();
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->save(); */

        //mail
        $allUsers = User::all();
        foreach($allUsers as $user){
            Mail::to($user->email)->queue(new BlogPublished($user, $blogByUser));
        }

        Session::flash('blog_created', 'Blog Created!');

        return redirect('/blogs');
    }

    public function view($slug){
        //$blog = Blog::findOrFail($slug);
        $blog = Blog::whereSlug($slug)->first();
        return view('blogs.view', compact('blog'));
    }

    public function edit($id){
         $blog = Blog::findOrFail($id);
         $categories = Category::latest()->get();

         $assignedCategories = array();
         foreach($blog->category as $category){
            $assignedCategories[] = $category->id;
         }
         $unusedCategories = array_except($categories, $assignedCategories);

         return view('blogs.edit', ['blog' => $blog, 'categories' => $categories, 'unusedCategories' => $unusedCategories]);
    }

    public function update(Request $request, $id){
        $input = $request->all();
        $blog = Blog::findOrFail($id);
        
        //update feature image
        if($file = $request->file('featured_image')){
            if($blog->featured_image){
                unlink('images/featured_images/' . $blog->featured_image);
            }

            $fileName = uniqid() . $file->getClientOriginalName();
            $name = strtolower(str_replace(' ', '-', $fileName));
            $file->move('images/featured_images/', $name);
            $input['featured_image'] = $name;
        }

        $blog->update($input);
        if($request->category_id){
            $blog->category()->sync($request->category_id);
        } /*else{
            $blog->category()->detach($request->category_id);
        }*/
        return redirect('blogs');
    }

    public function delete($id){
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect('blogs');
    }

    public function trash(){
        $trashedBlogs = Blog::onlyTrashed()->get();
        return view('blogs.trash', compact('trashedBlogs'));
    }

    public function restore($id){
        $restoredBlog = Blog::onlyTrashed()->findOrFail($id);
        $restoredBlog->restore($restoredBlog);
        return redirect('blogs');
    }

    public function permanentDelete($id){
        $permanentDeleteBlog = Blog::onlyTrashed()->findOrFail($id);
        $permanentDeleteBlog->forceDelete($permanentDeleteBlog);
        return back();
    }
}
