<!DOCTYPE html>
<html>

	<head>
				  <link rel="stylesheet" href="assets/css/bootstrap.css">
			  <link rel="stylesheet" href="assets/css/font-awesome.css">
	<style>
	
		body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #000;
  background-image: url({{ loginpage_bg() }});background-size: cover;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
	
	</style>




  </head>

  <body>

    <div class="container">
	
      <form class="form-signin" role="form" method="POST" action="{{ url('/signin') }}">
        <h2 class="form-signin-heading" style="text-align:center;color: #167edd;"><a href="{{ url('/') }}">{{ app_logo() }}</a></h2>
        	@if(Session::has('invalid_login'))
			<div class="alert alert-danger">{{ Session::get('invalid_login') }}</div>
		@endif
        	@if(Session::has('notverified'))
			<div class="alert alert-danger">{{ Session::get('notverified') }}, <a href="{{ url('/send_verification') }}">{{ t('clickheretosendverify') }}</a></div>
		@endif
				@if(Session::has('user_verified'))
					<div class="alert alert-success">{{ Session::get('user_verified') }}</div>
				@endif
				@if(Session::has('password_reset'))
					<div class="alert alert-success">{{ Session::get('password_reset') }}</div>
				@endif
        <input type="text" class="form-control" placeholder="{{ t('email') }}" name="email" required autofocus>
        <input type="password" class="form-control" placeholder="{{ t('password') }}" name="password" required>
        <label class="checkbox">
          <input type="checkbox" name="remember"> {{ t('rememberme') }}
        </label>
        <p>
        <a href="{{ url('/forgot_password') }}">{{ t('forgotpassword') }}</a>
        </p>
        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ t('signin') }}</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>