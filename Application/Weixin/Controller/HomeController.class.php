<?php
/**
 * Created by GreenStudio GCS Dev Team.
 * File: HomeController.class.php
 * User: Timothy Zhang
 * Date: 14-2-20
 * Time: 下午5:05
 */

namespace Weixin\Controller;


class HomeController extends WeixinBaseController
{
    public function index()
    {
        $action = '首页';
        $action_url = U('Weixin/Home/index');


        $this->assign('action', $action);
        $this->assign('action_url', $action_url);

        $this->display();
    }


}