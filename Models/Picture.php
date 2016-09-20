<?php
namespace Models;

class Picture
{
    public $id;
    public $albumID;
    public $label;//краткое название
    public $description;//описание
    public $dateCreate;//дата создания
    public $filename;//имя файла
    public $info;//информация о файле файла

    const VARS_LIST = '`id` SERIAL, `albumID` BIGINT, `label` VARCHAR(100), `description` TEXT, 
    `dateCreate` INT, `filename` VARCHAR(100), `info` VARCHAR(50)';

}