<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;

use App\Models\roles;
use App\Models\Student;
use App\Models\User;
use App\Models\Useradmin;
use App\Models\UserStudent;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            [
                "role_name" => "admin",

            ],
            [
                "role_name" => "siswa",
            ],
        ];
        foreach ($role as $key => $value) {
            roles::create([
                "role_name" => $value["role_name"],
            ]);
        }

        $admin = roles::whereRoleName('admin')->first();

        $adminCreate = [
            "nama" => "admin",
            "password" => bcrypt('12345'),
            "role_id" => $admin->id,
        ];

        $userAdmin = User::create([
            "nama" => $adminCreate["nama"],
            "password" => $adminCreate["password"],
            "role_id" => $adminCreate["role_id"]
        ]);

        $adminKet = Admin::create([
            'keterangan' => 'User Admin'
        ]);

        Useradmin::create([
            'user_id' => $userAdmin->id,
            'admin_id' => $adminKet->id
        ]);

        $student = roles::whereRoleName('siswa')->first();

        $studentCreate = [
            "nama" => "student",
            "password" => bcrypt('12345'),
            "role_id" => $student->id,
            "nisn" => "54321",
            "jurusan" => "PPLG",
            "kelas" => "XII"
        ];

        $userStudent = User::create([
            "nama" => $studentCreate["nama"],
            "password" => $studentCreate["password"],
            "role_id" => $studentCreate["role_id"],
        ]);

        $studentDetail = Student::create([
            'nisn' => $studentCreate['nisn'],
            'jurusan' => $studentCreate['jurusan'],
            'kelas' => $studentCreate['kelas']
        ]);

        UserStudent::create([
            'user_id' => $userStudent->id,
            'student_id' => $studentDetail->id
        ]);
    }
}
