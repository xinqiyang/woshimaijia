<?php
/**
 * Promo Logic
 */
class PromoLogic
{

    public static function index()
    {
          echo 'promotion logic';
          return '';
    }



    public static function getCount()
    {
        $sql = "SELECT count(id) from tb_pre_promotion_newuser";
        $db = getdb('sns_stat', 'dbPromo');
        $r = $db->query($sql);
        var_dump($r);
    }

    public static function getTodayNew()
    {
        $start = strtotime('yesterday');
        $end = strtotime('today');
        $sql = "SELECT count(id) from tb_pre_promotion_newuser WHERE insert_at >$start and insert_at<$end";
        $db = getdb('sns_stat', 'dbPromo');
        $r = $db->query($sql);
        var_dump($r);
    }


    public static function loadData()
    {
        $nowtime = time() - 5 * 60;
        $sql =  "select id,passport_id,last_login_at,login_count FROM tb_pre_promotion_newuser WHERE last_login_at>$nowtime order by passport_id limit 2000";
        $db = getdb('sns_stat', 'dbPromo');
        $label = 'time';
        debug_start($label);
        $r = $db->query($sql);
        debug_end($label);
        //var_dump($r);
    }


    public static function getTask()
    {
        $sql = "";
    }

    
    public static function sendMsg()
    {
        //
        
    }


    public static function getContent()
    {
        //
        
    }

}
