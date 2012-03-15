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

class TreeLogic extends BaseLogic {

    public static function setTree($service_id,$title, $tags, $desc, $parentid, $level, $module = '', $action = '', $parameters = '', $value = '') {
        $code = Error::PARAM_ERROR;
        $data = '';
        $array = array();
        $array['id'] = objid();
        $array['title'] = $title;
        $array['tags'] = $tags;
        $array['desc'] = $desc;
        $array['parentid'] = $parentid;
        $array['module'] = $module;
        $array['action'] = $action;
        $array['parameters'] = $parameters;
        $array['value'] = $value;
        $array['status'] = 0;
        $array['level'] = $level;
        $array['services_id'] = $service_id;
        if (self::add('tree', $array)) {
            $data = $array['id'];
            $code = Error::SUCCESS;
        }else{
            $code = Error::BUSY;
        }
        return array('data'=>$data,'code'=>$code);
    }

}