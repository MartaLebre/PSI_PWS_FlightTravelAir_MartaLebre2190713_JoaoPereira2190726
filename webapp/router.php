<?php
/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 02-05-2016
 * Time: 11:18
 */
use ArmoredCore\Facades\Router;

/****************************************************************************
 *  URLEncoder/HTTPRouter Routing Rules
 *  Use convention: controllerName/methodActionName
 ****************************************************************************/

Router::get('/',			'HomeController/index');
Router::get('home/',		'HomeController/index');
Router::get('home/index',	'HomeController/index');
Router::get('home/start',	'HomeController/start');

// ** LoginController **

Router::get('login/getlogin',           'LoginController/getLoginForm');
Router::get('login/getregistration',    'LoginController/getRegistrationForm');
Router::post('login/doregistration',    'LoginController/doRegistration');
Router::post('login/dologin',           'LoginController/doLogin');
Router::get('login/logout',             'LoginController/logout');


//** AdminAppController **

Router::get('admin/index',           'AdminController/index');

Router::resource('aeroporto', 'AeroportController');
Router::resource('funcionario', 'FuncionarioController');










/************** End of URLEncoder Routing Rules ************************************/