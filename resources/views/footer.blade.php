             
                
                <style>
                    /* Google Font CDN Link */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
#contactus {
  min-height: 100vh;
  width: 100%;
  background: #c8e8e9;
  display: flex;
  align-items: center;
  justify-content: center;
}
.container {
  max-width: 1100px;
  width: 100%;
  background: #fff;
  border-radius: 6px;
  padding: 20px 60px 30px 40px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}
.container .content {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.container .content .left-side {
  width: 25%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 15px;
  position: relative;
}
.content .left-side::before {
  content: "";
  position: absolute;
  height: 70%;
  width: 2px;
  right: -15px;
  top: 50%;
  transform: translateY(-50%);
  background: #afafb6;
}
.content .left-side .details {
  margin: 14px;
  text-align: center;
}
.content .left-side .details i {
  font-size: 30px;
  color: #3e2093;
  margin-bottom: 10px;
}
.content .left-side .details .topic {
  font-size: 18px;
  font-weight: 500;
}
.content .left-side .details .text-one,
.content .left-side .details .text-two {
  font-size: 14px;
  color: #afafb6;
}

.container .content .right-side {
  width: 75%;
  margin-left: 75px;
}
.content .right-side .topic-text {
  font-size: 23px;
  font-weight: 600;
  color: #3e2093;
}
.right-side .input-box {
  height: 55px;
  width: 100%;
  margin: 12px 0;
}
.right-side .input-box input,
.right-side .input-box textarea {
  height: 100%;
  width: 100%;
  border: none;
  outline: none;
  font-size: 16px;
  background: #f0f1f8;
  border-radius: 6px;
  padding: 0 15px;
  resize: none;
}
.right-side .message-box {
  min-height: 110px;
}
.right-side .input-box textarea {
  padding-top: 6px;
}
.right-side .button {
  display: inline-block;
  margin-top: 12px;
}
.right-side #submit{
  color: #fff;
  font-size: 18px;
  outline: none;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  background: #3e2093;
  cursor: pointer;
  transition: all 0.3s ease;
}
#submit:hover {
  background: #5029bc;
}

@media (max-width: 950px) {
  .container {
    width: 90%;
    padding: 30px 40px 40px 35px;
  }
  .container .content .right-side {
    width: 75%;
    margin-left: 55px;
  }
}
@media (max-width: 820px) {
  .container {
    margin: 40px 0;
    height: 100%;
  }
  .container .content {
    flex-direction: column-reverse;
  }
  .container .content .left-side {
    width: 100%;
    flex-direction: row;
    margin-top: 40px;
    justify-content: center;
    flex-wrap: wrap;
  }
  .container .content .left-side::before {
    display: none;
  }
  .container .content .right-side {
    width: 100%;
    margin-left: 0;
  }
}

/* /// */

                </style>
                <footer class="footer">
                    @if (@$home == "home")
                    <div class="container" id="contact_us">
                        <div class="content">
                          <div class="left-side">
                            <div class="address details">
                              <i class="fas fa-map-marker-alt"></i>
                              <div class="topic">Address</div>
                              <div class="text-one">Patia</div>
                              <div class="text-two">Bhubaneswar 24</div>
                            </div>
                            <div class="phone details">
                              <i class="fas fa-phone-alt"></i>
                              <div class="topic">Phone</div>
                              <div class="text-one">9658826406</div>
                              <div class="text-two">9937379010</div>
                            </div>
                            <div class="email details">
                              <i class="fas fa-envelope"></i>
                              <div class="topic">Email</div>
                              <div class="text-one">evento@gmail.com</div>
                              <div class="text-two">info.evento@gmail.com</div>
                            </div>
                          </div>
                          <div class="right-side">
                            <div class="topic-text">Get in Touch</div>
                            <p>If you have any work from me or any types of quries related to my tutorial, you can send me message from here. It's my pleasure to help you.</p>
                            <form action="{{url('/')}}/home" method="POST">
                              @csrf
                              <div class="input-box">
                                <input type="text" placeholder="Enter your name" name="name" id="name" />
                              </div>
                              <div class="input-box">
                                <input type="text" placeholder="Enter your email" name="email" id="email" />
                              </div>
                              <div class="input-box message-box">
                                <textarea placeholder="Enter your message" name="feedback" id="feedback"></textarea>
                              </div>
                              <div class="button">
                                <button id="submit" type="submit">Send Now</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="container-fluid" style="height: 80px;padding-top:40px ">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Evento.
                            </div>
                            <div class="col-sm-6">
                                
                            </div>
                        </div>
                    </div>
                    @else
                    
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <script>document.write(new Date().getFullYear())</script> © Evento.
                                </div>
                                <div class="col-sm-6">
                                    
                                </div>
                            </div>
                        </div>
                    
                    
                @endif
                </footer>
            </div>
            <!-- end main content-->
