<?php

include_once __DIR__.'/CasperTestCase.php';

/**
* 
*/
class CasperTestCase1 extends CasperTestCase
{
	protected $steps = [
		'tests/ok.js',
		'tests/ok3.js'
	];
}

class CasperTestCase2 extends CasperTestCase
{
	protected $steps = [
		'tests/error.js',
	];
}

/**
* 
*/
class MyCasperTestCaseTest extends PHPUnit_Framework_TestCase
{
	function testOne(){
		$casperOne = new CasperTestCase1();
		$casperOne->testCasperNormal();

		try {
			$casperTwo = new CasperTestCase2();
			$casperTwo->testCasperNormal();
			$this->assertTrue(false);
		} catch (\Exception $e) {
			$this->assertTrue(true);
		}


		$this->assertTrue(true);
	}
}