@layout('czar::pageshell')



@section('content')

<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN PORTLET-->   
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('addinterestcategory') }}</div>
			</div>
			
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				@if(Session::has('updated'))
			
					<div class="alert alert-success">
						{{ t('interestcategoryaddsuccess') }}
					</div>
				@endif
				<form action="{{url('/czar/add_interest_category')}}" id="form-interests-category" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('interestcategoryname') }}</label>
						<div class="controls">
							<input type="text" class="m-wrap" name="interestname" id="interestcategoryname">
						</div>
					</div>
							
					<div class="form-actions">
						<button type="button" id="add-btn" class="btn green">{{ t('add') }}</button>
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
				<div class="caption"><i class="icon-reorder"></i>{{ t('addinterests') }}</div>
			</div>
			
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				@if(Session::has('interest_added'))
			
					<div class="alert alert-success">
						{{ t('interestaddsuccess') }}
					</div>
				@endif
				<form action="{{url('/czar/add_interest')}}" id="form-interests" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('interestname') }}</label>
						<div class="controls">
							<input type="text" class="m-wrap" name="interestname" id="interestname">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">{{ t('interestcategory') }}</label>
						<div class="controls">
							{{ Form::select('interest_category', $interest_categories) }}
						</div>
					</div>
							
					<div class="form-actions">
						<button type="button" id="add-interest-btn" class="btn green">{{ t('add') }}</button>
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
				<div class="caption"><i class="icon-reorder"></i>{{ t('interestcategories') }}</div>
			</div>
			
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				@if(Session::has('interest_category_deleted'))
			
					<div class="alert alert-success">
						{ t('interestcategorydeletesuccess') }}
					</div>
				@elseif(Session::has('interest_deleted'))
			
					<div class="alert alert-success">
						{{ t('interestdeletesuccess') }}
					</div>
				@endif
							<table class="table table-striped table-hover">
									<thead>
										<tr>

											<th>{{ t('interestcategory') }}</th>
											<th>{{ t('noofinterests') }}</th>
											<th>{{ t('delete') }}</th>
										</tr>
									</thead>
									<tbody>
									
									@foreach($categories as $category)
									
										<tr class="interest-category-tr">
										
											<td>{{ $category->name }}</td>
											<td><a href="javascript:;" class="interest_count">{{ $category->interests_count() }}</a></td>
											<td>
											<form action="{{ url('czar/delete_interest_category') }}" method="POST">
												<input type="hidden" name="id" value="{{ $category->id }}" />
												<button type="submit" class="btn red">{{ t('delete') }}</button>
											</form>
											
											</td>
										
										
										</tr>
										<tr class="interest-tr" style="display:none;">
										<td>
										<table class="table">
											<tbody>
												@foreach($category->all_interests() as $interest)
											
													<tr>
														<td> {{ $interest->name }} </td>
														<td>
															<form action="{{ url('czar/delete_interest') }}" method="POST">
																<input type="hidden" name="id" value="{{ $interest->id }}" />
																<button type="submit" class="btn red mini">{{ t('delete') }}</button>
															</form>
														</td>
													</tr>
										
												@endforeach
											</tbody>
										</table>
										</td>
										</tr>
									@endforeach

									
									
									</tbody>
							</table>
			<!-- END FORM-->  
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>


@endsection



@section('scripts')

<script>

$(function(){

$("#add-btn").click(function(){

if($("#interestcategoryname").val() == "")
{

 alert("{{ t('emptyinterestcategorymsg') }}");
 
 }
 else{
 
 $("#form-interests-category").submit();
 
 }


});


$("#add-interest-btn").click(function(){

if($("#interestname").val() == "")
{

 alert("{{ t('emptyinterestnamemsg') }}");
 
 }
 else{
 
 $("#form-interests").submit();
 
 }


});


$(".interest_count").click(function(){

 var tr = $(this).parents('.interest-category-tr').get(0);
 
 
$(tr).next().toggle();


});




});



</script>


@endsection
