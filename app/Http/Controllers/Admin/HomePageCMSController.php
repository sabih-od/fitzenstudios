<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomepageCMS;
use Illuminate\Support\Facades\File;

class HomePageCMSController extends Controller
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
        $content = HomepageCMS::find(1);
        return view('admin.cms.homepage',compact('content'));
    }

  
    public function update(Request $request, $id)
    {
        $dirPath = "uploads/images/home";

        $update                            = HomepageCMS::find($id);
        $update->banner_heading            = $request->banner_heading;
        $update->banner_sub_heading        = $request->banner_sub_heading;
        $update->banner_content            = $request->banner_content;
        $update->about_heading             = $request->about_heading;
        $update->about_sub_heading         = $request->about_sub_heading;
        $update->about_content             = $request->about_content;
        $update->categories_heading        = $request->categories_heading;
        $update->categories_sub_heading    = $request->categories_sub_heading;
        $update->categories_content_one    = $request->categories_content_one;
        $update->categories_content_two    = $request->categories_content_two;
        $update->categories_content_three  = $request->categories_content_three;
        $update->categories_content_four   = $request->categories_content_four;
        $update->categories_content_five   = $request->categories_content_five;
        $update->categories_content_six    = $request->categories_content_six;
        $update->workout_heading           = $request->workout_heading;
        $update->workout_sub_heading       = $request->workout_sub_heading;
        $update->workout_url_one           = $request->workout_url_one;
        $update->workout_url_two           = $request->workout_url_two;
        $update->workout_url_three         = $request->workout_url_three;
        $update->workout_url_four          = $request->workout_url_four;
        $update->testimonial_heading       = $request->testimonial_heading;
        $update->testimonial_sub_heading   = $request->testimonial_sub_heading;
        $update->testimonial_author_one    = $request->testimonial_author_one;
        $update->testimonial_content_one   = $request->testimonial_content_one;
        $update->testimonial_author_two    = $request->testimonial_author_two;
        $update->testimonial_content_two   = $request->testimonial_content_two;
        $update->testimonial_author_three  = $request->testimonial_author_three;
        $update->testimonial_content_three = $request->testimonial_content_three;

        if($request->hasFile('banner_image'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->banner_image))){
                File::delete(public_path($dirPath.'/'.$request->banner_image));
            }    
            $fileName = time().'-'.$request->banner_image->getClientOriginalName();
            $request->banner_image->move(public_path($dirPath), $fileName);

            $update->banner_image =  $dirPath.'/'.$fileName;
        }

        if($request->hasFile('about_image'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->about_image))){
                File::delete(public_path($dirPath.'/'.$request->about_image));
            }    
            $fileName = time().'-'.$request->about_image->getClientOriginalName();
            $request->about_image->move(public_path($dirPath), $fileName);

            $update->about_image =  $dirPath.'/'.$fileName;
        }
        if($request->hasFile('categories_image_one'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->categories_image_one))){
                File::delete(public_path($dirPath.'/'.$request->categories_image_one));
            }    
            $fileName = time().'-'.$request->categories_image_one->getClientOriginalName();
            $request->categories_image_one->move(public_path($dirPath), $fileName);

            $update->categories_image_one =  $dirPath.'/'.$fileName;
        }
        if($request->hasFile('categories_image_two'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->categories_image_two))){
                File::delete(public_path($dirPath.'/'.$request->categories_image_two));
            }    
            $fileName = time().'-'.$request->categories_image_two->getClientOriginalName();
            $request->categories_image_two->move(public_path($dirPath), $fileName);

            $update->categories_image_two =  $dirPath.'/'.$fileName;
        }
        if($request->hasFile('categories_image_three'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->categories_image_three))){
                File::delete(public_path($dirPath.'/'.$request->categories_image_three));
            }    
            $fileName = time().'-'.$request->categories_image_three->getClientOriginalName();
            $request->categories_image_three->move(public_path($dirPath), $fileName);

            $update->categories_image_three =  $dirPath.'/'.$fileName;
        }
        if($request->hasFile('categories_image_four'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->categories_image_four))){
                File::delete(public_path($dirPath.'/'.$request->categories_image_four));
            }    
            $fileName = time().'-'.$request->categories_image_four->getClientOriginalName();
            $request->categories_image_four->move(public_path($dirPath), $fileName);

            $update->categories_image_four =  $dirPath.'/'.$fileName;
        }
        if($request->hasFile('categories_image_five'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->categories_image_five))){
                File::delete(public_path($dirPath.'/'.$request->categories_image_five));
            }    
            $fileName = time().'-'.$request->categories_image_five->getClientOriginalName();
            $request->categories_image_five->move(public_path($dirPath), $fileName);

            $update->categories_image_five =  $dirPath.'/'.$fileName;
        }
        if($request->hasFile('categories_image_six'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->categories_image_six))){
                File::delete(public_path($dirPath.'/'.$request->categories_image_six));
            }    
            $fileName = time().'-'.$request->categories_image_six->getClientOriginalName();
            $request->categories_image_six->move(public_path($dirPath), $fileName);

            $update->categories_image_six =  $dirPath.'/'.$fileName;
        }
        if($request->hasFile('workout_image_one'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->workout_image_one))){
                File::delete(public_path($dirPath.'/'.$request->workout_image_one));
            }    
            $fileName = time().'-'.$request->workout_image_one->getClientOriginalName();
            $request->workout_image_one->move(public_path($dirPath), $fileName);

            $update->workout_image_one =  $dirPath.'/'.$fileName;
        }
        if($request->hasFile('workout_image_two'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->workout_image_two))){
                File::delete(public_path($dirPath.'/'.$request->workout_image_two));
            }    
            $fileName = time().'-'.$request->workout_image_two->getClientOriginalName();
            $request->workout_image_two->move(public_path($dirPath), $fileName);

            $update->workout_image_two =  $dirPath.'/'.$fileName;
        }
        if($request->hasFile('workout_image_three'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->workout_image_three))){
                File::delete(public_path($dirPath.'/'.$request->workout_image_three));
            }    
            $fileName = time().'-'.$request->workout_image_three->getClientOriginalName();
            $request->workout_image_three->move(public_path($dirPath), $fileName);
            $update->workout_image_three =  $dirPath.'/'.$fileName;
        }
        
        if($request->hasFile('workout_image_four'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->workout_image_four))){
                File::delete(public_path($dirPath.'/'.$request->workout_image_four));
            }    
            $fileName = time().'-'.$request->workout_image_four->getClientOriginalName();
            $request->workout_image_four->move(public_path($dirPath), $fileName);
            $update->workout_image_four =  $dirPath.'/'.$fileName;
        }
        
        if($request->hasFile('gallery_image_one'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->gallery_image_one))){
                File::delete(public_path($dirPath.'/'.$request->gallery_image_one));
            }    
            $fileName = time().'-'.$request->gallery_image_one->getClientOriginalName();
            $request->gallery_image_one->move(public_path($dirPath), $fileName);
            $update->gallery_image_one =  $dirPath.'/'.$fileName;
        }
        
        if($request->hasFile('gallery_image_two'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->gallery_image_two))){
                File::delete(public_path($dirPath.'/'.$request->gallery_image_two));
            }    
            $fileName = time().'-'.$request->gallery_image_two->getClientOriginalName();
            $request->gallery_image_two->move(public_path($dirPath), $fileName);
            $update->gallery_image_two =  $dirPath.'/'.$fileName;
        }

        if($request->hasFile('gallery_image_three'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->gallery_image_three))){
                File::delete(public_path($dirPath.'/'.$request->gallery_image_three));
            }    
            $fileName = time().'-'.$request->gallery_image_three->getClientOriginalName();
            $request->gallery_image_three->move(public_path($dirPath), $fileName);
            $update->gallery_image_three =  $dirPath.'/'.$fileName;
        }

        if($request->hasFile('gallery_image_four'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->gallery_image_four))){
                File::delete(public_path($dirPath.'/'.$request->gallery_image_four));
            }    
            $fileName = time().'-'.$request->gallery_image_four->getClientOriginalName();
            $request->gallery_image_four->move(public_path($dirPath), $fileName);
            $update->gallery_image_four =  $dirPath.'/'.$fileName;
        }

        if($request->hasFile('gallery_image_five'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->gallery_image_five))){
                File::delete(public_path($dirPath.'/'.$request->gallery_image_five));
            }    
            $fileName = time().'-'.$request->gallery_image_five->getClientOriginalName();
            $request->gallery_image_five->move(public_path($dirPath), $fileName);
            $update->gallery_image_five =  $dirPath.'/'.$fileName;
        }
        
        $update->save();

        $content = HomepageCMS::find(1);
        return view('admin.cms.homepage',compact('content'));

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
