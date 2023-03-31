@extends('layouts.customer')
@section('page-title')
My Payments
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="secHeading mt-2">Invoices & Payments</h2>
                </div>
                <div class="col-md-6 text-right">
                    {{-- <a href="../admin-portal/contract.php" class="btnStyle addUserBtn">View Contract</a> --}}
                    {{-- <div class="d-flex filter h-auto">
                        <a href="javascript:;" class="active">All</a>
                        <a href="javascript:;">Paid</a>
                        <a href="javascript:;">Un Paid</a>
                    </div> --}}
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead>
                            <tr class="thead-dark">
                                <th><span>No.</span></th>
                                <th><span>Name</span></th>
                                <th><span>Invoice ID</span></th>
                                <th><span>Date</span></th>
                                <th><span>Invoice Month</span></th>
                                <th><span>Email</span></th>
                                <th><span>Payment</span></th>
                                <th><span>Status</span></th>
                                <th><span>Details</span></th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $item)
                                    <tr>
                                        <td><span>{{ $loop->iteration }}</span></td>
                                        <td><span>{{ $item->customer_name }}</span></td>
                                        <td><span>{{ $item->invoice }}</span></td>
                                        <td><span>{{ date('d-m-Y', strtotime($item->created_at)) }}</span></td>
                                        <td><span>{{ date('M', strtotime($item->created_at)) }}</span></td>
                                        <td><span>{{ $item->customer_email }}</span></td>
                                        <td><span>${{ $item->payment }}</span></td>
                                        @if($item->status == "paid")
                                            <td colspan="2"><span class="badge badge-pill badge-success">Paid</span></td>
                                        @else
                                            <td><span class="badge badge-pill badge-danger">Un-Paid</span></td>
                                        @endif
                                        @if($item->status == "unpaid")
                                            <!-- Button trigger modal -->
                                            <td><a href="javascript:;" data-id="{{ $item->id }}" data-payment="{{ $item->payment }}" class="btnStyle payNow">Pay Now</a></td>

                                        @endif
                                        {{-- <td><a href="assets/images/pdf.pdf" target="_blank" class="btnStyle">VIEW DETAILS</a></td> --}}
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="9">
                                        <h4 style="text-align: center;">No Payments Available..!!</h4>
                                    </td>
                                </tr>
                                @endforelse

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Payment title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('customer/payment') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="payment_id" id="payment_id" value="">
                                                <div class="form-group">
                                                    <label for="name">Payment</label>
                                                    <input class="form-control" name="payment" id="payment" type="text" value="" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Card Number</label>
                                                    <input class="form-control" name="card_number" type="text" maxlength="16"
                                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                           required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Card Expiry Month</label>
                                                    <input class="form-control" name="card_expiry_month" type="text" maxlength="2"
                                                           placeholder="10"
                                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                           required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Card Expiry Year</label>
                                                    <input class="form-control" name="card_expiry_year" type="text" maxlength="4"
                                                           placeholder="2022"
                                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                           required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Card CVV</label>
                                                    <input class="form-control" name="card_cvv" type="text" maxlength="3"
                                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                           placeholder="123" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary" style="width:100%;">Checkout</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    </div>
                                </div>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
<script type = "text/javascript">
    $(document).ready(function(){
        $('.payNow').click(function(){

            var payment_id = $(this).data('id');
            var payment    = $(this).data('payment');

            $('#payment_id').val(payment_id);
            $('#payment').val(payment);

            $('#exampleModal').modal('show');
        })
    })
  </script>
@endsection
