<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meeting extends Model
{
    protected $fillable = [
		'meeting_name',
		'meeting_date',
		'meeting_created_by',
		'verticals_id',
		'sub_verticals_id',          
          // add all other fields
    ];
}
