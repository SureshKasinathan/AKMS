<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    /**
     * The users that belong to the company.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}