<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;
}