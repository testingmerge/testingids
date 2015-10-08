<?php

class Chat_Chat_Controller extends Base_Controller {

	public $restful = true;
	
	
	
	public function post_add_contact(){
	
		$contact_id = Input::get('contact_id');
		
		if(Auth::user()->isContact($contact_id)){
		
			
			die(json_encode(array('success'=>'is_contact')));
		
		
		}
		else if(Auth::user()->isInContact($contact_id))
		{
		
				die(json_encode(array('success'=>'is_contact')));
		
		}
		else{
		
			$contact  = new Contact;
			$contact->user_id = Auth::user()->id;
			$contact->contact = $contact_id;
			$contact->save();
			
			Event::fire('user.contact.added', array(Auth::user(), User::find($contact_id)) );
			die(json_encode(array('success'=>'new_contact')));
		
		}
	
	
	
	
	}
	
	
	public function get_contacts(){
	

		$contacts = Auth::user()->contacts();
		$users = array();
		
		foreach($contacts as $contact){
			
			if(Auth::user()->id == $contact->user_id)
			{
			$user = User::find($contact->contact);
			$user->contact_id = $contact->id;
			}
			else{
			$user = User::find($contact->user_id);
			$user->contact_id = $contact->id;
			
			}
			
			if($user)
			{

				if($user->role != 4 && $user->role != 1)
				{ 
			$user_obj = new stdClass;
			$user_obj->name = $user->name;
			$user_obj->id = $user->id;
			$user_obj->profile_url = $user->profile_url();
			$user_obj->thumbnail_url = $user->thumbnailPhoto();
			$user_obj->contact_id = $user->contact_id;
			$user_obj->is_online = $user->isOnline();
			$user_obj->unread = Auth::user()->unreadChatsWithUser($user->id);
			
			array_push($users, $user_obj);
				}
			}
		
		}
	
	
		return die(json_encode($users));
	
	}	
	
	
		
	public function post_send_message(){
	
		$chat = new Chat;
		$chat->to_user = Input::get('to_user');
		$chat->from_user = Auth::user()->id;
		$chat->message = Input::get('message');
		$chat->notify_status = 0;
		$chat->contact_id = Input::get('contact_id');
		$chat->save();
		
		if($chat){

		Event::fire('user.message.sent', array(User::find($chat->from_user) , User::find($chat->to_user), $chat->message));

		die(json_encode(array("success"=>"1")));
		
		}
		else{
		
		die(json_encode(array("error"=>"1")));
		
		}

	
	}
	
	
	public function get_messages(){
	
		$contact_id = Input::get("contact_id");
		
		$chats = Chat::where('contact_id',"=","$contact_id")->order_by('created_at')->get();
		
		foreach($chats as $chat)
		{
			
			if(Auth::user()->id == $chat->to_user)
			{
			$chat->notify_status = 1;
			$chat->save();
			} 
		
			$to_user = User::find($chat->to_user);
			$from_user = User::find($chat->from_user);
			
			$to_user_obj = new stdClass;
			$to_user_obj->name = $to_user->name;
			$to_user_obj->id = $to_user->id;
			$to_user_obj->profile_url = $to_user->profile_url();
			$to_user_obj->thumbnail_url = $to_user->thumbnailPhoto();
			$chat->to_user = $to_user_obj;
			
			$from_user_obj = new stdClass;
			$from_user_obj->name = $from_user->name;
			$from_user_obj->id = $from_user->id;
			$from_user_obj->profile_url = $from_user->profile_url();
			$from_user_obj->thumbnail_url = $from_user->thumbnailPhoto();
			$chat->from_user = $from_user_obj;
			
			
			
		
		
		}
		
		
		
		
		return Response::eloquent($chats);
		
		
	
	
	
	}
	
	
	
	public function post_clear_chat_notifications(){
	
		Auth::user()->clear_chat_notifications(Input::get('user_id'));
	
	
	}
	
	
	
	public function get_chat_notifications(){
	
		die(Auth::user()->unread_chats());
	
	
	}
	
	
	
	
	
	
	
	
}