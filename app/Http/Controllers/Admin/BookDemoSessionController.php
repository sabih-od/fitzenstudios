<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemoSessionCMS;
use File;
class BookDemoSessionController extends Controller
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
        $content =  DemoSessionCMS::find($id);
       return view('admin.cms.demosessioncms',compact('content'));
    }

 
    public function update(Request $request, $id)
    {
        $dirPath = "uploads/images/contact";

        $update          = DemoSessionCMS::find($id);
        $update->heading = $request->heading;
        $update->content = $request->content;
        if($request->hasFile('image'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->image))){
                File::delete(public_path($dirPath.'/'.$request->image));
            }    
            $fileName = time().'-'.$request->image->getClientOriginalName();
            $request->image->move(public_path($dirPath), $fileName);
            $update->image =  $dirPath.'/'.$fileName;
        }
        $update->save();

        $content = DemoSessionCMS::find($id);
        return view('admin.cms.demosessioncms',compact('content'));
    }

  
    public function destroy($id)
    {
        //
    }
}
