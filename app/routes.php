<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function() {   
    return View::make('index'); // will return app/views/index.php 
});

// API ROUTES ==================================  
Route::group(array('prefix' => 'api'), function() {

    // Angular will handle both of create and edit forms
    // this ensures that a user can't access api/create when there's nothing there
    Route::resource('comments', 'CommentController', 
        array('except' => array('create')));
  
});

// CATCH ALL ROUTE =============================  
// all routes that are not home or api will be redirected to the frontend 
// this allows angular to route them 
App::missing(function($exception) { 
    return View::make('index'); 
});
