<!DOCTYPE html>
<html>
	<head>

@include('meta')


@include('styles')
   
   
   <style>
   
   .container{
   
   width: 640px;
   
   }
   
   </style>
   
	</head>
	<body>
		<div id="black_screen"></div>
		<div id="wrap">
		<nav class="navbar navbar-default navbar-static-top" role="navigation">
		        <!-- Brand and toggle get grouped for better mobile display -->
		        	<div class="container">
		        		 <div class="navbar-header">
				          <a class="navbar-brand" href="#">{{ app_logo() }}</a>
				        </div>
		        	</div>
		</nav>
		
			    <div class="container" style="margin-top:5px;">

					<div class="row">
					
					<div class="col-md-12 border-div" style="text-align: center;padding-bottom: 50px;">
					
						<h4 class="profile-heading">Facebook <i class="fa fa-arrows-h"></i> {{ s('title') }}</h4>
						<p>
									<div class="progress progress-striped active">
  <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
    <span class="sr-only">50% {{ t('complete') }}</span>
  </div>
</div>
						</p>
						<p>

						
						</p>
						<p class="lead small">
						{{ t('hello') }} {{ Session::get('name') }}, {{ t('enterlocationdetails') }}
						
						</p>
						
						<p>
							{{ Form::open('/facebook_complete', 'POST', array("id" => "facebookCompleteForm")) }}
							
										  <div class="form-group" id="control-city" >
												
												
												  <input type="text" class="form-control input-sm" id="city" name="city" placeholder="{{ t('city') }}">
												  <input type="hidden" name="lat" id="lat" value="" />
												  <input type="hidden" name="lng" id="lng" value="" />
												   <input type="hidden" name="country" id="country" value="" />
												  
												
											  </div>
											  
											  <p>
											  
											  	<button id="register-submit-btn" class="btn btn-success btn-xs">{{ t('yesmylocation') }}</button>
											  
											  </p>
							
							{{ Form::close() }}
						
						</p>
						
					
					</div>
					
					</div>
			
				</div>
		
		</div>







@include('footer')

@include('scripts')


<script>
var geocoder;

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

  }

   function geoCoderInitialize() {
    geocoder = new google.maps.Geocoder();


  }

  function codeLatLng(lat, lng) { 

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {

        if (results[1]) {
         //formatted address
       
        //find country name
             for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                if (results[0].address_components[i].types[b] == "locality") {
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
			getLocation();
			var flag = 0;
    		var email_set = 0;


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
	 	
	 	

	 	
	 	
	 	
	 		
	 		
	 		
	 		$("#register-submit-btn").click(function(e){
	 		
	 		flag = 0;
 		
	 		var label = '<label for="fullname" class="help-inline help-small no-left-padding">{{ t("fieldrequired") }}</label>';
	 		
	 		e.preventDefault();
			$("#register-form").find('.help-inline').remove();
	 	
	

 		
	 		if($("#city").val()) {
	 			$("#control-city").removeClass("has-error");
	 		} else{
	 			$("#control-city").addClass("has-error");
	 			$("#city").parent().append(label);
	 			flag = 1;
	 		}
	 		

 	
 		
 		
	 		if(flag == 0 && email_set == 0) {
	 			
	 			$("#facebookCompleteForm").submit();
	 		}
	 		
	 		

	 		
	 		
 		});
 		
 	
	 	
	 	
	 	
	 	
	 	

});

</script>

    

	</body>
</html>