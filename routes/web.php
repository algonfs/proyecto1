<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('/welcome');
});


Route::group(['middleware'=>['guest']],function(){
    Route::get('/welcome','Auth\LoginController@showLoginForm');
    Route::post('/welcome', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware'=>['auth']],function(){

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware'=>['Administrador']],function(){
        
        Route::get('/marca', 'MarcaController@index');
        Route::post('/marca/registrar', 'MarcaController@store');
        Route::put('/marca/actualizar', 'MarcaController@update');
        Route::put('/marca/activar', 'MarcaController@activar');
        Route::put('/marca/desactivar', 'MarcaController@desactivar');
        Route::get('/marca/selectMarca', 'MarcaController@selectMarca');


        Route::get('/bus', 'BusController@index');
        Route::post('/bus/registrar', 'BusController@store');
        Route::put('/bus/actualizar', 'BusController@update');
        Route::put('/bus/activar', 'BusController@activar');
        Route::put('/bus/desactivar', 'BusController@desactivar');
        Route::get('/bus/listarPdf', 'BusController@listarPdf')->name('buses_pdf');
        Route::get('/bus/selectBus', 'BusController@selectBus');


        Route::get('/ruta', 'RutaController@index');
        Route::post('/ruta/registrar', 'RutaController@store');
        Route::put('/ruta/actualizar', 'RutaController@update');
        Route::put('/ruta/desactivar', 'RutaController@desactivar');
        Route::put('/ruta/activar', 'RutaController@activar');
        Route::get('/ruta/selectRuta', 'RutaController@selectRuta');
        Route::get('/ruta/listarRutaVenta', 'RutaController@listarRutaVenta');
        Route::get('/ruta/buscarRutaVenta', 'RutaController@buscarRutaVenta');

        Route::get('/conductor', 'ConductorController@index');
        Route::post('/conductor/registrar', 'ConductorController@store');
        Route::put('/conductor/actualizar', 'ConductorController@update');
        Route::put('/conductor/desactivar', 'ConductorController@desactivar');
        Route::put('/conductor/activar', 'ConductorController@activar');
        Route::get('/conductor/listarPdf', 'ConductorController@listarPdf')->name('conductores_pdf');
        Route::get('/conductor/selectConductor', 'ConductorController@selectConductor');


        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');


        Route::get('/rol','RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');  

        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');


        Route::get('/viaje', 'ViajeController@index');
        Route::post('/viaje/registrar', 'ViajeController@store');
        Route::put('/viaje/actualizar', 'ViajeController@update');
        Route::put('/viaje/desactivar', 'ViajeController@desactivar');
        Route::put('/viaje/activar', 'ViajeController@activar');  
        Route::get('/viaje/listarPdf', 'ViajeController@listarPdf')->name('viajes_pdf');

     
        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'VentaController@store');
        Route::put('/venta/desactivar', 'VentaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');

        Route::get('/venta/pdf/{id}', 'VentaController@pdf')->name('venta_pdf');
    });
     
});

Route::group(['middleware' => ['Vendedor']], function () {
    Route::get('/cliente', 'ClienteController@index');
    Route::post('/cliente/registrar', 'ClienteController@store');
    Route::put('/cliente/actualizar', 'ClienteController@update');
    Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');

    // Route::get('/articulo/buscarArticuloVenta', 'ArticuloController@buscarArticuloVenta');
    // Route::get('/articulo/listarArticuloVenta', 'ArticuloController@listarArticuloVenta');

    // Route::get('/venta', 'VentaController@index');
    // Route::post('/venta/registrar', 'VentaController@store');
    // Route::put('/venta/desactivar', 'VentaController@desactivar');
    // Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
    // Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');
       
    Route::get('/venta', 'VentaController@index');
    Route::post('/venta/registrar', 'VentaController@store');
    Route::put('/venta/desactivar', 'VentaController@desactivar');
    Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
    Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');

    Route::get('/venta/pdf/{id}', 'VentaController@pdf')->name('venta_pdf');
});