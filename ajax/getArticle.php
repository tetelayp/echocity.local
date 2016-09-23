<?php
require __DIR__ . '/../autoload.php';

//check authorization


$title = '';
$content = '';
if (isset($_POST['id'])){
    //sleep(1);/////////////////////////////////////////
    $id = substr($_POST['id'],1);

    $news = new \Models\News();
    $article = $news->getArticleByID($id);

    if ($article){
        $title = $article->title;
        $content = $article->content;
    }
}


echo $title . '+split+' . $content;