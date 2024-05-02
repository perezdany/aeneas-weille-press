@php
    //dd(session()->user()->full_name);
    //use Illuminate\Support\Facades\Auth;
   // dd(Auth::user());
 
    use App\Http\Controllers\UserController;
    use App\Models\Customer;
@endphp

@extends('layouts/base_user')


@section('profile_name')
  {{auth()->user()->first_lastname}}
@endsection

@section('profile_email')
  {{auth()->user()->email_user}}
@endsection

@section('content')
    <div class="content-wrapper">
      <div class="row">
        <div class="col-sm-12">
          <div class="home-tab">
            <div class="tab-content tab-content-basic">
              <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">

                <!--affichage des messages de success ou d'erreur-->
                    @if(session('edit_success'))
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

                    @if(session('success'))
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="col-md-3"></div>
                            <div class="card card-body ">
                                <div class="bg-success">Success</br></div>

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
                              <h4 class="card-title">@lang('titles.form.EDIT A USER')</h4>
                                @php
                                  //dd($id);
                                  $get = (new UserController())->SelectAccountCustomerById($id);
                                  //dd($get);
                                @endphp
                              
                                @foreach($get as $user)
                                
                                  <form class="forms-sample" action="edit_customer_user" method="post">
                                    @csrf
                                    <input type="text" class="form-control" name="id" value="{{$user->id}}" style="display:none;" onkeyup="this.value=this.value.toUpperCase()">
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">@lang('titles.form.full_name_label')</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Full name" value="{{$user->first_lastname}}" name="fullname" onkeyup="this.value=this.value.toUpperCase();">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">@lang('titles.form.Email_label')</label>
                                       <div class="col-sm-9">
                                      <input type="email" class="form-control" placeholder="email" name="email" value="{{$user->email_user}}">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">@lang('titles.form.member_label')</label>
                                       <div class="col-sm-9">
                                      <select  class="form-control form-control-lg" name="customer" >
                                        <option value="{{$user->id_customer}}">{{$user->name}}</option>
                                          @php
                                            //on récupère les clients de la base
                                            $society = Customer::all();
                              
                                          @endphp
                                          
                                          @foreach($society as $society)
                                              
                                            <option value="{{$society->id_customer}}">{{$society->name}}</option>  
                                             
                                          @endforeach
                                      </select>
                                      </div>
                                    </div>
                      
                                  
                                    <button type="submit" class="btn btn-primary me-2">@lang('actions.Submit')</button>
                                    <button class="btn btn-light" type="rest">@lang('actions.Cancel')</button>
                                  </form>
                                  <form class="forms-sample" action="edit_customer_user_password" method="post">
                                    @csrf
                                    <input type="text" class="form-control" name="id" value="{{$user->id}}" style="display:none;" onkeyup="this.value=this.value.toUpperCase()">
                                   
                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">@lang('titles.form.password_label')</label>
                                      <div class="col-sm-9">
                                      <input type="password" class="form-control" placeholder="type the password"name="pass">
                                      </div>
                                    </div>
                                    
                                 
                                    <button type="submit" class="btn btn-primary me-2">@lang('actions.Submit')</button>
                                    <button class="btn btn-light" type="rest">@lang('actions.Cancel')</button>
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
       

