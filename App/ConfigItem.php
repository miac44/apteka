<?php

namespace App;

class ConfigItem
{

    public function __construct($data)
    {
        foreach ($data as $k => $v) {
            $this->$k = $v;
        }
    }

    public function __get($k)
    {
        if (is_array($this->$k)){
            return new ConfigItem($this->$k);
        } else {
            return $this->$k;
        }
    }

}