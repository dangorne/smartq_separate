<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main/';
$route['logout'] = 'main/logout';
$route[''] = 'main/index';
$route['nextqueuer'] = 'main/nextqueuer';
$route['editclient'] = 'main/editclient';
$route['createq'] = 'main/createq';
$route['dashboard'] = 'main/dashboard';
$route['editsubscriber'] = 'main/editsubscriber';
$route['joinq'] = 'main/joinq';
$route['pauseq'] = 'main/pauseq';
$route['resumeq'] = 'main/resumeq';
$route['closeq'] = 'main/closeq';
$route['stopq'] = 'main/stopq';
$route['dbupdate'] = 'main/dbupdate';
$route['create'] = 'main/createq';
$route['load_detail'] = 'main/load_detail';
$route['load_status'] = 'main/load_status';
$route['editdetail'] = 'main/editdetail';
$route['fetchlist'] = 'main/fetchlist';
$route['windowrio'] = 'main/windowrio';
$route['joinq'] = 'main/joinq';
$route['leave'] = 'main/leave';

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
