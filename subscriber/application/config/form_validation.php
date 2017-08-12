<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
  'syntax' => array(
          array(
            'field' => 'user',
            'label' => 'Username',
            'rules' => 'trim|required|min_length[3]',
          ),
          array(
            'field' => 'pass',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[3]|alpha_numeric',
          ),
  ),
  // 'main/login_validated_existing' => array(
  //         array(
  //           'field' => 'user',
  //           'label' => 'Username',
  //           'rules' => array(
  //                       array('existingusername',  array($CI->main_model, 'existingUsername'))
  //                     ),
  //           'errors' => array(
  //                         'existingusername' => 'Username does not exist.'
  //                       ),
  //         ),
  //         array(
  //           'field' => 'pass',
  //           'label' => 'Password',
  //           'rules' => array(
  //                        array('correctpassword',  array($CI->main_model, 'correctPassword'))
  //                      ),
  //           'errors' => array(
  //                         'correctpassword' => 'Incorrect password.'
  //                       ),
  //         ),
  // ),
);
