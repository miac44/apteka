<?php
namespace App;
trait GetterSetter 
{
	protected $data = [];
    public function __set($k, $v)
    {
        $this->data[$k] = $v;
    }

    public function __get($k)
    {
        return $this->data[$k];
    }

    public function __isset($k)
    {
    	return isset($this->data[$k]);
    }

    public function count()
    {
        return count($this->data);
    }


 }