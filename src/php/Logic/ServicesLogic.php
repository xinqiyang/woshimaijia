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

class ServicesLogic extends BaseLogic {

    public static function setSerivces($account, $password, $groupid) {
        $code = Error::PARAM_ERROR;
        $array = array();
        $array['id'] = objid();
        $array['account'] = $account;
        $array['password'] = $password;
        $array['status'] = 0;
        $array['groupid'] = $groupid;
        if (self::add('services', $array)) {
            $code = Error::SUCCESS;
            $data = $array['id'];
        }else{
            $code = Error::BUSY;
        }
        return array('code'=>$code,'data'=>$data);
    }

}