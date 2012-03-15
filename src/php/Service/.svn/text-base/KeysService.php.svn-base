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

/**
 * 全局的缓存变量设置 
 */
class KeysService  {

    //全局变量设置
    public static $prefix = 'b:';
    //定义数据类型前缀
    public static $object = 'h:'; //hash对象
    public static $list = 'l:'; //列表
    public static $set = 's:'; //集合
    public static $zset = 'z:'; //ZSET 
    public static $string = 'v:'; //字符
    public static $count = 'c:'; //计数
    public static $ulist = 'u:'; //unique list 严格的顺序来排列的类型
    public static $size = 'a:'; //获取list的长度
    public static $remove = 'd:'; //移出
    //public static $rlist = 'r:'; //
    //动作的内容
    public static $keyFollow = 'follow'; //关注
    public static $keyBeFollow = 'befollow'; //被关注
    public static $keyPrivateMsg = 'privatemsg'; //私信
    public static $keyView = 'view'; //查看
    public static $keyPost = 'post'; //发送
    public static $keyLike = 'like'; //喜欢
    public static $keyBuy = 'buy'; //买过
    public static $keyCollect = 'collect'; //收藏
    public static $keyGo = 'go'; //访问
    public static $keySend = 'send'; //发送
    public static $keyChat = 'chat'; //聊天
    public static $keyOwn = 'own'; //拥有
    public static $keyScoring = 'scoring'; //积分
    public static $keyBelong = 'belong'; //属于
    public static $keySupport = 'support'; //支持
    public static $keyWillBuy = 'willbuy'; //想买
    public static $keyReply = 'userreply'; //回应列表
    public static $keyUserCopy = 'usercopy'; //转发ID列表
    //@TODO:小组功能现在不开发所以，暂时就预留在这里
    //小组相关的KEY
    //public static $keyMyGroup = 'mygroup'; //我管理的小组
    //public static $keyGroupList = 'grouplist'; //组主题列表
    //public static $keyMyJoinGroup = 'joingroup'; //我加入的小组
    //public static $keyGroupUsers = 'groupusers';  //组用户列表
    //public static $keyGroupAdmins = 'groupadmins'; //组管理员
    //内容的KEY
    //public static $keyPub = 'pub'; //广场列表
    public static $keyInbox = 'inbox'; //用户的INBOX
    public static $keyOutbox = 'outbox'; //用户的OUTBOX
    //公共的信息
    public static $keyHaveNotice = 'notice'; //有提示消息
    public static $keyLastPost = 'lastpost'; //存储最后发表的内容
    //Mail
    public static $keyToMail = 'tomail';  //收件人
    public static $keyFromMail = 'frommail'; //发件人
    //可能感兴趣，引导用户的作用
    public static $keyInterestPeople = 'ipeople'; //可能感兴趣的人
    public static $keyInterestProduct = 'iproduct'; //可能感兴趣的商品
    public static $keyInterestBrand = 'ibrand'; //可能感兴趣的品牌
    public static $keyInterestUrl = 'iurl';     //可能感兴趣地方
    public static $keyInterestTag = 'itag';  //可能感兴趣的主题
    //public static $keyInterestTagGlobal = 'itagglobal'; //设置的默认的TAG
    public static $keyInterestSteam = 'istream'; //可能感兴趣的流
    
    //public static $keyInterestGroup = 'igroup';
    //public static $keyInterestTopic = 'itopic';
    //推荐的默认内容
    public static $keyRecommendPeople = 'rpeople';
    public static $keyRecommendProduct = 'rproduct';
    public static $keyRecommendBrand = 'rbrand';
    public static $keyRecommendUrl = 'rurl';
    //public static $keyRecommendGroup = 'rgroup';
    //public static $keyRecommendTopic = 'rtopic';
    public static $keyRecommendTag = 'rtag'; //每天推荐的
    //我不喜欢的ID
    public static $keyHateIds = 'hate';
    //实体对象
    public static $keyAccount = 'account'; //账户
    public static $keyProduct = 'product'; //产品
    public static $keyAd = 'ad';   //广告
    public static $keyBrand = 'brand';  //品牌
    public static $keyCompaign = 'compaign'; //聚会，暂时不开发
    public static $keyCount = 'count';    //计数
    public static $keyDomain = 'domain'; //访问的域名
    //public static $keyGroup = 'group';
    public static $keyImage = 'image'; //图片
    public static $keyMail = 'mail'; //私信
    public static $keyTag = 'tag'; //标签
    public static $keyTopic = 'topic';
    public static $keyUrl = 'url'; //访问URL 
    public static $keyAccountInfo = 'ainfo'; //用户信息
    public static $keyStream = 'stream'; //信息流
    //TAG相关的KEY
    public static $keyPubActionTags = 'actiontags'; //设置公共的引导动作的tag
    public static $keyOwnTags = 'owntags'; //每个人拥有的tags


    //用户搜索的TAG
    public static $keyUserSearchWords = 'usersearchwords';
    //存储ID关联的串,跟ID相关的串有写入操作的时候就写入到idkeysstore中，以便删除的时候工具ID来删除
    public static $keyIdKeysStore = 'idkeysstore';
    //最近活动的大家
    public static $keyActiveMomentUsers = 'activemomentusers';
    //刚刚在线的大家
    public static $keyOnlineUsers = 'onlineusers';
    //最近注册的大家
    public static $keySignupUsers = 'signupusers';
    
    //记数的key
    public static $keyCountTag = 'tagc';
    public static $keyCountStreamComment = 'commentc';
    public static $keyCountStreamCopy = 'copyc';

    /**
     * 获取KEY的串
     * @param string $type key的类型
     * @param string $key  key的名称
     * @param bigint $id 相关的ID
     * @return string 最终的key的串
     */
    public static function getKey($type, $key, $id = '') {
        $bdPrefix = self::$prefix;
        $returnKey = $bdPrefix . $type . $key;
        $id = empty($id) ? '' : ':' . $id;
        return $returnKey . $id;
    }

}