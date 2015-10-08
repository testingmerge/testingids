@layout("czar::pageshell")


@section('content')

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>{{ t('selectdefaultlanguage') }}</div>
	</div>
	
	<div class="portlet-body form">
		@if(Session::has('language_updated'))
			
				<div class="alert alert-success">
					{{ t('changessavedmsg') }}
				</div>
			
			@endif
		<!-- BEGIN FORM-->
		<form action="{{url('/czar/language_settings')}}" id="form-general" class="form-horizontal" method="post">
		<div class="control-group">
			<label class="control-label">{{ t('defaultlanguage') }} </label>
			<div class="control-group">
				{{ Form::select('default_language',Language::all(),$default_language, array("class"=>"span3 select2")) }}
			</div>
		</div>
		

									
		<div class="form-actions">
			<button type="submit" class="btn green">{{ t('submit') }}</button>
			</form>
		</div>
		<!-- END FORM-->  
	</div>
</div>
<!-- END PORTLET-->





<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>{{ t('languagesselectablebyusers') }}</div>
	</div>
	
	<div class="portlet-body form">
		@if(Session::has('user_language_updated'))
			
				<div class="alert alert-success">
					{{ t('changessavedmsg') }}
				</div>
			
			@endif
		<!-- BEGIN FORM-->
		<form action="{{url('/czar/user_languages')}}" id="form-general" class="form-horizontal" method="post">
									<table class="table table-striped table-hover">
											<tbody>
											@foreach($user_languages as $k => $v)
											<tr>
												<td>{{ $k }}</td>
												<td>{{ Form::checkbox("$k", "$v", $v) }}</td>
												<td><a href="{{ url('czar/edit_language/'.$k) }}">{{ t('editlanguage') }}</a></td>
											</tr>
											@endforeach
											
											</tbody>
									</table>
		

									
		<div class="form-actions">
			<button type="submit" class="btn green">{{ t('submit') }}</button>
			</form>
		</div>
		<!-- END FORM-->  
	</div>
</div>
<!-- END PORTLET-->

@endsection
