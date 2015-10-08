  	
  	
  	function message_toggle(user_id){
		
		$("#messages_btn").parent().toggleClass("message_open");
		$("#black_screen").toggle();
		$("#messages_box").toggle();
		$('body').toggleClass('stop-scrolling');
		
	
		if($("#messages_btn").parent().hasClass("message_open"))
		{
		window.scrollTo(0, 0);
		Chat.open(user_id);
		
		}
		else{
		Chat.close();
		}
		
	}

  $(function(){

  	$("#distance").slider();
  	
  	$("#black_screen").click(message_toggle);
  	
  	$('.user_interaction').tooltip();
  	
  	$( '#carousel' ).elastislide();
  	
	$("#messages_btn").click(message_toggle);
  
  
  });