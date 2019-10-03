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
			
			$tempArray =  array();
            $data =  array();
			foreach($files as $file)
            {

                $name=$file->getClientOriginalName();
                $file->move($path, $name);  
                $tempArray[] = $name;  
            }
            $data = implode(",", $tempArray);
			$values = array('meeting_id' => $insertedId,'folder_name' =>$folder_name,'asset_data'=> $data );
			DB::table('meeting_assets')->insert($values);
		}
		        return redirect()->route('list')
                        ->with('message','meeting created successfully');

    }

    public function edit($id)
    {
            $meeting = DB::select('select meetings.id as meetingId, meetings.meeting_name, meetings.meeting_date, meetings.meeting_created_by, meetings.verticals_id, meetings.verticals_id, verticals.id, verticals.vertical_name, sub_verticals.vertical_id, sub_verticals.sub_vertical_name FROM meetings INNER JOIN verticals ON meetings.verticals_id=verticals.id INNER JOIN sub_verticals ON sub_verticals.vertical_id=verticals.id where meetings.id=?',[$id]);
            $meeting_assets = DB::select('select * from meeting_assets where meeting_id=?',[$id]);
            $verticals_list = DB::select('select * from verticals');
            $verticals_name = DB::select('select * from verticals');
            $verticals_name = DB::select('select meetings.id, meetings.verticals_id, verticals.id, verticals.vertical_name FROM meetings INNER JOIN verticals ON meetings.verticals_id=verticals.id where meetings.id=?',[$id]);
            $sub_vertical_name = DB::select('select meetings.id, meetings.sub_verticals_id, sub_verticals.sub_vertical_name FROM meetings INNER JOIN sub_verticals ON meetings.sub_verticals_id=sub_verticals.id where meetings.id=?',[$id]);

            $asset_count = count($meeting_assets);
            $data = [

                'meeting_data' => $meeting,
                'meeting_assets' => $meeting_assets,
                'asset_count' => $asset_count,
                'verticals_list' => $verticals_list,
                'verticals_name' => $verticals_name,
                'sub_vertical_name' => $sub_vertical_name
            ];

            return view('meeting.edit',$data);
    }

    public function update_meeting(Request $request)
    {
        $meting_id = $request['id'];
        $meting_name = $request['meeting_name'];
        $meeting_time = $request['meeting_time'];
        $meeting_created = $request['meeting_created'];
        $verticals = $request['verticals'];
        $subverticals = $request['subverticals'];
         date_default_timezone_set('Asia/Kolkata');
                $modify = date("Y-m-d H:i:s");           
        DB::update('update meetings set meeting_name = ?,meeting_date=?,meeting_created_by=?,verticals_id=?, sub_verticals_id=?,updated_at=? where id = ?',[$meting_name,$meeting_time,$meeting_created,$verticals,$subverticals,$modify, $meting_id]);

        $count = $request['count'];
        $prevcount = $request['prevcount'];
        if($count<$prevcount)
        {
            for($i=1;$i<=$count;$i++)
            {
                $asset_id = $request['asset_id_'.$i];
                $folder_name = $request['folder_name_'.$i];
                $files =  $request['files_'.$i];

                $this->edit_update_record($asset_id,$folder_name,$files,$modify);
            }

        }  
        else
        {
            $prev_plus = $prevcount+1;
            for ($q=$prev_plus; $q <= $count ; $q++) 
            {
                $folder_name1 =  $request['folder_name_'.$q];
                //echo 'Ashish'.$folder_name;
                $path = public_path().'/uploads/meeting/' . $folder_name1;
                $fpath = File::makeDirectory($path, $mode = 0777, true, true);
                $files =  $request->file('files_'.$q);
                
                $tempArray =  array();
                $data =  array();
                foreach($files as $file)
                {

                    $name=$file->getClientOriginalName();
                    $file->move($path, $name);  
                    $tempArray[] = $name;  
                }
                $data = implode(",", $tempArray);
                $values = array('meeting_id' => $meting_id,'folder_name' =>$folder_name1,'asset_data'=> $data );
                DB::table('meeting_assets')->insert($values);
            }

            for($i=1;$i<=$prevcount;$i++)
            {
                $asset_id = $request['asset_id_'.$i];
                $folder_name = $request['folder_name_'.$i];
                $files =  $request['files_'.$i];

                $this->edit_update_record($asset_id,$folder_name,$files,$modify);

            }   
        }
        return redirect()->route('list')->with('message','meeting update successfully');
    }



    public function remove_image(Request $request)
    {
        $image_name = DB::select('select * from meeting_assets where id =?',[$request->asset_id]);

        $test = $image_name[0]->asset_data;
        $test1 = explode(",", $test);
        $image_delete = $request['image_name'];
        $imagesNew = "";
        if(count($test1)>1){
            $temp_arr = array();
            for($nn=0;$nn<count($test1);$nn++)
            {
            if($test1[$nn] != $image_delete)
            {
            $temp_arr[] = $test1[$nn];
            }
            }
            $imagesNew = implode(",",$temp_arr);
        }

        DB::update('update meeting_assets set asset_data = ? where id = ?',[$imagesNew, $request->asset_id]);

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


    public function edit_update_record($asset_id,$folder_name,$files,$modify)
    {

                $image_name = DB::select('select asset_data from meeting_assets where id =?',[$asset_id]);
                $test = $image_name[0]->asset_data;
                $prev_img= array();

                if(!empty($files))
                {
                $prev_img = explode(',', $test);  
                $path = public_path().'/uploads/meeting/' . $folder_name;

                $tempArray =  array();
                $data =  array();
                foreach($files as $file)
                {

                $name=$file->getClientOriginalName();
                $file->move($path, $name);  
                $tempArray[] = $name;  
                }
                    $image_new =  array_merge($prev_img,$tempArray);
                    $new_files = implode(',', $image_new);
                }
                else
                {
                    $new_files = $test;
                }
                //$new_files = $request['files_'.$i];
                //$asset_id = $request['asset_id_'.$i];
                
                //$imagesNew = implode(",",$new_files);
                DB::update('update meeting_assets set folder_name = ?, asset_data=?, updated_at=? where id = ?',[$folder_name, $new_files, $modify, $asset_id]);
    }


    public function destroy($id)
    {
        DB::table('meetings')->where('id', $id)->delete();
        DB::table('meeting_assets')->where('meeting_id', $id)->delete();

         return redirect()->route('list')
                        ->with('message','Deleted successfully');
    }
}
