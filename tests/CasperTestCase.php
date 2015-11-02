<?php

include_once __DIR__.'/OpCasper.php';

class CasperTestCase extends PHPUnit_Framework_TestCase
{
	/**
	 *要测试的脚本的名字
	 */
	protected $steps = [];

	/**
	 * 默认的进行脚本的测试
	 */
	public function testCasperNormal(){
		foreach ($this->steps as $script) {
			if(0 !== OpCasper::test($script)){
				throw new Exception("找不到casper脚本,路径:{$script}\n");
			}
		}
	}
}