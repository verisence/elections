<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Stream;
use App\Models\Station;
use App\Models\Agent;

class StreamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $streams = Stream::orderBy('created_at','desc')->get();
        $stations = Station::orderBy('created_at','asc')->get();
        return view('pages.streams', compact(['streams', 'stations']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stations = Station::orderBy('created_at','asc')->get();
        return view('stream.create', compact(['stations']));
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
            'station' => 'required'
        ]);

        // Create stream
        $stream = new Stream;
        $stream->name = $request->input('name');
        $stream->votes = 0;
        $stream->pending = false;
        $stream->station_id = implode(",", $request->input('station'));

        // Save stream
        $stream->save();



        // Redirect
        return redirect('/streams')->with('success', 'Stream Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stream = Stream::find($id);
        $stations = Station::orderBy('created_at','asc')->get();
        $agents = Agent::orderBy('created_at','desc')->get()->where('stream_id', $id);
        $station = Station::find($stream->station_id);
        return view('stream.show', compact(['stream','station','stations','agents']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stream = Stream::find($id);
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
            'station' => 'required'
        ]);

        // Edit stream
        $stream = Stream::find($id);
        $stream->name = $request->input('name');
        $stream->station_id = implode(",", $request->input('station'));

        // Save updates
        $stream->save();

        // Redirect
        return redirect('/streams/'.$id)->with('success', 'Stream Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stream = Stream::find($id);
        $stream->delete();

        return redirect('/streams')->with('success', 'Stream Deleted');
    }
}
