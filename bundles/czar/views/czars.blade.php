@layout('czar::pageshell')


@section('content')

<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN PORTLET-->   
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('addczar') }}</div>
			</div>
			
			<div class="portlet-body form">
			@if($errors->has())
			
				<div class="alert alert-error">
						<ul>
  						@foreach($errors->all() as $error)
  						
  						<li>{{ $error }}</li>
  						
  						@endforeach
  						</ul>
				</div>
			
			@endif
			
			@if(Session::has('new_czar'))
			
				<div class="alert alert-success">
					{{ Session::get('new_czar') }}
				</div>
			
			@endif
			<!-- BEGIN FORM-->
				<form action="{{url('/czar/add_new_czar')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('username') }}</label>
						<div class="controls">
							<input type="text" class="m-wrap" name="username"  >
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">{{ t('password') }}</label>
						<div class="controls">
							<input type="password" class="m-wrap" name="password" >
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">{{ t('confirmpassword') }}</label>
						<div class="controls">
							<input type="password" class="m-wrap" name="password_confirmation"  >
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


<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN PORTLET-->   
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('czars') }}</div>
			</div>
			
			<div class="portlet-body form">
			@if(Session::has('password_changed'))
			
				<div class="alert alert-success">
					{{ Session::get('password_changed') }}
				</div>
			
			@endif
			@if(Session::has('czar_deleted'))
			
				<div class="alert alert-success">
					{{ Session::get('czar_deleted') }}
				</div>
			
			@endif
					

							<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>{{ t('username') }}</th>
											<th>{{ t('lastlogin') }}</th>
											<th>{{ t('lastipaddress') }}</th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									
									@foreach($czars as $czar)
										<tr>
											<td>{{ $czar->id }}</td>
											<td>{{ $czar->username }}</td>
											<td>{{ $czar->last_login }}</td>
											<td>{{ $czar->last_ip }}</td>
											<td><button class="btn mini change_password_btn" data-czar-id="{{ $czar->id }}"></button></td>
											<td><button class="btn mini delete_czar_btn"  data-czar-id="{{ $czar->id }}"  data-czar-username="{{ $czar->username }}">{{ t('deleteczar') }}</button></td>
										</tr>
									@endforeach
									</tbody>
								</table>
								
								
									<div id="change_password_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="change_password_modal" aria-hidden="true">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h3>{{ t('changepassword') }}</h3>
									  </div>
									  <div class="modal-body">
										<p>
										{{ Form::open('/czar/change_password', 'POST') }}
										
										<label>{{ t('newpassword') }}</label>
										<input type="password" name="new_password" />
										<input id="czar_id" type="hidden" name="czar_id" />
										
										
										</p>
									  </div>
									  <div class="modal-footer">
										<button class="btn" data-dismiss="modal" aria-hidden="true">{{ t('close') }}</button>
										<button type="submit" class="btn btn-primary">{{ t('change') }}</button>
										{{ Form::close() }}
									  </div>
									</div>
									
									<div id="delete_czar_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="delete_czar_modal" aria-hidden="true">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h3>{{ t('deleteczar') }}</h3>
									  </div>
									  <div class="modal-body">
										<p>
										{{ Form::open('/czar/delete_czar', 'POST') }}
										
										<label>{{ t('deleteczarmsg') }}<span id="czar_username"></span></label>
		
										<input id="delete_czar_id" type="hidden" name="czar_id" />
										
										
										</p>
									  </div>
									  <div class="modal-footer">
										<button class="btn" data-dismiss="modal" aria-hidden="true">{{ t('close') }}</button>
										<button type="submit" class="btn btn-primary">{{ t('delete') }}</button>
										{{ Form::close() }}
									  </div>
									</div>
 
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>



@endsection


@section('scripts')

<script>

$(function(){

$(".change_password_btn").click(function(){

$("#czar_id").val($(this).data('czar-id'));

$('#change_password_modal').modal('show');


});


$(".delete_czar_btn").click(function(){

$("#delete_czar_id").val($(this).data('czar-id'));

$("#czar_username").html($(this).data('czar-username'));

$('#delete_czar_modal').modal('show');


});

});

</script>


@endsection{{ t('changepassword') }}
