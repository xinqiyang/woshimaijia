<?php

// +----------------------------------------------------------------------
// | WoShiMaiJia Projcet 
// +----------------------------------------------------------------------
// | Copyright (c) 2010-2011 http://woshimaijia.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: xinqiyang <xinqiyang@gmail.com>
// +----------------------------------------------------------------------


class ResourceService {

    public static function upload($module = '', $thumb = true, $width = 120, $height = 120) {
        $module = $module == '' ? 'temp' : $module;
        $path = C(ATTACHDIR) . DIRECTORY_SEPARATOR . '' . $module . DIRECTORY_SEPARATOR . 'mpic' . DIRECTORY_SEPARATOR;
        $spath = C(ATTACHDIR) . DIRECTORY_SEPARATOR . '' . $module . DIRECTORY_SEPARATOR . 'spic' . DIRECTORY_SEPARATOR;
        if (!is_dir($path))
            @mk_dir($path);
        if (!is_dir($spath))
            @mk_dir($spath);
        import("ORG.Net.UploadFile");
        $upload = new UploadFile();

        $upload->maxSize = 3145728; //3M
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->savePath = $path;
        $upload->saveRule = 'uniqid';

        if ($thumb) {
            $upload->thumb = true;
            $upload->thumbPrefix = '';
            $upload->thumbPath = $spath;
            $upload->thumbMaxWidth = $width;
            $upload->thumbMaxHeight = $height;
        }
        if (!$upload->upload()) {
            //捕获上传异常
            $upl = $upload->getErrorMsg();
        } else {
            $upl = $upload->getUploadFileInfo();
        }
        //判断结果,插入数据库
        if (is_array($upl)) {
            //插入图片表
            $img = M('image');

            $imgdata['model'] = $module;
            $imgdata['createtime'] = time();
            $imgdata['status'] = '1';
            $imgdata['url'] = C('ATTACHDIR');
            $imgdata['user_id'] = $this->getuid();
            $count = count($upl);
            //dump($count);
            if ($count == 1) {
                $imgdata['filename'] = $upl[0]['savename'];
                $imgid = $img->add($imgdata);
                return $imgid;
            } else {
                $str = '(';
                $counts = 0;
                for ($i = 0; $i < $count; $i++) {
                    //dump($upl[$i]['savename']);
                    $imgdata['filename'] = $upl[$i]['savename'];
                    $imgid = $img->add($imgdata);
                    if ($imgid) {
                        $str .= "'" . $imgid . "',";
                        $counts++;
                    }
                }
                if ($counts) {
                    //更新图片表
                    return substr($str, 0, -1) . ')';
                }
            }
        } else {
            //返回上传出错信息
            return $upl;
        }
    }

}