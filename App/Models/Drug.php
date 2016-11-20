<?php

namespace App\Models;

use App\Model;


class Drug extends Model
{
    const TABLE = "main";

    public $TOVNAME;

    public function search($search)
    {
        $db = \App\Db::instance();
        $res = $db->query(
            'SELECT * FROM ' . self::TABLE
            . ' WHERE TOVNAME LIKE :search',
            __CLASS__,
            array('search' => '%' . $search . '%')
        );
        return $res;
    }

    public function searchTovname($search)
    {
        $db = \App\Db::instance();
        $res = $db->query(
            'SELECT TOVNAME FROM ' . self::TABLE
            . ' WHERE TOVNAME LIKE :search',
            __CLASS__,
            array('search' => '%' . $search . '%')
        );
        return $res;
    }

    public function json_search($search)
    {
        $db = \App\Db::instance();
        $res = $db->query(
            'SELECT TOVNAME FROM ' . self::TABLE
            . ' WHERE TOVNAME LIKE :search',
            __CLASS__,
            array('search' => '%' . $search . '%')
        );
        $result = array();
        foreach ($res as $v) {
            $result[] = $v->TOVNAME;
        }
        return json_encode($result, JSON_UNESCAPED_UNICODE);

    }

}