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

class CartService {

    public static function dataIndex($param) {

        return array();
    }

    public static function actAdd($param) {
        $code = Error::PARAM_ERROR;
        if (!empty($param['id']) && !empty($param['count'])) {
            extract($param);
            $objCart = Base::instance('Cart');
            //商品已存在修改数据
            if ($objCart->data[$id]) {
                $objCart->data[$id]['count'] += $count;
                $objCart->data[$id]['money'] += $objCart->data[$id]['price'] * $count;
                $code = Error::SUCCESS;
            } else { //新增商品
                $objCart->data[$id]['name'] = $name;
                $objCart->data[$id]['price'] = $price;
                $objCart->data[$id]['count'] = $count;
                $objCart->data[$id]['money'] = $price * $count;
                $code = Error::SUCCESS;
            }
            //保存
            $objCart->save();
            return true;
        }
        return false;
    }

    public static function actEdit($param) {
        
    }

}