<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManufacturerController extends Controller
{
    
    public function index(Request $request)
    {
        $categories = Category::with('sub_category')->get();
        if ($request->ajax()) {
            $manufacturers = Manufacturer::with('Category')->latest()->get();
            return datatables()->of($manufacturers)
            ->addColumn('category_name', function ($data) {
                return $data->category->name ?? '';
            })
            ->addColumn('action', function($row){
                $btn = '<button class="btn btn-sm btn-warning btnEdit" data-id="'.$row->id.'" >
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="Delete('. $row->id .');" > 
                            <i class="fa fa-trash"></i>
                        </button>               
                        <form action="'.route('manufacturers.destroy',$row->id).'" method="POST" style="display: none;"
                            id="delete-form-'. $row->id .'"  >                       
                            <input type="hidden" name="_token" value="'.csrf_token().'">                                
                            <input type="hidden" name="_method" value="DELETE">                     
                        </form>';
                return $btn;
            })
            ->rawColumns(['category_name','action'])
            ->make(true);;
        }
        return view('admin.manufacturers.index', compact('categories'));
    }

   
    public function store(Request $request)
    {
        if($request->id == 0)
        {
            Manufacturer::create($request->all());
            return redirect('admin/manufacturers')->
            with('success','Manufacturer Created Successfully.');
        }
        else{
            $manufacturer = Manufacturer::find($request->id);
            $manufacturer->update($request->all());  
            return redirect('admin/manufacturers')->
            with('success','Manufacturer Updated Successfully.');
        }
    }

   
    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();  
        return redirect('admin/manufacturers')->
            with('success','Manufacturer Deleted Successfully.');
    }

    public function GetManufacturers($id)
    {
        $data = Manufacturer::where('category_id',$id)->get();
        return response()->json(['data' => $data]);
    }

    
}
