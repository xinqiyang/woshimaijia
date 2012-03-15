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


class CheckAction extends ApibaseAction {

    //
    public function index() {
        if (isset($_GET['type'])) {
            echo $_GET['type'] . "CHECK";
            die;
        }
        //usleep(4000);
        $int = mt_rand(0, 10000);
        $array = array('int' => $int, 'int2' => $int,);
        echo json_encode($array);
    }

    public function post() {
        if (isset($_POST['post']) && isset($_POST['type'])) {
            echo $_POST['post'] . $_POST['type'] . "CHECK";
        }
    }

    public function xml() {
        $data = array(array('id' => '111111', 'type' => 'type'), array('id' => '11111221', 'type' => 'type1'));
        $this->ajaxReturn($data, 1, 1, 'xml');
    }

    public function redirects() {

        $this->redirect('index/index', array('id' => 100));
    }

}
