<?php

namespace Controllers;


use Models\Gallery;
use Models\News;
use Models\Settings;
use Models\View;

class Index extends Controller
{
    protected $gallery;
    protected $albumsArray;
    protected $news;

    public function __construct()
    {
        parent::__construct();

        $this->gallery = new Gallery();
        $this->albumsArray = $this->gallery->getAlbumsArray();
        $this->view->albumsArray = $this->albumsArray;

        $this->news = new News();
        $this->view->articlesTitles = $this->news->getLastArticlesTitles(7);
    }

    public function actionDefault()
    {
        $this->view->subTemplate = 'main.php';
        $this->view->display(__DIR__ . '/../templates/index.php');
    }

    public function actionNews($page = 0)
    {
        $this->view->pagesCount = ceil($this->news->getArticlesCount() / \Settings::ARTICLES_LIMIT);

        $this->view->articles = $this->news->getArticles($page);

        if (substr($page,0,1)!='n')
        {
            $this->view->currentPage = $page;
        } else {
            $articleNumber = substr($page,1);
            $this->view->currentPage = floor($articleNumber / \Settings::ARTICLES_LIMIT);

        }

        $this->view->subTemplate = 'news.php';
        $this->view->display(__DIR__ . '/../templates/index.php');
    }

    public function actionGallery($albumID)
    {
        $album = $this->gallery->getAlbum($albumID);

        if (!$album)
        {
            $lst = $this->albumsArray;
            $this->view->header = 'Альбомы';
            $this->view->subTemplate = 'gallery.php';
        } else {
            $this->view->folder = $this->gallery->getAlbumParamByID($albumID, 'folder');
            $lst = $this->gallery->getAlbum($albumID);

            $this->view->header = $this->gallery->getAlbumParamByID($albumID, 'label');
            $this->view->subTemplate = 'album.php';
        }

        $this->view->gallery = $lst;


        $this->view->display(__DIR__ . '/../templates/index.php');
    }
}