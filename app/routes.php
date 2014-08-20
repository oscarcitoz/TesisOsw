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



Route::get('/empresa', 'CustomerController@index');
Route::get('/empresa/modificar', 'CustomerController@edit');
Route::post('/empresa/update', 'CustomerController@update');
Route::post('/empresa/create', 'UserController@store');

Route::post('/empresa/show', 'UserController@show');
Route::get('/empresa/buscar/nombre', 'UserController@buscarNombre');
Route::get('/empresa/buscar/cedula', 'UserController@buscarCedula');
Route::get('/empresa/buscar/profesion', 'UserController@buscarProfesion');
Route::get('/empresa/verUsuario/{id}','UserController@verUsuario');
Route::post('empresa/actualizaStatus','UserController@actualizaStatus');
Route::get('/empresa/registrar', 'CustomerController@indexRegistrar');



//Mi Consultora
Route::get('/',array('uses'=>'ProjectController@consultora','before'=>'auth'));
Route::get('/consultora',array('uses'=>'ProjectController@consultora','before'=>'auth'));
Route::get('/consultora/more_project',array('uses'=>'ProjectController@consultora_project','before'=>'auth'));
Route::get('/consultora/more_activity',array('uses'=>'ActivityController@consultora_activity','before'=>'auth'));

//proyecto
Route::get('/proyecto', 'ProjectController@proyecto');
Route::get('/proyecto/buscar/proyecto', 'ProjectController@buscarProyect');
Route::get('/proyecto/buscar/local', 'ProjectController@buscarLocal');
Route::post('/proyecto/buscar/tipo', 'ProjectController@buscarTipo');
Route::post('/proyecto/buscar/status', 'ProjectController@buscarStatus');
Route::post('/proyecto/create', 'ProjectController@create');
Route::get('/project/registrar', 'ProjectController@proyectoReg');

//customer
Route::get('/customer/buscar/customer', 'CustomerController@buscarCustomer');
Route::get('/customer/crear', 'CustomerController@CrearCustomer');
Route::post('/customer/registrar', 'CustomerController@RegistrarCustomer');
Route::get('/customer/edtiCustomer/{id}','CustomerController@editCustomer');
Route::post('/customer/update','CustomerController@updateCustomer');

//Proyectos Individuales
Route::get('/project/individual/{id}','ProjectController@proyectoIndividual');


Route::controller('password', 'RemindersController');