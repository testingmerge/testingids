<?php


class User extends Eloquent{
	
	public static $timestamps = true;
	
	 
	public function profile()
	{
		return $this->has_one('Profile');
	}	
	 
	public function notification(){
		return Notification::where('to_user', '=', $this->id)->where('status','=',0)->count();
	}
	 
	public function credits(){
		$credit = Credit::where('user_id', '=', $this->id)->first();
		if($credit != null){
			return $credit->balance;
		} else {
			return 0;
		}
	}
	
	public function setProfilePicture($photo_id){
	
		$this->photo_id = $photo_id;
		$this->save();
		Event::fire('profile.photo.upload');
	
	}

	  
	public function interests(){
		$interests = array();
		$userInterests = UserInterest::where('user_id',"=",$this->id)->get();
		foreach($userInterests as $userInterest) {
			$interest = Interest::where('id','=',$userInterest->interest_id)->first();
			if($interest != null) {
				$i = new stdClass;
				$i->id = $userInterest->id;
				$i->interest = $interest->name;
				$i->category = $interest->category;
			array_push($interests,$i);
			}
		}
		return $interests;
	}  
	  
	public function photos(){
	
		$user_id = $this->id;
	
		$photos = Photo::where('user_id',"=",$user_id)->order_by("created_at",'desc')->get();
		
		return $photos;
	}  
	
	public function photos_count(){
	
		$user_id = $this->id;
	
		$count = Photo::where('user_id',"=", $user_id)->order_by("created_at",'desc')->count();
		
		return $count;
	}  
	
	
	public function mediumPhoto(){
	
		if($this->photo_id != 0){
		
			return URL::to_asset("uploads/medium/$this->photo_id.jpg");
		}
		else{
		
			if($this->gender == 1)
			{
			return URL::to_asset("assets/images/male-medium.jpg");
			}
			else{
			return URL::to_asset("assets/images/female-medium.jpg");
			}
		}
	
	
	}
	
	public function smallPhoto(){
	
		if($this->photo_id != 0){
		
			return URL::to_asset("uploads/small/$this->photo_id.jpg");
		}
		else{
		
			if($this->gender == 1)
			{
			return URL::to_asset("assets/images/male-medium.jpg");
			}
			else{
			return URL::to_asset("assets/images/female-medium.jpg");
			}
		}
	
	
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
	  

	 
	 public function displayGender()
	 {
		 if($this->gender == 1){
		 	return t('male');
		 }
		 else {
		 	return t('female');
		 }
	 }
	 
	  public function oppositeGender()
	 {
		 if($this->gender == 1){
		 	return t('girls');
		 }
		 else {
		 	return t('guys');
		 }
	 }
	 
	  public function thirdPersonGender()
	 {
		 if($this->gender == 1){
		 	return t('him');
		 }
		 else {
		 	return t('her');
		 }
	 }
	 
	 
	 public function profile_url(){
	 
	 
	 return URL::to("/profile/$this->id");
	 
	 }
	 
	 
	 public function album_url(){
	 
	 
	 return URL::to("/album/$this->id");
	 
	 }

	 
	 
	 public function lastLoginDays()
	 {
		$prevDate = Date::forge(strtotime($this->last_login));
		
		return $prevDate->ago();
	 }
	 
	 
	 public function online(){
	 	
		$session_id = Session::$instance->session['id'];
		$this->last_login = date("Y-m-d H:i:s");
		$this->save();
		
		$session_update = DB::table('sessions')
    		->where('id', '=', $session_id)
    		->update(array('user_id' => $this->id));
	 }
	 
	 public function isOnline(){
	 	
		$session = DB::table('sessions')
    		->where('user_id', '=', $this->id)->get();
	
		if($this->setting('show_me_offline'))
		{
			return FALSE;
		}
		else{ 
		if($session)
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
		}
	 }
	 
	 
	
	 
	 
	 public static function user_search($user_id, $whyamihere, $gender, $age_group, $lat, $lng, $distance, $distance_unit, $interests, $paginate = 0){
	 

		$users = User::where("id","!=",$user_id)->where("role","!=",4)->where("role","!=",1);
	 
	 	if($age_group == 1) {
				$users = $users->where('age',"<=",25);
			} else if($age_group == 2){
				$users = $users->where('age',">",25)->where('age',"<=",30);
			} else if($age_group == 3){
				$users = $users->where('age',">",30);
			}
			
	if($gender != 3)
	 {
	 $users = $users->where('gender','=', $gender);
	 }
	 
	 
	 
	 
	 	
			
			if($distance_unit == "km") {
				$varR = 111.045;
			} else {
				$varR = 69;
			} 

	


			$userLat = number_format($lat, 6, '.', '');
			$userLng = number_format($lng, 6, '.', '');

			$minlng = $userLng-($distance/abs(cos(deg2rad($userLat))*$varR));
			$maxlng = $userLng+($distance/abs(cos(deg2rad($userLat))*$varR));
			$minlat = $userLat-($distance/$varR);
			$maxlat= $userLat+($distance/$varR);

			$minlng = number_format($minlng, 6, '.', '');
			$maxlng = number_format($maxlng, 6, '.', '');
			$minlat = number_format($minlat, 6, '.', '');
			$maxlat = number_format($maxlat, 6, '.', '');

	
			$users = $users->where_between('lat', $minlat, $maxlat);
			
			//->where_between('lng',$minlng,$maxlng);

		
			$users = $users->get();
			
			
			$ids_array = array();
			foreach($users as $user){ 
				array_push($ids_array, $user->id);
			}
			
			$tids_array = array();
			$fids_array = array();
			
			if($interests){
			$li = $interests[count($interests) -1];
			
						
			if($li == '')
			{
		
			array_pop($interests);
			
			}
			
			
			
			}

			
			
			/*
			if(count($interests) == 1 && $interests[0] == "")
			{
			
				$interests = null;
			
			}
			
			if */
					
				
			$interests_count = count($interests);
					if($interests) {
		
		
			
			foreach($interests as $interest)
			{
					$interest = Interest::where('name',"=",trim($interest))->first();
										
					if($interest)
					{
					
					$userinterests = UserInterest::where('interest_id','=',"$interest->id")->where_in('user_id', $ids_array)->get();
					
			
				
					if($userinterests)
					{
					
						foreach($userinterests as $ui)
						{
							
						array_push($tids_array, $ui->user_id);
						
						}
					
					}
					
					}
					
					
					
					
			
			}
			
			
			if($tids_array)
			{
			
				$tids_array = array_count_values($tids_array);
				
			
				
				foreach($tids_array as $k => $v)
				{
				
					if($v == $interests_count)
					{
					
						array_push($fids_array, $k);
					
					}
				
				}
				
				$ids_array = $fids_array;
			
			}
			else{
			
			
			$ids_array = null;
			
			}
			
			
			
			
		}  
		
		
		
		
		
		
		
			
			
		
		if($ids_array)
		{
			$profiles = Profile::where_in('user_id', $ids_array)->where('whyamihere','=',$whyamihere)->order_by('popularity','desc');
			if($paginate > 0)
			{
				$profiles = $profiles->paginate($paginate);
			}
			else{
					$profiles = $profiles->get();
			}
		}
		else{
		$profiles = null;
		}
		
		return $profiles;
	 
	 
	 }
	 
	 
	 public static function get_users_with($user_id, $gender, $age_group, $whyamihere){
	 
	 	$users = User::where("id","!=",$user_id)->where("role","!=",4)->where("role","!=",1);
	 
	 	if($age_group == 1) {
				$users = $users->where('age',"<=",25);
			} else if($age_group == 2){
				$users = $users->where('age',">",25)->where('age',"<=",30);
			} else if($age_group == 3){
				$users = $users->where('age',">",30);
			}
			
	if($gender != 3)
	 {
	 $users = $users->where('gender','=', $gender);
	 }
	 

	 	$users = $users->get();
	 	
	 	$ids_array = array();
	 	
			foreach($users as $user){ 
				array_push($ids_array, $user->id);
			}
	 
	 if($users)
		{
		$profiles = Profile::where_in('user_id', $ids_array)->where('whyamihere','=',$whyamihere)->get();
		}
		else{
		$profiles = null;
		}
		
		return $profiles;
	 
	 
	 
	 
	 }
	 
	 
	 public function my_photo_rating($photo_id){
	 
	
	 	$photorater = PhotoRater::where('user_id',"=","$this->id")->where('photo_id','=',"$photo_id")->first();
	 	
	 	if($photorater){
	 		$html = t("myrating").": ";
	 		
	 		for($i=0; $i<$photorater->rating; $i++)
	 		{
	 			$html = $html."<i class='glyphicon glyphicon-star'></i>";
	 		}
	 		
	 		
	 		return $html;
	 		
	 	}
	 	else{
	 	
	 		
	 		return "<a class='rate_this_photo' href='".URL::to('/photorater/i/'.$photo_id)."' />".t("ratethisphoto")."</a>";
	 		
	 	}
	 	
	 	}
	 	
	 	
	 public function photo_rated($photo_id){
	 
	 
	 	$photorater = PhotoRater::where('user_id',"=","$this->id")->where('photo_id','=',"$photo_id")->first();
	 	
	 	if($photorater){
	 	
	 		return true;
	 	}
	 	else{
	 	
	 		return false;
	 	}
	 
	 
	 }
	 
	 public function mutual_attractions(){
	 
	 
	 	$my_encounters = Encounter::where("from_user","=","$this->id")->where("status","=",1)->get();
	 	
	 	$matches = array();
	 	
	 	foreach($my_encounters as $encounter)
	 	{
	 	
	 		$their_encounter = Encounter::where("from_user","=","$encounter->to_user")->where("to_user","=","$this->id")->where("status","=",1)->first();
	 		
	 		if($their_encounter){
	 		array_push($matches, $their_encounter->from_user);
	 		}
	 	}
	 	
	 	if($matches){
	 	$users = User::where_in("id",$matches)->where("role","!=",4)->where("role","!=",1)->get();
	 	}
	 	else{
	 	return null;
	 	}
	 
	 	return $users;
	 
	 }
	 
	 
	 public function profile_visits_notification(){
	 
	 	$notification_count = Notification::getNewNotifications('profilevisit', $this->id, true);
	 	
	 	return $notification_count;
	 
	 
	 }

	 public function favourite_notification(){
	 
	 	$notification_count = Notification::getNewNotifications('favourite', $this->id, true);
	 	
	 	return $notification_count;
	 
	 
	 }
	 
	 public function meetme_notification(){
	 
	 	$notification_count = Notification::getNewNotifications('meetme', $this->id, true);
	 	
	 	return $notification_count;
	 
	 
	 }
	 
	 public function profile_visitors(){
	 
	 	$visitors = Notification::where('to_user','=',"$this->id")->where('type','=','profilevisit')->get('from_user');
	 	
	 	
	 
	 	
	 	if($visitors)
	 	{
	 	$ids_array = array();
	 	
	 	foreach($visitors as $visitor)
	 	{
	
	 	array_push($ids_array, $visitor->from_user);
	 	
	 	}
	 	
	 	
	 	$visitors = User::where_in('id', $ids_array)->where("role","!=",4)->where("role","!=",1)->get();
	 	}
	 	else{
	 	return null;
	 	}
	 	
	 	
	 	return $visitors;
	 
	 
	 }
	 
	 
	 public function debit($amount){
	 
	 	$credit = Credit::where('user_id', '=', $this->id)->first();
	 	
	 	$b = $credit->balance - $amount;
	 	
	 	if($b <= 0)
	 	{
	 	
	 		$credit->balance = 0;
	 		
	 	
	 	}
	 	else{
	 	
	 		$credit->balance = $b;
	 	
	 	}
	 	
	 	$credit->save();
	 
	 
	 }
	 
	 public function isFavourite($user_id){
	 
	 	$favourite = Favourite::where('from_user','=',Auth::user()->id)->where("to_user","=","$user_id")->first();
	 	
	 	if($favourite)
	 	{
	 	
	 		return TRUE;
	 	}
	 	else{
	 	
	 		return FALSE;
	 	}
	 
	 
	 }

	 public function isMeet($user_id){
	 
	 	$meetme = Meetme::where('from_user','=',Auth::user()->id)->where("to_user","=","$user_id")->first();
	 	
	 	if($meetme)
	 	{
	 	
	 		return TRUE;
	 	}
	 	else{
	 	
	 		return FALSE;
	 	}
	 
	 
	 }
	 
	 
	 public function isContact($contact_id){
	 
	 	$contact = Contact::where('user_id','=',"$this->id")->where("contact","=","$contact_id")->first();
	 	
	 	if($contact)
	 	{
	 	return TRUE;
	 	}
	 	else{
	 	return FALSE;
	 	}
	 
	 }
	 
	 
	 public function isInContact($contact_id){
	 
	 $contact = Contact::where('user_id','=',"$contact_id")->where("contact","=","$this->id")->first();
	 
	 	 	
	 	if($contact)
	 	{
	 	return TRUE;
	 	}
	 	else{
	 	return FALSE;
	 	}
	 
	 
	 
	 }
	 
	 
	 public function contacts(){
	 	
	

	 	return Contact::where('user_id','=',"$this->id")->or_where('contact','=',"$this->id")->get();
	 
	 }
	 
	 
	 public function unread_chats(){
	 
	 	$chat_count = Chat::where('to_user','=',"$this->id")->where('notify_status','=','0')->count();
	 	
	 	
	 	return $chat_count;
	 
	 
	 }
	 
	 
	 public function clear_chat_notifications($user_id){
	 
	 	$chats = Chat::where('to_user','=',"$this->id")->where("from_user","=","$user_id")->where('notify_status','=','0')->get();
	 	
	 	foreach($chats as $chat){
	 	
	 		$chat->notify_status = 1;
	 		$chat->save();
	 	
	 	}
	 	
	 	
	 
	 
	 }
	 
	 
	 public function unreadChatsWithUser($user_id){
	 
	 $chats = Chat::where("to_user","=",Auth::user()->id)->where("from_user","=","$user_id")->where("notify_status","=","0")->count();
	 
	 return $chats;
	 
	 
	 }
	 
	 
	 public function setting($name){
	 
	 
	 	return UserSetting::setting($name, $this->id);
	 
	 }
	 
	 
	 public function set_setting($name, $value){
	 
	 $userSetting = UserSetting::get_setting($name, $this->id);
	 
	 	if($userSetting){
	 	
	 		
	 		$userSetting->value = $value;
	 		$userSetting->save();
	 	
	 	}
	 	else{
	 	
	 		$userSetting = new UserSetting;
	 		$userSetting->name = $name;
	 		$userSetting->user_id = $this->id;
	 		$userSetting->value = $value;
	 		$userSetting->save();
	 	
	 	
	 	}
	 
	 }

	 public function rise_up_number(){

	 	$users = User::user_search(Auth::user()->id, $this->profile->whyamihere, $this->profile->preferred_gender, $this->profile->preferred_age, Session::get("searched_lat",$this->lat), Session::get("searched_lat",$this->lng), Session::get("searched_distance",100), Session::get("distance_unit",'miles'), Session::get("interests",array()), 0);

	 	return count($users);


	 }
	 
	 
	 public function isSuperpower(){
	 
	 	$superpower = Superpower::where("user_id","=",$this->id)->first();
	 
	 	if($superpower){
	
	 		$superpower_activation_date = Date::forge(php_timestamp($superpower->created_at));
	 		
	 		$current_date = Date::forge();
	 		
	 			$diff = Date::diff($current_date, $superpower_activation_date);
	 		
	 			$number_of_days = $diff->days;
	 		
	 			if($number_of_days <= 30)
	 			{
	 			
	 				return TRUE;
	 				
	 			}
	 			else{
	 			
	 				return FALSE;
	 				
	 				}
	 	
	 	}
	 	else{
	 	
	 				return FALSE;
	 	
	 	}
	 
	 }
	 
	 public function superpower_days(){
	 
	 			$superpower = Superpower::where("user_id","=",$this->id)->first();
	 
	 			if($superpower){
	 	
	 		$superpower_activation_date = Date::forge(php_timestamp($superpower->created_at))->time();
	 		
	 		$current_date = Date::forge();
	 		
	 			$diff = Date::diff($current_date, $superpower_activation_date);
	 		
	 			$number_of_days = $diff->days;
	 			
	 				if($number_of_days <= 30)
	 			{
	 			
	 				return 30 - $number_of_days;
	 				
	 			}
	 			else{
	 			
	 				return 0;
	 				
	 				}
	 			
	 			}
	 			else{
	 			
	 			
	 			return 0;
	 			
	 			}
	 
	 
	 }
	 
	 
	 public function iBlocked($user_id){
	 
	 	$block_user = BlockedUser::where('user_id','=',$this->id)->where('block_user_id','=',"$user_id")->first();
	 	
	 	if($block_user){
	 	
	 		return TRUE;
	 	
	 	}
	 	else{
	 	
	 		return FALSE;
	 		
	 		}
	 
	 
	 }
	 
	 
	 
	 public function gifts_received(){
	 
	 	$ug = UserGift::where("to_user","=","$this->id")->get();
	 	$gifts = array();
	 	foreach($ug as $g)
	 	{
	 		$gObj = Gift::find($g->type_id);
	 
	 		if($gObj)
	 		{
				$user = User::find($g->from_user);
				if($user)
				{
				
				$gObj->from_username =  $user->name;
				$gObj->user_profile_url = $user->profile_url();
				$gObj->ug_id = $g->id;
				
				array_push($gifts, $gObj);				
				
				}
	 		
	 		}
	 	
	 	}
	 	
	 	return $gifts;
	 
	 
	 
	 }
	 
	 
	 public function generate_verification_url(){
	 
	 	$this->verification_no = uniqid();
		$this->save();
		
		
		return URL::base()."/verify_user/".$this->verification_no;
	 
	 
	 
	 }
	 
	 public function generate_reset_password_url(){
	 
	 	$this->verification_no = uniqid();
		$this->save();
		
		
		return URL::base()."/reset_password/".$this->verification_no;	 
	 
	 
	 }


	 public function isBot(){

	 	$email = $this->email;

	 	$email = substr($email, -4);

	 	if($email == "@bot")
	 	{
	 		return TRUE;
	 	}
	 	else{
	 		return FALSE;
	 	}



	 }


	 public function album_comments(){

	 	$comments = PhotoComment::where('album_id',"=", $this->id)->order_by('created_at','desc')->get();


		return $comments;



	 }
	 
	 


	 
	 
}
