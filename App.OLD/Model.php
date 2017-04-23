<?php

namespace App;

abstract class Model
{

    const TABLE = '';

    public static function findAll()
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            static::class
        );
    }


    public static function findById($id)
    {
        $db = Db::instance();
        $res = $db->query_one_element(
            'SELECT * FROM ' . static::TABLE
            . ' WHERE id=:id',
            static::class,
            array('id' => $id)
        );
        return $res;
    }

    public function isNew()
    {
        return empty($this->id);
    }
    public function insert()
    {
        if (!$this->isNew()) {
            return;
        }
        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }
            $columns[] = $k;
            $values[':'.$k] = $v;
        }
        $sql = '
            INSERT INTO ' . static::TABLE . '
            (' . implode(',', $columns) . ')
            VALUES
            (' . implode(',', array_keys($values)) . ')
                    ';
        $db = Db::instance();
        $db->execute($sql, $values);
        $this->id = $db->getLastInsertId();
    }

    public function update()
    {
        if ($this->isNew()) {
            return;
        }
        $values = [];
        $sql = '
            UPDATE ' . static::TABLE . ' SET ';

        foreach ($this as $k => $v) {
            $values[':'.$k] = $v;
            if ($k == 'id'){
                continue;
            }
            $sql .= $k . '=:' . $k;
            $sql .= ', ';
        }
        $sql = substr($sql, 0, -2);
        $sql .= ' WHERE id=:id';
        $db = Db::instance();
        $db->execute($sql, $values);
    }

    public function delete()
    {
        if ($this->isNew()) {
            return;
        }
        $sql = '
            DELETE FROM ' . static::TABLE . '
            WHERE id=:id';
        $db = Db::instance();
        $db->execute($sql, array(':id' => $this->id));
    }

    public function save()
    {
        if ($this->isNew()) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public static function getLatest(int $count)
    {
        $db = Db::instance();
        $res = $db->query(
            'SELECT * FROM ' . static::TABLE
            . ' ORDER BY created_at DESC'
            . ' LIMIT 0,' . $count,
            static::class
        );

        if (count($res) == 0) {
            return [];
        }
        return $res;
    }

}