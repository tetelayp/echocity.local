<?php

namespace Controllers;


use Models\Article;
use Models\Gallery;
use Models\News;
use Models\Settings;
use Models\User;
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
        $this->view->albumsArray = $this->gallery->getAlbumsArray();

        $this->news = new News();
        $this->view->articlesTitles = $this->news->getLastArticlesTitles(7);

        //check authorization
        session_start();
        if (isset($_SESSION['echoAuthorize'])){
            $this->view->login = true;
            echo 'Authorize';
        } else {
            $this->view->login = false;
        }
    }

    public function actionLogin()
    {

        $user = User::getUser(1,2);
        if($user){
            if (!isset($_SESSION['echoAuthorize'])) {
                if ( !session_id() ) session_start();

                $_SESSION['echoAuthorize'] = $user->id;

                $this->view->login = true;
                echo 'LOGIN';
            }
        }
        $this->actionDefault();
    }

    public function actionLogout()
    {
            if (session_id()) {

                setcookie(session_name(), session_id(), time()-60*60*24);

                session_destroy();
                $this->view->login = false;
                echo 'LOGOUT';
            }
        $this->actionDefault();
    }

    public function actionDefault()
    {
        $this->view->subTemplate = 'main.php';
        $this->view->display(__DIR__ . '/../templates/index.php');
    }


    public function actionEdit($id)
    {
        //check permission
        if(true)
        {
            $article = $this->news->getArticleByID($id);
            if (!$article){
                $article = new Article();
            }
            
            $this->view->editArticle = $article;
            $this->view->subTemplate = 'editor.php';
            $this->view->display($_SERVER['DOCUMENT_ROOT'] . '/templates/index.php');
        }
    }


    public function actionNews($page = 1)
    {
        $this->view->pagesCount = 11112;//(int) ceil($this->news->getArticlesCount() / \Settings::ARTICLES_LIMIT);// количесво страниц новостей


        $this->view->articles = $this->news->getArticles($page);// новости лоя заданной страницы

        if (substr($page,0,1)!='n')
        {
            $this->view->currentPage = (int) $page;
        } else {
            $articleNumber = substr($page,1);
            $this->view->currentPage = (int) floor($articleNumber / \Settings::ARTICLES_LIMIT);

        }

        $this->view->pagesArray = $this->news->getPagesArray($this->view->currentPage, $this->view->pagesCount);


        $this->view->subTemplate = 'news.php';
        $this->view->display($_SERVER['DOCUMENT_ROOT'] . '/templates/index.php');
    }

    public function actionGallery($albumID)
    {
        $album = $this->gallery->getAlbum($albumID);

        if (!$album)
        {
            $lst = $this->view->albumsArray;
            $this->view->header = 'Альбомы';
            $this->view->subTemplate = 'gallery.php';
        } else {
            $this->view->folder = $this->gallery->getAlbumParamByID($albumID, 'folder');
            $lst = $this->gallery->getAlbum($albumID);

            $this->view->header = $this->gallery->getAlbumParamByID($albumID, 'label');
            $this->view->subTemplate = 'album.php';
        }

        $this->view->gallery = $lst;


        $this->view->display($_SERVER['DOCUMENT_ROOT'] . '/templates/index.php');
    }
}