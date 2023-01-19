<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeaderCMS;
use File;
class HeaderCMSController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = HeaderCMS::find($id);
        return view('admin.cms.header',compact('content'));
    }

    public function update(Request $request, $id)
    {
        $dirPath = "uploads/images/header";

        $update             = HeaderCMS::find($id);
        $update->link_one   = $request->link_one;
        $update->link_two   = $request->link_two;
        $update->link_three = $request->link_three;
        $update->link_four  = $request->link_four;
        $update->link_five  = $request->link_five;
        $update->link_six   = $request->link_six;

        if($request->hasFile('logo'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->logo))){
                File::delete(public_path($dirPath.'/'.$request->logo));
            }    
            $fileName = time().'-'.$request->logo->getClientOriginalName();
            $request->logo->move(public_path($dirPath), $fileName);

            $update->logo =  $dirPath.'/'.$fileName;
        }
        $update->save();

        $content = HeaderCMS::find($id);
        return view('admin.cms.header',compact('content'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
