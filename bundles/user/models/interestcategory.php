<?php


class InterestCategory extends Eloquent{
	
	public static $table = 'interest_categories';
	
	
	public function interests_count(){
	
	
		return Interest::where('category','=',$this->code)->count();
	
	}
	
	
	public function delete_all(){
	
		$interests = Interest::where('category','=',$this->code)->get();
		
		
		foreach($interests as $interest){
		
			$interest->delete();
		
		}
		
		$this->delete();
	
	
	}
	
	public function all_interests(){
	
		return Interest::where('category',"=",$this->code)->get();
		
	}
}