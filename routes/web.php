<?php
Route::get('seeder/test', 'Bronze\SampleController@test');
Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');


