<?php
/**
 * Created by GreenStudio GCS Dev Team.
 * File: LinksLogic.class.php
 * User: Timothy Zhang
 * Date: 14-1-16
 * Time: 上午12:29
 */

namespace Common\Logic;

use Common\Model\LinksModel;

/**
 * Class LinksLogic
 * @package Home\Logic
 */
class LinksLogic extends LinksModel
{



    /**
     * 获取list
     * @param int $limit 限制
     * @param int $link_group_id
     * @param string $order 顺序
     *
     * @internal param int $tag 标签
     * @return mixed 如果找到返回数组
     */
    public function getList($limit = 10, $link_group_id = 0, $order = 'link_sort desc ,link_id asc')
    {
        $condition['link_group_id'] = $link_group_id;

        //兼容旧版本
        if ($link_group_id == 0) {
            $condition = "link_group_id is null or link_group_id=0";
        }
        $link_list = D('Links')->where($condition)->order($order)->limit($limit)->relation(true)->select();

        return $link_list;
    }





}