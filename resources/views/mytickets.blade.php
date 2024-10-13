@extends('layout')

@section('content')



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
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-20">My Tickets</h4>

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
                                    <th>Payment Id</th>
                                    <th>Event Name</th>
                                    <th>Total person</th>
                                    <th>Total Amount</th>
                                    <th>Payment Status</th>
                                    <th>Status</th>
                                
                                   
                      
                                    
                                </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $i=1;
                                        $today = now();
                                    @endphp
                                    @foreach ($tickets as $d)
                                    <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{Session::get('name')}}</td>
                                    <td>{{$d->payment_id}}</td>
                                    <td>{{$d->event_name}}</td>
                                    <td>{{$d->person}}</td>
                                    <td>{{$d->total_amount}}</td>
                                    @if ($d->is_paid == 1)
                                        <td>PAID</td>
                                    @else
                                    <td>UNPAID</td>
                                    @endif
                        
                                 
                                        @if($d->is_paid == 1)
                                            <td><span class="badge rounded-pill bg-success">accepted</span>
                                            </td>
                                            @else
                                            <td><span class="badge rounded-pill bg-info">incompleted</span>
                                            </td>
                                         @endif
                                         
                                        @if($d->is_paid == 1)
                                        <td style="border: none">
                                      
                                            <button type="button" class="btn btn-outline-secondary btn-sm edit" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable" data-event-id="{{ $d->event_id }}" data-event-name="{{ $d->event_name }}">Feedback</button>
                                            <a href="{{url('/')}}/download-ticket/{{$d->payment_id}}" type="button" class="btn btn-outline-secondary btn-sm edit">Download</a>
                                        </td>
                                        @else
                                        <td style="border: none">
                                        </td>
                                     @endif
                                           
                                            @if ($d->is_paid !=1)
                                            <td style="border: none">
                                            <a class="btn btn-outline-secondary btn-sm edit" href="{{url('/')}}/booking/{{$d->event_id}}" title="proceed" >
                                                proceed
                                                </a>
                                                <a class="btn btn-outline-secondary btn-sm edit delete-btn" href="delete/{{$d->id}}" title="Delete">
                                                    <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                                                </a>
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
            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content"  style="width: 550px">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="col-lg-12 mt-4 mt-lg-0">
                            <div class="mt-4 mt-lg-0"> 
                                <section class="col-md-8">
                                    <div class="row">
                                    <h3 class="font-time text-primary text-center mb-3"><span id="event-name-display"></span> 
                                      FEEDBACK SURVEY</h3>
                                    <h4 class="font-time text-center">Please take few moments to complete this survey</h4>
                                    <hr class="text-dark">
                             
                                    <form action="{{url('/')}}/eventfeedback" method="POST">
                                        @csrf
                                        <input type="hidden" id="event-id" name="event_id">
                                        <input type="hidden" id="event-name" name="event_name">

                                      <div class="form-group">
                                        <label class="font-weight-bold">Have you participated in any event in EVENTO before?</label>
                                        <br />
                                        <input type="radio" name="attendBefore" value="yes">
                                        <label>Yes</label> <br />
                                        <input type="radio" name="attendBefore" value="no">
                                        <label>No</label>
                                      </div>
                             
                                      <div class="form-group">
                                        <label class="font-weight-bold">How likely are you to attend one of our events in the
                                          future?</label>
                                        <br />
                                        <input type="radio" name="likelyAttend" value="1">
                                        <label class="mr-5">1</label>
                                        <input type="radio" name="likelyAttend" value="2">
                                        <label class="mr-5">2</label>
                                        <input type="radio" name="likelyAttend" value="3">
                                        <label class="mr-5">3</label>
                                        <input type="radio" name="likelyAttend" value="4">
                                        <label class="mr-5">4</label>
                                        <input type="radio" name="likelyAttend" value="5">
                                        <label class="mr-5">5</label>
                                      </div>
                             
                                      <div class="form-group">
                                        <label class="font-weight-bold">How likely are you to recommend our events to a friend?</label>
                                        <br />
                                        <input type="radio" name="likelyRecommendFriend" value="1">
                                        <label class="mr-5">1</label>
                                        <input type="radio" name="likelyRecommendFriend" value="2">
                                        <label class="mr-5">2</label>
                                        <input type="radio" name="likelyRecommendFriend" value="3">
                                        <label class="mr-5">3</label>
                                        <input type="radio" name="likelyRecommendFriend" value="4">
                                        <label class="mr-5">4</label>
                                        <input type="radio" name="likelyRecommendFriend" value="5">
                                        <label class="mr-5">5</label>
                                      </div>
                             
                                      <div class="form-group">
                                        <label class="font-weight-bold">What did you like most about the event?</label>
                                        <textarea name="likeMost" cols="30" rows="3" class="form-control"></textarea>
                                      </div>
                             
                                      <div class="form-group">
                                        <label class="font-weight-bold">What did you like least about the event?</label>
                                        <textarea name="likeLeast" cols="30" rows="3" class="form-control"></textarea>
                                      </div>
                             
                                      <label class="font-weight-bold">Overall Satisfaction</label>
                             
                                      <table class="table table-bordered mb-0">
                                        <thead class="text-center">
                                          <tr>
                                            <th>Parameter</th>
                                            <th>Very Satisfied</th>
                                            <th>Satisfied</th>
                                            <th>Neutral</th>
                                            <th>Unsatisfied</th>
                                            
                                          </tr>
                                        </thead>
                             
                                        <tbody class="text-center">
                                          <tr>
                                            <td>Overall Satisfaction</td>
                                            <td><input type="radio" name="overall" value="Very Satisfied"></td>
                                            <td><input type="radio" name="overall" value="Satisfied"></td>
                                            <td><input type="radio" name="overall" value="Neutral"></td>
                                            <td><input type="radio" name="overall" value="Unsatisfied"></td>
                                            
                                          </tr>
                             
                                          <tr>
                                            <td>Location</td>
                                            <td><input type="radio" name="location" value="Very Satisfied"></td>
                                            <td><input type="radio" name="location" value="Satisfied"></td>
                                            <td><input type="radio" name="location" value="Neutral"></td>
                                            <td><input type="radio" name="location" value="Unsatisfied"></td>
                                        
                                          </tr>
                             
                                          <tr>
                                            <td>Events</td>
                                            <td><input type="radio" name="events" value="Very Satisfied"></td>
                                            <td><input type="radio" name="events" value="Satisfied"></td>
                                            <td><input type="radio" name="events" value="Neutral"></td>
                                            <td><input type="radio" name="events" value="Unsatisfied"></td>
                                          
                                          </tr>
                             
                                          <tr>
                                            <td>Events Coordinators</td>
                                            <td><input type="radio" name="coordinators" value="Very Satisfied"></td>
                                            <td><input type="radio" name="coordinators" value="Satisfied"></td>
                                            <td><input type="radio" name="coordinators" value="Neutral"></td>
                                            <td><input type="radio" name="coordinators" value="Unsatisfied"></td>
                                         
                                          </tr>
                             
                                          <tr>
                                            <td>Event Price</td>
                                            <td><input type="radio" name="eventsPrice" value="Very Satisfied"></td>
                                            <td><input type="radio" name="eventsPrice" value="Satisfied"></td>
                                            <td><input type="radio" name="eventsPrice" value="Neutral"></td>
                                            <td><input type="radio" name="eventsPrice" value="Unsatisfied"></td>
                                         
                                          </tr>
                             
                                        </tbody>
                                      </table>
                             
                                      <div class="form-group">
                                        <label class="font-weight-bold">How can we improve this event?</label>
                                        <textarea name="suggestion" cols="30" rows="3" class="form-control"></textarea>
                                      </div>
                                      <br>
                                      <div style="display: flex; justify-content: center">
                                        <button type="submit"class="btn text-center btn-primary btn-block rounded-pill">Submit</button>
                                      </div>
                                      
                                    </form>
                                </div>
                            </section>
                            </div>
                        </div>
                        </div>
                       
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Add an event listener for when the modal button is clicked
    var feedbackButtons = document.querySelectorAll('.edit[data-bs-toggle="modal"]');
    feedbackButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var eventId = button.getAttribute('data-event-id');
            var eventName = button.getAttribute('data-event-name');
            console.log(eventId);
            console.log(eventName);
            // Set the event ID and name in the modal form
            document.getElementById('event-id').value = eventId;
            document.getElementById('event-name-display').innerText = eventName;
            document.getElementById('event-name').value = eventName;
        });
    });
});

</script>
@endsection
