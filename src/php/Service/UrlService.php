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

class UrlService {

    public static function actAddUrl($array) {
        $code = Error::PARAM_ERROR;
        $data = '';
        if (!empty($array['title']) && !empty($array['account_id']) && !empty($array['siteurl'])) {
            extract($array);
            $openapi = !empty($openapi) ? $openapi : '';
            $image_id = !empty($image_id) ? $image_id : 0;
            if (preg_match('/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/', $siteurl) === 1) {
                $r = UrlLogic::setUrl($title,$siteurl,$account_id, $image_id, $openapi);
                $code = $r['code'];
                $data = $r['data'];
            } else {
                $code = Error::URL_NOT_AVALIDE;
            }
        }
        return array('code' => $code, 'data' => $data);
    }
}