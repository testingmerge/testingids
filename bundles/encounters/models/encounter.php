<?php


class Encounter extends Eloquent{


	public static function mutual_attraction($userA, $userB){
	
		$userA_encounter = Encounter::where("from_user","=",$userA)->where("to_user","=",$userB)->first();
		$userB_encounter = Encounter::where("from_user","=",$userB)->where("to_user","=",$userA)->first();
		
		
		if($userA_encounter && $userB_encounter)
		{
		if($userA_encounter->status == 1 && $userB_encounter->status == 1)
		{
		
			return true;
		
		}
		else{
		
		return false;
		
		}
		}
		else{
		
			return false;
		
		}
	
	
	}


}