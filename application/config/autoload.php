<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('database','session','form_validation','template','upload','cart');
$autoload['drivers'] = array();
$autoload['helper'] = array('url','form','file','my','string');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('Global_model' => 'global');
// $autoload['model'] = array("global_data"=>"func","admin_data"=>"admfunc");
