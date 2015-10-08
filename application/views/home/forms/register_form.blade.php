							@include('home.errors')
								

											<form id="register-form" class="form-horizontal" action="{{ url('/register') }}" method="POST" role="form">
												<div class="form-group" id="control-name">
												<label for="name" class="col-md-2 control-label">{{ t('fullname') }}</label>
												<div class="col-md-10">
												  <input type="text" class="form-control input-sm" id="name" name="name" placeholder="{{ t('fullname') }}" value="{{ Input::old('name') }}">
												</div>
											  </div>
											  <div class="form-group" id="control-email">
												<label for="email" class="col-md-2 control-label">{{ t('email') }}</label>
												<div class="col-md-10">
												  <input type="email" class="form-control input-sm" id="email" name="email" placeholder="{{ t('Email') }}" value="{{ Input::old('email') }}">
												</div>
											  </div>
											  <div class="form-group" id="control-password">
												<label for="password" class="col-md-2 control-label">{{ t('password') }}</label>
												<div class="col-md-10">
												  <input type="password" class="form-control input-sm" id="password" name="password" placeholder="{{ t('password') }}">
												</div>
											  </div>
											  <div class="form-group" id="control-confirm-password">
												<label for="confirm_password" class="col-md-2 control-label">{{ t('confirmpassword') }}</label>
												<div class="col-md-10">
												  <input type="password" class="form-control input-sm" id="confirm_password" name="confirm_password" placeholder="{{ t('confirmpassword') }}">
												</div>
											  </div>
											   <div class="form-group" id="control-birthday">
												<label for="day" class="col-md-2 control-label">{{ t('birthday') }}</label>
												<div class="col-md-10">
												  {{ Form::select('day', days(), Input::old('month'), array("class"=>"input-sm") )}}
												  {{ Form::select('month', months(), Input::old('month'), array("class"=>"input-sm")) }}
												  {{ Form::select('year', years(1971, date('Y',strtotime("-18 years"))), Input::old('year'), array("class"=>"input-sm")) }}
												</div>

											  </div>
											  
											  <div class="form-group" id="control-gender">
												<label for="gender" class="col-md-2 control-label">{{ t('selectgender') }}</label>
												<div class="col-md-3">
												  {{ Form::select('gender', array('1'=>t('male'), '2' => t('female')), Input::old('gender'),array("class"=>"input-sm")) }}
												</div>
											  </div>
											  <div class="form-group" id="control-city">
												<label for="city" class="col-md-2 control-label">{{ t('city') }}</label>
												<div class="col-md-10">
												  <input type="text" class="form-control input-sm" id="city" name="city" placeholder="{{ t('city') }}">
												  <input type="hidden" name="lat" id="lat" value="" />
												  <input type="hidden" name="lng" id="lng" value="" />
												   <input type="hidden" name="country" id="country" value="" />
												  
												</div>
											  </div>
											  
											  <div class="form-group" id="control-captcha">
											 	 <label for="captcha" class="col-md-2 control-label">{{ t('enter') }} CAPTCHA</label>
											 	 <div class="col-md-10">
											  				 {{Form::text('captcha', '', array('class' => 'captchainput form-control', 'placeholder' => "Captcha")) }}
											  		</div>
												 <div class="col-md-10 top-buffer">
															{{Form::image(LaraCaptcha\Captcha::img(), 'captcha', array('class' => 'captchaimg'))}}
												</div>
											  
											  </div> 
											  
											 
											  <div class="form-group">
												<div class="col-md-offset-2 col-md-10">
												  <button id="register-submit-btn" type="submit" class="btn btn-success btn-xs">{{ t('signmeup') }}</button>
												</div>
											  </div>
											</form>