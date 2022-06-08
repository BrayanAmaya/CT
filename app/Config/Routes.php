<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');

$routes->group('/',['namespace'=>'App\Controllers\Auth','filter' => 'auth'],function($routes){
    $routes->get('', 'Login::index',['as' => 'index']);
    $routes->get('login', 'Login::index',['as' => 'login']);
    $routes->post('checklogin', 'Login::signin', ['as'=>'signin']);
});

$routes->group('admin',['namespace'=>'App\Controllers\Admin','filter' => 'roles:Admin'],function($routes){
    $routes->get('incidencias', 'Admin::index',['as'=>'incidencia']);
    $routes->get('agregar-incidencia', 'Admin::incidencia',['as'=>'addIncidencia']);
    $routes->post('reportar-incidencia','Admin::reportarIncidencia');
    
    $routes->get('registrar-usuario', 'Admin::register',['as'=>'register']);
    $routes->post('registrar', 'Admin::registrarUsuario');
    $routes->get('registrar-ct', 'Admin::registerCt',['as'=>'registerCt']);
    $routes->post('registrarCt', 'Admin::registrarCentroTecnologia');

    $routes->get('buscar-usuario', 'Admin::buscarUsuario',['as'=>'search']);
    $routes->get('buscar-ct', 'Admin::buscarCt',['as'=>'searchCt']);
    
    $routes->get('agregar-dispositivo', 'Admin::agregarDispositivo',['as'=>'addDispositivo']);
    
    $routes->get('perfil', 'Admin::miPerfil',['as'=>'perfil']);
    $routes->get('actualizar-perfil', 'Admin::actualizarPerfil',['as'=>'updatePerfil']);
    $routes->post('actualizarPerfil', 'Admin::updatePerfil');
    $routes->get('actualizar-usuario', 'Admin::actualizar',['as'=>'update']);
    $routes->post('actualizarUsuario', 'Admin::actualizarUsuario');
    $routes->get('deleteUsuario', 'Admin::darDeBaja',['as'=>'delete']);
    $routes->get('backUsuario', 'Admin::volverUsuario',['as'=>'back']);
    $routes->get('actualizar-ct', 'Admin::actualizarCts',['as'=>'updateCt']);
    $routes->post('actualizarCt', 'Admin::actualizarCt');
    $routes->get('deleteCt', 'Admin::darDeBajaCt',['as'=>'deleteCt']);
    $routes->get('backCt', 'Admin::volverCt',['as'=>'backCt']);
    
    $routes->get('reportes', 'Admin::report',['as'=>'report']);
    $routes->get('cerrar', 'Admin::cerrar',['as'=>'logout']);
});

$routes->group('user',['namespace'=>'App\Controllers\User','filter' => 'roles:Usuario'],function($routes){
    $routes->get('incidencia', 'User::index', ['as'=>'user']);
    $routes->get('agregar-incidencia', 'User::incidencia',['as'=>'addIncidenciaUser']);
    $routes->post('reportar-incidencia','User::reportarIncidencia');

    $routes->get('perfil', 'User::miPerfil',['as'=>'perfilUser']);
    $routes->get('actualizar-perfil', 'User::actualizarPerfil',['as'=>'updatePerfilUser']);
    $routes->post('actualizarPerfil', 'User::updatePerfil');
    $routes->get('cerrar', 'User::cerrarS',['as'=>'logoutU']);
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}