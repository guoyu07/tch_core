<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * 后台的调度
 */
class TCH_Core_AdminRouter extends TCH_Core_Router {
    
    protected $controlKey = 'pmod';
    protected $actionKey = 'act';
    
    /**
     * 根据控制器标识名构造完整的类名
     * @param string $ctrl
     * @return string
     */
    protected function getControlClass($ctrl) {
        return TCH_APP_ID . '_Controller_Admin_' . ucwords($ctrl);
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
        
        return ADMINSCRIPT . '?action=plguins&operation=config&identifier=' 
          . TCH_APP_ID . '&' . http_build_query(array_merge($_params, $params));
    }
    
}

