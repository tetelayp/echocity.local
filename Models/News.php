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

    public function htmlToText($html)
    {
        $html = str_replace('<?', 'V?', $html);
        $html = str_replace('?>', '?V', $html);
        $html = htmlentities ($html);
        return $html;
    }

    public function textToHtml ($text)
    {
        return html_entity_decode($text);
    }

    public function addArticle($title, $content)
    {
        $article = new Article();
        $article->title =  $title;
        $article->content = $content;
        $article->dateCreate = time();
        return $this->db->insertRecord(Settings::TABLE_NEWS, $article);
    }

    public function getArticleByID ($articleID)
    {
        return $this->db->getRecordsByID(Settings::TABLE_NEWS,$articleID, Article::class);
    }

    public function getArticlesCount()
    {
        $sql = 'SELECT COUNT(*) FROM '. Settings::TABLE_NEWS;
        $result = $this->db->query($sql);
        return $result[0][0];
    }

    public function getArticles ($firstID, $limit = Settings::ARTICLES_LIMIT)
    {
        $sql = 'SELECT * FROM `' . Settings::TABLE_NEWS . '` WHERE `id`<=' . $firstID . ' ORDER BY `id` DESC LIMIT ' . $limit;
        return $this->db->query($sql, Article::class);
    }

    public function getLastArticlesTitles ($limit = Settings::ARTICLES_LIMIT)
    {
        if (0==$limit)
        {
            $limit = $this->getArticlesCount();
        }
        $sql = 'SELECT `id`, `title`, `dateCreate` FROM `' . Settings::TABLE_NEWS . '` WHERE 1 ORDER BY `id` DESC LIMIT ' . $limit;
        return $this->db->query($sql, Article::class);
    }

}