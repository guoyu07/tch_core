<?php

if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

/**
 * 帮助功能
 */
require dirname(__FILE__) . '/_bootstrap.php';

$router = new TCH_Core_AdminRouter();
$router->run('help');