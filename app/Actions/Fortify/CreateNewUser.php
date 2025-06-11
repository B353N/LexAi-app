<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
<<<<<<< HEAD
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
=======
<<<<<<< HEAD
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
=======
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
<<<<<<< HEAD
     * Validate and create a newly registered user.
=======
<<<<<<< HEAD
     * Validate and create a newly registered user.
=======
     * Create a newly registered user.
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
<<<<<<< HEAD
=======
=======
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
