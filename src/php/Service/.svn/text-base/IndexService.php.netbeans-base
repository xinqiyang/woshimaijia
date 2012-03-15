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

class IndexService {

    /**
     * 首页数据显示接口
     * 显示用户数据,根据用户的ID读取相关的key的数据然后显示胡来
     * 显示数据块有：
     * 每天的兴趣的行动，还有每天固定的行动
     * @param type $array
     * @return array 
     */
    public static function dataIndex($array) {
        //返回首页的信息
        $return = array();
        $code = Error::PARAM_ERROR;
        extract($array);
        $user_id = isset($user_id) ? $user_id : 0;
        //获取user_id  
        //$user_id = 0;
        //每日的globaletag
        $todayGlobalAction = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyRecommendTag,0);
        $return['globalaction'] = TagsLogic::getActions($todayGlobalAction);
        //获取用户的兴趣的TAG
        //$todayUserAction = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyInterestTagGlobal,$user_id);
        //$return['useraction'] = TagsLogic::getActions($todayGlobalAction);
        //获取周边的感兴趣的人
        $interestAccounts = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyInterestPeople,$user_id);
        $return['interestaccount'] = AccountLogic::getAccounts($interestAccounts);
        //获取感兴趣的产品
        $interestProducts = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyInterestProduct,$user_id);
        $return['interestproducts'] = ProductLogic::getProducts($interestProducts);
        //获取可能赶兴趣的品牌
        $interestBrands = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyInterestBrand,$user_id);
        $return['interestbrands'] = BrandLogic::getBrands($interestBrands);
        //可能敢兴趣的流
        $interestStreams = BaseLogic::redisGetKeyValues(KeysService::$ulist, KeysService::$keyInterestSteam,$user_id);
        $return['interststream'] = StreamLogic::getStreams($interestStreams);
        return array('code'=>$code,'data'=>$return);
    }

    

}