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

class ContentAction extends AppBaseAction {

    public function index() {
        $this->t();
    }

    public function addtags() {
        $this->t();
    }
    
    public function addbrand()
    {
        $this->t();
    }
    
    public function addbranddeal()
    {
        $this->t();
    }
    
    public function addtagsdeal() {
        if(!empty($_POST['tag']))
        {
            $_POST['tag'] = str_replace('，', ',', $_POST['tag']);
            $arr = explode(',',$_POST['tag']);
            foreach($arr as $one)
            {
                if(!empty($one)){
                    $array['tag'] = $one;
                    TagService::actAddTag($array);
                }
            }
            jump('/content/tag');
        }
    }

    public function product() {
        if (!empty($_GET['p'])) {
            $p = intval($_GET['p']);
        }
        $p = isset($p) && $p >= 1 ? $p : 1;
        $pageSize = 15;
        $arr['data']['data']['product'] = BaseLogic::getsByPage('product', " id>0 ORDER BY ID DESC ", $p, $pageSize);
        $arr['data']['data']['size'] = $pageSize;
        $arr['data']['data']['count'] = StatService::getObjectCounts('product');
        $this->t($arr);
    }

    public function brand() {
        if (!empty($_GET['p'])) {
            $p = intval($_GET['p']);
        }
        $p = isset($p) && $p >= 1 ? $p : 1;
        $pageSize = 15;
        $arr['data']['data']['brand'] = BaseLogic::getsByPage('brand', " id>0 ORDER BY ID DESC ", $p, $pageSize);
        $arr['data']['data']['size'] = $pageSize;
        $arr['data']['data']['count'] = StatService::getObjectCounts('brand');
        $this->t($arr);
    }

    public function url() {
        if (!empty($_GET['p'])) {
            $p = intval($_GET['p']);
        }
        $p = isset($p) && $p >= 1 ? $p : 1;
        $pageSize = 15;
        $arr['data']['data']['url'] = BaseLogic::getsByPage('url', " id>0 ORDER BY ID DESC ", $p, $pageSize);
        $arr['data']['data']['size'] = $pageSize;
        $arr['data']['data']['count'] = StatService::getObjectCounts('url');
        $this->t($arr);
    }

    public function mail() {
        if (!empty($_GET['p'])) {
            $p = intval($_GET['p']);
        }
        $p = isset($p) && $p >= 1 ? $p : 1;
        $pageSize = 15;
        $arr['data']['data']['mail'] = BaseLogic::getsByPage('mail', " id>0 ORDER BY ID DESC ", $p, $pageSize);
        $arr['data']['data']['size'] = $pageSize;
        $arr['data']['data']['count'] = StatService::getObjectCounts('mail');
        $this->t($arr);
    }

    public function group() {
        if (!empty($_GET['p'])) {
            $p = intval($_GET['p']);
        }
        $p = isset($p) && $p >= 1 ? $p : 1;
        $pageSize = 15;
        $arr['data']['data']['group'] = BaseLogic::getsByPage('group', " id>0 ORDER BY ID DESC ", $p, $pageSize);
        $arr['data']['data']['size'] = $pageSize;
        $arr['data']['data']['count'] = StatService::getObjectCounts('group');
        $this->t($arr);
    }

    public function topic() {
        if (!empty($_GET['p'])) {
            $p = intval($_GET['p']);
        }
        $p = isset($p) && $p >= 1 ? $p : 1;
        $pageSize = 15;
        $arr['data']['data']['topic'] = BaseLogic::getsByPage('topic', " id>0 ORDER BY ID DESC ", $p, $pageSize);
        $arr['data']['data']['size'] = $pageSize;
        $arr['data']['data']['count'] = StatService::getObjectCounts('topic');
        $this->t($arr);
    }

    public function post() {
        if (!empty($_GET['p'])) {
            $p = intval($_GET['p']);
        }
        $p = isset($p) && $p >= 1 ? $p : 1;
        $pageSize = 15;
        $arr['data']['data']['post'] = BaseLogic::getsByPage('stream', " id>0 ORDER BY ID DESC ", $p, $pageSize);
        $arr['data']['data']['size'] = $pageSize;
        $arr['data']['data']['count'] = StatService::getObjectCounts('stream');
        $this->t($arr);
    }

    public function tag() {
        if (!empty($_GET['p'])) {
            $p = intval($_GET['p']);
        }
        $p = isset($p) && $p >= 1 ? $p : 1;
        $pageSize = 15;
        $arr['data']['data']['tag'] = BaseLogic::getsByPage('tag', " id>0 ORDER BY ID DESC ", $p, $pageSize);
        $arr['data']['data']['size'] = $pageSize;
        $arr['data']['data']['count'] = StatService::getObjectCounts('tag');
        $this->t($arr);
    }

}