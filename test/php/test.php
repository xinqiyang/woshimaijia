<?php
//
require_once('../../../xhprof/xhprof_header.inc.php');
include_once '../../src/php/Util/HessianPHP/HessianClient.php';

$svrurl = 'http://localhost/yxqcodes/test/php/ServiceTest.php';

$proxy = new HessianClient($svrurl);

var_dump($proxy->div(20000,4555));

require_once('../../../xhprof/xhprof_footer.inc.php');