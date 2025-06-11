<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
<<<<<<< HEAD
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
=======
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
<<<<<<< HEAD
     * Validate and create a newly registered user.
=======
     * Create a newly registered user.
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
<<<<<<< HEAD
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
=======
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
