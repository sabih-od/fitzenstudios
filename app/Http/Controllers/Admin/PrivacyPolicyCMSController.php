<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicyCMS;
use File;

class PrivacyPolicyCMSController extends Controller
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
        $content = PrivacyPolicyCMS::find(1);
        return view('admin.cms.privacy',compact('content'));
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
        $dirPath = "uploads/images/privacy";

        $update = PrivacyPolicyCMS::find($id);
        $update->banner_heading  = $request->banner_heading;
        $update->section_heading = $request->section_heading;
        $update->section_content = $request->section_content;
        if($request->hasFile('banner_image'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->banner_image))){
                File::delete(public_path($dirPath.'/'.$request->banner_image));
            }    
            $fileName = time().'-'.$request->banner_image->getClientOriginalName();
            $request->banner_image->move(public_path($dirPath), $fileName);

            $update->banner_image =  $dirPath.'/'.$fileName;
        }
        $update->save();

        $content = PrivacyPolicyCMS::find($id);
        return view('admin.cms.privacy',compact('content'));
    }
    
    function destroy($id)
    {
        //
    }
}
