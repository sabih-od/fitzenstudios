<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterCMS;
use File;
class FooterCMSController extends Controller
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
        $content = FooterCMS::find($id);
        return view('admin.cms.footer', compact('content'));
    }

  
    public function update(Request $request, $id)
    {
        $dirPath = "uploads/images/footer";
        
        $update                 = FooterCMS::find($id);
        $update->heading_one    = $request->heading_one;
        $update->link_one       = $request->link_one;
        $update->link_two       = $request->link_two;   
        $update->link_three     = $request->link_three;
        $update->link_four      = $request->link_four;
        $update->heading_two    = $request->heading_two;
        $update->heading_three  = $request->heading_three;
        $update->facebook_link  = $request->facebook_link;
        $update->twitter_link   = $request->twitter_link;
        $update->instagram_link = $request->instagram_link;
        $update->linkedin_link  = $request->linkedin_link;
        $update->note           = $request->note;
        if($request->hasFile('logo_image'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->logo_image))){
                File::delete(public_path($dirPath.'/'.$request->logo_image));
            }    
            $fileName = time().'-'.$request->logo_image->getClientOriginalName();
            $request->logo_image->move(public_path($dirPath), $fileName);

            $update->logo_image =  $dirPath.'/'.$fileName;
        }
        if($request->hasFile('footer_image'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->footer_image))){
                File::delete(public_path($dirPath.'/'.$request->footer_image));
            }    
            $fileName = time().'-'.$request->footer_image->getClientOriginalName();
            $request->footer_image->move(public_path($dirPath), $fileName);

            $update->footer_image =  $dirPath.'/'.$fileName;
        }
        $update->save();

        $content = FooterCMS::find($id);
        return view('admin.cms.footer',compact('content'));
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
