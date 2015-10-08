<?php



class Rewards_Reward_Controller extends Base_Controller {

	public $restful = true;

	public function get_packages(){




		return View::make("rewards::packages");

	}



	public function post_invite_friend(){

				if(s("isrewards")){
				$reward = RewardPackage::where("reason","=","user.invite.friend")->first();
				if($reward && $reward->status == 1) {
					$credits = Credit::where("user_id","=",Auth::user()->id)->first();
				    $balance = $credits->balance + $reward->credits;
					$credits->balance = $balance;
					$credits->save();
					$creditvars['balance'] = $balance;
					$creditvars['amount'] = $reward->credits * Input::get('friends');
					$creditvars['transaction_id'] = "N/A";
		 			$creditvars['type'] = t("youinvitedsomefriends");
					$creditvars['user_id'] = Auth::user()->id;
					Credithistory::create($creditvars);	
				} 
			}


		}






}