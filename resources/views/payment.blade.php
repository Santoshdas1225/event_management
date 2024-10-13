@extends('layout')

@section('content')
<style>
    input[type=file]::file-selector-button {
       margin-right: 20px;
       border: none;
       background: #084cdf;
       padding: 5px 10px; 
       border-radius: 10px;
       color: #fff;
       cursor: pointer;
       transition: background .2s ease-in-out;
    }
    input[type=file]::file-selector-button:hover {
         background: #0d45a5;
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
                @if (session('success'))
                    <script>
                        alertify.success("{{ session('success') }}");
                    </script>
                @endif
                @if (session('error'))
                    <script> 
                        alertify.error("{{ session('error') }}");
                    </script>                 
                @endif
                
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-20">Payment Gateway</h4>

                           
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form id="customerForm" method="POST" action="{{url('/payment')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="ref" value="{{ request('ref') }}">
                        <input type="hidden" name="payment_id" value="{{ $paymentID }}">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Card Number<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                <input class="form-control" type="text" id="c_number" name="c_number" required>                                                            
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="eventdate" class="form-label">CVV<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                <input class="form-control" type="text" id="cvv" name="cvv" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-12" style="padding-right: 50px;display: flex;justify-content: end">
                                            <div>
                                                <h6>Total person: <span id="total_person">{{$paymentdetails->person}}</span></h6>
                                                <h5>Total: ₹<span id="total_price">{{$paymentdetails->total_amount}}</span></h5>
                                                {{-- <input type="hidden" name="total_person" id="total_person">
                                                <input type="hidden" name="total_price" id="total_price"> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <br>
                            <div style="margin-right: 10px;display: flex;justify-content: end">
                                <button type="submit" class="btn btn-primary btn-rounded w-lg waves-effect waves-light" id="submitbtn">Proceed</button>
                            </div>
                            <br>
                        </div> <!-- end col -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
 
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

 
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey && e.key === 'r') || e.key === 'F5') {
            e.preventDefault(); // Prevent reload
            alertify.error("Page reload is disabled to prevent payment interruptions.");
        }
    });

 
    window.addEventListener('beforeunload', function(e) {
       
        e.preventDefault();
        e.returnValue = 'Reloading this page will terminate the process'; 
    });

    
    $('#c_number, #cvv').on('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); 
        let maxLength = e.target.id === 'c_number' ? 16 : 3; 
        if (value.length > maxLength) {
            value = value.slice(0, maxLength); // Limit input
        }
        e.target.value = value;
    });
</script>

@endsection
