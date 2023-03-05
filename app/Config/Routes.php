<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'authAdmin']);

$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->get('/login/makeCookie/(.*)/(.*)', 'Login::makeCookie/$1/$2');
$routes->post('/login/auth', 'Login::auth');

$routes->get('/client', 'Client::index', ['filter' => 'authAdmin']);
$routes->get('/client/getAllClient', 'Client::getAllClient', ['filter' => 'authAdmin']);
$routes->get('/client/getClient/(.*)', 'Client::getClient/$1', ['filter' => 'authAdmin']);
$routes->get('/client/hapusClient/(.*)', 'Client::hapusClient/$1', ['filter' => 'authAdmin']);
$routes->post('/client/simpan', 'Client::simpan', ['filter' => 'authAdmin']);

$routes->get('/soal/getSoal/(.*)', 'Soal::getSoal/$1', ['filter' => 'authAdmin']);

$routes->get('/testoefl', 'TesToefl::index', ['filter' => 'authAdmin']);
$routes->get('/testoefl/getAllTes', 'TesToefl::getAllTes', ['filter' => 'authAdmin']);
$routes->get('/testoefl/getTes/(.*)', 'TesToefl::getTes/$1', ['filter' => 'authAdmin']);
$routes->get('/testoefl/hapusTes/(.*)', 'TesToefl::hapusTes/$1', ['filter' => 'authAdmin']);
$routes->post('/testoefl/simpan', 'TesToefl::simpan', ['filter' => 'authAdmin']);
$routes->post('/testoefl/editStatusTes', 'TesToefl::editStatusTes', ['filter' => 'authAdmin']);
$routes->get('/testoefl/hasil/(.*)', 'TesToefl::hasil/$1', ['filter' => 'authAdmin']);
$routes->get('/testoefl/getHasilTesToefl/(.*)', 'TesToefl::getHasilTesToefl/$1', ['filter' => 'authAdmin']);
$routes->get('/testoefl/getPeserta/(.*)', 'TesToefl::getPeserta/$1', ['filter' => 'authAdmin']);
$routes->post('/testoefl/simpanPesertaToefl', 'TesToefl::simpanPesertaToefl', ['filter' => 'authAdmin']);

$routes->get('/tes', 'Tes::index', ['filter' => 'authAdmin']);
$routes->get('/tes/getAllTes', 'Tes::getAllTes', ['filter' => 'authAdmin']);
$routes->get('/tes/getTes/(.*)', 'Tes::getTes/$1', ['filter' => 'authAdmin']);
$routes->get('/tes/hapusTes/(.*)', 'Tes::hapusTes/$1', ['filter' => 'authAdmin']);
$routes->post('/tes/simpan', 'Tes::simpan', ['filter' => 'authAdmin']);
$routes->post('/tes/editStatusTes', 'Tes::editStatusTes', ['filter' => 'authAdmin']);
$routes->get('/tes/hasil/(.*)', 'Tes::hasil/$1', ['filter' => 'authAdmin']);
$routes->get('/tes/getHasilTesIelts/(.*)', 'Tes::getHasilTesIelts/$1', ['filter' => 'authAdmin']);
$routes->get('/tes/getPeserta/(.*)', 'Tes::getPeserta/$1', ['filter' => 'authAdmin']);
$routes->post('/tes/simpanPesertaIelts', 'Tes::simpanPesertaIelts', ['filter' => 'authAdmin']);
$routes->post('/tes/simpanFeedbackWriting', 'Tes::simpanFeedbackWriting', ['filter' => 'authAdmin']);
$routes->post('/tes/simpanFeedbackSpeaking', 'Tes::simpanFeedbackSpeaking', ['filter' => 'authAdmin']);

$routes->get('/clientarea', 'ClientArea::index');
$routes->post('/clientarea/auth', 'ClientArea::auth');

$routes->get('/clientarea/testoefl', 'ClientArea::tesToefl', ['filter' => 'authClient']);
$routes->get('/clientarea/getAllTesToefl', 'ClientArea::getAllTesToefl', ['filter' => 'authClient']);
$routes->get('/clientarea/hasiltoefl/(.*)', 'ClientArea::hasiltoefl/$1', ['filter' => 'authClient']);
$routes->get('/clientarea/getHasilTesToefl/(.*)', 'ClientArea::getHasilTesToefl/$1', ['filter' => 'authClient']);
$routes->get('/clientarea/getPesertaToefl/(.*)', 'ClientArea::getPesertaToefl/$1', ['filter' => 'authClient']);
$routes->post('/clientarea/simpanPesertaToefl', 'ClientArea::simpanPesertaToefl', ['filter' => 'authClient']);



$routes->get('/clientarea/tes', 'ClientArea::tes', ['filter' => 'authClient']);
$routes->get('/clientarea/getAllTes', 'ClientArea::getAllTes', ['filter' => 'authClient']);
$routes->get('/clientarea/hasil/(.*)', 'ClientArea::hasil/$1', ['filter' => 'authClient']);
$routes->get('/clientarea/getHasilTesIelts/(.*)', 'ClientArea::getHasilTesIelts/$1', ['filter' => 'authClient']);
$routes->get('/clientarea/getPeserta/(.*)', 'ClientArea::getPeserta/$1', ['filter' => 'authClient']);
$routes->post('/clientarea/simpanPesertaIelts', 'ClientArea::simpanPesertaIelts', ['filter' => 'authClient']);
$routes->post('/clientarea/simpanFeedbackWriting', 'ClientArea::simpanFeedbackWriting', ['filter' => 'authClient']);
$routes->post('/clientarea/simpanFeedbackSpeaking', 'ClientArea::simpanFeedbackSpeaking', ['filter' => 'authClient']);

$routes->post('/PesertaIelts/cekEmail', 'PesertaIelts::cekEmail');
$routes->post('/PesertaIelts/passwordCheck', 'PesertaIelts::passwordCheck');
$routes->post('/PesertaIelts/addJawabanIelts', 'PesertaIelts::addJawabanIelts');

$routes->post('/PesertaToefl/cekEmail', 'PesertaToefl::cekEmail');
$routes->post('/PesertaToefl/passwordCheck', 'PesertaToefl::passwordCheck');
$routes->post('/PesertaToefl/addJawabanToefl', 'PesertaToefl::addJawabanToefl');

$routes->get('/toefl/(.*)/(.*)', 'TesToefl::soalTes/$1/$2');
$routes->get('/(.*)/(.*)', 'Tes::soalTes/$1/$2');

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
