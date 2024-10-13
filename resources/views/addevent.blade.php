@extends('layout')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
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
           <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
           
               <!-- ============================================================== -->
               <!-- Start right Content here -->
               <!-- ============================================================== -->
               <div class="main-content">
                 
                      
                           <!-- start page title -->
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
                                       <h4 class="mb-sm-0 font-size-18">Add Event</h4>
                                      
                                       
                                   </div>
                               </div>
                           </div>
                           <!-- end page title -->
           
                           <div class="row">
                               
                               <form id="customerForm" method="POST" action="{{url('/addevent')}}" enctype="multipart/form-data">
                                   @csrf
                                   <input type="hidden" name="ref" value="{{ request('ref') }}">
                                  
                                   <div class="col-12">
                                       <div class="card">
                                           <div class="card-body p-4">
                                               <div class="row">
           
                                                   
                                                   <div class="col-lg-4">
                                                       <div class="mt-3 mt-lg-0">
                                                           <div class="mb-3">
                                                               <label for="title" class="form-label">Event Title<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                               <input class="form-control" type="text" id="title" name="title" placeholder="Enter event title" required>
                                                               <div id="emailFeedback" class="invalid-feedback">
                                                                   <h6 id="feedbackMessage" style="color: red"></h6>
                                                               </div>
                                                                 @if($errors->has('iname'))
                                                                 <p style="color: red" class="error">{{ $errors->first('iname') }}</p>
                                                                 @endif
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="col-lg-4">
                                                       <div class="mb-3">
                                                           <label for="location" class="form-label">Location<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                           <input class="form-control" type="text" id="location" name="location" placeholder="Enter locaton " required>
                                                       </div>
                                                   </div>
                                                   
                                                   
                                                   <div class="col-lg-4">
                                                       <div class="mt-3 mt-lg-0">
                                                           <div class="mb-3">
                                                               <label for="eventdate" class="form-label">Date of Event<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                               <input class="form-control" type="datetime-local" id="eventdate" name="eventdate" required>
                                                           </div>
                                                       </div>
                                                   </div>
           
                                                   <div class="col-lg-4">
                                                       <div class="mt-3 mt-lg-0" style="margin-bottom: 10px">
                                                           <label class="form-label">Duration (in days)<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                           <select class="form-select" id="duration" name="duration" required>
                                                               <option value="">--Select--</option>
                                                               @for ($i = 1; $i <= 60; $i++)
                                                                   <option value="{{$i}}">{{$i}}</option>
                                                               @endfor
                                                           </select>
                                                       </div>
                                                      
                                                   </div>

                                                   <div class="col-lg-4">
                                                       <div>
                                                           <div class="mb-3">
                                                               <label for="example-text-input" class="form-label">Description</label>
                                                               <textarea class="form-control" type="text" value="" id="desc" name="desc" style="height: 150px; resize: none;"></textarea>
                                                    
                                                           </div>   
                                                       </div>
                                                   </div>
                                                   <div class="col-lg-4">
                                                    <div class="mt-3 mt-lg-0">
                                                        <label for="chooseFile" class="form-label">Upload Photo</label>
                                                        <div class="file-upload d-flex align-items-center">
                                                            <div class="file-select">
                                                                <input type="file" name="chooseFile" id="chooseFile" onchange="validatesize(this)">
                                                                <img src="" id="previewImg" style="width: ; height: 100px; display: none ; margin-top: 10px " alt="" >
                                                            </div>
            
            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body p-4">
                                                            <h5>Ticket Information</h5>
                                                            <br>
                                                            <div class="row">
                                                                
                                                                <div class="col-lg-4">
                                                                    <div class="mt-3 mt-lg-0">
                                                                        <div class="mb-3">
                                                                            <label for="tickets" class="form-label">Total Tickets<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                                            <input class="form-control" type="text" id="total_ticket" name="total_ticket" placeholder="" required>
                                                                            <div id="emailFeedback" class="invalid-feedback">
                                                                                <h6 id="feedbackMessage" style="color: red"></h6>
                                                                            </div>
                                                                              @if($errors->has('	total_tickets'))
                                                                              <p style="color: red" class="error">{{ $errors->first('total_tickets') }}</p>
                                                                              @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="mt-3 mt-lg-0">
                                                                        <div class="mb-3">
                                                                            <label for="tickets" class="form-label">No. Premium Tickets<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                                            <input class="form-control" type="text" id="premium_tickets" name="premium_tickets" placeholder="Enter premium tickets number" required>
                                                    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="mt-3 mt-lg-0">
                                                                        <div class="mb-3">
                                                                            <label for="tickets" class="form-label">No. general Tickets<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                                            <input class="form-control" type="text" id="general_tickets" name="general_tickets" placeholder="Enter general tickets number" required>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="mt-3 mt-lg-0">
                                                                        <div class="mb-3">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="mt-3 mt-lg-0">
                                                                        <div>
                                                                            <div class="mb-3">
                                                                                <label for="example-text-input" class="form-label">Premium ticket Price<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-text">₹</span>
                                                                                    <input class="form-control" type="text" value="" id="preticket" name="preticket" required>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div>
                                                                        <div class="mb-3">
                                                                            <label for="example-text-input" class="form-label">General ticket Price<i class="fa-light fa-asterisk fa-rotate-270 fa-lg" style="color: #ff0000;"></i></label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-text">₹</span>
                                                                                <input class="form-control" type="text" value="" id="genticket" name="genticket" required>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                               </div>
                                           </div>
                                       </div>
                                       <div class="d-flex justify-content-end" style="margin-right: 10px">
                                           <button type="submit" class="btn btn-primary w-md waves-effect waves-light" id="submitbtn">Add</button>
                                       </div>
                                       <br>
                                   </div> <!-- end col -->
                               </form>
                           </div>
                       </div>
                   </div>
               </div>
    </div>
    <!-- End Page-content -->  
    
    

    <script>
        function validatesize(input) {
            const fileSize = input.files[0].size / 1048576;
            var x = input.value.split(".");
            x = x[x.length - 1].toLowerCase();
            var arrayExtensions = ["jpg","png","jpeg"];
            if (arrayExtensions.lastIndexOf(x) == -1) {
                alertify.set('notifier','position', 'bottom-right');
                alertify.error('Invalid file format. Only jpg/png/jpeg format allowed', function () { console.log('dismissed'); });
                $(input).val('');
             } 
            //else if (fileSize > 2) {
            //     alertify.set('notifier','position', 'bottom-right');
            //     alertify.error('File is too large. Maximum 2MB allowed', function () { console.log('dismissed'); });
            //     $(input).val('');
            // }


            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewImg = document.getElementById('previewImg');
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }

        }

    </script>
@endsection