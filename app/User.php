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
        'name', 'email', 'password',
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

    public function Search ($filter = null){
        
        $results = $this->where(function($query) use ($filter){
            if( $filter) {
                $query->where('name', 'LIKE', "%{$filter}%");
            }
        })
        ->paginate();

        return $results;
    }

    public function getSender ($sender)
    {
        return $this->where('id', $sender)
            ->get()
            ->first();
    }
}
