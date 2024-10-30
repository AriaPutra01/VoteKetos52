<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthControllerServices extends BaseController
{
    function me()
    {
        $success = self::authUser();
        if (!$success) {
            return self::sendError('unauthorize', ['message' => 'token invalid!'], 401);
        }
        return self::sendResponse($success, 'profile found!.');
    }
}
