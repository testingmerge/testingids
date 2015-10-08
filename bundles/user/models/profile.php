<?php

class Profile extends Eloquent
{
	public function user()
	{
		return $this->belongs_to('User');
	}	
	
	
	public static function profile_fields($type){
		
		
		$fields = array(
		
			  'whyamihere' => array(
		1 => t('makefriends'),
		2 => t('todate'),
		3 => t('tochat')),
		
		
		'relationshipStatus' => array(
		1 => t('single'),
		2 => t('taken') ,
		3 => t('open')),
		
		'bodyType' => array(0 => '---'. t('select') ."---",
		1 => t('avg'),
		2 => t('fewextra'),
		3 => t('slim'),
		4 => t('muscular'),
		5 => t('bigbeautiful')),

	 	'hairColor' => array(0 => '---'. t('select') ."---",
		1 => t('black'),
		2 => t('brown') ,
		3 => t('red'),
		4 => t('blonde'),
		5 => t('grey'),
		6 => t('white'),
		7 => t('shaved'),
		8 => t('dyed')),

	  'eyeColor' => array(0 => '---'. t('select') ."---",
		1 => t('green'),
		2 => t('brown'),
		3 => t('blue'),
		4 => t('hazel'),
		5 => t('other')),

	  'living' => array(0 => '---'. t('select') ."---",
		1 =>  t('withparents'),
		2 =>  t('withroommate') ,
		3 =>  t('studentres'),
		4 =>  t('withpartner'),
		5 =>  t('alone')),

	 'children' => array(0 => '---'. t('select') ."---",
		1 => t('nonever'),
		2 => t('someday'), 
		3 => t('alreadyhave'),
		4 => t('emptynest')),

	  'smoking' => array(0 => '---'. t('select') ."---",
		1 => t('no'),
		2 => t('yes'),
		3 => t('nonever'),
		4 => t('social'),
		5 => t('chainsmoker')),

		  'drinking' => array(0 => '---'. t('select') ."---",
		1 => t('no'),
		2 => t('yes'),
		3 => t('nonever'),
		4 => t('social'),
		5 => t('alcoholic')),
		

	
	  'education' => array(0 => '---'. t('select') ."---",
		1 => t('schoolonly'),
		2 => t('tradetechnical'),
		3 => t('collegeuniversity'),
		4 => t('advanceddegree')) 
		
		);
		
		
		$accessor = explode(":", $type);
		
		if(count($accessor) == 1){
			
			return $fields[$accessor[0]];
			
			
		}
		
		
		if(count($accessor) == 2){
			
			return $fields[$accessor[0]][$accessor[1]];
			
		}
		
	}
	
	public static function ofUser($user_id){
	
		return Profile::where("user_id","=",$user_id)->first();
	}
	
	public function relationship_status(){
	
		if($this->relationshipstatus == 1)
		{
		return t('single');
		}
		else if($this->relationshipstatus == 2)
		{
		return t('taken');
		}
		else{
		return t('open');
		}
	
	
	}
	
	public function to_meet(){
	
		if($this->preferred_gender == 1)
		{
		return "men";
		}
		else if($this->preferred_gender == 2)
		{
		return "women";
		}
		else{
		return "both men & women";
		}
	
	
	}
	
	public function age_group(){
	
		if($this->preferred_age == 1)
		{
		return "18 & 25";
		}
		else if($this->preferred_age == 2)
		{
		return "25 & 30";
		}
		else{
		return "30+";
		}
	
	
	}


}
	
