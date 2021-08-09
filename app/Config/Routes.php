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
$routes->get('/test', 'TestController::index');

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

// post routes
$routes->match(['post'], 'upload-post-attachments', 'PostController::upload_post_attachments', ['filter' => 'auth']);
$routes->match(['post', 'get'], 'delete-post-attachments', 'PostController::delete_post_attachments', ['filter' => 'auth']);
$routes->match(['post'], 'sign-post', 'PostController::sign_post', ['filter' => 'auth']);
$routes->match(['post'], 'decline-post', 'PostController::decline_post', ['filter' => 'auth']);
$routes->match(['post'], 'send-doc-signing-verification', 'PostController::send_doc_signing_verification/', ['filter' => 'auth']);

// notices route
$routes->get('notices', 'NoticeController::index', ['filter' => 'auth']);
$routes->get('notices/(:alpha)', 'NoticeController::index/$1', ['filter' => 'auth']);
$routes->get('my-notices', 'NoticeController::my_notices', ['filter' => 'auth']);
$routes->get('view-notice/(:num)', 'NoticeController::view_notice/$1', ['filter' => 'auth']);
$routes->get('edit-notice/(:num)', 'NoticeController::edit_notice/$1', ['filter' => 'auth']);
$routes->post('edit-notice', 'NoticeController::edit_notice', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'new-notice', 'NoticeController::new_notice', ['filter' => 'auth']);

// memo routes
$routes->match(['get'], 'memos', 'MemoController::memos', ['filter' => 'auth']);
$routes->match(['get'], 'memos/(:alpha)', 'MemoController::memos/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'internal-memo', 'MemoController::internal_memo', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'external-memo', 'MemoController::external_memo', ['filter' => 'auth']);
$routes->match(['get'], 'my-memos', 'MemoController::my_memos', ['filter' => 'auth']);
$routes->match(['get'], 'view-memo/(:num)', 'MemoController::view_memo/$1', ['filter' => 'auth']);
$routes->match(['get'], 'edit-memo/(:num)', 'MemoController::edit_memo/$1', ['filter' => 'auth']);
$routes->match(['post'], 'edit-memo', 'MemoController::edit_memo', ['filter' => 'auth']);

// circular routes
$routes->match(['get'], 'circulars', 'CircularController::circulars', ['filter' => 'auth']);
$routes->match(['get'], 'circulars/(:alpha)', 'CircularController::circulars/$1', ['filter' => 'auth']);
$routes->match(['get'], 'new-circular', 'CircularController::new_circular', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'internal-circular', 'CircularController::internal_circular', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'external-circular', 'CircularController::external_circular', ['filter' => 'auth']);
$routes->match(['get'], 'my-circulars', 'CircularController::my_circulars', ['filter' => 'auth']);
$routes->match(['get'], 'view-circular/(:num)', 'CircularController::view_circular/$1', ['filter' => 'auth']);

#GDrive routes
$routes->get('/g-drive', 'FileController::index',['filter' => 'auth']);
$routes->post('/process-upload', 'FileController::processAttachmentUploads',['filter' => 'auth']);
$routes->post('/create-folder', 'FileController::createFolder',['filter' => 'auth']);
$routes->get('/open-folder/(:num)', 'FileController::openFolder/$1',['filter' => 'auth']);
$routes->get('/remove-file/(:num)', 'FileController::removeFile/$1',['filter' => 'auth']);
$routes->post('share-file-with', 'FileController::shareFileWith',['filter' => 'auth']);
$routes->get('shared-with-me', 'FileController::sharedFileWithMe',['filter' => 'auth']);
$routes->get('/my-files', 'FileController::myFiles',['filter' => 'auth']);
$routes->post('/search-g-drive', 'FileController::searchGDrive',['filter' => 'auth']);

#Training routes
$routes->get('/trainings', 'TrainingController::index', ['filter'=>'auth']);
$routes->get('/add-new-training', 'TrainingController::showAddNewTrainingForm', ['filter'=>'auth']);
$routes->get('/edit-training/(:any)', 'TrainingController::showEditTrainingForm/$1', ['filter'=>'auth']);
$routes->post('/add-new-training', 'TrainingController::storeNewTraining', ['filter'=>'auth']);
$routes->get('/trainings/(:any)', 'TrainingController::viewTraining/$1', ['filter'=>'auth']);
$routes->post('/update-training', 'TrainingController::updateTraining', ['filter'=>'auth']);
#Lesson routes
$routes->post('/add-new-training-lesson', 'TrainingController::addNewTrainingLesson', ['filter'=>'auth']);
$routes->post('/update-training-lesson', 'TrainingController::updateTrainingLesson', ['filter'=>'auth']);
$routes->get('/delete-lesson-attachment/(:num)', 'TrainingController::deleteAttachment/$1', ['filter'=>'auth']);

#Workflow routes
$routes->get('/workflow/settings', 'WorkflowController::settings', ['filter'=>'auth']);
$routes->post('/workflow/add-new-workflow-type', 'WorkflowController::storeNewWorkflowType', ['filter'=>'auth']);
$routes->post('/workflow/update-workflow-type', 'WorkflowController::updateWorkflowType', ['filter'=>'auth']);
#Normal process routes
$routes->post('/workflow/setup-workflow-processor', 'WorkflowController::setupWorkflowProcessor', ['filter'=>'auth']);
$routes->post('/workflow/update-workflow-processor', 'WorkflowController::updateWorkflowProcessor', ['filter'=>'auth']);

#Exception process routes
$routes->post('/workflow/setup-exception-workflow-processor', 'WorkflowController::setupExceptionWorkflowProcessor', ['filter'=>'auth']);
$routes->post('/workflow/update-exception-workflow-processor', 'WorkflowController::updateExceptionWorkflowProcessor', ['filter'=>'auth']);

#Workflow request [employee]
$routes->get('/workflow-requests', 'WorkflowController::workflowRequests', ['filter'=>'auth']);
$routes->get('/workflow-requests/new-request', 'WorkflowController::createNewWorkflowRequest', ['filter'=>'auth']);
$routes->post('/workflow-requests/new-request', 'WorkflowController::setNewWorkflowRequest', ['filter'=>'auth']);
$routes->get('/workflow-requests/view/(:num)', 'WorkflowController::viewWorkflowRequest/$1', ['filter'=>'auth']);
$routes->post('/workflow-requests/process-request', 'WorkflowController::processWorkflowRequest', ['filter'=>'auth']);
$routes->post('/workflow-requests/leave-comment', 'WorkflowController::leaveComment', ['filter'=>'auth']);
//$routes->get('notice-board/(:any)', 'MessagingSettingController::notice_board/$1', ['filter' => 'auth']);


//$routes->get('/email', 'EmailServiceController::index', ['filter'=>'auth']);
//$routes->get('/email/(:num)', 'EmailServiceController::index/$1', ['filter'=>'auth']);

$routes->get('/email/folder/(:any)', 'EmailServiceController::getMessagesInFolder/$1',['filter'=>'auth', 'as'=>'messages-in']);
/*

$routes->get('/sent-mails', 'EmailController::getSentMails', ['filter'=>'auth']);
$routes->get('/sent-mails/(:num)', 'EmailController::getSentMails/$1', ['filter'=>'auth']);

$routes->get('/draft-mails', 'EmailController::getDraftMails', ['filter'=>'auth']);
$routes->get('/draft-mails/(:num)', 'EmailController::getDraftMails/$1', ['filter'=>'auth']);

$routes->get('/archive-mails', 'EmailController::getArchivedMails', ['filter'=>'auth']);
$routes->get('/archive-mails/(:num)', 'EmailController::getArchivedMails/$1', ['filter'=>'auth']);

$routes->get('/trashed-mails', 'EmailController::getTrashedMails', ['filter'=>'auth']);
$routes->get('/trashed-mails/(:num)', 'EmailController::getTrashedMails/$1', ['filter'=>'auth']);

$routes->get('/spam-mails', 'EmailController::getSpamMails', ['filter'=>'auth']);
$routes->get('/spam-mails/(:num)', 'EmailController::getSpamMails/$1', ['filter'=>'auth']);*/

$routes->get('/read-mail/(:any)/(:any)', 'EmailServiceController::readMail/$1/$2', ['filter'=>'auth', 'as'=>'read-mail']);
$routes->get('/compose-email', 'EmailController::composeEmail', ['filter'=>'auth']);
$routes->post('/compose-email', 'EmailController::processMail', ['filter'=>'auth']);
$routes->get('/email-settings', 'EmailController::showEmailSettingsForm', ['filter'=>'auth']);
$routes->post('/email-settings', 'EmailController::processEmailSettings', ['filter'=>'auth']);

#Project routes
$routes->get('/manage-projects','ProjectController::index',['filter'=>'auth', 'as'=>'manage-projects']);
$routes->get('/projects/create','ProjectController::showAddNewProjectForm',['filter'=>'auth', 'as'=>'add-new-project']);

// employee routes
$routes->match(['get'], 'my-account', 'EmployeeController::my_account', ['filter' => 'auth']);
$routes->match(['get'], 'check-signature-exists', 'EmployeeController::check_signature_exists', ['filter' => 'auth']);
$routes->match(['post'], 'setup-signature', 'EmployeeController::setup_signature', ['filter' => 'auth']);
$routes->match(['post'], 'verify-signature', 'EmployeeController::verify_signature', ['filter' => 'auth']);

// central registry routes
$routes->match(['get'], 'central-registry', 'CentralRegistryController::index', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'incoming-mail', 'CentralRegistryController::incoming_mail', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'outgoing-mail', 'CentralRegistryController::outgoing_mail', ['filter' => 'auth']);
$routes->match(['post'], 'upload-mail-attachments', 'CentralRegistryController::upload_mail_attachments', ['filter' => 'auth']);
$routes->match(['post', 'get'], 'delete-mail-attachments', 'CentralRegistryController::delete_mail_attachments', ['filter' => 'auth']);
$routes->match(['get'], 'manage-mail/(:num)', 'CentralRegistryController::manage_mail/$1', ['filter' => 'auth']);
$routes->match(['post'], 'file-mail', 'CentralRegistryController::file_mail', ['filter' => 'auth']);
$routes->match(['post'], 'transfer-mail', 'CentralRegistryController::transfer_mail', ['filter' => 'auth']);
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
