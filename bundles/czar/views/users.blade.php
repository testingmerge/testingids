@layout('czar::pageshell')


@section('content')

								
	<div class="row-fluid search-forms search-default" style="margin-top:60px;">
		<form class="form-search" action="{{ URL::to('/czar/users')}}" id="form_search" >
			<div class="chat-form" style="overflow: visible;">
				{{ Form::select('users', array('0' => t("allusers"), '1' => t("onlymale"), '2' => t("onlyfemale")),"$user_type",array('class' => 'span3 chosen', 'id' => 'select_user')) }}
					<div class="span7 input-append pull-right">   
						<input type="text" placeholder="{{ t('nameoridoremail') }}" class="m-wrap" style="background-color: #FFFFFF;" name="name" value="{{$name}}"/>
						<input type="text" placeholder="{{ t('city') }}" class="m-wrap" style="background-color: #FFFFFF;" name="city" id="city" value="{{$city}}"/>
						<button type="submit" class="btn green">{{ t('search') }} &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>
					</div>
			</div>
		</form>
	
		<div class="portlet-body">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>{{ t('id') }}</th>
						<th>{{ t('photo') }}</th>
						<th class="hidden-phone">{{ t('name') }}</th>
						<th>{{ t('email') }}</th>
						<th class="hidden-phone">{{ t('age') }}</th>
						<th class="hidden-phone">{{ t('city') }}</th>
						<th class="hidden-phone">{{ t('joined') }}</th>
						<th class="hidden-phone">{{ t('credits') }}</th>
						<th class="hidden-phone">{{ t('photos') }}</th>
						<th>{{ t('status') }}</th>
						<th>{{ t('accountstatus') }}</th>
						<th>{{ t('action') }}</th>
					</tr>
				</thead>
				
				<tbody>
					@foreach($users->results as $user)
						<tr class="user-tr">
							<td>{{$user->id}} </td>
							<td><img src="{{$user->thumbnailPhoto()}}" alt="" height="45px" width="45px" /></td>
							<td><a class="hidden-phone" href="{{ URL::to('/profile/'.$user->id)}}" target="_blank">{{$user->name}}</a></td>
							<td>{{$user->email}} </td>
							<td class="hidden-phone">{{$user->age}}</td>
							<td class="hidden-phone">{{$user->city}}</td>
							<td class="hidden-phone">{{$user->created_at}}</td>
							<td class="hidden-phone">{{$user->credits()}}</td>
							<td class="hidden-phone">
								@if($user->photos_count() > 0 )
									<a href="javascript:;" class="photo_count">{{$user->photos_count()}}</a>
								@else
									0
								@endif	
							</td>	
							@if($user->isOnline())
								<td><span class="label label-success">{{ t('online') }}</span></td>
							@else
								<td><span class="label label-danger">{{ t('offline') }}</span></td>
							@endif
							
							@if($user->role == 1)
								<td><a class="btn mini red-stripe delete-btn" href="javascript:;" style="cursor:default;">{{ t('disabled') }}</a></td>
							@else

							@if($user->verified == 0)
								<td><a class="btn mini blue-stripe delete-btn" href="javascript:;" style="cursor:default;">{{ t('notverified') }}</a></td>
							@elseif($user->verified == 1)
								<td><a class="btn mini green-stripe delete-btn" href="javascript:;" style="cursor:default;">{{ t('active') }}</a></td>
							
							@endif

							@endif
							
							<td>
							
									<div  style="overflow: visible; width: 100px;" data-userid='{{$user->id}}'>
										@if($user->verified == 0)
											{{ Form::select('action', array('0' => t('select') , '1' => t('verify'), '3' => t('delete') ),"",array('class' => 'span3 chosen action_select', 'style' => 'width:115px')) }}
											{{Form::close()}}
										@elseif($user->role == 1)
											{{ Form::select('action', array( '0' => t('select') ,'3' => t('delete'), '5' => t('enable'), '6' => t('resetpassword')),"",array('class' => 'span3 chosen action_select', 'style' => 'width:115px')) }}
											{{Form::close()}}
										@elseif($user->verified == 1 && ($user->role == 0 || $user->role == 3))
											{{ Form::select('action', array('0' => t('select') , '2' => t('disable'), '3' => t('delete'), '6' => t('resetpassword'), '7' => t('givecredits')),"",array('class' => 'span3 chosen action_select', 'style' => 'width:115px')) }}
											{{Form::close()}}
										@endif
									</div>
							
															
								
							</td>
						</tr>

						<tr class="photo-tr" style="display:none;">
						<td colspan="4">
							<table class="table">
								<tbody>
									@foreach($user->photos() as $photo)
									<tr>
										<td ><img class="img" src="{{$photo->thumbnail()}}"/></td>
										<td>
										<form action="{{ url('czar/delete_photo') }}" method="POST">
											<input type="hidden" name="id" value="{{ $photo->id }}" />
											<button type="submit" class="btn red mini">{{ t('delete') }}</button>
										</form>
										</td>
									</tr>
										
									@endforeach
								</tbody>
							</table>
						</td>
						</tr>
				
					@endforeach
				</tbody>
			</table>
			
			<div class="span4 pull-right">{{ $users->appends($type)->links() }}</div>
		</div>
									
		<div id="dialog_verify" title="{{ t('verifyuser') }}" class="hide">
			<p>{{ t('verifyusermsg') }}</p>
		</div>
									
		<div id="dialog_disable" title="{{ t('disableuser') }}" class="hide">
			<p> {{ t('disableusermsg') }}</p>
		</div>
									
		<div id="dialog_delete" title="{{ t('deleteuser') }}" class="hide">
			<p> {{ t('deleteusermsg') }} </p>
		</div>
									
		<div id="dialog_enable" title="{{ t('enableuser') }}" class="hide">
			<p> {{ t('enableusermsg') }} </p>
		</div>
									
		<div id="dialog_reset_password" title="{{ t('resetpassword') }}" class="hide">
			<p> {{ t('resetpwdmsg') }} </p>
		</div>
									
		<div id="dialog_credits" title="{{ t('givecredits') }}" class="hide">
			<form action="{{URL::to('/czar/credit_user')}}" id="credit-form" class="form-horizontal" method="post">
				<label class="control-label">{{ t('credits') }}</label>
				<input type="text"  class="m-wrap" name="credits" id="credits" value=""/>
				<label class="control-label">{{ t('reason') }}</label>
				<input type="text" class="m-wrap" name="reason" id="reason" value=""/>
				<input type="text" class="m-wrap hide" name="userid" id="userid" />
			</form>
		</div>
	</div>
@endsection

@section('scripts')



<script type="text/javascript">

	var selected_option_element;
	jQuery(document).ready(function() {   

		jQuery("#city").autocomplete({
			source: function (request, response) {
		
				jQuery("#city").addClass("spinner");
				jQuery.getJSON(
					"http://gd.geobytes.com/AutoCompleteCity?callback=?&q="+request.term,
					function (data) {
				
						jQuery("#city").removeClass("spinner");
			 			response(data);
					}
		 		);
			},
			minLength: 3,
			select: function (event, ui) {
			 	var selectedObj = ui.item;
			 	jQuery("#city").val(selectedObj.value);
			 	return false;
			},
			open: function () {
		 		jQuery(this).removeClass("ui-corner-all").addClass("ui-corner-top");
			},
			close: function () {
		 		jQuery(this).removeClass("ui-cornegivecreditsr-top").addClass("ui-corner-all");
			}
	 	});
	 	
	 	jQuery("#city").autocomplete("option", "delay", 100);
	  	function split( val ) {
      		return val.split( /,\s*/ );
    	}
			
		$( "#dialog_verify" ).dialog({
	    	dialogClass: 'ui-dialog-green',
	      	autoOpen: false,
	      	resizable: false,
	      	height: 210,
	      	modal: true,
	      	buttons: [
	      	{
	      		'class' : 'btn green',	
	      		"text" : "{{ t('verify') }}",
	      		click: function() {
				var self = this;
	      			$.post("{{url('/czar/verify_user')}}",{'id' : $(this).data('id')},function() {
	        			$(self).dialog( "close" );
					window.location.reload();
				});
      			}
	      	},
	      	{
	      		'class' : 'btn',
	      		"text" : "{{ t('cancel') }}",
	      		click: function() {
	      			$(selected_option_element).val(0);
            		$(selected_option_element).trigger("liszt:updated");
            		
        			$(this).dialog( "close" );
      			}
	      	}]
		});
	    
	    $( "#dialog_disable" ).dialog({
			dialogClass: 'ui-dialog-red',
	      	autoOpen: false,
	      	resizable: false,
	      	height: 210,
	      	modal: true,
	      	buttons: [
	      	{
	      		'class' : 'btn red',	
	      		"text" :"{{ t('disable') }}",
	      		click: function() {
	      			var self = this;
	      			$.post("{{url('/czar/disable_user')}}",{'id' : $(this).data('id')},function() {
	        			$(self).dialog( "close" );
					window.location.reload();
				});
      			}
	      	},
	      	{
	      		'class' : 'btn',
	      		"text" : "{{ t('cancel') }}",
	      		click: function() {
	      			$(selected_option_element).val(0);
            		$(selected_option_element).trigger("liszt:updated");
            
        			$(this).dialog( "close" );
      			}
	      	}]
	    });
	    
	    $( "#dialog_delete" ).dialog({
			dialogClass: 'ui-dialog-red',
	      	autoOpen: false,
	      	resizable: false,
	      	height: 210,
	      	modal: true,
	      	buttons: [
	      	{
	      		'class' : 'btn red',	
	      		"text" : "{{ t('delete') }}",
	      		click: function() {
	      			var self = this;
	      			$.post("{{url('/czar/delete_user')}}",{'id' : $(this).data('id')},function() {
	        			$(self).dialog( "close" );
					window.location.reload();
				});
      			}
	      	},
	      	{
	      		'class' : 'btn',
	      		"text" : "{{ t('cancel') }}",
	      		click: function() {
	      			$(selected_option_element).val(0);
            		$(selected_option_element).trigger("liszt:updated");
            		
        			$(this).dialog( "close" );
      			}
	      	}]
	    });
	    
	   
	    $( "#dialog_enable" ).dialog({
			dialogClass: 'ui-dialog-green',
	      	autoOpen: false,
	      	resizable: false,
	      	height: 210,
	      	modal: true,
	      	buttons: [
	      	{
	      		'class' : 'btn green',	
	      		"text" : "{{ t('enable') }}",
	      		click: function() {
	      			var self = this;
	      			$.post("{{url('/czar/enable_user')}}",{'id' : $(this).data('id')},function() {
	        			$(self).dialog( "close" );
					window.location.reload();
				});
      			}
	      	},
	      	{
	      		'class' : 'btn',
	      		"text" : "{{ t('cancel') }}",
	      		click: function() {
	      			$(selected_option_element).val(0);
            		$(selected_option_element).trigger("liszt:updated");
            		
        			$(this).dialog( "close" );
      			}
	      	}]
	    });
	    
	    $( "#dialog_reset_password" ).dialog({
			dialogClass: 'ui-dialog-blue',
		    autoOpen: false,
		    resizable: false,
		    height: 210,
		    modal: true,
	        buttons: [
	      	{
	      		'class' : 'btn blue',	
	      		"text" : "{{ t('send') }}",
	      		click: function() {
	      			var self = this;
	      			$.post("{{url('/czar/reset_password')}}",{'id' : $(this).data('id')},function() {
	        			$(self).dialog( "close" );
					window.location.reload();
				});
      			}
	      	},
	      	{
	      		'class' : 'btn',
	      		"text" : "{{ t('cancel') }}",
	      		click: function() {
	      			$(selected_option_element).val(0);
            		$(selected_option_element).trigger("liszt:updated");
            		
        			$(this).dialog( "close" );
      			}
	      	}]
	    });
	    
	    $( "#dialog_credits" ).dialog({
			dialogClass: 'ui-dialog-green',
	      	autoOpen: false,
	      	resizable: false,
	      	height: 210,
	      	modal: true,
	      	buttons: [
	      	{
	      		'class' : 'btn green',	
	      		"text" : "{{ t('send') }}",
	      		click: function() {
	      			$("#credit-form").submit();
        			$(this).dialog( "close" );
      			}
	      	},
	      	{
	      		'class' : 'btn',
	      		"text" : "{{ t('cancel') }}",
	      		click: function() {
	      			$(selected_option_element).val(0);
            		$(selected_option_element).trigger("liszt:updated");
            		
        			$(this).dialog( "close" );
      			}
	      	}]
	    });
	    
	    $("#select_user").change(function(e){
		 	$("#form_search").submit();
		})
		 
		$(".action_select").change(function(e){
		 	var selected_option = $(e.target).val();
		 	var user_id = $($(e.target).parent()).data('userid');
		 	
		 	selected_option_element = e.target;
		 	
		 	if(selected_option == 1){
		 		$("#dialog_verify").data('id', user_id);
				$( "#dialog_verify" ).dialog( "open" );
		 		
		 	}
		 	else if(selected_option == 2){
		 		$("#dialog_disable").data('id', user_id);
				$( "#dialog_disable" ).dialog( "open" );
		 	}
		 	else if(selected_option == 3){
		 		$("#dialog_delete").data('id', user_id);
				$( "#dialog_delete" ).dialog( "open" );
		 	}
		 	else if(selected_option == 5){
		 		$("#dialog_enable").data('id', user_id);
				$( "#dialog_enable" ).dialog( "open" );
		 	}
		 	else if(selected_option == 6){
		 		$("#dialog_reset_password").data('id', user_id);
				$( "#dialog_reset_password" ).dialog( "open" );
		 	}else if(selected_option == 7){
		 		
		 		var this_url="{{URL::to('/czar/credit_user')}}";
		 		var data_url= this_url + user_id;
		 		$("#userid").val(user_id);
		 		$("#dialog_credits").data('url', data_url);
				$( "#dialog_credits" ).dialog( "open" );
		 	}
		})

	$(".photo_count").click(function(){

 		var tr = $(this).parents('.user-tr').get(0);
 
 
		$(tr).next().toggle();


	});	
		 
	});
</script>
@endsection
