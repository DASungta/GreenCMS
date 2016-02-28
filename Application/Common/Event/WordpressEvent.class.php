<?php
/**
 * Created by GreenStudio GCS Dev Team.
 * File: WordpressEvent.class.php
 * User: Timothy Zhang
 * Date: 14-2-20
 * Time: 上午11:23
 */

namespace Common\Event;

use Common\Util\File;
use SimpleXMLElement;
use Think\Log;


/**
 * Wordpress导入工具
 * Class WordpressEvent
 * @package Common\Event
 */
class WordpressEvent
{

    /**
     * @var null
     */
    private $file;

    /**
     * @param null $file
     */
    function __construct($file = null)
    {
        $this->file = $file;
    }


    public function getStringFromCDATA($item)
    {
        return simplexml_load_string($item->asXML(), 'SimpleXMLElement', LIBXML_NOCDATA)->__toString();
    }

    /**
     * @param $filename
     */
    public function postImport($filename)
    {

        if (!file_exists($filename)) exit();


        $file_content = File::readFile($filename);
        $wordpress_xml = new \SimpleXMLElement($file_content);

        // $wordpress_xml = simplexml_load_file($filename);

        $namespaces = $wordpress_xml->getNamespaces(true);
        $wordpress_channel = $wordpress_xml->channel;
        foreach ($namespaces as $key => $value) {
            $wordpress_channel->registerXPathNamespace($key, $value);
        }


        $items = $wordpress_channel->xpath('item');

        foreach ($items as $key => $value) {
            $post_cat_temp = array();
            $post_tag_temp = array();


//            dump($value);

            $value_wp = $value->children('wp', true);
            $value_wp->post_type = (string)$value_wp->post_type;
            $value_wp->post_date = (string)$value_wp->post_date;
            $value_wp->post_name = (string)$value_wp->post_name;
            $value_wp->status = (string)$value_wp->status;


            if ($value_wp->post_type == 'post') {
               $post_content = $value->children('content', true)->encoded;
 //
 //                 dump($value_wp);
                $value_wp = object_to_array($value_wp);
                //   dump($value);


                $post_temp = array();
                $post_temp['user_id'] = 1;
                $post_temp['post_content'] = (string)$post_content;
                $post_temp['post_id'] = (int)$value_wp['post_id'];
                $post_temp['post_title'] = (string)$value->title;
                $post_temp['post_status'] = "publish";
                $post_temp['post_date'] = $value_wp['post_date'];
                $post_temp['post_modified'] = $value_wp['post_date'];
                $post_temp['post_type'] = 'single';
                $post_temp['post_name'] = $value_wp['post_name'];

//                dump($post_temp);

                $tag_cat = $value->category;

                foreach ($tag_cat as $key => $value) {
                    $value = object_to_array($value);

                    if ($value["@attributes"]["domain"] == 'category') {
                        $nicename = D('Cats', 'Logic')->detail($value["@attributes"]["nicename"]);
                        $cat_id = (int)$nicename['cat_id'];
                        if ($cat_id != 0) {
                            array_push($post_cat_temp, $cat_id);
                        }
                    } elseif ($value["@attributes"]["domain"] == 'post_tag') {
                        $nicename = D('Tags', 'Logic')->detail($value["@attributes"]["nicename"]);
                        $tag_id = (int)$nicename['tag_id'];
                        if ($tag_id != 0) {
                            array_push($post_tag_temp, $tag_id);
                        }
                    } else {
                        Log::record('No match ');
                    }

                }

                $post_id = D('Posts', 'Logic')->data($post_temp)->add();

                Log::record('插入ID为' . $post_id . "的文章");

                foreach ($post_cat_temp as $cat_id) {

                    Log::record('插入ID为' . $post_id . "的文章关联CAT ID为:" . $cat_id);

                    D('Post_cat')->data(array('post_id' => $post_id, 'cat_id' => $cat_id))->add();

                }

                foreach ($post_tag_temp as $tag_id) {
                    Log::record('插入ID为' . $post_id . "的文章关联TAG ID为:" . $tag_id);

                    D('Post_tag')->data(array('post_id' => $post_id, 'tag_id' => $tag_id))->add();

                }


            }


        }


    }

    /**
     * @param $filename
     */
    public function tagImport($filename)
    {
        if (!file_exists($filename)) exit();

        $file_content = File::readFile($filename);

        $wordpress_xml = new \SimpleXMLElement($file_content);

        $namespaces = $wordpress_xml->getNamespaces(true);
        $wordpress_channel = $wordpress_xml->channel;
        foreach ($namespaces as $key => $value) {
            $wordpress_channel->registerXPathNamespace($key, $value);
        }

        $tags = $wordpress_channel->xpath('wp:tag');

        foreach ($tags as $key => $value) {

            $value_wp = $value->children('wp', true);
            $value_wp->tag_slug = $this->getStringFromCDATA($value_wp->tag_slug);
            $value_wp->tag_name = $this->getStringFromCDATA($value_wp->tag_name);

            if ($value_wp->tag_slug != '') {

                $item = object_to_array($value_wp);
                $tag_temp = array();
                $tag_temp['tag_id'] = $item['term_id'];
                $tag_temp['tag_slug'] = $item['tag_slug'];
                $tag_temp['tag_name'] = $item['tag_name'];

                D('Tags', 'Logic')->data($tag_temp)->add();

            }

        }

    }


    /**
     * @param $filename
     */
    public function catImport($filename)
    {
        if (!file_exists($filename)) exit();

        $file_content = File::readFile($filename);

        $wordpress_xml = new \SimpleXMLElement($file_content);

        $namespaces = $wordpress_xml->getNamespaces(true);
        $wordpress_channel = $wordpress_xml->channel;
        foreach ($namespaces as $key => $value) {
            $wordpress_channel->registerXPathNamespace($key, $value);
        }

        $cats = $wordpress_channel->xpath('wp:category');

        //    dump($cats);
        foreach ($cats as $key => $value) {

            $value_wp = $value->children('wp', true);
//            $value_wp = object_to_array($value_wp);

            $value_wp->category_nicename = $this->getStringFromCDATA($value_wp->category_nicename);
            $value_wp->category_parent = $this->getStringFromCDATA($value_wp->category_parent);
            $value_wp->cat_name = $this->getStringFromCDATA($value_wp->cat_name);

//           dump($value_wp);

            if ($value_wp->category_nicename != '') {

                $item = object_to_array($value_wp);

                $cat_temp = array();
                $cat_temp['cat_id'] = $item['term_id'];
                $cat_temp['cat_slug'] = $item['category_nicename'];
                $cat_temp['cat_name'] = $item['cat_name'];
                $cat_father = D('Cats', 'Logic')->detail($item['category_parent']);
                $cat_temp['cat_father'] = (int)$cat_father['cat_id'];

                D('Cats', 'Logic')->data($cat_temp)->add();

            } else {
//                dump($value_wp);
            }

        }
    }

}