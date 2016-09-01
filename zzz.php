<?php
require __DIR__ . '/autoload.php';
$n = new \Models\News();
//$news->createNewsTable();
//var_dump($news->addArticle('1 Сентября', 'Начало учебного года!'));

//$a=$news->getArticleByID(1);
//var_dump($a);
//echo date('d.m.Y (H:i)', $a[0]->dateCreate);

$a = $n->getLastArticlesTitles(2);
var_dump($a);