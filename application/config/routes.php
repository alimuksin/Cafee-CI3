<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['login'] = 'welcome/login';
$route['logout'] = 'welcome/logout';

$route['admin'] = 'login/login';
$route['kasir'] = 'login/login';

$route['daftar'] = 'welcome/daftar';
$route['reservasi'] = 'pesan/reservasi';
$route['cara-pesan'] = 'welcome/pesan';
$route['cara-booking'] = 'welcome/booking';
$route['404_override'] = 'not_found';
$route['translate_uri_dashes'] = FALSE;
