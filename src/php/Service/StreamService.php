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
class StreamService {

    public static function actAddStream($array) {
        $code = Error::PARAM_ERROR;
        $data = '';
        $id = '';
        if (!empty($array['account_id']) && !empty($array['content'])) {
            extract($array);
            $lastContent = StreamLogic::redisGetKeyValues(KeysService::$string, KeysService::$keyLastPost, $account_id);
            if ($lastContent != $content) {
                $id = objid();
                $source = !empty($source) ? $source : "web";
                $image_id = !empty($image_id) ? $image_id : '';
                $action = !empty($action) ? $action : 'say';
                $object_id = !empty($object_id) ? $object_id : '';
                $ispost = isset($ispost) ? $ispost : 1;
                $isusercopy = !empty($isusercopy) ? $isusercopy : 0;
                $notdeal = !empty($notdeal) ? $notdeal : false;
                $userlocation_id = !empty($userlocation_id) ? $userlocation_id : 0;
                $istopic = !empty($istopic) ? $istopic : 0;
                $istop = !empty($istop) ? $istop : 0;
                if ($isusercopy) {
                    $notdeal = true;
                }
                $r = StreamLogic::setStream($id, $content, $object_id, $account_id, $source, $userlocation_id, $istopic, $istop, $ispost, $image_id, $action, $notdeal, $isusercopy);
                if ($r['code'] === Error::SUCCESS) {
                    
                    //处理核心逻辑,根据Action处理核心逻辑
                    if ($action !== 'reply') {
                        //将ID写入到outbox
                        StreamLogic::redisSetKeyValues(KeysService::$list, KeysService::$keyOutbox, $id, $account_id);
                        //将ID写入inbox
                        StreamLogic::redisSetKeyValues(KeysService::$list, KeysService::$keyInbox, $id, $account_id);
                        //将account_id写入到广场的pub
                        //StreamLogic::redisSetKeyValues(KeysService::$ulist, KeysService::$keyPub, $account_id . '-' . $id);
                        //将ID写入lastpost
                        StreamLogic::redisSetKeyValues(KeysService::$string, KeysService::$keyLastPost, $account_id, $content);
                        //写入到推送的列表中
                        StreamLogic::addToEventQueue(array('account_id' => $account_id, 'id' => $id), __CLASS__ . __FUNCTION__);

                        if ($isusercopy) {

                            //PostLogic::updateReply($object_id, 'usercopy');
                        }
                    } else {
                        //update reply
                        //PostLogic::updateReply($object_id);
                        $id = $object_id;
                    }
                    $code = Error::SUCCESS;
                    $data = $id;
                    //写入最后一次发送的key中
                    StreamLogic::redisSetKeyValues(KeysService::$string, KeysService::$keyLastPost, $content,$account_id);
                } else {
                    $code = Error::BUSY;
                }
            }else{
                $code = Error::STREAM_SEND_DUMP;
            }
        }
        return array('code' => $code, 'data' => $data);
    }

    public static function actGetPostList($param) {
        $code = Error::PARAM_ERROR;
        $r = 0;
        if (!empty($param['id']) && !empty($param['user_id'])) {
            extract($param);
            $r = self::gets('post', "object_id=$id and status=0 and action='reply' order by id desc limit 5", '*');

            if (!empty($r)) {
                foreach ($r as &$one) {
                    $one['time'] = Time::timeAgo(substr($one['id'], 0, 10));
                    $one['screenname'] = AccountLogic::getscreenname($one['user_id']);
                }
                $code = Error::SUCCESS;
            }
        }
        return array('code' => $code, 'data' => $r);
    }

    public static function dataPost($param) {
        $code = Error::PARAM_ERROR;
        if (!empty($param['id'])) {
            extract($param);
            $r = PostLogic::get('post', '', '*', "id=$id and status=0 and ispost=1");
            if (!empty($r['id'])) {
                $p = isset($p) && $p >= 1 ? $p : 1;
                $pageSize = 10;
                $content = PostLogic::get('post', '', 'content', "object_id=$id and status=0");
                //取得结果
                $arrcount = PostLogic::get('post', '', 'count(*) as count', "object_id=$id and action='reply' and status=0");
                $r['count'] = $arrcount['count'];
                $r['size'] = $pageSize;
                $r['post'] = PostLogic::getsByPage('post', "object_id=$id and status=0 and action='reply' ORDER BY ID DESC", $p, $pageSize);
                $r['title'] = $r['content'];
                //获取所有的ID然后去取对象
                $ids = array_merge(arrToOne($r['post'], 'user_id'), array($r['user_id']));
                $r['user'] = AccountLogic::getUsers($ids, 'user_id');
                //var_dump($r);die;
                return $r;
            } else {
                //@TODO:跳转到错误页面,这里移出全部的跳转
                //jump('/public/404');
            }
        }
    }

}