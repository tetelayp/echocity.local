<?php
require __DIR__ . '/autoload.php';


//var_dump($_SERVER['SERVER_NAME']);


$url = $_SERVER['REQUEST_URI'];

$parts = explode('/', $url);

if (isset($parts[1]))
{

}


$ctrl = !$parts[1] ? 'Index' : $parts[1];
$action = !$parts[2] ? 'Default' : $parts[2];
$param = !$parts[3] ? 0 : $parts[3];

var_dump($ctrl);
var_dump($action);
var_dump($param);


//$action = $parts[2] ?: 'Default';

//$ctrl = 'Index';
//$action = 'Gallery';
//$param = 31;
try {
    $ctrlClass = 'Controllers\\'. ucfirst($ctrl);
    $controller = new $ctrlClass;

    $actionMethodName = 'action' . ucfirst($action);
    $controller->$actionMethodName($param);
} catch ( PDOException $e )
{
    echo 'Ошибка: ' . $e->getMessage();
}

//$a = new \Models\Gallery();
//var_dump($a->getAlbumsArray());


//$a= new \Models\Db();
//$a->createTable(\Models\Settings::TABLE_GALLERY, \Models\Album::VARS_LIST);


/*
$alb = new \Models\Album();
$alb->folder = 'Dir';
$alb->name = 'first';
$alb->description = '"123desc" \'a\'';
$alb->cover = 'cover.jpg';



foreach ($f as $k=>$v){
    $alb->folder = $v;
    $alb->name = $k . 'album';
    $alb->dateCreate = microtime(true);
    $alb->dateUpdate = microtime(true);
    //var_dump($alb);
    echo '<br>';
    $a->insertRecord(\Models\Settings::TABLE_GALLERY, $alb);
}

$r = $a->getAllRecords(\Models\Settings::TABLE_GALLERY, \Models\Album::class);

var_dump($r);/**/
//$a->getPropsArray($alb);
//require __DIR__ . '/template/index.php';

