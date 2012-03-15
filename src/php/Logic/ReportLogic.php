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
class ReportLogic extends BaseLogic {

    public static function setReport($typename, $account_id = 0, $url = '', $reason = '', $uname = '', $ip = '') {
        $code = Error::PARAM_ERROR;
        $data = '';
        $array = array();
        $array['id'] = objid();
        $array['account_id'] = $account_id;
        $array['uname'] = $uname;
        $array['ip'] = $ip;
        $array['typename'] = $typename;
        $array['url'] = $url;
        $array['reason'] = $reason;
        $array['status'] = 0;
        if (self::add('report', $array)) {
            $code = Error::SUCCESS;
            $data = $array['id'];
        }else{
            $code = Error::BUSY;
        }
        return array('data'=>$data,'code'=>$code);
    }

}