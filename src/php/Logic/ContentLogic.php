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

class ContentLogic extends BaseLogic {

    public static function setContent($module, $action, $title, $tags, $desc, $content, $services_id) {
        $code = Error::BUSY;
        $array = array();
        $array['id'] = objid();
        $array['module'] = $module;
        $array['action'] = $action;
        $array['title'] = $title;
        $array['tags'] = $tags;
        $array['desc'] = $desc;
        $array['status'] = 0;
        $array['content'] = $content;
        $array['services_id'] = $services_id;
        if (self::add('content', $array)) {
            $code = Error::SUCCESS;
        }
        return array('data'=>'','code'=>$code);
    }

}