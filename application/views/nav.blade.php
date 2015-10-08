				<nav class="navbar navbar-default navbar-static-top" role="navigation">
		        <!-- Brand and toggle get grouped for better mobile display -->
		        	<div class="container">
				        <div class="navbar-header">
				          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-nav">
				            <span class="sr-only">Toggle navigation</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				          </button>
				          <a class="navbar-brand" href="{{ url('/dashboard') }}">{{ app_logo() }}</a>
				        </div>
		
				        <!-- Collect the nav links, forms, and other content for toggling -->
				        <div class="collapse navbar-collapse" id="top-nav">
				          <ul class="nav navbar-nav" style="height: 43px;">
				            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-users fa-2"></i> {{ t('peoplenearby') }}</a></li>
				            @if(!IoC::resolve('Browser')->isMobile())
				            <li class="dropdown dropdown-large"><a href="javascript:;" class="dropdown-toggle" id="messages_btn">
				            	<i class="fa fa-comment fa-2"></i> {{ t('messages') }} <div id="msg_notification" class="blink_me" style="display:inline" > @if(Auth::user()->unread_chats())
				            	<span id="msg_notification_no" class="label label-warning">{{ Auth::user()->unread_chats() }}</span>
				            	 @endif</div></a>
				            	@include('chat::chat_box')
				            </li>
				            @endif
				            <li><a href="{{ url('/encounters') }}"><i class="fa fa-play-circle fa-2"></i> {{ t('encounters') }}</a></li>
				            <li><a href="{{ url('/photorater') }}"><span class="glyphicon glyphicon-camera"></span> {{ t('photorater') }}</a></li>
				          </ul>
				          <ul class="nav navbar-nav pull-right">
				          	<li class="dropdown"><a href="#" style="color: green" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-money fa-3"></i> {{ t('credits') }} <span class="label label-success">{{ Auth::user()->credits() }}</span><span class="caret"></span></a>
		
				          		<ul class="dropdown-menu">
						          <li><a href="{{ url('/topup') }}"><i class="fa fa-arrow-circle-o-up fa-2"></i> {{ t('topup') }}</a></li>
						          <li><a href="{{ url('/premium') }}"><i class="fa fa-flash fa-2"></i> {{ t('premiumfeatures') }}</a></li>
						          @if(s("isrewards"))
						           <li><a href="{{ url('/rewards') }}" ><i class="fa fa-smile-o fa-2"></i> Rewards</a></li>
						          @endif
						        </ul>
		
				          	</li>
				          	<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="img img-rounded" style="height:20px;width:20px;" src="{{ Auth::user()->thumbnailPhoto() }}"/> {{ Auth::user()->name }} <span class="caret"></span></a>
		
				          		<ul class="dropdown-menu">
						          <li><a href="{{ url('/profile/'.Auth::user()->id) }}"><i class="fa fa-user fa-3"></i> {{ t('yourprofile') }}</a></li>
						         <li><a href="{{url('/settings')}}"><i class="fa fa-cogs fa-3"></i> {{ t('settings') }}</a></li>
						            <li class="divider"></li>
						          <li><a href="{{ URL::to('/logout') }}"><i class="fa fa-power-off fa-3"></i> {{ t('signout') }}</a></li>
						        </ul>
		
				          	</li>
				          </ul>
				        </div><!-- /.navbar-collapse -->
				    </div>
		      </nav>