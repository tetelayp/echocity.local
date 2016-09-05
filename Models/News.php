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
        return $this->db->createTable(\Settings::TABLE_NEWS, Article::VARS_LIST);
    }

    public function htmlToText($html)
    {
        $html = str_replace('<?', 'V?', $html);
        $html = str_replace('?>', '?V', $html);
        $html = htmlentities($html);
        return $html;
    }

    public function textToHtml($text)
    {
        return html_entity_decode($text);
    }

    public function addArticle($title, $content)
    {
        $article = new Article();
        $article->title = $title;
        $article->content = $content;
        $article->dateCreate = time();
        return $this->db->insertRecord(\Settings::TABLE_NEWS, $article);
    }

    public function getArticleByID($articleID)
    {
        return $this->db->getRecordsByID(\Settings::TABLE_NEWS, $articleID, Article::class);
    }

    public function getArticlesCount()
    {
        $sql = 'SELECT COUNT(*) FROM ' . \Settings::TABLE_NEWS;
        $result = $this->db->query($sql);
        return $result[0][0];
    }

    public function getArticles($page, $limit = \Settings::ARTICLES_LIMIT)
    {
        if ($page <0){
            $page = 0;
        }
        if (!$limit) {
            $limit = $this->getArticlesCount();
        }
        if (0 == $limit) {
            return [];
        }

        if (substr($page,0,1)!='n')
        {
            $articlesTitles = $this->getLastArticlesTitles(0);

            $pos = $page * $limit;

            if ($pos >= count($articlesTitles)) {
                $pos = count($articlesTitles) - 1;
            }

            $firstID = $articlesTitles[$pos]->id;
        } else {
            $firstID = substr($page,1);
        }



        $sql = 'SELECT * FROM `' . \Settings::TABLE_NEWS . '` WHERE `id`<=' . $firstID . ' ORDER BY `id` DESC LIMIT ' . $limit;
        return $this->db->query($sql, Article::class);
    }

    public function getLastArticlesTitles($limit = \Settings::ARTICLES_LIMIT)
    {
        if (0 == $limit) {
            $limit = $this->getArticlesCount();
        }
        if (0 == $limit) {
            return [];
        }

        $sql = 'SELECT `id`, `title`, `dateCreate` FROM `' . \Settings::TABLE_NEWS . '` WHERE 1 ORDER BY `id` DESC LIMIT ' . $limit;
        return $this->db->query($sql, Article::class);
    }

    /**
     * Возвращает упорядоченный массив чисел с номерами страниц новостей для использования в быстрых ссылках
     * @param $currentPage - текущая страница
     * @param int $pagesCount - количество страниц новостей
     * @param int $delta - количество идущих подряд ссылок типа - 1, 2, 3, 4,
     * @param int $interval - количество идущих подряд ссылок типа - 10, 20, 30, 40,
     */
    public function getPagesArray($currentPage, $pagesCount = 0, $delta = 5, $interval = 10)
    {
        if (0 == $pagesCount)
        {
            $pagesCount = ceil($this->getArticlesCount() / \Settings::ARTICLES_LIMIT);
        }
        if (0 == $pagesCount){
            return [];
        }

        if ($currentPage < 0){
            $currentPage = 0;
        }
        if ($currentPage >= $pagesCount){
            $currentPage = $pagesCount - 1;
        }

        $result = [];
        for ($i = 0; ($i<$delta)&($i<$currentPage) ;$i++){
            $result[$i]=$i;
        }

        for ($i = 0; ($i<$delta);$i++){
            $pos = $currentPage - $i;
            if (0 <= $pos){
                $result[$pos]=$pos;
            }
            $pos = $currentPage + $i;
            if (($pagesCount-1) >= $pos){
                $result[$pos]=$pos;
            }
        }


        for ($i = $pagesCount-1; ($i>$pagesCount-1-$delta)&&($i>$currentPage) ;$i--){
            $result[$i]=$i;
        }


        $step = floor($currentPage / $interval);
        if (0 >= $step){
            $step = 1;
        }

        $z = strlen($step);
        if ($z>1){
            $step = substr($step,0,1)* pow(10,$z-1);
        }

        for ($i = $step-1; $i < $currentPage; $i+=$step){
            $result[$i]=$i;
        }


        $step = floor(($pagesCount-$currentPage) / $interval);
        if (0 >= $step){
            $step = 1;
        }

        $z = strlen($step);
        if ($z>1){
            $step = substr($step,0,1)* pow(10,$z-1);
        }

        $startPos = (int) ceil(($currentPage + $step)/10)*10-1;
        if ($startPos < 0){
            $startPos = 0;
        }
        for ($i = $startPos; $i < $pagesCount; $i+=$step){
            $result[$i]=$i;
        }
        sort($result);
        return $result;
    }

}