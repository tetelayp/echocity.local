<?php

namespace Models;


class Album
{
    public $id;
    public $folder;//название папки
    public $label;//краткое название
    public $description;//описание
    public $dateCreate;//дата создания
    public $dateUpdate;//дата последнеего изменения
    public $cover;//имя файла обложки

    const VARS_LIST = '`id` SERIAL, `folder` VARCHAR(100) NOT NULL, `label` VARCHAR(100), `description` TEXT, 
    `dateCreate` INT, `dateUpdate` INT, `cover` VARCHAR(100)';

}