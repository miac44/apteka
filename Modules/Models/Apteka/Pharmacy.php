<?php
namespace Modules\Models\Apteka;

use App\Model;

class Pharmacy extends Model
{
    const TABLE = 'Pharmacy';
    const COLUMNS = [
       'APTKOD'   => ['type'=>'integer'],
       'APTNAME'   => ['type'=>'string'],
       'ADRESS'   => ['type'=>'string'],
       'TIME'   => ['type'=>'string'],
       'PHONE'   => ['type'=>'string'],
       'INFO'   => ['type'=>'string'],
    ];
    const RELATIONS = [
        'drugs'=>['type'=>'has_many','model'=>'Modules\Models\Apteka\DrugBalance', 'field'=>'APTKOD'],
        'coords'=>['type'=>'has_one','model'=>'Modules\Models\Apteka\Coords', 'field'=>'APTKOD'],
    ];
}
