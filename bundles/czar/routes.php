<?php


Route::filter('only_czar', function()
{
	
	if (!CzarAuth::czar()) return Redirect::to('/czar/login');
});

Route::filter('czar_loggedIn', function()
{
	if (CzarAuth::czar()) return Redirect::to('/czar');
}); 


Route::group(array('before' => array('czar_loggedIn')), function()
{

	Route::get('/czar/login',"czar::czar@login");
	Route::post('/czar/login',"czar::czar@login");

}); 


Route::group(array('before' => array('only_czar')), function()
{  

Route::get('/czar/edit_language/(:any)', 'czar::czar@edit_language');
Route::controller('czar::czar');


});




