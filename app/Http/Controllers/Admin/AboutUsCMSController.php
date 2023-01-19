<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUsCMS;
use Illuminate\Support\Facades\File;

class AboutUsCMSController extends Controller
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
        $content = AboutUsCMS::find($id);
        return view('admin.cms.aboutus',compact('content'));
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
        $dirPath = "uploads/images/about";

        $update                            = AboutUsCMS::find($id);
        $update->banner_heading            = $request->banner_heading;
        $update->section_one_heading       = $request->section_one_heading;
        $update->section_one_content       = $request->section_one_content;
        $update->section_one_extra_content = $request->section_one_extra_content;
        $update->section_two_heading       = $request->section_two_heading;
        $update->section_two_content       = $request->section_two_content;

        if($request->hasFile('banner_image'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->banner_image))){
                File::delete(public_path($dirPath.'/'.$request->banner_image));
            }    
            $fileName = time().'-'.$request->banner_image->getClientOriginalName();
            $request->banner_image->move(public_path($dirPath), $fileName);

            $update->banner_image =  $dirPath.'/'.$fileName;
        }
        if($request->hasFile('section_one_image'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->section_one_image))){
                File::delete(public_path($dirPath.'/'.$request->section_one_image));
            }    
            $fileName = time().'-'.$request->section_one_image->getClientOriginalName();
            $request->section_one_image->move(public_path($dirPath), $fileName);

            $update->section_one_image =  $dirPath.'/'.$fileName;
        }
        
        if($request->hasFile('section_two_image'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->section_two_image))){
                File::delete(public_path($dirPath.'/'.$request->section_two_image));
            }    
            $fileName = time().'-'.$request->section_two_image->getClientOriginalName();
            $request->section_two_image->move(public_path($dirPath), $fileName);
            $update->section_two_image =  $dirPath.'/'.$fileName;
        }
        
        $update->save();

        $content = AboutUsCMS::find(1);
        return view('admin.cms.aboutus',compact('content'));
    }

    public function destroy($id)
    {
        //
    }
}
