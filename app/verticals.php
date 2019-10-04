<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class verticals extends Model
{
        protected $fillable = [
		'vertical_name',
		'sub_vertical_name'            
          // add all other fields
    ];

    protected $table = 'verticals';
}


