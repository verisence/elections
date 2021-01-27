<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Agent;


class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('created_at','desc')->get();
        $agents = Agent::orderBy('created_at','asc')->get();
        return view('pages.payments', compact(['payments', 'agents']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agents = Agent::orderBy('created_at','asc')->get();
        return view('payment.create', compact(['agents']));
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
            'amount' => 'required',
        ]);

        // Create payment
        $payment = new Payment;
        $payment->amount = $request->input('amount');
        $payment->agent_id = implode(",", $request->input('agent'));

        // Save payment
        $payment->save();

        // Redirect
        return redirect('/payments')->with('success', 'Payment Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::find($id);
        $agents = Agent::orderBy('created_at','desc')->get();
        $agentSort = Agent::orderBy('created_at','desc')->get()->where('id', $payment->agent_id)->values();
        $agent = $agentSort[0];
        return view('payment.show', compact(['payment', 'agent', 'agents']));
        // return json_encode($agent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::find($id);
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
            'amount' => 'required',
        ]);

        // Edit payment
        $payment = Payment::find($id);
        $payment->amount = $request->input('amount');
        $payment->agent_id = implode(",", $request->input('agent'));

        // Save updates
        $payment->save();

        // Redirect
        return redirect('/payments/'.$id)->with('success', 'Payment Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();

        return redirect('/payments')->with('success', 'Payment Deleted');
    }
}
