<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//Modelo del usuario
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

    //el método o función boot se usa para cargar todos los elementos que
    //no se ponen el el register
    protected static function boot()
    {
        parent::boot();
        
        static::created(function ($user){
            $user->perfil()->create();
        });
    }

    public function recetas() {
        //Que tantas recetas ha creado este usuario
        return $this->hasMany(Receta2::class);
    }

    public function perfil() {
        //cuantos perfiles tiene
        return $this->hasOne(Perfil::class);
    }

    public function meGusta() {
        //cuantos favoritos ha dado a recetas
        return $this->belongsToMany(Receta2::class, 'like_recetas');
    }

    public function getId() {
        return $this->id;
    }
}
