<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasUlids;

    /**
     *  The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'password',
        'role_id',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    function roles(): BelongsTo
    {
        return self::belongsTo(Roles::class, 'role_id', 'id')->select('role_name as name');
    }

    function student(): BelongsToMany
    {
        return self::belongsToMany(Student::class, 'user_students', 'user_id', 'student_id');
    }

    function admin(): BelongsToMany
    {
        return self::belongsToMany(Admin::class, 'user_admin', 'user_id', 'admin_id')->select('keterangan');

    }
    
    function candidate(): BelongsToMany{
        return self::belongsToMany(Candidate::class, 'nama_kandidat', 'student_id', 'deskripsi', 'visi_misi', 'foto');
    }
}
