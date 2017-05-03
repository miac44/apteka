<?php
namespace Modules\Models\Apteka;

use App\Model;

class DrugBalance extends Model
{
    const TABLE = 'DrugBalance';
    const COLUMNS = [
       'APTKOD'   => ['type'=>'integer'],
       'NOMKOD'   => ['type'=>'string'],
       'NOMNAME'   => ['type'=>'string'],
       'KODREAL'   => ['type'=>'string'],
       'PRKOD'   => ['type'=>'string'],
       'PRNAME'   => ['type'=>'string'],
       'GNVLP'   => ['type'=>'string'],
       'SHTRIH'   => ['type'=>'string'],
       'KOL'   => ['type'=>'string'],
       'PRICE'   => ['type'=>'string'],
    ];
    const RELATIONS = [
        'pharmacy'=>['type'=>'has_one','model'=>'Modules\Models\Apteka\Pharmacy', 'id'=>'APTKOD', 'connected_id'=>'APTKOD'],
    ];
}
