<?php

namespace App\Models;

use App\Model;


class Filelist extends Model
{

    protected static $instance;


    protected function __construct()
    {
    }

    public static function instance($directory)
    {
        if (null === static::$instance) {
            $filelist = glob($directory . "*.xml");
            foreach ($filelist as $key => $filename) {
                $file = new File();
                $file->name = basename($filename);
                $file->viewname = iconv('windows-1251', 'utf-8' , basename($filename));
                $file->urlname = urlencode(basename($filename));

                $file->size = filesize($filename);
                $file->upload = date("d-m-Y H:i:s", filemtime($filename));
                $file->moid = substr($file->name,11,10);
                $article = new Article($file->moid);
                $file->url = $article->getURL();
                $file->modate = str_replace("_", "-", substr($file->name,0,10));
                static::$instance[] = $file;
            }
        }
        return static::$instance;
    }


}