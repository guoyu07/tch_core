<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * 路由调度
 * @package tch.core
 */
class TCH_Core_Router {
    
    /**
     * 
     * @var string 控制器
     */
    protected $ctrl;
    
    /**
     *
     * @var string 动作
     */
    protected $act;
    
    protected $controlKey = 'ac';
    protected $actionKey = 'op';

    protected $defaultControl = 'main';
    protected $defaultAction = 'index';

    /**
     * 构造函数
     */
    public function __construct() {
        $this->parse();
    }
    
    /**
     * 解析用户的请求,确定控制器与动作
     * @return void
     */
    protected function parse() {
        if (defined('CURMODULE')) {//前端访问 从插件id参数中解析
            list(, $ctrl) = explode(':', $_GET['id']);
            
            $this->ctrl = $ctrl;
        } else {
            $this->ctrl = !empty($_GET[$this->controlKey]) ? preg_replace("/[^0-9a-z_]/i", '', trim($_GET[$this->controlKey])) : '';
        }
        if (empty($this->ctrl)) {
            $this->ctrl = $this->defaultControl;
        }
        
        $this->act = !empty($_GET[$this->actionKey]) ? preg_replace("/[^0-9a-z_]/i", '', trim($_GET[$this->actionKey])) : '';
        if (empty($this->act)) {
            $this->act = $this->defaultAction;
        }
    }
    
    /**
     * 根据请求调度相应的控制器动作
     * @param string $ctrl 控制器
     * @param string $act 动作
     * @return void 
     * @throws Exception
     */
    public function run($ctrl = null, $act = null) {
        if ($ctrl) $this->ctrl = $ctrl;
        if ($act) $this->act = $act;
        
        $ac_class = $this->getControlClass($this->ctrl);
        if (!class_exists($ac_class)) {
            writelog('tch.core', "control {$this->ctrl} : {$ac_class} not found.");
            throw new Exception("control {$this->ctrl} not found.", 404);
        }
        
        $obj = new $ac_class($this);
        if (!method_exists($obj, $this->act)) {
            writelog('tch.core', "action {$this->act} not found.");
            throw new Exception("action {$this->act} not found.", 404);
        }
        
        call_user_method($this->act, $obj);
    }
    
    /**
     * 根据控制器标识名构造完整的类名
     * @param string $ctrl
     * @return string
     */
    protected function getControlClass($ctrl) {
        return TCH_APP_ID . '_Controller_' . ucwords($ctrl);
    }

    /**
     * 获取控制器标识
     * @return string 返回控制器标识
     */
    public function getControl() {
        return $this->ctrl;
    }
    
    /**
     * 获取动作标识
     * @return string 返回动作标识
     */
    public function getAction() {
        return $this->act;
    }

    /**
     * 构建url
     * @param string $route 'students/add'
     * @param array $params 如array('name' => 'jimmy')
     * @param string $host 另行指定url中的host部分
     */
    public function url($route, $params = array(), $host = '') {
        $_params = array();
        
        list($ac, $op) = explode('/', $route);
        if ($ac) {
            $_params[$this->controlKey] = $ac;
        }
        if ($op) {
            $_params[$this->actionKey] = $op;
        }
        
        return 'plugin.php?id=' . TCH_APP_ID 
                . '&' . http_build_query(array_merge($_params, $params));
    }
}