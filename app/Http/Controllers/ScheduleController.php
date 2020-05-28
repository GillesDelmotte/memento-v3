<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\User;
use App\Day;
use Illuminate\Http\Request;

class ScheduleController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;

        $name = $request['name'];
        $days = $request['days'];
        $color = $request['color'];

        $schedule = Schedule::create(['name' => $name, 'user_id' => auth()->id(), 'color' => $color]);

        $user = User::where('id', auth()->id())->first();
        $user->schedule = true;
        $user->save();

        foreach($days as $day){
            Day::create(['name' => $day['name'], 'schedule_id' => $schedule->id, 'ms' => $day['ms'], 'me' => $day['me'], 'as' => $day['as'], 'ae' => $day['ae'], 'time' => $day['time']]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
