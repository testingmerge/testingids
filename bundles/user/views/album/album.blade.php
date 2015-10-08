@layout("twocolumn")

@section('styles')

	<link href="{{ asset('assets/css/prettyPhoto.css') }}" rel="stylesheet" />
	
	
	<style>
	
	.fdw-background{ background-color:rgba(0,0,0,0.6);opacity:0; margin-top:-25px; width:100%; height:100%; }
	.fdw-background h4{font-size:20px; font-family: 'Dosis', sans-serif; text-align:center; padding:40px 40px 0; }
	.fdw-background .fdw-port{ text-align:center; padding:0 40px 0; }
	.fdw-background .fdw-port a{ padding:8px 15px; font-size:1em; }
	/*subtitle*/
	.fdw-subtitle{ font-size:0.8em; margin-top:-20px; color:#0CF; }
	.fdw-subtitle a{ color:#F90; }
	/*columns*/
	.c-two{ width:314px !important; }
	/*align*/
	.a-center{ text-align:center; }
	/*border*/
	.border{ border:1px solid #CCC; margin:-1px;}
	/*link buttons*/
    .fdw-port a{ 
		background-color:#336699; 
		color:#fff; 
		border-radius:3px;
		-moz-border-radius:3px;
		-webkit-border-radius:3px;
		-o-border-radius:3px;
		-webkit-box-shadow: 0 3px 0 #0f3963, 3px 5px 3px #333;
		-moz-box-shadow: 0 3px 0 #0f3963, 3px 5px 3px #333;
		box-shadow: 0 3px 0 #0f3963, 3px 5px 3px #333;
		-o-box-shadow: 0 3px 0 #0f3963, 3px 5px 3px #333;
		text-shadow:0 1px 1px #000;
	}
    .fdw-port a:hover{ 
		background-color:#f2f2f2; 
		color:#336699 !important; 
		text-shadow:0 1px 1px #ccc;
		-webkit-box-shadow: 0 3px 0 #ccc, 3px 5px 3px #333;
		-moz-box-shadow: 0 3px 0 #ccc, 3px 5px 3px #333;
		box-shadow: 0 3px 0 #ccc, 3px 5px 3px #333;
		-o-box-shadow: 0 3px 0 #ccc, 3px 5px 3px #333;
	}
	
	.widget .panel-body { padding:0px; }
.widget .list-group { margin-bottom: 0; }
.widget .panel-title { display:inline }
.widget .label-info { float: right; }
.widget li.list-group-item {border-radius: 0;border: 0;border-top: 1px solid #ddd;}
.widget li.list-group-item:hover { background-color: rgba(86,61,124,.1); }
.widget .mic-info { color: #666666;font-size: 11px; }
.widget .action { margin-top:5px; }
.widget .comment-text { font-size: 12px; }
.widget .btn-block { border-top-left-radius:0px;border-top-right-radius:0px; }
	
	</style>


@endsection

@section('right_section')

					
      	<div class="col-md-9 border-div">

      			 <div class="col-md-12">

      									<h3>{{ $profile->user->name }}, {{ $profile->user->age }} <small>
										@if($profile->user->isOnline())
										<div class="status-online"></div>{{ t('iamonline') }}
										@else
										{{ t('lastonline') }} {{ $profile->user->lastLoginDays() }}
										@endif
										</small></h3>

      			</div>

      			<div class="col-md-12">

										<ul class="nav nav-tabs pull-right" >
										  <li><a href="{{ url('/profile/'.$profile->user->id) }}"><span class="glyphicon glyphicon-user"></span> {{ t('profile') }}</a></li>
										  <li class="active"><a href="#"><span class="glyphicon glyphicon-picture"></span> {{ t('photos') }}</a></li>
										</ul>

									@if($profile->user->id != Auth::user()->id)
										<div class="btn-group">
										  <button type="button" class="btn btn-default btn-xs chat-now-btn" data-user-id="{{ $profile->user->id }}"><i class="fa fa-comment fa-2 text-primary"></i> {{ t('chatnow') }}</button>
										  @if(!Auth::user()->isMeet($profile->user->id))
										  <button type="button" class="btn btn-default btn-xs meet-me-btn" data-user-id="{{ $profile->user->id }}"><i class="fa fa-check fa-2 text-success"></i> {{ t('meet') }} {{ $profile->user->thirdPersonGender() }}</button>
										  @endif
										   @if(!Auth::user()->isFavourite($profile->user->id))
										  <button type="button" class="btn btn-default btn-xs add-favourite-btn" data-user-id="{{ $profile->user->id }}"><i class="fa fa-star fa-2 text-warning"></i> {{ t('addasfavorite') }}</button>
										  @else
										  <button type="button" class="btn btn-default btn-xs unfavourite-btn" data-user-id="{{ $profile->user->id }}"><i class="fa fa-times-circle-o fa-2 text-danger"></i> {{ t('unfavorite') }}</button>
										  @endif
										  <div class="btn-group">
											  <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
												or<span class="caret"></span>
											  </button>
											  <ul class="dropdown-menu" role="menu">
												<!-- <li><a href="javascript:;" class="give-gift-btn"><i class="fa fa-gift fa-2 text-danger"></i> Give a Gift</a></li> -->
												@if(!Auth::user()->iBlocked($profile->user->id))
												<li><a href="javascript:;" class="block-btn" data-user-id="{{ $profile->user->id }}"><i class="fa fa-minus-circle fa-2 text-danger"></i> {{ t('block') }}</a></li>
												@else
												<li><a href="javascript:;" class="unblock-btn" data-user-id="{{ $profile->user->id }}"><i class="fa fa-plus-circle fa-2 text-danger"></i> {{ t('unblock') }}</a></li>
												@endif
												<li><a href="javascript:;" class="report-abuse-btn" data-user-id="{{ $profile->user->id }}" data-username="{{ $profile->user->name }}"><i class="fa fa-exclamation-triangle fa-2 text-danger"></i> {{ t('reportabuse') }}</a></li>
											  </ul>
											</div>
										</div>
										@else
								
										<input type="submit" id="save-changes-btn" class="btn btn-small btn-primary btn-xs" value="Add Photo" data-toggle="modal" data-target="#uploadPhoto" />
										
										<div class="modal fade" id="uploadPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title" id="myModalLabel">{{ t('uploadphoto') }}</h4>
											  </div>
											  <div class="modal-body">
											  
													{{ Form::open_for_files("/upload_photo","POST",array("id"=>"uploadPhotoForm")) }}
													<div class="alert alert-danger upload-error" style="display:none" id="nofile-error">{{ t('pleaseselectfile') }}</div>
																			<div class="alert alert-danger upload-error" style="display:none" id="type-error">{{ t('imagetypeerror') }}</div>
																			<div class="alert alert-danger upload-error" style="display:none" id="size-error">{{ t('imagesizeerror') }}</div>
																			<div class="alert alert-danger upload-error" style="display:none" id="dimension-error">{{ t('imagepixelerror') }}</div>
																			<div class="alert alert-danger upload-error" style="display:none" id="other-error">{{ t('somethingwrong') }}</div>
														
													{{ Form::file('photo', array("title"=>'Choose your file', "id"=>"photo")) }}
													
												
													
											  </div>
											  <div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">{{ t('close') }}</button>
												<button type="submit" id="submit-btn" class="btn btn-primary">{{ t('upload') }}</button>
												{{ Form::close() }}
											  </div>
											</div><!-- /.modal-content -->
										  </div><!-- /.modal-dialog -->
										</div><!-- /.modal -->
										
										
										
										@endif


      			</div>

      			<div class="col-md-12 top-buffer">

      						<div class="row">
      							<div class="col-md-12">
      									<h5 class="profile-heading">{{ $profile->user->name }}{{ t('sphoto') }} <small>({{ $profile->user->photos_count() }})</small></h5>
      							</div>
      		
      	@forelse($profile->user->photos() as $photo)
      			
      	<div class="col-xs-6 col-md-3" style="text-align: center;margin-bottom:10px;">			
        <div>

          <a href="{{ $photo->original() }}" rel="prettyPhoto[album]" class="thumbnail" style="margin-bottom:5px;">
            <img class="img-responsive" style="display: block;" src="{{ $photo->small() }}">
          </a>
        	
          <div class="rating-badge rating-badge-yellow">{{ $photo->rating }}</div>
          
          	
        </div>
        @if(Auth::user()->id == $profile->user->id)
        <button class="btn btn-danger btn-xs delete_photo" data-photo-id="{{ $photo->id }}" data-photo-src="{{ $photo->medium() }}">{{ t('deletephoto') }}</button>
        @else
        <span style="font-size: 0.9em;">{{ Auth::user()->my_photo_rating($photo->photo_id) }}</span>
        @endif
        </div>
        
        
        
        @empty
        
        <div class="col-md-12 well" style="text-align:center">
        	{{ t('nophotos') }}
        </div>
     
     	@endforelse


     	<div class="col-md-12" style="padding-top: 20px;">
     		<div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">                
                    <form accept-charset="UTF-8" action="" method="POST">
                        <textarea id="comment" class="form-control counted" name="message" placeholder="{{ t('typeinyourmessage') }}" rows="5" style="margin-bottom:10px;"></textarea>
                        <button class="btn btn-info pull-right" id="post_comment" type="submit">{{ t('comment') }}</button>
                    </form>
                </div>
            </div>
        </div>
     	</div>
     	<div class="col-md-12 widget" style="padding-top: 20px;">


     				<ul class="list-group">

     				@foreach($profile->user->album_comments() as $comment)
                    
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-1">
                                <img src="{{ $comment->user()->thumbnailPhoto() }}" class="img-circle img-responsive" alt="" /></div>
                            <div class="col-xs-10 col-md-11">
                                <div>
                                      <a href="{{ $comment->user()->profile_url() }}">
                                        {{ $comment->user()->name }}</a>
                                        <div class="mic-info">
                                         {{ $comment->created_at }}
                                    </div>
                                </div>
                                <div class="comment-text">
                                    {{ $comment->message }}
                                </div>
                                <div class="action pull-right">

                                	@if((Auth::user()->id == $comment->user_id) || (Auth::user()->id == $profile->user->id))
                                    <button type="button" data-comment-id="{{ $comment->id }}" id="delete-comment-btn" class="btn btn-danger btn-xs" title="Delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>

                    @endforeach

                </ul>

     	</div>






      </div>

      			</div>


      		</div>




<div class="modal fade" id="deletePhotoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
{{ Form::open('/delete_photo', 'POST', array("id"=>"deletePhotoForm")) }}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">{{ t('deletephoto') }}?</h4>
      </div>
      <div class="modal-body">
      	<div id="delete_photo_display" style="text-align: center;">
      		
      	</div>
       <input type="hidden" name="delete_photo_id" id="delete_photo_id" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">{{ t('cancel') }}</button>
        <button type="submit" class="btn btn-primary btn-xs">{{ t('delete') }}</button>
      </div>
    </div>
  </div>
  {{ Form::close() }}
</div>



@endsection



@section('scripts')

<script src="{{ asset('assets/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-rating-input.js') }}"> </script>

<script>

	$(function()
{
	// Variable to store your files
	var files;

	// Add events
	$('#photo').on('change', prepareUpload);
	$('#uploadPhotoForm').on('submit', uploadFiles);

	// Grab the files and set them to our variable
	function prepareUpload(event)
	{
		files = event.target.files;
		
	}

	// Catch the form submit and upload the files
	function uploadFiles(event)
	{
	
		event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening
	
		if(!files)
		{
		
			        $("#nofile-error").show();
            		$("#submit-btn").find(':first-child').remove();
		
			return false;
		}
	
	


		$(".upload-error").hide();
        // START A LOADING SPINNER HERE
        
        $("#submit-btn").prepend('<i class="fa fa-spinner fa-spin"></i> ');

        // Create a formdata object and add the files
		var data = new FormData();
		$.each(files, function(key, value)
		{


			data.append(key, value);
		});
		

        
        $.ajax({
            url: '{{ url("/upload_photo") }}',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(data, textStatus, jqXHR)
            {
            	

            	if(typeof data.errors === 'undefined')
            	{
					
            		submitForm(event, data);
            	}
            	else if(data.errors == "type")
            	{
            	
            		$("#type-error").show();
            		$("#submit-btn").find(':first-child').remove();
            		
            	} 
            	else if(data.errors == "size")
            	{
            	
            		$("#size-error").show();
            		$("#submit-btn").find(':first-child').remove();
            		
            	} 
            	else if(data.errors == "dimension")
            	{
            	
            		$("#dimension-error").show();
            		$("#submit-btn").find(':first-child').remove();
            		
            	} 
            	
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            
     
            		$("#other-error").show();
            		$("#submit-btn").find(':first-child').remove();
            
            	// STOP LOADING SPINNER
            }
        });
    }

    function submitForm(event, data)
	{
		$('#uploadPhoto').modal('hide');
		$("#submit-btn").find(':first-child').remove();
		window.location.reload();
	
	}
	
	
	$("a[rel^='prettyPhoto']").prettyPhoto({allow_expand: false});
	
	

	//portfolio - show link
	$('.fdw-background').hover(
		function () {
			$(this).animate({opacity:'1'});
		},
		function () {
			$(this).animate({opacity:'0'});
		}
	);
	
	
	$(".delete_photo").click(function(){
	
		$photo_id = $(this).data('photo-id');
		$photo_src = $(this).data('photo-src');
		
		$("#delete_photo_display").html("<img src='"+$photo_src+"' />");
		$("#delete_photo_id").val($photo_id);
	
		$('#deletePhotoModal').modal('show');
	
	});	


	$("#post_comment").click(function(e){

		e.preventDefault();

		$.post('{{ url("/user/comment") }}', { message : $("#comment").val(), album_id : "{{ $profile->user->id }}" }, function(data){

				data = JSON.parse(data);
				if(data.success){

					window.location.reload();
				}

		})

	});


	$("#delete-comment-btn").click(function(){

		$.post('{{ url("/user/delete_comment") }}', { comment_id : $(this).data("comment-id") }, function(data){

			data = JSON.parse(data);
				if(data.success){

					window.location.reload();
				}

		})


	})

	
	
	
});


</script>


@endsection