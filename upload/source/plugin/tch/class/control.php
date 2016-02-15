<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * 控制器父类
 * @package tch.core
 */
class TCH_Core_Control {

    /**
     *
     * @var TCH_Core_Router
     */
    protected $router;
    
    /**
     * 视图要用的变量全部存到这里
     * @var array 
     */
    protected $vars = array();

    /**
     * 构造函数
     * @param TCH_Core_Router $router 路由解析类示例
     */
    public function __construct(TCH_Core_Router &$router) {
        $this->router = $router;
    }

    /**
     * 对TCH_Core_Router::url 方法进行封装
     * @param string $route
     * @param array $params
     * @param string $host
     * @return string
     */
    protected function url($route, $params = array(), $host = '') {
        return $this->router->url($route, $params, $host);
    }

    /**
     * 获取当前控制器标识名称
     * @return string
     */
    protected function getControl() {
        return $this->router->getControl();
    }

    /**
     * 获取当前动作标识名称
     * @return string
     */
    protected function getAction() {
        return $this->router->getAction();
    }
    
    /**
     * 完整的route标识,用于在视图中做状态判断
     * @return string 如 'class/create'
     */
    protected function getRoute() {
        return $this->router->getControl() . '/' . $this->router->getAction();
    }

    /**
     * 设置视图中要用的各种变量
     * @param string $k 变量名
     * @param string $v 变量值
     * @return void 
     */
    public function setVar($k, $v) {
        $this->vars[$k] = $v;
    }
    
    /**
     * 引入模版显示
     * @param string $tpl 模板文件名 不含后缀
     */
    protected function display($tpl = '') {
        global $_G;

        extract($this->vars);
        
        include template($this->getTplFile($tpl));
    }

    /**
     * 构造当前模块下指定模版文件名
     * @param string $tpl_name
     * @return string
     */
    protected function getTplFile($tpl_name = '') {
        return TCH_APP_ID . ':' . $this->getControl() . '_' . ($tpl_name ? $tpl_name : $this->getAction());
    }

}
