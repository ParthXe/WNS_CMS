<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Live_Polling_Model extends Model
{
    //
   protected $fillable = [
    'question', 'optionA', 'optionB','optionC','optionD','active'
   ];

   protected $table = 'live_polling';
}
