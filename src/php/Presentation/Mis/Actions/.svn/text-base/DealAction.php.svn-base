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

class DealAction extends AppBaseAction {

    public function del() {
        $code = Error::PARAM_ERROR;
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            if ($id > 0) {
                $r = BaseLogic::destory($id);
                if ($r) {
                    $code = Error::SUCCESS;
                } else {
                    $code = Error::BUSY;
                }
            }
        }
        $this->ajaxReturn("", '', $code);
    }

    public function deltag() {
        $code = Error::PARAM_ERROR;
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            if ($id > 0) {
                $r = TagsLogic::deltag($id);
                if ($r) {
                    $code = Error::SUCCESS;
                }
            } else {
                $code = Error::BUSY;
            }
        }
        $this->ajaxReturn("", '', $code);
    }
    
    
    public function passtag() {
        $code = Error::PARAM_ERROR;
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            if ($id > 0) {
                $r = TagsLogic::savetag($id);
                if ($r) {
                    $code = Error::SUCCESS;
                }
            } else {
                $code = Error::BUSY;
            }
        }
        $this->ajaxReturn("", '', $code);
    }

}