<?php

Route::get('/profile/(:any?)','user::user@profile');

Route::group(array('before' => array('loggedin')), function()
{

Route::post('/signin','user::user@signin');
Route::post('/register','user::user@register');
Route::get('/facebook_login','user::user@facebook_login');
Route::get('/oauth','user::user@oauth');
Route::get('/send_verification','user::user@send_verification');
Route::post('/send_verification','user::user@send_verification');
Route::get('/forgot_password','user::user@forgot_password');
Route::post('/forgot_password','user::user@forgot_password');
Route::get('/verify_user/(:any)','user::user@verify_user');
Route::get('/reset_password/(:any)','user::user@reset_password');
Route::post('/reset_password','user::user@reset_password');
Route::get('/facebook_register','user::user@facebook_register');
Route::post('/facebook_complete','user::user@facebook_complete');

});


Route::group(array('before' => array('auth')), function()
{

Route::any('/dashboard','user::user@dashboard');

Route::get('/logout','user::user@logout');



Route::get('/album/(:any?)','user::user@album');

Route::post('/upload_photo/(:any?)','user::photo@upload_photo');

Route::post('/delete_photo','user::photo@delete_photo');

Route::post('/add_favourite','user::user@add_favourite');

Route::post('/meet_user','user::user@meet_me');

Route::post('/block_user','user::user@block_user');

Route::post('/unblock_user','user::user@unblock_user');

Route::post('/unfavourite_user','user::user@unfavourite_user');

Route::post('/report_abuse','user::user@report_abuse');

Route::get('/profile_visitors','user::user@profile_visitors');

Route::get('/favourites','user::user@favourites');

Route::get('/favme','user::user@favme');

Route::get('/wanttomeet','user::user@wanttomeet');

Route::get('/wantstomeetme','user::user@wantstomeetme');

Route::get('/blocked_users','user::user@blocked_users');

Route::get('/settings', 'user::user@settings');

Route::get('/interests/(:any)', 'user::user@interests');

Route::post('/add_interest', 'user::user@add_interest');

Route::post('/add_new_interest', 'user::user@add_new_interest');

Route::post('/delete_interest', 'user::user@delete_interest');

Route::post('/fb_share', 'user::user@fb_share');



Route::controller('user::user');

Route::controller('user::photo');

});












