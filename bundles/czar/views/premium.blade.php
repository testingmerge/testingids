@layout('czar::pageshell')



@section('content')	

	<div class="row-fluid" style="margin-top:60px;">
		<div class="span12">
			
			<!-- BEGIN PORTLET-->   
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption"><i class="icon-reorder"></i>{{ t('credits') }}</div>
				</div>
							
				<div class="portlet-body form">
					@if(Session::has('updated'))
			
						<div class="alert alert-success">
							{{ t('featuresupdatemsg') }}
						</div>
			
					@endif
					<table class="table table-bordered">
						<thead>
						 	<td class="span2"><strong>{{ t('feature') }}</strong></td>
						 	<td class="span3"><strong>{{ t('credits') }}</strong></td>
						 </thead>
						 
						 <tbody>
							<form action="{{url('/czar/updatefeatures')}}" id="settingForm" class="form-horizontal" method="post">
								
								  	<tr>
									 	<td class="span2">{{ t('spotlight') }}</td>
									 	<td class="span3"><input type="text" name="spotlight_cost"   value="{{ $spotlight_cost }}">
									</tr>
									<tr>
									 	<td class="span2">{{ t('riseup') }}</td>
									 	<td class="span3"><input type="text" name="riseup_cost"   value="{{ $riseup_cost }}">
									</tr>
									<tr>
									 	<td class="span2">{{ t('superpowers') }}</td>
									 	<td class="span3"><input type="text" name="superpower_cost"   value="{{ $superpower_cost }}">
									</tr>
							 	
						</tbody>
					</table>
					
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
					</form>
				</div>
			</div>
			<!-- END PORTLET-->
		</div>
	</div>

@endsection
