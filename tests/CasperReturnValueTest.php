<?php


include __DIR__.'/OpCasper.php';
class CasperReturnValueTest extends PHPUnit_Framework_TestCase
{
    public function testOne()
    {

    	// 不存在的脚本
    	$casper_return1 =  OpCasper::test('tests/not.js');
    	$this->assertEquals(1,$casper_return1);
    	
    	
    	
    	// 有断言错误的脚本
    	$casper_return2 =  OpCasper::test('tests/error.js');
    	$this->assertEquals(1,$casper_return2);

    	// 有断言正确的脚本
    	$casper_return3 =  OpCasper::test('tests/ok.js');
    	$this->assertEquals(0,$casper_return3);
    }
}