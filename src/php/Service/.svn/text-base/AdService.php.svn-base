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

/**
 * Ads Services
 * ad management
 * @author xinqiyang
 *
 */
class AdService {

    public static function getsAd($module, $action) {
        return AdLogic::gets('ad', "module='$module' and action='$action' and status=0");
    }

    public static function addAd($arr) {
        return AdLogic::add('ad', $arr);
    }

   

}