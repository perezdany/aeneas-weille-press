@extends('layouts/base_login')

@section('content')
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="images/aeneas_lg circ_fond_noir.png" alt="logo">
              </div>
             
              
              <h6 class="fw-light">@lang('titles.form.reset_pass_title').</h6>
              <!-- MESSAGE -->
              @if(session('success'))
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="col-md-3"></div>
                        <div class="card card-body ">
                            <div class=""><a href="/">Login</a></br></div>

                          </div>
                        <div class="col-md-3"></div>
                      </div>
                    
                    </div>  
                    
                     
                    @endif

                  @if(session('error'))
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="col-md-3"></div>
                        <div class="card ">
                          <div class="bg-danger">@lang('messages.error_login')</br></div>

                          </div>
                        <div class="col-md-3"></div>
                      </div>
                    
                    </div>  
                    
                    
                  @endif 
                   
              <form class="pt-3" method="post" action="">
                @csrf
                <input type="text" name="id" value="{{$id}}" style="display:none;">
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" placeholder="@lang('titles.form.password_label')" name="pass" id="pwd1" required>
                </div>

                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" placeholder="@lang('titles.form.password_confirm_label')" name="confirm_pass" id="pwd2" onkeyup="verifyPassword();" required>
                </div>
                <div class="form-group" id="match">
                 
                </div>
                <script type="text/javascript">

                  /*UN SCRIPT QUI VA VERFIER SI LES DEUX PASSWORDS MATCHENT*/
                  function verifyPassword()
                  {
                    var msg; 
                    var str = document.getElementById("pwd1").value; 
                    /*if (str.match( /[0-9]/g) && 
                        str.match( /[A-Z]/g) && 
                        str.match(/[a-z]/g) && 
                        str.match( /[^a-zA-Z\d]/g) &&
                        str.length >= 10) 
                      msg = "<p style='color:green'>Mot de passe fort.</p>"; 
                    else 
                      msg = "<p style='color:red'>Mot de passe faible.</p>"; 
                    document.getElementById("msg").innerHTML= msg; */
                    //var _ = require('underscore');
                    var text1 = document.getElementById('pwd1').value;
                    var text2 = document.getElementById('pwd2').value;


                    if((text1 == text2))
                    {
                      var theText = "<p style='color:green'>Correspond.</p>"; ;
                      document.getElementById("match").innerHTML= theText; 
                    }
                    else
                    {
                      var theText = "<p style='color:red'>Ne correspond pas.</p>";
                      document.getElementById("match").innerHTML= theText; 
                    }
                  }

                </script>
                <div class="mt-3">
                  <button class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" type="submit">@lang('actions.Submit')</button>
                </div>
                <!--ON DOIT FAIRE UN CODE SE SOUVENIR DE MOI APRES-->
                <!--<div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>-->
                  <!--<a href="email_forget" class="auth-link text-black">Forgot password?</a>-->
                </div>
                <div class="text-center mt-4 fw-light">
                  <!--Don't have an account? <a href="#" class="text-primary">Create</a>-->
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
@endsection
