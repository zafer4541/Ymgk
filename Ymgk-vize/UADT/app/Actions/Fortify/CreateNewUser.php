<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {   $attribute=[
        'name'=>'İsim',
        'email'=>'E-mail',
        'password'=>'Şifre',
    ];
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ],[
            'name.required'=>"İsim alanı boş geçilemez.",
            'name.min'=>"Şifre alanı en az 8 karekter olmalı.",
            'email.required'=>"E-mail alanı boş geçilemez.",
            'email.max'=>"E-mail en fazla 255 karakter olabilir..",
            'password.required'=>"Şifre alanı boş geçilemez.",
            'password.min'=>"Şifre alanı en az 8 karekter olmalı.",

        ],['email'=>'E-mail','name'=>'İsim','password'=>'Şifre'])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
