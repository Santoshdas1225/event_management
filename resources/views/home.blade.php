@extends('layout')

@section('content')

<style>
    .img-div {
        position: absolute; 
        top: 0; 
        left: 0; 
        right: 0; 
        bottom: 0; 
        background: rgba(0, 0, 0, 0.5); 
        color: white; 
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        align-items: start;
        padding-left: 40px;
    }

    /* Card hover effect */
    #events .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    #events .card:hover {
        transform: translateY(-10px); /* Slight lift on hover */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3); /* Shadow on hover */
    }

   

.rows {
  display: flex;
  flex-wrap: wrap;
}
.columns {
  width: 100%;
  padding: 0 1em 1em 1em;
  text-align: center;
}
.cards {
  width: 100%;
  height: 100%;
  padding: 2em 1.5em;
  background: linear-gradient(#ffffff 50%, #2c7bfe 50%);
  background-size: 100% 200%;
  background-position: 0 2.5%;
  border-radius: 5px;
  box-shadow: 0 0 35px rgba(0, 0, 0, 0.12);
  cursor: pointer;
  transition: 0.5s;
}
h3 {
  font-size: 20px;
  font-weight: 600;
  color: #1f194c;
  margin: 1em 0;
}
p {
  color: #575a7b;
  font-size: 15px;
  line-height: 1.6;
  letter-spacing: 0.03em;
}
.icon-wrappers {
  background-color: #2c7bfe;
  position: relative;
  margin: auto;
  font-size: 30px;
  height: 2.5em;
  width: 2.5em;
  color: #ffffff;
  border-radius: 50%;
  display: grid;
  place-items: center;
  transition: 0.5s;
}
.cards:hover {
  background-position: 0 100%;
}
.cards:hover .icon-wrapper {
  background-color: #ffffff;
  color: #2c7bfe;
}
.cards:hover h3 {
  color: #ffffff;
}
.cards:hover p {
  color: #f0f0f0;
}
@media screen and (min-width: 768px) {
  section {
    padding: 0 2em;
  }
  .columns {
    flex: 0 50%;
    max-width: 50%;
  }
}
@media screen and (min-width: 992px) {
  section {
    padding: 1em 3em;
  }
  .columns {
    flex: 0 0 33.33%;
    max-width: 33.33%;
  }
}

#feedback-form-wrapper #floating-icon > button {
  position: fixed;
  right: 0;
  top: 50%;
  transform: rotate(-90deg) translate(50%, -50%);
  transform-origin: right;
}

#feedback-form-wrapper .rating-input-wrapper input[type="radio"] {
  display: none;
}
#feedback-form-wrapper .rating-input-wrapper input[type="radio"] ~ span {
  cursor: pointer;
}
#feedback-form-wrapper .rating-input-wrapper input[type="radio"]:checked ~ span {
  background-color: #4261dc;
  color: #fff;
}
#feedback-form-wrapper .rating-labels > label{
  font-size: 14px;
    color: #777;
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
                  @if (session('pdf'))
                  <script type="text/javascript">
                    window.onload = function() {
                    var link = document.createElement('a');
                    link.href = "{{ url('pdfs/' . session('pdf')) }}";
                    console.log(link.href);
                    link.download = "{{ session('pdf') }}";
                    link.click();
                    };
                  </script>
                  @endif

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                  @foreach ($events as $e)
                  <div class="card mySlides" style="position: relative; text-align: center;display: none;">
                    <img src="{{asset($e->photo)}}" alt="Business Conference" style="height: 700px; width: 100%; object-fit: cover;">
                    <!-- Overlay with text -->
                    <div class="img-div">
                      <h1 style="font-size: 70px; font-weight: bold; color: #ff6600; font-style: italic">{{ $e->event_name }}</h1>

                      <p style="font-size: 24px;color: white">{{ (new \DateTime($e->date))->format('d F Y') }}</p>

                         
                        <!-- Button -->
                        <a href="{{url('/')}}/booking/{{$e->id}}" class="btn btn-primary btn-rounded waves-effect waves-light" style="padding: 10px 30px; font-size: 18px; margin-top: 20px;">Get Ticket Now</a>
                    </div>
                </div>
                  @endforeach
                    
                </div>
            </div>

            <div class="row" style="display: flex;justify-content: center" id="about">
              <div class="col-xl-4" style="margin-left: 100px;margin-top: 50px;margin-bottom: 50px;">
              <h1 style="font-size: 56px">about</h1>
              <div class="col-xl-12" style="background-image: url('{{url('/')}}/aboutus-bg.jpg'); background-size: cover; background-position: center;padding-left: 0px; padding-right: 0px;">
                <img src="{{url('/')}}/us-transparent.png" alt="Business Conference" style="height:auto; width: 100%; object-fit: cover;">
              </div>
            </div>
              <div class="col-xl-6" style="margin-top: 80px;margin-left: 50px;">
                <p style="color: black">Wizcraft Entertainment Agency Pvt. Ltd. is a global experiential marketing company, delivering impact driven brand experiences. With a legacy of over three decades, we integrate strategy, creativity and technology to deliver solutions that inspire.</p>
                <p style="color: black">Headquartered in Mumbai, Wizcraft has offices in Delhi, Bangalore, Hyderabad and Chennai, with international liaison offices and a global partner network. Our brand portfolio spans a wide range of industries and geographies, with 600+ global brands investing their trust in us.</p>
                <p style="color: black">Wizcraft has emerged as a pioneer in the space of In-Person and Virtual Events, Exhibitions, Brand Activation, Advertising, Television Production, Live Entertainment, Corporate Communication, Digital Marketing as well as Lead Generation. From historic concerts like Michael Jackson's India tour in 1996, to the BMW Experience Tour; from Tata Motors and Toyota at Auto Expo, to TVCs and influencer activations for Hyundai. In today's virtual age, we continue to set industry benchmarks with exclusive virtual media launce.</p>
              </div>
            </div>
        </div>  
        <div class="container-fluid">
            <br>
            <center><h1>Recent Events</h1></center>
            <div class="row" style="margin-top: 30px;" id="events">
              @foreach ($events as $e)
              <div class="col-lg-4">
                <div class="card" style="border-radius: 30px;">
                    <img class="card-img-top img-fluid" src="{{$e->photo}}" alt="Card image cap" style="border-top-left-radius: 30px;border-top-right-radius: 30px;height: 300px">
                    <div class="card-body">
                      <div style="display: flex;justify-content: space-between;align-items: baseline">
                        <div style="max-width: 300px;">
                          <h4 class="card-title" style="font-size: 18px;">{{$e->event_name}}</h4>
                        </div>
                     
                        <span class="badge rounded-pill bg-success" style="font-size: 12px">available</span>
                      </div>
                        <p class="card-text">
                          <span class="short-description">{{ Str::limit($e->description, 100) }}</span>
                          <span class="full-description" style="display:none;">{{ $e->description }}</span>
                          <button class="btn btn-link read-more-btn">Read More</button> 
                      </p>
                          
                      <div style="display: flex;justify-content: space-between;align-items: baseline">
                        <p class="card-text">
                          <small class="text-muted" style="font-size: 16px">{{ (new \DateTime($e->date))->format('d F Y') }}</small>
                      </p>
                      <a href="{{url('/')}}/booking/{{$e->id}}" class="btn btn-outline-primary waves-effect waves-light">Get Ticket</a>
                      </div>
                      
                    </div>
                </div>
              </div><!-- end col -->
              @endforeach
            
              {{-- <div class="col-lg-4">
                <div class="card" style="border-radius: 30px">
                    <img class="card-img-top img-fluid" src="assets/images/small/img-5.jpg" alt="Card image cap" style="border-top-left-radius: 30px;border-top-right-radius: 30px;height: 250px">
                    <div class="card-body">
                        <h4 class="card-title">Card title</h4>
                        <p class="card-text">This is a wider card with supporting text below as a
                            natural lead-in to additional content. This content is a little bit
                            longer.</p>
                            
                        <p class="card-text">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </p>
                    </div>
                </div>
            </div><!-- end col --> --}}
                
            
            
                
                
            </div>
            <div class="d-flex justify-content-end" >
                <a href="{{url('/')}}/allevents" type="button" class="btn btn-primary btn-rounded w-lg waves-effect waves-light">View all</a>
            </div>
        </div>  


        <section>
            <div class="rows" style="justify-content: center;margin-bottom: 20px">
              <h1 class="section-headings">Our Services</h1>
            </div>
            <div class="rows">
              <div class="columns">
                <div class="cards">
                  <div class="icon-wrappers">
                    <i class="fa-solid fa-calendar-days"></i>
                  </div>
                  <h3>Corporate Events</h3>
                  <p>
                    Crafting innovative, engaging and value-driven experiences, that are designed around your employees, partners and customers.
                  </p>
                </div>
              </div>
              <div class="columns">
                <div class="cards">
                  <div class="icon-wrappers">
                    <i class="fa-solid fa-calendar-days"></i>
                  </div>
                  <h3>Milestone Celebrations</h3>
                  <p>
                    You have a company that relies on a lot of moving parts to move forward, the most important being your employees.
                  </p>
                </div>
              </div>
              <div class="columns">
                <div class="cards">
                  <div class="icon-wrappers">
                    <i class="fa-solid fa-calendar-days"></i>
                  </div>
                  <h3>Brand Communication & Advertising
                  </h3>
                  <p>
                    Curating and producing engaging brand solutions, that help you reach your target audience in innovative and impactful ways.
                  </p>
                </div>
              </div>
              <div class="columns">
                <div class="cards">
                  <div class="icon-wrappers">
                    <i class="fa-solid fa-calendar-days"></i>
                  </div>
                  <h3>Performance Marketing</h3>
                  <p>
                    Our digital and data-derived customer centric solutions help you reach your audience and enhance ROI. So you can focus on scaling your business, while we focus on achieving results.
                  </p>
                </div>
              </div>
              <div class="columns">
                <div class="cards">
                  <div class="icon-wrappers">
                    <i class="fa-solid fa-calendar-days"></i>
                  </div>
                  <h3>Mice</h3>
                  <p>
                    Providing end-to-end travel, hospitality and event services for corporate employees, partners and customers.
                  </p>
                </div>
              </div>
              <div class="columns">
                <div class="cards">
                  <div class="icon-wrappers">
                    <i class="fa-solid fa-calendar-days"></i>
                  </div>
                  <h3>Virtual & Hybrid Events</h3>
                  <p>
                    Giving brands that competitive edge, through strategic, data driven and customer centric virtual experience solutions.

                  </p>
                </div>
              </div>
              
            </div>
          </section>
 
        <div class="container-fluid">
            <br>
            <center><h2>Upcoming events</h2></center>
            <div class="row" style="margin-top: 30px;" id="events">
              @foreach ($upcomingEvents as $e)
              <div class="col-lg-4">
                <div class="card" style="border-radius: 30px;">
                    <img class="card-img-top img-fluid" src="{{$e->photo}}" alt="Card image cap" style="border-top-left-radius: 30px;border-top-right-radius: 30px;height: 300px">
                    <div class="card-body">
                      <div style="display: flex;justify-content: space-between;align-items: baseline">
                        <h4 class="card-title" style="font-size: 18px">{{$e->event_name}}</h4>
                        <span class="badge rounded-pill bg-success" style="font-size: 12px">available</span>
                      </div>
                        <p class="card-text">
                          <span class="short-description">{{ Str::limit($e->description, 100) }}</span>
                          <span class="full-description" style="display:none;">{{ $e->description }}</span>
                          <button class="btn btn-link read-more-btn">Read More</button> 
                      </p>
                          
                      <div style="display: flex;justify-content: space-between;align-items: baseline">
                        <p class="card-text">
                          <small class="text-muted" style="font-size: 16px">{{ (new \DateTime($e->date))->format('d F Y') }}</small>
                      </p>
                      <a href="{{url('/')}}/booking/{{$e->id}}" class="btn btn-outline-primary waves-effect waves-light">Get Ticket</a>
                      </div>
                      
                    </div>
                </div>
            </div><!-- end col -->
              @endforeach
            
                
            
            </div>
            <div class="d-flex justify-content-end" >
                <a href="{{url('/')}}/allevents" type="button" class="btn btn-primary btn-rounded w-lg waves-effect waves-light">View all</a>
            </div>
            <br>
            <div id="feedback-form-wrapper">
              
              <div class="card-body">
                <!-- Scrollable modal button -->
                <div id="floating-icon">
                  <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Feedback</button>
                
                </div>
               

                <!-- Scrollable modal -->
                <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">Feedback</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="col-lg-12 mt-4 mt-lg-0">
                                <div class="mt-4 mt-lg-0"> 
                                    <form action="{{url('/')}}/home" method="POST">
                                      @csrf
                                        <div class="row mb-4">
                                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                              <input type="text" class="form-control" name="name" id="name">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="feedback" class="col-sm-3 col-form-label">Feedback</label>
                                            <div class="col-sm-9">
                                              <textarea type="text" class="form-control" name="feedback" id="feedback"></textarea>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                                <div style="display: flex; justify-content: end">
                                                    <button type="submit" class="btn btn-soft-primary waves-effect waves-light btn-rounded">Submit</button>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div><!-- end card body -->
            </div>




            
        <div class="modal fade" id="mobileNumberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter Your Mobile Number</h5>
              </div>
              <div class="modal-body">
                <form id="mobileNumberForm">
                  <div class="form-group">
                    <label for="mobile-number">Mobile Number:</label>
                    <input type="text" class="form-control" id="mobile-number" required>
                <span class="error" style="color: red" id="mobileNumberError"></span>
                  </div>
                  <div class="form-group">
                      <label for="whatsapp-number">WhatsApp Number:</label>
                      <input type="text" class="form-control" id="whatsapp-number" required>
                      <span class="error" style="color: red" id="whatsappNumberError"></span>
                  </div>
                  <div class="form-check">
                      <input type="hidden" name="samenumber" value="0">
                      <input type="checkbox" class="form-check-input" id="samenumber" name="samenumber" value="1">
                      <label class="form-check-label" for="samenumber">Same as Contact No.</label>
                  </div>
                  <div class="d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary" style="margin-top: 10px">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
      

        </div> 
    </div>
</div>

<script>
  var slideIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > x.length) {slideIndex = 1}
  x[slideIndex-1].style.display = "block";
  setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>
<script>
  $(document).ready(function() {
    $('.read-more-btn').click(function() {
        var $this = $(this);
        var $cardBody = $this.closest('.card-body');
        var $shortDescription = $cardBody.find('.short-description');
        var $fullDescription = $cardBody.find('.full-description');
        
        if ($fullDescription.is(':visible')) {
            // If full description is visible, hide it and show the short one
            $fullDescription.hide();
            $shortDescription.show();
            $this.text('Read More');
        } else {
            // If short description is visible, hide it and show the full one
            $shortDescription.hide();
            $fullDescription.show();
            $this.text('Read Less');
        }
    });
});

</script>

<script>
  $(document).ready(function() {
      var modal = new bootstrap.Modal(document.getElementById('mobileNumberModal'));

      // Function to check if session has email
      function checkSessionEmail() {
          $.ajax({
              url: '{{url('/')}}/check-session-email', // Create a route to check if the session has an email
              type: 'GET',
              success: function(response) {
                  if (response.hasEmail) {
                      // If session has email, proceed to check customer status
                      isNewCustomer();
                  }
              },
              error: function() {
                  console.error('Failed to check session email.');
              }
          });
      }

      // Function to check if the user is a new customer
      function isNewCustomer() {
          $.ajax({
              url: '{{url('/')}}/check-customer',
              type: 'GET',
              success: function(response) {
                  if (response.isNewCustomer) {
                      modal.show();
                  }
              },
              error: function() {
                  console.error('Failed to check customer status.');
              }
          });
      }

      // Call to check if the session has an email
      checkSessionEmail();

      function validateInput(input, errorElementId) {
          let value = input.val();
          value = value.replace(/\D/g, ''); // Allow only digits
          if (value.length > 10) {
              value = value.slice(0, 10); // Limit to 10 digits
          }
          input.val(value);
          if (value.length !== 10) {
              $('#' + errorElementId).text('Number must be 10 digits.');
              return false;
          } else {
              $('#' + errorElementId).text('');
              return true;
          }
      }

      function updateWhatsAppNumber() {
          if ($('#samenumber').is(':checked')) {
              var mobileNumber = $('#mobile-number').val();
              $('#whatsapp-number').val(mobileNumber).prop('readonly', true);
          }
      }

      $('#mobile-number, #whatsapp-number').on('input', function () {
          validateInput($(this), $(this).attr('id') + 'Error');
          if ($('#samenumber').is(':checked') && $(this).attr('id') === 'mobile-number') {
              updateWhatsAppNumber();
          }
      });

      $('#samenumber').change(function() {
          if ($(this).is(':checked')) {
              var mobileNumber = $('#mobile-number').val();
              $('#whatsapp-number').val(mobileNumber).prop('readonly', true);
          } else {
              $('#whatsapp-number').val('').prop('readonly', false);
          }
      });

      $('#mobileNumberForm').on('submit', function(event) {
          event.preventDefault();

          var isMobileValid = validateInput($('#mobile-number'), 'mobileNumberError');
          var isWhatsAppValid = validateInput($('#whatsapp-number'), 'whatsappNumberError');

          if (isMobileValid && isWhatsAppValid) {
              var mobileNumber = $('#mobile-number').val();
              var whatsappNumber = $('#whatsapp-number').val();
              var samenumber = $('#samenumber').is(':checked') ? 1 : 0;

              $.ajax({
                  url: '{{url('/')}}/submit-mobile-number',
                  type: 'POST',
                  data: {
                      mobile_number: mobileNumber,
                      whatsapp_number: whatsappNumber,
                      samenumber: samenumber,
                      _token: '{{ csrf_token() }}'
                  },
                  success: function(response) {
                      if (response.success) {
                          $('#mobileNumberModal').data('submitted', true);
                          modal.hide();
                          alertify.success(response.message);
                      } else {
                          alertify.error('Failed to save mobile number.');
                      }
                  },
                  error: function() {
                      alertify.error('An error occurred.');
                  }
              });
          }
      });

      $('#mobileNumberModal').on('hide.bs.modal', function (e) {
          if (!$(this).data('submitted')) {
              e.preventDefault(); // Prevent closing the modal if the form isn't submitted
          }
      });

      function initializeForm() {
          if ($('#samenumber').is(':checked')) {
              var mobileNumber = $('#mobile-number').val();
              $('#whatsapp-number').val(mobileNumber).prop('readonly', true);
          } else {
              $('#whatsapp-number').prop('readonly', false);
          }
      }

      initializeForm();
  });
</script>

@endsection
