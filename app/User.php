<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property bool $phone_verified
 * @property string $password
 * @property string $verify_token
 * @property string $phone_verify_token
 * @property Carbon $phone_verify_token_expire
 * @property boolean $phone_auth
 * @property string $role
 * @property string $status
 * @property Network[] networks
 * @method Builder byNetwork(string $network, string $identity)
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 */

class User extends Authenticatable
{
    use Notifiable;

    const STATUS_WAIT = 'wait';
    const STATUS_ACTIVE = 'active';

    protected $fillable = [
        'name', 'email', 'password', 'status', 'verify_token'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
}
