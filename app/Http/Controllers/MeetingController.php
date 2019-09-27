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
    	$verticals_name = DB::select('select * from verticals');
    	$data = [
    	'verticals_name'=>	$verticals_name];

        return view('meeting.create',$data);
    }

    public function save_data(Request $request)
    {
        		$this->validate(request(),[
		    'meeting_name'        => 'required',
            'meeting_time'         => 'required',
            'meeting_created'         => 'required',
            'verticals' => 'required'
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

    public function fetch_sub_vertical(Request $request)
    {
    	

	 	$sub_verticals = DB::select('select * from sub_verticals where vertical_id= ?', [$request->message]);
    		 	$response = array(
          'status' => 'success',
          'sub_verticals' => $sub_verticals,
      );
    		 

				return response()->json($response);
	    
    }
}
