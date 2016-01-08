<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * 后台控制器父类
 */
class TCH_Core_AdminControl extends TCH_Core_Control {
    
    /**
     * 引入模版显示
     * @param string $tpl 模板文件名 不含后缀
     */
    protected function display($tpl = '') {
        global $_G;

        extract($this->vars);
        
        include TCH_CORE_ROOT . $this->getTplFile($tpl);
    }
    
    /**
     * 构造当前模块下指定模版文件名
     * @param string $tpl_name
     * @return string
     */
    protected function getTplFile($tpl_name = '') {
        return '/template/admin/' . $this->getControl() . '_' 
                . ($tpl_name ? $tpl_name : $this->getAction()) . '.tpl.php';
    }
}