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
$petugas  = ['filter' => 'role:petugas'];
$penyetuju = ['filter' => 'role:admin, petugas'];
$allRole   = ['filter' => 'role:admin, user, petugas'];

// Login
$routes->get('/login', 'Auth::login');
$routes->post('/proses-login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// Halaman utama
$routes->get('/', 'Home::index', $authFilter);
$routes->get('/dashboard', 'DashboardController::index', $authFilter);

// Notifikasi
$routes->get('/notifikasi', 'Home::notifikasi', $petugas); //aksi ke menu notifikasi
$routes->get('/api/notifikasi', 'Home::getNotifikasi', $petugas); //aksi ambil data notifikasi untuk ajax
$routes->post('/notifikasi/mark-read/(:num)', 'Home::markAsRead/$1', $petugas); //aksi mark as read notifikasi
$routes->post('/notifikasi/mark-all-read', 'Home::markAllAsRead', $petugas); //aksi mark as read semua notifikasi
$routes->post('/notifikasi/delete/(:num)', 'Home::deleteNotifikasi/$1', $petugas); //aksi hapus notifikasi

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
$routes->post('/alat/update', 'AlatController::update', $admin); // aksi update alat
$routes->post('/alat/update/(:num)', 'SimpanController::update/$1', $admin); // aksi update alat
$routes->get('/alat/tambah', 'AlatController::tambah', $admin); // form tambah alat
$routes->post('/alat/simpan', 'AlatController::simpan', $admin); // aksi simpan alat


//peminjaman
$routes->get('/pinjam/(:num)', 'PinjamController::form/$1', $allRole); //form peminjaman
$routes->post('/pinjam/simpan', 'PinjamController::simpan', $allRole); //aksi simpan peminjaman
$routes->post('/alat/simpan', 'AlatController::simpan', $allRole); //aksi simpan alat

// pengembalian
$routes->get('/pengembalian', 'PengembalianController::index', $allRole); //aksi ke menu pengembalian
$routes->get('/pengembalian/kembalikan/(:num)', 'PengembalianController::kembalikan/$1', $user); //aksi kembalikan alat
$routes->get('/pengembalian/delete/(:num)', 'PengembalianController::delete/$1', $allRole); //aksi hapus data pengembalian
$routes->get('/riwayat', 'PengembalianController::riwayat', $allRole); //aksi riwayat pengembalian

//pdf
$routes->get('/pengembalian/export', 'PengembalianController::export', $allRole); //aksi export pdf data pengembalian


//profile
$routes->get('/profile', 'ProfileController::index', $allRole); //aksi ke menu profile
$routes->get('profile/edit', 'ProfileController::edit');
$routes->post('/profile/update/(:num)', 'ProfileController::update/$1', $allRole);

//approval peminjaman
$routes->get('/approval', 'ApprovalController::index', $penyetuju); //aksi ke menu approval
$routes->post('/approval/approve/(:num)', 'ApprovalController::approve/$1', $penyetuju);
$routes->post('/approval/reject/(:num)', 'ApprovalController::reject/$1', $penyetuju);

//Kategori
$routes->get('/kategori', 'KategoriController::index'); //
$routes->get('/kategori/tambah', 'KategoriController::tambah'); //
$routes->post('/kategori/simpan', 'KategoriController::simpan');
$routes->get('/kategori/edit/(:num)', 'KategoriController::edit/$1');
$routes->post('/kategori/update/(:num)', 'KategoriController::update/$1');
$routes->post('/kategori/delete/(:num)', 'KategoriController::delete/$1');

// Backup database
$routes->get('/backup', 'Backup::index');

// Restore database
$routes->get('/restore', 'Restore::index');
$routes->post('/restore/auth', 'Restore::auth');
$routes->get('/restore/form', 'Restore::form');
$routes->post('/restore/process', 'Restore::process');
