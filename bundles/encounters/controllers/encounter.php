<?php

class Encounters_Encounter_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
	
	
		return $this->encounter();
	
	}
	
	public function post_index()
	{
	
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
	
		return $this->encounter();
	}
	
	public function encounter(){
	
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
			$encounterUser = null;
			
			for($i = 0; $i< $users_count; $i++)
			{
			
				$encounterUser = Encounter::where("from_user","=",$profile->user->id)->where("to_user","=",$users[$i]->user->id)->first();

				if(!$encounterUser)
				{
					Session::put('encounter_user', $users[$i]->user_id);
					$encounterUser = $users[$i];
					break;
				}
				else{
					$encounterUser = null;
					continue;
				}
			
			}
	

			$vars['encounter_user'] = $encounterUser;
	
			return View::make("encounters::encounter", $vars);
	
	
	
	}
	
	
	public function post_encounter_yes(){
	
		$encounter_user = Session::get('encounter_user');
		$user = Auth::user();
		
		$encounter_user = User::find($encounter_user);
		
		$encounter = new Encounter;
		
		$encounter->from_user = $user->id;
		$encounter->to_user = $encounter_user->id;
		$encounter->status = 1;
		
		$encounter->save();
		
		if(Encounter::mutual_attraction($user->id, $encounter_user->id))
		{
			$vars['encounter_user'] = $encounter_user;
			
			Event::fire('user.mutual.attraction', array($user, $encounter_user));

			return View::make("encounters::mutual_attraction", $vars);
		}
		
		Event::fire('user.encounter.yes', array($user, $encounter_user));
		
		return Redirect::to('/encounters');
	
	
	}
	
	public function post_encounter_no(){
	
		$encounter_user = Session::get('encounter_user');
		$user = Auth::user();
		
		$encounter_user = User::find($encounter_user);
		
		$encounter = new Encounter;
		
		$encounter->from_user = $user->id;
		$encounter->to_user = $encounter_user->id;
		$encounter->status = 0;
		
		$encounter->save();

		
			
		return Redirect::to('/encounters');
	
	
	}
	
	public function get_matches(){
	
	
		$vars['users'] = Auth::user()->mutual_attractions();
		$vars['title'] = "Mutual Attractions";
		
		return View::make("user::user_list", $vars);
	
	}





}