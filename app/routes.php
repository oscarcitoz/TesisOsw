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

Route::get('/', function()
{
	return View::make('hello');
});






Route::get('/login',array('uses'=>'HomeController@login','before'=>'guest'));
Route::get('/logout',array('uses'=>'HomeController@logout','before'=>'auth'));
Route::post('/authenticate',array('uses'=>'HomeController@authenticate','before'=>'guest'));

//Route::get('/pruebaAdminG','UserController@admin_gerente');

Route::get('/perfil', 'perfilController@index');
Route::get('/perfil/changePassword', 'perfilController@passwordEdit');
Route::post('/perfil/exportar', 'perfilController@exportar');


Route::post('/perfil/updatePassword', 'perfilController@passwordUpdate');

//Mi Consultora
Route::get('/',array('uses'=>'ProjectController@consultora','before'=>'auth'));
Route::get('/consultora',array('uses'=>'ProjectController@consultora','before'=>'auth'));
Route::get('/consultora/more_project',array('uses'=>'ProjectController@consultora_project','before'=>'auth'));
Route::get('/consultora/more_activity',array('uses'=>'ActivityController@consultora_activity','before'=>'auth'));



Route::get('/empresa', 'HomeController@empresa');


Route::get('/proyecto', 'HomeController@proyecto');

Route::controller('password', 'RemindersController');