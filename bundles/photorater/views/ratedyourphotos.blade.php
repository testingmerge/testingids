@layout("twocolumn")




@section("right_section")

	<div class="col-md-9 border-div">
			
				      		<div class="row">
				      		
				      				<div class="col-md-12" style="text-align:center;">
				      				
				      					<h4 class="profile-heading">{{ $title }}</h4>
				      					<hr/>
				      				</div>
				      		
				      		</div>
				      		
				      		<div class="row">
				      			
				      				
				      				@forelse($photos as $photo)
				      				<div class="col-md-12">
				      					<div class="row" style="margin-bottom:5px;">
				      						
				      						<div class="col-md-4">
				      							<div class="pull-right"  style="background: url({{ $photo->medium() }});background-size: cover;height: 180px;width: 200px;">
				      							</div>
				      						</div>
				      						<div class="col-md-6">
												<div class="row">
													@forelse($photo->raters as $rater)
													
														<a  href="{{ $rater->profile_url() }}" title="{{ $rater->name}}, {{ $rater->age }}"><div class="col-md-1" style="background: url({{ $rater->thumbnailPhoto() }});background-size: cover;height: 70px;width: 70px; margin: 5px;" ></div></a>
													
													@empty
													
													<p>No ratings yet!</p>
													
													@endforelse
												
												</div>

												
				      						</div>
				      				
				      						
				      					
				      					</div>
				      					<div class="row">
													<hr/>
												</div>
										
				      				</div>
				      				
				      				@empty
				      				
				      				<div class="col-md-12" style="text-align: center;">
				      					<div class="well">
				      					None, Yet!
				      					</div>
				      					
				      				</div>
				      				@endforelse
				      				
				      				
				      			
				      		
				      		</div>
				      		
				      		
				      		
				      		
	</div>



@endsection