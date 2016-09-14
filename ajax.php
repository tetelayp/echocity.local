<?php
sleep(1);
var_dump($_POST);
$res='';
if (isset($_POST['title'])){
$res.='Title - ' . $_POST['title'];
}
$res.='<split>';
if (isset($_POST['content'])){
    $res.='Content - ' . $_POST['content'];
}
echo $res . '<br>' . date('d-m-Y h:i:s', time());