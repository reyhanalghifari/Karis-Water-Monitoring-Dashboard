<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('MyHome');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'MyHome::index');

$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/registration', 'Auth::registration');
$routes->post('/registration', 'Auth::process_registration');

$routes->get('/barang', 'Barang::index');
$routes->get('/barang/add', 'Barang::add');
$routes->post('/barang/add', 'Barang::process_add');
$routes->get('/barang/edit', 'Barang::edit');
$routes->post('/barang/edit', 'Barang::process_edit');
$routes->delete('/barang/delete', 'Barang::delete');

$routes->get('/cabang', 'CabangDistribusi::index');
$routes->get('/cabang/add', 'CabangDistribusi::add');
$routes->post('/cabang/add', 'CabangDistribusi::process_add');
$routes->get('/cabang/edit', 'CabangDistribusi::edit');
$routes->post('/cabang/edit', 'CabangDistribusi::process_edit');
$routes->delete('/cabang/delete', 'CabangDistribusi::delete');

$routes->get('/pelanggan', 'Pelanggan::index');
$routes->get('/pelanggan/add', 'Pelanggan::add');
$routes->post('/pelanggan/add', 'Pelanggan::process_add');
$routes->get('/pelanggan/edit', 'Pelanggan::edit');
$routes->post('/pelanggan/edit', 'Pelanggan::process_edit');
$routes->delete('/pelanggan/delete', 'Pelanggan::delete');

$routes->get('/penjualan', 'Penjualan::index');
$routes->get('/penjualan/add', 'Penjualan::add');
$routes->post('/penjualan/add', 'Penjualan::process_add');

$routes->get('/user', 'User::index');
$routes->get('/user/add', 'User::add');
$routes->post('/user/add', 'User::process_add');
$routes->get('/user/edit/(:num)', 'User::edit/$1');
$routes->post('/user/edit', 'User::process_edit');
$routes->get('/user/delete/(:num)', 'User::delete/$1');
$routes->get('/user-profile', 'User::user_profile');
$routes->post('/user-profile', 'User::edit_user_profile');


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
