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
$routes->get(  'api/auth/reset-password/(:segment)', 'AuthController::resetPasswordExists/$1');
$routes->post( 'api/auth/reset-password', 'AuthController::resetPassword');
$routes->post( 'api/auth/traffic-create', 'AuthController::trafficCreate');

$routes->post( 'api/auth/signin-with-facebook', 'AuthController::signinWithFacebook');
$routes->post( 'api/auth/signin-with-google', 'AuthController::signinWithGoogle');


// User Controller
$routes->get(  'api/user/user-type-list', 'UserController::userTypeList', ['filter' => 'authUser']);
$routes->get(  'api/user/user-type-read/(:num)', 'UserController::userTypeRead/$1', ['filter' => 'authUser']);

$routes->get(  'api/user/read', 'UserController::selfRead', ['filter' => 'authUser']);
$routes->post( 'api/user/update', 'UserController::selfUpdate', ['filter' => 'authUser']);
$routes->post( 'api/user/update-detail', 'UserController::selfUpdateDetail', ['filter' => 'authUser']);
$routes->post( 'api/user/update-password', 'UserController::selfUpdatePassword', ['filter' => 'authUser']);

$routes->get(  'api/user/user-list', 'UserController::userList', ['filter' => 'authUser']);
$routes->get(  'api/user/user-read/(:num)', 'UserController::userRead/$1', ['filter' => 'authUser']);

$routes->get(  'api/user/module-permissions', 'UserController::selfModulePermissions', ['filter' => 'authUser']);

$routes->post( 'api/user/signout', 'UserController::signout', ['filter' => 'authUser']);

$routes->post( 'api/user/traffic-create', 'UserController::trafficCreate', ['filter' => 'authUser']);


// Admin Controller
$routes->get(  'api/admin/user-type-list', 'AdminController::userTypeList', ['filter' => 'authUser']);
$routes->get(  'api/admin/user-type-read/(:num)', 'AdminController::userTypeRead/$1', ['filter' => 'authUser']);

$routes->get(  'api/admin/user-list', 'AdminController::userList', ['filter' => 'authUser']);

$routes->post( 'api/admin/user-create', 'AdminController::userCreate', ['filter' => 'authUser']);
$routes->get(  'api/admin/user-read/(:num)', 'AdminController::userRead/$1', ['filter' => 'authUser']);
$routes->post( 'api/admin/user-update', 'AdminController::userUpdate', ['filter' => 'authUser']);
$routes->post( 'api/admin/user-update-detail', 'AdminController::userUpdateDetail', ['filter' => 'authUser']);
$routes->post( 'api/admin/user-update-password', 'AdminController::userUpdatePassword', ['filter' => 'authUser']);
$routes->post( 'api/admin/user-delete', 'AdminController::userDelete', ['filter' => 'authUser']);

$routes->get(  'api/admin/external-app-list', 'AdminController::externalAppList', ['filter' => 'authUser']);
$routes->post( 'api/admin/external-app-create', 'AdminController::externalAppCreate', ['filter' => 'authUser']);
$routes->get(  'api/admin/external-app-read/(:num)', 'AdminController::externalAppRead/$1', ['filter' => 'authUser']);
$routes->post( 'api/admin/external-app-update', 'AdminController::externalAppUpdate', ['filter' => 'authUser']);
$routes->post( 'api/admin/external-app-delete', 'AdminController::externalAppDelete', ['filter' => 'authUser']);

$routes->get(  'api/admin/traffic-report', 'AdminController::trafficReport', ['filter' => 'authUser']);
$routes->get(  'api/admin/action-report', 'AdminController::actionReport', ['filter' => 'authUser']);
$routes->get(  'api/admin/user-registration-report', 'AdminController::userRegistrationReport', ['filter' => 'authUser']);


// Super Admin Controller
$routes->post( 'api/sadmin/user-type-create', 'SuperAdminController::userTypeCreate', ['filter' => 'authUser']);
$routes->post( 'api/sadmin/user-type-update', 'SuperAdminController::userTypeUpdate', ['filter' => 'authUser']);
$routes->post( 'api/sadmin/user-type-delete', 'SuperAdminController::userTypeDelete', ['filter' => 'authUser']);

$routes->get(  'api/sadmin/user-role-list', 'SuperAdminController::userRoleList', ['filter' => 'authUser']);
$routes->post( 'api/sadmin/user-role-create', 'SuperAdminController::userRoleCreate', ['filter' => 'authUser']);
$routes->get(  'api/sadmin/user-role-read/(:num)', 'SuperAdminController::userRoleRead/$1', ['filter' => 'authUser']);
$routes->post( 'api/sadmin/user-role-update', 'SuperAdminController::userRoleUpdate', ['filter' => 'authUser']);
$routes->post( 'api/sadmin/user-role-delete', 'SuperAdminController::userRoleDelete', ['filter' => 'authUser']);

$routes->get(  'api/sadmin/user-custom-column-list', 'SuperAdminController::userCustomColumnList', ['filter' => 'authUser']);
$routes->post( 'api/sadmin/user-custom-column-create', 'SuperAdminController::userCustomColumnCreate', ['filter' => 'authUser']);
$routes->get(  'api/sadmin/user-custom-column-read/(:num)', 'SuperAdminController::userCustomColumnRead/$1', ['filter' => 'authUser']);
$routes->post( 'api/sadmin/user-custom-column-update', 'SuperAdminController::userCustomColumnUpdate', ['filter' => 'authUser']);

$routes->post( 'api/sadmin/module-create', 'SuperAdminController::moduleCreate', ['filter' => 'authUser']);
$routes->get(  'api/sadmin/module-read/(:num)', 'SuperAdminController::moduleRead/$1', ['filter' => 'authUser']);
$routes->post( 'api/sadmin/module-update', 'SuperAdminController::moduleUpdate', ['filter' => 'authUser']);
$routes->post( 'api/sadmin/module-delete', 'SuperAdminController::moduleDelete', ['filter' => 'authUser']);

$routes->get(  'api/sadmin/role-permissions-read/(:num)', 'SuperAdminController::rolePermissionsRead/$1', ['filter' => 'authUser']);
$routes->post( 'api/sadmin/role-permissions-update', 'SuperAdminController::rolePermissionsUpdate', ['filter' => 'authUser']);

$routes->get(  'api/sadmin/user-integration-ids', 'SuperAdminController::userIntegrationIDs', ['filter' => 'authUser']);

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
