<!DOCTYPE html>
<html>
	<head>

@include('meta')

@include('styles')
			   
			   <style>
			   
			   			

.vertical-offset-100{
    padding-top:100px;
}




.lightbox{
padding: 13px 20px 22px 20px;
background: rgba(255,255,255,.2);
border-radius: 5px;
color: #FFF;
}

body{

background-color: #000;

}

.help-inline {

color: #cc2222;

}


footer{

background-color: #000;

}


.container-full {
  margin: 0 auto;
  width: 100%;
  padding: 50px;
}


.container-full .row {

	margin-left: 0px;
	margin-right: 0px;

}

nav{

margin:0px;

}

.navbar {

margin: 0px;

}


			   
			   </style>
   
	</head>
	<body>
		<div id="black_screen"></div>
		<div id="wrap">
				<nav class="navbar navbar-default navbar-static-top" style="background-color: #EDEFF3;" role="navigation">
		        <!-- Brand and toggle get grouped for better mobile display -->
		        	<div class="container">
				        <div class="navbar-header">
				          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-nav">
				            <span class="sr-only">Toggle navigation</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				          </button>
				          <a class="navbar-brand" href="#">{{ app_logo() }}</a>
				        </div>
				        
				        
							 <div class="collapse navbar-collapse pull-right" id="top-nav">
				          		<ul class="nav navbar-nav" style="height: 43px;">

				          			<li style="margin-top:10px">{{ t('alreadymember') }} <button class="btn btn-danger btn-xs" onclick="window.location.href = '{{ URL::to('signin') }}'">{{ t('signin') }}</button></li>
				          			
				       			</ul>
				       				
				       		</div>
				       			 
				            
		
				       
				    </div>
		      </nav>
		
				<div class="container-full" style="margin: 0px;background-color: #000;background-image: url({{ frontpage_bg() }});background-size: cover;box-shadow: inset 0 0 200px #000000;">
			    <div class="row">
			    
					<div class="col-md-4" style="color:#FFF;text-shadow: 1px 1px #000;">
						<h1>{{ t('welcometo') }} <span class="text-primary">{{ s('title') }}</span></h1>
						<p class="lead">{{ t('welcomemessage') }}</p>
					</div>
					
					<div class="col-md-6 col-md-offset-2">
						<div class="lightbox">
								<div class="row" style="margin-bottom:10px;">
								<div class="col-md-5">
								<h4>{{ t('newto') }} {{ s('title') }}? {{ t('signup') }}</h4>
								</div>
								<div class="col-md-5">
								<a href="{{ url('/facebook_login') }}" class="btn btn-primary btn-lg" /><i class="fa fa-facebook fa-2"></i> {{ t('signinwith') }} Facebook</a>
								</div>
								</div>
								
								@include('home.forms.register_form')
								
						</div>
					</div>
					
				

				</div>
				</div>
				
				<!--
				<div class="container">

						<div class="row top-buffer">
						  <div class="col-md-4">
						
						  <img class="img-responsive" src="assets/images/matches.png" style="height:150px;width:200px;" />
				
							<h4>Matches</h4>
							<p>Play our popular Encounters game to get matched with other users. It’s a great way to break the ice and start chatting!</p>
							<p><a class="btn btn-primary" href="#">View details »</a></p>
						  </div>

						  <div class="col-md-4">
						
						  <img class="img-responsive" src="assets/images/mapicon.png" style="height:156px;width:156px;text-align:center;" />
					
							<h4>People nearby</h4>
							<p>{{ s('title') }} won’t show your exact location, but will allow you to find people nearby who share common interests.</p>
							<p><a class="btn btn-primary" href="#">View details »</a></p>
						  </div>

						  <div class="col-md-4">
						
						  <img class="img-responsive" src="assets/images/interests.png" style="height:156px;width:156px;" />
						 
							<h4>Share interests</h4>
							<p>Increase your chances of being discovered and meeting other people with similar interests.</p>
							<p><a class="btn btn-primary" href="#">View details »</a></p>
						  </div>
						</div><!-- .row -->


 				 </div>
 				 -->


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
	 	
	 	
	 	    $("#email").focusout(function(e){
	    	$("#register-form").find('.help-inline').remove();
	    	$("#control-email").removeClass("has-error");
	    	if($("#email").val()){
	 			if(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test($("#email").val())  ) {  
	    			$("#control-email").removeClass("has-error");
				    $.get("{{ URL::to('ajax/check_email') }}", { email: $("#email").val()}, function(data){
				    	
				    	if(data == 0) {
				    		email_set = 1;
			    			$("#control-email").addClass("has-error");
			    			$("#email").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("emailerror") }}</label>');
			    		} else {
			    			$("#email").parent().append('<label for="fullname" class="help-inline help-small no-left-padding" style="color:green;">{{ t("available") }}</label>');
			    			email_set = 0;
			    		}
    				});
    			}
    			else{
    				
    				$("#control-email").addClass("has-error");
	 				$("#email").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("invalidemail") }}</label>');
	 				email_set = 1;
    			
    			
    			}
    		}
    	});
	 	
	 	
	 	
	 		$("#register-submit-btn").click(function(e){
	 		
	 		flag = 0;
 		
	 		var label = '<label for="fullname" class="help-inline help-small no-left-padding">{{ t("fieldrequired") }}</label>';
	 		
	 		e.preventDefault();
			$("#register-form").find('.help-inline').remove();
	 	
	 		if($("#name").val()) {
	 			if(/^[a-zA-Z ]*$/.test($("#name").val())) {
	 				$("#control-name").removeClass("has-error");
	 			} else {
	 				$("#control-name").addClass("has-error");
	 				$("#name").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("nospecialcharacters") }}</label>');
	 				flag = 1;	
	 			}
	 		} else{
	 			$("#control-name").addClass("has-error");
	 			$("#name").parent().append(label);
				flag = 1;
	 		}
 		
	 		if($("#email").val()){
	 			if(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test($("#email").val())  ) {  
	 				$("#control-email").removeClass("has-error");
	 			} else {
	 				$("#control-email").addClass("has-error");
	 				$("#email").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("invalidemail") }}</label>');
	 				flag = 1;
	 			}
	 		} else{
	 			$("#control-email").addClass("has-error");
	 			$("#email").parent().append(label);
	 			flag = 1;
	 		}
	 		
	 		if($("#confirm_password").val()) {
	 			if($("#confirm_password").val() == $("#password").val()) {
	 				$("#control-confirm-password").removeClass("has-error");
	 			} else {
	 				$("#control-confirm-password").addClass("has-error");
	 				$("#confirm_password").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("passwordsnomatch") }}</label>');
	 				flag = 1;	
	 			}
	 		} else{
	 			$("#control-confirm-password").addClass("has-error");
	 			$("#confirm_password").parent().append(label);
	 			flag = 1;
	 		}

 		
	 		if($("#city").val()) {
	 			$("#control-city").removeClass("has-error");
	 		} else{
	 			$("#control-city").addClass("has-error");
	 			$("#city").parent().append(label);
	 			flag = 1;
	 		}
	 		

 		
	 		if($("#password").val()) {
	 			if($("#password").val().length >= 6){
	 				$("#control-password").removeClass("has-error");
	 			} else {
	 				$("#control-password").addClass("has-error");
	 				$("#password").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("passwordminimum") }}</label>');
	 				flag = 1;
	 			}
	 		} else{
	 			$("#control-password").addClass("has-error");
	 			$("#password").parent().append(label);
	 			flag = 1;
 			}
 		
 		
	 		if(flag == 0 && email_set == 0) {
	 			
	 			$("#register-form").submit();
	 		}
	 	
 		})
	 	
	
	 	
	 	

});

</script>
	
  
	</body>
</html>