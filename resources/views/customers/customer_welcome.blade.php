@php
    //dd(session()->user()->full_name);
    //use Illuminate\Support\Facades\Auth;
   // dd(Auth::user());
    use App\Http\Controllers\Calculator;
    use App\Http\Controllers\ReviewController;
    use App\Http\Controllers\ArticleController;
@endphp

@extends('layouts/base_user')

@section('full_name')
  {{auth()->user()->first_lastname}}
@endsection

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
				<div class="tab-content tab-content-basic">
					<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 	  <!--affichage des messages de success ou d'erreur-->

            @if(session('success'))
              <div class="row">
                <div class="col-lg-12">
                  <div class="col-md-3"></div>
                  <div class="card card-body grid-margin ">
                      <div class="bg-success">OK</br></div>

                    </div>
                  <div class="col-md-3"></div>
                </div>
              
              </div>  

            @endif
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


			 @if(session('error_search'))
              <div class="row">
                <div class="col-lg-12">
                  <div class="col-md-3"></div>
                  <div class="card card-body grid-margin ">
                      <div class="bg-danger">@lang('messages.error_search')</br></div>

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
                  <div class="bg-danger">@lang('messages.error_download')</br></div>

                  </div>
                <div class="col-md-3"></div>
              </div>
            
            </div>  
            
            
          @endif  
                      
          <!-- fin-->
          <!--RECHERCHE DE DATE-->
			<div class="row">
					<div class="col-md-3 grid-margin stretch-card">
						
					</div>
					<div class="col-md-6 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">@lang('titles.form.Search_title')</h4>
							
							<form class="forms-sample" method="post" action="searh_review">
							@csrf
							<div class="form-group">
								<label for="exampleInputUsername1">@lang('titles.form.date_label')</label>
								<input type="date" class="form-control" name="date" >
							</div>
						
							<button type="submit" class="btn btn-primary me-2">@lang('actions.Submit')</button>
						
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
                <div class="row">
					<div class="col-md-3 grid-margin stretch-card">

					</div>
					@if(LaravelLocalization::getCurrentLocale() == 'en')
						<div class="col-md-6 grid-margin stretch-card">
							
							<div class="card text-center">
							<div class="card-body">
								<h3 class="card-title">@lang('titles.form.dld_title_form') {{$date_added}}</h3>
								<p class="card-description">
								<form class="forms-sample" action="/download_en" method="post" enctype="multipart/form-data">
									@csrf
									<input type="text" value="{{$path_en}}" style="display: none;" name="file">
										<!--<button type="submit" class="btn btn-primary me-2">Submit</button>-->
									<button type="submit" class="btn btn-success">@lang('actions.file_download_action')</button>
								</form>
								
								</p>
							</div>
							</div>
						</div>
					@else
						<div class="col-md-6 grid-margin stretch-card">
							
							<div class="card text-center">
							<div class="card-body">
								<h3 class="card-title">@lang('titles.form.dld_title_form') {{$date_added}}</h3>
								<p class="card-description">
								<form class="forms-sample" action="/download_en" method="post" enctype="multipart/form-data">
									@csrf
									<input type="text" value="{{$path_fr}}" style="display: none;" name="file">
										<!--<button type="submit" class="btn btn-primary me-2">Submit</button>-->
									<button type="submit" class="btn btn-success">@lang('actions.file_download_action')</button>
								</form>
								
								</p>
							</div>
							</div>
						</div>
					@endif
					
					<div class="col-md-3 grid-margin stretch-card">

					</div>
				</div>
							 
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
				
				$get = (new ReviewController())->GetTheLastReview();
				//dd($get->path_file_en);
				
				@endphp
				<div class="row">
					<div class="col-md-3 grid-margin stretch-card">

					</div>
					@if(LaravelLocalization::getCurrentLocale() == 'en')
						<div class="col-md-6 grid-margin stretch-card">
							
							<div class="card text-center">
							<div class="card-body">
								<h3 class="card-title">@lang('titles.form.dld_title_form') {{$get->date_added}}</h3>
								<p class="card-description">
								<form class="forms-sample" action="/download_en" method="post" enctype="multipart/form-data">
									@csrf
									<input type="text" value="{{$get->path_file_en}}" style="display: none;" name="file">
									<!--<button type="submit" class="btn btn-primary me-2">Submit</button>-->
									<button type="submit" class="btn btn-success">@lang('actions.file_download_action')</button>
								</form>
								
								</p>
							</div>
							</div>
						</div>
					@else
						<div class="col-md-6 grid-margin stretch-card">
							
							<div class="card text-center">
							<div class="card-body">
								<h3 class="card-title">@lang('titles.form.dld_title_form') {{$get->date_added}}</h3>
								<p class="card-description">
								<form class="forms-sample" action="/download_en" method="post" enctype="multipart/form-data">
									@csrf
									<input type="text" value="{{$get->path_file_fr}}" style="display: none;" name="file">
									<!--<button type="submit" class="btn btn-primary me-2">Submit</button>-->
									<button type="submit" class="btn btn-success">@lang('actions.file_download_action')</button>
								</form>
								
								</p>
							</div>
							</div>
						</div>
					@endif
					
					<div class="col-md-3 grid-margin stretch-card">

					</div>
				</div>
				
				@php
				//Recuper l'id d'abord
				$id = (new ReviewController())->GetTheLastReview();
				$all = (new ArticleController())->DisplayWithIdPresse($id->id);
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
	<!-- content-wrapper ends -->
@endsection