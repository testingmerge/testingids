<?php


class Installer_Installer_Controller extends Base_Controller {


		public $restful = true;
		
		
		
		public function get_index(){
		
		if(Input::get('new_install'))
		{
		
			Cookie::forget('installed');
			Cookie::forget('step3');
			Cookie::forget('step2');
			Cookie::forget('step1');
		}
		
		if($this->check_permissions())
		{
			if(Cookie::get('installed')){
			
				return Redirect::to('/');
			
			}
			else if(Cookie::get('step3')){
			
				return $this->step3();
			
			}
			else if(Cookie::get('step2')){
			
				return $this->step2();
			
			}
			else if(Cookie::get('step1'))
			{
			
				return $this->step1();
			
			}
			else{
			
				return $this->write_permissions_check();
			
			}
		}
		else{
		
		return $this->write_permissions_check();
		}
		
		

		
		}
		
		
		function write_permissions_check(){
		
			$vars = array();
			
			
			$vars["storage"] = is_writable(path('base').'/storage');
			
			$vars["uploads"] = is_writable(path('base').'/uploads');
			
			$vars['database'] = is_writable(path('app').'/config/database.php');
			
			$vars['session'] = is_writable(path('app').'/config/session.php');
			

			$vars['allclear'] = $this->check_permissions();

			
			
			return View::make("installer::installer", $vars);
		
		
		
		}
		
		
		function check_permissions(){
		
		if(is_writable(path('base').'/storage') && is_writable(path('base').'/uploads') && is_writable(path('app').'/config/database.php') && is_writable(path('app').'/config/session.php'))
		{
		
			return TRUE;
			
		}
		else{
		
		return FALSE;
		}
		
		
		}
		
		
		public function post_write_permissions_check(){
		
		
			Cookie::forever('step1', true);
			
			return Redirect::to('/installer');
		
		
		}
		
		
		function step1($db_error = null){
		
		
		$vars['db_error'] = $db_error;
		
		return View::make('installer::step1', $vars);
		
		}
		
		
		public function post_step1(){
		
		$credentials = Input::get();
		unset($credentials['tbl_prefix']);
		
		$driver = new \Laravel\Database\Connectors\MySQL;

		$error = null;
			try{
			$connection = new \Laravel\Database\Connection($driver->connect($credentials), $credentials);
				}
				catch(Exception $e)
				{
				
					$error = $e;
				
				}
			
			if($error){
			
				
				return $this->step1(true);
			
			}
			else{
			
			$this->generate_database_file($credentials['host'], $credentials['username'], $credentials['password'], $credentials['database'], Input::get('tbl_prefix'));
			
			
			
			Cookie::forever('step2', true);
			
			
			return Redirect::to('/installer');
				
			}
		
		
		}
		
		
		
		function generate_database_file($host, $username, $password, $database, $prefix){
		
			$stub = File::get(path('bundle')."installer/stubs/database.stub");

			$stub = str_replace("{{HOST}}", $host, $stub);

			$stub = str_replace("{{USERNAME}}", $username, $stub);

			$stub = str_replace("{{PASSWORD}}", $password, $stub);

			$stub = str_replace("{{DATABASE}}", $database, $stub);

			$stub = str_replace("{{PREFIX}}", $prefix, $stub);

			File::put(path('app')."config/database.php", $stub);
		
		
		
		}
		
		
		function generate_session_file(){
		
		$stub = File::get(path('bundle')."installer/stubs/session.stub");
		
		$stub = str_replace("{{DRIVER}}", "database", $stub);
		
		File::put(path('app')."config/session.php", $stub);
		
		}
		
		
		function step2(){
		
		
				return View::make('installer::step2');
		
		}
		
		
		public function post_step2(){
		
		
		Cookie::forever('step3', true);
			
			$this->generate_session_file();
			
		return Redirect::to('/installer');
		
		
		}
		
		
		function step3(){
		
		
			return View::make('installer::step3');
		
		}
		
		
		function post_step3(){
		
			$username = Input::get('username');
			$password = Hash::make(Input::get('password'));
			$title = Input::get('title');
			
			set_setting('title', $title);
			
			$czar = new Czar;
			$czar->username = $username;
			$czar->password = $password;
			
			$czar->save();
			
			
			Cookie::forever('installed', true);
			
			die(json_encode(array("success"=>"1")));
		
		
		
		}
		
		
		public function post_install_db(){

			
			
			$this->SplitSQL(Bundle::path('installer')."stubs/db.sql");
		
		
		}
		
		
		
		function SplitSQL($file, $delimiter = ';')
		{
			set_time_limit(0);

			if (is_file($file) === true)
			{
				$file = fopen($file, 'r');

				if (is_resource($file) === true)
				{
					$query = array();

					while (feof($file) === false)
					{
						$query[] = fgets($file);

						if (preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1)
						{
							$query = trim(implode('', $query));
							
							if (DB::query($query) === false)
							{
								echo '<h3>ERROR: ' . $query . '</h3>' . "\n";
							}

							else
							{
								echo '<h3>SUCCESS: ' . $query . '</h3>' . "\n";
							}

							while (ob_get_level() > 0)
							{
								ob_end_flush();
							}

							flush();
						}

						if (is_string($query) === true)
						{
							$query = array();
						}
					}

					return fclose($file);
				}
			}

			return false;
		}




}