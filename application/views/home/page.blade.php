<!DOCTYPE html>
<html>
	<head>

@include('meta')


@include('styles')
   
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
				          <a class="navbar-brand" href="{{ URL::base() }}">{{ app_logo() }}</a>
				        </div>
				        
				        
							 <div class="collapse navbar-collapse pull-right" id="top-nav">
				          		<ul class="nav navbar-nav" style="height: 43px;">
				          		
				          	

				       			</ul>
				       				
				       		</div>
				       			 
				            
		
				       
				    </div>
		      </nav>
		
	
		
			    <div class="container" style="margin-top:5px;">

					@yield('content')
			
				</div>
		
		</div>







@include('footer')

@include('scripts')








	</body>
</html>