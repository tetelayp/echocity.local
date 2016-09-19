<?php
require __DIR__ . '/../autoload.php';

//check authorization


$title = '';
$content = '';
if (isset($_POST['id'])){
    sleep(1);/////////////////////////////////////////
    $id = substr($_POST['id'],1);
    $db = new \Models\Db();
    $artticles = $db->getRecordsByID(Settings::TABLE_NEWS,$id,\Models\Article::class);
    if ($artticles){
        $title = $artticles[0]->title;
        $content = $artticles[0]->content;
    }
}


echo $title . '+split+' . $content;