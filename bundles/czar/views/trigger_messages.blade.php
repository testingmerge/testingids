@layout('czar::pageshell')

@section('content')

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>{{ t('triggers') }}</div>
	</div>
	
	<div class="portlet-body form">
		@if(Session::has('triggers_updated'))
			
				<div class="alert alert-success">
					{{ t('changessavedmsg') }}
				</div>
			
			@endif

		<!-- BEGIN FORM-->
		<form action="{{url('/czar/trigger_update')}}" id="form-general" class="form-horizontal" method="post">
		<div class="control-group">
			<label class="control-label">{{ t('showsuperpowers') }} </label>
			<div class="control-group">
				{{ Form::select('show_superpowers',array('1' => t("enable") , '0' => ("disable")),$show_superpowers, array("class"=>"span3 select2")) }}
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">{{ t('showriseupmsg') }}</label>
			<div class="control-group">
				{{ Form::select('show_riseup_msg',array('1' => t("enable") , '0' => ("disable")),$show_riseup_msg, array("class"=>"span3 select2")) }}
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">{{ t('showfbinvitebox') }}</label>
			<div class="control-group">
				{{ Form::select('show_fb_invite',array('1' => t("enable") , '0' => ("disable")),$show_fb_invite, array("class"=>"span3 select2")) }}
			</div>
		</div>
		<!--
		<div class="control-group">
			<label class="control-label">{{ t('showphotorater') }}</label>
			<div class="control-group">
				{{ Form::select('show_photo_rater',array('1' => t("enable") , '0' => ("disable")),$show_photo_rater, array("class"=>"span3 select2")) }}
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">{{ t('showencounters') }} </label>
			<div class="control-group">
				{{ Form::select('show_encounters',array('1' => t("enable") , '0' => ("disable")),$show_encounters, array("class"=>"span3 select2")) }}
			</div>
		</div> -->
									
		<div class="form-actions">
			<button type="submit" class="btn green">{{ t('update') }}</button>
			</form>
		</div>
		<!-- END FORM-->  
	</div>
</div>

@endsection
