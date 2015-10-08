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
				      			
				      				
				      				@forelse($users as $user)
				      				<div class="col-md-12">
				      					<div class="row" style="margin-bottom:5px;">
				      						
				      						<div class="col-md-4">
				      							<div class="pull-right"  style="background: url({{ $user->smallPhoto() }});background-size: cover;height: 180px;width: 200px;">
				      							</div>
				      						</div>
				      						<div class="col-md-6">
												<div class="row">
														
															<ul class="top-buffer" style="list-style-type: none;padding: 0px;font-size: 0.8em;">
																	<li><span class="lead">{{ $user->name }}, {{ $user->age }}</span></li>
																	<li><i class="fa fa-home"></i> Lives in {{ $user->city }}</li>
																	<li><i class="fa fa-heart"></i>{{ $user->profile->relationship_status() }}</li>
																	
																</ul>
												</div>
				      							<div class="row">
				      																<div class="btn-group top-buffer">
																					  <button type="button" class="btn btn-default btn-xs chat-now-btn" data-user-id="{{ $user->id }}"><i class="fa fa-comment fa-2 text-primary"></i> Chat Now</button>
																					 	  @if(!Auth::user()->isMeet($user->id))
																						  <button type="button" class="btn btn-default btn-xs meet-me-btn" data-user-id="{{ $user->id }}"><i class="fa fa-check fa-2 text-success"></i> Meet {{ $user->thirdPersonGender() }}</button>
																						  @endif
																						   @if(!Auth::user()->isFavourite($user->id))
																						  <button type="button" class="btn btn-default btn-xs add-favourite-btn" data-user-id="{{ $user->id }}"><i class="fa fa-star fa-2 text-warning"></i> Add to Favorite</button>
																						  @endif
																					  <div class="btn-group">
																						  <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
																							or<span class="caret"></span>
																						  </button>
																						  <ul class="dropdown-menu" role="menu">
																							<li><a href="javascript:;" class="give-gift-btn"><i class="fa fa-gift fa-2 text-danger"></i> Give a Gift</a></li>
																							<li><a href="javascript:;" class="block-btn"><i class="fa fa-minus-circle fa-2 text-danger"></i> Block</a></li>
																							<li><a href="javascript:;" class="report-abuse-btn"><i class="fa fa-exclamation-triangle fa-2 text-danger"></i> Report Abuse</a></li>
																						  </ul>
																						</div>
																					</div>
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