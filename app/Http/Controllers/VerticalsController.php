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
		$field_values_array = $request['sub_verticals_name'];
		$sub_verticals = implode(',', $field_values_array);
		$verticals->sub_vertical_name = $sub_verticals;
		$verticals->save();


        return redirect()->route('list_vertical')->with('message','meeting create successfully');

    }

    public function edit_vertical($id)
    {
    	$vertical = DB::select('select * from verticals where id=?',[$id]);
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
		$field_values_array = $request['sub_verticals_name'];
		$sub_verticals = implode(',', $field_values_array);
		DB::update('update verticals set vertical_name = ?, sub_vertical_name = ? where id = ?',[$vName,$sub_verticals,$id]);

    }

    public function destroy($id)
    {
			DB::table('verticals')->where('id', $id)->delete();
			

			return redirect()->route('list')
			->with('message','Deleted successfully');
    }
}
