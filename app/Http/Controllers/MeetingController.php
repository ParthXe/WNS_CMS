<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\meeting;
use DB;
use File;


class MeetingController extends Controller
{

	public function index()
    {
        $meeting_list = DB::select('select meetings.id as meetingId, meetings.meeting_name, meetings.meeting_date, meetings.verticals_id, verticals.id, verticals.vertical_name FROM meetings INNER JOIN verticals ON meetings.verticals_id=verticals.id');
        $meeting_count = count($meeting_list);

        $data = [
            'meeting_list'=>$meeting_list,
            'meeting_count'=>$meeting_count];

        return view('meeting.index',$data);
    }

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
		$insertedId = $meeting->id;
		$file_count = $request['count'];
		for ($q=1; $q <= $file_count ; $q++) {
			$folder_name =  $request['folder_name_'.$q];
			//echo 'Ashish'.$folder_name;
			$path = public_path().'/uploads/meeting/' . $folder_name;
			$fpath = File::makeDirectory($path, $mode = 0777, true, true);
			$files =  $request->file('files_'.$q);
			
			$data =  array();
			foreach($files as $file)
            {

                $name=$file->getClientOriginalName();
                $file->move($path, $name);  
                $data[] = $name;  
            }

			$values = array('meeting_id' => $insertedId,'folder_name' =>$folder_name,'asset_data'=> json_encode($data) );
			DB::table('meeting_assets')->insert($values);
		}
		        return redirect()->route('create')
                        ->with('message','meeting created successfully');

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
