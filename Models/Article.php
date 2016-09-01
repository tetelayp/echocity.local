<?php
namespace Models;


class Article
{
    public $id;
    public $title;//краткое название
    public $content;//описание
    public $dateCreate;//дата создания

    const VARS_LIST = '`id` SERIAL, `title` VARCHAR(100), `content` TEXT, `dateCreate` INT';
}