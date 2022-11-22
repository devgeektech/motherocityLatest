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
$routes->setDefaultController('Admin\Admin');
$routes->setDefaultMethod('login');
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
//$routes->get('/', 'Home::index');

/*APP-----------------------------------------------*/
$routes->group('/api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
	
	$routes->get('get-experties', 'Users::getExperties');
    $routes->get('get-nutrition-category', 'Users::get_nutrition_category');
    $routes->get('get-contentblog-category', 'Users::get_contentBlog_category');
    $routes->post('signup', 'Users::signup');
    $routes->post('signup_otp', 'Users::signup_otp');
    $routes->post('login', 'Users::login'); 
    $routes->get('is-verified', 'Users::isVerified');
    $routes->post('edit-profile', 'Users::edit_profile');
    $routes->get('get-user-by-id', 'Users::get_user_by_id');
    $routes->post('change-password', 'Users::change_password'); 
    $routes->post('forget-password', 'Users::forget_password');
    $routes->get('interval', 'Users::interval_api');
    $routes->get('membership-list', 'Users::MembershipList');
    $routes->post('BuyMembership', 'Users::BuyMembership');
    $routes->get('get-toolkit-category', 'Users::get_toolkit_category');
    $routes->get('get-content-category', 'Users::get_content_category');

//notification api route
    $routes->get('get-notification', 'Users::GetNotification');
    $routes->get('unread-notification', 'Users::GetUnreadNotification');
    $routes->get('clear-notification', 'Users::ClearNotification');
    $routes->get('clear-singlenotification', 'Users::ClearSingleNotification');
    $routes->get('mark-readnotification', 'Users::MarkAsReadNotification');
    $routes->get('check-email', 'Users::check_email');
    $routes->get('check-phone', 'Users::check_phone');
    $routes->get('get-report-category', 'Users::get_report_category');
    $routes->get('get-help-category', 'Users::get_help_category');
    $routes->post('addHelp', 'Users::addHelp');
    $routes->post('addReport', 'Users::addReport');
    $routes->get('privacy-policy', 'Users::privacyPolicy');
    $routes->get('terms-conditions', 'Users::termsConditions');
    $routes->get('about', 'Users::aboutUs');
    $routes->get('faq', 'Users::faqsManagement');
    $routes->get('why', 'Users::why');
    $routes->get('what', 'Users::what');
    $routes->get('who', 'Users::who');
    $routes->post('contact-us', 'Users::contact_us');
    $routes->get('contact-us-category', 'Users::contact_us_category');
    $routes->post('reset-password', 'Users::resetPassword');
    $routes->get('addto-favorite', 'Users::addtoFavorite');
    $routes->get('myfavorite-list', 'Users::myFavoriteList');
    $routes->get('home-screen', 'Users::homeScreenContent');
    $routes->get('get-all-tips', 'Users::getAllTips');
    $routes->get('get-blogs-for-home', 'Users::getBlogsForHome');
    $routes->get('faq-category-list', 'Users::faq_category');
    $routes->get('send-otp', 'Users::sendOpt');
    
	
});

/*Web-----------------------------------------------*/
$routes->get('/', 'Admin\Admin::login');
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], static function ($routes) 
{
    $routes->get('/', 'Admin::login');
    $routes->get('plansubscription', 'Admin::subscriptionplan');
    $routes->get('forgot', 'Admin::Forgot');
    $routes->get('do_forgot', 'Admin::do_forgot');

    //genres preference
    $routes->get('genres-preferences', 'Genres::genres_preferences');
    

    //content preference
    $routes->get('content-preferences', 'Content::content_preferences');
    
  //country management
    $routes->get('country-management', 'Country::country_management');
    $routes->get('country-management', 'Country::deleteCountry');

    /*Auth=====================*/
        $routes->get('profile', 'Profile::adminProfile');
        $routes->get('dashboard', 'Dashboard::index');
        $routes->get('logout', 'Dashboard::Logout');

        $routes->get('users', 'Users::index');
        $routes->get('view-user/(:any)', 'Users::user_view/$1');
        $routes->get('edit-user/(:any)', 'Users::user_edit/$1');

        $routes->get('reported_users', 'Users::reported_user');
        $routes->get('content', 'Content::index');
        $routes->get('feedback', 'Dashboard::feedback_list');
        $routes->get('post', 'Dashboard::post_list');
        $routes->get('view-post/(:any)', 'Dashboard::post_view/$1');

  //specialist-category
    $routes->get('specialist-category', 'Specialist_category::specialist_category');
    $routes->get('specialist-subcategory', 'Specialist_category::specialist_subcategory');

//Nutrition category
    $routes->get('nutrition-category', 'Nutrition::nutrition_category');
    $routes->get('nutrition-subcategory', 'Nutrition::nutrition_subcategory');

//Content Blog category
    $routes->get('blog-category', 'Blog::blog_category');
    $routes->get('blog-subcategory', 'Blog::blog_subcategory');
    $routes->get('blog-list', 'Blog::blog_list');

//Content Management
    $routes->get('privacy', 'Content_Management::privacy_list');
    $routes->get('term', 'Content_Management::term_list');
    $routes->get('about', 'Content_Management::about');
//FAQ


//TIPS MANAGEMENT
$routes->get('tips-list', 'Tips::tips_list');

//faqs MANAGEMENT
$routes->get('faq-category', 'Faqs::faqCategory');
$routes->get('faqs-list', 'Faqs::faqs_list');
$routes->get('accountfaqs-list', 'Faqs::accountfaqs_list');

$routes->get('report', 'Content_Management::report_list');
$routes->get('report-category', 'Content_Management::reportcategory_list');
$routes->get('help-category', 'Content_Management::helpcategory_list');
$routes->get('help', 'Content_Management::help_list');

//users
$routes->get('incoming_user', 'Users::incoming_user');
$routes->get('verified_user', 'Users::verified_user');
$routes->get('moms', 'Users::moms');

$routes->get('specialist-profile/(:any)', 'Users::specialist_profile/$1');
$routes->get('mom-profile/(:any)', 'Users::mom_profile/$1');

//Content Category
$routes->get('content-category', 'Content::content_category');
$routes->get('content-subcategory', 'Content::content_subcategory');


$routes->get('toolkit-category', 'Toolkit::toolkit_category');
$routes->get('toolkit-subcategory', 'Toolkit::toolkit_subcategory');

$routes->get('plan', 'Plan::plan_list');

$routes->get('roles', 'Roles::roles_list');
$routes->get('collaborators', 'Collaborators::collaborators_list');

$routes->get('stage', 'Stage_management::stage_list');
$routes->get('contact', 'Users::contact_list');





});


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
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