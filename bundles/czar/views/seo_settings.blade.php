@layout('czar::pageshell')



@section('content')

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>{{ t('metadata') }}</div>
	</div>
	
	<div class="portlet-body form">
		@if(Session::has('seo_updated'))
			
				<div class="alert alert-success">
					{{ t('changessavedmsg') }}
				</div>
			
			@endif
		<!-- BEGIN FORM-->
		<form action="{{url('/czar/seo_settings')}}" id="form-general" class="form-horizontal" method="post">
		<div class="control-group">
			<label class="control-label">{{ t('description') }}</label>
			<div class="control-group">
				<textarea class="span8 m-wrap" rows="3" name="description">{{$description}}</textarea>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">{{ t('keywords') }}</label>
			<div class="controls">
				<textarea class="span8 m-wrap" rows="3" name="keywords">{{$keywords}}</textarea>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">{{ t('blockcontentaccess') }}</label>
			<div class="controls">
				{{ Form::select('isSearchEngineAccess', array('1' => t("yes"), '0' => t("no")), "$isSearchEngineAccess",array('class' => 'span3 select2', 'id' => 'isSearchEngineAccess')) }}
			</div>
		</div>
									
		<div class="form-actions">
			<button type="submit" class="btn green">{{ t('submit') }}</button>
		</div>
		<!-- END FORM-->  
	</div>
</div>
<!-- END PORTLET-->

@endsection
