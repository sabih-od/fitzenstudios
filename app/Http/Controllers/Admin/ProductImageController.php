<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);    
        return view('admin.products.product_images', compact('product'));
    }

    public function store(Request $request)
    {
        $fileName = "";
        $dirPath = "uploads/images/products";
        $product = Product::find($request->id);

        if($request->file('photo'))
        {
            if(File::exists(public_path($dirPath.'/'.$product->photo))){
                File::delete(public_path($dirPath.'/'.$product->photo));
            }    
            $fileName = time().'-'.$request->photo->getClientOriginalName();
            $request->photo->move(public_path($dirPath), $fileName);
        }
        
        $product->photo =  $fileName;
        $product->save();

        return redirect()->back()
        ->with(['success' => 'Product image uploaded successfully']);

    }

    public function additional_images(Request $request)
    {
        $fileName = "";
        $dirPath = "uploads/images/products";
        if($request->hasfile('photos'))
        {
            foreach($request->file('photos') as $image)
            {
                $fileName = time().'-'.$image->getClientOriginalName();
                $image->move(public_path($dirPath), $fileName);

                ProductImage::create([
                    'product_id' => $request->get('id'),                    
                    'photo' => $fileName,
                ]);
            }
        }

        return redirect()->back()
        ->with(['success' => 'Product image uploaded successfully']);

    }
    
    public function deleteProdImage(Request $request)
    {
        $product_image = ProductImage::find($request->id);
        if(File::exists(public_path('uploads/images/products/'.$product_image->photo))){
            File::delete(public_path('uploads/images/products/'.$product_image->photo));
        }      
        $product_image->delete();  
        return redirect()->back()->
            with('success','Product Image Deleted Successfully.');
    }
}
