<?php


class Notification extends Eloquent{


	public static function getNewNotifications($type, $user_id, $count = false){
	
		$notifications = Notification::where("to_user","=","$user_id")->where("status","=",0)->where("type","=","$type")->get();
		
		if(count($notifications) > 0)
		{
				if($count){
				
					return count($notifications);
				}
				else{
				
					return $notifications;
				
				}
		}
		else{
		
		return null;
		
		}

	}
	
}