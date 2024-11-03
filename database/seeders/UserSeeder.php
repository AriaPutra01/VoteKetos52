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
        $role = [[
            "role_name" => "admin",

        ],
        [
            "role_name" => "siswa",
        ],
     ];
     foreach ($role as $key => $value){
        roles::create([
            "role_name" => $value["role_name"],
        ]);
     } 

     $student = roles::where('role_name', 'siswa')->first();
     $admin = roles::where('role_name', 'admin')->first();
     

      

        $user = [[
            "nama" => "admin",
            "nisn" => "54321",
            "password" => bcrypt('12345'),
            "role_id" => $admin->id,
            "role" => $admin->role_name,


          
        ],
        [
            "nama" => "student",
            "nisn" => "54321",
            "password" => bcrypt('12345'),
            "role_id" => $student->id,
            "role" => $student->role_name,
          
        ]];
  
         foreach ($user as $key => $value){
            $user = User::create([
                "nama" => $value["nama"],
                "password" => $value["password"],
                "role_id" => $value["role_id"],
                "role" => $value["role"],
                //"roles" => $value["roles"],
            ]);

            if($user->role_id == $student->id){

                $student = Student::create([
                    "nisn" => "45637",
                    "kelas" => "XII",
                    "jurusan" => "PPLG",
                ]);
                UserStudent::create([
                    "user_id" => $user->id,
                    "student_id" => $student->id,
                ]);
                }


                if($user->role_id == $admin->id){

                    $admin = Admin::create([
                        "keterangan" => "admin",
                    ]);
                    Useradmin::create([
                        "user_id" => $user->id,
                        "admin_id" => $admin->id,
                    ]);
                    }
            }

            


        
    }
}
