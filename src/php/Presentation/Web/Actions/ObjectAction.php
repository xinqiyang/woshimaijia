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

class ObjectAction extends AppBaseAction {

    public function object() {
        if (isset($_GET['id']) && intval($_GET['id']) > 0) {
            $r = ItemLogic::getObject($_GET);
            //显示页面的内容
            $r['object'] = empty($r['object']) ? 'product' : $r['object'];
            //var_dump($r);die;
            $data['data'] = $r;
            if (isset($r['object'])) {
                $this->t(array('data' => $data), 'Object/' . $r['object']);
            }
        }
    }

}