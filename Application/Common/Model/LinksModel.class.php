<?php
/**
 * Created by GreenStudio GCS Dev Team.
 * File: LinksModel.class.php
 * User: Timothy Zhang
 * Date: 14-1-16
 * Time: 上午12:27
 */

namespace Common\Model;

use Think\Model\RelationModel;

/**
 * 链接模型定义
 * Class LinksModel
 * @package Home\Model
 */
class LinksModel extends RelationModel
{

    /**
     * @var bool
     */
    protected $autoCheckFields = false;

    public $_link = array(
        'Group' => array(

            'mapping_type' => self::BELONGS_TO,

            'class_name' => 'Link_group',

            'mapping_name' => 'link_group',

            'mapping_key' => 'link_group_id',

            'foreign_key' => 'link_group_id',

            'parent_key' => 'link_group_id',

            'mapping_order' => 'link_group_id',

            'mapping_limit' => 0,

        )
    );

    /**
     * Add Link
     * @param $data
     *
     * @return bool
     *
     * @cache_key link_detail_id_$link_id
     */
    public function addLink($data)
    {
        if ($this->data($data)->add()) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Update Link
     * @param $data
     *
     * @return bool
     *
     * @cache_key link_detail_id_$link_id
     */
    public function updateLink($data)
    {
        if ($this->data($data)->save()) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Delete link
     * @param int $link_id id to be deleted
     *
     * @return bool true for success
     */
    public function delLink($link_id)
    {
        if ($this->where(array('link_id' => $link_id))->delete()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Fetch link detail
     * @param int $link_id id to be deleted
     *
     * @return mixed
     *
     * @cache_key link_detail_id_$link_id
     */
    public function detailLink($link_id)
    {
        $link_list = $this->where(array('link_id' => $link_id))->find();
        return $link_list;
    }

}