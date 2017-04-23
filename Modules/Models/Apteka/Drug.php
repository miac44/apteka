<?php
namespace Modules\Models\Apteka;

use App\Model;

class Drug extends Model
{
    const TABLE = 'Drug';
    const COLUMNS = [
       'TOVNAME'   => ['type'=>'string'],
       'KODTOV'   => ['type'=>'integer'],
       'NOMGROUP'   => ['type'=>'string'],
       'ED'   => ['type'=>'string'],
       'NDS'   => ['type'=>'string'],
       'GNVLS'   => ['type'=>'string'],
       'MNN'   => ['type'=>'string'],
       'FARMGROUP'   => ['type'=>'string'],
       'OKDP'   => ['type'=>'string'],
       'KODOKDP'   => ['type'=>'string'],
       'BARCODE'   => ['type'=>'string'],
       'GOSRNAME'   => ['type'=>'string'],
       'SHORTNAME'   => ['type'=>'string'],
       'LEKFORMA'   => ['type'=>'string'],
       'SHLEKFORMA'   => ['type'=>'string'],
       'VIPUPAK'   => ['type'=>'string'],
       'SHVIDUPAK'   => ['type'=>'string'],
       'DOZIROVKA'   => ['type'=>'string'],
       'FASOVKA'   => ['type'=>'string'],
       'FORNAME'   => ['type'=>'string'],
       'POSTNAME'   => ['type'=>'string'],
       'BREND'   => ['type'=>'string'],
       'TYPE'   => ['type'=>'string'],
       'PFORNAME'   => ['type'=>'string'],
       'PPOSTNAME'   => ['type'=>'string'],
       'SIGN'   => ['type'=>'string'],
       'SIGN2'   => ['type'=>'string'],
       'PFORM'   => ['type'=>'string'],
    ];
    const RELATIONS = [
    ];
}
