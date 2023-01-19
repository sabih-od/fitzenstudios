<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with('Manufacturer')->latest()->get();
            return datatables()->of($products)
            ->addColumn('manufacturer_name', function ($data) {
                return $data->manufacturer->name ?? '';
            })
            ->addColumn('action', function($row){
                $btn = '<a class="btn btn-sm btn-warning btnEdit" href ="/admin/products/' . $row->id . '/edit" >
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                        <button class="btn btn-sm btn-danger" onclick="Delete('. $row->id .');" > 
                            <i class="fa fa-trash"></i>
                        </button>               
                        <form action="'.route('products.destroy',$row->id).'" method="POST" style="display: none;"
                            id="delete-form-'. $row->id .'"  >                       
                            <input type="hidden" name="_token" value="'.csrf_token().'">                                
                            <input type="hidden" name="_method" value="DELETE">                     
                        </form>
                       ';
                return $btn;
            })
            ->rawColumns(['manufacturer_name', 'action'])
            ->make(true);
        }
        
        return view('admin.products.index');
    }
    public function create()
    {
        $categories = Category::with('sub_category')->get();
        return view('admin.products.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect('admin/products')->
        with('success','Product Created Successfully.');
    }    
   
    public function edit(Product $product)
    {
        $categories = Category::with('sub_category')->get();
        $subcategory_id = Manufacturer::where('id',$product->manufacturer_id)->pluck('category_id')->first();        
        return view('admin.products.edit',compact('product', 'categories','subcategory_id'));
    }
   
    public function update(Request $request, Product $product)
    {             
        $product->update($request->all());
        return redirect()->route('products.index')
            ->with('success', 'product updated successfully');
    }
    
    public function destroy(Product $product)
    {
        foreach($product->product_images as $pi){
            $this->DeleteFile($pi->photo);                 
            $pi->delete();  
        }
        $this->DeleteFile($product->photo);        
        $product->delete();  
        return redirect('admin/products')->
            with('success','Product Deleted Successfully.');
    }

    public function DeleteFile($file_name)
    {
        if(File::exists(public_path('uploads/images/products/'.$file_name))){
            File::delete(public_path('uploads/images/products/'.$file_name));
        }  

    }
}
