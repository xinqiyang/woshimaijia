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


class UserlocationLogic extends BaseLogic {
    /**
     * 根据账户IP获取地理位置信息
     * @param type $account_id
     * @param type $ip
     * @return type 
     */
    public static function setLocation($ip,$account_id='') {
        $code = Error::PARAM_ERROR;
        $data = '';
        $arrGeos = self::apiGetIpToGeo($ip);
        
        if(!empty($arrGeos['id'])){
            $code = Error::SUCCESS;
            $data = $arrGeos;
            
        }elseif (!empty($arrGeos)) {
            $arr = array();
            extract($arrGeos);
            $arr['id'] = objid();
            $arr['country'] = '';
            $arr['city'] = isset($city) ? $city : '';
            $arr['province'] = isset($province) ? $province : '';
            $arr['timezone'] = '';
            $arr['ip'] = $ip;
            $arr['mapimage'] = '';
            $arr['address'] = '';
            $arr['isdomestic'] = '';
            $arr['iswap'] = '';
            $arr['longitude'] = $longitude;
            $arr['latitude'] = $latitude;
            $arr['city_name'] = $city_name;
            $arr['province_name'] = $province_name;
            $arr['pinyin'] = isset($pinyin) ? $pinyin : '';
            $arr['more'] = isset($more) ? $more : '';
            $arr['account_id'] = $account_id;
            if(self::add('userlocation', $arr)){
                $code = Error::SUCCESS;
                $data = $arr;
            }else{
                $code = Error::BUSY;
            }
        }else{
            $code = Error::USERLOCATION_GET_GEOSERROR;
        }
        return array('data'=>$data,'code'=>$code);
    }

    //发送GET请求获取IP信息
    public static function apiGetIpToGeo($ip) {
        //@TODO 上线后移除
        $data = self::get('userlocation', '','*',"ip='$ip'");
        if(!$data && !empty($_SESSION['token']['access_token'])){
            $access_token = $_SESSION['token']['access_token'];
            $url = 'https://api.weibo.com/2/location/geo/ip_to_geo.json?ip=' . $ip . '&access_token=' . $access_token;
            $return = Curl::get($url);
            $returnDecode = json_decode($return,true);
            if (!empty($returnDecode['geos'][0])) {
                return $returnDecode['geos'][0];
            }else{
                logDebug('CANT GET IP INFO:'.$return);
            }
            return false;
        }
        return $data;
    }
    
   
}