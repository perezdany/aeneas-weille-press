@php
  use App\Models\Customer;
  use App\Http\Controllers\UserController;
@endphp
@extends('layouts/base_app')

@section('full_name')
  {{auth()->user()->full_name}}
@endsection

@section('profile_name')
  {{auth()->user()->full_name}}
@endsection

@section('profile_email')
  {{auth()->user()->email}}
@endsection

@section('content')
    <div class="content-wrapper">
      <div class="row">
        <div class="col-sm-12">
          <div class="home-tab">
            <div class="tab-content tab-content-basic">
              <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">

                <!--affichage des messages de success ou d'erreur-->

                    @if(session('success'))
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="col-md-3"></div>
                        <div class="card card-body ">
                            <div class="bg-success">@lang('messages.unknow_error')</br></div>

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
                          <div class="bg-danger">@lang('messages.unknow_error')</br></div>

                          </div>
                        <div class="col-md-3"></div>
                      </div>
                    
                    </div>  
                    
                    
                  @endif  
                
                <!-- fin--> 
            

                <div class="row">
                  <div class="col-lg-12 d-flex flex-column">
                    <div class="row flex-grow">
                       <div class="col-md-3 grid-margin stretch-card">
                          
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">@lang('titles.form.EDIT USER ADMIN')</h4>
                                @php
                                  //dd($id);
                                  $get = (new UserController())->SelectAdminById($id);
                                  //dd($get);
                                @endphp
                                @foreach($get as $user)
                                   <form class="forms-sample" action="editadmin" method="post">
                                    @csrf
                                    <input type="text" class="form-control" placeholder="Your name" name="id" value="{{$user->id}}" style="display:none;" onkeyup="this.value=this.value.toUpperCase()">
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">@lang('titles.form.full_name_label')</label>
                                      <div class="col-sm-9">

                                        <input type="text" class="form-control" placeholder="Your name" name="full_name" value="{{$user->full_name}}" onkeyup="this.value=this.value.toUpperCase()">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">@lang('titles.form.Pseudo_label')</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Username" name="pseudo" required value="{{$user->pseudo}}">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">@lang('titles.form.Email_label')</label>
                                       <div class="col-sm-9">
                                      <input type="email" class="form-control" placeholder="email" value="{{$user->email}}" name="email" required>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">@lang('titles.form.password_label')</label>
                                      <div class="col-sm-9">
                                      <input type="password" class="form-control" placeholder="password" name="pass" id="pwd1">
                                      </div>
                                    </div>
                                   
                                    @if(auth()->user()->super == 1)
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">@lang('titles.form.type_admin')</label>
                                        <div class="col-sm-9">
                                          <select class="form-control form-control-lg" name="type">
                                              <option value="1">YES</option>
                                              <option value="0">NO</option>
                                          </select>
                                        </div>
                                      </div>
                                    @endif
                               
                                   
                                    <button type="submit" class="btn btn-primary me-2">@lang('actions.Submit')</button>
                                    <button class="btn btn-light" type="rest">@lang('actions.Cancel')</button>
                                  </form>
                                @endforeach
                             
                            </div>
                            <div class="card-body">
                              <h4 class="card-title">@lang('titles.form.EDIT PASSWORD')</h4>
                                @php
                                  //dd($id);
                                  $get = (new UserController())->SelectAdminById($id);
                                  //dd($get);
                                @endphp
                                @foreach($get as $user)
                                  <form class="forms-sample" action="adminpassword" method="post">
                                    @csrf
                                    <input type="text" class="form-control" placeholder="Your name" name="id" value="{{$user->id}}" style="display:none;" onkeyup="this.value=this.value.toUpperCase()">
                            
                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">@lang('titles.form.password_label')</label>
                                      <div class="col-sm-9">
                                      <input type="password" class="form-control" placeholder="password" name="pass" id="pwd1">
                                      </div>
                                    </div>
                                   
                                    <button type="submit" class="btn btn-primary me-2">@lang('actions.Submit')</button>
                                    
                                  </form>
                                @endforeach
                             
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 grid-margin stretch-card">
                          
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
    <!-- content-wrapper ends -->

@endsection
       

