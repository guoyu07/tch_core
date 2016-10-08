<?php

if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

/**
 * 后台帮助中心控制器
 * @package tch.core.control.admin
 */
class TCH_Core_Controller_Admin_Help extends TCH_Core_AdminControl {
    
    /**
     * 默认动作
     */
    public function index() {
        require_once TCH_CORE_ROOT . '/vendor/Parsedown.php';
        
        $content = Parsedown::instance()->parse(file_get_contents(TCH_CORE_ROOT . '/template/admin/doc/readme.md'));
        $this->setVar('content', $content);
        $this->display();
    }
}