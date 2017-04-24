<?php

namespace App;

abstract class Model
{
    const TABLE = '';
    const COLUMNS = [];
    const RELATIONS = [];

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

    public static function findByLinkedId($linkname, $id)
    {
        $db = Db::instance();
        $res = $db->query(
            'SELECT * FROM ' . static::TABLE
            . ' WHERE ' . $linkname. '=:id',
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
            (' . implode(',', $columns) . ', created_at)
            VALUES
            (' . implode(',', array_keys($values)) . ', NOW())
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

    public function __get($k)
    {
        if (key_exists($k, static::RELATIONS)){
            if (isset($this->{$k . "_id"})){
                if (static::RELATIONS[$k]['type']=='has_one'){
                    return static::RELATIONS[$k]['model']::findById($this->{$k . "_id"});
                } 
            };
            if (isset($this->id)){
                if (static::RELATIONS[$k]['type']=='has_many'){
                    return static::RELATIONS[$k]['model']::findByLinkedId($this->getLinkedId() . "_id", $this->id );
                } 
            };
            return false;
        }
        return NULL;
    }

    public function __isset($k)
    {
        return key_exists($k, static::RELATIONS);
    }

    public function getLinkedId()
    {
        return strtolower(preg_replace('#.+\\\#', '', static::class));
    }

    public static function search($data = ['1' => '1'])
    {
        $db = Db::instance();
        $sql = '
            SELECT * FROM ' . static::TABLE . ' WHERE ';
        $values = [];
        foreach ($data as $k => $v) {
            $values[':'.$k] = '%' . $v . '%';
            $sql .= $k . ' LIKE :' . $k;
            $sql .= ' AND ';
        }
        $sql = substr($sql, 0, -5);
        $res = $db->query(
            $sql,
            static::class,
            $values
        );
        return $res;
    }

    public static function extendedSearch($data = ['1' => '1'])
    {
        foreach ($data as $k=>$v) {
            $data[$k] = str_replace(' ', '%', $v);
        }
        return self::search($data);
    }

}