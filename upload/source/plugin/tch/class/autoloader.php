<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * 类自动加载
 * @package tch.core
 */
class TCH_Core_Autoloader {

    private $_dir;
    private $_pluginId;

    /**
     * 构造函数
     * @param string $pluginId 手动指定插件目录 为null时加载框架自身
     * @param string $dir 手动指定起始目录
     */
    public function __construct($pluginId = null, $dir = null) {
        if (is_null($dir)) {
            $dir = dirname(__FILE__);
        }
        $this->_dir = $dir;
        
        $this->_pluginId = $pluginId ? $pluginId : TCH_CORE_ID;
    }

    /**
     * 向PHP注册SPL autoloader
     */
    public static function register($pluginId = null, $dir = null) {
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        
        spl_autoload_register(array(new self($pluginId, $dir), 'autoload'), FALSE, TRUE);
    }

    /**
     * 系统自动注册
     *
     * @param string $class 类名
     *
     * @return boolean 正常加载返回true
     */
    public function autoload($class) {
        if (0 !== stripos($class, $this->_pluginId)) {
            return false;
        }

        if (file_exists($file = $this->_dir . '/' 
                . str_replace('_', '/', strtolower(str_ireplace($this->_pluginId 
                        . '_', '', $class))) . '.php')) {
            require_once $file;
            
            return true;
        }
        
        return false;
    }

}
