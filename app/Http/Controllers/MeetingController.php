<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\meeting;
use DB;

class MeetingController extends Controller
{
    public function create()
    {
        return view('meeting.create',compact('post'));
    }

    public function save_data(Request $request)
    {
        		$this->validate(request(),[
		    'meeting_name'        => 'required',
            'meeting_time'         => 'date_format:Y-m-d H:i:s',
            'meeting_created'         => 'required',
            'verticals' => 'required',
            'subverticals'  => 'required'
		]);

		$meeting= new meeting();
		$meeting->meeting_name= $request['meeting_name'];
		$meeting->meeting_date= $request['meeting_time'];
		$meeting->meeting_created_by= $request['meeting_created'];
		$meeting->verticals_id= $request['verticals'];
		$meeting->sub_verticals_id= $request['subverticals'];
		// add other fields


		$meeting->save();

		        return redirect()->route('create')
                        ->with('message','meeting create successfully');

    }
}
