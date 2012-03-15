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
class AdLogic extends BaseLogic {

    public static function setAd($module, $action, $adbegin, $adend, $services_id, $position, $adcode = '') {
        $code = Error::BUSY;
        $array = array();
        $array['id'] = objid();
        $array['module'] = $module;
        $array['action'] = $action;
        $array['adcode'] = $adcode;
        $array['adbegin'] = $adbegin;
        $array['adend'] = $adend;
        $array['status'] = 0;
        $array['services_id'] = $services_id;
        $array['position'] = $position;
        if (self::add('ad', $array)) {
            $code = Error::SUCCESS;
        }
        return array('data'=>$array['id'],'code'=>$code);
    }

}