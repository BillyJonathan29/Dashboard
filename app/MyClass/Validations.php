<?php

namespace App\MyClass;

use App\Rules\ValidateUserPassword;

class Validations
{


    public static function login($request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);
    }

    public static function register($request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|max:12',
            'role' => 'in:Admin,User',
        ], [
            'username.required' => 'Username wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'role.in' => 'Role tidak valid',
        ]);
    }
}
