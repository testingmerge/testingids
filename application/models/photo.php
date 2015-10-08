<?php


class Photo extends Eloquent{


	public function original(){
	
		return URL::to_asset("uploads/originals/$this->photo_id.jpg");
	}
	
	public function small(){
	
		return URL::to_asset("uploads/small/$this->photo_id.jpg");
	
	}
	
	public function medium(){
	
		return URL::to_asset("uploads/medium/$this->photo_id.jpg");
	}
	
	public function thumbnail(){
	
		return URL::to_asset("uploads/thumbnails/$this->photo_id.jpg");
	}
	
	public static function withPhotoId($photo_id){
	
	
	return Photo::where("photo_id","=","$photo_id")->first();
	
	}

}