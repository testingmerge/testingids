<?php

include path('bundle')."minglecore/Curl.php";

class Translate_Task {
 
    public function run($arguments)
    {
        $english = include path('app')."language/en/app.php";

        $google_key = "AIzaSyAnRe2CYEu-vD3mP5QIxd90Iiqugr2eVZs";

        $translate_to = $arguments[0];

        $api_url = "https://www.googleapis.com/language/translate/v2?key=$google_key&source=en&target=$translate_to&q=";
        
        //$curl = new Curl;

        $translation_array = array();

        set_time_limit(0);
ob_implicit_flush(1);

        foreach($english as $key => $word){ 
        
        	

        	$api_call = $api_url.urlencode($word);
        	echo "Fetching for $word";
        	echo "\n";
        	
        	//$json_data = $curl->simple_get($api_call);


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $api_call);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_ENCODING, "");
$json_data = curl_exec($curl);
curl_close($curl);

        	$translation = json_decode($json_data, true);

        	$translation = $translation['data']['translations'][0]['translatedText'];
        
        	echo $word." => ".$translation;
        	echo "\n";

        	$translation_array[$key] = $translation;
        	
        	
        	sleep(2);
        	if(ob_get_level()>0)
       ob_end_flush(); 



    	}

    	$file = path('app')."language/$translate_to/app.php";

    	echo "Writing to File -> $file";

    	$array = static::make_array($translation_array);
		File::put($file, $array);

		echo "\n Completed!";

    	
    }


    public static function make_array($lang)
	{
		$out = '<?php '."\nreturn array(\n";
		$out .= static::build_array($lang);
		return $out.');';
	}


    protected static function build_array($lang, $depth = 1)
	{
		$out = '';
		foreach ($lang as $key => $value)
		{
			if (is_array($value))
			{
				$out .= str_repeat("\t", $depth)."'".$key."' => array(\n";
				$out .= static::build_array($value, ++$depth)."\n";
				$out .= str_repeat("\t", --$depth)."),\n";
				$depth = 1;
				continue;
			}
			$out .= str_repeat("\t", $depth)."'".$key."' => '".addcslashes($value, "'\\/")."',\n";
		}
		return $out;
	}
 
}