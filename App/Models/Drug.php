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
        $bad_words =
            [
                'капс.',
                'упаковка',
                'п.п.о.',
                'контурная',
                'ячейковая',
                'таб.',
                ',',
                'кардио',
                'шип.',
                'п/киш-раств.',
                'раствор./кишечн.',
                'п.о.',
                'об.',
                'пор.',
                'д/приг.',
                'назальный',
                'р-ра'
            ];
        $bad_regexp =
            [
                '\d+\s?мг',
                '\d+\s?%',
                '№\s?\d+',
                'N\s?\d+',
                '\d+\s?мл',
            ];
        $result = array();
        foreach ($res as $v) {
//            $result[] =  substr($v->TOVNAME,0,strpos(trim($v->TOVNAME),' '));
            $result_word =$v->TOVNAME;
            foreach ($bad_words as $word) {
                $result_word =  str_replace($word, '', $result_word);
            }
            foreach ($bad_regexp as $regexp) {
                $result_word = preg_replace("/" . $regexp . "/i", "", $result_word);
            }
            $result_word = trim(preg_replace("/s+/"," ",$result_word));
            if (!in_array($result_word, $result)){
                $result[] = $result_word;
            }

        }
        return json_encode(array_unique($result), JSON_UNESCAPED_UNICODE);

    }

}