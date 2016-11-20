<?php

namespace App\Models;

use App\Model;


class XMLImport extends Model
{

    protected static $instance;


    protected function __construct($xml_filename)
    {
    }

    public static function instance($xml_filename)
    {
        if (null === static::$instance) {
            static::$instance = simplexml_load_string(str_replace('xmlns="Employee"', '', file_get_contents($xml_filename)));
            $count = 0;
            $subdivisionArrayUnique = array();
            foreach (static::$instance->Employee as $value) {
                $main_post = "";
                $subdivision = "";
                foreach ($value->CardRecordList->CardRecord as $v) {
                    if ($v->PositionType->Name == "Основная должность"){
                        $main_post = $v->Post->Name;
                        $subdivision = preg_replace('/([0-9]+\.)(.+)/', '\\2', (string)$v->SubdivisionName);
                    };
                };
                static::$instance->Employee[$count]->MainPost->Name = $main_post;
                static::$instance->Employee[$count]->MainPost->SubdivisionName = $subdivision;
                $count++;
                if (!in_array($subdivision, $subdivisionArrayUnique)){
                    $subdivisionArrayUnique[] = $subdivision;
                };
            }
            // приводим теперь к удобному нам формату
            static::$instance->MO->title = preg_replace('/([0-9]+\.)(.+)/', '\\2', (string)static::$instance->Employee->Organization->Name);
            static::$instance->MO->id = (string)static::$instance->Employee->Organization->OID;
            foreach ($subdivisionArrayUnique as $value) {
                static::$instance->MO->addChild('SubdivisionName', $value);
            }
        }
        return static::$instance;
    }


}