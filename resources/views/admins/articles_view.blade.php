@php
  use App\Models\Customer;
  use App\Http\Controllers\ArticleController;
  use App\Http\Controllers\ReviewController;
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
          			 <!--RECHERCHE DE REVUE-->
                    <div class="row">
                        <div class="col-md-3 grid-margin stretch-card">
                          
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">@lang('titles.form_search_review')</h4>
                            
                            <form class="forms-sample" method="post" action="admin_searh_review">
                              @csrf
                              <div class="form-group">
                                <label for="exampleInputUsername1">@lang('titles.form.reveiew_label')</label>
                                <select type="text" class="form-control" name="review" >
                                  @php
                                    $query = (new ReviewController())->displayAllReviews();
                                  @endphp
                                  @foreach($query as $get)
                                    <option value="{{$get->id}}">{{$get->label}}</option>
                                  @endforeach
                                </select>
                              </div>
                            
                              <button type="submit" class="btn btn-success me-2">@lang('actions.Submit')</button>
                          
                            </form>

                          </div>
                        </div>
                        </div>
                        <div class="col-md-3 grid-margin stretch-card">
                          
                        </div>
                    </div> 
                <!--FIN -->
                <!--affichage du résultat de la recherche-->

                  @if(isset($id))
                    @php
                      //dd($id);
                    @endphp
                     
                    @php
            
                      $all = (new ArticleController())->DisplayWithIdPresse($id);
                    @endphp
                    @foreach($all as $all)
                      
                      <div class="row">
                        <div class="col-lg-2 d-flex flex-column">
                          
                        </div>
                        <div class="col-lg-8 d-flex flex-column">
                          <div class="row flex-grow">
                            <div class="col-12 col-lg-12 grid-margin ">
                              <div class="card">
                                <div class="card-body">
                                 <h4 class="card-title">{{$all->name_presse}}</h4>
                                 <p class="card-description">
                                  @lang('titles.form.French_upload')
                                </p>
                                
                                
                                <p>
                                  <a href="{{$all->link}}" target="blank">{{$all->title_fr}}</a>
                                </p>
                                <p class="card-description">
                                  @lang('titles.form.English_upload')
                                </p>
                                <p>
                                  <a href="{{$all->link}}" target="blank"> {{$all->title_en}}</a>
                                </p>
                                <p class="card-description">
                                    <form action="deleteArticleForm" method="post">
                                      @csrf
                                      <input type="text" name="id_article" value="{{$all->id_articles}}" style="display: none;">
                                      <button class="btn btn-danger">@lang('actions.Delete')<span class="mdi mdi-trash-can" ></span></button>
                                    </form>
                                    <form action="editArticleForm" method="post">
                                      @csrf
                                      <input type="text" name="id_article" value="{{$all->id_articles}}" style="display: none;">
                                      <button class="btn btn-primary">@lang('actions.Edit')<span class="mdi mdi-pen" ></span></button>
                                    </form>
                                    
                                  </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-2 d-flex flex-column">
                        
                      </div>
                      </div>

                    @endforeach 

                  @else
                     @php
                        $all = (new ArticleController())->DisplayAllArticles();
                      @endphp
                      @if($all->count() == 0)
                        <div class="row">
                            <div class="col-lg-2 d-flex flex-column">
                              
                            </div>
                            <div class="col-lg-8 d-flex flex-column">
                              <div class="row flex-grow">
                                <div class="col-12 col-lg-12 grid-margin ">
                                  <div class="card-body">
                                      <h4 class="card-title">No Articles Found</h4>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-2 d-flex flex-column">
                              
                            </div>
                        </div>
                      @endif
                        @foreach($all as $all)

                          <div class="row">
                            <div class="col-lg-2 d-flex flex-column">
                              
                            </div>
                            <div class="col-lg-8 d-flex flex-column">
                              <div class="row flex-grow">
                                <div class="col-12 col-lg-12 grid-margin ">
                                  <div class="card">
                                <div class="card-body">
                                   <h4 class="card-title">{{$all->name_presse}}</h4>
                                   <p class="card-description">
                                      @lang('titles.form.French_upload')
                                  </p>    
                                  
                                  <p>
                                    <a href="{{$all->link}}" target="blank">{{$all->title_fr}}</a>
                                  </p>
                                  <p class="card-description">
                                      @lang('titles.form.English_upload')
                                  </p>
                                  <p>
                                    <a href="{{$all->link}}" target="blank">{{$all->title_en}}</a>
                                  </p>
                                  <p class="card-description">
                                    <form action="deleteArticleForm" method="post">
                                      @csrf
                                      <input type="text" name="id_article" value="{{$all->id_articles}}" style="display: none;">
                                      <button class="btn btn-danger">@lang('actions.Delete')<span class="mdi mdi-trash-can" ></span></button>
                                    </form>
                                    <form action="editArticleForm" method="post">
                                      @csrf
                                      <input type="text" name="id_article" value="{{$all->id_articles}}" style="display: none;">
                                      <button class="btn btn-primary">@lang('actions.Edit')<span class="mdi mdi-pen" ></span></button>
                                    </form>
                                    
                                  </p>
                                </div>
                               </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-2 d-flex flex-column">
                              
                            </div>
                          </div>
                  
                        @endforeach    
               
                  @endif

                <!-- fin-->


                      

              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->

@endsection
       

