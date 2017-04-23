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

    /**
     * @param $search
     * @return string
     */
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
            $result_word =$v->TOVNAME;
            foreach (\App\Config::instance()->bad_words as $word) {
                if (strpos($result_word, $word)>0) {
                    $result_word = substr($result_word, 0, strpos($result_word, $word));
                };
            };
            foreach (\App\Config::instance()->bad_regexp as $regexp) {
                $result_word = preg_replace("/^(.+)" . $regexp . "(.+)$/iU", "$1", $result_word);
            };
            $result_word = trim(preg_replace("/s+/"," ",$result_word));
            if (!in_array($result_word, $result)){
                $result[] = $result_word;
            };
        }
        return json_encode(array_unique($result), JSON_UNESCAPED_UNICODE);

    }

}