<?php


include_once __DIR__.'/CasperTestCase.php';

class PhpThread extends Thread{
	protected $url = 'http://localhost';
	protected $port = '8010';
	public run(){
		$descriptorspec = [];
		$process = proc_open("php serve -S {$this->url}:{$this->port}", $descriptorspec, $pipes);
		if (is_resource($process)) {
		    return proc_close($process);
		}
	}
}

/**
* 
*/
class DownloadSplitTest extends CasperTestCase
{
	protected $steps = [];
	protected $php_process;
	function setUp(){
		$this->php_process = new PhpThread();
		$this->php_process->start();
	}

	function tearDown(){
		$this->php_process.kill();
	}
}