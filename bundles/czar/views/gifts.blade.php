@layout('czar::pageshell')

@section('content')
				
	<div class="row-fluid" style="margin-top:60px;">
		<div class="span12">
			<!-- BEGIN PORTLET-->   
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption"><i class="icon-reorder"></i>{{ t('addgifts') }}</div>
				</div>
			<div class="portlet-body form">
				@if(Session::has('gift_added'))
			
					<div class="alert alert-success">
						{{ t('giftaddsuccess') }}
					</div>
				@endif				
				<!-- BEGIN FORM-->
				{{ Form::open_for_files('/czar/add_gift', 'POST', array('class'=>'form-signin form-horizontal', 'id'=>'form-add' )) }}
	      	
					<div class="control-group" id="control-name">
						<label class="control-label" for="inputCredits">{{ t('name') }}</label>
						<div class="controls">
						      <input type="text" name="name"    value="" id="name">
						</div>
					</div>
						        
					<div class="control-group" id="control-photo">
						<label class="control-label" for="inputCost">{{ t('iconimage') }}</label>
						<div class="controls">
							{{ Form::file('photo', array("title"=>t("choosefile"), "id"=>"photo")) }}
								<p class="muted">
									{{ t('picuploadmessage') }}
								</p>
						 </div>
					</div>
					
					<div class="control-group" >
						<label class="control-label" for="inputCredits">{{ t('price') }}</label>
						<div class="controls">
						      <input type="number" name="price"    value="0">
						</div>
					</div>
					
					<div class="form-actions">
						<button class="btn green "  type="submit" id="add-btn">{{ t('add') }}</button>
					</div>
				{{ Form::close() }}
			</div>
		</div>
		<!-- END PORTLET-->

		<!-- BEGIN PORTLET-->   
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('currentgifts') }}</div>
			</div>
			
			<div class="portlet-body form">
				@if(Session::has('gift_deleted'))
			
					<div class="alert alert-success">
						{{ t('giftdeletesuccess') }}
					</div>
				@endif	
				<table class="table table-bordered">
					<thead>
					 	<td class="span2">{{ t('name') }}</td>
					 	<td class="span2">{{ t('price') }}</td>
					 	<td class="span3">{{ t('iconimage') }}</td>
					 </thead>
			  		<tbody>
						@foreach($gifts as $gift)
						  	<tr>
							 	<td class="span2">{{ $gift->name}}</td>
							 	<td class="span2">{{$gift->price}}</td>
							 	<td ><img class="img" src="{{$gift->iconURL()}}"/>
							 		<form action="{{ url('czar/delete_gift') }}" method="POST">
										<input type="hidden" name="id" value="{{ $gift->id }}" />
										<button type="submit" class="btn red mini">{{ t('delete') }}</button>
									</form>
							 	</td>
							 </tr>
					 	@endforeach
			 		</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section("scripts")

<script type="text/javascript">

$(function  () {	
	$("#add-btn").click(function(e){
	
		e.preventDefault();
		$("#add-btn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
		$("#add-btn").attr("disabled", true);
		$("#control-name").removeClass("has-error");
		$("#control-photo").removeClass("has-error");
	 	$(".help-inline").remove();
		if($("#name").val() == null || $("#name").val() == ''){
		console.log("adsjc");
	 		$("#control-name").addClass("has-error");
	 		$("#name").parent().append('<label for="fullname" class="help-inline help-small no-left-padding text-error">{{ t("namecannotbeempty") }}</label>');
	 	} else if($("#photo").val() == ''){
	 		console.log("sdh");
	 		$("#control-photo").addClass("has-error");
	 		$("#photo").parent().append('<label for="fullname" class="help-inline help-small no-left-padding text-error">{{ t("pleaseuploadimage") }}</label>');
	 	} else {
	 		$("#form-add").submit();
	 	}
		$("#add-btn").removeAttr("disabled");
		$("#add-btn").find(':first-child').remove();
	});
});

</script>

@endsection
