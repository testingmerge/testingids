@layout('czar::pageshell')

@section('content')

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>{{ t('facebook') }}</div>
	</div>
	
	<div class="portlet-body form">
		@if(Session::has('facebook_share_updated'))
			
				<div class="alert alert-success">
					{{ t('changessavedmsg') }}
				</div>
			
			@endif
		<!-- BEGIN FORM-->
		<form action="{{url('/czar/facebook_share')}}" id="form-general" class="form-horizontal" method="post">
		<div class="control-group">
			<label class="control-label">{{ t('fbsharecompulsorynewuser') }}</label>
			<div class="control-group">
				{{ Form::select('facebook_share',array('1' => t("enable"), '0' =>  t("disable")),$facebook_share, array("class"=>"span3 select2")) }}
			</div>
		</div>
		

									
		<div class="form-actions">
			<button type="submit" class="btn green">{{ t('submit') }}</button>
			</form>
		</div>
		<!-- END FORM-->  
	</div>
</div>

@endsection
