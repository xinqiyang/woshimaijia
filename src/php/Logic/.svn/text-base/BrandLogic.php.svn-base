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

class BrandLogic extends BaseLogic {

    public static function setBrand($title, $account_id, $url_id, $enname = '',  $image_id = 0) {
        $code = Error::BUSY;
        $data = '';
        $data = self::isExist('brand','title',$title);
        if (empty($data)) {
            $brand = array();
            $brand['id'] = objid();
            $brand['title'] = $title;
            $brand['enname'] = $enname;
            $brand['status'] = 2; //置入待审核的状态，审核后置为0
            $brand['image_id'] = $image_id;
            $brand['account_id'] = $account_id;
            $brand['url_id'] = $url_id;
            if (self::add('brand', $brand)) {
                $code = Error::SUCCESS;
                $data = $brand['id'];
            }else{
                $code = Error::BUSY;
            }
        }else{
            $code = Error::SUCCESS;
        }
        return array('data'=>$data,'code'=>$code);
    }

    public static function getBrands($ids,$selectfields='id,title,enname,status,account_id,url_id,image_id') {
        if(!empty($ids) && is_array($ids))
        {
            $ids = strin($ids);
            return self::getsKeyID('brand', "id IN $ids and status=0 ORDER BY ID DESC",$selectfields);
        }
        return array();
    }

    public static function getBrandMaxId() {
        return self::getMaxId('brand');
    }

}