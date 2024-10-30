<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['nama', 'nisn', 'jurusan', 'kelas', ];

    // function answear(): BelongsToMany
    // {
    //     return self::belongsToMany(Option::class, 'student_answear', 'student_id',);
    // }
}
