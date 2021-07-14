<?php

namespace Config;

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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//normal route
$routes->match(['get', 'post'], 'register', 'Auth::register', ['filter' => 'noauth']);
$routes->match(['get', 'post'], 'login', 'Auth::login', ['filter' => 'noauth']);
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('/logout', 'Auth::logout', ['filter' => 'auth']);




//office route
$routes->get('office', 'Office::index', ['filter' => 'auth']);
$routes->get('moderator', 'Auth::moderator', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'organization-profile', 'GeneralSettingController::organization_profile', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'departments', 'GeneralSettingController::departments', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'positions', 'GeneralSettingController::positions', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'notice-board', 'MessagingSettingController::notice_board', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'new-employee', 'EmployeeSettingController::new_employee', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'fetch-positions', 'EmployeeSettingController::fetch_positions', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'employees', 'EmployeeSettingController::all_employees', ['filter' => 'auth']);
$routes->match(['post'], 'check-username', 'EmployeeSettingController::check_username', ['filter' => 'auth']);

// notices route
$routes->get('notices', 'NoticeController::index', ['filter' => 'auth']);
$routes->get('my-notices', 'NoticeController::user_notices', ['filter' => 'auth']);
$routes->get('view-notice/(:num)', 'NoticeController::view_notice/$1', ['filter' => 'auth']);
$routes->get('edit-notice/(:num)', 'NoticeController::edit_notice/$1', ['filter' => 'auth']);
$routes->post('edit-notice', 'NoticeController::edit_notice', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'new-notice', 'NoticeController::new_notice', ['filter' => 'auth']);

$routes->match(['get'], 'memos', 'PostController::memos', ['filter' => 'auth']);
$routes->match(['get'], 'memos/(:alpha)', 'PostController::memos/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'new-memo', 'PostController::new_memo', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'internal-memo', 'PostController::internal_memo', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'external-memo', 'PostController::external_memo', ['filter' => 'auth']);
$routes->match(['get'], 'my-memos', 'PostController::my_memos', ['filter' => 'auth']);
$routes->match(['get'], 'view-memo/(:num)', 'PostController::view_memo/$1', ['filter' => 'auth']);
$routes->match(['get'], 'edit-memo/(:num)', 'PostController::edit_memo/$1', ['filter' => 'auth']);
$routes->match(['post'], 'edit-memo', 'PostController::edit_memo', ['filter' => 'auth']);

$routes->match(['get'], 'circulars', 'PostController::circulars', ['filter' => 'auth']);
$routes->match(['get'], 'new-circular', 'PostController::new_circular', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'internal-circular', 'PostController::internal_circular', ['filter' => 'auth']);
$routes->match(['post'], 'upload-post-attachments', 'PostController::upload_post_attachments', ['filter' => 'auth']);
$routes->match(['post', 'get'], 'delete-post-attachments', 'PostController::delete_post_attachments', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'external-circular', 'PostController::external_circular', ['filter' => 'auth']);
$routes->match(['get'], 'my-circulars', 'PostController::my_circulars', ['filter' => 'auth']);
$routes->match(['get'], 'view-circular/(:num)', 'PostController::view_circular/$1', ['filter' => 'auth']);
//$routes->get('notice-board/(:any)', 'MessagingSettingController::notice_board/$1', ['filter' => 'auth']);

$routes->match(['get'], 'my-account', 'EmployeeController::my_account', ['filter' => 'auth']);
$routes->match(['get'], 'check-signature-exists', 'EmployeeController::check_signature_exists', ['filter' => 'auth']);
$routes->match(['post'], 'setup-signature', 'EmployeeController::setup_signature', ['filter' => 'auth']);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
