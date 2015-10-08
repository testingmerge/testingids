@layout('czar::pageshell')



@section('content')

<!-- BEGIN PORTLET-->   
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>{{ t('general') }}</div>							
	</div>
	
	<div class="portlet-body form">
	<!-- BEGIN FORM-->
	@if(Session::has('general_updated'))
			
				<div class="alert alert-success">
					{{ t('changessavedmsg') }}
				</div>
			
			@endif
		<form action="{{url('/czar/general_settings')}}" id="form-general" class="form-horizontal" method="post">
			<div class="control-group" id="control-general">
				<label class="control-label">{{ t('websitetitle') }}</label>
				<div class="controls">
					<input type="text" class="m-wrap" name="title" id="title" value="{{$siteTitle}}">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">{{ t('maintainancemode') }}</label>
				<div class="controls">
					{{ Form::select('mode', array('0' => t("disable"), '1' => t("enable")), $mode ,array('class' => 'span3 select2')) }}
				</div>
			</div>
									
			<div class="form-actions">
				<button type="submit" class="btn green" id="generalBtn">{{ t('submit') }}</button>
			</div>
			<!-- END FORM--> 
		</form> 
	</div>
</div>

<!-- BEGIN PORTLET-->   
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>{{ t('sitelogo') }}</div>
	</div>
	
	<div class="portlet-body form">
	@if(Session::has('logo_updated'))
			
				<div class="alert alert-success">
					{{ t('changessavedmsg') }}
				</div>
			
			@endif
		@if($sitelogourl == null) 
			<p class="text-error">{{ t('nologomsg') }}</p>
		@else
			<div class="span12">
				<div class="well span6"><p><strong>{{ t('currentlogo') }}</strong></p><br/>
					<img class="img"  src="{{URL::to_asset('uploads/app/'.$sitelogourl)}}" /><br/><br/>
					<p><form action="{{url('/czar/delete_site_logo')}}" id="form-general" class="form-horizontal" method="post">
						<input type="submit" class="btn red" value="{{ t('delete') }}"/>
						{{Form::close()}} </p>
				</div>
			</div>	
			<br/>
			<br/>
		@endif 

	
					
	{{ Form::open_for_files("/czar/upload_site_logo","POST",array("id"=>"siteLogoForm")) }}
	<div class="controls" id="control-siteLogo">
		<p>
			<p><strong>{{ t('changelogo') }}</strong></p>
			{{ Form::file('photo', array("title"=>t("choosefile"), "id"=>"sitePhoto")) }}
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
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>{{ t('sitefavicon') }}</div>
	</div>
			
	<div class="portlet-body form">

		@if(Session::has('favicon_updated'))
			
				<div class="alert alert-success">
					{{ t('changessavedmsg') }}
				</div>
			
			@endif
		@if($sitefaviconurl == null)
			<p class="text-error">{{ t('nofaviconmsg') }}</p>
		@else
			<div class="span12">
				<div class="well span6"><p><strong>{{ t('currentfavicon') }}</strong></p><br/>
					<img class="img" src="{{URL::to_asset('uploads/app/'.$sitefaviconurl)}}"/><br/><br/>
					<p><form action="{{url('/czar/delete_favicon')}}" id="form-general" class="form-horizontal" method="post">
						<input type="submit" class="btn red" value="{{ t('delete') }}"/>
						{{Form::close()}} </p>
				</div>
			</div>
			<br/>
			<br/>
		@endif 
	

		{{ Form::open_for_files("/czar/upload_favicon","POST",array("id"=>"faviconForm")) }}
		<div class="controls" id="control-favicon">
		<p>
			<p><strong>{{ t('changefavicon') }}</strong></p>
			{{ Form::file('photo', array("title"=>t("choosefile"), "id"=>"faviconPhoto")) }}
				<p class="muted">
				
				</p>
		</p>
		</div>
		<div class="form-actions">
			<input type="submit" class="btn btn-small green" value="{{ t('upload') }}" id="faviconBtn" />
			{{ Form::close() }}
		</div>
	</div>
</div>

@endsection

@section("scripts")

<script type="text/javascript">

$(function  () {	
	$("#generalBtn").click(function(e){
		e.preventDefault();
		$("#generalBtn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
		$("#generalBtn").attr("disabled", true);
		$("#control-general").removeClass("has-error");
	 	$(".help-inline").remove();
		if($("#title").val() == null || $("#title").val() == ''){
	 		$("#control-general").addClass("has-error");
	 		$("#title").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("titlecannotbeempty") }}</label>');
	 	} else {
	 		$("#form-general").submit();
	 	}
		$("#generalBtn").removeAttr("disabled");
		$("#generalBtn").find(':first-child').remove();
	});
	
	$("#siteLogoBtn").click(function(e){
		e.preventDefault();
		$("#siteLogoBtn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
		$("#siteLogoBtn").attr("disabled", true);
		$("#control-siteLogo").removeClass("has-error");
	 	$(".help-inline").remove();
		if( $("#sitePhoto").val() == ''){
	 		$("#control-siteLogo").addClass("has-error");
	 		$("#sitePhoto").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("pleaseuploadimage") }}</label>');
	 	} else {
	 		$("#siteLogoForm").submit();
	 	}
		$("#siteLogoBtn").removeAttr("disabled");
		$("#siteLogoBtn").find(':first-child').remove();
	});
	
	$("#faviconBtn").click(function(e){
		e.preventDefault();
		$("#faviconBtn").prepend('<i class="fa fa-spinner fa-spin"></i> ');
		$("#faviconBtn").attr("disabled", true);
		$("#control-favicon").removeClass("has-error");
	 	$(".help-inline").remove();
		if( $("#faviconPhoto").val() == ''){
	 		$("#control-favicon").addClass("has-error");
	 		$("#faviconPhoto").parent().append('<label for="fullname" class="help-inline help-small no-left-padding">{{ t("pleaseuploadimage") }}</label>');
	 	} else {
	 		$("#faviconForm").submit();
	 	}
		$("#faviconBtn").removeAttr("disabled");
		$("#faviconBtn").find(':first-child').remove();
	});
});
</script>

@endsection
