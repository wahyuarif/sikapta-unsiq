<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;

class Kaprodi extends Authenticatable
{
    use Notifiable;

    // declare guard type
    protected $guard = 'kaprodi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dosen_id','prodi_id', 'email', 'password',
    ];
    
    public function getCreatedAttribute() 
    {
        return Carbon::parse($this->attribute['created_at'])
                        ->translatedFormat('l, d F Y');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
}
