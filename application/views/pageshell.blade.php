<!DOCTYPE html>
<html>
	<head>

@include('meta')


@include('styles')
   
	</head>
	<body>
		<div id="black_screen"></div>
		<div id="wrap">
	
    @if(Auth::guest())

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


    @else

			@include('nav')

    @endif
	


                  @if(s('banner_top_bar'))
                    <div class="row" style="margin-top: 5px;">
                      <center>
                    {{ Banner::get_banners('banner_top_bar') }}
                      </center>
                    </div>
                  @endif
		
			    <div class="container" style="margin-top:5px;">

					@yield('content')
			
				</div>
		
		</div>




                  @if(s('banner_bottom_bar'))
                    <div class="row" style="margin-top: 5px;">
                      <center>
                    {{ Banner::get_banners('banner_bottom_bar') }}
                      </center>
                    </div>
                  @endif


@include('footer')

@include('scripts')


@if(!Auth::guest())
<div class="modal fade" id="addSpotlight" tabindex="-1" role="dialog" aria-labelledby="addSpotlight" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">{{ t('addtospotlight') }}</h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger upload-error" style="display:none" id="balance-error">{{ t('balancelow') }}</div>
        {{ t('thiscosts') }} {{ s('spotlight_cost') }} {{ t('credits') }}. {{ t('yourbalanceis') }} {{ Auth::user()->credits() }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ t('close') }}</button>
        <button type="button" id="add-spotlight-btn" class="btn btn-primary">{{ t('add') }}</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="reportAbuseModal" tabindex="-1" role="dialog" aria-labelledby="reportAbuseModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">{{ t('reportabusive') }} <span id="report_abuse_username"></span></h4>
      </div>
      <div class="modal-body">
      	<input id="report_abuse_userid" type="hidden" value="" />
      	<label>{{ t('reportreason') }}</label>
      	<textarea id="report_abuse_reason"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ t('close') }}</button>
        <button type="button" id="report-abuse-submit-btn" class="btn btn-primary">{{ t('report') }}</button>
      </div>
    </div>
  </div>
</div>

@endif




	</body>
</html>