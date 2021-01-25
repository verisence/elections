<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voter;

class VotersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voters = Voter::orderBy('created_at','desc')->get();
        return view('pages.voters', compact(['voters']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('voter.create');
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

        // Create voter
        $voter = new Voter;
        $voter->name = $request->input('name');
        $voter->id_number = $request->input('id_number');
        $voter->phone_number = $request->input('phone');
        $voter->email = $request->input('email');

        // Save voter
        $voter->save();

        // Redirect
        return redirect('/voters')->with('success', 'Voter Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voter = Voter::find($id);
        return view('voter.show', compact(['voter']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voter = Voter::find($id);
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

        // Edit voter
        $voter = Voter::find($id);
        $voter->name = $request->input('name');
        $voter->id_number = $request->input('id_number');
        $voter->phone_number = $request->input('phone_number');
        $voter->email = $request->input('email');

        // Save updates
        $voter->save();

        // Redirect
        return redirect('/voters')->with('success', 'Voter details updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voter = Voter::find($id);
        $voter->delete();

        return redirect('/voters')->with('success', 'Voter Deleted');
    }
}
