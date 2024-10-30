<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    use AuthorizesRequests, ValidatesRequests;

    protected function authUser()
    {
        $user = Auth::user();
        $user->role;
        $user->student;
        $user->counselingTeacher;
        return $user;
    }

    protected function isCounselingTeacher($role)
    {
        return $role == 'admin';
    }

    protected function isStudent($role)
    {
        return $role == 'Student';
    }
}
