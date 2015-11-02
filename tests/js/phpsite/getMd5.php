<?php

$filename = $_GET['filename'];
echo md5(file_get_contents($filename));
exit();