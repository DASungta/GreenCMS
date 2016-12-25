<?php
/**
 * Created by GreenStudio GCS Dev Team.
 * File: IndexController.class.php
 * User: Timothy Zhang
 * Date: 14-1-25
 * Time: 上午10:38
 */

namespace Admin\Controller;

use Common\Event\AccessEvent;
use Common\Event\CountEvent;
use Common\Event\UpdateEvent;

/**
 * Class IndexController
 * @package Admin\Controller
 */
class IndexController extends AdminBaseController
{
    /**
     * 首页基本信息
     */
    public function index()
    {
        $CountEvent = new CountEvent();

        $this->assign("PostCount", $CountEvent->getPostCount());
        $this->assign("UserCount", $CountEvent->getUserCount());

        $this->assign("GreenCMS_Version", GreenCMS_Version);
        $this->assign("GreenCMS_Build", GreenCMS_Build);

        if (get_opinion("oem_info", false, 'original') != 'original') {
            $this->display("oem");
        } else {
            $this->display();
        }

    }

    /**
     * 返回home
     */
    public function main()
    {
        $this->redirect('Home/Index/index');
    }

}