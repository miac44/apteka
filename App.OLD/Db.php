<?php
// TODO вынести повторяющиеся строки
namespace App;

use \App\Exceptions\DBException;

class Db
{

    use Singleton;

    protected $dbh;

    protected function __construct()
    {
        try {
            $this->dbh = new \PDO('mysql:host=' . \App\Config::instance()->db['host'] . ';dbname=' . \App\Config::instance()->db['dbname'], \App\Config::instance()->db['user'], \App\Config::instance()->db['pass']);
            $this->execute('SET NAMES UTF8');
        } catch (\PDOException $e){
            throw new DBException('Ошибка соединения с базой данных');
        }
    }

    public function execute($sql, $substitutions = array())
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $res = $sth->execute($substitutions);
        } catch (\PDOException $e){
            throw new DBException('Ошибка соединения в запросе');
        }
        return $res;
    }

    public function query($sql, $class, $substitutions = array())
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($substitutions);
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    public function queryRaw($sql, $substitutions = array())
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($substitutions);
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function query_one_element($sql, $class, $substitutions = array())
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $res = $sth->execute($substitutions);
        } catch (\PDOException $e){
            throw new DBException('Ошибка соединения в запросе');
        }
        return $sth->fetchObject($class);
    }

    public function getLastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}