 <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
 <script src="{{ url('/assets/js/modernizr.js') }}" type="text/javascript"></script>
  <script src="{{ url('/assets/js/jquery.min.js') }}"></script>
  <script src="{{ url('/assets/js/jquery-ui.js') }}"></script>
  <script src="{{ url('/assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ url('/assets/js/underscore.js') }}"></script>
   <script src="{{ url('/assets/js/knockout.js') }}"></script>
   <script src="{{ url('/assets/js/postal.js') }}"></script>
  <script src="{{ url('/assets/js/bootstrap-slider.js') }}"></script>
  <script src="{{ url('/assets/js/jquery.elasticide.js') }}"></script>
  <script  src="{{ url('assets/metronic/assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ url('/assets/js/jquery.cssemoticons.min.js') }}"></script>
  <script src="{{ url('/assets/js/app.js') }}"></script>
  
  <script>
  
  @if(!Auth::guest())
  @include('chat::chatjs')

window.setTimeout(function(){
        window.location.href = "{{ url('/signin') }}";
    }, 3600000);

  @endif


function format_flags(state){

            	 if (!state.id) return state.text; // optgroup

            var flag = state.id;

            if(state.id == "en"){
            	flag = "us";
            }
            else if(state.id == "he"){
            	flag = "il";
            }
            
            return "<img class='flag' src='{{ url('assets/metronic/assets/img/flags/') }}" + flag.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;

            }

  $(function(){ 
	 	$("#selected_language").select2({
            allowClear: true,
            formatResult: format_flags,
            formatSelection: format_flags,
            minimumResultsForSearch: -1,
            escapeMarkup: function (m) {
                return m;
            }
        });

	 });

  </script>


  <script src="http://connect.facebook.net/en_US/all.js"></script>

<script>
FB.init({
appId:'{{ s("fbid") }}',
cookie:true,
status:true,
xfbml:true
});

function FacebookInviteFriends()
{
FB.ui({
method: 'apprequests',
message: 'Your Message dialog'
}, inviteCallback);
}

function inviteCallback(data){

 var url = "{{ url('/invite_friend') }}";

 var friends = data.to.length;

 if(friends >= 1){ 

 $.post(url, { friends : friends }, function(){


 } );

}

}

</script>
  
  <script>

$(function(){


	$("#add-spotlight-btn").click(function(){
	
	 $("#add-spotlight-btn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
	
	$.post('{{ url("/add_spotlight") }}', function(data){
	
		data = $.parseJSON(data);
		if(data.success)
		{
			$("#add-spotlight-btn").find(':first-child').remove();
			$('#addSpotlight').modal('hide');
			window.location.reload();
		}
		
		if(data.error){
		
			$('#balance-error').show();
			$("#add-spotlight-btn").find(':first-child').remove();
			
		}
	
	});
	
			
	
	
	
	});
	
	
	
	$(".add-favourite-btn").click(function(){
	
		to_user = $(this).data('user-id');
		
			$.post('{{ url("/add_favourite") }}', { to_user : to_user }, function(data){
	
					data = $.parseJSON(data);
					if(data.success)
					{
						window.location.reload();
					}
		
					if(data.error){
		
						alert("There was an error processing this request, please try again later");
			
					} 
	
			});
	
	
	});
	
	
	
	$(".meet-me-btn").click(function(){
	
		to_user = $(this).data('user-id');
		
			$.post('{{ url("/meet_user") }}', { to_user : to_user }, function(data){
	
					
					data = $.parseJSON(data);
					if(data.success)
					{
						window.location.reload();
					}
		
					if(data.error){
		
						alert("There was an error processing this request, please try again later");
			
					}
	
			});
	
	
	});
	
	


		
	$(".block-btn").click(function(){
	
			to_user = $(this).data('user-id');
		
			$.post('{{ url("/block_user") }}', { to_user : to_user }, function(data){
	
					
					data = $.parseJSON(data);
					if(data.success)
					{
						window.location.reload();
					}
		
					if(data.error){
		
						alert("There was an error processing this request, please try again later");
			
					}
	
			});
	
	});
	
	$(".unblock-btn").click(function(){
	
			to_user = $(this).data('user-id');
		
			$.post('{{ url("/unblock_user") }}', { to_user : to_user }, function(data){
	
					
					data = $.parseJSON(data);
					if(data.success)
					{
						window.location.reload();
					}
		
					if(data.error){
		
						alert("There was an error processing this request, please try again later");
			
					}
	
			});
	
	});
	
	
	$(".unfavourite-btn").click(function(){
	
			to_user = $(this).data('user-id');
		
			$.post('{{ url("/unfavourite_user") }}', { to_user : to_user }, function(data){
	
					
					data = $.parseJSON(data);
					if(data.success)
					{
						window.location.reload();
					}
		
					if(data.error){
		
						alert("There was an error processing this request, please try again later");
			
					}
	
			});
	
	});
	
	
	
	$(".report-abuse-btn").click(function(){
	
		var username = $(this).data('username');
		var user_id = $(this).data('user-id');
	
		$("#report_abuse_username").html(username);
		$("#report_abuse_userid").val(user_id);
		$("#reportAbuseModal").modal('show');
		
	
	});
	
	$("#report-abuse-submit-btn").click(function(){
	
		 $("#report-abuse-submit-btn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
		 
		var to_user = $("#report_abuse_userid").val();
		
		var reason = $("#report_abuse_reason").val();
		
		
					$.post('{{ url("/report_abuse") }}', { to_user : to_user, reason: reason }, function(data){
	
					
					$("#report-abuse-submit-btn").find(':first-child').remove();
					$("#reportAbuseModal").modal('hide');
	
					});
		
	
	});
	
	
	$("#selected_language").change(function(){
	
		
		$.post('{{ url("/change_language")}}',{selected_lang : $("#selected_language").val()}, function() {
			window.location.reload();
		});
	});



});

</script>
  
  
  @yield('scripts')