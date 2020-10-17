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
$routes->get('/', 'PageController::index');

// AuthController
$routes->match(['post', 'get'], 'signin', 'AuthController::signin', ['filter' => 'auth_sign_in']);
$routes->match(['post', 'get'], 'signup', 'AuthController::signup', ['filter' => 'auth_sign_in']);
$routes->match(['post', 'get'], 'forget-password', 'AuthController::forgetPassword', ['filter' => 'auth_sign_in']);
$routes->match(['post', 'get'], 'reset-password/(:alphanum)', 'AuthController::resetPassword/$1', ['filter' => 'auth_sign_in']);
$routes->get('signout', 'AuthController::signout');

// AdminController
$routes->get('admin', 'AdminController::index', ['filter' => 'auth_admin']);
$routes->get('admin/my-accounts', 'AdminController::myAccounts', ['filter' => 'auth_admin']);

// SuperAdminController
$routes->get('admin/users', 'SuperAdminController::users', ['filter' => 'auth_super_admin']);
$routes->get('admin/user-read/(:alphanum)', 'SuperAdminController::userRead/$1', ['filter' => 'auth_super_admin']);

$routes->get('admin/accounts', 'SuperAdminController::accounts', ['filter' => 'auth_super_admin']);


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
