<?php

namespace App\Models;

use App\Model;


class Drug extends Model
{
	const TABLE="main";

	public $TOVAR;

    public function search($search)
    {
        $db = \App\Db::instance();
        $res = $db->query(
            'SELECT * FROM ' . self::TABLE
            . ' WHERE TOVAR LIKE %:search%',
            __CLASS__,
            array(':search' => $search)
        );
        return $res;
    }

}