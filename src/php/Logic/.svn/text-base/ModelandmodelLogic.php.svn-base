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

class ModelandmodelLogic extends BaseLogic {

    public static function setModelandmodel($object_ida, $object_idb, $account_id, $relation, $status = 0, $userlocationid = '', $extension = '') {
        $code = Error::PARAM_ERROR;
        $data = '';
        $r = self::modelisExist($object_ida, $object_idb, $account_id, $relation);
        if (!$r) {
            $array = array();
            $array['id'] = objid();
            $array['status'] = $status;
            $array['object_ida'] = $object_ida;
            $array['object_idb'] = $object_idb;
            $array['account_id'] = $account_id;
            $array['relation'] = $relation;
            $array['userlocationid'] = $userlocationid;
            $array['extension'] = $extension;
            if (self::add('modelandmodel', $array)) {
                $data = $array['id'];
                $code = Error::SUCCESS;
            }else{
                $code = Error::BUSY;
            }
        } else {
            $r['status'] = 0;
            if (self::saveClean('modelandmodel', $r)) {
                $data = $r['id'];
                $code = Error::SUCCESS;
            }else{
                $code = Error::BUSY;
            }
            
        }
        return array('data'=>$data,'code'=>$code);
    }

    public static function modelisExist($object_ida, $object_idb, $account_id, $relation) {
        return self::get('modelandmodel', '', '*', "object_ida=$object_ida AND object_idb=$object_idb and account_id=$account_id and relation=$relation");
    }

    public static function getByRelation($relation,$object_ida,$account_id='')
    {
        $where = empty($account_id) ? "relation='$relation' and object_ida = $object_ida and status=0" : "relation='$relation' and object_ida = $object_ida and status=0 and account_id=$account_id";
        return self::gets('modelandmodel',$where);
    }
    
    
    public static function getByIds($ids)
    {
        $ids = is_array($ids) && count($ids) ? strin($ids) : $ids;
        $where = "id IN $ids and status=0";
        return self::gets('modelandmodel', $where);
    }

}