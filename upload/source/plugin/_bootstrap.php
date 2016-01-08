<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * 公共启动文件 其他插件要使用该框架,引入该文件即可
 */

/**
 * 框架本身的插件ID
 */
define('TCH_CORE_ID', 'tch_core');

define('TCH_CORE_ROOT', dirname(__FILE__));

//定义插件ID
if (defined('CURMODULE')) {//前台
    define('TCH_APP_ID', CURMODULE);
} else {//后台 都经过 admin.php?action=plugins&operation=config 进入 取 $plugin变量
    define('TCH_APP_ID', preg_replace('/[^\[A-Za-z0-9_\]]/', '', $plugin['identifier']));
}

if (file_exists(dirname(__FILE__) . '/data/dev.txt')) {
    define('TCH_DEBUG', true);
    
    error_reporting(E_ERROR ^ E_WARNING);
    ini_set('display_errors', true);
}

//框架本身的类自动加载
require dirname(__FILE__) . '/class/autoloader.php';

TCH_Core_Autoloader::register();