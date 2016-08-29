<?php

namespace Models;


class Album
{
    public $id='SERIAL';

    public $name='VARCHAR(100)';//краткое название
    public $description='TEXT';//описание
    public $dateCreate='BIGINT';//дата создания
    public $dateUpdate='BIGINT';//дата последнеего изменения
    public $cover='VARCHAR(100)';//имя файла обложки
    public $folder='VARCHAR(100)';//название папки

    const VARS_LIST = '`id` SERIAL NOT NULL, `folder` VARCHAR(100) NOT NULL, `name` VARCHAR(100), `description` TEXT, 
    `dateCreate` BIGINT, `dateUpdate` BIGINT, `cover` VARCHAR(100)';

}