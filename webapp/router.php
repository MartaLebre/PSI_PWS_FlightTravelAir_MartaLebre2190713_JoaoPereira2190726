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

Router::get('login/getlogin',           'LoginController/LoginForm');
Router::get('login/getregisto',    'LoginController/RegistoForm');
Router::post('login/registo',    'LoginController/Registo');
Router::post('login/login',           'LoginController/Login');
Router::get('login/logout',             'LoginController/logout');


//** AdminController **

Router::get('admin/index',           'AdminController/index');

Router::resource('aeroport', 'AeroportController');
Router::resource('funcionario', 'FuncionarioController');










/************** End of URLEncoder Routing Rules ************************************/