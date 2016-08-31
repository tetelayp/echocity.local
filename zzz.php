<?php
require __DIR__ . '/autoload.php';
$db = new \Models\Db();

//var_dump($db->getRecordsByID(\Models\Settings::TABLE_GALLERY, 31, \Models\Album::class));

//$db->createTable(\Models\Settings::TABLE_PICTURES, \Models\Picture::VARS_LIST);

$glr = new \Models\Gallery();

var_dump($glr->getAlbum(31));
/*
$arr = \Models\Gallery::getFileArray('a_000002');


$glr->addPicsArrayToTable(33,$arr);
/**/