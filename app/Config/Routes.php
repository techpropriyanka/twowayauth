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
$routes->setDefaultController('Home');
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

/* ajax insert view delete update*/

$routes->get('/', 'User::index');
$routes->get('/register', 'User::register');
$routes->post('/user/registerath', 'User::registerath');
$routes->post('/user/loginath', 'User::loginath');
$routes->get('/user/qrcodescan', 'User::qrcodegen');
$routes->post('/user/qrcodegenath', 'User::qrcodegenath');
$routes->get('/user/qrcodescanner', 'User::qrcodescanner');
$routes->post('/user/qrcodescannerath', 'User::qrcodescannerath');
    // $routes->get('/user/dashboard', 'User::dashboard');
$routes->group('', ['namespace' => 'App\Controllers', 'filter' => 'userauthGuard'], static function ($routes) {
	
	$routes->get('/user/dashboard', 'User::dashboard');
    $routes->post('/user/profile/update', 'User::updateprofileath');
    $routes->get('/user/user-list', 'User::userlist');
    $routes->post('/user/userlist', 'User::userlistath');
    
    $routes->get('/user/logout', 'User::logout');

});

// Admin Routes End


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
