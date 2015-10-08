<?php

class CzarAuth {




		public static function attempt($credentials){
		
		
		$username = $credentials['username'];
		$password = $credentials['password'];
		
		
		$czar = Czar::where("username","=","$username")->first();
		
	
		if($czar){
		
		if(Hash::check($password, $czar->password)){
		
			$czar->last_login = date("Y-m-d H:i:s");
			$czar->last_ip = Request::ip();
			$czar->save();
			Session::put('czar_session',$czar);
		
			
				
			
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
		
		
		public static function czar(){
		
		
			if(Session::has('czar_session'))
			{
			
			
			return Session::get('czar_session');
			
			}
			else{
			
			
			return FALSE;
			
			}
		
		
		
		}
		
		
		
		public static function logout(){
		
			if(Session::has('czar_session'))
			{
			
				Session::forget('czar_session');
			
			}
		
		
		
		}






}