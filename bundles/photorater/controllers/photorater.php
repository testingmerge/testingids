<?php


class Photorater_Photorater_Controller extends Base_Controller {


	public $restful = true;
	

	public function get_iphoto($photo_id = null){
	
		
		if(is_null($photo_id))
		{
		
			return Redirect::to('/photorater');
		}
		else{ 
		
	
			$photo = Photo::withPhotoId($photo_id);
			
			if($photo->user_id == Auth::user()->id)
			{
			
			return Redirect::to('/photorater');
			
			}
			
			$profile = Profile::ofUser($photo->user_id);
			
	
			
			if(Auth::user()->photo_rated($photo->photo_id))
			{
				
				return Redirect::to($profile->user->album_url());
			}
		
			$vars['profile'] = $profile;
			$vars['photo'] = $photo; 
		
		
			return View::make("photorater::iphoto", $vars);
		}
	
	
	}	
	
	
	public function post_rate_iphoto(){
	
	
		$photo_id = Input::get('photo_id');
		
		$rating = Input::get('rating');
		
		$photo = Photo::withPhotoId($photo_id);
		
			if($photo->user_id == Auth::user()->id)
			{
			
			return Redirect::to('/photorater');
			
			}
			
			if($rating > 5)
			{
			
			return Redirect::to('/photorater');
			
			}
			
			
		$photorater = new PhotoRater;
		
		$photorater->user_id = Auth::user()->id;
		$photorater->rating = $rating;
		$photorater->photo_id = $photo_id;
		
		$photorater->save();
		

			$new_rate = ($photo->rating * $photo->no_users) + $rating;
			$photo->no_users++;
			$photo->rating = $new_rate/$photo->no_users;
			$photo->save();

		Event::fire('user.photo.rated', array(Auth::user(), User::find($photo->user_id)));
		
		return Redirect::to("/album/$photo->user_id");
	
	
	
	}
	
	public function post_rate_photo(){
	
	
		$photo_id = Session::get("photo2rate");
		
		$rating = Input::get('rating');
		
		$photo = Photo::withPhotoId($photo_id);
		
			if($photo->user_id == Auth::user()->id)
			{
			
			return Redirect::to('/photorater');
			
			}
			
			if($rating > 5)
			{
			
			return Redirect::to('/photorater');
			
			}
			
			
		$photorater = new PhotoRater;
		
		$photorater->user_id = Auth::user()->id;
		$photorater->rating = $rating;
		$photorater->photo_id = $photo_id;
		
		$photorater->save();
		

			$new_rate = ($photo->rating * $photo->no_users) + $rating;
			$photo->no_users++;
			$photo->rating = $new_rate/$photo->no_users;
			$photo->save();

		Event::fire('user.photo.rated', array(Auth::user(), User::find($photo->user_id)));
		
		return Redirect::to("/photorater");
	
	
	
	}
	
	
	public function get_index(){
	
		
	
		return $this->photo_rater();
	
	}
	
	public function post_index(){
	
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
	
		return $this->photo_rater();
	
	}
	
	
	public function photo_rater(){
	
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
			
			
			$users = User::get_users_with(Auth::user()->id, $profile->preferred_gender, $profile->preferred_age, $profile->whyamihere);
			$users_count = count($users);
			$photo2rate = null;
			
			for($i = 0; $i< $users_count; $i++)
			{
			
				if($users[$i]->user->photos_count() > 0)
				{
				
				$photos = $users[$i]->user->photos();
			
				$photos_count = count($photos);
				
			
				
				
							for($j=0; $j < $photos_count; $j++)
							{
								$photorater = null;
								$photorater = PhotoRater::where("user_id","=",Auth::user()->id)->where("photo_id","=",$photos[$j]->photo_id)
								->first();
					
									
								
										
										
										
										
							
		
								if(is_null($photorater))
								{
									
									
										
									$photo2rate = $photos[$j];
									
									break;
								
					
								}
								else{
					
									$photo2rate = null;
									
									continue;
										
								
						
								}

							}
							
								

						if($photo2rate)
						{
							Session::put('photo2rate', $photo2rate->photo_id);
							break;
						}
						else{
							$photo2rate = null;
						
							continue;
						}
				
				}
				else{
				$photo2rate = null;
			
				continue;
				}
			
			}
	
			
		
			$vars['photo2rate'] = $photo2rate;
			
			
			
			return View::make("photorater::photorater", $vars);
	
	
	}
	
	
	
	public function get_photos_rated(){
	
		$photos = Auth::user()->photos();
		
		
		
		foreach($photos as $photo){
		
			$pr = PhotoRater::where("photo_id","=","$photo->photo_id")->get();
			
			$raters = array();
			foreach($pr as $r)
			{
				$user = User::find($r->user_id);
				if($user)
			{ 
				if($user->role != 4 && $user->role != 1)
				{
			array_push($raters, $user);
				}
			}
			
			}
			
			$photo->raters = $raters;

		}
		
		
		$vars['photos'] = $photos;
		$vars['title'] = t("ratedyourphotos");
		
		return View::make("photorater::ratedyourphotos", $vars);
	
	
	
	}
	
	
	
	
	
}

	