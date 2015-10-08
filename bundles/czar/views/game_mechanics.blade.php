@layout('czar::pageshell')

@section('content')

<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN PORTLET-->   
		
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('currentbots') }}</div>
			</div>
			
			<div class="portlet-body form">
				@if(Session::has('bot_deleted'))
			
					<div class="alert alert-success">
						{{ t('botdeletedsuccessfully') }}
					</div>
				@endif	
				<table class="table table-bordered">
					<thead>
						<td class="span2">{{ t('id') }}</td>
						<td class="span2">{{ t('photo') }}</td>
					 	<td class="span2">{{ t('name') }}</td>
					 	<td class="span2">{{ t('users') }}</td>
					 	<td class="span3">{{ t('joiningdate') }}</td>
						<td class="span3">{{ t('gender') }}</td>
						<td class="span3">{{ t('age') }}</td>
						<td class="span3">{{ t('status') }}</td>
					 </thead>
			  		<tbody>
						@foreach($bots as $bot)
						  	<tr class="bot-tr"> 
								<td class="span2">{{ $bot->id}}</td>
								<td ><img class="img" src="{{$bot->thumbnailPhoto()}}"/>
							 	<td class="span2">{{ $bot->name}}</td>
								<td class="span2">
									@if($bot->user_count() > 0 )
										<a href="javascript:;" class="user_count">{{$bot->user_count()}}</a>
									@else
										0
									@endif	
								</td>
`								
							 	<td class="span2">{{$bot->joining}}</td>
								@if($bot->gender == 1) 
									<td class="span2">{{ t('m') }}</td>
								@else
									<td class="span2">{{ t('f') }}</td>
								@endif
								<td class="span2">{{$bot->age}}</td>

								@if($bot->enable == 1)
								<td><a class="btn mini green-stripe delete-btn" href="javascript:;" style="cursor:default;">{{ t('active') }}</a></td>
								@else
								<td>
									<a class="btn mini red-stripe delete-btn" href="javascript:;" style="cursor:default;">{{ t('disabled') }}</a>
								</td>
								@endif
								<td>
									<div  style="overflow: visible;" data-botid='{{$bot->id}}'>

									@if($bot->enable == 1)
										{{ Form::select('action', array('0' => t('select') , '1' => t('delete'), '2' => t('disable') ),"",array('class' => 'span3 chosen action_select', 'style' => 'width:75px')) }}
										{{Form::close()}}
									@else
										{{ Form::select('action', array('0' => t('select') , '1' => t('delete'), '3' => t('enable')),"",array('class' => 'span3 chosen action_select', 'style' => 'width:75px')) }}
										{{Form::close()}}
									@endif
								</div>
							</td>
							 
							 </tr>

							<tr class="user-tr" style="display:none;">
								<td colspan="4">
								<table class="table">
								<tbody>
									@foreach($bot->users() as $user)
									<tr>
										@if(gettype($user) == "integer")
											<td>{{$user}}</td>
											<td>{{ t('deleteduser') }}</td>
				
										@else
											<td>{{$user->id}}</td>
											<td ><img class="img" src="{{$user->thumbnailPhoto()}}"/></td>
											<td><a class="hidden-phone" href="{{ URL::to('/profile/'.$user->id)}}" target="_blank">{{$user->name}}</a></td>
											<td>{{$user->city}}</td>
											<td>
											<form action="{{ url('czar/delete_user') }}" method="POST">
												<input type="hidden" name="id" value="{{ $user->id }}" />
												<button type="submit" class="btn red mini">{{ t('delete') }}</button>
											</form>
											</td>
										@endif
									</tr>
										
									@endforeach
								</tbody>
								</table>
								</td>
							</tr>
				
					 	@endforeach
			 		</tbody>
				</table>
			</div>
		</div>

		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('createbot') }}</div>
			</div>
			
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				@if(Session::has('bot_created'))
			
					<div class="alert alert-success">
						{{ t('botcreatedmsg') }}
					</div>
				@endif
				
				{{ Form::open_for_files('/czar/create_bot', 'POST', array('class'=>'form-signin form-horizontal', 'id'=>'form-create-bot' )) }}
					<div class="control-group" id="control-name">
						<label class="control-label">{{ t('fullname') }}</label>
						<div class="controls">
							<input type="text" class="form-control input-sm" id="name" name="name" placeholder="{{ t('fullname') }}" value="{{ Input::old('name') }}">
						</div>
					</div>
										  
					<div class="control-group" id="control-password">
						<label class="control-label">{{ t('password') }}</label>
						<div class="controls">
							<input type="text" class="form-control input-sm" id="password" name="password" placeholder="{{ t('password') }}">
						</div>
					</div>
											  
					<div class="control-group" id="control-birthday">
						<label for="day" class="control-label">{{ t('birthday') }}</label>
						<div class="controls">
							{{ Form::select('day', days(), Input::old('month'), array("class"=>"input-sm") )}}
							{{ Form::select('month', months(), Input::old('month'), array("class"=>"input-sm")) }}
							{{ Form::select('year', years(1971, date('Y',strtotime("-18 years"))), Input::old('year'), array("class"=>"input-sm")) }}
						</div>
					</div>

					<div class="control-group" id="control-joining">
						<label for="day" class="control-label">{{ t('joining') }}</label>
						<div class="controls">
							{{ Form::select('join_day', days(), Input::old('join_month'), array("class"=>"input-sm") )}}
							{{ Form::select('join_month', months(), Input::old('join_month'), array("class"=>"input-sm")) }}
							{{ Form::select('join_year', years(2014), Input::old('join_year'), array("class"=>"input-sm")) }}
						</div>
					</div>
											  
					<div class="control-group" id="control-gender">
						<label for="gender" class="control-label">{{ t('selectgender') }}</label>
						<div class="controls">
							{{ Form::select('gender', array('1'=>t('male'), '2' => t('female')), Input::old('gender'),array("class"=>"input-sm")) }}
						</div>
					</div>
					
					<div class="control-group" id="control-photo">
						<label class="control-label">{{ t('profilepicture') }}</label>
						<div class="controls">
							{{ Form::file('photo', array("title"=>t('choosefile'), "id"=>"photo")) }}
								<p class="muted">
									{{t('picuploadmessage') }}
								</p>
						 </div>
					</div>	
					
		
					<div class="form-actions">
						<button type="button" id="create-btn" class="btn green">{{ t('create') }}</button>
					</div>
				</form>
			<!-- END FORM-->  
			</div>
		</div>
		<!-- END PORTLET-->

		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('generalsettings') }}</div>
			</div>
			
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				@if(Session::has('updated'))
			
					<div class="alert alert-success">
						{{ t('settingupdatemsg') }}
					</div>
				@endif
				<form action="{{url('/czar/game_mechanics_setting')}}" id="form-settings" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('nobotstobecreated') }}</label>
						<div class="controls">
							<input type="text" class="m-wrap" name="no_bot" id="no_bot" value="{{$no_bot}}">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">{{ t('gender') }}</label>
						<div class="controls"  style="overflow: visible;">
					{{ Form::select('bot_gender', array('0' => t('oppositegender') , '1' => t('samegender'), '2' => t('bothgender')),$bot_gender,array('class' => 'span3 chosen', 'style' => 'width:140px')) }}
						</div>	
					</div>	
					<div class="form-actions">
						<button type="submit" id="add-btn" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
			<!-- END FORM-->  
			</div>
		</div>
	
	</div>


		<div id="dialog_disable" title="Disable Bot" class="hide">
			<p> {{ t('disablebotmsg') }} </p>
		</div>
									
		<div id="dialog_delete" title="Delete Bot" class="hide">
			<p> {{ t('deletebotmsg') }} </p>
		</div>
									
		<div id="dialog_enable" title="Enable Bot" class="hide">
			<p> {{ t('enablebotmsg') }} </p>
		</div>
</div>
@endsection



@section('scripts')

<script>

$(function(){



$("#create-btn").click(function(e){
	 		
	 		flag = 0;
 		
	 		var label = '<label for="fullname" class="help-inline help-small no-left-padding">{{ t("fieldrequired") }}</label>';
	 		
	 		e.preventDefault();
			$("#form-create-bot").find('.help-inline').remove();
	 	
	 		if($("#name").val()) {
	 			if(/^[a-zA-Z ]*$/.test($("#name").val())) {
	 				$("#control-name").removeClass("has-error");
	 			} else {
	 				$("#control-name").addClass("has-error");
	 				$("#name").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("nospecialcharacters") }}</label>');
	 				flag = 1;	
	 			}
	 		} else{
	 			$("#control-name").addClass("has-error");
	 			$("#name").parent().append(label);
				flag = 1;
	 		}
	 		
	 		if($("#photo").val() == ''){
	 			console.log("sdh");
	 			$("#control-photo").addClass("has-error");
	 			$("#photo").parent().append(label);
				flag = 1;
 			} else {
				$("#control-photo").removeClass("has-error");
			}
 		
	 		if($("#password").val()) {
	 			if($("#password").val().length >= 6){
	 				$("#control-password").removeClass("has-error");
	 			} else {
	 				$("#control-password").addClass("has-error");
	 				$("#password").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("passwordminimum") }}</label>');
	 				flag = 1;
	 			}
	 		} else{
	 			$("#password").addClass("has-error");
	 			$("#password").parent().append(label);
	 			flag = 1;
 			}
 		
 		
	 		if(flag == 0) {
	 			
	 			$("#form-create-bot").submit();
	 		}
	 	
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
	      			$.post("{{url('/czar/disable_bot')}}",{'id' : $(this).data('id')},function() {
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
	      			$.post("{{url('/czar/delete_bot')}}",{'id' : $(this).data('id')},function() {
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
	      			$.post("{{url('/czar/enable_bot')}}",{'id' : $(this).data('id')},function() {
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



	$(".action_select").change(function(e){
		var selected_option = $(e.target).val();
		 var bot_id = $($(e.target).parent()).data('botid');
		 	
		 selected_option_element = e.target;
		 	
		if(selected_option == 1){
		 	$("#dialog_delete").data('id', bot_id);
			$( "#dialog_delete" ).dialog( "open" );
		 } else if(selected_option == 2){
		 	$("#dialog_disable").data('id', bot_id);
			$( "#dialog_disable" ).dialog( "open" );
		 } else if(selected_option == 3){
		 	$("#dialog_enable").data('id', bot_id);
			$( "#dialog_enable" ).dialog( "open" );
	 	}
	});

	$(".user_count").click(function(){

 		var tr = $(this).parents('.bot-tr').get(0);
 
 
		$(tr).next().toggle();


	});	
});




</script>


@endsection
