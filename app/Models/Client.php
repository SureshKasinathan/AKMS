<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'email', 'username', 'firstname', 'lastname', 'cell', 'phonenumber',
        'address', 'city', 'state_code', 'zip', 'password',
    ];
}
