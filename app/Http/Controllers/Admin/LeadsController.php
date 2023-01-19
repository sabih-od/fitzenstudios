<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadsController extends Controller
{
    public function index()
    {
        $leads = Lead::where('is_customer',0)->get();
        return view('admin.leads.index',compact('leads'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'phone'      => 'required',
            'age'        => 'required',
            'gender'     => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $leads              = new Lead();
        $leads->is_customer = 0;
        $leads->first_name  = $request->first_name;
        $leads->last_name   = $request->last_name;
        $leads->email       = $request->email;
        $leads->phone       = $request->phone;
        $leads->age         = $request->age;
        $leads->gender      = $request->gender;
        $leads->note        = $request->note;
        $leads->save();

        return redirect()->back()->with('success','Lead Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'age' => 'required',
            'gender' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // store
            $lead = Lead::find($id);
            $lead->first_name       = $request->first_name;
            $lead->last_name       = $request->last_name;
            $lead->email       = $request->email;
            $lead->phone       = $request->phone;
            $lead->age      = $request->age;
            $lead->gender = $request->gender;
            $lead->note = $request->note;
            $lead->save();

            return redirect()->back()
            ->with('success','Lead updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return redirect()->back()
            ->with('success','Lead Deleted successfully');
    }
}
