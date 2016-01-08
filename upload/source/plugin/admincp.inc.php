<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

/**
 * 框架后台入口
 */
require dirname(__FILE__) . '/_bootstrap.php';

$router = new TCH_Core_AdminRouter();
$router->run('main');
