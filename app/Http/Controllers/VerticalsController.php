<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\verticals;
use DB;

class VerticalsController extends Controller
{

	public function create_vertical()
    {
    	return view('verticals.create_vertical',compact('post'));
    }
    public function save_vertical(Request $request)
    {
  //       		$this->validate(request(),[
		//     'meeting_name'        => 'required',
  //           'meeting_time'         => 'date_format:Y-m-d H:i:s',
  //           'meeting_created'         => 'required',
  //           'verticals' => 'required',
  //           'subverticals'  => 'required'
		// ]);

		$verticals= new verticals();
		$verticals->vertical_name= $request['vertical_name'];
		// $meeting->meeting_date= $request['meeting_time'];
		// $meeting->meeting_created_by= $request['meeting_created'];
		// $meeting->verticals_id= $request['verticals'];
		// $meeting->sub_verticals_id= $request['subverticals'];
		// add other fields


		$verticals->save();

		$insertedId = $verticals->id;

		//echo $insertedId;
		$field_values_array = $request['sub_verticals_name'];
		foreach($field_values_array as $value){
    	// Your database query goes here
		$values = array('vertical_id' => $insertedId,'sub_vertical_name' =>$value );
		DB::table('sub_verticals')->insert($values);
		}


        return redirect()->route('create_vertical')->with('message','meeting create successfully');

    }
}
