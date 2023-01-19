@extends('layouts.admin')
@section('page-title')
Edit Product
@endsection

@section('content') 
<div class="row">
    <div class="col-lg-12">
        <div class="card mt-3 tab-card">
            <div class="card-header tab-card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="one-tab"  href="/admin/products/edit/{{$product->id}}" role="tab" aria-controls="One" aria-selected="true">Basic Details</a>
                    </li>                   
                    <li class="nav-item">
                        <a class="nav-link" id="three-tab" href="/admin/product_images/{{$product->id}}" role="tab" aria-controls="Three" aria-selected="false">Images</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">                       
                    <form action="{{ route('products.update',$product->id) }}" method="POST" >
                        @csrf
                        @method('PUT') 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Categories</label>
                                    <select class="js-example-basic-single form-control" id = "ddlCategories" name="category_id"  required>
                                        <option value="">Please Select</option>
                                        @if(!empty($categories))
                                            @foreach($categories as $val)
                                                @if($val->parent_id==0)
                                                    <optgroup label="{{$val->name}}">
                                                @endif
                                                @if($val->sub_category)  
                                                    @foreach($val->sub_category as $child)
                                                        <option value="{{$child->id??''}}" {{ ( $subcategory_id == $child->id) ? 'selected' : '' }}>
                                                            {{$child->name??''}}
                                                        </option>                                    
                                                    @endforeach 
                                                @endif
                                                </optgroup>
                                            @endforeach 
                                        @endif
                                    </select>
                                    @error('category_id')
                                    <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="manufacturer_id">Select Manufacturers</label>
                                <select class="form-control form-control" name="manufacturer_id" id = "ddlManufacturer" required>
                                    <option>Select Manufacturers</option>   
                                    <option value="{{$product->manufacturer->id}}" selected>
                                        {{$product->manufacturer->name}}
                                    </option>                            

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input class="form-control form-control" name="name" type="text" value="{{$product->name}}" required>
                                </div>
                            </div>
                        
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <textarea id="short_description" name="short_description" rows="4" cols="50" class="form-control">{{$product->short_description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" rows="4" cols="50" class="form-control">{{$product->description}}</textarea>
                                </div>                                   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input class="form-control form-control" name="price" type="text" value="{{$product->price}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <input class="form-control form-control" name="model" type="text" value="{{$product->model}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <input class="form-control form-control" name="year" type="text" value="{{$product->year}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="year">Condition</label>
                                    <select class="form-control form-control" name="condition" required >
                                        <option {{ ( $product->condition == 'New') ? 'selected' : '' }}>New</option>
                                        <option {{ ( $product->condition == 'Used') ? 'selected' : '' }}>Used</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="stock_number">Stock Number</label>
                                    <input class="form-control form-control" name="stock_number" type="text" value="{{$product->stock_number}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="hours">Hours</label>
                                    <input class="form-control form-control" name="hours" type="text" value="{{$product->hours}}" required>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <a href="{{ url('admin/products') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary" >update</button>
                                </div>
                            </div>
                        </div>
                    </form>           
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('custom-js-scripts')
<script type="text/javascript">
    $('#ddlCategories').on('change', function() {
        id = this.value;
        $.ajax({
                url:'/admin/manufacturers/GetManufacturers/'+id,
                type:'get',
                dataType:'json',           
                success:function (response) {
                    //$('#ddlManufacturer').empty()
                    $('#ddlManufacturer').find('option').not(':first').remove();
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }
                    if (len>0) {
                       
                        for (var i = 0; i<len; i++) {
                            var id = response.data[i].id;
                            var name = response.data[i].name;

                            var option = "<option value='"+id+"'>"+name+"</option>"; 
                            $("#ddlManufacturer").append(option);
                        }
                    }

                }

        });
    });
</script>
@endpush