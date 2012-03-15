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

class ProductLogic extends BaseLogic {

    public static function setProduct($title, $account_id, $image_id = 0, $brand_id = '', $url_id = '', $titleextend = '', $status = 0, $rebate = 0, $price = 0, $newprice = 0, $showtype = 0, $starttime = '', $endtime = '') {
        $code = Error::PARAM_ERROR;
        $data = '';
        $array = array();
        $product = self::isExist('product', 'title', $title);
        if(empty($product)){
            $array['id'] = objid();
            $array['title'] = $title;
            $array['titleextend'] = $titleextend;
            $array['status'] = $status;
            $array['account_id'] = $account_id;
            $array['brand_id'] = $brand_id;
            $array['price'] = $price;
            $array['newprice'] = $newprice;
            $array['showtype'] = $showtype;
            $array['url_id'] = $url_id;
            $array['starttime'] = $starttime;
            $array['endtime'] = $endtime;
            $array['rebate'] = $rebate;
            $array['image_id'] = $image_id;
            if (self::add('product', $array)) {
                $code = Error::SUCCESS;
                $data = $array['id'];            
            }else{
                $code = Error::BUSY;
            }
        }else{
            $data = $product['id'];
            $code = Error::SUCCESS;
        }
        return array('data'=>$data,'code'=>$code);
    }
    
    public static function getProducts($ids,$selectfields="id,title,titleextend,status,price,account_id,url_id,brand_id,image_id")
    {
        if(!empty($ids) && is_array($ids))
        {
            $ids = strin($ids);
            return self::getsKeyID('product', "ID IN $ids AND status=0",$selectfields);
        }
        return array();
    }


    public static function getByIds($ids) {
        $where = !empty($ids) ? 'ID IN ' . $ids . ' AND status=0' : "id in ($ids) and status=0";
        return self::gets('Product', $where);
    }
    
    public static function setInterestProduct($user_id,$product_id)
    {
        $code = Error::PARAM_ERROR;
        if($user_id && $product_id)
        {
            $tag = BaseLogic::redisGetKeyValues(KeysService::$string, KeysService::$keyTag,$tag_id);
            if($tag)
            {
                if(false !== BaseLogic::redisSetKeyValues(KeysService::$ulist, KeysService::$keyGo, $user_id,$tag_id))
                {
                    //设置访问次数＋1
                    if(false !== BaseLogic::redisSetKeyValues(KeysService::$count, KeysService::$keyCountTag,1,$tag_id))
                    {
                        $code = Error::SUCCESS;
                    }else{
                        Error::REDIS_COUNTSET_ERROR;
                    }
                }else{
                    $code = Error::REDIS_OBJECTSET_ERROR;
                }
            }else{
                $code = Error::TAG_NOT_FIND;
            }
        }
        return array('code'=>$code,'data'=>'');
    }
    

}
