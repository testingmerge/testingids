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

  
					
      				<h1 class="lead" style="text-align:center;">
      				{{ Form::open('/rate_photo/i','POST', array("id"=>"ratePhotoForm")) }}
      				<strong>{{ t('ratethisphoto') }}</strong>
					<p>
					<input type="hidden" name="photo_id" value="{{ $photo->photo_id }}" />
					<input type="number" name="rating" id="rating_id" class="rating"/></h1>	
					</p>
					{{ Form::close() }}
      				</h1>



      			</div>

      			<div class="col-md-12" style="text-align:center;">

			


					<div class="row  top-buffer">
					<div class="col-md-7 col-md-offset-3" style="text-align:center;">
      				<img class="img img-polaroid col-md-offset-2 img-responsive" src="{{ $photo->medium() }}" />
      				</div>
      				</div>
      			
      				
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