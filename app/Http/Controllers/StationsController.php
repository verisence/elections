<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Station;

class StationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::orderBy('created_at','desc')->get();
        return view('pages.stations', compact(['stations']));
        // return json_encode($stations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('station.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'name' => 'required',
            'location' => 'required'
        ]);

        // Create station
        $station = new Station;
        $station->name = $request->input('name');
        $station->location = $request->input('location');
        $station->votes = 0;
        $station->pending = false;

        // Save station
        $station->save();

        // Redirect
        return redirect('/stations')->with('success', 'Station Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $station = Station::find($id);
        return view('station.show')->with('station', $station);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $station = Station::find($id);
        // return view('station.edit')->with('station', $station);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation
        $this->validate($request, [
            'name' => 'required',
            'location' => 'required'
        ]);

        // Edit station
        $station = Station::find($id);
        $station->name = $request->input('name');
        $station->location = $request->input('location');

        // Save station
        $station->save();

        // Redirect
        return redirect('/stations/'.$id)->with('success', 'Station Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $station = Station::find($id);
        $station->delete();

        return redirect('/stations')->with('success', 'Station Deleted');
    }
}
