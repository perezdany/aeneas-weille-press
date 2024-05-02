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
                            <div class="bg-success">{{session('success')}}</br></div>

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
                          <div class="bg-danger">{{session('error')}}</br></div>

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
          							   <h4 class="card-title card-title-dash">@lang('titles.tables.user_admin_table')</h4>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                              @php
                                $all = (new UserController())->displayAllAdmins();
                              @endphp
                              <thead>
                                <tr>
                                  <th>@lang('titles.tables.Name')</th>
                                  <th>@lang('titles.tables.Pseudo')</th>
                                  <th>@lang('titles.tables.Type')</th>
                                  <th>@lang('titles.tables.Action')</th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($all as $all)

                                  <tr>
                                
                                    <td>{{$all->full_name}}</td>
                                    <td>{{$all->pseudo}}</td>
                                    <td>
                                      @if($all->super == 1)
                                          SUPER
                                        @else
                                          STANDARD
                                        @endif
                                    </td>
                                    <td align="center">

                                        <form action="deleteadminuser" method="post">
                                          @csrf
                                          <input type="text" name="id" value="{{$all->id}}" style="display: none;">
                                          <button class="btn btn-danger"><span class="mdi mdi-trash-can" style="color:#fff;"></span></button>
                                        </form>
                                        
                                        <form action="editformadminuser" method="post">
                                          @csrf
                                          <input type="text" name="id" value="{{$all->id}}" style="display: none;">
                                        <button class="btn btn-primary"><span class="mdi mdi-pen" style="color:#fff;"></span></button>
                                        </form>
                                      </span></button>
                                    </td>


                                  </tr>
                                @endforeach
                              
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>@lang('titles.tables.Name')</th>
                                  <th>@lang('titles.tables.Pseudo')</th>
                                  <th>@lang('titles.tables.Type')</th>
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
                        <div class="col-md-6 grid-margin stretch-card">
              					  <div class="card">
                						<div class="card-body">
                						  <h4 class="card-title">@lang('titles.form_add_admin')</h4>
                              
                						  <form class="forms-sample" action="adduser" method="post">
                                @csrf
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.full_name_label')</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Your name" name="full_name" required  onkeyup="this.value=this.value.toUpperCase()">
                                  </div>
                                </div>
                  							<div class="form-group row">
                  							  <label class="col-sm-3 col-form-label">@lang('titles.form.Pseudo_label')</label>
                  							  <div class="col-sm-9">
                  								  <input type="text" class="form-control" placeholder="Username" name="pseudo" required>
                  							  </div>
                  							</div>
                  							<div class="form-group row">
                  							  <label  class="col-sm-3 col-form-label">@lang('titles.form.Email_label')</label>
                  							   <div class="col-sm-9">
                  								<input type="email" class="form-control" placeholder="email" name="email" required>
                  							  </div>
                  							</div>
                  							<div class="form-group row">
                  							  <label  class="col-sm-3 col-form-label">@lang('titles.form.password_label')</label>
                  							  <div class="col-sm-9">
                  								<input type="password" class="form-control" placeholder="password" name="pass" id="pwd1" required>
                  							  </div>
                  							</div>
                  							<div class="form-group row">
                  							  <label class="col-sm-3 col-form-label">@lang('titles.form.password_confirm_label')</label>
                  							  <div class="col-sm-9">
                  								<input type="password" class="form-control" placeholder="confirm" name="confirm" id="pwd2" required  onkeyup="verifyPassword()">
                  							  </div>
                  							</div>
                                <div class="form-group row" id="match">
                                
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
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">SUPER OR NO</label>
                                  <div class="col-sm-9">
                                    <select class="form-control form-control-lg" name="type">
                                        <option value="1">YES</option>
                                        <option value="0">NO</option>
                                    </select>
                                  </div>
                                </div>
                  							<button type="submit" class="btn btn-primary me-2">@lang('actions.Submit')</button>
                  							<button class="btn btn-light" type="rest">@lang('actions.Cancel')</button>
                						  </form>
                						</div>
              					  </div>
              				  </div>
                        <!--AJOUTER UN UTILISATEUR CLIENT -->
                        <div class="col-md-6 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">@lang('titles.form_add_user')</h4>

                              
                              <form class="forms-sample" action="add_customer_user" method="post">
                                @csrf
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.full_name_label')</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Full name" name="fullname" onkeyup="this.value=this.value.toUpperCase();">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label  class="col-sm-3 col-form-label">@lang('titles.form.Email_label')</label>
                                   <div class="col-sm-9">
                                  <input type="email" class="form-control" placeholder="email" name="email">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label  class="col-sm-3 col-form-label">@lang('titles.form.member_label')</label>
                                   <div class="col-sm-9">
                                  <select  class="form-control form-control-lg" name="customer">
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
                                <div class="form-group row">
                                  <label  class="col-sm-3 col-form-label">@lang('titles.form.password_label')</label>
                                  <div class="col-sm-9">
                                  <input type="password" class="form-control" placeholder="type the password" id="pwd3" name="pass">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.password_confirm_label')</label>
                                  <div class="col-sm-9">
                                  <input type="password" class="form-control" placeholder="confirm password" id="pwd4" name="confirm_pass" onkeyup="verifyPassword()">
                                  </div>
                                </div>
                                 <div class="form-group row" id="matcht">
                                  
                                  </div>
                                  <script type="text/javascript">
                                      
                                      /*UN SCRIPT QUI VA VERFIER SI LES DEUX PASSWORDS MATCHENT*/
                                      function verifyPassword()
                                      {
                                        var msg; 
                                        var str = document.getElementById("pwd3").value; 

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
                                        var text1 = document.getElementById('pwd3').value;
                                        var text2 = document.getElementById('pwd4').value;
                                        
                                        if((text1 == text2))
                                        {
                                          var theText = "<p style='color:green'>Correspond.</p>"; ;
                                          document.getElementById("matcht").innerHTML= theText; 
                                        }
                                        else
                                        {
                                          var theText = "<p style='color:red'>Ne correspond pas.</p>";
                                          document.getElementById("matcht").innerHTML= theText; 
                                        }
                                      }
                                        
                                  </script>
                                <button type="submit" class="btn btn-primary me-2">@lang('actions.Submit')</button>
                                <button class="btn btn-light" type="rest">@lang('actions.Cancel')</button>
                              </form>
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
       

