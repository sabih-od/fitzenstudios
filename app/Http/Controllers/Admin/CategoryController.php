<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('sub_category')->where('parent_id', 0)->get();
        return view('admin.categories.index', compact('categories'));
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
        $fileName = "";
        $dirPath = "uploads/images/categories";
        if($request->file('photo'))
        {
            $fileName = time().'-'.$request->photo->getClientOriginalName();
            $request->photo->move(public_path($dirPath), $fileName);
        }
        $pkid = $request->id;
        if($request->id == 0)
        {
            $category = Category::create([
                'name' => $request->get('name'),                
                'photo' => $fileName,
                'parent_id' => $request->get('parent_id')
            ]);
            return redirect('admin/categories')->
                with('success','Category Created Successfully.');
        }
        else{
            $category = Category::find($request->id);
            if($fileName != "" )
            {
                $this->DeleteFile($category->photo);
                $category->photo = $fileName;
            }
            $category->name = $request->name;
            
            $category->save();
            return redirect('admin/categories')->
                with('success','Category Updated Successfully.');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);      

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->parent_id == 0){
            if(Category::where('parent_id',$category->id)->count() > 0){
                return redirect('admin/categories')->
                with('error','Cannot Delete! Category has sub-category(s).');
            }
           
        }
        $this->DeleteFile($category->photo);    
        $category->delete(); 
        
        return redirect('admin/categories')->
                with('success','Category Deleted Successfully.');
    }

    public function DeleteFile($file_name){
        if(File::exists(public_path('uploads/images/categories/'.$file_name))){
            File::delete(public_path('uploads/images/categories/'.$file_name));
        }

    }
}
