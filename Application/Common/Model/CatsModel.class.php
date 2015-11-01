<?php
/**
 * Created by GreenStudio GCS Dev Team.
 * File: CatsModel.class.php
 * User: Timothy Zhang
 * Date: 14-1-16
 * Time: 上午12:34
 */

namespace Common\Model;

use Common\Model;
use Think\Model\RelationModel;

/**
 * 分类模型定义
 * Class CatsModel
 * @package Home\Model
 */
class CatsModel extends RelationModel
{

    /**
     * @var array
     */
    public $_link = array(
        'Post_cat' => array(

            'mapping_type' => self::HAS_MANY,

            'class_name' => 'Post_cat',

            'mapping_name' => 'cat_post',

            'foreign_key' => 'cat_id',

            'parent_key' => 'cat_id',

            'mapping_order' => 'cat_id',

            'mapping_limit' => 0,
        ),

    );


    /**
     * Category Count
     * @public param string $type
     * @return int
     *
     * @cache_key cats_countAll
     */
    public function countAll()
    {
        $count = $this->count();
        return $count;
    }


    /**
     * Category Count with filter info
     * @param array $info_with
     * @param array $ids id array to be limited
     *
     * @return int
     */
    public function countWithInfo($info_with = array(), $ids = array())
    {
        if (!empty($ids)) $info_with['cat_id'] = array('in', $ids);
        return $this->where($info_with)->count();
    }


    /**
     * get Category Raw List
     * @param int $limit limit
     *
     * @return mixed
     *
     * @cache_key cats_rawList_limit_$limit
     */
    public function rawList($limit = 20)
    {
        return $this->limit($limit)->select();
    }

    /**
     * get post_id by cat_id
     * @param $cat_id
     * @return mixed
     *
     */
    public function getPostCatRelation($cat_id)
    {
        //TODO Post_cat
        //     * @cache_key post_cat_cat_$cat_id

        return D('Post_cat')->where(array('cat_id' => $cat_id))->select();
    }


}