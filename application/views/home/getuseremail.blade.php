<!DOCTYPE html>
<html>

	<head>
	
@include('meta')

				  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
			  <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
	<style>
	
		body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #000;
  background-image: url(assets/images/background.jpg);background-size: cover;
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

      <form class="form-signin" role="form" method="POST" action="{{ $url }}">
        <h2 class="form-signin-heading" style="text-align:center;color: #167edd;"><a href="{{ url('/') }}">{{ app_logo() }}</a></h2>
        	@if(Session::has('sent_verification_mail'))
			<div class="alert alert-success">{{ Session::get('sent_verification_mail') }}</div>
		@endif
        	@if(Session::has('password_reset_mail'))
			<div class="alert alert-success">{{ Session::get('password_reset_mail') }}</div>
		@endif
        <input type="text" class="form-control" placeholder="{{ t('email') }}" name="email" required autofocus>

        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ $action }}</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>