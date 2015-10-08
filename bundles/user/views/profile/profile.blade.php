@layout('twocolumn')

@section('styles')

	<link href="{{ asset('assets/css/image-picker.css') }}" rel="stylesheet" />
	<style>
	
	.btn-label {position: relative;left: -12px;display: inline-block;padding: 6px 12px;background: rgba(0,0,0,0.15);border-radius: 3px 0 0 3px;}
.btn-labeled {padding-top: 0;padding-bottom: 0;}
	
	</style>

@endsection

@section('right_section')


				      	<div class="col-md-9 border-div">
			
				      		<div class="row">

								<div class="col-md-12">

										<h3>{{ $profile->user->name }}, {{ $profile->user->age }} <small>
										@if($profile->user->isOnline())
										<div class="status-online"></div>{{ t('iamonline') }}
										@else
										{{ t('lastonline') }} {{ $profile->user->lastLoginDays() }}
										@endif
										</small></h3>

								</div>
								
							</div>
							
							<div class="row">
							
							

									<div class="col-md-12">

										<ul class="nav nav-tabs pull-right" >
										  <li class="active"><a href="{{ url('/profile/'.$profile->user->id) }}"><span class="glyphicon glyphicon-user"></span> {{ t('profile') }}</a></li>
										  <li><a href="{{ url('/album/'.$profile->user->id) }}"><span class="glyphicon glyphicon-picture"></span> {{ t('photos') }}</a></li>
										</ul>

									@if(!Auth::guest())
										@if($profile->user->id != Auth::user()->id)
										<div class="btn-group">
										  <button type="button" class="btn btn-default btn-xs chat-now-btn" data-user-id="{{ $profile->user->id }}"><i class="fa fa-comment fa-2 text-primary"></i> {{ t('chatnow') }}</button>
										  @if(!Auth::user()->isMeet($profile->user->id))
										  <button type="button" class="btn btn-default btn-xs meet-me-btn" data-user-id="{{ $profile->user->id }}"><i class="fa fa-check fa-2 text-success"></i> {{ t('meet') }} {{ $profile->user->thirdPersonGender() }}</button>
										  @endif
										   @if(!Auth::user()->isFavourite($profile->user->id))
										  <button type="button" class="btn btn-default btn-xs add-favourite-btn" data-user-id="{{ $profile->user->id }}"><i class="fa fa-star fa-2 text-warning"></i> {{ t('addasfavorite') }}</button>
										  @else
										  <button type="button" class="btn btn-default btn-xs unfavourite-btn" data-user-id="{{ $profile->user->id }}"><i class="fa fa-times-circle-o fa-2 text-danger"></i> {{ t('unfavorite') }}</button>
										  @endif
										  <div class="btn-group">
											  <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
												or<span class="caret"></span>
											  </button>
											  <ul class="dropdown-menu" role="menu">
												<!-- <li><a href="javascript:;" class="give-gift-btn"><i class="fa fa-gift fa-2 text-danger"></i> Give a Gift</a></li> -->
												@if(!Auth::user()->iBlocked($profile->user->id))
												<li><a href="javascript:;" class="block-btn" data-user-id="{{ $profile->user->id }}"><i class="fa fa-minus-circle fa-2 text-danger"></i> {{ t('block') }}</a></li>
												@else
												<li><a href="javascript:;" class="unblock-btn" data-user-id="{{ $profile->user->id }}"><i class="fa fa-plus-circle fa-2 text-danger"></i> {{ t('unblock') }}</a></li>
												@endif
												<li><a href="javascript:;" class="report-abuse-btn" data-user-id="{{ $profile->user->id }}" data-username="{{ $profile->user->name }}"><i class="fa fa-exclamation-triangle fa-2 text-danger"></i> {{ t('reportabuse') }}</a></li>
											  </ul>
											</div>
										</div>
										@else
										{{ Form::open('/user/update_profile', 'POST', array('id'=>'editProfileForm' )) }}
										<input type="submit" id="save-changes-btn" class="btn btn-small btn-primary btn-xs" value="Save Changes" />
										@endif

									@endif
									</div>
									
							</div>
							
							
							<div class="row">
							

      								<div class="col-md-12 top-buffer">

										<div class="row">
											<div class="col-md-5">

												<div class="row">
												<div class="col-md-12">
												<div class="alert alert-success" style="text-align: center;">

												@if(Auth::guest())

													{{ t('wants') }} {{ $whyamihere }}
												@else


												@if($profile->user->id != Auth::user()->id)
												{{ t('wants') }} {{ $whyamihere }}
												@else
												{{ t('iamhereto') }} {{ Form::select('whyamihere', Profile::profile_fields("whyamihere"), "$profile->whyamihere") }}
												@endif

												@endif
												</div>
												</div>
												</div>

												<div class="row">
												<div class="col-md-12">
												<img class="img-responsive" src="{{ $profile->user->mediumPhoto() }}">
												</div>
												</div>
												
												<div class="row">

												@if(!Auth::guest())

												@if($profile->user->id == Auth::user()->id)
												<div class="col-md-5 col-md-offset-3 top-buffer">
												
												<button id="set-profile-picture-btn" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#uploadPhoto">{{ t('changeprofilepicture') }}</button>
												
																<div class="modal fade" id="uploadPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																  <div class="modal-dialog">
																	<div class="modal-content">
																	  <div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																		<h4 class="modal-title" id="myModalLabel">{{ t('uploadphoto') }}</h4>
																	  </div>
																	  <div class="modal-body">
																			
																			<div class="alert alert-danger upload-error" style="display:none" id="nofile-error">{{ t('pleaseselectfile') }}</div>
																			<div class="alert alert-danger upload-error" style="display:none" id="type-error">{{ t('imagetypeerror') }}</div>
																			<div class="alert alert-danger upload-error" style="display:none" id="size-error">{{ t('imagesizeerror') }}</div>
																			<div class="alert alert-danger upload-error" style="display:none" id="dimension-error">{{ t('imagepixelerror') }}</div>
																			<div class="alert alert-danger upload-error" style="display:none" id="other-error">{{ t('somethingwrong') }}</div>
														
																			
													
													
																						<div class="panel-group" id="accordion">
																						  <div class="panel panel-default">
																							<div class="panel-heading">
																							  <h4 class="panel-title">
																								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
																								  {{ t('uploadfromcomputer') }}
																								</a>
																							  </h4>
																							</div>
																							<div id="collapseOne" class="panel-collapse collapse in">
																							  <div class="panel-body">
																								{{ Form::file('photo', array("title"=>'Choose your file', "id"=>"photo")) }}
																							  </div>
																							</div>
																						  </div>
																						  <div class="panel panel-default">
																							<div class="panel-heading">
																							  <h4 class="panel-title">
																								<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" onclick="masonryImageSelect();">
																								  {{ t('selectfromalbum') }}
																								</a>
																							  </h4>
																							</div>
																							<div id="collapseTwo" class="panel-collapse collapse">
																							  <div class="panel-body">
																							  		<select id="user-photo-select" class="image-picker masonry show-html" >
																							  		<option value=""></option>
																									@forelse(Auth::user()->photos() as $photo)
																									 <option data-img-src="{{ $photo->thumbnail() }}" value="{{ $photo->photo_id }}"></option>
																									
																									@empty
																									
																									@endforelse
																									</select>
																							  </div>
																							</div>
																						  </div>
																						  
																						</div>
												
													
																	  </div>
																	  <div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">{{ t('close') }}</button>
																		<button id="submit-btn" class="btn btn-primary">{{ t('upload') }}</button>
																	
																	  </div>
																	</div><!-- /.modal-content -->
																  </div><!-- /.modal-dialog -->
																</div><!-- /.modal -->
												
												</div>
												@endif
												
												@if($profile->user->id != Auth::user()->id)
												
												<div class="col-md-12 col-md-offset-3 top-buffer">
												
													<button class="btn btn-warning" id="give-gift-btn" data-toggle="modal" data-target="#giveGiftModal" onclick="setTimeout(masonryImageSelect, 200);"><i class="fa fa-gift"></i> {{ t('givegift') }}</button>
													
													
																<div class="modal fade" id="giveGiftModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																  <div class="modal-dialog">
																	<div class="modal-content">
																	  <div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																		<h4 class="modal-title" >{{ t('sendagift') }}</h4>
																	  </div>
																	  <div class="modal-body" >
														
																					<div class="alert alert-danger gift-error" style="display:none" id="selectgift-error">{{ t('pleaseselectgift') }}</div>
																					<div class="alert alert-danger gift-error" style="display:none" id="giftbalance-error">{{ t('balancelow') }}. {{ t('yourbalanceis') }} {{ Auth::user()->credits() }}</div>
																					
																							  		<select  id="gift-select" class="image-picker masonry show-html show-labels" >
																							  		<option value=""></option>
																									@forelse(Gift::all() as $gift)
																									
																									 <option data-img-label="{{ t('cost') }} : {{ $gift->show_price() }}" data-img-src="{{ $gift->iconUrl() }}" value="{{ $gift->id }}">{{ t('cost') }} : {{ $gift->show_price() }}</option>
																									 
																									
																									
																									@empty
																										{{ t('nogiftsavailable') }}
																									@endforelse
																									 </select> 
																				
												
													
																	  </div>
																	  <div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">{{ t('close') }}</button>
																		<button id="gift-submit-btn" class="btn btn-primary">{{ t('send') }}</button>
																	
																	  </div>
																	</div><!-- /.modal-content -->
																  </div><!-- /.modal-dialog -->
																</div><!-- /.modal -->



														
												
												</div>
												
												@endif
												
												
												<div class="col-md-12  top-buffer">
													<h4 class="profile-heading">{{ t('giftsireceived') }}</h4>
														<div class="row">
													@forelse($profile->user->gifts_received() as $gift)
													
														<div class="col-md-12">
														<img class="user_interaction user_gift" src="{{ $gift->iconUrl() }}" style="height: 50px; width: 50px;margin: 10px;" data-gift-id="{{ $gift->ug_id }}" title="{{ t('giftedby') }} {{ $gift->from_username }}"/>
														</div>
													@empty
													
													<p style="margin:10px;">{{ t('none') }}</p>
													
													@endforelse
														</div>
													
													
												
												</div>

												<div class="modal fade" id="removeGiftModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">{{t('removegift')}}?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ t('close') }}</button>
        <button type="button" id="remove-gift-btn" class="btn btn-primary">{{ t('remove') }}</button>
      </div>
    </div>
  </div>
</div>





												@endif
												
												
												</div>		
										


											</div>


											<div class="col-md-7">
											
													<div class="row">
													<div class="col-md-12">
															<h5 class="profile-heading">{{ t('location') }}:
																@if(!Auth::guest())
															@if($profile->user->id == Auth::user()->id) 
															  <input type="text" id="city" name="city" value="{{ $profile->user->city }}" /> <button id="update_current_location" class="btn btn-warning btn-xs">{{ t('updatetocurrentlocation') }}</button>
															   @else <small id="current_location">{{ $profile->user->city }}</small> 
															    @endif
															    @else

															    	<small id="current_location">{{ $profile->user->city }}</small> 

															    @endif
															</h5>
															
															@if(!Auth::guest())
															 @if($profile->user->id == Auth::user()->id)
															 	<div id="change_location">
															 	
															 	<input type="hidden" id="country" name="country" value="{{ $profile->user->country }}" />
															 	<input type="hidden" id="lat" name="lat" value="{{ $profile->user->lat }}" />
															 	<input type="hidden" id="lng" name="lng" value="{{ $profile->user->lng }}" />
															 	<div id="map-canvas" class="col-md-12" style="height:300px;"> </div>
															 	
															 	</div>
															 @else
															 <img class="img-responsive" id="current_user_map" src="http://maps.googleapis.com/maps/api/staticmap?size=500x300&zoom=11&markers=size:mid%7Ccolor:red%7C{{$profile->user->lat}},{{$profile->user->lng}}&sensor=false" />
															 @endif

															 @else

															  <img class="img-responsive" id="current_user_map" src="http://maps.googleapis.com/maps/api/staticmap?size=500x300&zoom=11&markers=size:mid%7Ccolor:red%7C{{$profile->user->lat}},{{$profile->user->lng}}&sensor=false" />


															 @endif
															
															

													</div>
													</div>

							
													<div class="row">
													<div class="col-md-12">
															<h5 class="profile-heading">{{ t('interests') }}</h5>
															<div class="row">
																<div class="col-md-12">

																	@if(!Auth::guest())

																	 @if($profile->user->id == Auth::user()->id)
																		<input id="interests" type="text" />
																		<button type="button" id="add-interest-btn" class="btn btn-warning btn-xs">{{ t('addinterest') }}</button>
																		
																		
																		
																									
																<div class="modal fade" id="addInterestModal" tabindex="-1" role="dialog"  aria-hidden="true">
																  <div class="modal-dialog">
																	<div class="modal-content">
																	  <div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																		<h4 class="modal-title">{{ t('addinterest') }} <span id="new-interest-label"></span></h4>
																	  </div>
																	  <div class="modal-body">
																			
																			<label>{{ t("selectcategory") }}</label>
																			{{ Form::select('interest_category', InterestCategory::lists('name','code'), null ,array('id'=>'interests_category')) }}
																	
													
													
																					
												
													
																	  </div>
																	  <div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">{{ t('close') }}</button>
																		<button id="add-new-interest-btn" class="btn btn-primary">{{ t('add') }}</button>
																	
																	  </div>
																	</div><!-- /.modal-content -->
																  </div><!-- /.modal-dialog -->
																</div><!-- /.modal -->
												
																		
																		
																		
																		
																		
																	@endif

																	@endif
																</div>
															</div>
															<div class="row top-buffer">
																<div class="col-md-12">
																
																@foreach($profile->user->interests() as $interest)
																	
																	@if(!Auth::guest())

																	@if($profile->user->id == Auth::user()->id)
																	
																	            <button type="button" class="btn btn-labeled btn-primary user-interest-del" data-interest-id="{{ $interest->id }}">
                											<span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>{{ $interest->interest }}</button>
																		
																	@else
																	
															<span class="label label-primary interest">{{ $interest->interest }}</span>
															
																	@endif

																	@else

																	<span class="label label-primary interest">{{ $interest->interest }}</span>

																	@endif
																@endforeach

																</div>
															</div>

													</div>
													</div>
							

													<div class="row">
													<div class="col-md-12">
															<h5 class="profile-heading">{{ t('aboutme') }}</h5>
															<small class="text-muted">
															
															

															 @if(Auth::guest() || ($profile->user->id != Auth::user()->id))
																@if($profile->aboutme != null)
																	{{$profile->aboutme}}
																@else
																	{{ t('willreveallater')}}
																@endif
															@else
																<textarea class="col-md-12" rows="3" name="aboutme">{{ $profile->aboutme  }}</textarea>
															@endif
															
															</small>

													</div>
													</div>

													<div class="row">
													<div class="col-md-12">
															<h5 class="profile-heading">{{ t('interestedin') }}</h5>
															<small class="text-muted">
															 @if(Auth::guest() || ($profile->user->id != Auth::user()->id))
																@if($profile->interestedin != null)
																{{$profile->interestedin}}
																@else
																{{ t('willreveallater')}}
																@endif
															@else
																<textarea class="col-md-12" rows="3" name="interestedin">{{ $profile->interestedin  }}</textarea>
															@endif
															
															
															
															
															
															
															</small>

													</div>
													</div>

													<div class="row">
													<div class="col-md-12">
													<h5 class="profile-heading">{{ t('personalinfo') }}</h5>
													<div class="panel panel-default">
														  <!-- Default panel contents -->


														  <!-- Table -->
														 
														  <table class="table table-striped table-bordered table-advance table-hover">
																		<tbody>
																			<tr>
																				<td> {{ t('relationshipstatus') }} </td>
																				<td>
																				 @if(Auth::guest() || ($profile->user->id != Auth::user()->id))
																					@if( $relationshipStatus)
																						{{ $relationshipStatus }} 
																					@else
																						{{ t('single') }}
																					@endif
																				@else
																					{{ Form::select('relationship', Profile::profile_fields("relationshipStatus"), "$profile->relationshipstatus") }}
																				@endif
																				</td>
							   
																			</tr>

																			<tr>
																				<td>{{ t('bodytype') }} </td>
																				<td>
																				 @if(Auth::guest() || ($profile->user->id != Auth::user()->id))
																					@if( $bodyType )
																						{{ $bodyType }} 
																					@else
																						<center>-</center>
																					@endif
																				@else
																					{{ Form::select('bodyType',  Profile::profile_fields("bodyType"), "$profile->bodytype") }}
																				@endif
																				</td>
																			</tr>

																			<tr>
																				<td> {{ t('haircolor') }}</td>
																				<td>
																				 @if(Auth::guest() || ($profile->user->id != Auth::user()->id))
																					@if( $hairColor)
																						{{ $hairColor }} 
																					@else
																						<center>-</center>
																					@endif
																				@else
																					{{ Form::select('hairColor',  Profile::profile_fields("hairColor"), "$profile->haircolor") }}
																				@endif
																				</td>
																			</tr>

																			<tr>
																				<td> {{ t('eyecolor') }}</td>
																				<td>
																				 @if(Auth::guest() || ($profile->user->id != Auth::user()->id))
																					@if($eyeColor)
																						{{ $eyeColor }} 
																					@else
																						<center>-</center>
																					@endif
																				@else
																					{{ Form::select('eyeColor',  Profile::profile_fields("eyeColor"), "$profile->eyecolor") }}
																				@endif
																				</td>				   
																			</tr>
										
																			<tr>
																				<td>{{ t('living') }}</td>
																				<td>
																				@if(Auth::guest() || ($profile->user->id != Auth::user()->id))
																					@if( $living )
																						{{ $living }} 
																					@else
																						<center>-</center>
																					@endif
																				@else	
																					{{ Form::select('living', Profile::profile_fields("living"), "$profile->living") }}
																				@endif
																				</td>						   
																			</tr>   
										
																			<tr>
																				<td>{{ t('children') }}</td>
																				<td>
																				@if(Auth::guest() || ($profile->user->id != Auth::user()->id))
																					@if($children)
																						{{ $children }}
																					@else
																						 <center>-</center>
																					@endif
																				@else
																					{{ Form::select('children',  Profile::profile_fields("children"), "$profile->children") }}
																				@endif
																				</td>
																			</tr>



																			<tr>
																				<td>{{ t('smoking') }}</td>
																				<td>
																				@if(Auth::guest() || ($profile->user->id != Auth::user()->id))
																					@if($smoking)
																						{{ $smoking }} 
																					@else
																						<center>-</center>
																					@endif
																				@else
																					{{ Form::select('smoking',  Profile::profile_fields("smoking"), "$profile->smoking") }}
																				@endif
																				</td>
																   
																			</tr>

																		   <tr>
																				<td>{{ t('drinking') }}</td>
																				<td>
																				@if(Auth::guest() || ($profile->user->id != Auth::user()->id))
																					@if($drinking)
																						{{ $drinking }} 
																					@else
																						<center>-</center>
																					@endif
																				@else
																					{{ Form::select('drinking', Profile::profile_fields("drinking"), "$profile->drinking") }}
																				@endif
																				</td>
																			</tr>

																			<tr>
																				<td>{{ t('education') }}</td>
																				<td>
																				@if(Auth::guest() || ($profile->user->id != Auth::user()->id))
																					@if($education)
																						{{ $education }} 
																					@else
																						<center>-</center>
																					@endif
																				@else
																					{{ Form::select('education',  Profile::profile_fields("education"), "$profile->education") }}
																				@endif
																				</td>
																   		
																			</tr>
																		</tbody>
																	</table>
																	@if(!Auth::guest())
																@if($profile->user->id == Auth::user()->id)
																	{{ Form::close() }}
																@endif
																@endif
														</div>
													</div>
													</div>

      											</div>
										</div>




									</div>

							
							</div>
							
							
						</div>
						
						
						
						

@endsection


@section('scripts')

<script src="{{ asset('assets/js/image-picker.min.js') }}"></script>
<script src="{{ asset('assets/js/masonry.js') }}"></script>

<script>

function masonryImageSelect(){

	
	
  var container = jQuery("select.image-picker.masonry").next("ul.thumbnails");
    container.imagesLoaded(function(){
      container.masonry({
        itemSelector:   "li",
      });
    });
    
    setTimeout(function(){
    $("ul.image_picker_selector").css("height","300px");
    }, 200);

}

@if(!Auth::guest())

 @if($profile->user->id == Auth::user()->id)
 
  	var map;
    var geocoder;
    var marker;

      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(-34.397, 150.644),
          zoom: 8
        };
         map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);

         var pos = new google.maps.LatLng({{ Auth::user()->lat }},
                                       {{ Auth::user()->lng }});

         map.setCenter(pos);


	// Create and set the marker
	marker = new google.maps.Marker({
		map: map,
		draggable:true,	
		position: pos
	});

	 var infowindow = new google.maps.InfoWindow({
      content: "<b>{{ t('youarehere') }}</b><p style='font-size:8pt;'>{{ t('dragmappin') }}</p>"
  });

	 infowindow.open(map,marker);
	
	// Register Custom "dragend" Event
	google.maps.event.addListener(marker, 'dragend', function() {
		
		// Get the Current position, where the pointer was dropped
		var point = marker.getPosition();
		// Center the map at given point
		map.panTo(point);
		// Update the textbox
		$("#lat").val(point.lat());
		$("#lng").val(point.lng());
		codeLatLng(point.lat(), point.lng());

		infowindow.setPosition(point);
	});


	google.maps.event.addListener(map, 'idle', function(){

		$(".gm-style-iw").next("div").hide();
	})


      }
      google.maps.event.addDomListener(window, 'load', initialize);
      
      
	function geoCoderInitialize() {
    geocoder = new google.maps.Geocoder();


  	}
  	
  	
  	  function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(setUserPosition);
    
    }
  else{

    }
  }
  
  	
  	function setUserPosition(position)
  {


  $("#lat").val(position.coords.latitude);
   $("#lng").val(position.coords.longitude);
   codeLatLng(position.coords.latitude, position.coords.longitude);

   var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

   marker.setPosition(pos);
    map.setCenter(pos);

	$("#update_current_location").find(':first-child').remove();

  }
  
  function codeLatLng(lat, lng) { 

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {

        if (results[1]) {
         //formatted address
       		console.log(results);
        //find country name
             for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                if (results[0].address_components[i].types[b] == "locality") {
                    //this is the object you are looking for
                    city= results[0].address_components[i];

                   
                }
                else if(results[0].address_components[i].types[b] == "administrative_area_level_2") {
                    //this is the object you are looking for
                    city= results[0].address_components[i];

                   
                }

                 if (results[0].address_components[i].types[b] == "country") {
                    //this is the object you are looking for
                    country= results[0].address_components[i];

                   
                }
            }
        }
        //city data
        $("#city").val(city.long_name);
        $("#country").val(country.long_name);

        } else {
          //alert("No results found");
        }
      } else {
        //alert("Geocoder failed due to: " + status);
   

  }
  
  });
  
  }
  
  
  
  function codeCity(city_name){

 geocoder.geocode({'address': city_name}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {

		var lat,lng;
        if (results[0]) {
        	lat = results[0].geometry.location.lat();
        	lng = results[0].geometry.location.lng();
        	 $("#lat").val(results[0].geometry.location.lat())
        	 $("#lng").val(results[0].geometry.location.lng());
        		 

     }
     else{
     		lat = results.geometry.location.lat();
        	lng = results.geometry.location.lng();
     	   	$("#lat").val(results.geometry.location.lat())
        	 $("#lng").val(results.geometry.location.lng());
     } 
     
     var latlng = new google.maps.LatLng(lat, lng);
     map.setCenter(latlng);
     marker.setPosition(latlng);

 }
 else{
 
 	console.log("Google Maps GeoCoder Not Reachable");
 
 }
});


	}
  
  
  
  
      
 
 $(function(){
 
 	geoCoderInitialize(); 
 	
 	
 	var interest_select = 0;
 	
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
	 		
	 		
	 		
	 		
	 		
	 		 	jQuery("#interests").autocomplete({
			source: function (request, response) {
		
				jQuery("#city").addClass("spinner");
			 	jQuery.getJSON(
					"{{ url('/interests/') }}"+request.term,
					
					function (data) {
						jQuery("#interests").removeClass("spinner");
					 	response(data);
					}
		 		);
		
			},
			
			minLength: 3,
			select: function (event, ui) {

				jQuery("#interests").val(ui.item.value);

				return false;
			},
			
			open: function () {
		 		jQuery(this).removeClass("ui-corner-all").addClass("ui-corner-top");
			},
			change: function(event, ui) {
        if (ui.item) {
            interest_select = 0;
        } else {
            interest_select = 1;
        }
    },
			close: function () {
					

					
		 		jQuery(this).removeClass("ui-corner-top").addClass("ui-corner-all");
			}
	 	});
	 	
	 	jQuery("#interests").autocomplete("option", "delay", 100);
	 	
	 	
	 	$("#add-interest-btn").click(function(){
	 	
	 	
	 		if($("#interests").val() == ''){
	 		
	 		
	 			alert("{{ t('interestsempty') }}");
	 		
	 		
	 		}
	 		else{
	 		
	 			if(interest_select == 1)
	 			{
	 			
	 			$("#new-interest-label").html($("#interests").val());
	 			$("#new_interest").val($("#interests").val());
	 			
	 			$("#addInterestModal").modal('show');
	 			
	 			}
				else{
	 			$.post("{{ url('/add_interest') }}", { interest: $("#interests").val() }, function(){
	 			
	 			
	 						window.location.reload();
	 			
	 			});
	 			
	 			}
	 		
	 		}
	 		
	 	
	 	
	 	});
	 	
	 	
	 	$("#add-new-interest-btn").click(function(){
	 	
	 	$(this).prepend('<i class="fa fa-spinner fa-spin"></i> ');
	 	
	 	$.post("{{ url('/add_new_interest') }}", { category : $("#interests_category").val(), interest: $("#interests").val() }, function(data){
	 				
	 				$("#add-new-interest").find(':first-child').remove();
	 			
	 				window.location.reload();
	 	
	 	
	 	});
	 	
	 	
	 	});
	 	
	 	
	 	
	 	$(".user-interest-del").click(function(){
	 	
	 	$interest_id = $(this).data('interest-id');
	 	
	 	$.post("{{ url('/delete_interest') }}", { interest_id : $interest_id }, function(){
	 	
	 		window.location.reload();
	 	
	 	});
	 	
	 	
	 	});
	 		
	 		
	 		
	 		
	 		
	 		
	 		
	 		
	 		
 			$("#update_current_location").click(function(e){

				e.preventDefault();

				$("#update_current_location").prepend('<i class="fa fa-spinner fa-spin"></i> ');



				getLocation();

			

				});
				
				
			$("#save-changes-btn").click(function(){
			
				$("#save-changes-btn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
			
			
			});
				
		
 	
 });
 


	$(function()
{
	// Variable to store your files
	var files;

	// Add events
	$('#photo').on('change', prepareUpload);
	//$('#uploadPhotoForm').on('submit', uploadFiles);
	
	$("#submit-btn").click(function(e){
	
		 $("#submit-btn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
		e.preventDefault();
		
		if(!files)
		{
		
			if($("#user-photo-select").val())
			{
			
				$.post('{{ url("/user/set_profile_picture") }}', { photo_id : $("#user-photo-select").val() }, function(data){
				
				
					window.location.reload();
				
				});
			
			}
			else{
			        $("#nofile-error").show();
            		$("#submit-btn").find(':first-child').remove();
            }
		
			return false;
		}
		
		uploadFiles();
	
	});

	// Grab the files and set them to our variable
	function prepareUpload(event)
	{
		files = event.target.files;
		console.log(files);
	}

	// Catch the form submit and upload the files
	function uploadFiles(event)
	{
		
		$(".upload-error").hide();
        // START A LOADING SPINNER HERE
        
       

        // Create a formdata object and add the files
		var data = new FormData();
		$.each(files, function(key, value)
		{


			data.append(key, value);
		});
		

        
        $.ajax({
            url: '{{ url("/upload_photo/profile_picture") }}',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(data, textStatus, jqXHR)
            {
            	
				console.log(data);
            	if(typeof data.errors === 'undefined')
            	{
					
            		submitForm(event, data);
            	}
            	else if(data.errors == "type")
            	{
            	
            		$("#type-error").show();
            		$("#submit-btn").find(':first-child').remove();
            		
            	} 
            	else if(data.errors == "size")
            	{
            	
            		$("#size-error").show();
            		$("#submit-btn").find(':first-child').remove();
            		
            	} 
            	else if(data.errors == "dimension")
            	{
            	
            		$("#dimension-error").show();
            		$("#submit-btn").find(':first-child').remove();
            		
            	} 
            	
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            
     
            		$("#other-error").show();
            		$("#submit-btn").find(':first-child').remove();
            
            	// STOP LOADING SPINNER
            }
        });
    }

    function submitForm(event, data)
	{
		$('#uploadPhoto').modal('hide');
		$("#submit-btn").find(':first-child').remove();
		window.location.reload();
	
	}
	
	$("#user-photo-select").imagepicker();
	

    
    
     $("#city").click(function() { 


	$(this).select(); 

} );
    
    
	
});





 
 @endif

 @endif


</script>


<script>

$(function(){

$("#gift-select").imagepicker({ show_label : true });



$(".gifts-popover").popover();

@if($profile->user->id == Auth::user()->id)

$(".user_gift").click(function(){


	$("#remove-gift-btn").data('gift-id', $(this).data('gift-id'));
	$("#removeGiftModal").modal("show");

});

$("#remove-gift-btn").click(function(){

	$.post("{{ url('/remove_gift') }}" , { gift_id : $(this).data('gift-id') },function(data){
			
				data = JSON.parse(data);
				
				if(data.success)
				{
				
					$("#removeGiftModal").modal("hide");
					location.reload();
				
				}
				
				if(data.error){
				
				
					alert("There was some error");
					
				
				}
				
			
			});



	

});

@endif



$("#gift-submit-btn").click(function(){

			$(".gift-error").hide();

			if($("#gift-select").val())
			{
			
			
	

			$.post("{{ url('/send_gift') }}" , { gift_id : $("#gift-select").val(), to_user: '{{ $profile->user->id }}' } ,function(data){
			
				data = JSON.parse(data);
				
				if(data.success)
				{
				
					$("#giveGiftModal").modal('hide');
					location.reload();
				
				}
				
				if(data.error){
				
				
					$("#giftbalance-error").show();
					
				
				}
				
			
			});
			
			}
			else{
			
			$("#selectgift-error").show();
			
			}


});


});

</script>

@endsection