<?php



class Gifts_Gift_Controller extends Base_Controller {


	public $restful = true;




	public function post_send_gift(){
	
	
		$gift_id = Input::get('gift_id');
		
		$gift = Gift::find($gift_id);
		
				$credits = Credit::where("user_id","=",Auth::user()->id)->first();
				
				if($gift->price > 0)
				{
		$balance = $credits->balance - $gift->price;
			}
			else{
			$balance = 1;
			
			}


			if($balance > 0) {
			
					$user_gift = new UserGift;
					
					$user_gift->from_user = Auth::user()->id;
					$user_gift->to_user = Input::get('to_user');
					$user_gift->type_id = $gift_id;
					$user_gift->save();
			
					if($gift->price != 0)
					{
					Auth::user()->debit($gift->price);
					}
				
				Event::fire('user.gift.sent', array(Auth::user(), User::find(Input::get('to_user'))));

					die(json_encode(array("success"=>"1")));
			
			}
			else{
			
			die(json_encode(array("error"=>"low_balance")));
			}
		
	
	
	
	
	}



	public function post_remove_gift(){

		$id = Input::get("gift_id");

		$user_gift = UserGift::find($id);

		if($user_gift)
		{
			$user_gift->delete();

			die(json_encode(array("success"=>"1")));
		}
		else{
			die(json_encode(array("error"=>"1")));
		}



	}
	
	
	
	
}