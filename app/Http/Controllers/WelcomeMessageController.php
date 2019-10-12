<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\welcome_message;
use DB;



class WelcomeMessageController extends Controller
{

	public function index()
    {
    	$welcome_messages = DB::select('select * from welcome_messages');
		$welcome_messages_count = count($welcome_messages);
		$data = [
		'welcome_messages'=>	$welcome_messages,
		'welcome_messages_count'=> $welcome_messages_count
		];

		return view('welcome_messege.index',$data);
    }

    public function create_message()
    {
    	$meeting_list = DB::select('select id, meeting_name from meetings');
    	$data = [
		'meeting_list'=>	$meeting_list
		];
    	return view('welcome_messege.create_message', $data);
    }

    public function save_message(Request $request)
    {
    	$welcome_message= new welcome_message();
    	$welcome_message->meeting_id= $request['meeting_id'];
		$welcome_message->welcome_message= $request['message'];
		$field_values_array = $request['guest_name'];
		$guest_name = implode(',', $field_values_array);
		$welcome_message->guest_name = $guest_name;
		$welcome_message->save();

		return redirect()->route('message_list')
			->with('message','Message Add successfully');
    }

    public function edit_message($id)
    {

    	$message = DB::select('select welcome_messages.welcome_message, welcome_messages.guest_name, welcome_messages.meeting_id, welcome_messages.id as wid, meetings.meeting_name,meetings.id from welcome_messages INNER JOIN meetings ON meetings.id= welcome_messages.meeting_id where welcome_messages.id=?',[$id]);
    	$meeting_list = DB::select('select id, meeting_name from meetings');
    	$message_count = count($message);
    		$data= [
    			'message' => $message,
    			'message_count' => $message_count,
    			'meeting_list' => $meeting_list
    		];
            return view('welcome_messege.edit',$data);

    
    }


    public function update_message(Request $request)
    {

    	$id = $request['id'];
    	$meeting_id = $request['meeting_id'];
    	$messsage = $request['message'];
		$field_values_array = $request['guest_name'];
		$guest_name1 = implode(',', $field_values_array);

		DB::update('update welcome_messages set meeting_id = ?, welcome_message	 = ?, guest_name= ? where id = ?',[$meeting_id,$messsage,$guest_name1,$id]);

				return redirect()->route('message_list')
			->with('update_message','Message Update successfully');

    }

        public function destroy($id)
    {
			DB::table('welcome_messages')->where('id', $id)->delete();
			

			return redirect()->route('message_list')
			->with('message','Deleted successfully');
    }
}
