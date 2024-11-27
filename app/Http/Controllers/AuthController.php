<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Roles;
use App\Models\Student;
use App\Models\UserStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $user = self::authUser();

        if ($user->roles->name !== 'admin') {
            return response()->json([
                'error' => 'Unauthorized. Only admins can add participants.'
            ], 403);
        }

        $request->validate([
            'nama' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|string|exists:roles,id',
        ]);

        $role = self::role()->find($request->role);
        if ($role->role_name == 'siswa') {
            $request->validate([
                'nisn' => 'required|digits_between:1,10|unique:student,nisn',
                'kelas' => 'required|string',
                'jurusan' => 'required|string'
            ]);

            try {

                DB::beginTransaction();

                $user = self::storeUser(
                    [
                        'nama' => $request->nama,
                        'password' => bcrypt($request->password),
                        'role_id' =>  $request->role
                    ]
                );

                $student = self::student()->create([
                    'nisn' => $request->nisn,
                    'kelas' => $request->kelas,
                    'jurusan' => $request->jurusan
                ]);

                self::userStudent()->create([
                    'user_id' => $user->id,
                    'student_id' => $student->id
                ]);

                DB::commit();

                return self::sendResponse($user, "user has been registered Successfully!", 201);
            } catch (\Exception $th) {
                DB::rollBack();
                return self::sendError($th, '', 500);
            }
        }

        $user = self::storeUser(
            [
                'nama' => $request->nama,
                'password' => bcrypt($request->password),
                'role_id' =>  $request->role
            ]
        );

        return self::sendResponse($user, "user has been registered Successfully!", 201);
    }

    public function login(Request $request)
    {
        $credentials = request(['nama', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    function me()
    {
        $success = self::authUser();
        if (!$success) {
            return self::sendError('unauthorize', ['message' => 'token invalid!'], 401);
        }
        return self::sendResponse($success, 'profile found!.');
    }

    private function userStudent()
    {
        return new UserStudent;
    }

    private function role()
    {
        return new Roles;
    }

    private function student()
    {
        return new Student;
    }
}
