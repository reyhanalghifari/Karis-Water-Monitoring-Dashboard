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
$routes->get('/barang/edit/(:num)', 'Barang::edit/$1');
$routes->post('/barang/edit', 'Barang::process_edit');
$routes->get('/barang/delete/(:num)', 'Barang::delete/$1');

$routes->get('/cabang', 'CabangDistribusi::index');
$routes->get('/cabang/add', 'CabangDistribusi::add');
$routes->post('/cabang/add', 'CabangDistribusi::process_add');
$routes->get('/cabang/edit/(:num)', 'CabangDistribusi::edit/$1');
$routes->post('/cabang/edit', 'CabangDistribusi::process_edit');
$routes->get('/cabang/delete/(:num)', 'CabangDistribusi::delete/$1');

$routes->get('/pelanggan', 'Pelanggan::index');
$routes->get('/pelanggan/add', 'Pelanggan::add');
$routes->post('/pelanggan/add', 'Pelanggan::process_add');
$routes->get('/pelanggan/edit/(:num)', 'Pelanggan::edit/$1');
$routes->post('/pelanggan/edit', 'Pelanggan::process_edit');
$routes->get('/pelanggan/delete/(:num)', 'Pelanggan::delete/$1');

$routes->get('/penjualan', 'Penjualan::index');
$routes->get('/penjualan/add', 'Penjualan::add');
$routes->get('/penjualan/add_cabang', 'Penjualan::add_cabang');
$routes->get('/penjualan/laporan', 'Penjualan::laporan');
$routes->post('/penjualan/add', 'Penjualan::process_add');
$routes->get('/penjualan/laporan/print/bulanan/(:num)/(:num)', 'Penjualan::print_laporan_bulanan/$1/$2');
$routes->get('/penjualan/laporan/print/mingguan/(:num)/(:num)', 'Penjualan::print_laporan_mingguan/$1/$2');
$routes->get('/penjualan/laporan/print/tahunan/(:num)', 'Penjualan::print_laporan_tahunan/$1');

$routes->get('/user', 'User::index');
$routes->get('/user/add', 'User::add');
$routes->post('/user/add', 'User::process_add');
$routes->get('/user/edit/(:num)', 'User::edit/$1');
$routes->post('/user/edit', 'User::process_edit');
$routes->get('/user/delete/(:num)', 'User::delete/$1');
$routes->get('/user-profile', 'User::user_profile');
$routes->post('/user-profile', 'User::edit_user_profile');

$routes->get('/user-cabang', 'UserCabang::index');
$routes->get('/user-cabang/add', 'UserCabang::add');
$routes->post('/user-cabang/add', 'UserCabang::process_add');
$routes->get('/user-cabang/delete/(:num)', 'UserCabang::delete/$1');

$routes->get('/master/barang/(:num)', 'DataMaster::getBarang/$1');
$routes->get('/master/penjualan-tahunan/(:num)', 'DataMaster::getPenjualanPerTahun/$1');
$routes->get('/master/penjualan-bulanan/(:num)/(:num)', 'DataMaster::getPenjualanPerBulan/$1/$2');
$routes->get('/master/penjualan-mingguan-tahunan/(:num)/(:num)', 'DataMaster::getPenjualanPerMingguTahunan/$1/$2');
$routes->get('/master/penjualan-mingguan/(:num)/(:num)/(:num)', 'DataMaster::getPenjualanPerMinggu/$1/$2/$3');
$routes->get('/master/penjualan-harian/(:num)/(:num)/(:num)', 'DataMaster::getPenjualanPerHari/$1/$2/$3');
$routes->get('/master/penjualan-tahunan-all/', 'DataMaster::getPenjualanTahunanAllCabang/');
$routes->get('/master/penjualan-bulanan-all/(:num)', 'DataMaster::getPenjualanBulananAllCabang/$1');
$routes->get('/master/penjualan-harian-all/(:num)/(:num)', 'DataMaster::getPenjualanHarianAllCabang/$1/$2');
$routes->get('/master/penjualan-mingguan-all/(:num)/(:num)', 'DataMaster::getPenjualanMingguanAllCabang/$1/$2');
$routes->get('/master/galon-terjual-tahunan-all/', 'DataMaster::getGalonTerjualTahunanAllCabang/');
$routes->get('/master/galon-terjual-bulanan-all/(:num)', 'DataMaster::getGalonTerjualBulananAllCabang/$1');
$routes->get('/master/galon-terjual-harian-all/(:num)/(:num)', 'DataMaster::getGalonTerjualHarianAllCabang/$1/$2');
$routes->get('/master/galon-terjual-mingguan-all/(:num)/(:num)', 'DataMaster::getGalonTerjualMingguanAllCabang/$1/$2');
$routes->get('/master/tahun-penjualan', 'DataMaster::getTahunPenjualan');


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
