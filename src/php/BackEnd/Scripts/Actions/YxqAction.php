<?php
/*
 * @filename
 * @touch
 * @package
 * @author
 * @license
 * @version
 * @copyright (c) 2011, baidu.com
 */
class YxqAction extends Action
{
    function index()
    {
        
        $db = storeM('testtable');
        $sql = "SELECT * FROM testtable limit 5";
        $r = $db->query($sql);
        var_dump($r);
    }

}


