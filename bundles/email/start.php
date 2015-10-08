<?php



Autoloader::directories(array(
    Bundle::path('email').'models',
   
));


if(isInstalled()){ 

Config::set('messages::config.transports.smtp.host', s('email_host'));
Config::set('messages::config.transports.smtp.port', s('email_port'));
Config::set('messages::config.transports.smtp.username', s('email_username'));
Config::set('messages::config.transports.smtp.password', s('email_password'));
Config::set('messages::config.transports.smtp.encryption', s('email_encryption'));




$email_user_verification = function($user){

	if($user->role != 3){ 
				
				$content = Email::make(s("email_content_email_verification"), array(
				
					"[username]" => $user->name,
					"[verification_no]" => $user->generate_verification_url(),
					"[site_link]" => URL::base()
				
				));

	Email::send($user->email, s("email_subject_email_verification"), $content);

}


};



if(Email::config_set())
{



Event::listen('user.created', $email_user_verification);


Event::listen('user.send_verification', $email_user_verification);

Event::listen('user.send_reset_password', function($user){

				
				$content = Email::make(s("email_content_forgot_password"), array(
				
					"[username]" => $user->name,
					"[password_link]" => $user->generate_reset_password_url(),
					"[site_link]" => URL::base()
				
				));

	Email::send($user->email, s("email_subject_forgot_password"), $content);

});


Event::listen('user.visited.profile', function($visitor, $visited)
{
	$visitorUser = User::find($visitor);
    	$visitedUser = User::find($visited);

    	if($visitedUser->role != 3){ 
    	if($visitorUser->id != $visitedUser->id && $visitedUser->setting('send_profile_visitor_email') && s("email_notification_profile_visitor") ) {
    			
		$content = Email::make(s("email_content_profile_visitor"), array(
				
					"[to_username]" => $visitedUser->name,
					"[from_username]" => $visitorUser->name,
					"[from_user_profile_link]" => $visitorUser->profile_url(),
					"[site_link]" => URL::base()
				
				));

		Email::send($visitedUser->email, s("email_subject_profile_visitor"), $content);
	}
}
});


Event::listen('user.meetme', function($meetme)
{
	$visitorUser = User::find($meetme->from_user);
    	$visitedUser = User::find($meetme->to_user);
    	if($visitedUser->role != 3){
	if($visitedUser->setting('send_meet_me_email') && s("email_notification_meetme")) {
	    	if($visitedUser-> isSuperpower()) {

			$content = Email::make(s("email_content_meetme"), array(
				
						"[to_username]" => $visitedUser->name,
						"[from_username]" => $visitorUser->name,
						"[from_user_profile_link]" => $visitorUser->profile_url(),
						"[site_link]" => URL::base()
				
					));

		}
		else {
			$content = Email::make(s("email_content_meetme"), array(
				
						"[to_username]" => t("someone_wants_to_meet"),
						"[from_username]" => $visitorUser->name,
						"[from_user_profile_link]" => $visitorUser->profile_url(),
						"[site_link]" => URL::base()
				
					));
		}
		Email::send($visitedUser->email, s("email_subject_meetme"), $content);
	}

	}
});


Event::listen('user.message.sent', function($fromuser, $touser, $message)
{

		if($touser->role != 3){ 
    	if(!($touser->isOnline()) && $touser->setting('send_message_sent_email') && s("email_notification_message")) {

		$content = Email::make(s("email_content_message"), array(
				
					"[to_username]" => $touser->name,
					"[from_username]" => $fromuser->name,
					"[from_user_profile_link]" => $fromuser->profile_url(),
					"[site_link]" => URL::base(),
					"[message]" => $message,
				
				));

		Email::send($touser->email, s("email_subject_message"), $content);
	}
		}
});

Event::listen('user.contact.added', function($fromuser, $touser)
{


	if($touser->role != 3){ 

    	if($touser->setting('send_add_contact_email') && s("email_notification_add_contact")) {

		$content = Email::make(s("email_content_add_contact"), array(
				
					"[to_username]" => $touser->name,
					"[from_username]" => $fromuser->name,
					"[from_user_profile_link]" => $fromuser->profile_url(),
					"[site_link]" => URL::base()
				
				));

		
		Email::send($touser->email, s("email_subject_add_contact"), $content);
		
	}
			}
});


Event::listen('user.disabled', function($user)
{
	if($user->role != 3)
	{ 
	if(s("email_notification_disable_user")) {
		$content = Email::make(s("email_content_disable_user"), array(
				
					"[username]" => $user->name,
					"[site_link]" => URL::base()
				
				));

		Email::send($user->email, s("email_subject_disable_user"), $content);
	}
	}
});

Event::listen('user.photo.deleted', function($user)
{
	if($user->role != 3){ 
	if(s("email_notification_delete_photo")) {

		$content = Email::make(s("email_content_delete_photo"), array(
				
					"[username]" => $user->name,
					"[site_link]" => URL::base()
				
				));

		Email::send($user->email, s("email_subject_delete_photo"), $content);
	}
	}
});

Event::listen('user.deleted', function($user)
{
	if($user->role != 3){ 
	if(s("email_notification_delete_user")) {

		$content = Email::make(s("email_content_delete_user"), array(
				
					"[username]" => $user->name,
					"[site_link]" => URL::base()
				
				));

		Email::send($user->email, s("email_subject_delete_user"), $content);
	}
	}
});


Event::listen('user.photo.comment', function($fromuser, $touser)
{
	if($touser->role != 3){ 
	if($visitedUser->setting('send_photo_commented_email') && s("email_notification_comment_photo")) {
		$content = Email::make(s("email_content_comment_photo"), array(
				
					"[to_username]" => $touser->name,
					"[from_username]" => $fromuser->name,
					"[from_user_profile_link]" => $fromuser->profile_url(),
					"[site_link]" => URL::base()
				
				));

		Email::send($touser->email, s("email_subject_comment_photo"), $content);
	}
	}
});

Event::listen('user.photo.rated', function($fromuser, $touser)
{
	if($touser->role != 3){ 
	if($touser->setting('send_photo_rated_email') && s("email_notification_rate_photo")) {
	
		$content = Email::make(s("email_content_rate_photo"), array(
				
					"[to_username]" => $touser->name,
					"[from_username]" => $fromuser->name,
					"[site_link]" => URL::base()
				
				));

		Email::send($touser->email, s("email_subject_rate_photo"), $content);
	}
	}
});

Event::listen('user.gift.sent', function($fromuser, $touser)
{
	if($touser->role != 3){ 
	if($touser->setting('send_gift_sent_email') && s("email_notification_send_gift")) {

		$content = Email::make(s("email_content_send_gift"), array(
				
					"[to_username]" => $touser->name,
					"[from_username]" => $fromuser->name,
					"[from_user_profile_link]" => $fromuser->profile_url(),
					"[site_link]" => URL::base()
				
				));

		Email::send($touser->email, s("email_subject_send_gift"), $content);
	}
	}
});

Event::listen('user.mutual.attraction', function($fromuser, $touser)
{
	if($touser->role !=3){ 
	if($touser->setting('send_mutual_attraction_email') && s("email_notification_mutual_attraction")) {
	
		$content = Email::make(s("email_content_mutual_attraction"), array(
				
					"[from_user_profile_link]" => $fromuser->profile_url(),
					"[to_username]" => $touser->name,
					"[from_username]" => $fromuser->name,
					"[site_link]" => URL::base()
				
				));

		Email::send($touser->email, s("email_subject_mutual_attraction"), $content);
	}
	}
});



}


}
