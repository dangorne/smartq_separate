<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main/';
$route['logout'] = 'main/logout';
$route[''] = 'main/index';
$route['nextqueuer'] = 'main/nextqueuer';
$route['editclient'] = 'main/editclient';
$route['createq'] = 'main/createq';
$route['controlq'] = 'main/controlq';
$route['editsubscriber'] = 'main/editsubscriber';
$route['joinq'] = 'main/joinq';
$route['pauseq'] = 'main/pauseq';
$route['resumeq'] = 'main/resumeq';
$route['closeq'] = 'main/closeq';
$route['stopq'] = 'main/stopq';
$route['dbupdate'] = 'main/dbupdate';
$route['dashboard'] = 'main/dashboard';
$route['fetchsearch'] = 'main/fetchsearch';
$route['listselected'] = 'main/listselected';
$route['joinselected'] = 'main/joinselected';
$route['fetchlist'] = 'main/fetchlist';
$route['leave'] = 'main/leave';
// $route['fetchsearch_all'] = 'main/fetchsearch_all';


if ($_SERVER['REQUEST_METHOD'] === 'POST'){

 $route['login'] = 'main/login_validated';

}else{

 $route['login'] = 'main/login';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

 $route['signup'] = 'main/signup_validated';

}else{

 $route['signup'] = 'main/signup';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

 $route['createq'] = 'main/createq_submit';

}else{

 $route['createq'] = 'main/createq';
}
