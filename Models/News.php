<?php
namespace Models;

class News
{

    protected $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function createNewsTable()
    {
        return $this->db->createTable(Settings::TABLE_NEWS, Article::VARS_LIST);
    }

    public function addArticle($title, $content)
    {
        $article = new Article();
        $article->title = $title;
        $article->content = $content;
        $article->dateCreate = time();
        return $this->db->insertRecord(Settings::TABLE_NEWS, $article);
    }
}