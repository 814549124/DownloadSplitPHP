教程
====

用法
-------
```php
$path = '某文件';
$filename = '重命名';
$mime = '某MIME TYPE';
$dsp = new \hjj\DownloadSplit();
$dsp->begin($path,$filename,$mime);
$dsp->go();
