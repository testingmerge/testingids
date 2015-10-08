<?php



Route::group(array('before' => array('auth')), function()
{

Route::any("/photorater", "photorater::photorater@index");

Route::get('/photorater/i/(:any?)','photorater::photorater@iphoto');

Route::get('/photos_rated','photorater::photorater@photos_rated');

Route::post('/rate_photo','photorater::photorater@rate_photo');

Route::post('/rate_photo/i','photorater::photorater@rate_iphoto');






});