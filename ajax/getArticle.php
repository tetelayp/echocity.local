<?php
require __DIR__ . '/../autoload.php';

//check authorization

sleep(1);
//var_dump($_POST);
$id = substr($_POST['id'],1);
$db = new \Models\Db();
$artticles = $db->getRecordsByID(Settings::TABLE_NEWS,$id,\Models\Article::class);
if ($artticles){
    $title = $artticles[0]->title;
    $content = $artticles[0]->content;
} else {
    $title = '';
    $content = '';
}

echo $title . '+split+' . $content;