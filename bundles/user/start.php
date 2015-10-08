<?php






Autoloader::directories(array(
    Bundle::path('user').'models',
   
));


Event::listen('user.created', function($user)
{
    
    		$profile = new Profile();
			$profile->user_id = $user->id;
			$profile->whyamihere = 1;
			
			if($user->gender == 1)
			{
			$profile->preferred_gender = 2;
			}
			else{
			$profile->preferred_gender = 1;
			}
			
			if($user->age < 25)
			{ 
			$profile->preferred_age = 1;
			}
			else if($user->age > 25 && $user->age < 30)
			{
				$profile->preferred_age = 2;
			}
			else if($user->age >= 30)
			{
				$profile->preferred_age = 3;
			}
			
			$profile->relationshipstatus = 1;
			$profile->save();
    
});



Event::listen('user.created', function($user)
{

		$user->set_setting('show_me_offline', 0);
		$user->set_setting('hide_from_search', 0);
		
		$user->set_setting('send_add_contact_email', 1);
		$user->set_setting('send_meet_me_email', 1);
		$user->set_setting('send_photo_commented_email', 1);
		$user->set_setting('send_photo_rated_email', 1);
		$user->set_setting('send_message_sent_email', 1);
		$user->set_setting('send_profile_visitor_email', 1);
		$user->set_setting('send_gift_sent_email', 1);
		$user->set_setting('send_mutual_attraction_email', 1);


});

