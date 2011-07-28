<?php
Class Math
{
    //test
    function div($arg1,$arg2)
    {
        /*
        for($i=1;$i<10000;$i++)
        {
            $arg1 += $i;
            usleep(1);
        }
         * 
         */
        return $arg1/$arg2;
    }
}

include_once '../../src/php/Util/HessianPHP/HessianService.php';
$service = new HessianService(new Math());
$service->handle();

