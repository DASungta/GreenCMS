<?php
/**
 * Created by GreenStudio GCS Dev Team.
 * File: SystemController.class.php
 * User: Timothy Zhang
 * Date: 14-1-26
 * Time: 下午5:28
 */

namespace Admin\Controller;

use Common\Util\GreenMail;

/**
 * Class SystemController
 * @package Admin\Controller
 */
class SystemController extends AdminBaseController
{

    /**
     *
     */
    public function index()
    {
        $this->display();
    }

    public function attach()
    {
        $this->display();
    }

    public function user()
    {
        $role_list = array_column_5(D('Role')->select(), 'name', 'id');
        $this->assign('user_can_regist', get_opinion('user_can_regist', true, 1));
        $this->assign('new_user_role', gen_opinion_list($role_list, get_opinion('new_user_role', true, 5)));

        $this->display();

    }

    /**
     *
     */
    public function post()
    {
        $this->display();
    }

    /**
     *
     */
    public function saveHandle()
    {
        $this->saveConfigs();
        $this->success('配置成功');
    }

    /**
     *
     */
    public function kvset()
    {

        $this->display();
    }

    /**
     *
     */
    public function kvsetHandle()
    {
        S('kv_array', null); //清空缓存

        foreach ($_POST as $key => $value) {
            set_kv($key, $value);
        }

        $this->success('配置成功');
    }

    /**
     *
     */
    public function url()
    {
        //普通模式0, PATHINFO模式1, REWRITE模式2, 兼容模式3
        $url_model = get_opinion('url_model0');
        $home_post_model = get_opinion('post_model');
        $home_tag_model = get_opinion('tag_model');
        $home_cat_model = get_opinion('cat_model');

        $this->assign('home_post_model', gen_opinion_list($home_post_model, get_opinion('home_post_model', true)));
        $this->assign('home_tag_model', gen_opinion_list($home_tag_model, get_opinion('home_tag_model', true)));
        $this->assign('home_cat_model', gen_opinion_list($home_cat_model, get_opinion('home_cat_model', true)));

        $this->assign('url_mode', gen_opinion_list($url_model, (int)get_opinion('home_url_model', true)));

        $this->display();
    }

    /**
     * 邮箱配置
     */
    public function email()
    {
        $this->assign('mail_method', get_opinion('mail_method'));
        $this->display();
    }

    /**
     * 邮箱发送测试
     */
    public function emailSendTest()
    {
        $this->assign('action', '邮件发送测试');

        if (IS_POST) {

            $send_to = I('post.to_mail');

            $subject = "GreenCMS测试邮件";
            $body = "测试邮件通过" . get_opinion('mail_method') . '模式发送';
            $Mail = new GreenMail();
            $res = $Mail->sendMail($send_to, "GreenCMS Test Team", $subject, $body);

            $this->assign("config", $Mail->config);
            $this->assign("res", $res);
            $this->display('emailRes');

        } else {
            $this->display('emailTest');
        }

    }

    /**
     *
     */
    public function safe()
    {
        $this->display();
    }

    /**
     *
     */
    public function info()
    {
        if (function_exists('gd_info')) {
            $gd = gd_info();
            $gd = $gd ['GD Version'];
        } else {
            $gd = "不支持";
        }

        $able = get_loaded_extensions();
        $extensions_list = "";
        foreach ($able as $key => $value) {
            if ($key != 0 && $key % 13 == 0) {
                $extensions_list = $extensions_list . '<br />';
            }
            $extensions_list = $extensions_list . "$value&nbsp;&nbsp;";
        }

        $info = array(
            '操作系统' => PHP_OS,
            '主机名IP端口' => $_SERVER ['SERVER_NAME'] . ' (' . $_SERVER ['SERVER_ADDR'] . ':' . $_SERVER ['SERVER_PORT'] . ')',
            '运行环境' => $_SERVER ["SERVER_SOFTWARE"],
            '服务器语言' => getenv("HTTP_ACCEPT_LANGUAGE"),
            'PHP运行方式' => php_sapi_name(),
            '管理员邮箱' => $_SERVER['SERVER_ADMIN'],
            '程序目录' => WEB_ROOT,
            'MYSQL版本' => function_exists("mysql_close") ? mysql_get_client_info() : '不支持',
            'GD库版本' => $gd,
            '上传附件限制' => ini_get('upload_max_filesize'),
            'POST方法提交限制' => ini_get('post_max_size'),
            '脚本占用最大内存' => ini_get('memory_limit'),
            '执行时间限制' => ini_get('max_execution_time') . "秒",
            '浮点型数据显示的有效位数' => ini_get('precision'),
            '内存使用状况' => round((@disk_free_space(".") / (1024 * 1024)), 5) . 'M/',
            '已用/总磁盘' => round((@disk_free_space(".") / (1024 * 1024 * 1024)), 3) . 'G/' . round(@disk_total_space(".") / (1024 * 1024 * 1024), 3) . 'G',
            '服务器时间' => date("Y年n月j日 H:i:s 秒"),
            '北京时间' => gmdate("Y年n月j日 H:i:s 秒", time() + 8 * 3600),

            '显示错误信息' => ini_get("display_errors") == "1" ? '√' : '×',
            'register_globals' => get_cfg_var("register_globals") == "1" ? '√' : '×',
            'magic_quotes_gpc' => (1 === get_magic_quotes_gpc()) ? '√' : '×',
            'magic_quotes_runtime' => (1 === get_magic_quotes_runtime()) ? '√' : '×',

        );
        $this->assign('server_info', $info);
        $this->assign('extensions_list', $extensions_list);

        $this->display('info');
    }

    public function phpinfo()
    {
        $this->show(phpinfo());
    }

    public function db()
    {

        $this->assign('db_path', DB_Backup_PATH);
        $this->display();

    }

    public function cache()
    {
        $this->assign('HTML_CACHE_ON', (int)get_opinion('HTML_CACHE_ON', true));
  //        $this->assign('DATA_CACHE_TYPE', gen_opinion_list(get_opinion("cache_type"), get_opinion('DATA_CACHE_TYPE', true, "File")));

        $this->display();
    }

}