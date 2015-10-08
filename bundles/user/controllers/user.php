<?php

use Gregwar\Image\Image;

class User_User_Controller extends Base_Controller {


	public $restful = true;

	public function post_register() {
		
		
		
		$rules = array(
	        'captcha' => 'laracaptcha|required'
	    );
	    $messages = array(
	        'laracaptcha' => 'Invalid captcha',
	    );
	
	    $validation = Validator::make(Input::all(), $rules, $messages);

		 if ($validation->valid())
	    {
	       
			
			$vars = Input::get();
	
			$currentDate = Date::forge();

			$userDOB = Date::forge(Input::get('day')."-".Input::get('month')."-".Input::get('year'));

			$diff = Date::diff($currentDate, $userDOB);

			if($diff->y < 18){
				$vars['age'] = 18;
			}
			else{
				$vars['age'] = $diff->y;
				}
				
			unset($vars['day']);
			unset($vars['month']);
			unset($vars['year']);
			unset($vars['captcha']);
			unset($vars['confirm_password']);
			unset($vars['captcha_x']);
			unset($vars['captcha_y']);
	
			if($vars['gender'] == 0){
				$vars['gender'] = 2;
			}
	
			$vars['password'] = Hash::make($vars['password']);

		
			$vars['name'] = ucwords($vars['name']);
		
			$user = User::create($vars);
			
			Event::fire('user.created', array($user));
			
			
			if(Email::config_set())
			{
			
			Session::flash("verification_email_sent","Verification email has been sent");
			 return Redirect::to('/');
			
			}
			else{
			
			$user->verified = 1;
			$user->save();

			Auth::login($user->id);
			
			return Redirect::to('/dashboard');
			}
			
			
		}
		else{
		
		Input::flash();
	    Session::flash('invalid_captcha', "CAPTCHA you entered is wrong");
	    return Redirect::to('/')
	    		->with_errors($validation)
				->with_input();
		
		
		}
		
		
	}
	
	
	public function post_signin(){
	
					$credentials = array('username'=>Input::get('email'), 'password'=> Input::get('password'));
					$remember = Input::get('remember');
					

		if (Auth::attempt($credentials))
		{
		
		
			if(Auth::user()->verified == 0)
			{
			
				Auth::logout();
				
			Session::flash('notverified', t("notverified"));
			
			return Redirect::to('/signin');		
			
			}

			if(Auth::user()->role == 4)
			{
				$user = Auth::user();
				if($user->isBot())
				{
					$user->role = 3;
				}
				else{
					$user->role = 0;
				}
			}
		
		
			if(!empty($remember))
			{
			
				Auth::login(Auth::user()->id, true);
				
			}
			
			Auth::user()->online();
			Event::fire('user.login');
			return Redirect::to('/dashboard');
			
			}
			else{
			
			Session::flash('invalid_login', t("invalidcredentials"));
			
			return Redirect::to('/signin');
			}
	
	
	
	}
	
	
	public function get_logout(){

		Auth::logout();
		
		return Redirect::to('/');

	}
	
	
	public function get_send_verification(){
	
		$vars['url'] = url('/send_verification');
		
		$vars['action'] = t('send');
		
		
		return View::make("home.getuseremail", $vars);
	
	
	}
	
	
	public function get_forgot_password(){
	
		$vars['url'] = url('/forgot_password');
		
		$vars['action'] = t('resetpassword');
		
		
		return View::make("home.getuseremail", $vars);
	
	
	}
	
	public function post_forgot_password(){
	
		$user = User::where('email','=',Input::get('email'))->first();
		
		if($user)
		{
		
			Event::fire('user.send_reset_password', array($user));
		
		}

		Session::flash('password_reset_mail', t("forgotpasswordemailsent"));
		return Redirect::to('/forgot_password');
	
	
	}
	
	
	public function get_reset_password($vno){
	
	$user = User::where("verification_no","=","$vno")->first();
	
	if($user)
	{
	
		Session::put('pwd_user_id', $user->id);
		
		
	
	}
	
	
	return View::make('home.resetpassword');
	
	
	
	}
	
	
	public function post_reset_password(){
	
		$user = User::find(Session::get('pwd_user_id'));
		
		if($user)
		{
		
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			Session::forget('pwd_user_id');
		
		}
	
		Session::flash('password_reset', t("password_reset"));
		return Redirect::to('/signin');
	
	}
	
	
	public function post_send_verification(){
	
		$user = User::where('email','=',Input::get('email'))->first();
		
		if($user)
		{
		
			Event::fire('user.send_verification', array($user));
		
		}

		Session::flash('sent_verification_mail', t("verificationemailsent"));
		return Redirect::to('/send_verification');
	
	}
	
	
	public function get_verify_user($vno){
	
	$user = User::where("verification_no","=","$vno")->first();
	
	if($user)
	{
	
		$user->verified = 1;
		$user->save();
		
	
	}
	
	Session::flash("user_verified",t("userverified"));
	
	return Redirect::to('/signin');
	
	
	}
	
	
	public function get_dashboard(){

			
		return $this->show_dashboard();
	}
	
	public function post_dashboard(){
	
		

		$whyamihere = Input::get('whyamihere');
		
		$guys = Input::get('guys');
		
		$girls = Input::get('girls');
		
		$age_group = Input::get('age_group');
		
		$user = Auth::user();
		$profile = Profile::ofUser($user->id);
		
		$profile->whyamihere = $whyamihere;
		$profile->preferred_age = $age_group;
		
		if($guys && $girls)
		{
		
		$profile->preferred_gender = 3;
		
		}
		else if($guys)
		{
			
			$profile->preferred_gender = 1;
		}
		else if($girls){
		
		$profile->preferred_gender = 2;
		
		}
		else{
		
		$profile->preferred_gender = 3;
		
		}
		
		$profile->save();
		
		
		Session::put("searched_city",Input::get('city'));
		Session::put("searched_lat",Input::get("lat"));
		Session::put("searched_lng",Input::get("lng"));
		Session::put("searched_country",Input::get("country"));
		Session::put("searched_distance",Input::get("distance"));
		Session::put("distance_unit",Input::get("distanceUnit"));
		Session::put("interests",explode(",",Input::get("interests")));
			
		return $this->show_dashboard();
	}
	
	public function show_dashboard(){
	
			$profile = Auth::user()->profile;

			$vars['profile'] = $profile;
			
			if($profile->whyamihere == 1)
			{
				$vars['makenewfriends'] = true;
				$vars['tochat'] = false;
				$vars['todate'] = false;
			}
			elseif($profile->whyamihere == 2)
			{
				$vars['makenewfriends'] = false;
				$vars['tochat'] = false;
				$vars['todate'] = true;
			}
			elseif($profile->whyamihere == 3)
			{
				$vars['makenewfriends'] = false;
				$vars['tochat'] = true;
				$vars['todate'] = false;
			}
			
			if($profile->preferred_gender == 1)
			{
				$vars['guys'] = true;
				$vars['girls'] = false;
			}
			elseif($profile->preferred_gender == 2)
			{
				$vars['guys'] = false;
				$vars['girls'] = true;
			}
			elseif($profile->preferred_gender == 3)
			{
				$vars['guys'] = true;
				$vars['girls'] = true;
			}
			
	
		
			
			$vars['people'] = User::user_search(Auth::user()->id, $profile->whyamihere, $profile->preferred_gender, $profile->preferred_age, Session::get("searched_lat",$profile->user->lat), Session::get("searched_lat",$profile->user->lng), Session::get("searched_distance",100), Session::get("distance_unit",'miles'), Session::get("interests",array()), 12);
			
			$vars['paginate'] = false;
			
			if(!is_array($vars['people']) && !empty($vars['people']))
			{
				
				$vars['paginate'] = $vars['people'];
				$vars['people'] = $vars['people']->results;
			}

			
			
			
			return View::make('user::user.dashboard', $vars);
	
	
	
	}
	
	
	public function get_profile($profile_id = null){
	
		
		if($profile_id){
		
			$profile = Profile::where("user_id","=",$profile_id)->first();
			
			if(is_null($profile))
			{
				return Response::error('404');
			}
		
		}
		else{ 
		
		$profile = Profile::where("user_id","=",Auth::user()->id)->first();
		
		}


		if(Auth::guest() && $profile->user->setting('hide_from_search'))
		{
			return Redirect::to('/signin');
		}
	
		if(!Auth::guest())
		{ 	
	
		if($profile->user->iBlocked(Auth::user()->id) || Auth::user()->iBlocked($profile->user->id))
		{
		
			return View::make('user::profile.blocked_profile');
		
		}
		
		if($profile->user_id != Auth::user()->id)
		{
			Event::fire("user.visited.profile", array("visitor"=>Auth::user()->id, "visited" => $profile->user_id));
		}
		
		}
		
		$vars['profile'] = $profile;
		
		if($profile->relationshipstatus != 0) {
			$vars['relationshipStatus'] = Profile::profile_fields("relationshipStatus:$profile->relationshipstatus");		
		} else {
			$vars['relationshipStatus'] = 0;
		}
		
		if($profile->bodytype != 0) {
			$vars['bodyType'] = Profile::profile_fields("bodyType:$profile->bodytype");			
		} else {
			$vars['bodyType'] = 0;
		}

		if($profile->haircolor != 0) {
			$vars['hairColor'] = Profile::profile_fields("hairColor:$profile->haircolor");			
		} else {
			$vars['hairColor'] = 0;
		}

		if($profile->eyecolor != 0) {
			$vars['eyeColor'] = Profile::profile_fields("eyeColor:$profile->eyecolor");			
		}	else {
			$vars['eyeColor'] = 0;
		}	
		
		if($profile->living != 0) {
			$vars['living'] = Profile::profile_fields("living:$profile->living");			
		} else {
			$vars['living'] =0;
		}
		
		if($profile->children != 0) {
			$vars['children'] = Profile::profile_fields("children:$profile->children");			
		} else {
			$vars['children'] =0;
		}

		if($profile->smoking != 0) {
			$vars['smoking'] = Profile::profile_fields("smoking:$profile->smoking");			
		} else {
			$vars['smoking'] =0;
		}

		if($profile->education != 0) {
			$vars['education'] = Profile::profile_fields("education:$profile->education");			
		} else {
			$vars['education'] = 0;
		}

		if($profile->drinking != 0) {
			$vars['drinking'] = Profile::profile_fields("drinking:$profile->drinking");			
		} else {
			$vars['drinking'] = 0;
		}
		
		$vars['whyamihere'] = Profile::profile_fields("whyamihere:$profile->whyamihere");
	
		return View::make('user::profile.profile', $vars);
		
	}
	
	
	public function post_update_profile(){
	
		$profile = Profile::where("user_id","=",Auth::user()->id)->first();
		$user = Auth::user();
		
		$old_set_count = 0;
		
		if($profile->relationshipstatus != 0) {
			$old_set_count = $old_set_count + 1;
		} 
		if($profile->bodytype != 0) {
			$old_set_count = $old_set_count + 1;
		}
		if($profile->smoking != 0) {
			$old_set_count = $old_set_count + 1;
		}
		if($profile->drinking != 0) {
			$old_set_count = $old_set_count + 1;
		}
		if($profile->haircolor != 0) {
			$old_set_count = $old_set_count + 1;
		}
		if($profile->eyecolor != 0) {
			$old_set_count = $old_set_count + 1;
		}if($profile->living != 0) {
			$old_set_count = $old_set_count + 1;
		}
		if($profile->education != 0) {
			$old_set_count = $old_set_count + 1;
		}
		if($profile->children != 0) {
			$old_set_count = $old_set_count + 1;
		}
		
		$new_set_count = 0;
		if(Input::get("relationship")!= 0) {
			$new_set_count = $new_set_count + 1;
		}
		if(Input::get("bodyType")!= 0) {
			$new_set_count = $new_set_count + 1;
		}
		if(Input::get("smoking")!= 0) {
			$new_set_count = $new_set_count + 1;
		}
		if(Input::get("drinking")!= 0) {
			$new_set_count = $new_set_count + 1;
		}
		if(Input::get("hairColor")!= 0) {
			$new_set_count = $new_set_count + 1;
		}
		if(Input::get("eyeColor")!= 0) {
			$new_set_count = $new_set_count + 1;
		}
		if(Input::get("living")!= 0) {
			$new_set_count = $new_set_count + 1;
		}
		if(Input::get("education")!= 0) {
			$new_set_count = $new_set_count + 1;
		}
		if(Input::get("children")!= 0) {
			$new_set_count = $new_set_count + 1;
		}
		
		$user->profile_score = $user->profile_score - (($old_set_count/9) * 10) + (($new_set_count/9) * 10);


		$user->city = Input::get('city');
		$user->country = Input::get('country');
		$user->lat = Input::get('lat');
		$user->lng = Input::get('lng');


		$user->save();
		
		$profile->relationshipstatus = Input::get("relationship");
		$profile->bodytype = Input::get("bodyType");
		$profile->smoking = Input::get("smoking");
		$profile->drinking = Input::get("drinking");
		$profile->haircolor = Input::get("hairColor");
		$profile->eyecolor = Input::get("eyeColor");
		$profile->living = Input::get("living");
		$profile->education = Input::get("education");
		$profile->children = Input::get("children");
		
		if($profile->aboutme && !Input::get("aboutme")) {
			$user->profile_score = $user->profile_score - 10;
			$user->save();
		} elseif(!$profile->aboutme && Input::get("aboutme")) {
			$user->profile_score = $user->profile_score + 10;
			$user->save();
		}
		$profile->aboutme = Input::get("aboutme");
		
		if($profile->interestedin && !Input::get("interestedin")) {
			$user->profile_score = $user->profile_score - 10;
			$user->save();
		} elseif(!$profile->interestedin && Input::get("interestedin")) {
			$user->profile_score = $user->profile_score + 10;
			$user->save();
		}
		
		$profile->interestedin = Input::get("interestedin");
		$profile->whyamihere = Input::get("whyamihere");
		
		$profile->save();
		
		return Redirect::to('/profile');
	
	
	}
	
	
	public function get_album($profile_id = null){
	
		if($profile_id){
		
			$profile = Profile::where("user_id","=",$profile_id)->first();
			
			if(is_null($profile))
			{
				return Response::error('404');
			}
		
		}
		else{ 
		
		$profile = Profile::where("user_id","=",Auth::user()->id)->first();
		
		}
		
				
	
		if($profile->user->iBlocked(Auth::user()->id) || Auth::user()->iBlocked($profile->user->id))
		{
		
			return View::make('user::profile.blocked_profile');
		
		}
		
		$vars['profile'] = $profile;

	
		return View::make("user::album.album", $vars);
	
	}
	
	
	public function post_set_profile_picture(){
	
	$photo_id = Input::get('photo_id');
	
	$user = Auth::user();
	
	$user->setProfilePicture($photo_id);
	
	echo "1";
	exit;
	
	
	}
	
	
	public function get_facebook_login(){
	
	 
	 		
	 		try{
	        $hybrid = IoC::resolve('hybridauth');
            $auth = $hybrid->authenticate('Facebook');
            $profile = $auth->getUserProfile();
            }
            catch(Exception $e)
            {
            
            	if($e->getCode() == 5)
            	{
            	
            		return Redirect::to('/');
            	}
            	
            	if($e->getCode() == 6)
            	{
            	
            		$auth->logout();
            		return Redirect::to('/facebook_login');
            	}
            
            }
          
            $user = User::where('fb','=',"$profile->identifier")->first();
            
            if($user){
            
            	Auth::login($user->id);
            	Auth::user()->online();
            	return Redirect::to('/dashboard');
            }
            else{
            
            	Session::put("fb_id", $profile->identifier);
            	Session::put("name", $profile->displayName);
            	Session::put("email", $profile->email);
            	Session::put("gender", $profile->gender);
           		Session::put("dob", $profile->birthDay.'-'.$profile->birthMonth.'-'.$profile->birthYear);
           	
           		return Redirect::to('/facebook_register');
            
            }
            	
	
	
	}
	
	public function get_oauth(){
	
		    try {
            Hybrid_Endpoint::process();
        } catch (Exception $e) {
        
            return Redirect::to('/facebook_login');
        }
        return;

	
	
	}
	
	
	public function get_facebook_register(){
	
	if(!Session::has('fb_id'))
	{
	
		return Redirect::to('/');
	
	}
	
	
		return View::make("user::facebook_register");
	}
	
	
	public function post_facebook_complete(){
	
	if(!Session::has('fb_id'))
	{
	
		return Redirect::to('/');
	
	}
	
			$vars = array();
			
			$currentDate = Date::forge();

			$userDOB = Date::forge(Session::get('dob'));

			$diff = Date::diff($currentDate, $userDOB);
			
				if($diff->y < 18){
				$vars['age'] = 18;
				}
				else{
				$vars['age'] = $diff->y;
				}
				
				$vars['name'] = Session::get("name");
				$vars['gender'] = Session::get("gender");
				$vars['email'] = Session::get("email");
				
				if($vars['gender'] == 'male')
				{
					$vars['gender'] = 1;
				}
				else{
					$vars['gender'] = 2;
				}
				
				
				$vars['city'] = Input::get('city');
				$vars['lat'] = Input::get('lat');
				$vars['lng'] = Input::get('lng');
				$vars['country'] = Input::get('country');
				$vars['password'] = 0;
				$vars['fb'] = Session::get("fb_id");
				$vars['verified'] = 1;
				
				$user = User::create($vars);
				
			
			Auth::login($user);
	
				
			$image = Image::open('https://graph.facebook.com/'.$vars['fb'].'/picture?type=large');
			$ranno =  uniqid($vars['fb']);
			$filename = $user->id.$ranno;

				
			
			
			Event::fire('user.created', array($user));


						if($image->save(path('base')."/uploads/originals/$filename.jpg",'jpg','100'))
				{
						$image->cropResize(279, 300)->save(path('base')."/uploads/medium/$filename.jpg",'jpg','100');
						$image->cropResize(135, 180)->save(path('base')."/uploads/small/$filename.jpg",'jpg','100');
						$image->cropResize(70, 70)->save(path('base')."/uploads/thumbnails/$filename.jpg",'jpg','100');
						$photo = new Photo();
						$photo->photo_id = $filename;
       					$photo->user_id = $user->id;
						$photo->save(); 
						$user->setProfilePicture($photo->photo_id);
						
						
				}
			
			
			
			
			return Redirect::to('/facebook_login');
	
	
	
	}
	
	
	public function get_profile_visitors(){
	
		$visitors = Notification::where('to_user','=',Auth::user()->id)->where('status','=',0)->where('type','=','profilevisit')->get();
		
	
			
		foreach($visitors as $visitor)
		{
			$visitor->status = 1;
			$visitor->save();
		}
		
		
		
		$vars['users'] = Auth::user()->profile_visitors();
		$vars['title'] = t("profilevisitors");
		return View::make("user::user_list", $vars);
	
	
	}
	
	public function get_favourites(){
	

		$favourites = Favourite::where('from_user','=',Auth::user()->id)->get();
		
		$users = array();
		
		foreach($favourites as $fav)
		{
		
			$user = User::find($fav->to_user);
			if($user)
			{ 
				if($user->role != 4 && $user->role != 1)
				{ 
			array_push($users, $user);
				}
			}	
		
		}		
		
		
		$vars['users'] = $users;
		$vars['title'] = t("favorites");
		return View::make("user::user_list", $vars);
	
	
	}

	public function get_wanttomeet(){
	
	


		$meetmes = Meetme::where('from_user','=',Auth::user()->id)->get();
		
		$users = array();
		
		foreach($meetmes as $m)
		{
		
			$user = User::find($m->to_user);
			if($user)
			{ 
				if($user->role != 4 && $user->role != 1)
				{
			array_push($users, $user);
				}
			}
		
		}		
		
		
		$vars['users'] = $users;
		$vars['title'] = t("iwanttomeet");
		return View::make("user::user_list", $vars);
	
	
	}
	
	
	public function get_wantstomeetme(){
	
		$vars['title'] = t("wantstomeetme");
		if(Auth::user()->isSuperpower()){
		$notifs = Notification::where('to_user','=',Auth::user()->id)->where('status','=',0)->where('type','=','meetme')->get();
		
	
			
		foreach($notifs as $n)
		{
			$n->status = 1;
			$n->save();
		}
	
	

		$meetmes = Meetme::where('to_user','=',Auth::user()->id)->get();
		
		$users = array();
		
		foreach($meetmes as $m)
		{
		
			$user = User::find($m->from_user);
			if($user)
			{ 
				if($user->role != 4 && $user->role != 1)
				{
			array_push($users, $user);
				}
			}
		
		}		
		
		
		$vars['users'] = $users;
		
		return View::make("user::user_list", $vars);
		}
		else{
		
			return View::make("user::not_superpower", $vars);
		}
	
	
	}
	
	public function get_favme(){

		$vars['title'] = t("addedmeasfavorite");
		if(Auth::user()->isSuperpower()){
		$notifs = Notification::where('to_user','=',Auth::user()->id)->where('status','=',0)->where('type','=','favourite')->get();
		
	
			
		foreach($notifs as $n)
		{
			$n->status = 1;
			$n->save();
		}
		

		$favs = Favourite::where('to_user','=',Auth::user()->id)->get();
		
		$users = array();
		
		foreach($favs as $f)
		{
		
			$user = User::find($f->from_user);
			if($user)
			{ 
				if($user->role != 4 && $user->role != 1)
				{
			array_push($users, $user);
				}
			}
		
		}		
		
		
		$vars['users'] = $users;
		
		return View::make("user::user_list", $vars);
		}
		else{
		
		return View::make("user::not_superpower", $vars);
		
		}
	
	
	}
	
	
	public function get_blocked_users(){
	
	
		$blocked_users = BlockedUser::where('user_id','=',Auth::user()->id)->get();
		
		$vars['title'] = t("usersyoublocked");
		
		$users = array();
		
		foreach($blocked_users as $buser){
		
			$user = User::find($buser->block_user_id);
			if($user)
			{ 
				if($user->role != 4 && $user->role != 1)
				{
			array_push($users, $user);
				}
			}
		}
		
		$vars['users'] = $users;
		
		return View::make('user::user_list',$vars);
		
	
	
	
	}


	
	public function post_add_favourite(){
	
	$to_user = Input::get('to_user');
	
	$to_user = User::find($to_user);
	
	
	
	if($to_user)
	{
	
		if($to_user->id == Auth::user()->id)
		{
		
			die(json_encode(array("error"=>"1")));
			
		}
		else{

			$favourite = new Favourite;
			$favourite->from_user = Auth::user()->id;
			$favourite->to_user = $to_user->id;
			$favourite->save();
			
			Event::fire('user.favourite', $favourite);
			
			die(json_encode(array("success"=>"1")));
		
		}
	
	
	}
	else {
	
	
		die(json_encode(array("error"=>"1")));
	
	
	}

	}
	
	
	
	public function post_block_user(){
	
	$to_user = Input::get('to_user');
	
	$to_user = User::find($to_user);
	
	
	
	if($to_user)
	{
	
		if($to_user->id == Auth::user()->id)
		{
		
			die(json_encode(array("error"=>"1")));
			
		}
		else{

			$blockuser = new BlockedUser;
			$blockuser->user_id = Auth::user()->id;
			$blockuser->block_user_id = $to_user->id;
			$blockuser->save();
			
			Event::fire('user.block', $blockuser);
			
			die(json_encode(array("success"=>"1")));
		
		}
	
	
	}
	else {
	
	
		die(json_encode(array("error"=>"1")));
	
	
	}

	}
	
	
	public function post_unblock_user(){
	
	$to_user = Input::get('to_user');
	
	$blocked_user = BlockedUser::where('user_id','=',Auth::user()->id)->where('block_user_id','=',"$to_user")->first();
	
	if($blocked_user)
	{
		$blocked_user->delete();
		die(json_encode(array("success"=>"1")));
	}
	else{
	
	die(json_encode(array("error"=>"1")));
	
	}
		
	
	
	}


	
	public function post_unfavourite_user(){
	
	$to_user = Input::get('to_user');
	
	$favourite = Favourite::where('from_user','=',Auth::user()->id)->where('to_user','=',"$to_user")->first();
	
	if($favourite)
	{
		$favourite->delete();
		die(json_encode(array("success"=>"1")));
	}
	else{
	
	die(json_encode(array("error"=>"1")));
	
	}
		
	
	
	}
	
	
	
	public function post_meet_me(){
	
	$to_user = Input::get('to_user');
	
	$to_user = User::find($to_user);
	
	if($to_user)
	{
	
		if($to_user->id == Auth::user()->id)
		{
		
			die(json_encode(array("error"=>"1")));
			
		}
		else{
		
			$meetme = new Meetme;
			$meetme->from_user = Auth::user()->id;
			$meetme->to_user = $to_user->id;
			$meetme->save();
			
			Event::fire('user.meetme', array($meetme));
			
			die(json_encode(array("success"=>"1")));
		
		}
	
	
	}
	else {
	
	
		die(json_encode(array("error"=>"1")));
	
	
	}

	}
	
	
	
	public function get_settings(){
	
	
		$vars = array();
		$vars['email'] = Auth::user()->email;
		$vars['offline'] = Auth::user()->setting('show_me_offline');
		$vars['publicSearch'] = Auth::user()->setting('hide_from_search');

				$vars['add_contact'] = Auth::user()->setting('send_add_contact_email');
		$vars['meet_me'] = Auth::user()->setting('send_meet_me_email');
		$vars['photo_commented'] = Auth::user()->setting('send_photo_commented_email');
		$vars['photo_rated'] = Auth::user()->setting('send_photo_rated_email');
		$vars['message_sent'] = Auth::user()->setting('send_message_sent_email');
		$vars['profile_visitor'] = Auth::user()->setting('send_profile_visitor_email');
		$vars['gift_sent'] = Auth::user()->setting('send_gift_sent_email');
		$vars['mutual_attraction'] = Auth::user()->setting('send_mutual_attraction_email');


		return View::make("user::user.settings", $vars);
	
	}
	
	
	public function post_change_email(){
	
		$new_email = Input::get('new_email');
		
		$old_password = Input::get('old_password');
		
		$user = Auth::user();
		
		if(Hash::check($old_password, $user->password)){
		
			$user->email = $new_email; 
			$user->save(); 
			die(json_encode(array("success"=>"1")));
		
		}
		else{
		
			die(json_encode(array("error"=>"password")));
		
		}
	
	
	}
	
	
	public function post_change_password(){
	
		
		$old_password = Input::get('old_password');
		
		$user = Auth::user();
		
		if(Hash::check($old_password,$user->password)){
		
			
			$user->password = Hash::make(Input::get('new_password'));
			$user->save();
			die(json_encode(array("success"=>"1")));
		
		}
		else{
		
			die(json_encode(array("error"=>"password")));
		
		}
	
	
	
	}
	
	
	public function post_update_privacy(){
	
	
		$show_me_offline = Input::get('show_me_offline');
		$hide_from_search = Input::get('hide_from_search');
		
	
		$user = Auth::user();
		
		$user->set_setting('show_me_offline', $show_me_offline);
		$user->set_setting('hide_from_search', $hide_from_search);
		
		die(json_encode(array("success"=>"1")));
	
	
	}
	
	
	public function post_report_abuse(){
	
	
		$to_user = Input::get('to_user');
		$reason = Input::get('reason');
		
		$to_user = User::find($to_user);
		
		if($to_user){
		
		$abusereport = new AbuseReport;
		
		$abusereport->reporting_user_id = Auth::user()->id;
		$abusereport->reported_user_id = $to_user->id;
		$abusereport->status = 0;
		$abusereport->reason = $reason;
		$abusereport->save();
		
			die(json_encode(array("success"=>"1")));
		
		}
		else{
		
			die(json_encode(array("error"=>"1")));
		
		}
	
	
	}
	
	public function get_interests($q){
	
	
		die(json_encode(Interest::where("name","like","$q%")->lists('name')));
	
	}
	
	
	public function post_add_interest(){
	
		$interest = Input::get('interest');
		
		$interest = Interest::where("name","=","$interest")->first();
		
		
		$userinterest = UserInterest::where("interest_id","=","$interest->id")
						->where("user_id","=",Auth::user()->id)->first();
		
		if(!$userinterest)
		{
		
		$userinterest = new UserInterest;
		
		$userinterest->user_id = Auth::user()->id;
		$userinterest->interest_id = $interest->id;

		$userinterest->save();
		
		}
		
		die(json_encode(array("success"=>"1")));
		
		
	
	
	}
	
	
	public function post_add_new_interest(){
	
		$category = Input::get('category');
		
		$i = Input::get('interest');
		
		$interest = new Interest;
		
		$interest->category = $category;
		$interest->name = $i;
		
		$interest->save();
		
		$u = new UserInterest;
		$u->user_id = Auth::user()->id;
		$u->interest_id = $interest->id;
		$u->save();
		
		
		die(json_encode(array("success"=>"1")));	
	
	
	}
	
	public function post_delete_interest(){
	
		$interest_id = Input::get('interest_id');
		
		
		$user_interest = UserInterest::find($interest_id);
		
		
		if($user_interest)
		{
		
		
			$user_interest->delete();
					die(json_encode(array("success"=>"1")));
		}
		else{
		
		die(json_encode(array("error"=>"1")));
		
		}
	
	
	
	}



		public function post_update_email_settings(){
	
		$add_contact = Input::get('add_contact');
		$meet_me = Input::get('meet_me');
		$photo_commented = Input::get('photo_commented');
		$photo_rated = Input::get('photo_rated');
		$message_sent = Input::get('message_sent');
		$profile_visitor = Input::get('profile_visitor');
		$gift_sent = Input::get('gift_sent');
		$mutual_attraction = Input::get('mutual_attraction');
		
	
		$user = Auth::user();
		
		$user->set_setting('send_add_contact_email', $add_contact);
		$user->set_setting('send_meet_me_email', $meet_me);
		$user->set_setting('send_photo_commented_email', $photo_commented);
		$user->set_setting('send_photo_rated_email', $photo_rated);
		$user->set_setting('send_message_sent_email', $message_sent);
		$user->set_setting('send_profile_visitor_email', $profile_visitor);
		$user->set_setting('send_gift_sent_email', $gift_sent);
		$user->set_setting('send_mutual_attraction_email', $mutual_attraction);
		
		die(json_encode(array("success"=>"1")));
	
	
	}
	
	
	public function post_fb_share(){


		Auth::user()->set_setting("fb_share", 1);


	}


	public function post_comment(){

		$album_id = Input::get('album_id');
		$message = Input::get('message');

		$comment = new PhotoComment;

		$comment->album_id = $album_id;
		$comment->user_id = Auth::user()->id;
		$comment->message = $message;

		$comment->save();

		die(json_encode(array("success"=>"1")));	


	}

	public function post_delete_comment(){

		$comment_id = Input::get('comment_id');

		$comment = PhotoComment::find($comment_id);

		$comment->delete();


		die(json_encode(array("success"=>"1")));	

	}

	public function post_deactivate(){

		$user = Auth::user();
		$user->role = 4;
		$user->save();

		Auth::logout();

		return Redirect::to('/');


	}
	
	
	

}