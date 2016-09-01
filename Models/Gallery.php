<?php

namespace Models;


class Gallery
{
    protected $db;

    public function __construct()
    {
        $this->db = new Db();
    }


    public function createGalleryTable()
    {
        return $this->db->createTable(Settings::TABLE_GALLERY, Album::VARS_LIST);
    }


    public function getAlbumsArray()
    {
        return $this->db->getAllRecords(Settings::TABLE_GALLERY, Album::class);
    }

    public function getAlbumParamByID($albumID, $param)
    {
        $query = $this->db->getRecordsByID(Settings::TABLE_GALLERY, $albumID, Album::class);
        if(!isset($query[0]))
        {
            return false;
        }
        return $query[0]->$param;
    }


    public function getAlbum ($albumID)
    {
        return $this->db->query('SELECT * FROM `' . Settings::TABLE_PICTURES . '` WHERE albumID=' . $albumID, Picture::class);
    }

    public function addPicsArrayToTable($albumID, $fileNamesArray)
    {
        $album = $this->db->getRecordsByID(Settings::TABLE_GALLERY, $albumID,Album::class);
        if (!isset($album[0]))
            {
                return false;
            }

        foreach ($fileNamesArray as $name){
            $pic = new Picture();
            $pic->albumID = $albumID;
            $pic->dateCreate = time();
            $pic->filename = $name;
            $pic->label = 'file - ' . $name;
            $pic->description = 'Album - ' . $album[0]->folder . ', file - ' . $name;
            $this->db->insertRecord(Settings::TABLE_PICTURES, $pic);
        }
        return true;
    }

    public static function getFoldersArray()
    {
        $path = __DIR__ . '/../' . Settings::PATH_GALLERY;

        if (file_exists($path))
        {
            $currentDir = opendir ($path);
            while (false !== ($currentFile = readdir ($currentDir)))
            {
                if ((filetype($path."/".$currentFile)=="dir")&&($currentFile!=".")&&($currentFile!=".."))
                {
                    $dirs[]=$currentFile;
                }
            }
            closedir ($currentDir);
        }
        if (!isset($dirs)){
            $dirs=false;
        } else{
            sort($dirs,SORT_REGULAR);
        }
        return $dirs;
    }

    public static function getFileArray($folderName)
    {
        $path = __DIR__ . '/../' . Settings::PATH_GALLERY . '/' . $folderName;
        if (!file_exists($path))
            {
                return false;
            }
        $currentDir = opendir ($path);
        $dirs=[];
        while (false !== ($currentFile = readdir ($currentDir)))
        {
            if ((filetype($path."/".$currentFile)!="dir")&&($currentFile!=".")&&($currentFile!=".."))
            {
                $dirs[]=$currentFile;
            }
        }
        closedir ($currentDir);

        sort($dirs,SORT_REGULAR);

        return $dirs;
    }
}