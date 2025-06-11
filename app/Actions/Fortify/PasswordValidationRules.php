<?php

namespace App\Actions\Fortify;

<<<<<<< HEAD
use Illuminate\Validation\Rules\Password;
=======
<<<<<<< HEAD
use Illuminate\Validation\Rules\Password;
=======
use Laravel\Fortify\Rules\Password;
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', Password::default(), 'confirmed'];
<<<<<<< HEAD
=======
=======
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', new Password, 'confirmed'];
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
>>>>>>> 8d242d342dff375cbac73b316ed8761220d0e9c3
    }
}
