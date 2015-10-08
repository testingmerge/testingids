@if(Session::has('invalid_captcha'))
								
		<div class="alert alert-danger"><strong>CAPTCHA</strong> is wrong, please try again</div>		
								
@endif

@if(Session::has('verification_email_sent'))

<div class="alert alert-success">Email verification mail sent. Please check your inbox</div>

@endif