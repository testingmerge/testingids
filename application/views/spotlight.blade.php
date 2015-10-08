@if(!Auth::guest())			    	
			    	<div class="row" style="margin-bottom: 20px;">
			    		
			    				<div class="col-xs-1" style="z-index:999;">
								
								<img src="{{ asset('assets/images/spotlightframe.gif') }}"  />
								
								<img src="{{ Auth::user()->thumbnailPhoto() }}" style="position:absolute;top:4px;left:19px;z-index:1000;height:70px;width:70px;" />
								
								<p data-toggle="modal" data-target="#addSpotlight" style="position:absolute;top:8px;left:25px;z-index:1000;width:50px;text-align:center;color: #FFF;
			text-decoration: underline;
			cursor: pointer;text-shadow: rgba(0,0,0,0.5) 0 -1px 0;">{{ t('add') }}<br/>{{ t('yourself') }}<br/>{{ t('here') }}</p>
								
								</div>
			
			
			
			      			<div class="col-md-11" style="height:78px;overflow:hidden;padding:0px;">
			      			 <ul id="carousel" class="elastislide-list" style="padding-top:0px;">
			      			 	@foreach(Spotlight::spotlight_users() as $u)
								
								<li><a href="{{ $u->profile_url() }}"><img style="height:70px;width:70px;" src="{{ $u->thumbnailPhoto() }}" alt="image02" /></a></li>
								@endforeach
							</ul>
						</div>
			    		
			    		
			    		
			    	</div>
@endif
			