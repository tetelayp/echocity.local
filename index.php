<?php
require __DIR__ . '/autoload.php';

$url = $_SERVER['REQUEST_URI'];

$parts = explode('/', $url);

if (isset($parts[1]))
{
    $ctrl = !$parts[1] ? 'Index' : $parts[1];
} else {
    $ctrl = 'Index';
}

if (isset($parts[2]))
{
    $action = !$parts[2] ? 'Default' : $parts[2];
} else {
    $action = 'Default';
}

if (isset($parts[3]))
{
    $param = !$parts[3] ? 0 : $parts[3];
} else {
    $param = 0;
}

try {
    //$a = new Exception('Message',12345);
    //throw $a;
    $ctrlClass = 'Controllers\\'. ucfirst($ctrl);

    if (!class_exists($ctrlClass)){
        $ctrlClass = 'Controllers\\Index';
        $actionMethodName = 'actionDefault';
    } else {
        $actionMethodName = 'action' . ucfirst($action);
    }
    $controller = new $ctrlClass;

    if (!method_exists($controller, $actionMethodName)){
        $actionMethodName = 'actionDefault';
    }
    $controller->$actionMethodName($param);

} catch (Exception $e)
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

