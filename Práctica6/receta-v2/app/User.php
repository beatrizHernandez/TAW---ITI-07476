<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::created(function ($user){
            $user->perfil()->create();
        });
    }

    public function recetas() {
        return $this->hasMany(Receta2::class);
    }

    public function perfil() {
        return $this->hasOne(Perfil::class);
    }

    public function meGusta() {
        return $this->belongsToMany(Receta2::class, 'likes_receta');
    }

    public function getId() {
        return $this->id;
    }
}
