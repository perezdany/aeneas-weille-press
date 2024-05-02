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
                              <div class="card-body">
                               <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">@lang('titles.form.EDIT PRESS ARTCILE')</h4>
                              @php
                                $get = (new ArticleController())->GetArticleById($id);
                                //dd($get);
                              @endphp
                              @foreach($get as $article)
                                <form class="forms-sample" action="editartcile" method="post">
                                @csrf
                                <input type="text" name="id_article" value="{{$article->id_articles}}" style="display:none;">
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.English Title')</label>
                                  <div class="col-sm-9">
                                    <textarea  class="form-control" name="en_title" value="{{$article->title_en}}"></textarea>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.French Title')</label>
                                  <div class="col-sm-9">
                                    <textarea  class="form-control" name="fr_title" value="{{$article->title_fr}}"></textarea>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.Select the Press')</label>
                                  <div class="col-sm-9">
                                    <select class="form-control form-control-lg" name="press" required>
                                      <option value="{{$article->id_presse}}">{{$article->name_presse}}</option>
                                      @php
                                        $query = (new ReviewController())->displayAllNewsPaper();
                                      @endphp

                                      @foreach($query as $presse)
                                        <option value="{{$presse->id_presse}}">{{$presse->name_presse}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.Url_of_artcicle')</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="https://journalci.press/artciledu7_12_2021..." name="url" value="{{$article->link}}">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.Select_review') </label>
                                  <div class="col-sm-9">
                                    <select class="form-control form-control-lg" name="rv" >
                                      <option value="{{$article->id}}">{{$article->label}}</option>
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
                              @endforeach
                              
                            </div>
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
     
