<?php


Autoloader::directories(array(
    Bundle::path('bot').'models',
   
));


if(isInstalled()){ 

if(s('no_bot')){

	Event::listen('user.created', function($user){

		if($user->role != 3)
	{ 
		$people = User::user_search($user->id, $user->profile->whyamihere, $user->profile->preferred_gender, $user->profile->preferred_age, $user->lat, $user->lng, 100, 'miles', array(), 12);


		if(empty($people)){

			Bot::create_bots($user->gender, $user->lat, $user->lng, $user->city, $user->country, s('no_bot'));

		}

	}


	});


} 

}