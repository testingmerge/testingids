<?php



Route::group(array('before' => array('auth')), function()
{

Route::get("/rewards", "rewards::reward@packages");
Route::post("/invite_friend", "rewards::reward@invite_friend");

});
