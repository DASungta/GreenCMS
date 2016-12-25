<?php
/**
 * Created by PhpStorm.
 * User: TianShuo
 * Date: 2015/8/12
 * Time: 17:11
 */

namespace Admin\Controller;
use Common\Event\CountEvent;

class MemberController extends AdminBaseController
{

    /**
     * 修改密码页面
     */
    public function changePass()
    {
        $this->display('changepass');
    }

    /**
     * 修改密码处理
     */
    public function changepassHandle()
    {

        if (I('post.password') != I('post.rpassword')) {
            $this->error('两次密码不同');
        }

        $uid = $this->_currenUserId();

        $res = $this->UserLogic->changePassword($uid, I('post.opassword'), I('post.password'));

        $this->array2Response($res);

    }

    /**
     * 用户信息
     */
    public function profile()
    {
        $CountEvent = new CountEvent();

        $this->assign("PostCount", $CountEvent->getPostCount(array("user_id" => $this->_currenUserId())));

        $this->display();
    }

    /**
     * 用户信息信息保存
     * @param $uid int user_id
     */
    public function profileHandle($uid)
    {
        $this->_checkCurrentUser($uid);

        $post_data = I('post.');

        $res = $this->UserLogic->updateUser($uid, $post_data);

        $this->array2Response($res);

    }

}