<?php
require __DIR__ . '/autoload.php';

$a= new \Models\Db();
$a->createTable('gallery', \Models\Album::VARS_LIST);

//require __DIR__ . '/template/index.php';

