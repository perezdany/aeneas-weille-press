@php
  
    use App\Http\Controllers\Calculator;
     use App\Http\Controllers\ReviewController;

     //dd($id);
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
                                <div class="card card-body grid-margin ">
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
                      <div class="col-lg-3 d-flex flex-column">
                        
                      </div>
                      <div class="col-lg-6 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin">
                            <div class="card card-rounded">
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title">@lang('titles.form.EDIT A PRESS REVIEW')</h4>
                                    @php
                                      $all = (new ReviewController())->SelectById($id);
                                    @endphp

                                    @foreach($all as $all)
                                      <form class="forms-sample" action="editreview" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                          <input type="text" class="form-control" style="display: none;" value="{{$all->id}}" name="id">
                                          <label class="col-sm-3 col-form-label">@lang('titles.form.Title')</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="exeample: press review of 12/03/2023" name="title" value="{{$all->label}}"required>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">@lang('titles.form.French_upload')</label>
                                          <div class="col-sm-9">
                                            <input type="file" class="form-control form-control-lg" name="fr_file" >
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">@lang('titles.form.English_upload')</label>
                                          <div class="col-sm-9">
                                            <input type="file" class="form-control form-control-lg" name="en_file" >
                                          </div>
                                        </div>
                                        <button type="submit" class="btn btn-success me-2">@lang('actions.Submit')</button>
                                        <button class="btn btn-light" type="reset">@lang('actions.Cancel')</button>
                                      </form>
                                    @endforeach
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        
                      </div>
                      <div class="col-lg-3 d-flex flex-column">
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>


@endsection
     
