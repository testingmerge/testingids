@layout('czar::pageshell')


@section('styles')

<link rel="stylesheet" href="{{ url('/assets/css/redactor.css') }}" />

@endsection

@section('content')


<div class="row-fluid" style="margin-top:60px;">
	<div class="span12">
		<!-- BEGIN PORTLET-->   
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('emailconfigurations') }}</div>
			</div>
							
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<form action="{{URL::to('/czar/update_email_config')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('smtphost') }}</label>
						<div class="controls">
							<input type="text" class="m-wrap" name="host" id="host" value="{{$host}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('port') }}</label>
						<div class="controls">
							<input type="text" class="m-wrap" name="port" id="port" value="{{$port}}"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">{{ t('fromusername') }}</label>
						<div class="controls">
							<input type="text" class="m-wrap" name="from_username" id="encryption" value="{{$from_username}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('password') }}</label>
						<div class="controls">
							<input type="password" class="m-wrap" name="password" id="password" value="{{$password}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('encryption') }}</label>
						<div class="controls">
							<input type="text" class="m-wrap" name="encryption" id="encryption" value="{{$encryption}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('fromemail') }}</label>
						<div class="controls">
							<input type="text" class="m-wrap" name="from_email" id="encryption" value="{{$from_email}}"/>
						</div>
					</div>
									
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
		<!-- END PORTLET-->
						
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('emailnotifications') }}</div>
			</div>
							
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<form action="{{URL::to('/czar/update_email_notification')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label span5">{{ t('profilevisitdesc') }} &nbsp;</label>
						<div class="controls ">
							{{ Form::select('profilevisitor', array('1' => t("enable"), '0' => t("disable")), "$profilevisitor",array('class' => 'span3 chosen', 'id' => 'profile_visits_enable')) }}
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label span5">{{ t('meetmedesc') }} &nbsp;</label>
						<div class="controls ">
							{{ Form::select('wantstomeet', array('1' => t("enable"), '0' => t("disable")), "$wantstomeet",array('class' => 'span3 chosen', 'id' => 'wants_to_meet_enable')) }}
						</div>
					</div>

					<div class="control-group">
						<label class="control-label span5">{{ t('mutualattractiondesc') }} &nbsp;</label>
						<div class="controls ">
							{{ Form::select('mutualattraction', array('1' => t("enable"), '0' => t("disable")), "$mutualattraction",array('class' => 'span3 chosen', 'id' => 'mutual_attraction_enable')) }}
						</div>
					</div>
									
					<div class="control-group" >
						<label class="control-label span5">{{  t('addcontactdesc') }} &nbsp;</label>
						<div class="controls ">
							{{ Form::select('addcontact', array('1' => t("enable"), '0' => t("disable")), "$addcontact",array('class' => 'span3 chosen', 'id' => 'add_contact_enable')) }}
						</div>
					</div>
					
					<div class="control-group" >
						<label class="control-label span5">{{ t('giftsentdesc') }} &nbsp;</label>
						<div class="controls ">
							{{ Form::select('sendgift', array('1' => t("enable"), '0' => t("disable")), "$sendgift",array('class' => 'span3 chosen', 'id' => 'send_gift_enable')) }}
						</div>
					</div>
					
					<div class="control-group" >
						<label class="control-label span5">{{ t('msgdesc') }} &nbsp;</label>
						<div class="controls ">
							{{ Form::select('message', array('1' => t("enable"), '0' => t("disable")), "$message",array('class' => 'span3 chosen', 'id' => 'message_enable')) }}
						</div>
					</div>
									
					<div class="control-group" >
						<label class="control-label span5">{{ t('disableuserdesc') }} &nbsp;</label>
						<div class="controls ">
							{{ Form::select('disableuser', array('1' => t("enable"), '0' => t("disable")), "$disableuser",array('class' => 'span3 chosen', 'id' => 'disable_user_enable')) }}
						</div>
					</div>
					
					<div class="control-group" >
						<label class="control-label span5">{{ t('userdeletedesc') }} &nbsp;</label>
						<div class="controls ">
							{{ Form::select('deleteuser', array('1' => t("enable"), '0' => t("disable")), "$deleteuser",array('class' => 'span3 chosen', 'id' => 'delete_user_enable')) }}
						</div>
					</div>
									
					<div class="control-group " >
						<label class="control-label span5">{{ t('photodeletedesc') }} &nbsp;</label>
						<div class="controls ">
							{{ Form::select('deletephoto', array('1' => t("enable"), '0' => t("disable")), "$deletephoto",array('class' => 'span3 chosen', 'id' => 'delete_photo_enable')) }}
						</div>
					</div>
					
					<div class="control-group " >
						<label class="control-label span5">{{ t('photocommentdesc') }} &nbsp;</label>
						<div class="controls ">
							{{ Form::select('commentphoto', array('1' => t("enable"), '0' => t("disable")), "$commentphoto",array('class' => 'span3 chosen', 'id' => 'comment_photo')) }}
						</div>
					</div>
					
					<div class="control-group " >
						<label class="control-label span5">{{ t('photoratedesc') }} &nbsp;</label>
						<div class="controls ">
							{{ Form::select('ratephoto', array('1' => t("enable"), '0' => t("disable")), "$ratephoto",array('class' => 'span3 chosen', 'id' => 'rate_photo')) }}
						</div>
					</div>
									
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
						
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('profilevisitoremailcontent') }}</div>
			</div>
							
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<p><b>{{ t('profilevisitdesc') }}</b></p>
				<form action="{{URL::to('/czar/profile_visitor_email_content')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('subject') }} : </label>
						<div class="controls">
							<input type="text" class="m-wrap" name="profilevisitoremailsubject" id="encryption" value="{{$profilevisitoremailsubject}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('content') }} :  </label>
						<div class="controls">
							<textarea class="span8 m-wrap" rows="3" name="profilevisitoremail">{{$profilevisitoremail}}</textarea>
							</br><b>{{ t('fromusernameprofilevisitor') }}</b>
							</br><b>{{ t('fromuserprofilelink') }}</b>
							</br><b>{{ t('tousernameprofilevisitor') }}</b>
							</br><b>{{ t('sitelink') }}</b>
						</div>
					</div>
								
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
						
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('addcontactemailcontent') }}</div>
			</div>
							
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<p><b>{{  t('addcontactdesc') }}</b></p>
				<form action="{{URL::to('/czar/add_contact_email_content')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('subject') }} : </label>
						<div class="controls">
							<input type="text" class="m-wrap" name="addcontactemailsubject" id="encryption" value="{{$addcontactemailsubject}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label"> {{ t('content') }} : </label>
						<div class="controls">
							<textarea class="span8 m-wrap" rows="3" name="addcontactemail">{{$addcontactemail}}</textarea>
							</br><b>{{ t('fromusernameaddcontact') }}</b>
							</br><b>{{ t('fromuserprofilelink') }}</b>
							</br><b>{{ t('tousernameaddcontact') }}</b>
							</br><b>{{ t('sitelink') }}</b>
						</div>
					</div>
								
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
		
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('sendgiftemailcontent') }}</div>
			</div>
							
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<p><b>{{ t('giftsentdesc') }}</b></p>
				<form action="{{URL::to('/czar/send_gift_email_content')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('subject') }} : </label>
						<div class="controls">
							<input type="text" class="m-wrap" name="sendgiftemailsubject" id="encryption" value="{{$sendgiftemailsubject}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label"> {{ t('content') }} : </label>
						<div class="controls">
							<textarea class="span8 m-wrap" rows="3" name="sendgiftemail">{{$sendgiftemail}}</textarea>
							</br><b>{{ t('fromusernamegiftsend') }}</b>
							</br><b>{{ t('fromuserprofilelink') }}</b>
							</br><b>{{ t('tousernamegiftsend') }}</b>
							</br><b>{{ t('sitelink') }}</b>
						</div>
					</div>
								
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
		
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('msgemailcontent') }}</div>
			</div>
							
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<p><b>{{ t('msgdesc') }}</b></p>
				<form action="{{URL::to('/czar/message_email_content')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('subject') }} : </label>
						<div class="controls">
							<input type="text" class="m-wrap" name="messageemailsubject" id="encryption" value="{{$messageemailsubject}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label"> {{ t('content') }} : </label>
						<div class="controls">
							<textarea class="span8 m-wrap" rows="3" name="messageemail">{{$messageemail}}</textarea>
							</br><b>{{ t('fromusernamemsg') }}</b>
							</br><b>{{ t('fromuserprofilelink') }}</b>
							</br><b>{{ t('tousernamemsg') }}</b>
							</br><b>{{ t('printmsg') }}</b>
							</br><b>{{ t('sitelink') }}</b>
						</div>
					</div>
								
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
						
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('meetmeemailcontent') }}</div>
			</div>
			
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<p><b>{{ t('meetmedesc') }}</b></p>
				<form action="{{URL::to('/czar/meetme_email_content')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('subject') }} : </label>
						<div class="controls">
							<input type="text" class="m-wrap" name="meetmeemailsubject" id="encryption" value="{{$meetmeemailsubject}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('content') }} : </label>
						<div class="controls">
							<textarea class="span8 m-wrap" rows="3" name="meetmeemail">{{$meetmeemail}}</textarea>
							</br><b>{{ t('fromusernamemeetme') }}</b>
							</br><b>{{ t('fromuserprofilelink') }}</b>
							</br><b>{{ t('tousernamemeetme') }}</b>
							</br><b>{{ t('sitelink') }}</b>
						</div>
					</div>
								
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>


		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('mutualattractionemailcontent') }}</div>
			</div>
			
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<p><b>{{ t('mutualattractiondesc') }}</b></p>
				<form action="{{URL::to('/czar/mutual_attraction_email_content')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('subject') }} : </label>
						<div class="controls">
							<input type="text" class="m-wrap" name="mutualattractionemailsubject" id="encryption" value="{{$mutualattractionemailsubject}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('content') }} : </label>
						<div class="controls">
							<textarea class="span8 m-wrap" rows="3" name="mutualattractionemail">{{$mutualattractionemail}}</textarea>
							</br><b>{{ t('fromusernamemutualattraction') }}</b>
							</br><b>{{ t('fromuserprofilelink') }}</b>
							</br><b>{{ t('tousernamemutualattraction') }}</b>
							</br><b>{{ t('sitelink') }}</b>
						</div>
					</div>
								
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
						
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('forgotpwdmeailcontent') }}</div>
			</div>
			
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<p><b>{{ t('forgotpwddesc') }}</b></p> 
				<form action="{{URL::to('/czar/forgot_password_email_content')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('subject') }} : </label>
						<div class="controls">
							<input type="text" class="m-wrap" name="forgotpasswordemailsubject" id="encryption" value="{{$forgotpasswordemailsubject}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('content') }} : </label>
						<div class="controls">
							<textarea class="span8 m-wrap" rows="3" name="forgotpasswordemail">{{$forgotpasswordemail}}</textarea>
							</br><b>{{ t('printusername') }}</b>
							</br><b>{{ t('sitelink') }}</b>
							</br><b>{{ t('printpasswordlink') }}</b> 
						</div>
					</div>
								
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
						
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('emailverificationcontent') }}</div>
			</div>
			
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<p><b>{{ t('emailverificationdesc') }}</b></p>
				<form action="{{URL::to('/czar/email_verification_email_content')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('subject') }} : </label>
						<div class="controls">
							<input type="text" class="m-wrap" name="emailverificationemailsubject" id="encryption" value="{{$emailverificationemailsubject}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('content') }} : </label>
						<div class="controls">
							<textarea class="span8 m-wrap" rows="3" name="emailverificationemail">{{$emailverificationemail}}</textarea>
							</br><b>{{ t('printusername') }}</b>
							</br><b>{{ t('sitelink') }}</b>
							</br><b>{{ t('printverificationno') }}</b> 
						</div>
					</div>
								
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
		
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('disableuseremailcontent') }}</div>
			</div>
			
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<p><b>{{ t('disableuserdesc') }}</b></p>
				<form action="{{URL::to('/czar/disable_user_email_content')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class=deleteuseremailcontent"control-label">{{ t('subject') }} : </label>
						<div class="controls">
							<input type="text" class="m-wrap" name="disableuseremailsubject" id="encryption" value="{{$disableuseremailsubject}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('content') }} : </label>
						<div class="controls">
							<textarea class="span8 m-wrap" rows="3" name="disableuseremail">{{$disableuseremail}}</textarea>
							</br><b>{{ t('printusername') }}</b>
							</br><b>{{ t('sitelink') }}</b>
						</div>
					</div>
								
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
		
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('deleteuseremailcontent') }}</div>
			</div>
			
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<p><b>{{ t('userdeletedesc') }}</b></p>
				<form action="{{URL::to('/czar/delete_user_email_content')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('subject') }} : </label>
						<div class="controls">
							<input type="text" class="m-wrap" name="deleteuseremailsubject" id="encryption" value="{{$deleteuseremailsubject}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('content') }} : </label>
						<div class="controls">
							<textarea class="span8 m-wrap" rows="3" name="deleteuseremail">{{$deleteuseremail}}</textarea>
							</br><b>{{ t('printusername') }}</b>
							</br><b>{{ t('sitelink') }}</b>
						</div>
					</div>
								
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
		
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('deletephotoemailcontent') }}</div>
			</div>
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<p><b>{{ t('photodeletedesc') }}</b></p>
				<form action="{{URL::to('/czar/delete_photo_email_content')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('subject') }} : </label>
						<div class="controls">
							<input type="text" class="m-wrap" name="deletephotoemailsubject" id="encryption" value="{{$deletephotoemailsubject}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('content') }} : </label>
						<div class="controls">
							<textarea class="span8 m-wrap" rows="3" name="deletephotoemail">{{$deletephotoemail}}</textarea>
							</br><b>{{ t('printusername') }}</b>
							</br><b>{{ t('sitelink') }}</b>
						</div>
					</div>
								
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
		
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('photocommentemailcontent') }}</div>
			</div>
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<p><b>{{ t('photocommentdesc') }}</b></p>
				<form action="{{URL::to('/czar/comment_photo_email_content')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('subject') }} : </label>
						<div class="controls">
							<input type="text" class="m-wrap" name="commentphotoemailsubject" id="encryption" value="{{$commentphotoemailsubject}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('content') }} : </label>
						<div class="controls">
							<textarea class="span8 m-wrap" rows="3" name="commentphotoemail">{{$commentphotoemail}}</textarea>
							</br><b>{{ t('fromusernamephotocomment') }}</b>
							</br><b>{{ t('fromuserprofilelink') }}</b>
							</br><b>{{ t('tousernamephotoowner') }}</b>
							</br><b>{{ t('printcomment') }}</b>
							</br><b>{{ t('sitelink') }}</b>
						</div>
					</div>
								
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
		
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>{{ t('photorateemailcontent') }}</div>
			</div>
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<p><b>{{ t('photoratedesc') }}</b></p>
				<form action="{{URL::to('/czar/rate_photo_email_content')}}" id="form-username" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label">{{ t('subject') }} : </label>
						<div class="controls">
							<input type="text" class="m-wrap" name="ratephotoemailsubject" id="encryption" value="{{$ratephotoemailsubject}}"/>
						</div>
					</div>
									
					<div class="control-group">
						<label class="control-label">{{ t('content') }} : </label>
						<div class="controls">
							<textarea class="span8 m-wrap" rows="3" name="ratephotoemail">{{$ratephotoemail}}</textarea>
							</br><b>{{ t('fromusernamephotorater') }}</b>
							</br><b>{{ t('fromuserprofilelink') }}</b>
							</br><b>{{ t('tousernamephotoowner') }}</b>
							</br><b>{{ t('sitelink') }}</b>
						</div>
					</div>
								
					<div class="form-actions">
						<button type="submit" class="btn green">{{ t('update') }}</button>
					</div>
				</form>
				<!-- END FORM-->  
			</div>
		</div>
	</div>
</div>
@endsection


@section('scripts')

<script src="{{ url('/assets/js/redactor.min.js') }}"></script>

<script>

$(function(){

$('textarea').redactor();




})
</script>

@endsection
