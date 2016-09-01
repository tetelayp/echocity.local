<?php
require __DIR__ . '/autoload.php';
$news = new \Models\News();
//$news->createNewsTable();
var_dump($news->addArticle('Появились новые работы в разделах \'Разное, Техника, Дерево, Паяльник, Туризм, Отдых, Кулинария\'', 'Друзья, приглашаю Вас взглянуть на эти фото!'));