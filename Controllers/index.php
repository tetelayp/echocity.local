<?php

namespace Controllers;


use Models\Gallery;
use Models\View;

class Index extends Controller
{
    protected $gallery;
    protected $albumsArray;

    public function __construct()
    {
        parent::__construct();
        $this->gallery = new Gallery();
        $this->albumsArray = $this->gallery->getAlbumsArray();
        $this->view->albumsArray = $this->albumsArray;

    }

    public function actionDefault()
    {
        $this->view->subTemplate = 'main.php';
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