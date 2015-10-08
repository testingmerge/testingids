<?php

class Ajax_Controller extends Base_Controller {


	public $restful = true;

	public function get_check_email() {
		$email = Input::get('email');
		$user = User::where("email","=",$email)->first();
		if($user) {
			return 0;
		}
		return 1;
	}

}