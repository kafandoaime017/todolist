<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class User extends Model
{
   public function __construct(
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $password,
        private int $age
   ){}

   public function isValid():bool
   {
        return $this->isEmailValid()
            && !empty($this->firstName)
            && !empty($this->lastName)
            && $this->isPasswordValid()
            && $this->isValidAge();
   }

   private function isEmailValid():bool
   {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
   }

    private function isPasswordValid():bool
    {
          return preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,40}$/', $this->password);
    }

    private function isValidAge():bool
    {
        return $this->age >= 13;
    }
   
   

   
}
