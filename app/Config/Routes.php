<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

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
$routes->get('/', 'LoginController::index');

$routes->post('login-process', 'LoginController::loginProcess');

$routes->get('/admin/dashboard', 'Admin\Dashboard::index', ['filter' => 'auth']);
$routes->get('petugas/dashboard', 'PetugasController::index');


// Admin
$routes->group('admin', ['filter' => 'auth'], function (RouteCollection $routes) {


   // Kelas
   $routes->group('kelas', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
      $routes->get('/', 'KelasController::index');
      $routes->get('tambah', 'KelasController::tambahKelas');
      $routes->post('tambahKelasPost', 'KelasController::tambahKelasPost');
      $routes->get('edit/(:any)', 'KelasController::editKelas/$1');
      $routes->post('editKelasPost', 'KelasController::editKelasPost');
      $routes->post('deleteKelasPost', 'KelasController::deleteKelasPost');
      $routes->post('list-data', 'KelasController::listData');
   });

   // admin lihat data siswa
   $routes->get('siswa', 'Admin\DataSiswa::index');
   $routes->post('siswa', 'Admin\DataSiswa::ambilDataSiswa');
   // admin tambah data siswa
   $routes->get('siswa/create', 'Admin\DataSiswa::formTambahSiswa');
   $routes->post('siswa/create', 'Admin\DataSiswa::saveSiswa');
   // admin edit data siswa
   $routes->get('siswa/edit/(:any)', 'Admin\DataSiswa::formEditSiswa/$1');
   $routes->post('siswa/edit', 'Admin\DataSiswa::updateSiswa');
   // admin hapus data siswa
   $routes->delete('siswa/delete/(:any)', 'Admin\DataSiswa::delete/$1');
   $routes->get('siswa/bulk', 'Admin\DataSiswa::bulkPostSiswa');

   // POST Data Siswa

   $routes->group('siswa', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
      $routes->post('downloadCSVFilePost', 'DataSiswa::downloadCSVFilePost');
      $routes->post('generateCSVObjectPost', 'DataSiswa::generateCSVObjectPost');
      $routes->post('importCSVItemPost', 'DataSiswa::importCSVItemPost');
      $routes->post('deleteSelectedSiswa', 'DataSiswa::deleteSelectedSiswa');
   });

   // admin lihat data absen siswa
   $routes->get('absen-siswa', 'Admin\DataAbsenSiswa::index');
   $routes->post('absen-siswa', 'Admin\DataAbsenSiswa::ambilDataSiswa'); // ambil siswa berdasarkan kelas dan tanggal
   $routes->post('absen-siswa/kehadiran', 'Admin\DataAbsenSiswa::ambilKehadiran'); // ambil kehadiran siswa
   $routes->post('absen-siswa/edit', 'Admin\DataAbsenSiswa::ubahKehadiran'); // ubah kehadiran siswa
   // admin send notifikasi siswa
   $routes->get('absen-siswa/send', 'Admin\DataAbsenSiswa::sendNotification');

   // admin buat laporan
   $routes->get('laporan', 'Admin\GenerateLaporan::index');
   $routes->post('laporan/siswa', 'Admin\GenerateLaporan::generateLaporanSiswa');

   // superadmin lihat data petugas
   $routes->get('petugas', 'Admin\DataPetugas::index');
   $routes->post('petugas', 'Admin\DataPetugas::ambilDataPetugas');
   // superadmin tambah data petugas
   $routes->get('petugas/register', 'Admin\DataPetugas::registerPetugas');
   // superadmin edit data petugas
   $routes->get('petugas/edit/(:any)', 'Admin\DataPetugas::formEditPetugas/$1');
   $routes->post('petugas/edit', 'Admin\DataPetugas::updatePetugas');
   // superadmin hapus data petugas
   $routes->delete('petugas/delete/(:any)', 'Admin\DataPetugas::delete/$1');

   // Settings
   $routes->group('general-settings', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
      $routes->get('/', 'GeneralSettings::index');
      $routes->post('update', 'GeneralSettings::generalSettingsPost');
   });
});


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
