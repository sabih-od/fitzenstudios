@extends('layouts.admin-portal')
@section('page-title')
Customer Contracts
@endsection
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@section('content')


<div class="row">
    <div class="col-md-12">
 
        <div class="card">
            <div class="card-body">                
                <div class="">
                    <table class="table" id = "gridView">
                        <thead class="thead-light" >
                            <th >#</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Contract Signed Date</th>   
                            <th>Contract</th>                       
                            {{-- <th width= "15%">Action</th>  --}}
                        </thead>
                        <tbody>
                            @forelse ($contracts as $item)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- <td style="text-align: center">{{ $item["customers"]->first_name.' '.$item["customers"]->last_name}}</td> --}}
                                    <td style="text-align: center">{{ $item->client_name  ?? "" }}</td>
                                   
                                    <td>{{ $item["customers"]->email }}</td>
                                    <td>{{ $item["customers"]->phone }}</td>
                                    <td style="text-align: center">{{ date('d-m-Y',strtotime($item->client_date))}}</td>
                                    <td><a href="{{ url('admin/view-contract/'.$item->id) }}" style="background-color: var(--theme-color);color:#fff;font-weight:bold;" class="btn">View Contract</a></td>
                                    {{-- <td>
                                        <button class="btn btn-sm btn-danger" onclick="Delete('. {{$item->id}} .');" > 
                                            <i class="fa fa-trash"></i>
                                        </button>               
                                        <form action="{{url('admin/delete-contact-inquiry')}}" id="deleteRow" method="POST" style="display: none;"
                                           >    
                                            @csrf                   
                                                                        
                                            <input type="hidden" name="id" value="{{$item->id}}">                     
                                        </form>
                                    </td> --}}
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('custom-js-scripts')
<script type="text/javascript">

    function Delete(id){
    if (confirm("Are you sure to delete?")) {
        event.preventDefault();
        $('#deleteRow').submit(); 
        // document.getElementById('delete-form-' + id).submit();
    }
    return false;
   }

</script>
@endpush