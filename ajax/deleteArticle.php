<?php
require __DIR__ . '/../autoload.php';

//check authorization


if (isset($_POST['id'])) {
    $id = substr($_POST['id'], 1);

    $news = new \Models\News();
    $news->deleteArticleByID($id);

}

//echo $db->insertUpdateRecord(Settings::TABLE_NEWS,$article);

