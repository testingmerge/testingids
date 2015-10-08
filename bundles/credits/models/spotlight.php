<?php


class Spotlight extends Eloquent{
	
	public static function spotlight_users() {
		
		$spotLightUsers = Spotlight::order_by('updated_at','desc')->order_by('rank','desc')->take(20)->get();
		$users = array();
		foreach($spotLightUsers as $spotlight) {
			$user = User::find($spotlight->user_id);
			if($user != null) {
				array_push($users,$user);
			}
			
		}
		return $users; 
	}
}