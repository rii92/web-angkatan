<?php

namespace App\Actions\Socialstream;

use App\Models\ConnectedAccount;
use App\Models\User;
use JoelButcher\Socialstream\Contracts\ResolvesSocialiteUsers;
use JoelButcher\Socialstream\Socialstream;
use Laravel\Jetstream\Jetstream;
use Laravel\Socialite\Facades\Socialite;

class ResolveSocialiteUser implements ResolvesSocialiteUsers
{
    /**
     * Resolve the user for a given provider.
     *
     * @param  string  $provider
     * @return \Laravel\Socialite\AbstractUser
     */
    public function resolve($provider)
    {
        $providerUser = Socialite::driver($provider)->user();

        $user = User::where('email', $providerUser->email)->firstOrfail();

        // create new connected account if user exist
        if (ConnectedAccount::where(['email' => $user->email, 'user_id' => $user->id])->doesntExist()) {
            (new CreateConnectedAccount())->create($user, $provider, $providerUser);

            if (Socialstream::hasProviderAvatarsFeature() && Jetstream::managesProfilePhotos() && $providerUser->getAvatar()) {
                $user->setProfilePhotoFromUrl($providerUser->getAvatar());
            }
        }
        
        if (Socialstream::generatesMissingEmails()) {
            $providerUser->email = $providerUser->getEmail() ?? "{$providerUser->id}@{$provider}" . config('app.domain');
        }

        return $providerUser;
    }
}
