<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('', ['filter' => 'login'], function($routes){
    $routes->get('/', 'Home::index');
    $routes->get('/siswa', 'Siswa::index');
    $routes->add('siswa/tambah', 'Siswa::tambah', ['as' => 'siswa_tambah']);
    $routes->get('siswa/hapus/(:num)', 'Siswa::hapus/$1');
    $routes->add('Siswa/edit/(:num)', 'Siswa::edit/$1');
    $routes->post('siswa/ubah', 'Siswa::ubah');
    
    $routes->get('/guru', 'Guru::index');
    $routes->add('guru/tambah', 'Guru::tambah', ['as' => 'guru_tambah']);
    $routes->get('guru/hapus/(:num)', 'Guru::hapus/$1');
    $routes->add('guru/edit/(:num)', 'Guru::edit/$1');
    $routes->post('guru/ubah', 'Guru::ubah');  
});
