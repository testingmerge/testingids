@layout('czar::pageshell')



@section('content')

<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN PORTLET-->   
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('googleanalytics') }}</div>
			</div>
			
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				@if(Session::has('updated'))
			
					<div class="alert alert-success">
						{{ t('settingupdatemsg') }}
					</div>
				@endif
				<form action="{{url('/czar/analytics_settings')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('accountno') }}</label>
						<div class="controls">
							<input type="text" class="m-wrap" name="account_no" id="username1_input" value="{{$account_no}}">
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
