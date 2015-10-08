@layout('czar::pageshell')



@section('content')

<div class="row-fluid">
	<div class="span12">
	<!-- BEGIN PORTLET-->   
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('facebook') }}</div>
			</div>
			
			<div class="portlet-body form">
				@if(Session::has('updated'))
			
					<div class="alert alert-success">
						{{ t('settingupdatemsg') }}
					</div>
				@endif
			<!-- BEGIN FORM-->
				<form action="{{url('/czar/facebook_settings')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('fbappid') }}</label>
						<div class="controls">
							<input type="text" class="m-wrap" name="facebookid" id="facebookid" value="{{$fbid}}">
						</div>
					</div>
										
					<div class="control-group">
						<label class="control-label">{{ t('fbsecret') }}</label>
						<div class="controls">
							<input type="text" class="m-wrap" name="facebooksecret" id="facebooksecret"  value="{{$fbsecret}}">
						</div>
					</div>
										
										
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('submit') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
	<!-- END PORTLET-->
	</div>
</div>
				
			

@endsection
