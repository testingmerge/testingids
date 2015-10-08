@layout('czar::pageshell')

@section('content')

	<div class="row-fluid" style="margin-top:60px;">
		<div class="span12">
			<!-- BEGIN PORTLET-->   
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption"><i class="icon-reorder"></i>{{ t('addcreditspackage') }}</div>
				</div>

				<div class="portlet-body form">
					@if(Session::has('created_package'))
			
						<div class="alert alert-success">
							{{ t('packagecreatedmsg') }}
						</div>
			
					@endif
					<!-- BEGIN FORM-->
					<form action="{{URL::to('/czar/add_credits_package')}}" id="form-credits-package" class="form-horizontal" method="post">
						<div class="control-group" id="control-credits">
							<label class="control-label">{{ t('credits') }}</label>
							<div class="controls">
								<input type="number" class="m-wrap" name="credits" id="credits" value="" pattern="\d+" min="0" step="50">
							</div>
						</div>
						
						<div class="control-group" id="control-package-amt">
							<label class="control-label">{{ t('packageamount') }}</label>
							<div class="controls">
								<input type="number" class="m-wrap" name="cost" id="cost" value="" pattern="\d+" min="0" step="1">
							</div>
						</div>
									
						<div class="form-actions">
							<button type="submit" class="btn green" id="addPackageBtn">{{ t('submit') }}</button>
						</div>
					</form>
					<!-- END FORM-->  
				</div>
			</div>
			<!-- END PORTLET-->

			<!-- BEGIN PORTLET-->   
			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption"><i class="icon-reorder"></i>{{ t('currentcreditspck') }}</div>
				</div>
				<div class="portlet-body form">
					@if(Session::has('deleted_package'))
			
						<div class="alert alert-success">
							{{ t('deletecreditspck') }}
						</div>
			
					@endif
					<table class="table table-bordered">
						<thead>
							 <td class="span2">{{ Lang::line('app.credits')->get(Setting::get_setting('language')) }}</td>
							 <td class="span3">{{ t('dollars') }}</td>
						</thead>
							
						<tbody>
							@foreach($packages as $package)
								<tr>
								<td class="span2">{{ $package->credits}}</td>
								<td class="span3">{{ $package->cost }}
								<form action="{{URL::to('/czar/delete_credits_package')}}" id="form-delete-package" class="form-horizontal" method="post">
								<input type="hidden" class="m-wrap" name="id" id="id" value="{{$package->id}}">
								<button type="submit" class="btn btn-primary pull-right red"> {{ t('delete') }}</button>
								</form>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>


			<!-- BEGIN PORTLET-->   
			<div class="portlet box green">
				<div class="portlet-title">
					<div class="caption"><i class="icon-reorder"></i>{{ t('generalsettings') }}</div>
				</div>
				
				<div class="portlet-body form">
					@if(Session::has('update_general'))
			
						<div class="alert alert-success">
							{{ t('settingupdatemsg') }}
						</div>
			
					@endif
					<!-- BEGIN FORM-->
					<form action="{{URL::to('/czar/update_credits_general')}}" id="default-credits" class="form-horizontal" method="post">
						<div class="control-group" id="control-default-credits">
							<label class="control-label">{{ t('defaultcredits') }}</label>
							<div class="controls">
								<input type="number" class="m-wrap" name="defaultcredits" id="defaultcredits" value="{{$defaultcredits}}" pattern="\d+" min="0" step="1">
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">{{ t('creditsystem') }}</label>
							<div class="controls">
								{{ Form::select('isenabled', array('1' =>  t("enable"), '0' => t("disable")), "$isenabled",array('class' => 'span3 chosen', 'id' => 'credits_enable')) }}
							</div>
						</div>
											
						<div class="form-actions">
							<button type="submit" class="btn green">{{ t('submit') }}</button>
						</div>
					<!-- END FORM-->
					</form>  
				</div>
			</div>
			<!-- END PORTLET-->
						
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption"><i class="icon-reorder"></i>{{ t('creditsallusers') }}</div>
				</div>
				
				<div class="portlet-body form">
					@if(Session::has('credit_all'))
			
						<div class="alert alert-success">
							{{ t('alluserscredited') }}
						</div>
			
					@endif
					<!-- BEGIN FORM-->
					<form action="{{URL::to('/czar/credit_all_users')}}" id="form-credit-all" class="form-horizontal" method="post">
						<div class="control-group" id="control-all-users-credit">
							<label class="control-label">{{ t('credits') }}</label>
							<div class="controls">
								<input type="number" class="m-wrap" name="all_users_credit" id="all_users_credit" value="" pattern="\d+" min="0" step="50">
							</div>
						</div>
						
						<div class="control-group" id="control-reason">
							<label class="control-label">{{ t('reason') }}</label>
							<div class="controls">
								<input type="text" class="m-wrap" name="reason" id="reason" value="">
							</div>
						</div>
											
						<div class="form-actions">
							<button type="submit" class="btn green" id="creditAllBtn">{{ t('submit') }}</button>
						</div>
					</form>
					<!-- END FORM-->  
				</div>
			</div>
						
		</div>
	</div>

@endsection

@section("scripts")

<script type="text/javascript">

$(function  () {	
	$("#addPackageBtn").click(function(e){
		
		e.preventDefault();
		
		$("#addPackageBtn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
		$("#addPackageBtn").attr("disabled", true);
		
		$("#control-credits").removeClass("has-error");
		$("#control-package-amt").removeClass("has-error");
	 	$(".help-inline").remove();
	 	
	 	var incomplete_data = 0;
		
		if($("#credits").val() == null || $("#credits").val() == ''){
	 	
	 		$("#control-credits").addClass("has-error");
	 		$("#credits").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("creditsrequiredmsg") }}</label>');
	 		incomplete_data =1;
	 	
	 	} else  if ($("#cost").val() == null || $("#cost").val() == ''){
	 	
	 		$("#control-package-amt").addClass("has-error");
	 		$("#cost").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("costrequiredmsg") }}</label>');
	 	
	 	} else {
	 		$("#form-credits-package").submit();
	 	}
		
		$("#addPackageBtn").removeAttr("disabled");
		$("#addPackageBtn").find(':first-child').remove();
	});
	
	$("#creditAllBtn").click(function(e){
		
		e.preventDefault();
		
		$("#creditAllBtn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
		$("#creditAllBtn").attr("disabled", true);
		
		$("#control-all-users-credit").removeClass("has-error");
		$("#control-reason").removeClass("has-error");
	 	$(".help-inline").remove();
	 	
	 	var incomplete_data = 0;
		
		if($("#all_users_credit").val() == null || $("#all_users_credit").val() == ''){
	 	
	 		$("#control-all-users-credit").addClass("has-error");
	 		$("#all_users_credit").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("creditsrequiredmsg") }}</label>');
	 		incomplete_data =1;
	 	
	 	} else  if ($("#reason").val() == null || $("#reason").val() == ''){
	 		
	 		$("#control-reason").addClass("has-error");
	 		$("#reason").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("reasonisrequired") }}</label>');
	 		incomplete_data =1;
	 		
	 	} else {
	 		$("#form-credit-all").submit();
	 	}
	 	
		$("#creditAllBtn").removeAttr("disabled");
		$("#creditAllBtn").find(':first-child').remove();
	});
});
</script>

@endsection
