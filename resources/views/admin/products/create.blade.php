@extends('layouts.admin')
@section('page-title')
Create Products
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-12">            
            <div class="card-body">               
                <form action="{{ route('products.store') }}" method="POST" >
                    @csrf
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
                                                    <option value="{{$child->id??''}}">
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
                               

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input class="form-control form-control" name="name" type="text" placeholder="" required>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="short_description">Short Description</label>
                                <textarea id="short_description" name="short_description" rows="4" cols="50" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="4" cols="50" class="form-control"></textarea>
                            </div>                                   
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input class="form-control form-control" name="price" type="text"  onkeypress="return onlyNumberKey(event)" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input class="form-control form-control" name="model" type="text" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input class="form-control form-control" name="year" type="text" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="year">Condition</label>
                                <select class="form-control form-control" name="condition" required>
                                    <option>New</option>
                                    <option>Used</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="stock_number">Stock Number</label>
                                <input class="form-control form-control" name="stock_number" type="text" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hours">Hours</label>
                                <input class="form-control form-control" name="hours" type="text" placeholder="" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <a href="{{ url('admin/products') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary" >Create</button>
                            </div>
                        </div>
                    </div>
                </form>
                   
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

    function onlyNumberKey(evt) {
          
        var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
      }
</script>
@endpush