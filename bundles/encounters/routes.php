<?php

Route::group(array('before' => array('auth')), function()
{

Route::any("/encounters", "encounters::encounter@index");

Route::any("/matches", "encounters::encounter@matches");

Route::post("/encounters/encounter_yes", "encounters::encounter@encounter_yes");

Route::post("/encounters/encounter_no", "encounters::encounter@encounter_no");

Route::controller('encounters::encounter');

});