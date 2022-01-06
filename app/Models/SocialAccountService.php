<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    use HasFactory;

    public function createOrGetUser(ProviderUser $providerUser) {
        $account = SocialAccount::whereProvider('facebook')->whereProviderUserId($providerUser->getId())->$first();
        if($account) {
            return redirect('blogs');
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook',
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if(!$user){

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'role_id' => 3,
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}
