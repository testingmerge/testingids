				      						<div class="list-group sidebar-nav small">
											  <a href="{{ url('/profile_visitors') }}" class="list-group-item">
											    <i class="fa fa-eye fa-2"></i> {{ t('profilevisitors') }} 
											    @if(Auth::user()->profile_visits_notification())
											    <span class="badge badge-notification">
											     {{ '+'.Auth::user()->profile_visits_notification() }}
											      </span>
											    @endif
											    
											  </a>
											  <a href="{{ url('/favourites') }}" class="list-group-item"><i class="fa fa-star fa-2"></i> {{ t('favorites') }}</a>
											  <a href="{{ url('/favme') }}" class="list-group-item"><i class="fa fa-sun-o fa-2"></i> {{ t('addedyouasfavorite') }}
											   @if(Auth::user()->favourite_notification())
											    <span class="badge badge-notification">
											     {{ '+'.Auth::user()->favourite_notification() }}
											      </span>
											    @endif
											  </a>
											  <a href="{{ url('/wantstomeetme') }}" class="list-group-item"><i class="fa fa-thumbs-up fa-2"></i> {{ t('wantstomeetyou') }}
											   @if(Auth::user()->meetme_notification())
											    <span class="badge badge-notification">
											     {{ '+'.Auth::user()->meetme_notification() }}
											      </span>
											    @endif
											  </a>
											  <a href="{{ url('/wanttomeet') }}" class="list-group-item"><i class="fa fa-check-square-o fa-2"></i> {{ t('youwanttomeet') }}</a>
											   <a href="{{ url('/matches') }}" class="list-group-item"><i class="fa fa-heart fa-2"></i> {{ t('mutualattractions') }}</a>
											  <a href="{{ url('/photos_rated') }}"  class="list-group-item"><i class="fa fa-camera-retro fa-2"></i> {{ t('photosrated') }}</a>
											 <a href="{{ url('/blocked_users') }}"  class="list-group-item"><i class="fa fa-stop fa-2"></i> {{ t('blocked') }}</a> 
			
										</div>