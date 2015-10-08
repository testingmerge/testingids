<?php


Autoloader::directories(array(
    Bundle::path('notifications').'models',
   
));


Event::listen("user.visited.profile", function($visitor, $visited){

			
				//$notification = Notification::where('to_user',"=",$visited)->where('from_user','=',$visitor)->where('type','=','profilevisit')->first();

				$notificationVars['to_user'] = $visited;
				$notificationVars['from_user'] = $visitor;
				$notificationVars['type'] = "profilevisit";
				$notificationVars['status'] = 0;
				Notification::create($notificationVars);


});



Event::listen("user.favourite", function($favourite){

			
				//$notification = Notification::where('to_user',"=",$visited)->where('from_user','=',$visitor)->where('type','=','favourite')->first();

				$notificationVars['to_user'] = $favourite->to_user;
				$notificationVars['from_user'] = $favourite->from_user;
				$notificationVars['type'] = "favourite";
				$notificationVars['status'] = 0;
				Notification::create($notificationVars);


});


Event::listen("user.meetme", function($meetme){

			
				//$notification = Notification::where('to_user',"=",$visited)->where('from_user','=',$visitor)->where('type','=','favourite')->first();

				$notificationVars['to_user'] = $meetme->to_user;
				$notificationVars['from_user'] = $meetme->from_user;
				$notificationVars['type'] = "meetme";
				$notificationVars['status'] = 0;
				Notification::create($notificationVars);


});