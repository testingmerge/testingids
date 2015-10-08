		  <meta charset="utf-8">

		  <title>{{ s('title') }}</title>
		
		  <meta name="viewport" content="width=device-width, initial-scale=1.0">
		  
		  {{ app_description() }}
		  {{ app_keywords() }}
		  {{ app_search_engine_access() }}
		  
		  {{ app_favicon() }}
		  
		  
		  @if(s("google_ua"))
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '{{ s("google_ua") }}']);
			_gaq.push(['_trackPageview']);
			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
		@endif
		  
		  