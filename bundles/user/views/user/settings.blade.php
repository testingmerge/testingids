@layout('pageshell')



@section('content')

<div class="row">

    <div class="col-md-3">
      	<nav class="nav-sidebar">
            <ul class="nav">
                <li class="active" id="account_link"><a href="javascript:;">Account</a></li>
                <!-- <li  id="profile_link"><a href="{{url('/profile')}}">Profile</a></li> -->
                <li id="privacy_link"><a href="javascript:;">Privacy</a></li>
		<li id="emails_link"><a href="javascript:;">Email notifications</a></li>
               <!--  <li id="notification_link"><a href="javascript:;">Notification</a></li> -->
            </ul>
        </nav>
   	</div>

    
	    <div class="col-md-8 border-div" id="account">
	      	<div class="row">
	      		<div class="col-md-12">
	      			<h3 class="profile-heading">{{ t('accountsettings') }}</h3>
	      		</div>
	      	</div>
	      			
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="panel panel-default">
						<div class="panel-heading"><strong>{{ t('changeemail') }}</strong></div>
						<div class="panel-body">
							<form class="form-horizontal" id="settingEmailForm"  accept-charset="UTF-8">							
								<div class="control-group" id="control-email">
									<label class="control-label">{{ t('email') }} </label>
									<div class="controls">
										<input type="text" class="m-wrap" name="email" id="email" value="{{$email}}">
									</div>
								</div>
								
								<div class="control-group" id="control-email-pwd">
									<label class="control-label">{{ t('password') }}</label>
									<div class="controls">
										<input type="password" class="m-wrap" name="changeEmailPwd" id="changeEmailPwd" value="">
									</div>
								</div>
										
								<div class="control-group top-buffer">
									<button type="button" class="btn btn-default" id="emailBtn">{{ t('submit') }}</button>
								</div>
							</form>
						</div>
					</div>
	      		</div>
	      	</div>

	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="panel panel-default">
						<div class="panel-heading"><strong>{{ t('changepassword') }}</strong></div>
						<div class="panel-body">
							    				
							<form class="form-horizontal" id="settingPasswordForm" method="POST" accept-charset="UTF-8">							
								<div class="control-group" id="control-new-pwd">
									<label class="control-label">{{ t('newpassword') }}</label>
									<div class="controls">
										<input type="password" class="m-wrap" name="newpassword" id="newpassword" value="">
									</div>
								</div>
										
								<div class="control-group" id="control-confirm-pwd">
									<label class="control-label">{{ t('confirmpassword') }}</label>
									<div class="controls">
										<input type="password" class="m-wrap" name="confirmpassword" id="confirmpassword" value="">
									</div>
								</div>
										
								<div class="control-group" id="control-old-pwd">
									<label class="control-label">{{ t('oldpassword') }}</label>
									<div class="controls">
										<input type="password" class="m-wrap" name="oldpassword" id="oldpassword" value="">
									</div>
								</div>
										
								<div class="control-group top-buffer">
									<button type="button" class="btn btn-default" id="pwdBtn">{{ t('submit') }}</button>
								</div>
							<!-- END FORM--> 
							</form>
						</div>
					</div>
	      		</div>
	      	</div>


	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="panel panel-default">
						<div class="panel-heading"><strong>{{ t('deactivateaccount') }}</strong></div>
						<div class="panel-body">
							<form class="form-horizontal" method="POST" action="{{ url('/user/deactivate') }}"  accept-charset="UTF-8">							
								{{ t('deactivatedetails')}}
										
								<div class="control-group top-buffer">
									<button type="submit" class="btn btn-danger" >{{ t('deactivate') }}</button>
								</div>
							</form>
						</div>
					</div>
	      		</div>
	      	</div>




		</div>
	
		<div class="col-md-8 border-div" id="privacy" style="display:none;">
	      	<div class="row">
	      		<div class="col-md-12">
	      			<h3 class="profile-heading">{{ t('privacysettings') }}</h3>
	      		</div>
	      	</div>
	      			
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="panel panel-default">
						<div class="panel-heading"><strong>{{ t('visibility') }}</strong></div>
						<div class="panel-body">
							<form class="form-horizontal" id="settingVisibleForm" method="POST"  accept-charset="UTF-8">							
								<div class="checkbox">
									<label>
										{{ Form::checkbox('show_me_offline', $offline, $offline) }}{{ t('alwaysshowmeoffline') }}
									</label>
								</div>
								
								<div class="checkbox">
									<label>
										{{ Form::checkbox('hide_from_search',$publicSearch, $publicSearch) }}{{ t('hideprofilefromsearchengine') }}
									</label>
								</div>
										
								<div class="control-group top-buffer">
									<button type="button" class="btn btn-default" id="visibilityBtn">{{ t('submit') }}</button>
								</div>
							</form>
						</div>
					</div>
	      		</div>
	      	</div>
		</div>

		<div class="col-md-8 border-div" id="email_notifications" style="display:none;">
	      	<div class="row">
	      		<div class="col-md-12">
	      			<h3 class="profile-heading">{{ t('emailnotificationsettings') }}</h3>
	      		</div>

	      	</div>
	      			
	      	<div class="row">
	      		<div class="col-md-12">

	      			<div class="panel panel-default">
						<div class="panel-heading"><strong>{{ t('changesettings') }}</strong></div>
						<div class="panel-body">
							<form class="form-horizontal" id="settingEmailForm" method="POST" accept-charset="UTF-8">							

								<div class="checkbox">
									<label>
										{{ Form::checkbox('profile_visitor', $profile_visitor, $profile_visitor) }} {{ t("whenuservisitsaprofile")}}
									</label>

								</div>
								
								<div class="checkbox">
									<label>

										{{ Form::checkbox('add_contact', $add_contact, $add_contact) }} {{ t('whenuseraddscontact')}}
									</label>
								</div>

								<div class="checkbox">
									<label>

										{{ Form::checkbox('meet_me', $meet_me, $meet_me) }} {{ t("whensomeonemeetsme") }}
									</label>
								</div>

								<div class="checkbox">
									<label>
										{{ Form::checkbox('message_sent', $message_sent, $message_sent) }} {{ t("whensomeonemessagesme")}}
									</label>

								</div>
								
								<div class="checkbox">
									<label>

										{{ Form::checkbox('photo_rated', $photo_rated, $photo_rated) }} {{ t("whensomeoneratesmyphoto")}}
									</label>
								</div>

								<div class="checkbox">
									<label>

										{{ Form::checkbox('photo_commented', $photo_commented, $photo_commented) }} {{ t('whensomeonecommentsonphoto')}}
									</label>
								</div>

								<div class="checkbox">
									<label>

										{{ Form::checkbox('gift_sent', $gift_sent, $gift_sent) }} {{ t('whensomeonegiftsyou')}}
									</label>
								</div>

								<div class="checkbox">
									<label>

										{{ Form::checkbox('mutual_attraction', $mutual_attraction, $mutual_attraction) }} {{ t('whenyouhaveamutualattraction') }}
									</label>
								</div>											

								<div class="control-group top-buffer">

									<button type="button" class="btn btn-default" id="emailSettingsBtn">{{ t('submit') }}</button>
								</div>
							</form>

						</div>
					</div>
	      		</div>

	      	</div>
		</div>


<!--
		<div class="col-md-8 border-div" id="notifications" style="display:none;">
	      	<div class="row">
	      		<div class="col-md-12">
	      			<h3 class="profile-heading">Notification Settings</h3>
	      		</div>
	      	</div>
	      			
	      	<div class="row">
	      		<div class="col-md-12">
	      			<div class="panel panel-default">
						<div class="panel-heading"><strong>Visiblity</strong></div>
						<div class="panel-body">
							<form class="form-horizontal" id="settingEmailForm" method="POST" action="http://rigolade.minglematic.com/index.php/settings/change_email" accept-charset="UTF-8">							
								<div class="checkbox">
									<label>
										{{ Form::checkbox('guys', '1', 0) }}Always show me offline
									</label>
								</div>
								
								<div class="checkbox">
									<label>
										{{ Form::checkbox('guys', '1', 0) }}Hide my profile from public search engines
									</label>
								</div>
										
								<div class="control-group top-buffer">
									<button type="submit" class="btn btn-default">Submit</button>
								</div>
							</form>
						</div>
					</div>
	      		</div>
	      	</div>
		</div>
		-->
	</div>	
      		

</div>
@endsection
@section("scripts")

<script type="text/javascript">

$(function  () {
	$("#account_link").click(function(){
		$(".active").removeClass("active");
		$("#account_link").addClass("active");
		$("#privacy").hide();
		$("#email_notifications").hide();
		$("#account").show();

	});

	$("#privacy_link").click(function(){

		$(".active").removeClass("active");
		$("#privacy_link").addClass("active");
		$("#privacy").active;
		$("#account").hide();
		$("#email_notifications").hide();
		$("#privacy").show();

	});

	$("#emails_link").click(function(){

		$(".active").removeClass("active");
		$("#emails_link").addClass("active");
		$("#email_notifications").active;
		$("#privacy").hide();
		$("#account").hide();
		$("#email_notifications").show();

	});

	
	$("#emailBtn").click(function(){
		
		$("#emailBtn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
		$("#emailBtn").attr("disabled", true);
		$("#control-email").removeClass("has-error");
	 	$(".help-inline").remove();
	 	$("#control-email-pwd").removeClass("has-error");
		var email_set = 0;
		if($("#email").val() == '' || !(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test($("#email").val())  ) ){
	 		$("#control-email").addClass("has-error");
	 		$("#email").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("invalidemail") }}</label>');
	 		email_set = 1;
	 	} 
    			
		if($("#changeEmailPwd").val() !='' && email_set == 0) {
			$("#control-email-pwd").removeClass("has-error");
			$.post('{{ url("/user/change_email") }}', { old_password : $("#changeEmailPwd").val(), new_email : $("#email").val() }, function(data){
			data = $.parseJSON(data);
			console.log(data);
			if(data.success)
			{
				$("#emailBtn").find(':first-child').remove();
				alert("Email changed successfully");
				window.location.reload();
			}
			if(data.error){
				$("#emailBtn").find(':first-child').remove();
				alert("The password you provided is incorrect.");
			} });
		} else {
			$("#control-email-pwd").addClass("has-error");
	 		$("#changeEmailPwd").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">Invalid password</label>');
		}
		$("#emailBtn").removeAttr("disabled");
		$("#emailBtn").find(':first-child').remove();
	});
	
	$("#pwdBtn").click(function(){
		$("#pwdBtn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
		$("#pwdBtn").attr("disabled", true);
		$("#control-new-pwd").removeClass("has-error");
		$("#control-old-pwd").removeClass("has-error");
		$("#control-confirm-pwd").removeClass("has-error");
	 	$(".help-inline").remove();
		if($("#newpassword").val() == ''){
			$("#control-new-pwd").addClass("has-error");
	 		$("#newpassword").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">Invalid Password</label>');
	 	} else if($("#confirmpassword").val() == '') {  
	 		$("#control-confirm-pwd").addClass("has-error");
	 		$("#confirmpassword").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">Invalid Password</label>');
	 	} else if($("#newpassword").val() != $("#confirmpassword").val()) {
	 		$("#control-confirm-pwd").addClass("has-error");
	 		$("#confirmpassword").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">Passwords not matching</label>');
	 	} else if($("#oldpassword").val() == ''){
    		$("#control-old-pwd").addClass("has-error");
	 		$("#oldpassword").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">Invalid Password</label>');
    	} else {
			$.post('{{ url("/user/change_password") }}', { old_password : $("#oldpassword").val(), new_password : $("#newpassword").val() }, function(data){
	
					data = $.parseJSON(data);
					if(data.success)
					{
						$("#pwdBtn").find(':first-child').remove();
						alert("Pasword changed successfully");
						window.location.reload();
					}
		
					if(data.error){
						$("#pwdBtn").find(':first-child').remove();
						alert("The password you provided is incorrect.");
			
					} 
	
			});
		} 
		$("#pwdBtn").removeAttr("disabled");
		$("#pwdBtn").find(':first-child').remove();
	});
	
	$("#visibilityBtn").click(function(){
	
			
				
				var show_me_offline = $("input[name='show_me_offline']").is(':checked') ? 1 : 0;
				var hide_from_search = $("input[name='hide_from_search']").is(':checked') ? 1 : 0;
	
			$.post('{{ url("/user/update_privacy") }}', { show_me_offline : show_me_offline, hide_from_search : hide_from_search }, function(data){
	
			
					
					data = $.parseJSON(data);
					if(data.success)
					{
						alert("Changes have been saved");
					} 
	
			});
	});

	$("#emailSettingsBtn").click(function(){
	
			
				
				var photo_commented = $("input[name='photo_commented']").is(':checked') ? 1 : 0;
				var photo_rated = $("input[name='photo_rated']").is(':checked') ? 1 : 0;
				var message_sent = $("input[name='message_sent']").is(':checked') ? 1 : 0;
				var meet_me = $("input[name='meet_me']").is(':checked') ? 1 : 0;
				var add_contact = $("input[name='add_contact']").is(':checked') ? 1 : 0;
				var profile_visitor = $("input[name='profile_visitor']").is(':checked') ? 1 : 0;
				var gift_sent = $("input[name='gift_sent']").is(':checked') ? 1 : 0;
				var mutual_attraction = $("input[name='mutual_attraction']").is(':checked') ? 1 : 0;
	
			$.post('{{ url("/user/update_email_settings") }}', { photo_commented : photo_commented, photo_rated : photo_rated, message_sent : message_sent, meet_me : meet_me, add_contact : add_contact, profile_visitor : profile_visitor, gift_sent : gift_sent, mutual_attraction : mutual_attraction }, function(data){
	
			
					
					data = $.parseJSON(data);
					if(data.success)
					{
						alert("Changes have been saved");
					} 
	
			});
	});
		
});
</script>

@endsection
