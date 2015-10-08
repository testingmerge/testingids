@layout("twocolumn")


@section("right_section")

     	<div class="col-md-9 border-div">

      			<div class="col-md-12 top-buffer">

              <div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-cog fa-4"></i> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu dropdown-menu-form row" role="menu">
  	{{ Form::open('/encounter', 'POST', array('id'=>'encounter_filter_form' )) }}
                      <div class="col-md-12 row">
                    <div class="col-md-12">
                    <h5 class="text-muted">{{ t('iamhereto') }}</h4>
                    </div>
                    <div class="col-md-12 small">
                            <div class="radio">
																  <label>
																   {{ Form::radio('whyamihere', '1', $makenewfriends) }}
																    {{ t('makefriends') }}
																  </label>
							
																</div>
																<div class="radio">
																  <label>
																  {{ Form::radio('whyamihere', '2', $todate) }}
																    {{ t('date') }}
																  
																  </label>
																</div>
																<div class="radio">
																  <label>
																    {{  Form::radio('whyamihere', '3', $tochat) }}
																    {{ t('chat') }}
																  </label>
																</div>
                    </div>
              </div>

              <div class="col-md-12 row">
                  <div class="col-md-12">
                  <h5 class="text-muted">{{ t('with') }}</h4>
                  </div>
                  <div class="col-md-12">
                      <div class="checkbox">
                        <label>
																	    {{ Form::checkbox('guys', '1', $guys) }}
																	    {{ t('guys') }}
																	  </label>
																	</div>
																<div class="checkbox">
																	  <label>
																	    {{ Form::checkbox('girls', '2', $girls) }}
																	    {{ t('girls') }}
																	  </label>
                      </div>
                    {{ Form::select('age_group', array('1' => '18 - 25', '2' => '25 - 30', '3' => '30 '.t('beyond')),"$profile->preferred_age",array('class' => 'select', 'id' => 'select_age')) }}
                  </div>
              </div>
              <div class="col-md-12 top-buffer">
              <button type="submit" class="btn btn-warning btn-xs" id="update-btn">{{ t('updateresults') }}</button>
              </div>
              {{ Form::close() }}
  </ul>
</div>
					
      				<h1 class="lead col-md-offset-4">
      				@if($encounter_user)
      				<strong>{{ t('wanttomeet') }} {{ $encounter_user->user->thirdPersonGender() }}?</strong>
      				@else
      				{{ t('nomoreprofiles') }}.<br/> <small>{{ t('trychangefilters') }}</small>.
      				@endif
      				</h1>



      			</div>

      			<div class="col-md-12">

					@if($encounter_user)
					<div class="row">
      				<div class="col-md-7 inner-shadow col-md-offset-2" style="padding-left:35px;">
      					{{ Form::open('/encounters/encounter_yes', 'POST', array("style"=>"display:inline-block;")) }}
      					<button type="submit" class="btn btn-success btn-large" style="height:40px;width:107px;"> <span class="h4"><i class="fa fa-check-circle-o fa-5"></i> {{ t('yes') }}</span></button>
      					{{ Form::close() }}
      					{{ Form::open('/encounters/encounter_yes', 'POST', array("style"=>"display:inline-block;")) }}
      					<button class="btn btn-warning btn-large" style="height:40px;width:107px;"><span class="h4">{{ t('maybe') }} ...</span></button>
      					{{ Form::close() }}
      					{{ Form::open('/encounters/encounter_no', 'POST', array("style"=>"display:inline-block;")) }}
      					<button class="btn btn-danger btn-large" style="height:40px;width:107px;"><span class="h4"><i class="fa fa-times-circle fa-5"></i> {{ t('no') }}</span></button>
      					{{ Form::close() }}
      				</div>
      				</div>

					<div class="row  top-buffer">
					<div class="col-md-7 col-md-offset-2" style="text-align:center;">
      				<img class="img img-polaroid col-md-offset-2 img-responsive" src="{{ $encounter_user->user->mediumPhoto() }}" />
      				</div>
      				</div>
      				@endif
      				
      				<div class="clearfix" style="margin: 50px;">
      					
      				</div>

      			</div>



      		</div>


@endsection


@section('scripts')

<script>

$(function(){
$('.dropdown-menu').on('click', function(e){
        if($(this).hasClass('dropdown-menu-form')){
            e.stopPropagation();
        }
});
});

</script>

@endsection