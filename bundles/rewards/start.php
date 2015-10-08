<?php


Autoloader::directories(array(
    Bundle::path('rewards').'models',
   
));

function giveRewards($user,$reason,$creditType) {

	if(s("isrewards") == 1){
		$reward = RewardPackage::where("reason","=",$reason)->first();
		if($reward && $reward->status == 1) {
			$credits = Credit::where("user_id","=",$user->id)->first();
			$balance = $credits->balance + $reward->credits;
			$credits->balance = $balance;
			$credits->save();
			$vars['balance'] = $balance;
			$vars['amount'] = $reward->credits;
			$vars['transaction_id'] = "N/A";
		 	$vars['type'] = t($creditType);
			$vars['user_id'] = $user->id;
			Credithistory::create($vars);	
		}
	} 
}

if(isInstalled()){ 
if(s('isrewards')){




Event::listen("user.visited.profile", function($visitor, $visited){
    
    	
		giveRewards(User::find($visitor),"user.visit.profile","uservisitingprofile");
		giveRewards(User::find($visited),"user.profile.visited","userprofileVisited");

	
}); 


Event::listen('user.contact.added', function($fromuser, $touser)
{
	giveRewards(Auth::user(),"message.request.send","usercontactadded");
});


Event::listen('user.encounter.yes', function($fromuser, $touser)
{
	giveRewards(Auth::user(),"user.encounter.yes","userencounteryes");
});


Event::listen('user.login', function()
{
	giveRewards(Auth::user(),"user.login","userlogin");
});


Event::listen('album.photo.upload', function()
{
	giveRewards(Auth::user(),"album.photo.upload","useralbumupload");
});

Event::listen('profile.photo.upload', function()
{
	giveRewards(Auth::user(),"profile.photo.upload","userprofileupload");
});

Event::listen('user.invite.friend', function()
{
	giveRewards(Auth::user(),"user.invite.friend","userinvitefriend");
});


}

}

