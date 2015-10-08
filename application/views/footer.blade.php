		<footer id="footer" style="margin-top:10px;">
		      <div class="container">
		      	<div class="row">
		      		<div class="col-md-6">
		        <p> 
		    <a href="{{ url('/aboutus') }}">{{ t('aboutus') }}</a> | 
			<a href="{{ url('/privacy_policy') }}">{{ t('privacypolicy') }}</a> |
			<a href="{{ url('/terms_conditions') }}">{{ t('termsconditions') }}</a> |
			{{ t('copyright') }} {{ s('title') }} &copy {{ date('Y') }}
			</p>
				</div>
				<div class="col-md-6">
			<p class="pull-right">
			{{ Language::get_language_bar() }}
			</p>
				</div>
				</div>
		      </div>
   		</footer>