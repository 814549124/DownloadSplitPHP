<?php

include '../../../src/DownloadSplit.php';

$filename = $_GET['filename'];

$limit = $_GET['limit'];

$d = new \hjj\DownloadSplit($limit);

$d->begin($filename);
$d->go();
