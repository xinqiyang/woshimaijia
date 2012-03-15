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

class ImageLogic extends BaseLogic {

    public static function setImage($id, $account_id, $filename = '', $source = 'web', $desc = '', $remoteurl = '', $url = '') {
        $code = error::PARAM_ERROR;
        $data = '';
        $array = array();
        $array['id'] = $id;
        $filename = empty($filename) ? $array['id'] : $filename;
        $array['filename'] = $filename;
        $array['desc'] = $desc;
        $array['status'] = 0;
        $array['source'] = $source;
        $array['remoteurl'] = $remoteurl;
        $array['url'] = $url;
        $array['account_id'] = $account_id;
        if (self::add('image', $array)) {
            $data = $id;
            logDebug('add new picture %s',$id);
            $code = Error::SUCCESS;
        }else{
            $code = Error::BUSY;
        }
        return array('data'=>$data,'code'=>$code);
    }
}