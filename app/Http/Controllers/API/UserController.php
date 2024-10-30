<?php

namespace App\Http\Controllers\API;

use App\Models\PasswordReset;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use App\Models\UserStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    protected function storeUser($request, $idUser)
    {
        return self::getUserData()->create([
            'password' => bcrypt($request->password),
            'nama' => $request->username,
            'nisn' => $request->nisn,
            'role_id' => $idUser,
        ]);
    }

    protected function storeStudent($request)
    {
        return self::getStudent()->create([
            'nama' => $request->name,
            'nisn' => $request->nisn,
            'kelas' => 'X','XI','XII',
            'jurusan' => $request->jurusan,
        ]);
    }

    protected function userStudentStore($userId, $studentId): void
    {
        self::userStudent()->create([
            'user_id' => $userId,
            'student_id' => $studentId
        ]);
    }

    /**
     * Display the specified resource.
     */
    protected function showUser($nisn)
    {
        return self::getUserData()->wherenisn($nisn)->firstOrFail();
    }

    protected function getToken($token)
    {
        return self::modelPasswordReset()->where('token', '=', $token)->first();
    }

    protected function createTokenReset($nisn)
    {
        return self::modelPasswordReset()->create([
            'nisn' => $nisn,
            'token' => Str::random(60),
            'created_at' => Carbon::now(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    protected function getRole($name)
    {
        return self::roles()->whereRoleName($name)->first();
    }

    private function userStudent()
    {
        return new UserStudent();
    }

    private function getStudent()
    {
        return new Student();
    }

    private function roles()
    {
        return new Role();
    }

    private function getUserData()
    {
        return new User;
    }

    private function modelPasswordReset()
    {
        return new PasswordReset;
    }
}
