<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class welcome_message extends Model
{
    protected $fillable = [
		'meeting_id',
		'welcome_message',
		'guest_name'            
          // add all other fields
    ];

    protected $table = 'welcome_messages';
}
