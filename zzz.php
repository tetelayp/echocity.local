<?php
require __DIR__ . '/autoload.php';
//$n = new \Models\News();

//$news->createNewsTable();
//var_dump($news->addArticle('1 Сентября', 'Начало учебного года!'));

//$a=$news->getArticleByID(1);
//var_dump($a);
//echo date('d.m.Y (H:i)', $a[0]->dateCreate);

//$a = $n->getLastArticlesTitles(2);

$db = new \Models\Db();
$article = new \Models\Article();
//$article->id = '16';
$article->title = 'Заголовок';
$article->content = 'Content Ha-Ha-Ha +++ <?php var_dump(12345);) ?>';
$article->dateCreate = time();

var_dump($db->insertUpdateRecord(Settings::TABLE_NEWS,$article));