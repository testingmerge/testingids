@layout("twocolumn")


@section("right_section")

     	<div class="col-md-9 border-div">


              <div class="col-md-12 row">
                
                	<div class="col-md-12" style="text-align:center;">
                		<h1>{{ t('itsamatch') }}! </h1> 
                	</div>
                	
                	<div class="col-md-12" style="text-align:center;">
                		<div class="row">
                			<div class="col-md-4">
                				<img src="{{ Auth::user()->mediumPhoto() }}" class="img-responsive img-circle" />
                			</div>
                			<div class="col-md-4">
                				{{ $encounter_user->name }} {{ t('alsosaidyestoyou') }}. {{ t('visit') }} {{ $encounter_user->thirdPersonGender()}} {{ t('profile') }} <a href="{{ $encounter_user->profile_url() }}">{{ t('here') }}</a>. 
                				<p style="margin-top:50px;">
                				<a class="btn btn-xs btn-success" href="{{ url('/encounters') }}">{{ t('continuewithencounters') }} >></a>
                				</p>
                			</div>
                			
                			<div class="col-md-4">
                				<img src="{{ $encounter_user->mediumPhoto() }}" class="img-responsive img-circle" />
                			</div>
                		</div>
                	</div>
      				
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