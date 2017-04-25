<?php
namespace Modules\Models\Apteka;

use App\Model;

class Coords extends Model
{
    const TABLE = 'PharmacyCoords';
    const COLUMNS = [
       'APTKOD'   => ['type'=>'integer'],
       'latitude'   => ['type'=>'string'],
       'longitude'   => ['type'=>'string']
    ];
    const RELATIONS = [
        'pharmacy'=>['type'=>'has_one','model'=>'Modules\Models\Apteka\Pharmacy', 'field'=>'APTKOD'],
    ];
}
