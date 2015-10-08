<?php


class Setting extends Eloquent{

	 public static function get_setting($key){
     	
		$value = Setting::where('name',"=",$key)->first();
		

		if($value != null){
			$value = $value->value;
			return $value;
		}
		else {
			return "";
		}
	 }
	 
	 
	 public static function set_setting($key, $value){
     	
		$setting = Setting::where('name',"=",$key)->first();
		

		if($setting != null){
			
			$setting->value = $value;
			$setting->save();
		}
		else {
			$setting = new Setting;
			$setting->name = $key;
			$setting->value = $value;
			$setting->save();
		}
	 }
	 
	 public static function get_language(){

		if(Auth::user() && Auth::user()->language) {


	 		return Auth::user()->language;
	 	}
	 	else if(Cookie::has('language')){


	 		return Cookie::get('language');
	 	}
	 	else {

	 		return s("default_language");
	 	}
	 }
	 

}