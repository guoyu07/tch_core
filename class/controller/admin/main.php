<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

/**
 * 框架后台默认控制器
 * @package tch.core.control.admin
 */
class TCH_Core_Controller_Admin_Main extends TCH_Core_AdminControl {
    
    public function index() {
        $this->display();
    }
}