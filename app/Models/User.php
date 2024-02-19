<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;


    const DEFAULT_ROLE_ID = 5;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'faculty_id',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public static function boot()
    {
        parent::boot();

        // Set default role ID when creating a new user
        static::creating(function ($user) {
            if (!$user->role_id) {
                $user->role_id = self::DEFAULT_ROLE_ID;
            }
        });
        static::deleting(function ($user) {
            $user->articles()->update(['author_id' => null]);
        });
        static::deleting(function ($user) {
            $user->comments()->update(['user_id' => null]);
        });
        static::deleting(function ($faculty) {
            User::where('faculty_id', $faculty->id)->update(['faculty_id' => 1]);
        });
    }


    //user may have a role
    public function role(){
        return $this->belongsTo(Role::class, 'role_id');
    }
    //user may belongs to a faculty
    public function faculty(){
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    //user has many articles
    public function articles(){
        return $this->hasMany(Article::class, 'author_id');
    }
    public function comments()
    {
    return $this->hasMany(Comment::class);
    }
   
}
