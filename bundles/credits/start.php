<?php


Autoloader::directories(array(
    Bundle::path('credits').'models',
   
));


Event::listen('user.created', function($user){

	$credit = new Credit;
	$credit->user_id = $user->id;
	$credit->balance = s('defaultcredits');
	$credit->save();


});