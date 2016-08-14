<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function claims(array $customClaims = [])
    {
        return array_merge([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
        ], $customClaims);
    }

    public static function byUsername(string $username)
    {
        return static::whereUsername($username);
    }
}
