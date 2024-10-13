@extends('layout')

@section('content')

<style>
 /* Card Container */
.event-card {
    max-width: 900px;
    margin: 0 auto;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    background-color: #fff;
}

/* Header */
.card-header {
    display: flex;
    align-items: center;
    background: linear-gradient(to right, #007bff, #00c6ff);
    padding: 20px;
    color: white;
    position: relative;
}

.event-photo img {
    width: 250px;
    height: 150px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
}

/* Hover effect on image */
.event-photo img:hover {
    transform: scale(1.05);
}

.event-summary {
    flex: 1;
    margin-left: 20px;
}

.event-summary h2 {
    margin-bottom: 10px;
    font-size: 28px;
   
}

.event-summary button {
    padding: 10px 15px;
    background-color: transparent;
    border: 2px solid white;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Hover effect on button */
.event-summary button:hover {
    background-color: white;
    color: #007bff;
}

/* Body */
.card-body {
    padding: 20px;
}

.description-section h4 {
    font-size: 22px;
    margin-bottom: 10px;
    color: black
}

.description-section p {
    font-size: 16px;
    line-height: 1.6;
    color: black
}

/* Ticket Section */
.ticket-section {
    margin: 30px 0;
}

.ticket-section h4 {
    font-size: 22px;
    margin-bottom: 20px;
}

.ticket-boxes {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.ticket-box {
    background-color: #f8f9fa;
    border-radius: 10px;
    text-align: center;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, transform 0.3s ease;
}

/* Hover effect on ticket boxes */
/* .ticket-box:hover {
    background-color: #007bff;
    color: white;
    transform: translateY(-5px);
} */

.ticket-box h5 {
    margin-bottom: 5px;
    font-size: 18px;
}

.ticket-box p {
    font-size: 24px;
    font-weight: bold;
}

/* Event Buttons */
.event-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.event-buttons .btn {
    padding: 12px 25px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

/* Hover effects for buttons */
.event-buttons .btn-primary:hover {
    background-color: #0056b3;
    transform: translateY(-3px);
}

.event-buttons .btn-secondary:hover {
    background-color: #5a6268;
    transform: translateY(-3px);
}

.event-buttons .btn-success:hover {
    background-color: #28a745;
    transform: translateY(-3px);
}

</style>
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
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">BOOKING DETAILS</h4>

                        <div class="page-title-right">
                         
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Tickets</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value" data-target="865.2">{{$event->total_tickets}}</span>
                                    </h4>
                                    
                                </div>
                                <?php
                                $remainingTicktes =$event->total_tickets - ($event->ticket_premium_booking+$event->ticket_general_booking+$event->ticket_free_booking);
                                ?>

                            </div>
                            <div class="text-nowrap">
                                @if ($remainingTicktes > 0)
                                <span class="badge bg-soft-success text-success" style="font-size: 14px">Available</span>
                                @else
                                <span class="badge bg-soft-danger text-danger" style="font-size: 14px">sold</span>
                                @endif
                                <span class="ms-1 text-muted font-size-13">Tickets: {{$remainingTicktes}}</span>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <?php
                                    $remainingPremium =($event->premium_tickets)-($event->ticket_premium_booking);
                                    $remainingGeneral =($event->general_tickets)-($event->ticket_general_booking);
                                    ?>
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Premium booked</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value">{{$event->ticket_premium_booking}}</span>
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                </div>
                            </div>
                            <div class="text-nowrap">
                                @if ($remainingPremium > 0)
                                <span class="badge bg-soft-success text-success" style="font-size: 14px">Available</span>
                                @else
                                <span class="badge bg-soft-danger text-danger" style="font-size: 14px">sold</span>
                                @endif
                                <span class="ms-1 text-muted font-size-13">Tickets: {{$remainingPremium}}</span>

                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">General booked</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value">{{$event->ticket_general_booking}}</span>
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                </div>
                            </div>
                            <div class="text-nowrap">
                                @if ($remainingGeneral > 0)
                                <span class="badge bg-soft-success text-success" style="font-size: 14px">Available</span>
                                @else
                                <span class="badge bg-soft-danger text-danger" style="font-size: 14px">sold</span>
                                @endif
                                <span class="ms-1 text-muted font-size-18"> Tickets: {{$remainingGeneral}}</span>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Free Booking</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value">{{$event->ticket_free_booking}}</span>
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                </div>
                            </div>
                            <div class="text-nowrap">
                                <?php

                                $freeTickets = $event->total_tickets - ($event->general_tickets+$event->premium_tickets);
                                
                                $freeTicket_remaining = $freeTickets - $event->ticket_free_booking  
                                ?>
                                @if ($freeTicket_remaining > 0)
                                <span class="badge bg-soft-success text-success" style="font-size: 14px">Available</span>
                                @else
                                <span class="badge bg-soft-danger text-danger">sold</span>
                                @endif
                                <span class="ms-1 text-muted font-size-18">Tickets: {{$freeTicket_remaining}}</span>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col-->

                <div class="col-xl-12">
                    <center><h3 style="color: black">EVENT DETAILS</h3></center>
                    <div class="card event-card">
                        <div class="card-header">
                            <div class="event-photo">
                                <img src="{{asset($event->photo)}}" alt="Event Photo">
                            </div>
                            <div class="event-summary">
                                <h2>{{$event->event_name}}</h2>
                                <p><strong>Location:</strong>{{$event->location}}</p>
                                <p><strong>Date:</strong>{{ (new \DateTime($event->date))->format('F j, Y') }}</p>
                                <p><strong>TIME:</strong> {{ (new \DateTime($event->date))->format('h:i A') }}</p>
                            </div>
                        </div>
                    
                        <div class="card-body">
                            <div class="description-section">
                                <h4>Description</h4>
                                <p>{{$event->description}}</p>
                            </div>
                    
                            <div class="ticket-section">
                                <h5 style="color: black">Ticket Information</h5>
                                <div class="ticket-boxes">
                                    <div class="ticket-box">
                                        <h5>Total Tickets</h5>
                                        <p style="margin-bottom: 0px">{{$event->total_tickets}}</p>
                                        
                                    </div>
                                    <div class="ticket-box">
                                        <h5>VIP Tickets</h5>
                                        <p style="margin-bottom: 0px">{{$event->premium_tickets}}</p>
                                        <span>Rs:{{$event->premium_price}}</span>
                                    </div>
                                    <div class="ticket-box">
                                        <h5>General Tickets</h5>
                                        <p style="margin-bottom: 0px">{{$event->general_tickets}}</p>
                                        <span>Rs:{{$event->general_price}}</span>
                                    </div>
                                    
                                    <div class="ticket-box">
                                        <h5>Free Tickets</h5>
                                        <p style="margin-bottom: 0px">{{$freeTickets}}</p>
                                        
                                    </div>
                                </div>
                            </div>
                    
                            <div class="event-buttons">
                                @if ($event->user_id == Session::get('id'))
                                <a href="{{url('/')}}/editevent/{{$event->id}}" class="btn btn-primary btn-rounded waves-effect waves-light">Edit Event</a>
                                <button class="btn btn-secondary btn-rounded waves-effect waves-light">View Customers</button> 
                                @endif
                                
                                <a href="{{url('/')}}/booking/{{$event->id}}" class="btn btn-success btn-rounded waves-effect waves-light">Get Ticket</a>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- end card -->
                </div>
            </div><!-- end row-->


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->    
@endsection