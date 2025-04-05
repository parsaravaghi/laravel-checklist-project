<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Validator;

class AuthValidation
{
    //
    public function validation(array $data, string $type): object
    {
        // Define validation rules and messages based on the type of request
        $rules = [];
        $messages = [];

        // Validate the data based on the type of request
        if ($type === 'register') 
        {
            // Validate the data for registration
            $rules = [
                "username" => "string|regex:/^[^<>]*$/|max:100|unique:users",
                "password" => "string|min:8|confirmed",
                "email" => "string|email|regex:/^[^<>]*$/|max:100|unique:users"
            ];

            // Custom error messages
            $messages = [
                "username.string" => "The username must be a string.",
                "username.regex" => "The username must not contain < or > characters.",
                "username.max" => "The username must not exceed 100 characters.",
                "username.unique" => "This username is already taken.",
                "username.required" => "The username is required.",
                "password.required" => "The password is required.",
                "password.string" => "The password must be a string.",
                "password.min" => "The password must be at least 8 characters.",
                "password.confirmed" => "The password confirmation does not match.",
                "email.string" => "The email must be a string.",
                "email.email" => "The email must be a valid email address.",
                "email.regex" => "The email must not contain < or > characters.",
                "email.max" => "The email must not exceed 100 characters.",
                "email.unique" => "This email is already registered.",
                "email.required" => "The email is required."
            ];
        } 

        // Validate the data for login
        elseif ($type === 'login') 
        {
            // Validate the data for login
            $rules = [
                "username" => "required|string",
                "password" => "required|string"
            ];

            // Custom error messages
            $messages = [
                "username.required" => "The username is required.",
                "username.string" => "The username must be a string.",
                "password.required" => "The password is required.",
                "password.string" => "The password must be a string."
            ];
        }

        // return the validator instance
        return Validator::make($data, $rules, $messages);
    }
}
