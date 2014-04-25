<?php
$viewlist = array(
    'mshare'    => '一键分享',
    'qzone'     => 'QQ空间',
    'tsina'     => '新浪微博',
    'baidu'     => '百度搜藏',
    'renren'    => '人人网',
    'tqq'       => '腾讯微博',
    'bdxc'      => '百度相册',
    'kaixin001' => '开心网',
    'tqf'       => '腾讯朋友',
    'tieba'     => '百度贴吧',
    'douban'    => '豆瓣网',
    'tsohu'     => '搜狐微博',
    'bdhome'    => '百度新首页',
    'sqq'       => 'QQ好友',
    'thx'       => '和讯微博',
    'qq'        => 'QQ收藏',
    'taobao'    => '我的淘宝',
    'hi'        => '百度空间',
    'bdysc'     => '百度云收藏',
    'msn'       => 'MSN',
    'sohu'      => '搜狐白社会',
    't163'      => '网易微博',
    'qy'        => '奇艺奇谈',
    'meilishuo' => '美丽说',
    'mogujie'   => '蘑菇街',
    'diandian'  => '点点网',
    'huaban'    => '花瓣',
    'leho'      => '爱乐活',
    'share189'  => '手机快传',
    'duitang'   => '堆糖',
    'hx'        => '和讯',
    'tfh'       => '凤凰微博',
    'fx'        => '飞信',
    'youdao'    => '有道云笔记',
    'sdo'       => '麦库记事',
    'qingbiji'  => '轻笔记',
    'ifeng'     => '凤凰快博',
    'people'    => '人民微博',
    'xinhua'    => '新华微博',
    'ff'        => '饭否',
    'mail'      => '邮件分享',
    'kanshou'   => '搜狐随身看',
    'isohu'     => '我的搜狐',
    'yaolan'    => '摇篮空间',
    'wealink'   => '若邻网',
    'tuita'     => '推他',
    'xg'        => '鲜果',
    'ty'        => '天涯社区',
    'fbook'     => 'Facebook',
    'twi'       => 'Twitter',
    'ms'        => 'Myspace',
    'deli'      => 'delicious',
    's51'       => '51游戏社区',
    's139'      => '139说客',
    'linkedin'  => 'linkedin',
    'copy'      => '复制网址',
    'print'     => '打印',
    'ibaidu'    => '百度个人中心',
    'weixin'    => '微信',
    'iguba'     => '股吧'
);

return array(
    'group' => array(
        'type'    => 'group',
        'options' => array(
            'button' => array(
                'title'   => '分享按钮配置',
                'options' => array(
                    'openbutton'  => array(
                        'title'   => '是否开启按钮分享',
                        'type'    => 'radio',
                        'options' => array(
                            '0' => '开启',
                            '1' => '关闭'
                        ),
                        'value'   => '1'
                    ),
                    'buttonlist'  => array(
                        'title'   => '分享的媒体',
                        'type'    => 'checkbox',
                        'options' => $viewlist,
                        value     => array(
                            'mshare',
                            'qzone',
                            'tsina',
                            'renren',
                            'tqq',
                            'tieba'
                        )
                    ),
                    'button_size' => array(
                        'title'   => '图标大小:',
                        'type'    => 'radio',
                        'options' => array(
                            '16' => '16*16',
                            '24' => '24*24',
                            '32' => '32*32'
                        ),
                        'value'   => '1',
                        'tip'     => '分享按钮图片大小'
                    ),

                )
            ),
            'img'    => array(
                'title'   => '图片分享配置',
                'options' => array(
                    'openimg'  => array(
                        'title'   => '是否开启图片分享',
                        'type'    => 'radio',
                        'options' => array(
                            '0' => '开启',
                            '1' => '关闭'
                        ),
                        'value'   => '0'
                    ),
                    'imglist'  => array(
                        'title'   => '分享的媒体',
                        'type'    => 'checkbox',
                        'options' => $viewlist,
                        value     => array(
                            'mshare',
                            'qzone',
                            'tsina',
                            'renren',
                            'tqq',
                            'tieba'
                        )
                    ),
                    'img_size' => array(
                        'title'   => '图标大小:',
                        'type'    => 'radio',
                        'options' => array(
                            '16' => '16*16',
                            '24' => '24*24',
                            '32' => '32*32'
                        ),
                        'value'   => '1',
                        'tip'     => '图片分享按钮大小'
                    ),

                )
            ),
            'select' => array(
                'title'   => '划词分享配置',
                'options' => array(
                    'openselect' => array(
                        'title'   => '是否开启划词分享',
                        'type'    => 'radio',
                        'options' => array(
                            '0' => '开启',
                            '1' => '关闭'
                        ),
                        'value'   => '0'
                    ),
                    'selectlist' => array(
                        'title'   => '分享的媒体',
                        'type'    => 'checkbox',
                        'options' => $viewlist,
                        value     => array(
                            'mshare',
                            'qzone',
                            'tsina',
                            'renren',
                            'tqq',
                            'tieba'
                        )
                    ),

                )
            ),
        )
    )
);
					