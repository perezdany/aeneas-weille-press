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
              <h4>@lang('messages.login_first_word_user')</h4>
              
              <h6 class="fw-light">@lang('messages.Sign_in').</h6>
              <!-- MESSAGE -->
              @if(session('success'))
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="col-md-3"></div>
                        <div class="card card-body ">
                            <div class="bg-success">@lang('messages.edit_success')</br></div>

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
                   
              <form class="pt-3" method="post" action="customer_login">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" placeholder="login" name="login" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" placeholder="@lang('titles.form.password_label')" name="password" required>
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" type="submit">@lang('actions.SIGN IN')</button>
                </div>
                <!--ON DOIT FAIRE UN CODE SE SOUVENIR DE MOI APRES-->
                <!--<div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>-->
                  <a href="#" class="auth-link text-black">Forgot password?(A faire)</a>
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
