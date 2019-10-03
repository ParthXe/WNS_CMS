<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\verticals;
use DB;

class VerticalsController extends Controller
{

	public function index()
    {
		$verticals_list = DB::select('select * from verticals');
		$verticals_count = count($verticals_list);
		$data = [
		'verticals_name'=>	$verticals_list,
		'verticals_count'=> $verticals_count
		];

		return view('verticals.index',$data);
    }

	public function create_vertical()
    {
    	return view('verticals.create_vertical',compact('post'));
    }
    public function save_vertical(Request $request)
    {


		$verticals= new verticals();
		$verticals->vertical_name= $request['vertical_name'];


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

    public function edit_vertical($id)
    {
    	$vertical = DB::select('select verticals.id as vId, verticals.vertical_name, sub_verticals.id as sId, sub_verticals.sub_vertical_name FROM verticals INNER JOIN sub_verticals ON verticals.id=sub_verticals.vertical_id where verticals.id=?',[$id]);
    	$vertical_count = count($vertical);
    		$data= [
    			'vertical_data' => $vertical,
    			'vertical_count' => $vertical_count
    		];
            return view('verticals.edit',$data);

    }

    public function update_vertical(Request $request)
    {
    	$id = $request['id'];
    	$vName = $request['vertical_name'];
    	$curCount = $request['curCount'];
    	$prev = $request['prev'];
    	DB::update('update verticals set vertical_name = ? where id = ?',[$vName,$id]);
    	$field_values_array = $request['sub_verticals_name'];
    	if($prev<$curCount)
    	{
    		

			    		$prev_plus = $prev+1;
	
					//echo $insertedId;
				$field_values_array = $request['sub_verticals_name'];
				foreach($field_values_array as $value){
		    	// Your database query goes here
				$values = array('vertical_id' => $id,'sub_vertical_name' =>$value );
				DB::table('sub_verticals')->insert($values);
				}
		
            	$q=$prev;
            	foreach($field_values_array as $key => $value){
		    	// Your database query goes here
				DB::update('update sub_verticals set sub_vertical_name = ? where id = ?',[$value,$q]);
				$q++;
				}
            
	
    	}
    	else
    	{
    		$i=1;
			
			foreach($field_values_array as $key => $value){
			// Your database query goes here
			DB::update('update sub_verticals set sub_vertical_name = ? where id = ?',[$value,$i]);
			//echo $query;
			$i++;
			}

    	}
		
    }
}
