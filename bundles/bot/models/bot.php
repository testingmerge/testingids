<?php


class Bot extends Eloquent{


	public static function create_bots($gender, $lat, $lng, $city, $country, $no){

		$gender_setting = s('bot_gender');

		if($gender_setting == 0)
		{
			$bots = Bot::all();
		}
		else if($gender_setting == 1){

			if($gender == 0){
				$selectable_gender = 1;
			}
			else if($gender == 1){
				$selectable_gender = 0;
			}

			$bots = Bot::where("gender","=",$selectable_gender)->get();
		}
		else if($gender_setting = 3){
			$bots = Bot::where("gender","=",$gender)->get();
		}


		foreach ($bots as $key => $bot) {



			$vars = array();

			$vars['name'] = $bot->name;

			$vars['lat'] = $lat;
			$vars['lng'] = $lng;
			$vars['city'] = $city;
			$vars['country'] = $country;
			$vars['gender'] = $bot->gender;
			$vars['verified'] = 1;
			$vars['photo_id'] = $bot->photo_id;
			$vars['password'] = Hash::make($bot->password);
			$vars['role'] = 3;
			$vars['age'] = $bot->age;
			$vars['email'] = uniqid()."@bot";

			$u = User::create($vars);

			Event::fire('user.created', array($u));

			$k = $key + 1;

			if($k == $no){

				break;
			}
		}
		




	}

	public function user_count(){
		if($this->user_ids == null) {
			return 0;
		} 
		$user_ids = unserialize($this->user_ids);
		$count  = 0;
    		foreach($user_ids as $id) {
			$count++;
		}
    		
		return $count;

	}


	public function add_user($user_id){

		if($this->user_ids == null) {
			$user_ids = array();
		}
		else{ 
		$user_ids = unserialize($this->user_ids);
		}


		array_push($user_ids, $user_id);

		$s = serialize($user_ids);

		$this->user_ids = $s;
		$this->save();



	}
	
	public function users(){
		if($this->user_ids == null) {
			return null;
		} 
		$user_ids = unserialize($this->user_ids);
		$users  = array();
    		foreach($user_ids as $id) {
			$user = User::find($id);
			if($user) {
				array_push($users,$user);
			} else {
				array_push($users,$id);				
			}
		}
    		
		return $users;

	}

	public function thumbnailPhoto(){
	
		if($this->photo_id != 0){
		
			return URL::to_asset("uploads/thumbnails/$this->photo_id.jpg");
		}
		else{
		
			if($this->gender == 1)
			{
			return URL::to_asset("assets/images/male-thumbnail.jpg");
			}
			else{
			return URL::to_asset("assets/images/female-thumbnail.jpg");
			}
		}
	
	
	}


}
