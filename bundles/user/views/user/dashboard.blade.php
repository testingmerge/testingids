@layout('pageshell')


@section('styles')

<style>

#fb_screen
{
position:absolute;height:100%;width:100%;background-color: #FFF;top:0px;left:0px;display:none;z-index:9999;
background: rgb(255, 255, 255);
opacity:0.8;
text-align: center;

}

</style>

@endsection

@section('content')

@include('spotlight')			    	

			      	<div class="row">
			
				      	<div class="col-md-3">
				      	
				      	
				      		@section('left_section')
				      		
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
				      					
				      					<div class="row">
			
				      			<div class="panel panel-default">
										  <div class="panel-body">
										    	<div class="row">
										    			
								  					<div class="col-md-8">
								    		<h4>{{ t('iamhereto') }}  
								    		@if($profile->whyamihere == 1)
								    		<strong class="text-primary">{{ t('makefriends') }}</strong>
								    		@elseif($profile->whyamihere == 2)
								    		<strong class="text-primary">{{ t('date') }}</strong>
								    		@else
								    		<strong class="text-primary">{{ t('chat') }}</strong>
								    		@endif
								    		 with 
								    		 @if($profile->preferred_gender == 1)
								    		<strong class="text-success">{{ t('guys') }}</strong>
								    		@elseif($profile->preferred_gender == 2)
								    		<strong class="text-success">{{ t('girls') }}</strong>
								    		@else
								    		<strong class="text-success">{{ t('bothgirlsguys') }}</strong>
								    		@endif
								    		{{ t('in') }} <strong class="text-warning">{{ Session::get('searched_city',Auth::user()->city) }}</strong></h4>
								    				</div>
			
								    				<div class="col-md-4">
								    						<div class="btn-toolbar pull-right">
												  			<div class="btn-group">
												  	 <button type="button" class="btn btn-default" id="change_search_filter">{{ t('change') }}</button>
												  	
												  	 		</div>
																<!--
												  	 		<div class="btn-group">
														    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
														      Show: All
														      <span class="caret"></span>
														    </button>
														    <ul class="dropdown-menu">
														      <li><a href="#">New</a></li>
														      <li><a href="#">With Photo</a></li>
														    </ul>
								  							</div> -->
								  	 						</div> 
								    				</div>
			
							    	
										    	</div>
			
										    	<div id="search_filter"  style="display:none;">
													
													<div class="row">
													{{ Form::open('/dashboard', 'POST', array('id'=>'search_filter_form' )) }}
										    			<div class="col-md-3">
												    			<h5 class="text-muted">{{ t('iamhereto') }}</h4>
												    			<div class="clearfix"></div>
												    			<div class="small">
								    							<div class="radio">
																  <label>
																   {{ Form::radio('whyamihere', '1', $makenewfriends) }}
																    {{ t('makefriends') }}
																  </label>
							
																</div>
																<div class="radio">
																  <label>
																  {{ Form::radio('whyamihere', '2', $todate) }}
																    {{ t('date') }}
																  
																  </label>
																</div>
																<div class="radio">
																  <label>
																    {{  Form::radio('whyamihere', '3', $tochat) }}
																    {{ t('chat') }}
																  </label>
																</div>
																</div>
														</div>
			
			
			
														<div class="col-md-3">
																<h5 class="text-muted">{{ t('with') }}</h4>
							    								<div class="clearfix"></div>
			
										    					<div class="checkbox">
																	  <label>
																	    {{ Form::checkbox('guys', '1', $guys) }}
																	    {{ t('guys') }}
																	  </label>
																	</div>
																<div class="checkbox">
																	  <label>
																	    {{ Form::checkbox('girls', '2', $girls) }}
																	    {{ t('girls') }}
																	  </label>
																	</div>

																{{ Form::select('age_group', array('1' => '18 - 25', '2' => '25 - 30', '3' => '30 '.t('beyond')),"$profile->preferred_age",array('class' => 'select', 'id' => 'select_age')) }}
			
			
			
														</div>
			
			
														<div class="col-md-3">
			
																<h5 class="text-muted">{{ t('where') }}</h4>
												    			<div class="clearfix"></div>
			
												    			
												    			
												    				<input class="form-control" id="city" type="text" name="city" value="{{ Session::get('searched_city',Auth::user()->city) }}" style="margin-bottom:10px;">
									
												    				<input type="hidden" name="lat" id="lat" value="{{ Session::get('searched_lat',Auth::user()->lat) }}" />
												  					<input type="hidden" name="lng" id="lng" value="{{ Session::get('searched_lng',Auth::user()->lng) }}" />
												  					<input type="hidden" name="country" id="country" value="{{ Session::get('searched_country',Auth::user()->country) }}" />
			
												    					
												    				<input  type="text" style="width:150px;" name="distance" id="distance" data-slider-id="distance-slider" data-slider-min="50" data-slider-max="600" data-slider-step="25" data-slider-value="{{ Session::get('searched_distance',100) }}" value="{{ Session::get('searched_distance',100) }}"  />
												    					
												    				
												    					{{ Form::select('distanceUnit', array('km' => "km", 'miles' => "miles"),Session::get('distance_unit','km'),array( 'id' => 'distanceUnit')) }}
												    					
			
												    				
			
												    				
			
			
														</div>
								
														<div class="col-md-3">
			
															<h5 class="text-muted">{{ t('interestedin') }}</h4>
																<div class="clearfix"></div>
			
											    				<input type="text" name="interests" class="form-control" value="{{ implode(',',Session::get('interests',array())) }}" placeholder="{{ t('enterinterests') }}" id="enter_interests" />
												    				
			
			
														</div>
														
														</div>
														
														
														<div class="row top-buffer">
														<div class="col-md-5 col-md-offset-3">
														<div class="btn-group" style="display:none;" id="filter_buttons">
												  					<button type="submit" class="btn btn-warning" id="update-btn">{{ t('updateresults') }}</button>
												  	 			<button type="button" class="btn btn-default" id="cancel-btn">{{ t('cancel') }}</button>
												  	
												  	 					</div>
												  	 	</div>
												  	 	{{ Form::close() }}
												  	 	</div>
			
			
			
								    			</div>
							    	</div>
			
			
										    	</div>
			
										  </div>
				
							@if(s('show_riseup_msg'))
							<div class="row">

								<div class="col-md-12">
									<div class="alert alert-success">
										<div class="row">
											<div class="col-md-9">
												<p><strong>{{ t("getyourprofiletofirstinsearch") }}</strong></p>
												<p>{{ t('riseupinsearchamoung') }} {{ Auth::user()->rise_up_number() }} {{ t('profiles') }}</p>
											</div>
											<div class="col-md-3">
													<a href="{{ url('/premium') }}" class="btn btn-success pull-right"><i class="fa fa-arrow-circle-o-up"></i> {{ t('riseup') }}</a>
											</div>
										</div>
									</div>
								</div>

							</div>
							@endif
			
							<div class="row">
			
									<div class="col-md-12" id="people" style="padding: 0px;margin:0px;text-align:left;">
									
														
														@forelse($people as $person)
														<div class="boxcontainer" style="width:232px;display:inline-block;">
															<div  style="height:180px;width:232px:padding:0px;margin:0px;background-image: url({{ $person->user->mediumPhoto() }});background-size: cover;text-align:center;">
																<div style="border-radius:10px;height:16px;width:45px;position:absolute;top:5px;right:5px;background: rgba(0,0,0,.4);color: #fff;font: .917em/1.4 Helvetica,Arial,sans-serif;"><span class="glyphicon glyphicon-camera"></span> {{ $person->user->photos_count()}}</div>
															</div>
			
															<div style="margin:7px;">
															<h6><a href="{{ $person->user->profile_url() }}">{{ $person->user->name }}, {{ $person->user->age }}</a></h6>
															<p>
																<ul style="list-style-type: none;padding: 0px;font-size: 0.8em;">
																	<li><i class="fa fa-home"></i> {{ t('livesin') }} {{ $person->user->city }}</li>
																	<li><i class="fa fa-heart"></i> {{ $person->relationship_status() }}</li>
																	
																</ul>
															</p>
															<p style="font-size:0.8em;" class="text-muted">
																{{ t('wantstomeet') }} {{ $person->to_meet() }} {{ t('between') }} {{ $person->age_group() }} {{ t('yearsoldin') }} {{ $person->user->city }}
															</p>
															
															</div>
															
															
															<div style="background: #f2f2f2;
																			border-top: 1px solid #e6e6e6;
																			padding: 7px 11px;
																			font-size: 16px;">
																@if($person->user->isOnline())
																<div class="status-online pull-right user_interaction" style="margin-top:3px;" data-toggle="tooltip" data-original-title="{{ t('online') }}"></div>
																@else
																<div class="status-offline pull-right user_interaction" style="margin-top:6px;" data-toggle="tooltip" data-original-title="{{ t('offline') }}"></div>
																@endif
																<a href="javascript:;" class="user_interaction chat-now-btn" data-user-id="{{ $person->user->id }}"  data-toggle="tooltip" data-original-title="{{ t('sendmessage') }}"><i class="fa fa-comment fa-2"></i></a> 
																@if(Auth::user()->isFavourite($person->user->id))
																<a href="javascript:;" class="user_interaction"  data-toggle="tooltip" data-original-title="{{ t('isafavorite') }}"><i style="color: gold;" class="fa fa-star fa-2"></i></a>	
																@else
																<a href="javascript:;" class="user_interaction add-favourite-btn" data-user-id="{{ $person->user->id }}"  data-toggle="tooltip" data-original-title="{{ t('addasfavorite') }}"><i class="fa fa-star fa-2"></i></a>	
																@endif
																@if($person->user->isSuperpower())
																<a href="javascript:;" class="user_interaction" style="margin-top:3px;" data-toggle="tooltip" data-original-title="{{ t('superpower') }}"><i class="fa fa-bolt fa-2"></i></a>
																@endif
															</div>
														</div>
														
														@empty
														
															<div class="well">
																{{ t('nousersfound') }}
															</div>
														
														@endforelse
														
														
									
			
									</div>
									
			
			
				      		</div>
			
			@if($paginate)
							<div class="row">
								
								<ul class="pager pull-right">
			  <li>{{ $paginate->previous() }}</li>
			  <li>{{ $paginate->next() }}</li>
			</ul>
								
								
							</div> 
			@endif
			
			
			
			
				      		</div>
				      		
				      		@endsection
				      	
				      	
				      		@yield("right_section")
			
				      		
			
			
			
				      	
			
			
			
			
				      	</div>




				      	<div id="fb_screen">
<div style="position:absolute;top:200px;left:500px;text-align:center;">
<h4>{{ t('shareinfbtounlockyouraccount') }}</h4>

<a href="javascript:;" id="fb_share" class="btn btn-xs btn-primary"><i class="fa fa-facebook"></i> Share</a>

<!--
<fb:like href="{{ URL::base() }}" 
     send="true" width="450" show_faces="false"
     >
</fb:like> -->
</div>
</div>
				      	
@endsection


@section('scripts')

<script>

$('#fb_share').on('click',function() {
            FB.ui(
             {
               method: 'feed',
               name: document.title,
               link: location.href,
             },
             function(response) {
               if (response && response.post_id) {
                 // the downlaod link will be activated

                 $.post('/fb_share', function(){

                 	   $('#fb_screen').fadeOut(); 

                 	   $('html, body').css({
    'overflow': 'auto',
    'height': 'auto'
})

                 })

               



               } else {
                 // do nothing or ask the user to share it
                  }
             });        
        }); 


@if(s("facebook_share"))

@if(!Auth::user()->setting("fb_share"))
$(function(){

$("#fb_screen").show();

$('html, body').css({
    'overflow': 'hidden',
    'height': '100%'
})

});
@endif

@endif
/*
FB.Event.subscribe('edge.create',
   function(response) {
    alert('You liked the URL: ' + response);
            // you can do some ajax call to your backend and update your database
   }
);  */

</script>


<script>

var geocoder;

   function geoCoderInitialize() {
    geocoder = new google.maps.Geocoder();


  }

function codeCity(city_name){

 geocoder.geocode({'address': city_name}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {


        if (results[0]) {
        		 
        	 $("#lat").val(results[0].geometry.location.lat())
        	 $("#lng").val(results[0].geometry.location.lng());
        		 

     }
     else{
     	   	$("#lat").val(results.geometry.location.lat())
        	 $("#lng").val(results.geometry.location.lng());
     } 

 }
 else{
 
 	console.log("Google Maps GeoCoder Not Reachable");
 
 }
});


}

$(function(){

	geoCoderInitialize();

	

	jQuery("#city").autocomplete({
			source: function (request, response) {
		
				jQuery("#city").addClass("spinner");
			 	jQuery.getJSON(
					"http://gd.geobytes.com/AutoCompleteCity?callback=?&q="+request.term,
					
					function (data) {
						jQuery("#city").removeClass("spinner");
					 	response(data);
					}
		 		);
		
			},
			
			minLength: 3,
			select: function (event, ui) {
		 		var selectedObj = ui.item;
		 		var city = selectedObj.value.split(',');
		 		var country = $.trim(city[2]);
		 		city = city[0];
		 		fcity = city +", "+country;
				jQuery("#city").val(city);
				jQuery("#country").val(country);
				codeCity(fcity);

				return false;
			},
			
			open: function () {
		 		jQuery(this).removeClass("ui-corner-all").addClass("ui-corner-top");
			},
			close: function () {
		 		jQuery(this).removeClass("ui-corner-top").addClass("ui-corner-all");
			}
	 	});
	 	
	 	jQuery("#city").autocomplete("option", "delay", 100);
	 	
	 	
	 	
	 	jQuery("#city").keyup(function(){
	 	
	 		if(jQuery("#city").val() == ""){
	 		jQuery("#lat").val("");
	 		jQuery("#lng").val("");
	 		jQuery("#country").val("");
	 		}

	 	
	 	});
	 	
	 	
	 	
	 	  function split( val ) {
    return val.split( /,\s*/ );
  }

  function extractLast( term ) {
     return split( term ).pop();
   }
	 	
	 	
	 		jQuery("#enter_interests").autocomplete({
			source: function (request, response) {
		
				jQuery("#enter_interests").addClass("spinner");
			 	jQuery.getJSON(
					"{{ url('/interests/') }}"+extractLast(request.term),
					
					function (data) {
						jQuery("#enter_interests").removeClass("spinner");
					 	response( $.ui.autocomplete.filter(
                     data, extractLast( request.term ) ) );
					}
		 		);
		
			},
			
			minLength: 2,
			select: function (event, ui) {

				var terms = split( this.value );
                terms.pop();
                terms.push( ui.item.value );
                terms.push( "" );
                this.value = terms.join( "," );

				return false;
			},
			focus: function(){
			
				return false;
			
			},
			
			open: function () {
		 		jQuery(this).removeClass("ui-corner-all").addClass("ui-corner-top");
			},
			close: function () {
					

					
		 		jQuery(this).removeClass("ui-corner-top").addClass("ui-corner-all");
			}
	 	});
	 	
	 	jQuery("#enter_interests").autocomplete("option", "delay", 100);




 	$("#change_search_filter").click(function(){ 

  	$("#search_filter").slideToggle('fast');
  	$("#filter_buttons").show();
  	$("#change_search_filter").hide();
  

  });
  
  
  $("#cancel-btn").click(function(){
  
  $("#search_filter").slideToggle('fast');
  $("#filter_buttons").hide();
  $("#change_search_filter").show();
  
  });
  
  
  $("#update-btn").click(function(e){
  
  	e.preventDefault();
  	
  	if($('#city').val() == ''){
  	
  	alert("{{ t('citymust') }}");
  	
  
  	
  	}
  	else{
  	
  		$("#search_filter_form").submit();
  	
  	}
  
  
  });
  
  
  
});

</script>


@endsection
			