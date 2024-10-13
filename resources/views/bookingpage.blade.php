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
                            <h4 class="mb-sm-0 font-size-20">Get Ticket</h4>
                            <h5 class="mb-sm-0 font-size-16">Payment ID: <span id="payment-id" style="background-color: yellow"></span></h5>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form id="customerForm" method="POST" action="{{url('/booking')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="ref" value="{{ request('ref') }}">
                        <input type="hidden" name="paymentID" id="paymentID" value="">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">

                                                <label for="title" class="form-label">Event Name<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                              @if ($id)
                                              <input class="form-control" type="text" value="{{$event->event_name}}" id="eventname_display" name="eventname_display" disabled required>
                                              <input type="hidden" id="eventname" name="eventname" value="{{$event->id}}">
                                              <input type="hidden" id="eventname_source" name="eventname_source" value="input"> 
                                              @else
                                              <select class="form-select" name="eventname" id="eventname" required>
                                                <option value="">--Select Event--</option>
                                                @foreach($event as $e)
                                                    <option value="{{ $e->id }}">{{ $e->event_name }}</option>
                                                @endforeach  
                                            </select>  
                                              @endif                                                           
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="location" class="form-label">Type<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                <select class="form-select" name="type" id="type" required>
                                                    <option value="">--Select Type--</option>
                                                    <option value="premium">Premium</option>
                                                    <option value="general">General</option>
                                                    <option value="free">Free</option>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="eventdate" class="form-label">Price<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                <input class="form-control" type="text" id="price" name="price" readonly>
                                            </div>
                                        </div>

                                        <div class="col-12" id="a_details_wrapper">
                                            <div class="card a_details">
                                                <div class="card-body p-4">
                                                    <div style="display: flex; justify-content: space-between">
                                                        <h5>Attendee Details</h5>
                                                        <button type="button" class="btn btn-danger remove_details_btn"><i class="fa-solid fa-trash"></i></button>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label for="tickets" class="form-label">Name<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                                <input class="form-control" type="text" name="a_name[]" placeholder="Enter attendee name" required>
                                                                @if($errors->has('a_name'))
                                                                  <p style="color: red" class="error">{{ $errors->first('a_name') }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label for="tickets" class="form-label">Age<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                                <input class="form-control" type="number" name="a_age[]" placeholder="Enter age" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label for="id_proof" class="form-label">Identity Proof type<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                                <select class="form-select" name="id_proof[]" required>
                                                                    <option value="">--Select Type--</option>
                                                                    <option value="Aadhar Card">Aadhar Card</option>
                                                                    <option value="Pan Card">Pan Card</option>
                                                                    <option value="Voter ID">Voter ID</option>
                                                                    <option value="Passport">Passport</option>
                                                                </select> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="mb-3">
                                                                <label for="example-text-input" class="form-label">ID proof number<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                                <input class="form-control" type="text" name="id_number[]" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-primary" id="add_details_btn">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12" style="padding-right: 50px;display: flex;justify-content: end">
                                <div>
                                    <h6>Total person: <span id="total_person_display"></span></h6>
                                    <h6>Ticket Amount: ₹<span id="total_amount_display"></span></h6>
                                    <h6>GST: 18%</h6>
                                    <h5>Total: ₹<span id="total_price_display"></span></h5>
                                    <input type="hidden" name="total_person" id="total_person" value="">
                                    <input type="hidden" name="total_price" id="total_price" value="">
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
    $(document).ready(function() {
        $('input[name="a_age[]"]').on('input', function() {
        var age = $(this).val();
        if (age.length > 3) {
            $(this).val(age.slice(0, 3)); // Limit input to 3 digits
        }
    });
        // Function to fetch price based on selected event and type
        $('#eventname, #type').on('change', function() {
            var eventId = $('#eventname').val();
            var type = $('#type').val();
            console.log(type);
            if (eventId && type) {
                $.ajax({
                    url: "{{ url('/get-price') }}", // Route to fetch price
                    type: 'GET',
                    data: {
                        event_id: eventId,
                        type: type
                    },
                    success: function(response) {
                        if (response.price) {
                            $('#price').val(response.price);
                            console.log(response.price);
                        } else {
                            $('#price').val(response.price);
                        }
                        updateTotals(); // Update totals when price is fetched
                    },
                    error: function() {
                        alert('Error fetching price.');
                    }
                });
            }
        });

        // Function to update totals based on attendee count and price
        function updateTotals() {
            let numberOfAttendees = $('#a_details_wrapper .a_details').length;
            let pricePerTicket = parseFloat($('#price').val().replace(/[^0-9.-]+/g,"")) || 0; // Get numeric price
            let ticketAmount = numberOfAttendees * pricePerTicket;
            let gst = ticketAmount * 0.18;
            let totalPrice = ticketAmount + gst;

            $('#total_person_display').text(numberOfAttendees);
            $('#total_amount_display').text(ticketAmount.toFixed(2));
            $('#total_price_display').text(totalPrice.toFixed(2));

            $('#total_person').val(numberOfAttendees);
            $('#total_price').val(totalPrice.toFixed(2));
        }

        // Function to add new attendee form
        $('#add_details_btn').click(function() {
            var newAttendee = $('.a_details').first().clone(); // Clone the first attendee details form
            newAttendee.find('input').val(''); // Clear input fields
            newAttendee.find('select').val(''); // Clear select fields
            $('#a_details_wrapper').append(newAttendee); // Append the new form
            updateTotals(); // Update total
        });

        // Function to remove attendee form
        $(document).on('click', '.remove_details_btn', function() {
            $(this).closest('.a_details').remove(); // Remove the closest parent .a_details div
            updateTotals(); // Update total
        });

        // Initial total calculation
        updateTotals();
    });

    function generatePaymentID() {
        const digits = 8;
        const paymentIdNumber = Math.floor(Math.random() * Math.pow(10, digits)).toString().padStart(digits, '0'); // Generate an 8-digit number
        return paymentIdNumber; // Example: PAY-12345678
    }

    // When the page loads, generate a unique payment ID and display it
    document.addEventListener("DOMContentLoaded", function() {
        const paymentId = generatePaymentID();
        document.getElementById("payment-id").textContent = paymentId; // Display the generated payment ID
        document.getElementById("paymentID").value = paymentId; // Set the hidden input value
    });
</script>

@endsection
