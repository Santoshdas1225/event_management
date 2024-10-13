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
            <!-- Advanced Search Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="advancedSearchForm" action="{{ url('allevents') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="searchTitle">Event Name</label>
                                        {{-- <input type="text" class="form-control" id="searchTitle" name="title" placeholder="Event Name" value="{{ request('title') }}"> --}}
                                        <select class="form-select" id="eventname" name="eventname">
                                            <option value="">--Select Event--</option>
                                            @foreach ($eventname as $p)
                                            <option value="{{$p}}" {{ old('event_name', request('event_name')) == $p ? 'selected' : '' }}>{{$p}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group col-md-4">
                                        
                                        <label for="searchFromDate">From Date</label>
                                        <input type="date" class="form-control" id="searchFromDate" name="start_date" value="{{ old('created_date', request('created_date')) }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="searchToDate">To Date</label>
                                        <input type="date" class="form-control" id="searchToDate" name="end_date" value="{{ request('end_date') }}">
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top: 10px">
                                        <label for="type">Type</label>
                                        <select class="form-select" id="type" name="type">
                                            <option value="">--Select Type--</option>
                                            @foreach ($eventTypes as $type)
                                            <option value="{{ $type }}" {{ old('type', request('type')) == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top: 10px">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" value="{{ request('title') }}">
                                         
    
                                        </select>
                                    </div>
                                </div>
                                
                                    
                                    
                               
                                <br>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary w-sm waves-effect waves-light">Search</button>

                                    <button type="reset" class="btn btn-secondary" onclick="window.location.href='{{ url('/allevents') }}'">Reset</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Advanced Search Form -->

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
                                  
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th></th>
                                    
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
                                        <a href="{{url('/')}}/eventdetails/{{$d->id}}" type="button" class="btn btn-light btn-sm">View</a>
                                    </td>
                                        @if($d->date > $today)
                                            <td><span class="badge rounded-pill bg-success">upcoming</span>
                                            </td>
                                            @else
                                            <td><span class="badge rounded-pill bg-info">completed</span>
                                            </td>
                                         @endif
                                 
                                         <td><a href="{{url('/')}}/booking/{{$d->id}}" type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light">Get Ticket</a></td>

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
 