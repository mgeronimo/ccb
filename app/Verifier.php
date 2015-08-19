<?php
namespace App;
    use Illuminate\Support\Facades\Auth;

    class Verifier
    {
        public function verify($email, $password)
        {
            $credentials = [
                'email'    => $email,
                'password' => $password,
            ];

            if (Auth::once($credentials)) {
                return Auth::user()->id;
            }

            return false;
        }
    }
?>