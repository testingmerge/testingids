	
var Chat = {};


Chat.init = function(){

	Chat.UIChannel = postal.channel();
	Chat.DataChannel = postal.channel();
	Chat.viewModel = new Chat.ViewModel;

	ko.applyBindings(Chat.viewModel, $('#messages_box').get(0));



	

};


Chat.setMessages = function(messages){


	Chat.viewModel.setMessages(messages);


}


Chat.open = function(user_id){

if(user_id && typeof user_id == "number")
{
$("#contact_"+user_id).click();
}
else{
$('#contacts').children().first().click();

}



}


Chat.close = function(){

if(typeof Chat.messageSession != "undefined")
{
clearInterval(Chat.messageSession);
}


}


Chat.ChatModel = function(name, id, contact_id){

	var self = this;
	self.name = name;
	self.id = id;
	self.contact_id = contact_id

	return { name: name, id : id, contact_id: contact_id };
};


Chat.MessageModel = function(id, name, message, time){

	var self = this;
	self.name = name;
	self.id = id;
	self.message = message;
	self.time = time;


};


Chat.ViewModel = function(){

var self = this;

var ChatModel = Chat.ChatModel;
var MessageModel = Chat.MessageModel;

self.contacts = ko.observableArray([]);



	
	
	self.loadContacts = function(){
	
	
	$.ajaxSetup({async:false});
	$.getJSON("{{ url('/contacts') }}", function(data){
	
	self.contacts.removeAll();

		_.each(data, function(ele){
	

		var contact = ele;
		self.contacts.push(contact);
		
		});
	
			
	
	});
	

	
	};
	
	
	self.loadContacts();
	
	
	Chat.UIChannel.subscribe("contacts.reload", function(data){
	
	
	self.loadContacts();
	message_toggle(data.contact_id);
	Chat.send_message();
	
	});



self.loadMessages = function(data, e){

Chat.UIChannel.publish("messages.loading");


$("#convo_user").html($("#contactName_"+data.id).html());

if($(e.target).is('li'))
{
	$(e.target).removeClass('aliceblue');
}
else{
		$(e.target).parents('li').removeClass('aliceblue');
}

$.post("{{ url('/clear_chat_notifications') }}", { user_id : data.id }, function(){

	


});


if(typeof Chat.messageSession != "undefined")
{
clearInterval(Chat.messageSession);
}

Chat.messageSession = setInterval(function(){



	var cid = data.contact_id;
	
	$.getJSON('{{ url("/messages") }}', { contact_id : cid } , function(data){

	if(data.length > 1){
	var last_msg = data[data.length-1];
	
	var last_msg_user_id = parseInt(last_msg['from_user']['id']);
	
	var current_user = parseInt("{{ Auth::user()->id }}");
	

	
	if(last_msg_user_id !== current_user){
	
				
			if(Chat.viewModel.messages().length < data.length){

					
						
				$.playSound('{{ asset("assets/sounds/msg") }}');
				
				}

	
	}

	$("#msg_canvas").emoticonize();
	Chat.DataChannel.publish("messages.loaded", { messages : data });
	
	}

	});
	


}, 5000);


$("#send-message-btn").data('user-id',data.id);
$("#send-message-btn").data('contact-id',data.contact_id);


$.getJSON('{{ url("/messages") }}', { contact_id : data.contact_id } , function(data){


Chat.DataChannel.publish("messages.loaded", { messages : data });

});






}



self.messages = ko.observableArray();


self.setMessages = function(messages){



self.messages.removeAll();

self.messages(messages);


var msg_canvas   = $('#msg_canvas');
  var height = msg_canvas[0].scrollHeight;
  msg_canvas.scrollTop(height);
  

}


Chat.UIChannel.subscribe("message.sent", function(data){





$.getJSON('{{ url("/messages") }}', { contact_id : data.contact_id } , function(data){

$("#sendMessage").val("");
Chat.DataChannel.publish("messages.loaded", { messages : data });

});
	


});

Chat.DataChannel.subscribe("messages.loaded", function(data){

	var messages = [];
	


_.each(data.messages, function(msg){


	var msg_model = {};
	
	msg_model['from_user'] = msg.from_user.name;
	msg_model['from_user_profile_url'] = msg.from_user.profile_url;
	msg_model['from_user_thumbnail_url'] = msg.from_user.thumbnail_url;
	msg_model['sent_at'] = msg.created_at;
	msg_model['message'] = msg.message;
	
	messages.push(msg_model);

});	


	self.setMessages(messages);

$("#msg_canvas").emoticonize();

});



self.sendMessage = function(){


};


};






$(function(){


(function($){

  $.extend({
    playSound: function(){
      return $("<embed src='"+arguments[0]+".mp3' hidden='true' autostart='true' loop='false' class='playSound'>" + "<audio autoplay='autoplay' style='display:none;' controls='controls'><source src='"+arguments[0]+".mp3' /><source src='"+arguments[0]+".ogg' /></audio>").appendTo('body');
    }
  });

})(jQuery);


	$('.chat-now-btn').click(function(){
	
		var contact_id = $(this).data('user-id');
		
	
		
			$.post('{{ url("/chat_now") }}', { contact_id : contact_id }, function(data){
	
					
					data = $.parseJSON(data);
					if(data.success)
					{
						if(data.success == "is_contact"){
						
						
							message_toggle(contact_id);
						
						}
						
						
						if(data.success == "new_contact"){
						
						Chat.UIChannel.publish("contacts.reload", { contact_id : contact_id });
						
						
						}
					}
		
					if(data.error){
		
						alert("There was an error processing this request, please try again later");
			
					}
	
			});
	
	});
	
	
	Chat.send_message = function(){
	
	$("#messages_box .send-message-btn").on('click',function(){
	
			var to_user = $(this).data('user-id');
			var contact_id = $(this).data('contact-id');


			if($("#sendMessage").val()){
			
				$.post("{{ url('/send_message') }}",{ contact_id: contact_id, to_user: to_user,  message:$("#sendMessage").val()},  function(data){
				
					
					data = JSON.parse(data);
					
					if(data.success){
					
							Chat.UIChannel.publish("message.sent",{contact_id: contact_id});
					}
					
					if(data.error){
					
					
					}
				
				});
			
			}
	
	});
	
	
	$("#messages_box .sendMessage").on('keypress', function(e) {
	
	
	var code = e.keyCode || e.which;
 if(code == 13) { //Enter keycode
   				var to_user = $("#send-message-btn").data('user-id');
			var contact_id = $("#send-message-btn").data('contact-id');

			if($("#sendMessage").val()){
			
				$.post("{{ url('/send_message') }}",{ contact_id: contact_id, to_user: to_user,  message:$("#sendMessage").val()},  function(data){
				
					data = JSON.parse(data);
					
					if(data.success){
					
							Chat.UIChannel.publish("message.sent",{contact_id: contact_id});
					}
					
					if(data.error){
					
					
					}
				
				});
			
			}
   				
 }
	
	
	});
	
	}
	
	
	Chat.send_message();
	
	setInterval(function(){
	
		var current_notification = parseInt($("#msg_notification_no").html());
		
		if(isNaN(current_notification))
		{
		current_notification = 0;
		
		}
		
		$.get("{{ url('/chat_notifications') }}", function(data){
		
			var new_notification = data;
			
			if(new_notification != 0){
			if(new_notification > current_notification){
			
				$("#msg_notification_no").addClass('blink_me');
				$.playSound('{{ asset("assets/sounds/msg") }}');
				$("#msg_notification_no").html(new_notification);
			}
			else if(new_notification == current_notification )
			{
				$("#msg_notification_no").addClass('blink_me');
				$("#msg_notification_no").html(new_notification);
			}
			else if(new_notification < current_notification){
			
			$("#msg_notification_no").html("");
			$("#msg_notification_no").removeClass('blink_me');
			
			}
			
			}
			else{
			
				$("#msg_notification_no").html("");
			$("#msg_notification_no").removeClass('blink_me');
			
			}
			
		
		});
	
	
	
	}, 10000);
	
	Chat.init();
	
	});
	
