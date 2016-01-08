<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * 默认前台控制器
 * @package tch.core.control
 */
class TCH_Core_Controller_Main extends TCH_Core_Control {
    
    /**
     * 默认动作
     */
    public function index() {
        $this->display();
    }
}