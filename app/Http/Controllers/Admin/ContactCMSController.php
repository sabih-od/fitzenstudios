<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactCMS;
use App\Models\ContactInquiry;
use App\Models\BookDemoSession;
use App\Models\Newsletter;
use App\Models\Trainer;

use File;

class ContactCMSController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $content = ContactCMS::find($id);
        return view('admin.cms.contact',compact('content'));
    }


    public function update(Request $request, $id)
    {
        $dirPath = "uploads/images/contact";

        $update                      = ContactCMS::find($id);
        $update->banner_heading      = $request->banner_heading;
        $update->section_heading     = $request->section_heading;
        $update->section_sub_heading = $request->section_sub_heading;
        $update->location_heading    = $request->location_heading;
        $update->location            = $request->location;
        $update->email_heading       = $request->email_heading;
        $update->email               = $request->email;
        $update->phone_heading       = $request->phone_heading;
        $update->phone               = $request->phone;
        $update->map                 = $request->map;
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

        $content = ContactCMS::find($id);
        return view('admin.cms.contact',compact('content'));
    }

    public function ContactInquiry() {
        $contacts = ContactInquiry::orderBy('id','DESC')->get();
        return view('admin.contact_inquiry',compact('contacts'));
    }

    public function DeleteContactInquiry(Request $request) {
        ContactInquiry::where('id',$request->id)->delete();
        return back();
    }

    public function SessionRequest() {
        $demos    = BookDemoSession::with('Customer', 'Customer.trainer')->orderBy('id','DESC')->get();
        $trainers = Trainer::get();
        return view('admin.demo_request',compact('demos', 'trainers'));

    }

    public function DeleteSessionRequest(Request $request) {
        BookDemoSession::where('id',$request->id)->delete();
        return back();
    }
    public function NewsLetter() {
        $newsletters = Newsletter::orderBy('id','DESC')->get();
        return view('admin.newsletter',compact('newsletters'));
    }

    public function DeleteNewsletter(Request $request) {
        Newsletter::where('id',$request->id)->delete();
        return back();
    }


    public function destroy($id)
    {
        //
    }
}
