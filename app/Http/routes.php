<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', function () {
    return redirect()->route('tasks.index');
}]);

Route::resource('tasks', 'TaskController', ['except' => 'destroy']);
// Since "resource" does not support optional parameters:
Route::delete('tasks/{tasks?}', ['as' => 'tasks.destroy', 'uses' => 'TaskController@destroy']);

Route::post('tasks/toggle',     ['as' => 'tasks.toggle',  'uses' => 'TaskController@toggle']);

// Endpoint to get the defined tasks
Route::group(['prefix' => 'api/v1'], function () {
    Route::get('tasks', ['uses' => 'ApiController@tasks']);
});

// Define the small navigation bar
Menu::make('navlinks', function ($t) {
    $t->add('Tasks');
    $t->tasks->add('Scheduled Tasks', ['route' => 'tasks.index']);
    $t->tasks->add('New Task',        ['route' => 'tasks.create']);
});