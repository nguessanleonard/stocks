<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'nom',
        'prenoms',
        'telephone',
        'email',
        'password',
        'userAdd',
        'photo',
        'userUpdate',
        'userDelete',
        'created_at',
        'updated_at',
        'deleted_at',
        'supprimer',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
    public static function getuser($email)
    {

        return DB::table('users as u')
            ->select('u.*')
            ->where('u.email', $email)
            ->first();
    }
    public static function users()
    {

        return DB::table('users as u')
            ->select('u.*')
            ->where('supprimer',0)
            ->get();
    }

    public static function getinfosadminrole($admins_id)
    {
        return DB::table('users as u')
            ->join('model_has_roles as mhr', 'mhr.model_id', '=', 'u.id')
            ->join('roles as r', 'mhr.role_id', '=', 'r.id')
            ->where('u.id', $admins_id)
            ->where('u.supprimer', 0)
            ->first();
    }
}
