<?php

class Credits_Credit_Controller extends Base_Controller {

	public $restful = true;


	public function post_add_spotlight(){

		$credits = Credit::where("user_id","=",Auth::user()->id)->first();
		$balance = $credits->balance - s('spotlight_cost');


			if($balance > 0) {

				$spotlight = Spotlight::where('user_id',"=",Auth::user()->id)->first();
					if($spotlight != null) {
						$spotlight->rank++;
						$spotlight->save();
					}
					else {
						$spotlight = new Spotlight();
						$spotlight->user_id = Auth::user()->id;
						$spotlight->rank = 1;
						$spotlight->save();
					}
					
					Auth::user()->debit(s('spotlight_cost'));
				
					die(json_encode(array("success"=>"1")));
 				
 				}
 				else{
 				
 				die(json_encode(array("error"=>"low_balance")));
 				
 				}
 				
 		}
 		
 		
 		public function get_top_up(){
 		
 		
 			return View::make('credits::topup');
 		
 		}
 		
 		
 		
 	public function get_payment(){
		$status = Input::get('st');
		if($status == "Completed") {
			$credits = Credit::where("user_id","=",Auth::user()->id)->first();
		    $balance = $credits->balance + Input::get('item_number');
			$credits->balance = $balance;
			$credits->save();
			$vars['balance'] = $balance;
			$vars['amount'] = Input::get('item_number');
			$vars['transaction_id'] = Input::get('tx');
 			$vars['type'] = "Top up";
			$vars['user_id'] = Auth::user()->id;
			Credithistory::create($vars);	
			Session::flash('payment_successful', "Payment Successful");
		} else {
			Session::flash('payment_error', "Payment error.. try again");
		}
		return Redirect::to('/credits');
	}
	
	
	public function get_premium(){
	
	
	
	
		return View::make('credits::premium');
	}
	
	public function post_buy_superpower(){

		$credits = Credit::where("user_id","=",Auth::user()->id)->first();
		$balance = $credits->balance - s('superpower_cost');


			if($balance > 0) {

					$superpower = Superpower::where("user_id","=",Auth::user()->id)->get();
					
					if($superpower){
					
						$superpower->created_at = date("Y-m-d H:i:s");
						$superpower->save();
					
					}
					else{
					
					$superpower = new Superpower;
					$superpower->user_id = Auth::user()->id;
					$superpower->save();
					
					
					}
			
					
					Auth::user()->debit(s('superpower_cost'));
				
					die(json_encode(array("success"=>"1")));
 				
 				}
 				else{
 				
 				die(json_encode(array("error"=>"low_balance")));
 				
 				}
 				
 		}
 		
 	public function post_buy_riseup(){

		$credits = Credit::where("user_id","=",Auth::user()->id)->first();
		$balance = $credits->balance - s('riseup_cost');


			if($balance > 0) {

					$user = Auth::user()->profile()->first();
					
					$user->popularity = $user->popularity + 1;
					
					$user->save();
					
					Auth::user()->debit(s('riseup_cost'));
				
					die(json_encode(array("success"=>"1")));
 				
 				}
 				else{
 				
 				die(json_encode(array("error"=>"low_balance")));
 				
 				}
 				
 		}
 				
 				
}