@extends('layout')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-20">Manage Bookings</h4>

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
                                    <th>Name</th>
                                    <th>age</th>
                                    <th>ID proof</th>
                                    <th>Id proof number</th>
                                    <th>Event name</th>
                                    <th>Ticket type</th>
                                    <th>Payment Id</th>
                                  
                                    <th>Payment status</th>
                                    
                                </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $i=1;
                                        $today = now();
                                    @endphp
                                    @foreach ($bookings as $d)
                                    <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$d->customer_name}}</td>
                                    <td>{{$d->age}}</td>
                                    <td>{{$d->id_proof_type}}</td>
                                    <td>{{$d->id_proof_no}}</td>
                                    <td>{{$d->event_name}}</td>
                                    <td>{{$d->ticket_type}}</td>
                                    <td>{{$d->payment_id}}</td>
                                    
                                 
                                        @if($d->is_paid == 1)
                                            <td><span class="badge rounded-pill bg-success">PAID</span>
                                            </td>
                                            @else
                                            <td><span class="badge rounded-pill bg-info">incompleted</span>
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
