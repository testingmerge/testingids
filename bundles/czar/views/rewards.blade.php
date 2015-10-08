@layout('czar::pageshell')

@section('content')

<div class="row-fluid" style="margin-top:60px;">
		<div class="span12">
			<!-- BEGIN PORTLET-->
			
			@if(Session::has('all_rewards_disabled'))
		
				<div class="span9" style="margin-top:60px;">
					<div class="alert alert-block">
						
						{{ t('rewardsdisabledduetonorewardpckmsg') }}
					</div>
				</div>
		
			@elseif(Session::has('all_rewards_and_topup_disabled'))
		
				<div class="span9" style="margin-top:60px;">
					<div class="alert alert-block">
						
						{{ t('rewardsdisabledduetonorewardpckmsg') }}
						{{ t('spotlightandsuperpowerdisabled') }}
					</div>
				</div>
		
			@endif
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption"><i class="icon-reorder"></i>{{ t('general') }}</div>
				</div>
							
				<div class="portlet-body form">
				<!-- BEGIN FORM-->
					<form action="{{url('/czar/update_rewards_setting')}}" id="form-username" class="form-horizontal" method="post">
						<div class="control-group">
							<label class="control-label">{{ t('rewards') }} </label>
							<div class="controls">
								{{ Form::select('isrewards', array('1' => t("enable"), '0' => t("disable") ), "$isrewards",array('class' => 'span3 chosen', 'id' => 'isrewards')) }}
							</div>
						</div>
						
						<div class="form-actions">
							<button type="submit" class="btn green">{{ t('update') }}</button>
						</div>
						<!-- END FORM-->  
					</form>
				</div>
			</div>

			<!-- END PORTLET-->
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<!-- BEGIN PORTLET-->   
			@if($isrewards == 1)  
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption"><i class="icon-reorder"></i>{{ t('rewarddetails') }}</div>
					</div>
								
					<div class="portlet-body form">
						<table class="table table-bordered">
							<thead>
							 	<td class="span5"><strong>{{ t('reason') }}</strong></td>
							 	<td class="span2"><strong>{{ t('credits') }}</strong></td>
							 	<td ></td>
							 </thead>
							 
							 <tbody>
								<form action="{{url('/czar/update_rewards')}}" id="settingForm" class="form-horizontal" method="post">
									@foreach($rewards as $reward)
									  	<tr>
										 	<td class="span2">{{ t(RewardPackage::getreasons($reward->reason))}}</td>
										 	<td class="span3"><input type="text" name="credits{{$reward->id}}"   value="{{ $reward->credits }}"></td>
										 	<td >
										 		{{ Form::select("isenable".$reward->id, array('1' => t("enable") , '0' =>  t("disable") ), "$reward->status",array('class' => 'span4 chosen', 'id' => 'isenable'.$reward->id)) }}
										 	</td>
										</tr>
								 	@endforeach
							</tbody>
						</table>
						
						<div class="form-actions">
							<button type="submit" class="btn green">{{ t('update') }}</button>
						</div>
						</form>
					</div>
				</div>
				
				<!-- BEGIN PORTLET-->   
			
			@endif
			<!-- END PORTLET-->
		</div>
	</div>

@endsection 
