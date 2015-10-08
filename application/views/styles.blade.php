			<link href='http://fonts.googleapis.com/css?family=Istok+Web:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
			  <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">
			  <link rel="stylesheet" href="{{ url('assets/css/font-awesome.css') }}">
			  <link rel="stylesheet" href="{{ url('assets/css/jquery-ui.css') }}">
			  <link rel="stylesheet" href="{{ url('assets/css/switcher.css') }}">
			
			
			  <link rel="stylesheet" href="{{ url('assets/css/pygments-manni.css') }}">
			  <link rel="stylesheet" href="{{ url('assets/css/slider.css') }}" >
			   <link rel="stylesheet" href="{{ url('assets/css/elasticide.css') }}" >
			<link rel="stylesheet"  href="{{ url('assets/metronic/assets/plugins/select2/select2_metro.css') }}" />
			  <link rel="stylesheet" href="{{ url('assets/css/icon-hover.css') }}">
			  <link rel="stylesheet" href="{{ url('assets/css/icon-hover-icons.css') }}">
			  <link rel="stylesheet" href="{{ url('assets/css/jquery.cssemoticons.css') }}">
			   <link rel="stylesheet" href="{{ url('assets/css/app.css') }}">


			   	@if(Language::isRTL())
			   	<style>
			   	body{

			   	direction:rtl; unicode-bidi:bidi-override;

			   }
			   	</style>
			   	@endif
			   
			   @yield('styles')