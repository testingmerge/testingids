@layout('czar::pageshell')

@section('content')

<div class="row-fluid" style="margin-top:60px;">
					<div class="span12">
						<!-- BEGIN PORTLET-->   
								
						
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="icon-reorder"></i>{{ t('addnewbanner') }}</div>
								
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								
								
								
								<form action="{{url('/czar/create_banner')}}" id="form-username" class="form-horizontal" method="post">
									<div class="control-group">
										<label class="control-label">{{ t('name') }}</label>
										<div class="controls">
											<input type="text" class="m-wrap" name="name" id="name" value=""/>
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label">{{ t('htmlcode') }}</label>
										<div class="controls">
											<textarea class="span8 m-wrap" rows="3" name="htmlcode"></textarea>
										</div>
									</div>
								
									<div class="form-actions">
										<button type="submit" class="btn green">{{ t('create') }}</button>
									</div>
								</form>
								<!-- END FORM-->  
							</div>
						</div>
						
						
						<div class="portlet box purple">
							<div class="portlet-title">
								<div class="caption"><i class="icon-reorder"></i>{{ t('currentbanners') }}</div>
								
							</div>
							<div class="portlet-body form">
						
								<table class="table table-bordered">
									 <thead>
									 	<td class="span2">{{ t('name') }}</td>
									 	<td >{{ t('htmlcode') }}</td>
									 	<td class="span2"></td>
									 </thead>
									  <tbody>
										@foreach($banners as $banner)
									  	<tr>
										 	<td class="span2">{{ $banner->name}}</td>
										 	<td >
										 		<form action="{{url('/czar/update_banner')}}" id="form-username" class="form-horizontal" method="post">
												<input type="hidden" class="m-wrap" name="id" id="id" value="{{$banner->id}}">
												 	<textarea class="span8 m-wrap" rows="3" name="{{$banner->id}}">{{ $banner->html_code}}</textarea>
												 	</br>
												 	<button type="submit" class="btn green">{{ t('update') }}</button>
												 </form>
											</td>
											<td><form action="{{URL::to('/czar/delete_banner')}}" id="form-delete-banner" class="form-horizontal" method="post">
								<input type="hidden" class="m-wrap" name="id" id="id" value="{{$banner->id}}">
								<button type="submit" class="btn btn-primary pull-right red"> {{ t('delete') }}</button>
								</form>
										 	</td>
										</tr> 
									 	@endforeach
									 </tbody>
								</table>
							</div>
						</div>
						
						
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="icon-reorder"></i>{{ t('assignadbanners') }}</div>
								
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								
								<form action="{{URL::to('/czar/assign_banners')}}" id="form-username" class="form-horizontal" method="post">
									<div class="control-group">
										<label class="control-label">{{ t('leftsidebar') }}</label>
										<div class="controls">
											
											{{ Form::select('leftsidebar', $bannersarray, "$leftsidebar",array('class' => 'span3 chosen')) }}
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">{{ t('topbar') }}</label>
										<div class="controls">
											
											{{ Form::select('topbar', $bannersarray , "$topbar",array('class' => 'span3 chosen')) }}
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">{{ t('bottombar') }}</label>
										<div class="controls">
											
											{{ Form::select('bottombar', $bannersarray, "$bottombar",array('class' => 'span3 chosen')) }}
										</div>
									</div>
									
									<div class="form-actions">
										<button type="submit" class="btn green">{{ t('update') }}</button>
									</div>
									
								</form>
								<!-- END FORM-->  
							</div>
						</div>
			
					</div>
				</div>


@endsection
