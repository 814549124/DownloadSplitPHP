<?php
namespace hjj;

/**
* 分片的下载文件
*/
class DownloadSplit
{
	protected $send_limit;
	protected $resource_file;
	protected $filename;
	protected $fsize;
	protected $mimeType;

	function __construct($send_limit = 204800)
	{
		$this->send_limit = $send_limit;
	}

	/**
	 * 分片下载前的准备
	 * @param string $path
	 * @param string $filename
	 * @param string $mimeType
	 * @throws \Exception
	 */
	function begin($path,$filename = null,$mimeType = 'octer-stream'){
		if (!file_exists($path)) {
			throw new \Exception("文件未找到!");
		}
		$this->resource_file = fopen($path, 'rb');
		$this->fsize = filesize($path);
		if (!$filename) {
			$this->filename = basename($path);
		}else{
			$this->filename = $filename;
		}
		$this->mimeType = $mimeType;
	}
	/**
	 * 进行循环的分片下载
	 * @throws \Exception
	 * @return bool
	 */
	function go(){
		ob_start();
		$start = 0 ;
		$send_len = $this->fsize;
		$end = $send_len - 1;
		if (array_key_exists('HTTP_Range',$_SERVER)) {
			$range_info = $_SERVER['HTTP_Range'];
			list($type,$range) = explode('=',$request->headers->get('Range'));
        	switch ($type) {
        		case 'bytes':
        			list($start,$end) = explode('-', $range);
        			if (fseek($this->resource_file, $start)) {
        				header('HTTP/1.1 416 Error!');
			            return false;
			        }
			        $send_len = $end - $start + 1;
        			break;
        		default:
        			throw new \Exception("未处理这种分片协议");
        			break;
        	}
		}

		header('Content-type: '.$this->mimeType);
		header('Accept-Ranges: bytes');
		header('Content-Range: bytes '.$start.'-'.$end.'/'.$this->fsize);
		header('Content-Length: '.$send_len);
		header('Content-Disposition: attachment;filename='.$this->filename);
		while(!feof($this->resource_file)){
	        $fileNowPos = ftell($this->resource_file);
	        if ($fileNowPos >= $end) {
	            break;
	        }
	        echo fread($this->resource_file,$this->send_limit);
	        flush();
	        ob_flush();
	    }
	    fclose($this->resource_file);
    	return true;
	}

}