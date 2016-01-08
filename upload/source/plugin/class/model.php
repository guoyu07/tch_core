<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * 模型类，Db模型
 * @package tch.core
 */
class TCH_Core_Model {
    
    protected $_table;
    protected $_pk;

    /**
     * 将任意的查询语句转换成count预计
     * @param string $sql
     * @return string
     */
    public function buildCountSql($sql) {
        $sql = preg_replace("#SELECT[ \r\n\t](.*)[ \r\n\t]FROM#is", 'SELECT COUNT(*) AS COUNT FROM', $sql);
        $sql = preg_replace("#ORDER[ \r\n\t]{1,}BY(.*)#is", '', $sql);
        return $sql;
    }

    /**
     * 获取一条数据
     * @param     string|array    $condition
     * @param     string    $field
     * @return    array
     */
    public function fetch($condition = '1=1', $field = '*') {
        $row = DB::fetch_first("SELECT $field FROM %t WHERE " . $this->buildWhereStr($condition), array($this->_table));

        return $row;
    }

    /**
     * 返回指定条件的记录数
     * @param string $condition
     * @return int
     */
    public function count($condition = '1=1') {
        $row = DB::result_first("SELECT count(*) as count FROM %t WHERE " . $this->buildWhereStr($condition), array($this->_table));

        return (int) $row;
    }

    /**
     * 获取全部数据，适用于少量数据
     * @param string|array $condition 条件
     * @param string $field 字段
     * @param string $pageIndex 页码
     * @param string $pageSize 每页数量
     * @param string $orderBy 排序
     * @param string $keyField 用作键名的字符串
     * @return array
     */
    public function fetchAll($condition = '1=1', $field = '*', $pageIndex = 1, $pageSize = 500, $orderBy = '', $keyField = '') {

        $limit = DB::limit((max($pageIndex, 1) - 1) * $pageSize, $pageSize);
        $sql = "SELECT $field FROM %t WHERE " . $this->buildWhereStr($condition) . " $orderBy $limit";
        $data = DB::fetch_all($sql, array($this->_table), $keyField);

        return $data;
    }

    /**
     * 根据条件更新数据
     * @param string|array $condition
     * @param array $data 可以数组也可以字符串形式，数组必须成对
     * @return boolean|int 成功则返回影响的条数
     */
    public function update($condition = "", $data = array()) {
        if (empty($data)) {
            return false;
        }

        $ret = DB::update($this->_table, $data, $condition);

        return $ret;
    }

    /**
     * 删除指定条件下的记录
     * @param string|array $condition
     * @return int 返回影响条数
     */
    public function delete($condition = "1") {
        $ret = DB::delete($this->_table, $condition);

        return $ret;
    }

    /**
     * 构造where条件的语句，从database类中提取出来的语句
     * @param mixed $condition
     * $condition 支持两种格式：
     * 第一种：
     * $id = 500;
     * $sids = array(4,5,6);
     * $condition = array(
     *      'where' => ' id < %d and sid in ($n)',
     *      'arg' => array($id, $sids)
     * );
     * 第二种：
     * $id = 500;
     * $sid = 6;
     * $condition = array(
     *      'id' => $id,
     *      'sid' => $sid
     * );
     * @return string
     */
    protected function buildWhereStr($condition = '') {
        if (is_array($condition)) {
            if (count($condition) == 2 && isset($condition['where']) && isset($condition['arg'])) {
                $where = DB::format($condition['where'], $condition['arg']);
            } else {
                $where = DB::implode_field_value($condition, ' AND ');
            }
        } else {
            $where = $condition;
        }
        return $where;
    }

}
