@layout("czar::pageshell")


@section('content')






<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Languages selectable by Users</div>
	</div>
	
	<div class="portlet-body form">
		@if(Session::has('user_language_updated'))
			
				<div class="alert alert-success">
					Changes saved successfully
				</div>
			
			@endif
		@if(!$is_writable)
			<div class="alert alert-error">
					{{ $lang_path }} is not writable. Please make it writable. <button class="btn yellow btn-small" onclick="window.location.reload();">Check Again</button>
				</div>
		
		@endif
		<!-- BEGIN FORM-->
		<form action="{{url('/czar/edit_language')}}" id="form-general" class="form-horizontal" method="post">
									<input type="hidden" name="l" value="{{ $l }}" />
									<table class="table table-striped table-hover">
											<tbody>
											@foreach($language as $l)
											<tr>
												<td>{{ $l->left_lang }}</td>
												<td>
													@if(!$is_writable)
													<textarea name="{{ $l->mcode }}"  disabled>{{ $l->right_lang }}</textarea>
		
													@else
												<textarea name="{{ $l->mcode }}">{{ $l->right_lang }}</textarea>
													@endif
												</td>
											</tr>
											@endforeach
											
											</tbody>
									</table>
		

									
		<div class="form-actions">
				@if(!$is_writable)
			<button type="submit" class="btn green" disabled>Submit</button>
				@else
			<button type="submit" class="btn green">Submit</button>	
				@endif
			</form>
		</div>
		<!-- END FORM-->  
	</div>
</div>
<!-- END PORTLET-->

@endsection