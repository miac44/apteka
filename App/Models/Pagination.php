<?php
namespace App\Models;

class Pagination
{
    public $current = 1;
    public $url = '/pages/';
    public $count = 1;

    public function __construct($records_count, $records_per_page)
    {
        $this->count = ceil($records_count/$records_per_page);
    }
}