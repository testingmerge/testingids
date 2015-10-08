@layout('czar::pageshell')



@section('content')

<div class="row-fluid">
	<div class="span12">

	<!-- BEGIN PORTLET-->   
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>{{ t('frontpagebackgroundpic') }}</div>
	</div>
	
	<div class="portlet-body form">
	@if(Session::has('frontbackgroundimage_updated'))
			
				<div class="alert alert-success">
					{{ t('changessavedmsg') }}
				</div>
			
			@endif
		@if($frontbackgroundimage == null) 
			<p class="text-error">{{ t('defaultfrontpagebck') }}</p>
		@else
			<div class="span12">
				<div class="well span6"><p><strong>{{ t('currentfrontpagebckpic') }}</strong></p><br/>
					<img class="img"  src="{{URL::to_asset('uploads/app/'.$frontbackgroundimage.'.png')}}" /><br/><br/>
					<p><form action="{{url('/czar/delete_frontpageimage')}}" id="form-general" class="form-horizontal" method="post">
						<input type="submit" class="btn red" value="{{ t('delete') }}"/>
						{{Form::close()}} </p>
				</div>
			</div>	
			<br/>
			<br/>
		@endif 

	
					
	{{ Form::open_for_files("/czar/upload_frontpageimage","POST",array("id"=>"frontpageImageForm")) }}
	<div class="controls" id="control-siteLogo">
		<p>
			<p><strong>{{ t('changefrontpagebckpic') }}</strong></p>
			{{ Form::file('photo', array("title"=> t("choosefile"), "id"=>"sitePhoto")) }}
			<p class="muted">
				
			</p>
		</p>
	</div>
		<div class="form-actions">
			<input type="submit" class="btn btn-small green" value="{{ t('upload') }}" id="siteLogoBtn" />
			{{ Form::close() }}
		</div>
	</div>
</div>{{ t('') }}

		
<!-- BEGIN PORTLET--> 



	<!-- BEGIN PORTLET-->   
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>{{ t('loginpagebckpic') }}</div>
	</div>
	
	<div class="portlet-body form">
	@if(Session::has('loginbackgroundimage_updated'))
			
				<div class="alert alert-success">
					{{ t('changessavedmsg') }}
				</div>
			
			@endif
		@if($loginbackgroundimage == null) 
			<p class="text-error">{{ t('defaultloginpagebck') }}</p>
		@else
			<div class="span12">
				<div class="well span6"><p><strong>{{ t('currentloginpagenckpic') }}</strong></p><br/>
					<img class="img"  src="{{URL::to_asset('uploads/app/'.$loginbackgroundimage.'.png')}}" /><br/><br/>
					<p><form action="{{url('/czar/delete_loginpageimage')}}" id="form-general" class="form-horizontal" method="post">
						<input type="submit" class="btn red" value="{{ t('delete') }}"/>
						{{Form::close()}} </p>
				</div>
			</div>	
			<br/>
			<br/>
		@endif 

	
					
	{{ Form::open_for_files("/czar/upload_loginpageimage","POST",array("id"=>"loginpageImageForm")) }}
	<div class="controls" id="control-siteLogo">
		<p>
			<p><strong>{{ t('changeloginpagebckpic') }}</strong></p>
			{{ Form::file('photo', array("title"=> t("choosefile"), "id"=>"sitePhoto")) }}
			<p class="muted">
				
			</p>
		</p>
	</div>
		<div class="form-actions">
			<input type="submit" class="btn btn-small green" value="{{ t('upload') }}" id="siteLogoBtn" />
			{{ Form::close() }}
		</div>
	</div>
</div>

		
<!-- BEGIN PORTLET--> 


</div>
</div> 

@endsection
