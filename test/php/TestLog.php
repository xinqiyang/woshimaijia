<?php

require_once 'simpletest/autorun.php';

class TestLog extends UnitTestCase {

    function testlog() {
        //
        $l = require_once '/home/xinqiyang/wwwroot/yxqcodes/src/php/BackEnd/BTBoss/Common/mc_log.inc.php';
        //array("logid" => 12345, "reqip" => "210.23.55.33")
        $r = ub_log_init("/tmp", "test".date('YmdH',time()), 16, array(), true);

        var_dump($__log);
        UB_LOG_FATAL("fatal %d  %s !!!", 1231324, "asdfasdfsf");
        UB_LOG_TRACE("fatal %d  %s !!!", 1231324, "asdfasdfsf");
        UB_LOG_DEBUG("fatal %d  %s !!!", 1231324, "asdfasdfsf");
        UB_LOG_WARNING("fatal %d  %s !!!", 1231324, "asdfasdfsf");
        UB_LOG_NOTICE("fatal %d  %s !!!", 1231324, "asdfasdfsf");
        UB_LOG_MONITOR("fatal %d  %s !!!", 1231324, "asdfasdfsf");

        ub_log_pushnotice("notice %s %d", "asdfasdf", 111);
        ub_log_pushnotice("notice %s %d", "asdfasdf", 222);
        UB_LOG_NOTICE("fatal %d  %s !!!", 1231324, "asdfasdfsf");
        UB_LOG_NOTICE("fatal %d  %s !!!", 1231324, "asdfasdfsf");

        ub_log_addbasic(array("uid" => 1234, "uname" => 2323));
        UB_LOG_NOTICE("fatal %d  %s !!!", 1231324, "asdfasdfsf");

        var_dump($__log);
    }

}
