<?php


Route::group(array('before' => array('auth')), function()
{

Route::get("/topup", "credits::credit@top_up");
Route::get("/premium", "credits::credit@premium");
Route::post("/add_spotlight", "credits::credit@add_spotlight");
Route::post("/buy_superpower", "credits::credit@buy_superpower");
Route::post("/buy_riseup", "credits::credit@buy_riseup");

Route::controller('credits::credit');

});