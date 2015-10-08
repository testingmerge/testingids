@layout("twocolumn")




@section("right_section")

	<div class="col-md-9 border-div">
			
				      		<div class="row">
				      		
				      				<div class="col-md-12" style="text-align:center;">
				      				
				      					<h4 class="profile-heading">{{ t('premiumfeatures') }}</h4>
				      					<span class="pull-right">{{ t('yourcredits') }}: {{ Auth::user()->credits() }}</span>
				      				
				      				</div>
				      		
				      		</div>
				      		
				      		<div class="row">
				      			
				      				<table class="table">
				
											<tbody>

				      					<tr>
				      						<td>{{ t('spotlight') }}</td>
				      						<td>{{ s('spotlight_cost') }}</td>
				      						<td><button data-toggle="modal" data-target="#addSpotlight" class="btn btn-primary">{{ t('buy') }}</button></td>
				      					</tr>
				      					<tr>
				      						<td>{{ t('riseup') }}</td>
				      						<td>{{ s('riseup_cost') }}</td>
				      						<td><button data-toggle="modal" data-target="#buyRiseUp" class="btn btn-primary">{{ t('buy') }}</button></td>
				      					</tr>
				      					<tr>
				      						<td>{{ t('superpower') }}</td>
				      						<td>{{ s('superpower_cost') }}</td>
				      						<td>
				      						@if(Auth::user()->isSuperpower())
				      						
				      							<small>{{ t('currentsuperpower') }} {{ Auth::user()->superpower_days() }} {{ t('days') }}</small>
				      						
				      						@else
				      						<button data-toggle="modal" data-target="#buySuperPower"  class="btn btn-primary">{{ t('buy') }}</button>
				      						@endif
				      						</td>
				      					</tr>
				      				</tbody>
				      				</table>
				      				
				      			
				      		
				      		</div>
				      		
				      		
				      	
				      		
				      		
				      		
				      		
	</div>





<div class="modal fade" id="buySuperPower" tabindex="-1" role="dialog" aria-labelledby="buySuperPower" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">{{ t('becomesuperpower') }}</h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger upload-error" style="display:none" id="superpower-balance-error">{{ t('lowbalance') }}</div>
        {{ t('thiscosts') }} {{ s('superpower_cost') }} {{ t('credits') }}. {{ t('yourbalanceis') }} {{ Auth::user()->credits() }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ t('close') }}</button>
        <button type="button" id="buy-superpower-btn" class="btn btn-primary">{{ t('add') }}</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="buyRiseUp" tabindex="-1" role="dialog" aria-labelledby="buyRiseUp" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">{{ t('riseupinsearch') }}</h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger upload-error" style="display:none" id="riseup-balance-error">{{ t('yourbalance') }}</div>
        {{ t('thiscosts') }} {{ s('riseup_cost') }} {{ t('credits') }}. {{ t('yourbalanceis') }} {{ Auth::user()->credits() }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ t('close') }}</button>
        <button type="button" id="buy-riseup-btn" class="btn btn-primary">{{ t('add') }}</button>
      </div>
    </div>
  </div>
</div>




@endsection


@section('scripts')
<script>

$(function(){



	$("#buy-superpower-btn").click(function(){
	
	 $("#buy-superpower-btn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
	
	$.post('{{ url("/buy_superpower") }}', function(data){
	
		data = $.parseJSON(data);
		if(data.success)
		{
			$("#buy-superpower-btn").find(':first-child').remove();
			$('#buySuperPower').modal('hide');
			window.location.reload();
		}
		
		if(data.error){
		
			$('#superpower-balance-error').show();
			$("#buy-superpower-btn").find(':first-child').remove();
			
		}
	
	});

	
	});
	
	
	

	$("#buy-riseup-btn").click(function(){
	
	 $("#buy-riseup-btn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
	
	$.post('{{ url("/buy_riseup") }}', function(data){
	
		data = $.parseJSON(data);
		if(data.success)
		{
			$("#buy-riseup-btn").find(':first-child').remove();
			$('#buyRiseUp').modal('hide');
			window.location.reload();
		}
		
		if(data.error){
		
			$('#riseup-balance-error').show();
			$("#buy-riseup-btn").find(':first-child').remove();
			
		}
	
	});

	
	});
	





});



</script>

@endsection