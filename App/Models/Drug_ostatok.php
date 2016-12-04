<?php
namespace App\Models;
use App\Model;

class Drug_ostatok extends Model
{
    const TABLE = "ostatok";

    public $NOMNAME;

    public function search($search)
    {
        $search = str_replace(' ', '%', $search);
        $db = \App\Db::instance();
        $res = $db->query(
            'SELECT * FROM ' . self::TABLE
            . ' WHERE NOMNAME LIKE :search',
            __CLASS__,
            array('search' => '%' . $search . '%')
        );
        return $res;
    }

    public function searchwithpharmacy($search)
    {
        $search = str_replace(' ', '%', $search);
        $db = \App\Db::instance();
        $res = $db->query(
            'SELECT ostatok.*, apteki.* FROM ' . self::TABLE
            . ' LEFT JOIN apteki ON ostatok.APTKOD=apteki.APTKOD'
            . ' WHERE ostatok.NOMNAME LIKE :search',
            __CLASS__,
            array('search' => '%' . $search . '%')
        );
        return $res;
    }

    public function searchNomname($search)
    {
        $db = \App\Db::instance();
        $res = $db->query(
            'SELECT NOMNAME FROM ' . self::TABLE
            . ' WHERE NOMNAME LIKE :search',
            __CLASS__,
            array('search' => '%' . $search . '%')
        );
        return $res;
    }


}