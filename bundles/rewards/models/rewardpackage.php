<?php


class RewardPackage extends Eloquent{
		
	public static $table = 'reward_packages';
	
	public static $reasons = array("user.visit.profile" => "whenuservisitsaprofile",
	 "user.profile.visited" => "someonevisityourprofile",
								"user.contact.added" => 'useraddsacontact', 
								"user.encounter.yes" => "whenusersaysyesinencounters",
								 "user.login" => "whenyoulogin",
								"album.photo.upload" => "whenuseruploadsphotoinalbum",
								 "profile.photo.upload" => "whenuseraddsaprofilepicture",
								"user.invite.friend" => "whenuserinvitesafriend",
								"message.request.send"  => "whenuseraddscontact"
						
								); 
								
	public static function getreasons($key){
		return static::$reasons[$key];
	}
}	
		
