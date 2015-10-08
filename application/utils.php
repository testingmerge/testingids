<?php

function t($word){


	return Lang::line("app.$word")->get(Setting::get_language());

}

function setting($s){

	return Setting::get_settings($s);
}


function months() {
    $month_options = array();
     for ($x=1;$x<=12;$x++){
     
    	$month_options[$x] = date( 'M', mktime(0, 0, 0, $x, 1) );
    	
  		}
  		
  	return $month_options;
  		
}


function days() {
    $days_options = array();
     for ($x=1;$x<=31;$x++){
     
    	$days_options[$x] = $x;
    	
  		}
  		
  	return $days_options;
  		
}


function years($startYear = 1971, $endYear = null){

	if(is_null($endYear))
	{
	$endYear = date('Y');
	}

	$years_options = array();
	for ($i=$startYear;$i<=$endYear;$i++){ 
        	$years_options[$i] = $i;     
        } 

	return $years_options;

}


function s($name){

	return Setting::get_setting($name);

}


function set_setting($key, $value){

	Setting::set_setting($key, $value);

}


function php_timestamp($yourMySQLDateTime){

list($date, $time) = explode(' ', $yourMySQLDateTime);
list($year, $month, $day) = explode('-', $date);
list($hour, $minute, $second) = explode(':', $time);

$timestamp = mktime($hour, $minute, $second, $month, $day, $year);

return $timestamp;

}



function app_logo(){

if(s('logo'))
{

$html = "<img src='".URL::to_asset('uploads/app/'.s('logo').'.png')."' />";

}
else{

$html = "<h3 class='profile-heading'>".s('title')."</h3>";

}

return $html;



}



function app_favicon(){

if(s('favicon'))
{

$html = "<link rel='shortcut icon' type='image/x-icon' href='".URL::to_asset('uploads/app/'.s('favicon').'.ico')."' />";

}
else{

$html = "";

}

return $html;


}






function app_description(){



$html = '<meta name="description" content="'.s('description').'">';



return $html;


}

function app_keywords(){


$html = '<meta name="keywords" content="'.s('meta_keywords').'">';



return $html;


}

function app_search_engine_access(){

if(s('search_engine_access'))
{

$html = '<meta name="robots" content="noindex">';

}
else{

$html = "";

}

return $html;


}



function make_array($lang)
	{
		$out = '<?php '."\nreturn array(\n";
		$out .= build_array($lang);
		return $out.');';
	}


function build_array($lang, $depth = 1)
	{
		$out = '';
		foreach ($lang as $key => $value)
		{
			if (is_array($value))
			{
				$out .= str_repeat("\t", $depth)."'".$key."' => array(\n";
				$out .= build_array($value, ++$depth)."\n";
				$out .= str_repeat("\t", --$depth)."),\n";
				$depth = 1;
				continue;
			}
			$out .= str_repeat("\t", $depth)."'".$key."'  => '".addcslashes($value, "'\\/")."',\n";
		}
		return $out;
	}

function frontpage_bg(){

	if(s('frontbackgroundimage')){

		return url('uploads/app/'.s('frontbackgroundimage').'.png');
	}
	else{

		return url("assets/images/homepage.jpg");
	}


}

function loginpage_bg(){

	if(s('loginbackgroundimage')){

		return url('uploads/app/'.s('loginbackgroundimage').'.png');
	}
	else{
		
		return url("assets/images/background.jpg");
	}

}

function tableExists($table){


$check = DB::only('SELECT COUNT(*) as `exists`
    FROM information_schema.tables
    WHERE table_name IN (?)
    AND table_schema = database()',$table);
if(!$check) // No table found, safe to create it.
{
   return FALSE;
}

return TRUE;

}

function isInstalled(){

$host = Config::get('database.connections.mysql.host');

	if($host == ''){
	 	return FALSE;
	 }
	 else{

	 if(tableExists('settings')){
	 		return TRUE;
	 	}
	 	else{
	 		return FALSE;
	 	}

	}
}