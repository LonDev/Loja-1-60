<?php

namespace londev\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
	protected $fillable = ['nome','senha','nivel_acesso','cargo'];

	//public $dateFormat = 'd.M.Y';

	  /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha', 'remember_token',
    ];

}
