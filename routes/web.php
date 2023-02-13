<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Desde la terminal podemos verificar las rutas que tenemos: php artisan route:list
//***************************/
// Rutas de la la aplicacion //
//***************************/
Route::view('/','welcome')->name('home');
Route::view('/contact','contact')->name('contact');

// convencion que utilizaremos en los controladores
// el metodo 'index' utilizaremos para mostras un listado recursos
// en este caso son los recurso del modelo POST
    // Route::get('/blog',[PostController::class,'index'])->name('posts.index');
//el metodo 'show' utilizaremos para mostras el detalle de un recurso
// en este caso el POST individual
//Parametros de ruta
// El orde de declaracion de rutas es importante ,
// ya que se ejecuta la ruta con parametro especifica primero '/blog/create'
// y despues las que reciven parametros variables '/blog/{post}'
//Por convencion utilizamos create para mostrar el formulario de creacion
    // Route::get('/blog/create',[PostController::class,'create'])->name('posts.create');
//Por convencion utilizamos store para almacenar  el formulario
    // Route::post('/blog',[PostController::class,'store'])->name('posts/store');

    // Route::get('/blog/{post}',[PostController::class,'show'])->name('posts.show');
    // Route::get('/blog/{post}/edit',[PostController::class,'edit'])->name('posts.edit');

// put() para reemplazar un registro  y patch() para actualizar
// error al querer usar patch():The POST method is not supported for route blog/1. Supported methods: GET, HEAD, PATCH.
// esta rutta '/blog/{post}' soporta solamente el metos get(), como se hace para usar PATCH
// ya que del lado del fornulario no podemos usar PATCH ya que los navegadores actualemte no lo soportan
// para ello laravel tieme un sistema que permite emular este tipo de peticiones: diretiva @method()
    // Route::patch('/blog/{post}',[PostController::class,'update'])->name('posts.update');
    // Route::delete('/blog/{post}',[PostController::class,'destroy'])->name('posts.destroy');

//**************************************/
//Generar las rutas de forma automatica//
//*************************************/
//para ver el listado de rutas de la aplicacion, con el parametro--path= y una palabra que contenga en la ruta
// php artisan route:list --path=blog
// Como esto es un patron comun Laravel tiene un metodo especial que permite generar todas estas rutas
//resourcer( ,)
// podemos pasar como 3er parametro un array de configuracion

Route::resource('blog',PostController::class,[

    'names' =>'posts',
    'parameters'=>['blog'=>'post']

]);


//Proteger rutas//
/*los middleware son mecanismos nos permiten filtrar e inspeccionar
las peticiones entrantes de nuestra aplicacion
en esta caso agregamos el middleware 'auth'
Route::view('/about','about')->name('about')->middleware('auth');
*/


Route::view('/about','about')->name('about');

// route::get('login',function() {
//     return 'Login page';

// } )->name('login');

Route::view('/login','auth.login')->name('login');
Route::post('/login',[AuthenticatedSessionController::class,'store']);
Route::post('/logout',[AuthenticatedSessionController::class,'destroy'])->name('logout');

// Para crear el controlador RegisteredUserController
// ejecutar en ternimal:php artisan make:controller Auth/RegisteredUserController
Route::view('/register','auth.register')->name('register');
Route::post('/register',[RegisteredUserController::class,'store'] );

