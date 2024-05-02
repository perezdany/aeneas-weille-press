@php
  use App\Models\Customer;
  use App\Http\Controllers\UserController;
  use App\Http\Controllers\CustomerController;
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
                        <div class="card card-body grid-margin">
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
                        <div class="card card-body grid-margin">
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
                        <div class="col-md-3 grid-margin">
                         
                        </div>
                        <div class="col-md-6">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">@lang('titles.form.EDIT A CUSTOMER')</h4>

                              @php
                                $select = (new CustomerController())->seclectById($id);
                                //dd($id);
                              @endphp
                              
                              @foreach($select as $get)
                                <form class="forms-sample" action="editcompany" method="post">
                                  @csrf

                                  <input type="text" name="id" value="{{$get->id_customer}}" style="display:none;">
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">@lang('titles.form.full_name_label')</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" placeholder="name" name="name_company" value="{{$get->name}}"  onkeyup="this.value=this.value.toUpperCase()">
                                    </div>
                                  </div>
                                  
                                  <button type="submit" class="btn btn-primary me-2">@lang('actions.Submit')</button>
                                  <button class="btn btn-light" type="rest">@lang('actions.Cancel')</button>
                                </form>
                              @endforeach
                           
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 grid-margin">
                         
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
       

