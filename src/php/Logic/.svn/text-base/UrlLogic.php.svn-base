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
 * UrlLogic 
 * 
 * @author xinqiyang
 *
 */
class UrlLogic extends BaseLogic {

    public static function setUrl($title, $url,  $account_id,$image_id=0,$openapi = '', $category_id = 0) {
        $code = Error::PARAM_ERROR;
        $data = '';
        $uuid = self::isExist('url','siteurl',$url);
        if (empty($uuid)) {
            $array = array();
            $array['id'] = objid();
            $array['title'] = $title;
            $array['image_id'] = $image_id;
            $array['status'] = 0;
            $domainReturn = DomainLogic::getDomainID($url, $account_id, $title,$image_id);
            $array['domain_id'] = $domainReturn['code'] == Error::SUCCESS ? $domainReturn['data'] : 0;
            $array['account_id'] = $account_id;
            $array['category_id'] = $category_id;
            $array['openapi'] = $openapi;
            $array['siteurl'] = $url;

            if (self::add('url', $array)) {
                $data = $array['id'];
                $code = Error::SUCCESS;
            }else{
                $code = Error::BUSY;
            }
        }else{
            $data = $uuid;
            $code = Error::SUCCESS;
        }
        return array('code'=>$code,'data'=>$data);
    }

    public static function getUrlByDomain($domain) {
        return self::gets('url', "domain='{$domain}' and status=0");
    }

    public static function isExistUrl($url)
    {
        return self::isExist('url','siteurl',$url);
    }
    

    public static function getByIds($ids) {
        $where = !empty($ids) ? 'ID IN ' . strin($ids) . ' AND status=0 ' : " id in ($ids) and status=0";
        return  self::gets('url', $where);
    }

    

}
