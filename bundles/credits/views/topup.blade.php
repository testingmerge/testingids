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
				      				@if(Package::all())
										<thead>
										<tr>
										  <th>{{ t('credits') }}</th>
										  <th>{{ t('cost') }}</th>
										  <th>{{ t('payment') }}</th>
										</tr>
										  </thead>
									@endif
											<tbody>
				      				@forelse(Package::all() as $package)
				      					<tr>
				      						<td>{{ $package->credits }}</td>
				      						<td>${{ $package->cost }}</td>
				      						<td>
				      						<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
											<input type="hidden" name="cmd" value="_xclick">
											<input type="hidden" name="business" value="{{ s('paypalusername') }}">
											<input type="hidden" name="currency_code" value="USD">
											<input type="hidden" name="item_name" value="{{ $package->credits}}">
											<input type="hidden" name="item_number" value="{{ $package->credits}}">
											<input type="hidden" name="amount" value="{{ $package->cost }}">
										
											<input type="submit" class="btn btn-primary" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" value='{{t("payvia")}} PayPal' />
										</form>
				      						
				      						</td>
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