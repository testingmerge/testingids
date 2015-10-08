@layout('pageshell')


@section('content')

@include('spotlight')			    	

			      	<div class="row">
			
				      	<div class="col-md-3">
				      	
				      	
				      		@section('left_section')
				      		
				      						@if(!Auth::guest())
											@include("user_menu")



															      						@if(s('show_superpowers'))
				      						
											<div  style="margin-top: 10px;width: 200px;height:45px; background-image: url({{ asset('assets/images/activate_superpower.png') }});">
											
											<p style="color: #FFF;display: inline-block;margin: 5px;margin-top:12px;margin-left: 15px;"><u><a class="activatesuperpower" href="{{ url('/premium') }}">{{ t('activatesuperpowers') }}</a></u></p>
										

											</div>
										</a>
											@endif


@if(s('show_fb_invite'))
											<div id="fb-root"></div>
<a href='#' onclick="FacebookInviteFriends();" > 
<img src="{{ asset('assets/images/facebook_invite.png') }}" style="margin-top: 10px;" />
</a>
@endif
				      		


@endif

				      		@if(s('banner_left_side_bar'))
				      			<div style="margin-top: 20px;">
				      			{{ Banner::get_banners('banner_left_side_bar') }}
				      			</div>
				      		@endif
				      		
				      		
				      		@endsection


				      		
				      	
				      		@yield("left_section")

				      	</div>
			
			
				      	
				      	
				      		@section("right_section")
				      		
				      		<div class="col-md-9">
				      					
					


			
			
				      		</div>
				      		
				      		@endsection
				      	
				      	
				      		@yield("right_section")
			
				      		
			
			
			
				      	
			
			
			
			
				      	</div>
				      	
@endsection
			