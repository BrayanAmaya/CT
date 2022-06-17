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
    $routes->get('incidencias', 'Vistas::index',['as'=>'incidencia']);
    $routes->get('agregar-incidencia', 'Vistas::incidencia',['as'=>'addIncidencia']);
    $routes->post('reportar-incidencia','Registro::reportarIncidencia');
    $routes->get('resolver-incidencia', 'Vistas::resolverIncidencia',['as'=>'viewIncidencia']);
    $routes->post('resuelveIncidencia','UpdateDelete::resuelveIncidencia');
    //$routes->get('filtro-incidencia', 'Vistas::filtrarIncidencia',['as'=>'filtrarIncidencia']);
    $routes->post('filtroIncidencia','Registro::filtrarIncidencias');
    $routes->post('filtro-incidencia', 'Vistas::filtrarIncidencia');
    
    $routes->get('registrar-usuario', 'Vistas::register',['as'=>'register']);
    $routes->post('registrar', 'Registro::registrarUsuario');
    $routes->get('registrar-ct', 'Vistas::registerCt',['as'=>'registerCt']);
    $routes->post('registrarCt', 'Registro::registrarCentroTecnologia');

    $routes->get('buscar-usuario', 'Vistas::buscarUsuario',['as'=>'search']);
    $routes->get('buscar-ct', 'Vistas::buscarCt',['as'=>'searchCt']);
    $routes->get('buscar-dispositivo', 'Vistas::buscarDispositivo',['as'=>'searchDispositivo']);

    $routes->post('generar-reporte', 'Registro::generarReport',['as'=>'generarReport']);
    
    $routes->get('agregar-tipo-dispositivo', 'Vistas::agregarTipoDispositivo',['as'=>'addTipoDispositivo']);
    $routes->get('agregar-tipo-incidencia', 'Vistas::agregarTipoIncidencia',['as'=>'addTipoIncidencia']);
    $routes->get('agregar-dispositivo', 'Vistas::agregarDispositivo',['as'=>'addDispositivo']);
    $routes->post('addDispositivos', 'Registro::agregarDispositivo');
    $routes->post('addTipoDispositivos', 'Registro::agregarTipoDispositivo');
    $routes->post('addTipoIncidencias', 'Registro::agregarTipoIncidencia');
    
    $routes->get('perfil', 'Vistas::miPerfil',['as'=>'perfil']);
    $routes->get('actualizar-perfil', 'Vistas::actualizarPerfil',['as'=>'updatePerfil']);
    $routes->post('actualizarPerfil', 'UpdateDelete::updatePerfil');
    $routes->get('actualizar-usuario', 'Vistas::actualizar',['as'=>'update']);
    $routes->post('actualizarUsuario', 'UpdateDelete::actualizarUsuario');
    $routes->get('deleteUsuario', 'UpdateDelete::darDeBaja',['as'=>'delete']);
    $routes->get('backUsuario', 'UpdateDelete::volverUsuario',['as'=>'back']);
    $routes->get('actualizar-ct', 'Vistas::actualizarCts',['as'=>'updateCt']);
    $routes->post('actualizarCt', 'UpdateDelete::actualizarCt');
    $routes->get('deleteCt', 'UpdateDelete::darDeBajaCt',['as'=>'deleteCt']);
    $routes->get('backCt', 'UpdateDelete::volverCt',['as'=>'backCt']);

    $routes->get('actualizar-dispositivo', 'Vistas::actualizarDispositivo',['as'=>'updateDispositivo']);
    $routes->post('actualizarDispositivo', 'UpdateDelete::actualizarDispositivo');
    $routes->get('deleteDispositivo', 'UpdateDelete::darDeBajaDispositivo',['as'=>'deleteDispositivo']);
    $routes->get('backDispositivo', 'UpdateDelete::volverDispositivo',['as'=>'backDispositivo']);
    
    $routes->get('reportes', 'Vistas::report',['as'=>'report']);
    $routes->get('cerrar', 'Registro::cerrar',['as'=>'logout']);
});

$routes->group('user',['namespace'=>'App\Controllers\User','filter' => 'roles:Usuario'],function($routes){
    $routes->get('incidencia', 'Vistas::index', ['as'=>'user']);
    $routes->get('agregar-incidencia', 'Vistas::incidencia',['as'=>'addIncidenciaUser']);
    $routes->post('reportar-incidencia','Registro::reportarIncidencia');

    $routes->get('perfil', 'Vistas::miPerfil',['as'=>'perfilUser']);
    $routes->get('actualizar-perfil', 'Vistas::actualizarPerfil',['as'=>'updatePerfilUser']);
    $routes->post('actualizarPerfil', 'Registro::updatePerfil');
    $routes->get('cerrar', 'Vistas::cerrar',['as'=>'logoutU']);
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