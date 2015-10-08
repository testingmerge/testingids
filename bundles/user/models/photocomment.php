<?php


class PhotoComment extends Eloquent {
	
	public static $table = "photo_comments";

	public function user()
	{
		return User::find($this->user_id);
	}

}