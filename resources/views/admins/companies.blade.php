@php
  use App\Models\Customer;
  use App\Http\Controllers\UserController;
  use App\Http\Controllers\Calculator;
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
                            <div class="bg-success">@lang('messages.success_save')</br></div>

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
                   <div class="col-lg-2 d-flex flex-column">
                    
                   </div>
                   <div class="col-lg-8 d-flex flex-column">
                    <div class="row flex-grow">
                      <div class="col-12 col-lg-4 col-lg-12 grid-margin ">
                      <div class="card card-rounded">
                        <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                          <div class="table-responsive">
                           <h4 class="card-title card-title-dash">@lang('titles.tables.COMPANIES')</h4>
                          <table id="example" class="table table-striped table-bordered" style="width:100%">
                            @php
                              $all = (new CustomerController())->displayAllCustomers();
                            @endphp
                            <thead>
                              <tr>
                                <th>@lang('titles.tables.Name')</th>
                                <th>@lang('titles.tables.Number of Users')</th>
                            
                                <th>@lang('titles.tables.Action')</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($all as $all)

                                <tr>
                               
                                  <td>{{$all->name}}</td>
                                  <td>
                                      @php
                                        $nb = (new Calculator())->CountUserByCompanies($all->id_customer);
                                      @endphp
                                      <b>{{$nb}}</b>
                                  </td>
                                 
                                   <td align="center">

                                      <form action="deletecompagny" method="post">
                                        @csrf
                                        <input type="text" name="id" value="{{$all->id_customer}}" style="display: none;">
                                        <button class="btn btn-danger"><span class="mdi mdi-trash-can" style="color:#fff;"></span></button>
                                      </form>
                                      
                                       <form action="editcompagnyform" method="post">
                                        @csrf
                                        <input type="text" name="id" value="{{$all->id_customer}}" style="display: none;">
                                        <button class="btn btn-primary"><span class="mdi mdi-pen" style="color:#fff;">  </span></button>
                                      </form>
                                    
                                   
                                  </td>


                                </tr>
                              @endforeach
                             
                            </tbody>
                            <tfoot>
                              <tr>
                                <th>@lang('titles.tables.Name')</th>
                                <th>@lang('titles.tables.Number of Users')</th>
                            
                                <th>@lang('titles.tables.Action')</th>
                              </tr>
                            </tfoot>
                          </table>

                          </div>

                        </div>

                        </div>
                      </div>
                      </div>
                    </div>
                    </div>
                   <div class="col-lg-2 d-flex flex-column">
                    
                   </div>
                </div>

                <div class="row">
                  <div class="col-lg-12 d-flex flex-column">
                    <div class="row flex-grow">
                        <div class="col-md-3 grid-margin">
                         
                        </div>
                        <div class="col-md-6">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">@lang('titles.form_add_company')</h4>
                              
                              <form class="forms-sample" action="addcompany" method="post">
                                @csrf
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Full name</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="name" name="name_company" required  onkeyup="this.value=this.value.toUpperCase()">
                                  </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary me-2">@lang('actions.Submit')</button>
                                <button class="btn btn-light" type="rest">@lang('actions.Cancel')</button>
                              </form>
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
       

