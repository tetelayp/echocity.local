<?php
class Settings
{
    const DBNAME = 'dbEcho';
    const HOST = '127.0.0.1';
    const USER = 'root';
    const PASSWORD = '';

    const SITE_TITLE = 'EchoCity new version';
    const SITE_DESCRIPTION = 'My new site';
    const PATH_UPLOAD = 'assets/upload';

    const TABLE_NEWS = 'news';
    const ARTICLES_LIMIT = 5;

    const PATH_GALLERY = 'assets/gallery';
    const TABLE_GALLERY = 'gallery';
    
    const PATH_IMG_DEFAULT = 'assets/img';
    const TABLE_PICTURES = 'pictures';
    
    //public static function getGalleryURL()
    //{return $_SERVER['SERVER_NAME'] . '/' . self::PATH_GALLERY;}

}