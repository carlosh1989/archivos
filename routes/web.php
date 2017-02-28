<?php

use App\Notifications\SuspiciousLogin;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middlewareGroups' => 'web'], function () {
    Route::get('/pusher', function () {
        event(new App\Events\HelloPusherEvent('Hi there Pusher!'));

        return 'Event has been sent!';
    });
    Route::get('routes', function () {
        $routeCollection = Route::getRoutes();

        return view('routes', compact('routeCollection'));
    });
    Route::get('/logout', 'HomeController@logout');
    Route::resource('photos', 'PhotoController');
/*    Route::get('suscribe', function (Faker\Generator $faker) {
        $user = new User();
        $user->name = $faker->name;
        $user->email = $faker->email;
        $user->password = bcrypt($faker->password);
        $user->notify(new SuspiciousLogin());

        return view('notified', ['user' => $user]);
    });*/

    Route::get('/enviar', ['as' => 'enviar', function () {

        $data = ['link' => 'http://styde.net'];

        \Mail::send('emails.notificacion', $data, function ($message) {

            $message->from('email@styde.net', 'Styde.Net');

            $message->to('carlodasilva89@gmail.com')->subject('Notificación');
        });

        return 'Se envío el email';
    }]);
    Route::auth();
    Route::get('/salir', 'HomeController@salir');
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::get('/search', 'HomeController@searchParts');
    Route::get('/busqueda', 'HomeController@busqueda');
    Route::get('/busqueda/{cadena}', 'HomeController@busqueda');
    Route::post('/busquedaProcesar', 'HomeController@busquedaProcesar');
    Route::get('/gps', 'HomeController@gps');
    Route::get('/gpsParts', 'HomeController@gpsParts');
    Route::get('/test', 'HomeController@test');
    Route::get('/subirImagen', 'HomeController@subirImagen');

    Route::get('/admin/parts', 'AdminController@index');
    Route::get('/admin/parts/category/{id}', 'AdminController@partsCategory');

      Route::get('/local', 'LocalController@index');

    Route::get('/turno', 'HomeController@turno');
    Route::get('/turno/{cedula}', 'HomeController@turnoIngresar');

    Route::group(['middleware' => ['auth']], function () {
        // All routes you put here can be accessible to all authenticated users
        Route::get('/profile', 'HomeController@profile');
        Route::get('/profile/create', 'HomeController@profileCreate');
        Route::post('/profile', 'HomeController@profileStore');
        Route::put('/profile/edit', 'HomeController@profileUpdate');
       // Route::put('/profile', 'HomeController@profileUpdate');
    });

    Route::group(['middleware' => ['auth', 'role:concejal']], function () {
        // All routes you put here can be accessible to all authenticated users
        Route::get('concejal', 'Concejal\PrincipalController@index');
        Route::resource('concejal/archivos', 'Concejal\ArchivosController');
        Route::resource('concejal/chat', 'Concejal\ChatController');
        Route::get('concejal/archivo/publicar', 'Concejal\ArchivosController@publicar');
        Route::get('concejal/archivo/ver', 'Concejal\ArchivosController@ver');
        Route::get('concejal/archivo/pusher', 'Concejal\ArchivosController@pusher');
    });

    Route::group(['middleware' => ['auth', 'role:local']], function () {
        // All routes you put here can be accessible to all authenticated users
        Route::get('/local', 'LocalController@index');
    });

    Route::group(['middleware' => ['auth', 'role:admin']], function () {
        // Rutas de REPUESTOS
        Route::resource('admin/chat', 'Admin\ChatController');
        Route::resource('admin/cuentas', 'Admin\CuentasController');
        Route::get('/admin', 'AdminController@home');
        Route::get('/admin/home', 'AdminController@home');
        Route::get('/admin/mensaje', 'AdminController@mensaje');
        Route::get('/admin/archivos/ingresar', 'AdminController@archivoIngresar');
        Route::post('/admin/archivos', 'AdminController@archivoGuardar');
        Route::get('/admin/archivos/{id}/show', 'AdminController@archivosVer');
        Route::get('/admin/archivos/', 'AdminController@archivosTodos');
        Route::get('/admin/reporte/{idArchivo}', 'AdminController@reporte');
        Route::post('/admin/busquedaProcesarPublicar', 'AdminController@busquedaProcesarPublicar');
        Route::get('/admin/publicar/{idArchivo}/{cadena?}', 'AdminController@publicar');
        Route::delete('/admin/eliminarArchivo/{idArchivo}', 'AdminController@eliminarArchivo');
        Route::post('admin/publicar', 'AdminController@publicarProceso');

        //Recarline
        Route::get('/admin/archivos', 'AdminController@busqueda');
        Route::get('/admin/archivos/{cadena}', 'AdminController@busqueda');
        Route::post('/admin/busquedaProcesar', 'AdminController@busquedaProcesar');

        Route::get('/admin/usuario', 'AdminController@usuario');
       

        //Publicaciones
        Route::get('/admin/publicaciones', 'AdminController@publicaciones');
        Route::get('/admin/publicaciones/{id?}', 'AdminController@publicacionesVistas');
        Route::get('/admin/notificar', 'AdminController@notificar');
        Route::get('/admin/url', 'AdminController@url');
        Route::get('/admin/pusher', 'AdminController@pusher');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index');
