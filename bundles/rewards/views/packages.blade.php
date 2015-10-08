@layout("twocolumn")




@section("right_section")

	<div class="col-md-9 border-div">
			
				      		<div class="row">
				      		
				      				<div class="col-md-12" style="text-align:center;">
				      				
				      					<h4 class="profile-heading">{{ t('packages') }}</h4>
				      					<span class="pull-right">{{ t('yourcredits') }}: {{ Auth::user()->credits() }}</span>
				      					<hr/>
				      				</div>
				      		
				      		</div>
				      		
				      		<div class="row">
				      			
				      				<table class="table">
				      				@if(RewardPackage::all())
										<thead>
										<tr>
										  <th>{{ t('rewards') }}</th>
										  <th>{{ t('credits') }}</th>
										</tr>
										  </thead>
									@endif
											<tbody>
				      				@forelse(RewardPackage::all() as $package)
				      					<tr>
				      						<td>{{ t(RewardPackage::getreasons($package->reason))}}</td>
				      						<td>{{ $package->credits }}</td>
				      					</tr>
				      				
				      				@empty
				      				
				      				<div class="col-md-12" style="text-align: center;">
				      					<div class="well">
				      					{{ t('noneyet') }}
				      					</div>
				      					
				      				</div>
				      				@endforelse
				      				</tbody>
				      				</table>
				      				
				      			
				      		
				      		</div>
				      		
				      		
				      	
				      		
				      		
				      		
				      		
	</div>



@endsection