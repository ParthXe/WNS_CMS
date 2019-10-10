<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Live_Polling_Model;
use DB;

class LivePollingModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_live_polling()
    {
        //
          return view('live_polling.live_polling');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_live_polling(Request $request)
    {
        //
        $poll= new Live_Polling_Model();
        $poll->question= $request['question'];
        $poll->optionA= $request['optionA'];
        $poll->optionB= $request['optionB'];
        $c= $request['optionC'];
        if($c==""){
           $optionC= ""; 
        }
        else{
          $optionC=$c;  
        }
        $poll->optionC=$optionC;
        $d= $request['optionD'];
        if($d==""){
           $optionD= ""; 
        }
        else{
          $optionD=$d;  
        }
        $poll->optionD=$optionD;
        // $e= $request['optionE'];
        // if($e==""){
        //    $optionE= ""; 
        // }
        // else{
        //   $optionE=$e;  
        // }
        // $poll->optionE=$optionE;
        // $f= $request['optionF'];
        // if($f==""){
        //    $optionF= ""; 
        // }
        // else{
        //   $optionF=$f;  
        // }
        // $poll->optionF=$optionF;
        $poll->active = ($request['active'] == "on") ? 1 : 0;
        $poll_created_time=date("Y-m-d H:i:s");
        $poll_updated_time=date("Y-m-d H:i:s");
        //print_r($poll);
        // add other fields
        $poll->save();
        return redirect()->route('show_live_polling')->with('success','Live Poll Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_live_polling()
    {
        //
       $live_pollings = DB::select('select * from live_polling');
        return view('live_polling.live_polling_list',['live_pollings'=>$live_pollings]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_live_polling($id)
    {
        //
        $live_pollings = DB::select('select * from live_polling where id = ?',[$id]);
        return view('live_polling.edit_live_polling',['live_pollings'=>$live_pollings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_live_polling(Request $request, $id)
    {
        //
       // $poll_id= $request['poll_id'];
        $question= $request['question'];
        $a= $request['optionA'];
        if($a==""){
            $optionA =" ";
        }
        else
        {
           $optionA= $a; 
        }
        $b= $request['optionB'];
        if($b==""){
            $optionB =" ";
        }
        else
        {
           $optionB= $b; 
        }
        $c= $request['optionC'];
        if($c==""){
            $optionC ="";
        }
        else
        {
           $optionC= $c; 
        }
        $d= $request['optionD'];
        if($d==""){
            $optionD =" ";
        }
        else
        {
           $optionD= $d; 
        }
        // $e= $request['optionE'];
        // if($e==""){
        //     $optionE =" ";
        // }
        // else
        // {
        //    $optionE= $e; 
        // }
        // $f= $request['optionF'];
        // if($f==""){
        //     $optionF =" ";
        // }
        // else
        // {
        //    $optionF= $f; 
        // }
        $active = ($request['active'] == "on") ? 1 : 0;

        $updated_time=date("Y-m-d H:i:s");
        DB::update('update live_polling set question=?,optionA=?,optionB=?,optionC=?,optionD=?,active=? where id = ?',[$question,$optionA,$optionB,$optionC,$optionD,$active,$id]);
        return redirect()->route('show_live_polling')
                         ->with('success','Live Poll Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_live_polling($id)
    {
        //
          $live_pollings = DB::select('delete from live_polling where id= ?',[$id]);
          return redirect()->route('show_live_polling')
                           ->with('success','Live Poll Deleted Successfully');
    }

    public function live_pollings_report(Request $request){
      $live_pollings = DB::select('select * from live_polling');
      $polling_sessions = DB::select('select * from polling_session');
      return view('live_polling_report',['live_pollings'=>$live_pollings,'polling_sessions'=>$polling_sessions]);
    }

    /*public function live_polling_api(){
        return Live_Polling_Model::all();
    }*/
    
    public function select_live_poll()
    {
       $live_pollings=Live_Polling_Model::distinct()->get(['poll_id']);
       return view('live_polling.select_live_poll',['live_pollings'=>$live_pollings]);
       //return response()->json($live_pollings);
       
    }

    
    public function live_polling_api()
    {
        $live_pollings=Live_Polling_Model::orderBy('poll_id', 'asc')->get()->groupBy('poll_id');
        
        $response = array($live_pollings);
        return response()->json($response);
       
    }
    
    public function get_poll_sessions($id){
          if($id=='0')
          {
            $response = DB::select('select * from polling_session');
            //$response = array($attendee_list);
            return response()->json($response);
          }
          else if($id=='1')
          {
            $response = DB::select('select * from polling_session where poll_id=1');
            //$response = array($attendee_list);
            return response()->json($response);
          }
          else if($id=='2')
          {
            $response = DB::select('select * from polling_session where poll_id=2');
            //$response = array($attendee_list);
            return response()->json($response);
          }
          else if($id=='3')
          {
            $response = DB::select('select * from polling_session where poll_id=3');
            //$response = array($attendee_list);
            return response()->json($response);
          }
          else
          {
                return false;
          }
    }
    public function generate_live_poll_report($id)
    {
        //$response = array($live_pollings);
      if($id=='0')
      {
        $response = DB::select('select * from live_polling');
        //$response = array($attendee_list);
        return response()->json($response);
      }
      else if($id=='1')
      {
        $response = DB::select('select * from live_polling where poll_id=1');
        //$response = array($attendee_list);
        return response()->json($response);
      }
      else if($id=='2')
      {
        $response = DB::select('select * from live_polling where poll_id=2');
        //$response = array($attendee_list);
        return response()->json($response);
      }
      else if($id=='3')
      {
        $response = DB::select('select * from live_polling where poll_id=3');
        //$response = array($attendee_list);
        return response()->json($response);
      }
      else
      {
            return false;
      }
    }
    
      public function live_polling_question_api($id){
      if($id=='0')
      {
        $response = DB::select('select * from live_polling');
        //$response = array($attendee_list);
        return response()->json($response);
      }
      else if($id=='1')
      {
        $response = DB::select('select * from live_polling where poll_id=1');
        //$response = array($attendee_list);
        return response()->json($response);
      }
      else if($id=='2')
      {
        $response = DB::select('select * from live_polling where poll_id=2');
        //$response = array($attendee_list);
        return response()->json($response);
      }
      else if($id=='3')
      {
        $response = DB::select('select * from live_polling where poll_id=3');
        //$response = array($attendee_list);
        return response()->json($response);
      }
      else
      {
            return false;
      }
    }
    
    public function get_live_poll_result($id)
    {
        //$response = array($live_pollings);
      if($id=='0')
      {
        $response = DB::select('select * from live_polling');
        //$response = array($attendee_list);
        return response()->json($response);
      }
      else if($id=='1')
      {
        $response = DB::select('select * from live_polling where poll_id=1');
        //$response = array($attendee_list);
        return response()->json($response);
      }
      else if($id=='2')
      {
        $response = DB::select('select * from live_polling where poll_id=2');
        //$response = array($attendee_list);
        return response()->json($response);
      }
      else if($id=='3')
      {
        $response = DB::select('select * from live_polling where poll_id=3');
        //$response = array($attendee_list);
        return response()->json($response);
      }
      else
      {
            return false;
      }
    }
    
     public function get_poll_results(Request $request,$id){
      if($id=='0')
      {
        $live_pollings = DB::select('select * from live_polling');
        $polling_sessions = DB::select('select * from polling_session');
        //$response = array($attendee_list);
        return view('get_poll_results',['live_pollings'=>$live_pollings,'polling_sessions'=>$polling_sessions,'poll_id'=>$id]);
      }
      else if($id=='1')
      {
        $live_pollings = DB::select('select * from live_polling where poll_id=1');
        //$response = array($attendee_list);
        $polling_sessions = DB::select('select * from polling_session where poll_id=1');
        return view('get_poll_results',['live_pollings'=>$live_pollings,'polling_sessions'=>$polling_sessions,'poll_id'=>$id]);
      }
      else if($id=='2')
      {
        $live_pollings = DB::select('select * from live_polling where poll_id=2');
        //$response = array($attendee_list);
        $polling_sessions = DB::select('select * from polling_session where poll_id=2');
        return view('get_poll_results',['live_pollings'=>$live_pollings,'polling_sessions'=>$polling_sessions,'poll_id'=>$id]);
      }
      else if($id=='3')
      {
        $live_pollings = DB::select('select * from live_polling where poll_id=3');
        //$response = array($attendee_list);
        $polling_sessions = DB::select('select * from polling_session where poll_id=3');
        return view('get_poll_results',['live_pollings'=>$live_pollings,'polling_sessions'=>$polling_sessions,'poll_id'=>$id]);
      }
      else
      {
            return false;
      }
      
    }

    
    
}
