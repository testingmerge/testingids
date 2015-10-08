@layout('installer::pageshell')

@section('content')
<span>

	<img src="{{ asset('assets/images/minglematic_grey.png') }}" /> <span class="text-berry pull-right">Installing {{ Config::get('installer::installer.product') }} Version {{ Config::get('installer::installer.version') }}</span>

</span>
<div class="panel panel-default">
<div class="panel-heading" style="text-align:center">
<div class="btn-group">
                                            <button type="button" class="btn btn-cyanide disabled">Step 1</button>
                                        </div>
                    <div class="btn-group">
                                            <button type="button" class="btn btn-cyanide">Step 2</button>
                                        </div>
                                        
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-cyanide  disabled">Step 3</button>
                                        </div>
                                        <p class="lead" style="margin-top:10px;">
                                        	Installation
                                        </p>
</div>

<div class="panel-body">

						{{ Form::open('/installer/step2', 'POST') }}
                            
                            
                            <div class="progress progress-striped active">
  <div id="progress_bar" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">

  </div>
</div>

<div>
<strong id="feedback" class="text-success">Setting Up Database...</strong>
</div>

                
                

                
                
                
                            
                        <div class="pull-right">
                        	<div id="continue" class="btn-group" style="display:none;">
                        					
                                            <button type="submit" class="btn btn-success btn-xs">Continue</button>
                                      
                                        </div>
                        </div>
                        
                        {{ Form::close() }}
</div>


@endsection



@section('scripts')

<script>



$(function(){

setTimeout(function(){
$("#progress_bar").css('width','60%');
$.post('{{ url("installer/install_db") }}', function(){
	
	
		$("#progress_bar").css('width','100%');
		$("#feedback").html("Installation Complete");
		$("#continue").show();
	
	});
	
}, 2000);

});

</script>

@endsection
