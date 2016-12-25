<?php
/**
 * Created by GreenStudio GCS Dev Team.
 * File: UpdateEvent.class.php
 * User: Timothy Zhang
 * Date: 14-3-17
 * Time: 下午9:18
 */

namespace Common\Event;

use Common\Controller\BaseController;
use Common\Util\File;

/**
 * 升级事件
 * Class UpdateEvent
 * @package Common\Event
 */
class UpdateEvent extends BaseController
{


    public function applyZipPatch($filename)
    {
        $System = new SystemEvent();

        $zip = new \ZipArchive; //新建一个ZipArchive的对象
        if ($zip->open($filename) === true) {
            $zip->extractTo(WEB_ROOT); //假设解压缩到在当前路径下/文件夹内
            $zip->close(); //关闭处理的zip文件
            File::delFile($filename);
            $System->clearCacheAll();
            return $this->jsonResult(1, "安装成功");

        } else {
            return $this->jsonResult(0, "文件损坏");
        }


    }

}