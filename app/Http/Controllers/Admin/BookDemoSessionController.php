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
        $request->validate(
            [
                'heading' => 'required',
                'content' => 'required',
                'image' => 'required|mimes:jpeg,png,bmp,tiff|max:4096',
            ],
            [
                'heading.required' => 'The heading field is required.',
                'content.required' => 'The content is required.',
                'image.required' => 'The image field is required.',
                'image.mimes' => 'Only jpeg, png are allowed.',
                'image.max' => 'Maximum 4096 size allowed to upload.'
            ]
        );
        try {
            $dirPath = "uploads/images/contact";
            $update          = DemoSessionCMS::find($id);
            if(!empty($update)) {
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
            } else {
                $create          = new DemoSessionCMS();
                $create->heading = $request->heading;
                $create->content = $request->content;
                if($request->hasFile('image'))
                {
                    if(File::exists(public_path($dirPath.'/'.$request->image))){
                        File::delete(public_path($dirPath.'/'.$request->image));
                    }
                    $fileName = time().'-'.$request->image->getClientOriginalName();
                    $request->image->move(public_path($dirPath), $fileName);
                    $create->image =  $dirPath.'/'.$fileName;
                }
                $create->save();
            }
            return back()->with('success', 'Successfully updated.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function destroy($id)
    {
        //
    }
}
