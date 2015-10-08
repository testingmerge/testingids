@layout("twocolumn")

@section('styles')

<style>

.rating-clear{

	font-size: 0.6em;

}

</style>

@endsection

@section("right_section")

     	<div class="col-md-9 border-div">

      			<div class="col-md-12 top-buffer">

					<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-cog fa-4"></i> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu dropdown-menu-form row" role="menu">
  	{{ Form::open('/photorater', 'POST', array('id'=>'photorater_filter_form' )) }}
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
                  <h5 class="text-muted">With</h4>
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
  
					
      			
      				
      				
      				
      				



      			</div>

      			<div class="col-md-12" style="text-align:center;">
							<h1 class="lead" style="text-align:center;">
      				@if($photo2rate)
      				{{ Form::open('/rate_photo/','POST', array("id"=>"ratePhotoForm")) }}
      				<p style="text-align:center;">
      				<strong>{{ t('ratethisphoto') }}</strong>
					<br/>
					<input type="number" name="rating" id="rating_id" class="rating"/>
					</p>
					{{ Form::close() }}
					@else
					{{ t('nomoreprofiles') }}.<br/> <small>{{ t('trychangefilters') }}</small>.
					@endif
      				</h1>
			

					@if($photo2rate)
					<div class="row  top-buffer">
					<div class="col-md-7 col-md-offset-3" style="text-align:center;">
      				<img class="img img-polaroid col-md-offset-2 img-responsive" src="{{ $photo2rate->medium() }}" />
      				</div>
      				</div>
      				@endif
      				
      				<div class="clearfix" style="margin: 50px;">
      					
      				</div>

      			</div>



      		</div>


@endsection


@section('scripts')

<script src="{{ asset('assets/js/bootstrap-rating-input.js') }}"> </script>

<script>

$(function(){
$('.dropdown-menu').on('click', function(e){
        if($(this).hasClass('dropdown-menu-form')){
            e.stopPropagation();
        }
});



$(".rating-input span").click(function(){

	setTimeout(function(){ 
	$("#ratePhotoForm").submit();
	}, 100);
	

});


});

</script>

@endsection