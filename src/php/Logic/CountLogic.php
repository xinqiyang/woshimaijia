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
class CountLogic extends BaseLogic {

    public static function setCount($id) {
        $code = Error::BUSY;
        $array = array();
        $array['id'] = $id;
        if (self::add('count', $array)) {
            return $code = Error::SUCCESS;
        }
        return array('data'=>'','code'=>$code);
    }
    
    /**
     * 设置计数表的变化
     * @param type $id
     * @param type $field
     * @param type $step
     * @return type 
     */
    public static function setCountField($id,$field,$step=1){
        $code = Error::PARAM_ERROR;
        if(!emtpy($id) && $id>0 && !empty($field) && !empty($step))
        {
            $sql = "UPDATE COUNT SET $field = $field + $step where id= $id";
            if(self::query('count', $sql))
            {
                $code = Error::SUCCESS;
            }else{
                $code = Error::BUSY;
            }
        }
        return array('data'=>'','code'=>$code);
    }
}