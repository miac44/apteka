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
    ];

    public function searchwithpharmacy($search)
    {
        $search = str_replace(' ', '%', $search);
        $db = \App\Db::instance();
        $res = $db->query(
            'SELECT DrugBalance.*, Pharmacy.* FROM ' . self::TABLE
            . ' LEFT JOIN Pharmacy ON DrugBalance.APTKOD=Pharmacy.APTKOD'
            . ' WHERE DrugBalance.NOMNAME LIKE :search',
            __CLASS__,
            array('search' => '%' . $search . '%')
        );
        return $res;
    }



}
