@layout('installer::pageshell')

@section('content')
<span style="text-align:center">
	<img src="{{ asset('assets/images/minglematic_grey.png') }}" />
</span>
<div class="panel panel-default">
<div class="panel-heading">
<h5 class="antagon-color-main">Welcome to MingleMatic Blaze Installer</h5> - This will install <span class="text-berry">{{ Config::get('installer::installer.product') }} Version {{ Config::get('installer::installer.version') }}</span>
</div>
<div class="panel-body">
						@if(!$storage)
						<div class="alert alert-danger fade in">
                    
                                <p>
                                    <i class="fa fa-times-circle"></i> {{ path('base').'storage/' }} should be made writable.
                                </p>


                            </div>
                        @endif

						@if(!$uploads)
						<div class="alert alert-danger fade in">
                    
                                <p>
                                    <i class="fa fa-times-circle"></i> {{ path('base').'uploads/' }} should be made writable.
                                </p>


                            </div>
                        @endif
                        
                        	@if(!$database)
						<div class="alert alert-danger fade in">
                    
                                <p>
                                    <i class="fa fa-times-circle"></i> {{ path('app').'config/database.php' }} should be made writable.
                                </p>


                            </div>
                            @endif
                            
                        	@if(!$session)
						<div class="alert alert-danger fade in">
                    
                                <p>
                                    <i class="fa fa-times-circle"></i> {{ path('app').'config/session.php' }} should be made writable.
                                </p>


                            </div>
                            @endif
                            
                            
                            @if($allclear)
                            {{ Form::open('/installer/write_permissions_check', 'POST') }}
                        <div class="pull-right">
                        	<div class="btn-group">
                                            <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-check"></i>All Set! Click Here Continue</button>
                                        </div>
                        </div>
                        	{{ Form::close() }}
                        	
                        	@else
                       <div class="pull-right">
                        	<div class="btn-group">
                                            <button type="button" class="btn btn-warning btn-xs" onclick="window.location.reload()">Check Again</button>
                                        </div>
                        </div>
                        	
                        	
                        	@endif
</div>


@endsection
