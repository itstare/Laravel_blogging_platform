<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\BlogsController@index');

Route::get('/blogs', 'App\Http\Controllers\BlogsController@index')->name('blogs');
Route::get('/blogs/create', 'App\Http\Controllers\BlogsController@create')->name('blogs.create');
Route::post('/blogs/insert', 'App\Http\Controllers\BlogsController@insert')->name('blogs.insert');
//keep trash routes here
Route::get('/blogs/trash', 'App\Http\Controllers\BlogsController@trash')->name('blogs.trash');
Route::get('/blogs/trash/{id}/restore', 'App\Http\Controllers\BlogsController@restore')->name('blogs.restore');
Route::delete('/blogs/trash/{id}/permanent-delete', 'App\Http\Controllers\BlogsController@permanentDelete')->name('blogs.permanent-delete');




Route::get('blogs/{slug}', 'App\Http\Controllers\BlogsController@view')->name('blogs.view');
Route::get('/blogs/{id}/edit', 'App\Http\Controllers\BlogsController@edit')->name('blogs.edit');
Route::patch('/blogs/{id}/update', 'App\Http\Controllers\BlogsController@update')->name('blogs.update');
Route::delete('/blogs/{id}/delete', 'App\Http\Controllers\BlogsController@delete')->name('blogs.delete');

//admin routes
Route::get('/dashboard', 'App\Http\Controllers\AdminController@index')->name('admin')->middleware('auth');
Route::get('/admin/blogs', 'App\Http\Controllers\AdminController@blogs')->name('admin.blogs')->middleware(['auth', 'admin']);


//Categories routes
Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('categories');
Route::get('/categories/create', 'App\Http\Controllers\CategoryController@create')->name('categories.create');
Route::post('/categories/store', 'App\Http\Controllers\CategoryController@store')->name('categories.store');
Route::get('/categories/{id}/edit', 'App\Http\Controllers\CategoryController@edit')->name('categories.edit');
Route::patch('/categories/{id}/update', 'App\Http\Controllers\CategoryController@update')->name('categories.update');
Route::get('/categories/{slug}/view', 'App\Http\Controllers\CategoryController@show')->name('categories.view');
Route::delete('/categories/{id}/delete', 'App\Http\Controllers\CategoryController@destroy')->name('categories.delete');

//UserController routes
//Route::get('/users/{name}/show', 'App\Http\Controllers\UserController@show')->name('users.show');
Route::resource('users', 'App\Http\Controllers\UserController');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Contact form routes 
Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('contact');
Route::post('/contact/send', 'App\Http\Controllers\ContactController@send')->name('contact.send');

//using Route resource
//Route::resource('categories', 'App\Http\Controllers\CategoryController');

