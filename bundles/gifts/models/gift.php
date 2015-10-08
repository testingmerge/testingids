<?php


class Gift extends Eloquent{
	
	public static $table = "gifts";
	
	public function iconUrl() {
		return URL::to_asset('uploads/gifts/'.$this->icon_id.'.png');
	}
	
	public function show_price(){
	
		if($this->price == 0)
		{
		
			return t('free');
		}
		else{
		
			return $this->price;
		
		}
	
	}
	
}