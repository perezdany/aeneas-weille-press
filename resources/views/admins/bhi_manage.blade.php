@php
    //dd(session()->user()->full_name);
    //use Illuminate\Support\Facades\Auth;
   // dd(Auth::user());
 
    use App\Http\Controllers\BhiController;
    use App\Models\Customer;
@endphp

@extends('layouts/base_app')


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
                              <div class="bg-success">@lang('messages.success_save')</br></div>

                          </div>
                          <div class="col-md-3"></div>
                      </div>
                      
                    </div>  
                @endif

                @if(session('success_del'))
                    <div class="row">
                      <div class="col-lg-12">
                          <div class="col-md-3"></div>
                          <div class="card card-body ">
                              <div class="bg-success">@lang('messages.success_del')</br></div>

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
                      
                    <div class="col-lg-6 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin">
                            <div class="card card-rounded">
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title">@lang('titles.add_bhi')</h4>
                                  
                                  <form class="forms-sample" action="/addbhi" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">@lang('titles.form.Title')</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="BHI of of 12/03/2023" name="title" required>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">@lang('titles.form.dld')</label>
                                      <div class="col-sm-9">
                                        <input type="file" class="form-control form-control-lg" name="bhi_file">
                                      </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success me-2">@lang('actions.Submit')</button>
                                    <!--<button class="btn btn-light" type="reset">Cancel</button>-->
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        
                      </div>
                    <div class="col-lg-6 d-flex flex-column">
                        <div class="row flex-grow">
                            <div class="col-12 grid-margin">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <h4 class="card-title card-title-dash">@lang('titles.tables.user_admin_table')</h4>
                                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            @php
                                                $all = (new BhiController())->displayAllBhi();
                                            @endphp
                                            <thead>
                                                <tr>
                                                <th>@lang('titles.tables.Name')</th>

                                                <th>@lang('titles.tables.Date_added')</th>
                                    
                                                <th>@lang('titles.tables.Action')</th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($all as $all)

                                                <tr>
                                                
                                                    <td>{{$all->name_file}}</td>

                                                    <td>{{$all->date_added}}</td>
                                                   
                                                    <td align="center">
                                                        <form action="/download" method="post">
                                                            @csrf
                                                            <input type="text" name="file" value="{{$all->file_path}}" style="display: none;">
                                                            <button class="btn btn-success"><span class="mdi mdi-download" style="color:#fff;"></span></button>
                                                        </form>

                                                        <form action="deletebhi" method="post">
                                                            @csrf
                                                            <input type="text" name="id" value="{{$all->id}}" style="display: none;">
                                                            <button class="btn btn-danger"><span class="mdi mdi-trash-can" style="color:#fff;"></span></button>
                                                        </form>
                                                        
                                                        <form action="form_edit_bhi" method="post">
                                                            @csrf
                                                            <input type="text" name="id_bhi" value="{{$all->id}}" style="display: none;">
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
            

              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->

@endsection
       

