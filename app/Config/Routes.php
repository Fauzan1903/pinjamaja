<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Variabel Filter
$authFilter = ['filter' => 'auth'];

// Variabel Role
$admin     = ['filter' => 'role:admin'];
$user     = ['filter' => 'role:user'];
$allRole   = ['filter' => 'role:admin, user'];

// Login
$routes->get('/login', 'Auth::login');
$routes->post('/proses-login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// Halaman utama
$routes->get('/', 'Home::index', $authFilter);
$routes->get('/dashboard', 'Home::index', $authFilter);

// User
$routes->get('/users/create', 'Users::create'); // form tambah user
$routes->post('/users/store', 'Users::store'); // aksi simpan user

// Tambahan untuk menampilkan data user, form edit, aksi update, dan hapus user
$routes->get('/users', 'Users::index', $allRole); // menampilkan data user
$routes->get('/users/edit/(:num)', 'Users::edit/$1', $admin); // form edit user
$routes->post('/users/update/(:num)', 'Users::update/$1', $allRole); // aksi update user
$routes->get('/users/delete/(:num)', 'Users::delete/$1', $admin); // aksi hapus user

//Menu alat
$routes->get('/alat', 'AlatController::index'); // aksi ke menu alat
$routes->get('/alat/delete/(:num)', 'SimpanController::delete/$1', $admin); // aksi hapus alat
$routes->get('/alat/edit/(:num)', 'AlatController::edit/$1', $admin); // form edit alat
$routes->post('/alat/update', 'AlatController::update'); // aksi update alat
$routes->post('/alat/update/(:num)', 'SimpanController::update/$1', $admin); // aksi update alat
$routes->get('/alat/tambah', 'AlatController::tambah'); // form tambah alat
$routes->post('/alat/simpan', 'AlatController::simpan'); // aksi simpan alat


//peminjaman
$routes->get('/pinjam/(:num)', 'PinjamController::form/$1'); //form peminjaman
$routes->post('/pinjam/simpan', 'PinjamController::simpan'); //aksi simpan peminjaman
$routes->post('/alat/simpan', 'AlatController::simpan'); //aksi simpan alat

// pengembalian
$routes->get('/pengembalian', 'PengembalianController::index'); //aksi ke menu pengembalian
$routes->get('/pengembalian/kembalikan/(:num)', 'PengembalianController::kembalikan/$1'); //aksi kembalikan alat
$routes->get('/pengembalian/delete/(:num)', 'PengembalianController::delete/$1'); //aksi hapus data pengembalian
$routes->get('/riwayat', 'PengembalianController::riwayat'); //aksi riwayat pengembalian

//pdf
$routes->get('/pengembalian/export', 'PengembalianController::export');//aksi export pdf data pengembalian
