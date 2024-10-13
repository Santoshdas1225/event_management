@extends('layout')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-20">Manage Event</h4>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                        <div class="card-body">

                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" style="width:100% ">
                                <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Event Name</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Duration</th>
                                    <th>Total Tickets</th>
                                    <th>Actions</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $i=1;
                                        $today = now();
                                    @endphp
                                    @foreach ($events as $d)
                                    <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$d->event_name}}</td>
                                    <td>{{(new \DateTime($d->date))->format('d/m/Y')}}</td>
                                    <td>{{$d->location}}</td>
                                    <td>{{$d->duration}}</td>
                                    <td>{{$d->total_tickets}}</td>
                                    <td>
                                        <a class="btn btn-outline-secondary btn-sm edit" href="{{url('/')}}/editevent/{{$d->id}}" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-outline-secondary btn-sm edit delete-btn" href="delete/{{$d->id}}" title="Delete">
                                            <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{url('/')}}/eventdetails/{{$d->id}}" type="button" class="btn btn-light btn-sm">View</a>
                                    </td>
                                        @if($d->date > $today)
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
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>

@endsection
