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
$routes->set404Override(function(){
	$data = [
		'appTitle' => getenv('app.title'),
		'appUrl' => getenv('app.baseURL'),
        'bodyClass' => 'app',
	];
	return 404;
});
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */


// Auth Controller
$routes->post( 'api/auth/signin', 'AuthController::signin');
$routes->post( 'api/auth/signup', 'AuthController::signup');
$routes->post( 'api/auth/forget-password', 'AuthController::forgetPassword');
$routes->get(  'api/auth/reset-password/(:alphanum)', 'AuthController::resetPasswordExists/$1');
$routes->post( 'api/auth/reset-password', 'AuthController::resetPassword');
$routes->get(  'api/auth/signout', 'AuthController::signout');


// User Controller
$routes->get(  'api/user/read', 'UserController::userRead', ['filter' => 'authUser']);
$routes->post( 'api/user/update', 'UserController::userUpdate', ['filter' => 'authUser']);
$routes->post( 'api/user/detail/update', 'UserController::userDetailUpdate', ['filter' => 'authUser']);
$routes->post( 'api/user/password/update', 'UserController::userPasswordUpdate', ['filter' => 'authUser']);


// Super Admin Controller
// $routes->get('admin/users', 'SuperAdminController::users', ['filter' => 'auth_super_admin']);
// $routes->match(['post', 'get'], 'admin/user/(:alpha)', 'SuperAdminController::user/$1', ['filter' => 'auth_super_admin']);
// $routes->match(['post', 'get'], 'admin/user/(:alpha)/(:alphanum)', 'SuperAdminController::user/$1/$2', ['filter' => 'auth_super_admin']);


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
