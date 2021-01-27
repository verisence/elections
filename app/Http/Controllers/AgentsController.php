<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Agent;
use App\Models\Payment;
use App\Models\Stream;
use App\Models\Station;

class AgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Agent::orderBy('created_at','desc')->get();
        return view('pages.agents', compact(['agents']));
        // return json_encode($agents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $streams = Stream::orderBy('created_at','asc')->get();
        return view('agent.create', compact(['streams']));
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
            'id_number' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        // Create agent
        $agent = new Agent;
        $agent->name = $request->input('name');
        $agent->id_number = $request->input('id_number');
        $agent->phone_number = $request->input('phone');
        $agent->email = $request->input('email');
        $agent->votes = 0;
        $agent->stream_id = implode(",", $request->input('stream'));

        // Save agent
        $agent->save();

        // Redirect
        return redirect('/agents')->with('success', 'Agent Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agent = Agent::find($id);
        $streams = Stream::orderBy('created_at','desc')->get();
        $payments = Payment::orderBy('created_at','desc')->get()->where('agent_id', $id);
        $stream = Stream::orderBy('created_at','desc')->get()->where('id', $agent->stream_id)->values()[0];
        $station = Station::orderBy('created_at','desc')->get()->where('id', $stream->station_id)->values()[0];
        return view('agent.show', compact(['agent', 'payments', 'station', 'stream', 'streams']));
        // return json_encode($station);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agent = Agent::find($id);
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
            'id_number' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);

        // Edit agent
        $agent = Agent::find($id);
        $agent->name = $request->input('name');
        $agent->id_number = $request->input('id_number');
        $agent->phone_number = $request->input('phone_number');
        $agent->email = $request->input('email');
        $agent->stream_id = implode(",", $request->input('stream'));

        // Save updates
        $agent->save();

        // Redirect
        return redirect('/agents/'.$id)->with('success', 'Agent Details Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agent = Agent::find($id);
        $agent->delete();

        return redirect('/agents')->with('success', 'Agent Deleted');
    }

    // Update Votes
    public function vote(Request $request,$id)
    {
        // get agent
        $agent = Agent::find($id);
        // get stream
        $stream = Stream::orderBy('created_at','desc')->get()->where('id', $agent->stream_id)->values()[0];
        // get station
        $station = Station::orderBy('created_at','desc')->get()->where('id', $stream->station_id)->values()[0];
        // get all streams in a station
        $streams = Stream::orderBy('created_at', 'desc')->get()->where('station_id', $stream->station_id)->values();
        // get all agents in a stream
        $agents = Agent::orderBy('created_at', 'desc')->get()->where('stream_id', $agent->stream_id)->values();


        // update agent's votes
        $agent->votes = $request->input('votes');
        $agent->save();
        $agentVotes = $agent->votes;
        // update stream's votes
        $streamVotes = $stream->votes;
        // $streamVotes += $agentVotes;
        // $stream->votes = $streamVotes;


        // if (count($agents)>1) {
        //     return 123;
        // }

        if ($streamVotes==0) {
            $streamVotes += $agentVotes;
            $stream->votes = $streamVotes;
        } else {
            if ($streamVotes==$agentVotes) {
                // $streamVotes = 0;
                $streamVotes+=$agentVotes;
                $stream->votes = $streamVotes;
                $stream->pending = 0;
                $station->pending = 0;
            } else {
                // $streamVotes=$streamVotes;
                $stream->votes = $streamVotes;
                $stream->pending = 1;
                $station->pending = 1;
            }

        }

        $stream->save();

        // $stationVotes = $station->votes;

        // for ($i=0; $i < count($streams); $i++) {
        //     $stationVotes += $streams[$i]->votes;
        // }

        // $stationVotes = 0;
        foreach ($streams as $stream) {
            $stationVotes = 0;
            $stationVotes+=$stream->votes;
        }

        // $stationVotes += $streamVotes;
        $station->votes = $stationVotes;
        $station->save();
        // return json_encode($streams);
        return redirect('/agents/'.$id)->with('success', 'Votes Updated');
    }

    public function makePayment(Request $request, $id)
    {
        $agent = Agent::find($id);
        $payment = new Payment();
        $payment->amount = $request->input('amount');
        $payment->agent_id = $agent->id;
        $payment->save();
        return redirect('/agents/'.$id)->with('success', 'Payment made to ' . $agent->name);
    }

}
