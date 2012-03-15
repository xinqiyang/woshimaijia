<?php


class StockAction extends Action
{
	public function mornitor()
	{
		$code = '600568';
		$url = "http://flashquote.stock.hexun.com/Stock_Combo.ASPX?mc=1_$code&dt=M&t=0.16830742462211056";
		$r = Curl::get($url);
		var_dump($r);
		//var_dump(json_decode($r));
	}
	
	
}