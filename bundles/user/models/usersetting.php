<?php


class UserSetting extends Eloquent{
		
	public static $table = 'user_settings';
	
	public static function setting($name, $id){
		$userSetting = UserSetting::where('user_id',"=",$id)->where("name","=",$name)->first();
		
		if($userSetting == null) {
			return FALSE;
		}
		
		return $userSetting->value;
	} 
	
	
	public static function get_setting($name, $id){
	
		$userSetting = UserSetting::where('user_id',"=",$id)->where("name","=",$name)->first();
		
		if($userSetting)
		{
		
			return $userSetting;
			
		}
		else{
		
			return FALSE;
		
		}
	
	
	}
}	