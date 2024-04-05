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
// $routes->setDefaultController('Home');
// $routes->setDefaultMethod('index');
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
// $routes->get('/', 'Home::index');

$routes->get('/', 'Index::showpage');

$routes->get('/searchitem/bylikes', 'SearchItem::bylikes');
$routes->get('/searchitem', 'SearchItem::search');
$routes->get('/searchauthor', 'SearchItem::searchauthor');
$routes->get('/searchpublisher', 'SearchItem::searchpublisher');

$routes->get('/loginreg', 'LoginRegister::showpage');
$routes->get('/likes', 'LikesBook::showpage', ['filter' => 'authfilter']);
$routes->get('/aboutus', 'AboutUs::showpage');
$routes->post('/verify', 'Auth::verify');
$routes->post('/profile/editprofile', 'Auth::editprofile', ['filter' => 'authfilter']);

$routes->post('/profile/payfine', 'Profile::payfine', ['filter' => 'authfilter']);
$routes->get('/profile/showedit', 'Profile::showedit', ['filter' => 'authfilter']);
$routes->get('/profile', 'Profile::showpage', ['filter' => 'authfilter']);

$routes->post('/detailbook/likeprocess', 'DetailBook::likebook', ['filter' => 'authfilter']);
$routes->post('/detailbook/unlikeprocess', 'DetailBook::unlikebook', ['filter' => 'authfilter']);
$routes->post('/detailbook/borrowprocess', 'DetailBook::borrowbook', ['filter' => 'authfilter']);
$routes->post('/detailbook/returnprocess', 'DetailBook::returnbook', ['filter' => 'authfilter']);
$routes->get('/detailbook/(:any)', 'DetailBook::showpage/$1');

// admin routes
$routes->get('/admin', 'AdminLogin::showpage');
$routes->post('/admin', 'AdminLogin::verifylogin');
$routes->get('/admin/books', 'AdminIndex::showpage', ['filter' => 'authfilteradmin']);
$routes->post('/admin/books', 'AdminIndex::deletebook', ['filter' => 'authfilteradmin']);
$routes->get('/admin/authors', 'AdminAuthor::showpage', ['filter' => 'authfilteradmin']);
$routes->post('/admin/authors', 'AdminAuthor::deleteauthor', ['filter' => 'authfilteradmin']);
$routes->get('/admin/publishers', 'AdminPublisher::showpage', ['filter' => 'authfilteradmin']);
$routes->post('/admin/publishers', 'AdminPublisher::deletepublisher', ['filter' => 'authfilteradmin']);
$routes->get('/admin/genres', 'AdminGenre::showpage', ['filter' => 'authfilteradmin']);
$routes->post('/admin/genres', 'AdminGenre::deletegenre', ['filter' => 'authfilteradmin']);
$routes->get('/admin/users', 'AdminUser::showpage', ['filter' => 'authfilteradmin']);
$routes->post('/admin/users/control', 'AdminUser::controluser', ['filter' => 'authfilteradmin']);
$routes->post('/admin/users/reset', 'AdminUser::resetpass', ['filter' => 'authfilteradmin']);

$routes->get('/admin/addeditbook/', 'AdminAddEditBook::showpage', ['filter' => 'authfilteradmin']);
$routes->post('/admin/addeditbook/', 'AdminAddEditBook::addeditbook', ['filter' => 'authfilteradmin']);
$routes->get('/admin/addeditbook/(:any)', 'AdminAddEditBook::showpage/$1', ['filter' => 'authfilteradmin']);
$routes->post('/admin/addeditbook/(:any)', 'AdminAddEditBook::addeditbook', ['filter' => 'authfilteradmin']);

$routes->get('/admin/addeditauthor/', 'AdminAddEditAuthor::showpage', ['filter' => 'authfilteradmin']);
$routes->post('/admin/addeditauthor/', 'AdminAddEditAuthor::addeditauthor', ['filter' => 'authfilteradmin']);
$routes->get('/admin/addeditauthor/(:any)', 'AdminAddEditAuthor::showpage/$1', ['filter' => 'authfilteradmin']);
$routes->post('/admin/addeditauthor/(:any)', 'AdminAddEditAuthor::addeditauthor', ['filter' => 'authfilteradmin']);

$routes->get('/admin/addeditpublisher/', 'AdminAddEditPublisher::showpage', ['filter' => 'authfilteradmin']);
$routes->post('/admin/addeditpublisher/', 'AdminAddEditPublisher::addeditpublisher', ['filter' => 'authfilteradmin']);
$routes->get('/admin/addeditpublisher/(:any)', 'AdminAddEditPublisher::showpage/$1', ['filter' => 'authfilteradmin']);
$routes->post('/admin/addeditpublisher/(:any)', 'AdminAddEditPublisher::addeditpublisher', ['filter' => 'authfilteradmin']);

$routes->get('/admin/addeditgenre/', 'AdminAddEditGenre::showpage', ['filter' => 'authfilteradmin']);
$routes->post('/admin/addeditgenre/', 'AdminAddEditGenre::addeditgenre', ['filter' => 'authfilteradmin']);
$routes->get('/admin/addeditgenre/(:any)', 'AdminAddEditGenre::showpage/$1', ['filter' => 'authfilteradmin']);
$routes->post('/admin/addeditgenre/(:any)', 'AdminAddEditGenre::addeditgenre', ['filter' => 'authfilteradmin']);

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
