<?php

namespace App\Actions\Fortify;

<<<<<<< HEAD
use Illuminate\Validation\Rules\Password;
=======
use Laravel\Fortify\Rules\Password;
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
<<<<<<< HEAD
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', Password::default(), 'confirmed'];
=======
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', new Password, 'confirmed'];
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
    }
}
