<?php


Route::group(array('before' => array('auth')), function()
{

Route::get("/contacts", "chat::chat@contacts");

Route::get("/messages", "chat::chat@messages");

Route::get("/chat_notifications", "chat::chat@chat_notifications");

Route::post("/chat_now", "chat::chat@add_contact");

Route::post("/send_message", "chat::chat@send_message");

Route::post("/clear_chat_notifications", "chat::chat@clear_chat_notifications");

Route::controller('chat::chat');

});