<?php



Route::group(array('before' => array('auth')), function()
{

Route::post('/send_gift', 'gifts::gift@send_gift');
Route::post('/remove_gift', 'gifts::gift@remove_gift');



});