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

class TestAction extends AppBaseAction {
    
    public function testfollow()
    {
        $uid = '13303295021479350';
        $fid = '13315626166329480';
        $r1 = BaseLogic::redisSetKeyValues(KeysService::$ulist, KeysService::$keyFollow, $fid,$uid);
        $array['uid'] = $uid;
        $r = FollowService::dataFollow($array);
        var_dump($r1,$r);
    }
    
    public function testredis()
    {
        
        $pid = '13314816182897691';// '13312801582258550';
        $bid = '13311130875544450';
        $uid = '13303295021479350';
        $r1 = BaseLogic::redisSetKeyValues(KeysService::$ulist, KeysService::$keyInterestProduct, $pid,$uid);
        $r2 = BaseLogic::redisSetKeyValues(KeysService::$ulist, KeysService::$keyInterestBrand, $bid,$uid);
        var_dump($r1,$r2);
    }

    public function teststream()
    {
        $array = array(
            'account_id'=>'131212',  
            'content'=>'我想说的内容eee111测试一个链接看看怎么http://detail.tmall.com/item.htm?id=12647546451&cm_cat=50097177&pm2=1&source=dou 的了啊 source=dou&cm_cat=50010158加个淘宝的',
        );
        var_dump(StreamService::actAddStream($array));
    }
    
    public function testtag()
    {
        $array = array(
            'tag'=>'我的标签1',
        );
        var_dump(TagService::actAddTag($array));
    }


    public function testproduct()
    {
        $array = array(
            'url'=>'http://test.aaa.com/asfsadf.html',
            'title'=>'测试商品1',
            'titleextend'=>'大家都推荐的',
            'image_id'=>'4444',
            'brand_id'=>'32323',
            'source'=>'wap',
            'account_id'=>'123',
        );
        var_dump(ProductService::actAddProduct($array));
    }
    
    public function testsbrand()
    {
        $array = array(
            'title'=>'测试品牌12',
            'siteurl'=>'http://www.test323121.com/abc/i3',
            'enname'=>'test12',
            'account_id'=>'13233',
            'source'=>'web',
            'image_id'=>'323233',
        );
        var_dump(BrandService::actAddBrand($array));
    }
    
    public function index() {
        $sql = 'select * from account limit 1';
        $sqllarge = 'select * from stream';
        $sqlproduct = 'select * from product';
        $db = Base::instance('Mysqlidb');
        $result = $db->fetchRow($sql);
        $db->connect()->real_query($sqllarge);
        $result2 = $db->connect()->use_result();
        while ($row = $result2->fetch_row()) {
            var_dump($row);
        }
        echo "<br />2222-------<br />";
        var_dump($result);


        echo "<br />----------333 <br />";

        if ($db->query($sqlproduct)) {
            while ($arrRow = mysqli_fetch_assoc($db->getQuery())) {
                var_dump($arrRow);
                echo "--------------<br />";
            }
        }
    }

    public function testqrcode() {
        include BUDDY_PATH . DIRECTORY_SEPARATOR . 'Vender' . DIRECTORY_SEPARATOR . 'phpqrcode/qrlib.php';
        QRcode::png("http://woshimaijia.com");
    }

    public function testfacebox() {
        $this->t();
    }

    public function testlock() {
        $lock = Base::instance('Lock');
        $lock->lock();
        echo "lock";
        $lock->unlock();
    }

    public function testpage() {
        $totalRows = 200;
        $listRow = 30;
        $page = new Page($totalRows, $listRow);
        echo $page->show();
    }

    public function testsphinx() {
        $query = "著名";
        $result = SphinxClient::instance()->query($query);
        dump($result);
    }

    public function testonline() {
        //$key = "WEB";
        $r = OnlineService::online();
        var_dump($r);
    }

    public function testonlinelogout() {
        $keys = 'PHPREDIS_SESSION:*';
        $r = OnlineService::logoutAll($keys);
        var_dump($r);
    }

    public function testlang() {
        var_dump(L('_MODULE_NOT_EXIST_'));
    }

    public function testasynchttpclient() {
        
    }

    public function showresult($result) {
        echo $result;
    }

    public function testimageup() {
        $img = Base::instance('ImageUpload');
        $model = 'user';
        $filename = 'testuser1.jpg';
        //$streamFile = './yxq.jpg';
        //$id = '33333333333333333';
        //$user_id = '444444444444444444';
        //$return = $img->save($model,$filename,$streamFile,$id,$user_id);
        //$return = $img->get($model,$filename);
        $return = $img->delete($model, $filename);
        var_dump($return);
    }

    public function testu() {
        $r['enname'] = 'aaaaaa';
        echo U('group/group', array('enname' => $r['enname']));
    }

}