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





Route::get('/',array('uses'=>'HomeController@consultora','before'=>'auth'));
Route::get('/login',array('uses'=>'HomeController@login','before'=>'guest'));
Route::get('/logout',array('uses'=>'HomeController@logout','before'=>'auth'));
Route::post('/authenticate',array('uses'=>'HomeController@authenticate','before'=>'guest'));

//Route::get('/pruebaAdminG','UserController@admin_gerente');

Route::get('/perfil', 'perfilController@index');
Route::get('/perfil/changePassword', 'perfilController@passwordEdit');

Route::post('/perfil/storeCurriculum', 'perfilController@storeCurriculum');
Route::get('/perfil/curriculum', 'perfilController@indexCurriculum');
Route::get('/perfil/datosPersonales/modificar', 'userController@edit');
Route::get('/perfil/datosPersonales', 'perfilController@indexDatosPersonales');
Route::post('/perfil/updateDatosPersonales', 'userController@update');

Route::post('/perfil/updatePassword', 'perfilController@passwordUpdate');



Route::get('/empresa', 'HomeController@empresa');
Route::get('/consultora', 'HomeController@consultora');
Route::get('/proyecto', 'HomeController@proyecto');

Route::controller('password', 'RemindersController');