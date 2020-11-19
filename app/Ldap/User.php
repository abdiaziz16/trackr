<?php

namespace App\Ldap;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use LdapRecord\Models\Model;

use Illuminate\Foundation\Auth\User as Authenticatabale;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;

class User extends Authenticatabale implements LdapAuthenticatable
{
    use Notifiable, AuthenticatesWithLdap;


    protected $fillable = [
        'name',
        'email',
        'password',

    ];

    protected $hidden = [
        'password', 'remember_token' ,
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
