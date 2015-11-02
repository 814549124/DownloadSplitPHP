<?php

/**
* 
*/
class OpCasper
{
	/**
	 * 进行一个测试
	 * @param string $path
	 * @throws \Exception
	 * @return int
	 */
	static function test($path){
		$descriptorspec = [];
		$process = proc_open("./casperjs test {$path}", $descriptorspec, $pipes);
		if (is_resource($process)) {
		    return proc_close($process);
		}
		throw new Exception("不能运行casperjs");
	}
}