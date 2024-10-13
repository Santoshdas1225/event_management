@extends('layout')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

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
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Total events</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value" data-target="865.2">{{$eventCount}}</span>
                                    </h4>
                                    
                                </div>

                            </div>
                            {{-- <div class="text-nowrap">
                                <span class="badge bg-soft-success text-success">+$20.9k</span>
                                <span class="ms-1 text-muted font-size-13">Since last week</span>
                            </div> --}}
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
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Total attendee</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value" data-target="6258">0</span>
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                </div>
                            </div>
                            <div class="text-nowrap">
                                <span class="badge bg-soft-danger text-danger">-29 Trades</span>
                                <span class="ms-1 text-muted font-size-13">Since last week</span>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col-->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Ticket sell</span>
                                    <h4 class="mb-3">
                                        $<span class="counter-value" data-target="4.32">0</span>M
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                </div>
                            </div>
                            <div class="text-nowrap">
                                <span class="badge bg-soft-success text-success">+ $2.8k</span>
                                <span class="ms-1 text-muted font-size-13">Since last week</span>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-header">
                            <a href=""><h4 class="card-title">Manage Events</h4></a>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">

                                    <thead>
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Events</th>
                                            <th>Date</th>
                                            <th>Details</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i= 1;
                                        $today = now();
                                        ?>
                                        @foreach ($events as $event)
                                        <tr>
                                            <td scope="row">{{$i++}}</td>
                                            <td>{{$event->event_name}}</td>
                                            <td>{{(new \DateTime($event->date))->format('d/m/Y')}}</td>
                                            <td>
                                                <a href="{{url('/')}}/eventdetails/{{$event->id}}" type="button" class="btn btn-light btn-sm">View</a>
                                            </td>

                                            @if($event->date > $today)
                                            <td><span class="badge rounded-pill bg-success">upcoming</span>
                                            </td>
                                            @else
                                            <td><span class="badge rounded-pill bg-info">completed</span>
                                            </td>
                                            @endif
                                            
                                        </tr>
                                        @endforeach
                                        
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div><!-- end row-->


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->    
@endsection