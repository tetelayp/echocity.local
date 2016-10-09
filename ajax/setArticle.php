<?php
require __DIR__ . '/../autoload.php';

//check authorization


if (isset($_POST['id']))$id = substr($_POST['id'],1);
$title = $_POST['title'];
if (trim($title)=='')$title='Новость';

$content = $_POST['content'];

if (trim($content)!=''){
    $db = new \Models\Db();
    $article = new \Models\Article();

    $article->title = $title;
    $article->content = $content;
    if (isset($id)){
        $article->id = $id;
    } else {
        $article->dateCreate = time();
    }


    echo $db->insertUpdateRecord(Settings::TABLE_NEWS,$article);
}


