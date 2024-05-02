@extends('layouts/base_app')

@php
  
  use App\Http\Controllers\ArticleController;
 
@endphp


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
                        <div class="card card-body grid-margin">
                          <div class="bg-danger">{{session('error')}}</br></div>

                          </div>
                        <div class="col-md-3"></div>
                      </div>
                    
                    </div>  
                    
                    
                  @endif  
                
                  @php
                    $all = (new ArticleController())->DisplayWithIdPresse($id);
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
                                  French version
                              </p>
                             
                              
                              <p>
                                {{$all->title_fr}}
                              </p>
                              <p class="card-description">
                                  English version
                              </p>
                              <p>
                                {{$all->title_en}}
                              </p>
                              <p class="card-description">
                                <form action="deleteArticleForm" method="post">
                                  @csrf
                                  <input type="text" name="id_article" value="{{$all->id_articles}}" style="display: none;">
                                  <button class="btn btn-danger">SUPPRIMER<span class="mdi mdi-trash-can" ></span></button>
                                </form>
                                <form action="editArticleForm" method="post">
                                  @csrf
                                  <input type="text" name="id_article" value="{{$all->id_articles}}" style="display: none;">
                                  <button class="btn btn-primary">MODIFIER<span class="mdi mdi-pen" ></span></button>
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

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->

@endsection
       
