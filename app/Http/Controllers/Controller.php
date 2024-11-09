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
        $user->roles;
        $user->student;
        $user->admin;
        return $user;
    }

    protected function isadmin($roles)
    {
        return $roles == 'admin';
    }

    protected function isstudent($roles)
    {
        return $roles == 'siswa';
    }

    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
