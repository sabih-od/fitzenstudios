<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQCMS;
use App\Models\FaqBannerCMS;
use File;
class FAQCMSController extends Controller
{
    
    public function index(Request $request)
    {
        $faqs    = FAQCMS::all();
        $content = FaqBannerCMS::find(1);
        return view('admin.cms.faqs.index',compact('faqs', 'content'));
    }
    public function updateBannerFaq(Request $request) {
     
        $dirPath                    = "uploads/images/faq";
        $update_faq                 = FaqBannerCMS::find(1);
        $update_faq->banner_heading = $request->banner_heading;

        if($request->hasFile('banner_image'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->banner_image))){
                File::delete(public_path($dirPath.'/'.$request->banner_image));
            }    
            $fileName = time().'-'.$request->banner_image->getClientOriginalName();
            $request->banner_image->move(public_path($dirPath), $fileName);
            $update_faq->banner_image =  $dirPath.'/'.$fileName;
        }
        $update_faq->save();
        return redirect('admin/faq');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add_faq          = new FAQCMS();
        $add_faq->heading = $request->heading;
        $add_faq->content = $request->content;
        $add_faq->save();

        return redirect('admin/faq');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $content =  FAQCMS::where('id',$id)->first();
        return view('admin.cms.faqs.edit',compact('content'));
    }

   
    public function update(Request $request, $id)
    {
        $add_faq          = FAQCMS::find($id);
        $add_faq->heading = $request->heading;
        $add_faq->content = $request->content;
        $add_faq->save();

        return redirect('admin/faq');
    }

 
    public function destroy($id)
    {
        FAQCMS::where('id',$id)->delete();  
        return redirect('admin/faq')->with('success','Product Deleted Successfully.');
    }
}
