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
        $res = $db->execute(
            'SELECT * FROM ' . self::TABLE
            . ' WHERE TOVAR LIKE %:search%',
            array(':search' => $search)
        );
        return $res;
    }
}