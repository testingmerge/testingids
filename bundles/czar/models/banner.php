<?php


class Banner extends Eloquent{
	
	public static function get_banners($location) {
		
		$banner_id = s($location);
		if($banner_id != -1 && $banner_id != "") {
			 return Banner::find($banner_id)->html_code;
		}
		
		return ""; 
	}
	
	
}
