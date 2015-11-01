<?php
/**
 * Created by PhpStorm.
 * User: Timothy Zhang
 * Date: 14-6-21
 * Time: 下午8:17
 */

namespace Common\Logic;


use Common\Model\LogModel;
use Think\Model\RelationModel;

class LogLogic extends LogModel
{

    public function countLog($where)
    {
        return $this->where($where)->count();
    }

    public function addLog($group_name = '', $module_name = '', $action_name = '', $message = '', $log_type = 1)
    {
        $log_data['user_id'] = get_current_user_id();
        $log_data['group_name'] = $group_name;
        $log_data['module_name'] = $module_name;
        $log_data['action_name'] = $action_name;
        $log_data['message'] = $message;
        $log_data['log_type'] = $log_type;
        $insert_res = $this->data($log_data)->add();
        return $insert_res;
    }

    public function getLogList($limit = 0, $where = array(), $relation = true)
    {
        $log_list = $this->where($where)->limit($limit)->relation($relation)->select();

        return $log_list;
    }
}