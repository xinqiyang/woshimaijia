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

class LoveService {

    public static function dataIndex($array) {
        $code = Error::SUCCESS;
        $return = array();
        $hateIds = array();
        $uid = $array['uid'];
        $productIds = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyInterestProduct, $uid);
        $recommandProducts = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyRecommendProduct);
        $brandIds = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyInterestBrand, $uid);
        $recommandBrands = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyRecommendBrand);
        
        if ($uid > 0) {
            $hateIds = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyHateIds, $uid);
        }
        if (is_array($recommandProducts)) {
            $productIds = is_array($productIds) ? array_merge($productIds,$recommandProducts) : $recommandProducts;
            if(is_array($hateIds)){
                $productIds = array_diff($productIds, $hateIds);
            }
            //var_dump($productIds);die;
            $return['products'] = ProductLogic::getProducts($productIds);
            
        }
        if (is_array($recommandBrands)) {
            $brandIds = is_array($brandIds) ? array_merge($brandIds,$recommandBrands) : $recommandBrands;
            
            if(is_array($hateIds)){
                $brandIds = array_diff($brandIds, $hateIds);
            }
            //var_dump($brandIds);die;
            $return['brands'] = BrandLogic::getBrands($brandIds);
        }
        //$userids = datasetToArray(array_merge($return['products'],$return['brands']), 'account_id');
        //$return['user'] = AccountLogic::getAccounts($userids);
        $return['count'] = ProductLogic::redisCount(KeysService::$list, KeysService::$keyInterestProduct, $uid);
        $return['size'] = 20;
        //var_dump($recommandBrands,$return['brands']);die;
        return array('data' => $return, 'code' => $code);
    }

}