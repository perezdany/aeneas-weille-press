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
          							   <h4 class="card-title card-title-dash">@lang('titles.tables.user_of_companies')</h4>
          								<table id="example" class="table table-striped table-bordered" style="width:100%">
                            @php
                              $all = (new UserController())->displayAllUsers();
                            @endphp
          									<thead>
          										<tr>
          											<th>@lang('titles.tables.Name')</th>
          											<th>@lang('titles.tables.Email')</th>
          											<th>@lang('titles.tables.Addet At')</th>
                                <th>@lang('titles.tables.Member of')</th>
          											<th>@lang('titles.tables.Action')</th>
          											
          										</tr>
          									</thead>
          									<tbody>
          										@foreach($all as $all)

                                <tr>
                               
                                  <td>{{$all->first_lastname}}</td>
                                  <td>{{$all->email_user}}</td>
                                   <td>
                                    {{$all->added_at}}
                                   </td>
                                   <td>
                                    {{$all->name}}
                                   </td>
                                   <td align="center">

                                      <form action="deletecustomer" method="post">
                                        @csrf
                                        <input type="text" name="id_client" value="{{$all->id}}" style="display: none;">
                                        <button class="btn btn-danger"><span class="mdi mdi-trash-can" style="color:#fff;"></span></button>
                                      </form>
                                      
                                       <form action="editcustomerform" method="post">
                                        @csrf
                                        <input type="text" name="id_client" value="{{$all->id}}" style="display: none;">
                                        <button class="btn btn-primary"><span class="mdi mdi-pen" style="color:#fff;">  </span></button>
                                      </form>
                                    
                                   
                                  </td>


                                </tr>
                              @endforeach
          									 
          									</tbody>
          									<tfoot>
          										<tr>
                              <th>@lang('titles.tables.Name')</th>
          											<th>@lang('titles.tables.Email')</th>
          											<th>@lang('titles.tables.Addet At')</th>
                                <th>@lang('titles.tables.Member of')</th>
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
                        <div class="col-md-6">
              					  <div class="card">
                						<div class="card-body">
                						  <h4 class="card-title">@lang('titles.form_add_company')</h4>
                              
                						  <form class="forms-sample" action="addcompany" method="post">
                                @csrf
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.full_name_label')</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Your name" name="name_company" required  onkeyup="this.value=this.value.toUpperCase()">
                                  </div>
                                </div>
                  							
                  							<button type="submit" class="btn btn-primary me-2">@lang('actions.Submit')</button>
                  							<button class="btn btn-light" type="rest">@lang('actions.Cancel')</button>
                						  </form>
                						</div>
              					  </div>
              				  </div>
                        <div class="col-md-6 grid-margin">
                          <div class="card">
                          <div class="card-body">
                            <a href="companies"><button class="btn btn-block btn-success btn-lg font-weight-medium">@lang('actions.EDIT SOME COMPANIES')</button></a>
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
      </div>
    </div>
    <!-- content-wrapper ends -->

@endsection
       

