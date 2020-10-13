<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Pages');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Pages::index');
$routes->get('/signout', 'Pages::signout');

$routes->get('portals', 'Portals::index', ['filter' => 'auth_user']);
$routes->get('portals/monthly-slips/(:num)/(:num)', 'Portals::monthlySlips/$1/$2', ['filter' => 'auth_user']);
$routes->get('portals/slip-view/(:num)', 'Portals::slipView/$1', ['filter' => 'auth_user']);

$routes->get('portals/report', 'Portals::report', ['filter' => 'auth_user']);

$routes->get('admins', 'Admins::index', ['filter' => 'auth_admin']);


$routes->match(['post'], 'api/upload-slips', 'Apis::uploadSlips', ['filter' => 'auth_user']);
$routes->match(['post'], 'api/ajax/upload-text-files', 'Apis::ajaxUploadTextFiles', ['filter' => 'auth_user']);

// $routes->match(['get', 'post'], 'register', 'Users::register', ['filter' => 'noauth']);
// $routes->match(['get', 'post'], 'profile', 'Users::profile', ['filter' => 'auth']);
// $routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);




/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
