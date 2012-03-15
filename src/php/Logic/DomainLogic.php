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

class DomainLogic extends BaseLogic {

    public static function getDomainID($url, $account_id, $title = '', $image_id = 0) {
        $code = Error::PARAM_ERROR;
        $data = '';
        $domain = rootUrl($url);
        if ($domain) {
            $domainid = self::isExist('domain', 'domain', $domain);
            if ($domainid) {
                $data = $domainid;
                $code = Error::SUCCESS;
            } else {
                $array = array();
                $array['id'] = objid();
                $array['title'] = $title;
                $array['image_id'] = $image_id;
                $array['status'] = 0;
                $array['domain'] = $domain;
                $array['account_id'] = $account_id;
                if (self::add('domain', $array)) {
                    $data = $array['id'];
                    $code = Error::SUCCESS;
                }else{
                    $code = Error::BUSY;
                }
            }
        }
        return array('data' => $data, 'code' => $code);
    }
}