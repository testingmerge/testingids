<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>{{ t('czarcontrolpanel') }}</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="{{ url('assets/metronic/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('assets/metronic/assets/plugins/bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('assets/metronic/assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('assets/metronic/assets/css/style-metro.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('assets/metronic/assets/css/style.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('assets/metronic/assets/css/style-responsive.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('assets/metronic/assets/css/themes/default.css') }}" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="{{ url('assets/metronic/assets/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('assets/metronic/assets/plugins/jquery.thumbnailScroller.css') }}" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('assets/metronic/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ url('assets/metronic/assets/plugins/chosen-bootstrap/chosen/chosen.css') }}" />
	<link href="{{ url('assets/metronic/assets/plugins/select2/select2_metro.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('assets/metronic/assets/plugins/glyphicons/css/glyphicons.css') }}" rel="stylesheet" />
	<link href="{{ url('assets/metronic/assets/css/prettyPhoto.css') }}" rel="stylesheet" />
	<link href="{{ url('assets/metronic/assets/css/jquery.Jcrop.min.css') }}" rel="stylesheet" />
	<link href="{{ url('assets/metronic/assets/plugins/data-tables/DT_bootstrap.css') }}" rel="stylesheet" />
	
	@yield('styles')
	
</head>

<body class="page-header-fixed">


	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container" style="width: 900px;">
				<!-- BEGIN LOGO -->
				<a class="brand" href="{{ url('/czar') }}">
					{{ t('czarcontrolpanel') }}
				</a>
				<!-- END LOGO -->
				
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
					<img src="{{ asset('assets/metronic/assets/img/menu-toggler.png') }}" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->









				            
				<!-- BEGIN TOP NAVIGATION MENU -->              

				<!-- END TOP NAVIGATION MENU --> 
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	
	
<div class="container">
		<!-- BEGIN CONTAINER -->  
		<div class="page-container row-fluid">
			@include('czar::sidebar')
	</div>
	
	
<div class="page-content" style="min-height:800px !important">
				<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				<div id="portlet-config" class="modal hide">
					<div class="modal-header">
						<button data-dismiss="modal" class="close" type="button"></button>
						<h3>portlet Settings</h3>
					</div>
					<div class="modal-body">
						<p>Here will be a configuration form</p>
					</div>
				</div>
				<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
				<!-- BEGIN PAGE CONTAINER-->
				<div class="container-fluid">
					<!-- BEGIN PAGE HEADER-->
					<div class="row-fluid">
						<div class="span12">
							<h1>{{$page_title}}</h1>
							<hr/>
							@yield('content')
						</div>
					</div>
				</div>
</div>
	
	
	
	
</div>
					





<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   <script src="{{ url('assets/metronic/assets/plugins/jquery-1.10.1.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('assets/metronic/assets/plugins/jquery-migrate-1.2.1.min.js') }}" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="{{ url('assets/metronic/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>      
	<script src="{{ url('assets/metronic/assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('assets/metronic/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js') }}" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="{{ url('assets/metronic/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('assets/metronic/assets/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>  
	<script src="{{ url('assets/metronic/assets/plugins/jquery.cookie.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('assets/metronic/assets/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<script src="{{ url('assets/metronic/assets/plugins/fancybox/source/jquery.fancybox.pack.js')}}"></script>
	<script src="{{ url('assets/metronic/assets/plugins/jquery.thumbnailScroller.js')}}"></script>
	<script src="{{ url('assets/metronic/assets/scripts/app.js') }}"></script> 
	<script src="{{ url('assets/metronic/assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js') }}"></script>
	<script src="{{ url('assets/metronic/assets/scripts/jquery.prettyPhoto.js') }}"></script>
	<script src="{{ url('assets/metronic/assets/scripts/jquery.Jcrop.min.js') }}"></script>
	<script src="{{ url('assets/metronic/assets/plugins/data-tables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ url('assets/metronic/assets/plugins/data-tables/DT_bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/metronic/assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ url('assets/metronic/assets/scripts/search.js') }}"></script>

<script>

jQuery(document).ready(function() {    
		   App.init();
		   
		   setTimeout(function(){ 
		 $('.chzn-search').hide();
		 }, 500);
		   
		   });
		   


</script>

@yield('scripts')

</body>
</html>
