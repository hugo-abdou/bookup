<?php

namespace App\Actions\Jetstream;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    use PasswordValidationRules;
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user, $input = null)
    {
        if ($input) {
            Validator::make($input, [
                'password' => $this->passwordRules(),
            ])->after(function ($validator) use ($user, $input) {
                if (!Hash::check($input['password'], auth()->user()->password)) {
                    $validator->errors()->add('password', __('The provided password does not match your current password.'));
                }
            })->validateWithBag('deletePassword');
        }
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
