<?php

use Gregwar\Image\Image;

class Czar_Czar_Controller extends Base_Controller {

	public $restful = true;
	
	
	
	public function get_index(){
		
		$vars['page_title'] = "Dashboard";

		$vars['users_total'] = User::count();
		$vars['users_male'] =  User::where("gender","=",1)->count();
		$vars['users_female'] =  User::where("gender","=",2)->count();
		$vars['users_online'] = DB::table('sessions')->count();
		$vars['users_today'] = User::where('created_at', '>=', date('Y-m-d H:i:s',time()-(24*60*60)))->count();
		$vars['users_week'] = User::where('created_at', '>=', date('Y-m-d H:i:s',time()-(7*24*60*60)))->count();
		$vars['users_month'] = User::where('created_at', '>=', date('Y-m-d H:i:s',time()-(30*24*60*60)))->count();

		$vars['photos_total'] = Photo::count();
		$vars['photos_today'] = Photo::where('created_at', '>=', date('Y-m-d H:i:s',time()-(24*60*60)))->count();
		$vars['photos_week'] = Photo::where('created_at', '>=', date('Y-m-d H:i:s',time()-(14*24*60*60)))->count();
		$vars['photos_month'] = Photo::where('created_at', '>=', date('Y-m-d H:i:s',time()-(30*24*60*60)))->count();

		
		$vars['gifts_total'] = UserGift::count();
		$vars['gifts_today'] = UserGift::where('created_at', '>=', date('Y-m-d H:i:s',time()-(24*60*60)))->count();
		$vars['gifts_week'] = UserGift::where('created_at', '>=', date('Y-m-d H:i:s',time()-(7*24*60*60)))->count();
		$vars['gifts_month'] = UserGift::where('created_at', '>=', date('Y-m-d H:i:s',time()-(30*24*60*60)))->count();

		$vars['encounters_total'] = Encounter::count();
		$vars['encounters_today'] = Encounter::where('created_at', '>=', date('Y-m-d H:i:s',time()-(24*60*60)))->count();
		$vars['encounters_week'] = Encounter::where('created_at', '>=', date('Y-m-d H:i:s',time()-(7*24*60*60)))->count();
		$vars['encounters_month'] = Encounter::where('created_at', '>=', date('Y-m-d H:i:s',time()-(30*24*60*60)))->count();		

		$vars['msg_total'] = Chat::count();
		$vars['msg_today'] = Chat::where('created_at', '>=', date('Y-m-d H:i:s',time()-(24*60*60)))->count();
		$vars['msg_week'] = Chat::where('created_at', '>=', date('Y-m-d H:i:s',time()-(7*24*60*60)))->count();
		$vars['msg_month'] = Chat::where('created_at', '>=', date('Y-m-d H:i:s',time()-(30*24*60*60)))->count();		
				

		$vars['photo_rater_total'] = PhotoRater::count();
		$vars['photo_rater_today'] = PhotoRater::where('created_at', '>=', date('Y-m-d H:i:s',time()-(24*60*60)))->count();
		$vars['photo_rater_week'] = PhotoRater::where('created_at', '>=', date('Y-m-d H:i:s',time()-(7*24*60*60)))->count();
		$vars['photo_rater_month'] = PhotoRater::where('created_at', '>=', date('Y-m-d H:i:s',time()-(30*24*60*60)))->count();

		return View::make('czar::dashboard',$vars); 
		
	}
	
	
	public function get_login(){
	
	
		return View::make('czar::login');
	
	}
	
	
	public function post_login(){
	
		$credentials = Input::all();
		
		if(CzarAuth::attempt($credentials))
		{
		
			return Redirect::to('/czar');
		}
		else
		{
			Session::flash('login_error', "Invalid Username/Password");
			return Redirect::to('/czar/login');
			
			}
		
	
	}
	
	public function get_logout(){
	
		CzarAuth::logout();
		
		return Redirect::to('/czar/login');
	
	
	}
	
	public function post_general_settings() {
		$title = Input::get("title");
		set_setting("title", $title);
		
		$mode = Input::get("mode");
		set_setting("debug_mode", $mode);
		Session::flash('general_updated', "Settings updated successfully");
		return Redirect::to("/czar/app_settings");
	}
	
	public function post_upload_site_logo(){
		
        $file = Input::file('photo');

		$image = Image::open($file['tmp_name']);
		$filename =  uniqid($file['size']);	
		if($image->save(path('base')."/uploads/app/$filename.png",'png'))
		{
			set_setting("logo",$filename);
		}
		Session::flash('logo_updated', "Settings updated successfully");
		return Redirect::to("/czar/app_settings");
	}

	public function post_delete_site_logo() {
		$siteLogo = Setting::where("name","=","logo")->first();
		if($siteLogo != null) {
			$siteLogo->value = 0;
			$siteLogo->save();
		}
		Session::flash('logo_updated', "Settings updated successfully");
		return Redirect::to('/czar/app_settings');	
	}

	public function post_upload_favicon(){
		
        $file = Input::file('photo');

		$image = Image::open($file['tmp_name']);
		$filename =  uniqid($file['size']);	
		if($image->save(path('base')."/uploads/app/$filename.ico",'png'))
		{
			set_setting("favicon",$filename);
		}
		Session::flash('favicon_updated', "Settings updated successfully");
		return Redirect::to("/czar/app_settings");
	}

	public function post_delete_favicon() {
		
		$faviconLogo = Setting::where("name","=","favicon")->first();
		if($faviconLogo != null) {
			$faviconLogo->value = 0;
			$faviconLogo->save();
		}
		
		Session::flash('favicon_updated', "Settings updated successfully");
		return Redirect::to('/czar/app_settings');	
	}
	
	public function post_seo_settings() {
		
		$description = Input::get("description");
		$keywords = Input::get("keywords");
		$isSearchEngineAccess = Input::get("isSearchEngineAccess");
		
		set_setting("description",$description);
		set_setting("meta_keywords",$keywords);
		set_setting("search_engine_access",$isSearchEngineAccess);
		
		Session::flash('seo_updated', "Settings updated successfully");
		
		return Redirect::to("/czar/seo_settings");
	}
	
	
	
	public function get_facebook_settings() {
		$vars['fbid'] = s("fbid");
		$vars['fbsecret'] = s("fbsecret");
		$vars['page_title'] = "Facebook Setting";
		return View::make('czar::facebook_settings',$vars);

	}
	
	public function post_facebook_settings() {
		
		set_setting("fbid",Input::get("facebookid"));
		set_setting("fbsecret",Input::get("facebooksecret"));
		Session::flash('updated', "Successfully created a new Czar");
		return Redirect::to("czar/facebook_settings");
	}

	public function get_paypal_settings() {
		$vars['paypalusername'] = s("paypalusername");
		$vars['page_title'] = "Paypal Setting";
		return View::make('czar::paypal_settings',$vars);

	}
	
	public function post_paypal_settings() {
		set_setting("paypalusername", Input::get("paypalusername"));
		Session::flash('updated', "Successfully created a new Czar");
		return Redirect::to("czar/paypal_settings");
	}

	public function get_analytics_settings() {
		$vars['account_no'] = s("google_ua");
		$vars['page_title'] = "Analytics Setting";
		return View::make('czar::analytics_settings',$vars);

	}
	
	public function get_abuse_reports() {
		$vars['page_title'] = t('abusereports');
		
		$unseenReports = AbuseReport::where("status","=",0)->get();
		foreach($unseenReports as $report){
			$report->reportinguser = User::find($report->reporting_user_id);
			$report->reporteduser = User::find($report->reported_user_id);
		}
		//$unseenReports  = $unseenReports->paginate(20);
		$vars['unseenreports'] = $unseenReports;
		
		$seenReports = AbuseReport::where("status","=",1)->get();
		foreach($seenReports as $report){
			$report->reportinguser = User::find($report->reporting_user_id);
			$report->reporteduser = User::find($report->reported_user_id);
		}
		//$seenReports  = $seenReports->paginate(20);
		$vars['seenreports'] = $seenReports;
		
		return View::make('czar::abuse_reports',$vars);
	}
	
	public function post_abuse_report_mark_seen() {
		$id = Input::get("id");
		$report = AbuseReport::where("id","=",$id)->first();
		$report->status = 1;
		$report->save();
		return Redirect::to("czar/abuse_reports");
	}
	
	public function post_abuse_report_mark_unseen() {
		$id = Input::get("id");
		$report = AbuseReport::where("id","=",$id)->first();
		$report->status = 0;
		$report->save();
		return Redirect::to("czar/abuse_reports");
	}
	
	public function get_premium_features() {
		
		$vars['spotlight_cost'] = s("spotlight_cost");
		$vars['riseup_cost'] = s("riseup_cost");
		$vars['superpower_cost'] = s("superpower_cost");
		$vars['page_title'] = t('featurescontrol');
		return View::make('czar::premium', $vars);
	}
	
	public function post_updatefeatures() {
		
		set_setting("spotlight_cost", Input::get("spotlight_cost"));
		set_setting("riseup_cost", Input::get("riseup_cost"));
		set_setting("superpower_cost", Input::get("superpower_cost"));
		Session::flash('updated', "Successfully created a new Czar");
		return Redirect::to("czar/premium_features");
	}
	
	public function post_analytics_settings() {
		set_setting("google_ua", Input::get("account_no"));
		Session::flash('updated', "Successfully created a new Czar");
		return Redirect::to("czar/analytics_settings");
	}
	
	
  	public function get_app_settings(){
	
		if(s("logo")) {
			$vars['sitelogourl'] = s("logo") .".png";
		} else {
			$vars['sitelogourl'] = null;
		} if(s("favicon")) {
			$vars['sitefaviconurl'] = s("favicon").".ico";
		} else {
			$vars['sitefaviconurl'] = null;
		}
		$vars['siteTitle'] = s("title");
		$vars['mode'] = s("debug_mode");
		$vars['page_title'] = "Application Setting";
		return View::make('czar::app_settings',$vars);
	
	}
	
	public function get_seo_settings() {
		$vars['description'] = s("description");
		$vars['keywords'] = s("meta_keywords");
		$vars['isSearchEngineAccess'] = s("search_engine_access");
		$vars['page_title'] = "SEO Setting"; 
		return View::make('czar::seo_settings',$vars);
	}
	
	public function get_credits_settings() {
		
		$vars['page_title'] = t('creditscontrol');
		$vars['packages'] = Package::all();
		
		$defaultcredits = Setting::where('name','=','defaultcredits')->first();
		if($defaultcredits == null){
			$vars['defaultcredits'] = "0";		
		}
		else {
			$vars['defaultcredits'] = $defaultcredits->value;
		}
		
		$isenabled = Setting::where('name','=','iscredits')->first();
		if($isenabled == null){
			$vars['isenabled'] = "0";		
		}
		else {
			$vars['isenabled'] = $isenabled->value;
		}
		
		
		return View::make("czar::credits",$vars);
	}
	
	public function post_add_credits_package() {
		
		$vars['cost'] = Input::get('cost');
		$vars['credits'] = Input::get('credits');
		
		Package::create($vars);
		
		Session::flash('created_package', "Successfully created a new Czar");
		return Redirect::to("/czar/credits_settings");
	}
	
	public function post_delete_credits_package() {
		$id = Input::get("id");
		Package::find($id)->delete();
		
		Session::flash('deleted_package', "Successfully created a new Czar");
		return Redirect::to('/czar/credits_settings');
	}
	
	public function post_credit_all_users() {
		$amount = Input::get("all_users_credit");
		$type = Input::get('reason');
		
		$users = User::all();
		foreach($users as $user) {
			$credit = Credit::where("user_id","=",$user->id)->first();
			if($credit) {
				
				$balance = $credit->balance + $amount;
				$credit->balance = $balance;
				$credit->save();
				
				$vars['balance'] = $balance;
				$vars['amount'] = $amount;
				$vars['transaction_id'] = "N/A";
	 			$vars['type'] = $type;
				$vars['user_id'] = $user->id;
				Credithistory::create($vars);	
			}
		}
		Session::flash('credit_all', "Successfully created a new Czar");
		return Redirect::to('/czar/credits_settings');
	}
	
	public function post_update_credits_general() {
		
		set_setting("defaultcredits",Input::get('defaultcredits'));
		
		$enabled = Input::get('isenabled');
		set_setting("iscredits",$enabled);
		
		if($enabled == '0'){
			set_setting("isspotlight","0");
			set_setting("issuperpowers","0");
			
		}
		Session::flash('update_general', "Successfully created a new Czar");
		return Redirect::to("/czar/credits_settings");
	}
	

	
	
	
	public function get_czars(){
	
		$vars['page_title'] = "Czars Management";
		
		
		$czars = Czar::all();
		
		$vars['czars'] = $czars;
		
		return View::make('czar::czars',$vars);
	
		
	}
	
	public function post_add_new_czar(){
	
	
		$input = Input::all();
		$rules = array(
				'username'  => 'required|max:50|unique:czars',
				'password' => 'required|confirmed',

			);
			
			
			$validation = Validator::make($input, $rules);
 
			if ($validation->fails())
			{
				 return Redirect::to('czar/czars')->with_errors($validation);
			}
			else{
			
			
				$czar = new Czar;
				$czar->username = Input::get('username');
				$czar->password = Hash::make(Input::get('password'));
				$czar->save();
				
				Session::flash('new_czar', "Successfully created a new Czar");
				return Redirect::to('/czar/czars');
			
			
			}
	
	
	
	}
	
	
	public function post_change_password(){
	
		$czar = Czar::find(Input::get('czar_id'));

		$czar->password = Hash::make(Input::get('new_password'));
		
		$czar->save();
		
		Session::flash('password_changed', "Password Changed Successfully");
		
		return Redirect::to('/czar/czars/');
	
	
	
	}
	
		
	public function post_delete_czar(){
	
		
		$czar = Czar::find(Input::get('czar_id'));
		
		$czar->delete();
		
		Session::flash('czar_deleted', "Czar Deleted Successfully");
		
		return Redirect::to('/czar/czars/');
	
	
	
	}
	
	
	public function get_language_settings(){
	
		$vars['page_title'] = "Language Settings";
	
		$vars['default_language'] = s('default_language');
		
		$vars['user_languages'] = Language::get_user_languages();
		
		return View::make('czar::language.select', $vars);
	
	}	
	
	
	public function post_language_settings(){
	
		$language = Input::get('default_language');
		
		Setting::set_setting('default_language', $language);
		
		
		Session::flash('language_updated', "Czar Deleted Successfully");
		
		return Redirect::to('/czar/language_settings');
	
	
	}
	
	
	public function post_user_languages(){
	
		$user_languages = Language::get_user_languages();
		
		$post_ul = Input::all();
		


		foreach($user_languages as $k=>$v)
		{
		
				
				if(array_key_exists($k, $post_ul)){
				

				$user_languages[$k] = 1;
				
				}
				else{
				
					$user_languages[$k] = 0;
					
				}
			
		
		
		}
		
		set_setting('user_languages',json_encode($user_languages));
		
		Session::flash('user_language_updated', "Czar Deleted Successfully");
		
		return Redirect::to('/czar/language_settings');		
	
	
	
	}
	
	
	public function get_edit_language($language){
	
		$array = array();
		$vars['l'] = $l = $language;
		
		$default = include(path('app')."language/".s('default_language')."/app.php");
		
		$language =  include(path('app')."language/$language/app.php");
		

		foreach($default as $k => $v)
		{
		
			$a = new stdClass;
			$a->mcode = $k;
			$a->left_lang = $v;
			if(isset($language[$k]))
			{
			$a->right_lang = $language[$k];
			}
			else{
			
			$a->right_lang = "";
			
			}
			array_push($array, $a);
		
		}
		
		$vars['page_title'] = "Edit Language";
		$vars['language'] = $array;
		
		if(is_writable(path('app')."language/$l/app.php"))
		{
		
			$vars['is_writable'] = true;
		}
		else{
		
			$vars['is_writable'] = false;
		
		}
		
		$vars['lang_path'] = path('app')."language/$l/app.php";
		
		return View::make('czar::language.edit', $vars);
	
	
	}
	
	
	public function post_edit_language(){
	
		$new_words = Input::all();
		$l = $new_words['l'];
		unset($new_words['l']);
		$array = make_array($new_words);
		File::put(path('app')."language/$l/app.php", $array);
	
		return Redirect::to("czar/edit_language/$l");
	
	
	
	}
	
	
	public function get_interests(){
	
	$vars['page_title'] = "Interests Management";
	
	$vars['categories'] = InterestCategory::all();
	
	$vars['interest_categories'] = InterestCategory::lists('name','code');
	

	
	return View::make('czar::interests', $vars);
	
	
	}
	
	public function get_gifts(){
	
	$vars['page_title'] = "Gifts Management";
	
	$vars['gifts'] = Gift::all();
	
	
	return View::make('czar::gifts', $vars);
	
	
	}
	
	public function post_add_interest_category(){
	
		$interest = Input::get('interestname');
		
		$interest_code = preg_replace('/\s+/', '', $interest);
		
		$interest_code = strtolower($interest_code);
		
		$vars['name'] = $interest;
		$vars['code'] = $interest_code;
		
		$interest = InterestCategory::create($vars);
		
		
		Session::flash('updated', "Interest Category Added Successfully");
		
		return Redirect::to('/czar/interests');	
	
	
	}
	
	
	public function post_add_interest(){
	
	
		$vars['name'] = Input::get('interestname');
		
		$vars['category'] = Input::get('interest_category');
		
		
		$interest = Interest::create($vars);

		Session::flash('interest_added', "Interest Added Successfully");
		
		return Redirect::to('/czar/interests');			

	}
	
	public function post_add_gift(){
	
	
		$vars['name'] = Input::get('name');
		
		$vars['price'] = Input::get('price');
		
		
		$file = Input::file('photo');

		$image = Image::open($file['tmp_name']);
		$filename =  uniqid($file['size']);
		if($image->cropResize(170, 170)->save(path('base')."/uploads/gifts/$filename.png",'png'))
		{
			$vars['icon_id'] = $filename;
		}
		
		$gift = Gift::create($vars);

		Session::flash('gift_added', "Gift Added Successfully");
		
		return Redirect::to('/czar/gifts');			

	}
	
	
	public function post_delete_interest_category(){
	
		$interest = InterestCategory::find(Input::get('id'));
		
		$interest->delete_all();
		
		Session::flash('interest_category_deleted', "Interest Category Deleted Successfully");
		
		return Redirect::to('/czar/interests');			
	
	
	}
	
	public function post_delete_interest(){
	
		$interest = Interest::find(Input::get('id'));
		$interest->delete();
		
		Session::flash('interest_deleted', "Interest Deleted Successfully");
		
		return Redirect::to('/czar/interests');			

	}
	
	public function post_delete_gift(){
	
		$gift = Gift::find(Input::get('id'));
		$gift->delete();
		
		Session::flash('gift_deleted', "Gift Deleted Successfully");
		
		return Redirect::to('/czar/gifts');			

	}
	
	public function post_update_email_config(){

		set_setting("email_host", Input::get("host"));
		
		set_setting("email_port", Input::get("port"));
		
		//set_setting("email_username", Input::get("username"));
		
		set_setting("email_password", Input::get("password"));
		
		set_setting("email_encryption", Input::get("encryption"));
		
		set_setting("from_email", Input::get("from_email"));
		
		return Redirect::to("/czar/email_settings");
	}

	public function post_update_email_notification() {

		set_setting("email_notification_profile_visitor", Input::get("profilevisitor"));

		set_setting("email_notification_message", Input::get("message"));
		
		set_setting("email_notification_meetme", Input::get("wantstomeet"));

		set_setting("email_notification_mutual_attraction", Input::get("mutualattraction"));		
		
		set_setting("email_notification_disable_user", Input::get("disableuser"));		
		
		set_setting("email_notification_delete_photo", Input::get("deletephoto"));		

		set_setting("email_notification_delete_user", Input::get("deleteuser"));			
		
		set_setting("email_notification_add_contact", Input::get("addcontact"));
		
		set_setting("email_notification_send_gift", Input::get("sendgift"));
		
		set_setting("email_notification_comment_photo", Input::get("commentphoto"));
		
		set_setting("email_notification_rate_photo", Input::get("ratephoto"));
		
		return Redirect::to("/czar/email_settings");
	}

	
	public function get_email_settings(){
		
		$vars['page_title'] = "Emails Management";
	
		$vars['host'] = s("email_host");
		
		$vars['port'] = s("email_port");
		
		//$vars['username'] = s("email_username");
		
		$vars['password'] = s("email_password");
		
		$vars['encryption'] = s("email_encryption");
		
		$vars['from_email'] = s("from_email");
		
		$vars['profilevisitor'] = s("email_notification_profile_visitor");
		
		$vars['wantstomeet'] = s("email_notification_meetme");

		$vars['mutualattraction'] = s("email_notification_mutual_attraction");
		
		$vars['message'] = s("email_notification_message");
		
		$vars['addcontact'] = s("email_notification_add_contact");
		
		$vars['sendgift'] = s("email_notification_send_gift");
		
		$vars['disableuser'] = s("email_notification_disable_user");
		
		$vars['deletephoto'] = s("email_notification_delete_photo");
		
		$vars['deleteuser'] = s("email_notification_delete_user");
		
		$vars['commentphoto'] = s("email_notification_comment_photo");
		
		$vars['ratephoto'] = s("email_notification_rate_photo");
		
		$vars['profilevisitoremail'] = s("email_content_profile_visitor");
		
		$vars['messageemail'] =s("email_content_message");
		
		$vars['addcontactemail'] =s("email_content_add_contact");
		
		$vars['sendgiftemail'] =s("email_content_send_gift");
		
		$vars['meetmeemail'] = s("email_content_meetme");

		$vars['mutualattractionemail'] = s("email_content_mutual_attraction");
		
		$vars['forgotpasswordemail'] = s("email_content_forgot_password");
		
		$vars['emailverificationemail'] = s("email_content_email_verification");
		
		$vars['disableuseremail'] = s("email_content_disbale_user");
		
		$vars['deletephotoemail'] = s("email_content_delete_photo");

		$vars['deleteuseremail'] = s("email_content_delete_user");
		
		$vars['commentphotoemail'] = s("email_content_comment_photo");
		$vars['ratephotoemail'] = s("email_content_rate_photo");
		
		$vars['profilevisitoremailsubject'] = s("email_subject_profile_visitor");
		
		$vars['messageemailsubject'] = s("email_subject_message");
		
		$vars['addcontactemailsubject'] = s("email_subject_add_contact");
		
		$vars['sendgiftemailsubject'] = s("email_subject_send_gift");
		
		$vars['meetmeemailsubject'] = s("email_subject_meetme");
		$vars['mutualattractionsubject'] = s("email_subject_mutual_attraction");
		$vars['forgotpasswordemailsubject'] = s("email_subject_forgot_password");
		$vars['emailverificationemailsubject'] = s("email_subject_email_verification");
		$vars['disableuseremailsubject'] =	s("email_subject_disbale_user");
		$vars['deletephotoemailsubject'] = s("email_subject_delete_photo");
		$vars['deleteuseremailsubject'] = s("email_subject_delete_user");
		
		$vars['commentphotoemailsubject'] = s("email_subject_comment_photo");
		$vars['ratephotoemailsubject'] = s("email_subject_rate_photo");
		
		return View::make('czar::email_settings', $vars);

	}


	public function post_profile_visitor_email_content() {
		
		set_setting("email_content_profile_visitor", Input::get('profilevisitoremail'));
		
		set_setting("email_subject_profile_visitor", Input::get('profilevisitoremailsubject'));
		
		return Redirect::to("/czar/email_settings");
	}

	
	public function post_message_email_content() {

		set_setting("email_content_message", Input::get('messageemail'));
		
		set_setting("email_subject_message", Input::get('messageemailsubject'));
		
		return Redirect::to("/czar/email_settings");
	}
	
	public function post_add_contact_email_content() {

		set_setting("email_content_add_contact", Input::get('addcontactemail'));
		
		set_setting("email_subject_add_contact", Input::get('addcontactemailsubject'));
		
		return Redirect::to("/czar/email_settings");
	}
	
	public function post_send_gift_email_content() {

		set_setting("email_content_send_gift", Input::get('sendgiftemail'));
		
		set_setting("email_subject_send_gift", Input::get('sendgiftemailsubject'));
		
		return Redirect::to("/czar/email_settings");
	}
	
	

	
	public function post_meetme_email_content() {

		set_setting("email_content_meetme", Input::get('meetmeemail'));
		
		set_setting("email_subject_meetme", Input::get('meetmeemailsubject'));
		
		return Redirect::to("/czar/email_settings");
	}

	public function post_mutual_attraction_email_content() {

		set_setting("email_content_mutual_attraction", Input::get('mutualattractionemail'));
		
		set_setting("email_subject_mutual_attraction", Input::get('mutualattractionemailsubject'));
		
		return Redirect::to("/czar/email_settings");
	}

	
	public function post_forgot_password_email_content() {

		set_setting("email_content_forgot_password", Input::get('forgotpasswordemail'));
		
		set_setting("email_subject_forgot_password", Input::get('forgotpasswordemailsubject'));
		
		return Redirect::to("/czar/email_settings");
		
	}

	
	public function post_email_verification_email_content() {

		set_setting("email_content_email_verification", Input::get('emailverificationemail'));
		
		set_setting("email_subject_email_verification", Input::get('emailverificationemailsubject'));
		
		return Redirect::to("/czar/email_settings");
	}
	
	public function post_disable_user_email_content() {

		set_setting("email_content_disable_user", Input::get('disableuseremail'));
		
		set_setting("email_subject_disable_user", Input::get('disableuseremailsubject'));
		
		return Redirect::to("/czar/email_settings");
		
	}
	
	public function post_delete_usser_email_content() {

		set_setting("email_content_delete_user", Input::get('deleteuseremail'));
		
		set_setting("email_subject_delete_user", Input::get('deleteuseremailsubject'));
		
		return Redirect::to("/czar/email_settings");
		
	}
	
	public function post_delete_photo_email_content() {

		set_setting("email_content_delete_photo", Input::get('deletephotoemail'));
		
		set_setting("email_subject_delete_photo", Input::get('deletephotoemailsubject'));
		
		return Redirect::to("/czar/email_settings");
		
	}

	public function post_comment_photo_email_content() {

		set_setting("email_content_comment_photo", Input::get('commentphotoemail'));
		
		set_setting("email_subject_comment_photo", Input::get('commentphotoemailsubject'));
		
		return Redirect::to("/czar/email_settings");
		
	}
	
	public function post_rate_photo_email_content() {

		set_setting("email_content_rate_photo", Input::get('ratephotoemail'));
		
		set_setting("email_subject_rate_photo", Input::get('ratephotoemailsubject'));
		
		return Redirect::to("/czar/email_settings");
	}
	
	public function get_growth_hacking() {

		$vars['page_title'] = "Growth Hacking";

		$vars['facebook_share'] = s("facebook_share");

		return View::make('czar::growth_hacking', $vars);
	}

	public function post_facebook_share() {

		set_setting('facebook_share',Input::get("facebook_share"));

		Session::flash("facebook_share_updated","Facebook share was updated successfully");

		return Redirect::to("/czar/growth_hacking");	
	}

	public function get_users() {
		
		$vars['page_title'] = "User Management";

		$user_type = Input::get('users');
		$name = Input::get('name');
		$city = Input::get('city');
		if($user_type == '1') {
			$type = array('type' => "male" );
			$users = User::where('gender',"=",1)->order_by('created_at','desc');
			$vars['user_type'] = 1;
		} else if($user_type == '2') {
			$type = array('type' => "female" );
			
			$users = User::where('gender',"=",2)->order_by('created_at','desc');
			$vars['user_type'] = 2;
		} else {
			$type = array();
			$users = User::order_by('created_at','desc');
			$vars['user_type'] = 0;
		}
		if($name != "name") {		
			if (is_numeric($name)) {
				$users = $users->where('id','=',$name);
			} else if(filter_var($name, FILTER_VALIDATE_EMAIL)) {
        			$users = $users->where('email',"=", $name);
    			} else {
			$users = $users->where('name', 'like', $name.'%');
			}
			$vars['name'] = $name;
		} else {
			$vars['name'] = "name";
		}
 		if($city != "city") {
			$users = $users->where('city', 'like', '%'.$city.'%');
			$vars['city'] = $city;
		} else {
			$vars['city'] = "city";
		}
		$users = $users->paginate(20);
		$vars['users'] = $users;
		$vars['type'] = $type;

		return View::make('czar::users', $vars);
	}

	public function post_delete_user() {
		$id = Input::get("id");
		$user = DB::table('sessions')->where("user_id","=",Input::get("id"))->delete();
		$user = User::find($id);
			
		/*if(Setting::get_setting('email_notification_delete_user') == 1 && $user->email) {

			$content = Setting::get_setting("email_content_delete_user");
			$content = str_replace("[username]",$user->name,$content);
			$content = str_replace("[site_link]","",$content);
						
			if(Setting::get_setting('from_email')){ 
				SMessage::to($user->email)
    				->from(Setting::get_setting('from_email'), Setting::get_setting('title'))
    				->subject(Setting::get_setting("email_subject_delete_user"))
    				->body($content)
    				->send();
    			}
		}

		$fb = FBUser::where("user_id","=",$user->id)->first();
		if($fb) {
			$facebook = IoC::resolve('facebook-sdk');
			$facebook->api('/'. $fb->facebook_id. '/permissions', 'DELETE');
			$fb->delete();

		}*/
			
		$user->delete();
		return Redirect::to('/czar/users');
	}

	public function post_disable_user() {
		$id = Input::get("id");
		$user = DB::table('sessions')->where("user_id","=",Input::get("id"))->delete();
			$user = User::find($id);
			if($user){
				$user->verified = 2;
				$user->save();
				/*if(Setting::get_setting('email_notification_disable_user') == 1 && $user->email) {
					$content = Setting::get_setting("email_content_disable_user");
					$content = str_replace("[username]",$user->name,$content);
					$content = str_replace("[site_link]","",$content);
						
					if(Setting::get_setting('from_email')){ 
					SMessage::to($user->email)
    					->from(Setting::get_setting('from_email'), Setting::get_setting('title'))
    					->subject(Setting::get_setting("email_subject_disable_user"))
    					->body($content)
    					->send();

    				}
				}*/
			}
			return Redirect::to('/czar/users');
	}

	public function post_verify_user(){
		$id = Input::get("id");
		
			$user = DB::table('sessions')->where("user_id","=",$id)->delete();
			$user = User::find($id);
			if($user){
				$user->verified = 1;
				$user->save();
			}
		

		return Redirect::to('/czar/users');
	}

	public function post_reset_password(){
		$id = Input::get("id");
		$user = User::find($id);
		/*if($user){
			$content = Setting::get_setting("email_content_forgot_password");
			$content = str_replace("[username]",$user->name,$content);
			$content = str_replace("[verification_no]",$user->verification_no,$content);
			$content = str_replace("[site_link]","",$content);
							
			if(Setting::get_setting("from_email") && $user->email){ 
			SMessage::to($user->email)
	    		->from(Setting::get_setting("from_email"), Setting::get_setting('title'))
	    		->subject(Setting::get_setting("email_subject_forgot_password"))
	    		->body($content)
	    		->send();	
	    	}
		}*/
		return Redirect::to('/czar/users');
	}
	
	public function post_credit_user() {
		$amount = Input::get("credits");
		$user_id = Input::get("userid");
		$type = Input::get('reason');
		
		$credit = Credit::where("user_id","=",$user_id)->first();
		if($credit) {
			
			$balance = $credit->balance + $amount;
			$credit->balance = $balance;
			$credit->save();
			
			$vars['balance'] = $balance;
			$vars['amount'] = $amount;
			$vars['transaction_id'] = "N/A";
 			$vars['type'] = $type;
			$vars['user_id'] = $user_id;
			Credithistory::create($vars);	
		}
		return Redirect::to('/czar/users');
	}

	public function post_enable_user(){
		$id = Input::get("id");
		if(Auth::User()->id == $id){
			Session::flash('delete_error', Lang::line('app.deleteaccounterror')->get(Setting::get_setting('language')));
		} else {
			$user = DB::table('sessions')->where("user_id","=",$id)->delete();
			$user = User::find($id);
			if($user){
				$user->verified = 1;
				$user->save();
			}
		}

		return Redirect::to('/czar/users');
	}

	public function post_update_rewards_setting(){
		
		$enabled = Input::get('isrewards');
		set_setting("isrewards",$enabled);
		if($enabled == '0'){
			$topupsetting = Setting::where("name","=","istopup")->first();

			if($topupsetting->value != 1) {
				set_setting("isspotlight",0);
				set_setting("issuperpower",0);
				
				Session::flash("all_rewards_and_topup_disabled","Rewards are disabled as all reward packages are disabled");
			} 
		}
		return Redirect::to('/czar/rewards_settings');	
	}

	
	public function post_update_rewards() {
		$rewards = RewardPackage::all();
		foreach($rewards as $reward) {
			$reward->credits = Input::get("credits$reward->id");
			$reward->status = Input::get("isenable$reward->id");
			$reward->save();
		}
		
		$activerewards = RewardPackage::where("status","=",1)->get();
		if($activerewards == null) {
			set_setting("isrewards",0);

			$topupsetting = Setting::where("name","=","istopup")->first();
			if($topupsetting->value != 1) {
				set_setting("isspotlight",0);
				set_setting("issuperpower",0);
			
				Session::flash("all_rewards_and_topup_disabled","Rewards are disabled as all reward packages are disabled");
			} else {
				Session::flash("all_rewards_disabled","Rewards are disabled as all reward packages are disabled");
			}
			
 		}
		
		return Redirect::to('/czar/rewards_settings');	
	}

	public function get_rewards_settings(){
		$vars['page_title'] = t('rewardscontrol');
		$vars['rewards'] = RewardPackage::all();

		$setting = Setting::where("name","=","isrewards")->first();
		if($setting != null) {
			$vars['isrewards'] = $setting->value;
		} else {
			$vars['isrewards'] = 0;
		}
		return View::make('czar::rewards', $vars);
	}

 	public function post_delete_photo() {
		$photo_id = Input::get("id");

		$photo = Photo::find($photo_id);
		$photo->delete();
		return Redirect::to('/czar/users');	
	}

	public function get_game_mechanics() {
		
		$vars['page_title'] = t('gamemechanics');
	
		$vars['no_bot'] = s("no_bot");
		$vars['bot_gender'] = s("bot_gender");
		$vars['bots'] = Bot::all();
		return View::make('czar::game_mechanics',$vars);
	}

	public function post_create_bot() {
		$vars = Input::get();
	
		$currentDate = Date::forge();

		$userDOB = Date::forge(Input::get('day')."-".Input::get('month')."-".Input::get('year'));

		$diff = Date::diff($currentDate, $userDOB);

		if($diff->y < 18){
			$vars['age'] = 18;
		}
		else{
			$vars['age'] = $diff->y;
		}
				
		unset($vars['day']);
		unset($vars['month']);
		unset($vars['year']);

		//$joining = Date::forge(Input::get('join_day')."-".Input::get('join_month')."-".Input::get('join_year'));
		$vars['joining'] = date("Y-m-d H:i:s", mktime(0, 0, 0, Input::get('join_month'), Input::get('join_day'), Input::get('join_year')) );
 
		
		unset($vars['join_day']);
		unset($vars['join_month']);
		unset($vars['join_year']);
	
		if($vars['gender'] == 0){
			$vars['gender'] = 2;
		}
	
		$vars['enable'] = 1;


		$file = Input::file('photo');
		
		//list($width, $height, $type, $attr) = getimagesize($file['tmp_name']);
			
		$image = Image::open($file['tmp_name']);
				
		$ranno =  uniqid($file['size']);		
		$filename = time().$ranno;
				
			
		if($image->save(path('base')."/uploads/originals/$filename.jpg",'jpg','100'))
		{
			$image->cropResize(279, 300)->save(path('base')."/uploads/medium/$filename.jpg",'jpg','100');
			$image->cropResize(135, 180)->save(path('base')."/uploads/small/$filename.jpg",'jpg','100');
			$image->cropResize(70, 70)->save(path('base')."/uploads/thumbnails/$filename.jpg",'jpg','100');
			$photo = new Photo();
			$photo->photo_id = $filename;
       			$photo->user_id = 0;
			$photo->save(); 
		}		

		$vars['photo_id'] = $photo->photo_id;
		$user_array = array();

		$user_array_serial = serialize($user_array);
		$vars['user_ids'] = $user_array_serial;

		Bot::create($vars);

		Session::flash("bot_created", "Bot created successfully");
		return Redirect::to('czar/game_mechanics');
	}


	public function post_delete_bot(){
	
		$bot = Bot::find(Input::get('id'));
		$bot->delete();
		
		Session::flash('bot_deleted', "Bot Deleted Successfully");
		
		return Redirect::to('/czar/game_mechanics');		
	}

	public function post_disable_bot() {
		$id = Input::get("id");
		$bot = Bot::find($id);
		if($bot){
			$bot->enable = 2;
			$bot->save();
				
		}
		return Redirect::to('/czar/game_mechanics');	
	}

	public function post_enable_bot() {
		$id = Input::get("id");
		$bot = Bot::find($id);
		if($bot){
			$bot->enable = 1;
			$bot->save();
				
		}
		return Redirect::to('/czar/game_mechanics');	
	}

	public function post_game_mechanics_setting() {
	
		set_setting('no_bot',Input::get("no_bot"));
		set_setting('bot_gender',Input::get("bot_gender"));

		Session::flash("updated","Settings updated successfully");

		return Redirect::to("czar/game_mechanics");
	}

	public function get_frontpage(){
	
	$vars['page_title'] = "Frontpage Appearance";
	
	$vars['frontbackgroundimage'] = s('frontbackgroundimage');
	
	$vars['loginbackgroundimage'] = s('loginbackgroundimage');
	
	return View::make("czar::frontpage", $vars);
	
	
	}


	public function post_upload_frontpageimage(){

		 $file = Input::file('photo');

		$image = Image::open($file['tmp_name']);
		$filename =  uniqid($file['size']);	
		if($image->save(path('base')."/uploads/app/$filename.png",'png'))
		{
			set_setting("frontbackgroundimage",$filename);
		}
		Session::flash('frontbackgroundimage_updated', "Settings updated successfully");
		return Redirect::to("/czar/frontpage");




	}

	public function post_upload_loginpageimage(){

		 $file = Input::file('photo');

		$image = Image::open($file['tmp_name']);
		$filename =  uniqid($file['size']);	
		if($image->save(path('base')."/uploads/app/$filename.png",'png'))
		{
			set_setting("loginbackgroundimage",$filename);
		}
		Session::flash('loginbackgroundimage_updated', "Settings updated successfully");
		return Redirect::to("/czar/frontpage");




	}


	public function post_delete_frontpageimage(){

		set_setting('frontbackgroundimage', "");

		Session::flash('frontbackgroundimage_updated', "Settings updated successfully");
		return Redirect::to("/czar/frontpage");

	}

	public function post_delete_loginpageimage(){

		set_setting('loginbackgroundimage', "");

		Session::flash('loginbackgroundimage_updated', "Settings updated successfully");
		return Redirect::to("/czar/frontpage");

	}

	public function get_ad_banners() {
		
		$vars['page_title'] = t('adbanner');

		$banners = Banner::all();
		$vars['banners'] = $banners;
		
		$bannersarray = array();
		$bannersarray[-1] = "none";
		foreach($banners as $banner) {
			$bannersarray[$banner->id] = $banner->name;
		}
		
		$vars['topbar'] = s("banner_top_bar");
		$vars['bottombar'] = s("banner_bottom_bar");
		$vars['leftsidebar'] = s("banner_left_side_bar");

		$vars['bannersarray'] = $bannersarray;
		
		return View::make('czar::ad_banner',$vars);
	}

	public function post_create_banner() {
	
		$vars['name'] = Input::get('name');
		$vars['html_code'] = Input::get("htmlcode");
		
		Banner::create($vars);

		return Redirect::to("czar/ad_banners");
	}

	public function post_assign_banners() {
		
		$topbar = Input::get("topbar");
		set_setting("banner_top_bar", $topbar);	

		$bottombar = Input::get("bottombar");
		set_setting("banner_bottom_bar", $bottombar);		

		$leftsidebar = Input::get("leftsidebar");
		set_setting("banner_left_side_bar", $leftsidebar);			

		return Redirect::to("czar/ad_banners");
	}

	public function post_delete_banner() {

		$id = Input::get("id");
		Banner::find($id)->delete();
		
		$settings = Setting::where("value","=",$id)->get();
		foreach($settings as $setting) {
			$setting->value = -1;
			$setting->save();
		}

		return Redirect::to("czar/ad_banners");
	}

	public function post_update_banner() {
		
		$id = Input::get("id");
		$banner = Banner::find($id);
		
		$banner->html_code = Input::get($id);
		$banner->save();
		
		return Redirect::to("czar/ad_banners");
	}

	public function get_trigger_messages() {

		$vars['page_title'] = "Trigger Messages";

		$vars['show_superpowers'] = s("show_superpowers");
		$vars['show_riseup_msg'] = s("show_riseup_msg");
		$vars['show_fb_invite'] = s("show_fb_invite");
		$vars['show_photo_rater'] = s("show_photo_rater");
		$vars['show_encounters'] = s("show_encounters");

		return View::make('czar::trigger_messages', $vars);
	}

	public function post_trigger_update() {

		set_setting('show_superpowers',Input::get("show_superpowers"));
		set_setting('show_riseup_msg',Input::get("show_riseup_msg"));
		set_setting('show_fb_invite',Input::get("show_fb_invite"));
		set_setting('show_photo_rater',Input::get("show_photo_rater"));
		set_setting('show_encounters',Input::get("show_encounters"));


		Session::flash("triggers_updated","Triggers were updated successfully");

		return Redirect::to("/czar/trigger_messages");	
	}
	
	
}
