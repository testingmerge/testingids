@layout('czar::pageshell')



@section('content')	
	
	<div class="row-fluid search-forms search-default" style="margin-top:60px;">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('unseenreports') }}</div>
			</div>
			
			<div class="portlet-body">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th class="hidden-phone">{{ t('reportinguser') }}</th>
							<th class="hidden-phone">{{ t('reporteduser') }}</th>
							<th class="hidden-phone">{{ t('reason') }}</th>
							<th></th>
						</tr>
					</thead>
				
					<tbody>
						@foreach($unseenreports  as $report)
							
							<form action="{{URL::to('/czar/abuse_report_mark_seen')}}" id="form-username" class="form-horizontal" method="post">
								<tr>
									<td>
										@if($report->reportinguser)
											<a class="hidden-phone" href="{{ $report->reportinguser->profile_url()}}">
												<img src="{{$report->reportinguser->thumbnailPhoto()}}" alt="" height="45px" width="45px" />
												{{$report->reportinguser->name}}
											</a>
										@else
											{{ t('deleteduser') }}
										@endif
									</td>
									<td>
										@if($report->reporteduser)
											<a class="hidden-phone" href="{{ $report->reporteduser->profile_url()}}">
												<img src="{{$report->reporteduser->thumbnailPhoto()}}" alt="" height="45px" width="45px" />
												{{$report->reporteduser->name}}
											</a>
										@else
											{{ t('deleteduser') }}
										@endif
									</td>
									<td>{{$report->reason}}</td>
									<td>
											<button type="submit" class="btn green">{{ t('markseen') }}</button>
									</td>	
								</tr>
								<input type="hidden" value="{{$report->id}}" id="id" name="id">
							</form>
								<!-- END FORM--> 
							
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('seenreports') }}</div>
			</div>
			
			<div class="portlet-body">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th class="hidden-phone">{{ t('reportinguser') }}</th>
							<th class="hidden-phone">{{ t('reporteduser') }}</th>
							<th class="hidden-phone">{{ t('reason') }}</th>
							<th></th>
						</tr>
					</thead>
				
					<tbody>
						@foreach($seenreports  as $report)
							<form action="{{URL::to('/czar/abuse_report_mark_unseen')}}" id="form-username" class="form-horizontal" method="post">
								<tr>
									<td>
										@if($report->reportinguser)
											<a class="hidden-phone" href="{{ $report->reportinguser->profile_url()}}">
												<img src="{{$report->reportinguser->thumbnailPhoto()}}" alt="" height="45px" width="45px" />
												{{$report->reportinguser->name}}
											</a>
										@else
											{{ t('deleteduser') }}
										@endif
									</td>
									<td>
										@if($report->reporteduser)
											<a class="hidden-phone" href="{{ $report->reporteduser->profile_url()}}">
												<img src="{{$report->reporteduser->thumbnailPhoto()}}" alt="" height="45px" width="45px" />
												{{$report->reporteduser->name}}
											</a>
										@else
											{{ t('deleteduser') }}
										@endif
									</td>
									<td>{{$report->reason}}</td>
									<td>
											<button type="submit" class="btn green">{{ t('markunseen') }}</button>
									</td>
								</tr>
								<input type="hidden" value="{{$report->id}}" id="id" name="id">	
							</form>
								<!-- END FORM--> 
							
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
									
	</div>		
@endsection
