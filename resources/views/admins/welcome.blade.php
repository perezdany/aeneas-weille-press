@php
    //dd(session()->user()->full_name);
    //use Illuminate\Support\Facades\Auth;
   // dd(Auth::user());
    use App\Http\Controllers\Calculator;
     use App\Http\Controllers\ReviewController;
     use App\Http\Controllers\ArticleController;
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
                   
                    <div class="row">
                         <div class="col-lg-3 d-flex flex-column">
                            <div class="row flex-grow">
                              <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                <div class="card bg-default card-rounded">
                                  <div class="card-body pb-0">
                                    <h4 class="card-title card-title-dash  mb-4">@lang('titles.CUSTOMERS')</h4>
                                    <div class="row">
                                      <div class="col-sm-4 ">
                                            <h4 class="card-title-dash mb-4">
                                               @php
                                                    $calcul = (new Calculator())->CountCompanies();
                                               @endphp
                                               {{$calcul}}
                                           </h4>
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                          <div class="col-lg-3 d-flex flex-column">
                            <div class="row flex-grow">
                              <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                <div class="card bg-primary card-rounded">
                                  <div class="card-body pb-0">
                                    <h4 class="card-title card-title-dash text-white mb-4">@lang('titles.USERS')</h4>
                                    <div class="row">
                                      <div class="col-sm-4 ">
                                            <h4 class="card-title-dash text-white mb-4">
                                               @php
                                                    $calcul = (new Calculator())->CountUserAccount();
                                               @endphp
                                               {{$calcul}}
                                           </h4>
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                         <div class="col-lg-3 d-flex flex-column">
                            <div class="row flex-grow">
                              <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                <div class="card bg-warning card-rounded">
                                  <div class="card-body pb-0">
                                    <h4 class="card-title card-title-dash text-white mb-4">@lang('titles.PRESS REVIEWS')</h4>
                                     <div class="row">
                                      <div class="col-sm-4 ">
                                            <h4 class="card-title-dash mb-4 text-white">
                                               @php
                                                    $calcul = (new Calculator())->CountPressReveiew();
                                               @endphp
                                               {{$calcul}}
                                           </h4>
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                         <div class="col-lg-3 d-flex flex-column">
                            <div class="row flex-grow">
                              <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                <div class="card bg-success card-rounded">
                                  <div class="card-body pb-0">
                                    <h4 class="card-title card-title-dash text-white mb-4">@lang('titles.BHI')</h4>
                                    <div class="row">
                                      <div class="col-sm-4">
                                        
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                    </div>
                    <!--<div class="row">
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                   <h4 class="card-title card-title-dash">Performance Line Chart</h4>
                                   <h5 class="card-subtitle card-subtitle-dash">Lorem Ipsum is simply dummy text of the printing</h5>
                                  </div>
                                  <div id="performance-line-legend"></div>
                                </div>
                                <div class="chartjs-wrapper mt-5">
                                  <canvas id="performaneLine"></canvas>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                            <div class="card bg-primary card-rounded">
                              <div class="card-body pb-0">
                                <h4 class="card-title card-title-dash text-white mb-4">Status Summary</h4>
                                <div class="row">
                                  <div class="col-sm-4">
                                    <p class="status-summary-ight-white mb-1">Closed Value</p>
                                    <h2 class="text-info">357</h2>
                                  </div>
                                  <div class="col-sm-8">
                                    <div class="status-summary-chart-wrapper pb-4">
                                      <canvas id="status-summary"></canvas>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                      <div class="circle-progress-width">
                                        <div id="totalVisitors" class="progressbar-js-circle pr-2"></div>
                                      </div>
                                      <div>
                                        <p class="text-small mb-2">Total Visitors</p>
                                        <h4 class="mb-0 fw-bold">26.80%</h4>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="circle-progress-width">
                                        <div id="visitperday" class="progressbar-js-circle pr-2"></div>
                                      </div>
                                      <div>
                                        <p class="text-small mb-2">Visits per day</p>
                                        <h4 class="mb-0 fw-bold">9065</h4>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>-->

                      <!--affichage des messages de success ou d'erreur-->

                          @if(session('success'))
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="col-md-3"></div>
                                <div class="card card-body grid-margin ">
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
                                <div class="bg-danger">@lang('messages.unknow_erro')</br></div>

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
                                  <h4 class="card-title">@lang('titles.form_add_review')</h4>
                                  
                                  <form class="forms-sample" action="addreview" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">@lang('titles.form.Title')</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="exeample: press review of 12/03/2023" name="title" required>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">@lang('titles.form.French_upload')</label>
                                      <div class="col-sm-9">
                                        <input type="file" class="form-control form-control-lg" name="fr_file">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">@lang('titles.form.English_upload')</label>
                                      <div class="col-sm-9">
                                        <input type="file" class="form-control form-control-lg" name="en_file">
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
                               <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">@lang('titles.form_add_article')</h4>
                              
                              <form class="forms-sample" action="addartcile" method="post">
                                @csrf
                               <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.English Title')</label>
                                  <div class="col-sm-9">
                                    <textarea  class="form-control" name="en_title" required></textarea>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.French Title')</label>
                                  <div class="col-sm-9">
                                    <textarea  class="form-control" name="fr_title" required></textarea>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.Select the Press')</label>
                                  <div class="col-sm-9">
                                    <select class="form-control form-control-lg" name="press" required>
                                      @php
                                        $query = (new ReviewController())->displayAllNewsPaper();
                                      @endphp
                                      @foreach($query as $get)
                                        <option value="{{$get->id_presse}}">{{$get->name_presse}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.Url_of_artcicle')</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="https://journalci.press/artciledu7_12_2021..." name="url" required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.Select_review')</label>
                                  <div class="col-sm-9">
                                    <select class="form-control form-control-lg" name="rv" required>
                                      @php
                                        $query = (new ReviewController())->displayAllReviews();
                                      @endphp
                                      @foreach($query as $get)
                                        <option value="{{$get->id}}">{{$get->label}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-warning me-2">@lang('actions.Submit')</button>
                                <!--<button class="btn btn-light" type="reset">Cancel</button>-->
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
        </div>
    </div>


@endsection
     
