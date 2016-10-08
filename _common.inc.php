<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * 前台功能入口 兼容dz插件id的机制'
 * 如果控制器名称与入口名相同,可以直接引用该文件,减少重复代码
 */

require dirname(__FILE__) . '/_bootstrap.php';

$router = new TCH_Core_Router();
$router->run();
