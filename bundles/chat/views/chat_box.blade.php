<ul id="messages_box" class="dropdown-menu dropdown-menu-large row message-bg" style="margin-top:-10px;z-index:9999px;margin-left: 15px;display:none;border-bottom-left-radius: 5px;
		border-bottom-right-radius:5px;
		border-top-left-radius: 5px;
		border-top-right-radius:5px;">
							
	
				
				<!-- ko if: contacts().length > 0 -->
		        <ul  id="contacts" class="conversation-wrap col-md-3" data-bind="foreach: contacts" style="background-color: #FFF; margin:10px;margin-top:0px;border-radius:5px;list-style-type:none;" >
					
						
					
						
		            <li class="media conversation row" data-bind="click: $parent.loadMessages, css: { 'aliceblue' : unread > 0 }, attr:{ id: 'contact_'+id }">

		            	<div class="col-md-4">
		                <a class="pull-left" href="#">
		                    <img class="media-object"  alt="64x64" style="width: 32px; height: 32px;"  data-bind="attr: { src : thumbnail_url }" >
		                </a>
		               </div>
		               <div class="col-md-5">
		                <div class="media-body">
		
		                    <h5 class="media-heading" style="font-size: 0.7em;" data-bind="text: name, attr:{ id: 'contactName_'+id }"></h5>
		
		                </div>
		               </div>
		               <div class="col-md-2">
		               		                	<div data-bind="css: { 'status-online' : is_online , 'status-offline' : !is_online}"></div>
		               </div>
		            </li>
		            
		            	</ul>
		            <!-- /ko -->

		   
		            
		           

		           
		           
		        	
		
			<span id="messages">
		<!-- ko if: contacts().length > 0 -->
		
		        <div class="message-wrap col-md-8 border-div" style="padding:30px;background: #f2f2f2;">
		        	<div style="text-align:center;margin:0px;padding:0px;"><small>{{ t('yourconversationwith') }} <span id="convo_user"></span></small></div>
		        	<div class="row border-div">
		        	
		            <div id="msg_canvas"  class="msg-wrap col-md-12" style="height:274px;overflow:hidden;" data-bind="foreach: messages">
		
		
		                <div class="media msg">
		                    <a class="pull-left" href="#">
		                        <img class="media-object"  alt="64x64" style="width: 32px; height: 32px;" data-bind="attr: { src : from_user_thumbnail_url }">
		                    </a>
		                    <div class="media-body">
		                        <small class="pull-right time"><i class="fa fa-clock-o"></i> <span data-bind="text: sent_at"></span></small>
		                        <h5 class="media-heading" data-bind="text: from_user"></h5>
		                        <small class="col-lg-10" data-bind="text: message"></small>
		                    </div>
		                </div>
  
		           
		            </div>
		           
		            
		            <div class="col-md-12">
		            		 <div class="send-wrap ">
		
		                <input type="text" id="sendMessage" class="sendMessage form-control send-message input-lg"  placeholder="{{ t('writeareply') }}" />
		
		                   <div class="btn-panel">
		                <a href="javascript:;" id="send-message-btn" class="send-message-btn col-lg-4 text-right btn send-message-btn pull-right" role="button" ><i class="fa fa-plus"></i> {{ t('sendmessage') }}</a>
		            </div>
		
		            </div>
		        </div>
		        
		         
		          
		            </div>
		            
		            </div>
		<!-- /ko -->
		</span>
		
		
		<!-- ko if: contacts().length == 0 -->
		
		<div class="border-div" style="margin: 10px;text-align:center">
			<h2 style="font-size: 0.9em;">{{ t('nocontacts') }}</h2>
		</div>
		
		<!-- /ko -->
		
		
		
						</ul>