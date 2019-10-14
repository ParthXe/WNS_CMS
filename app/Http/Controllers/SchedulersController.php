<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Calendar;
use App\Schedulers;

class SchedulersController extends Controller
{
    //
    public function index()
    {
      $schedules = Schedulers::all();
      return view('schedulers.index', compact('schedules'));
    }

    public function store_schedules(Request $request){
      Schedulers::create($request->all());
      return redirect()->route('schedulers.index');
    }
}
