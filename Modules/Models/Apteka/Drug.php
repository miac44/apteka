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

    public function prepare($res)
    {
        $result = array();
        foreach ($res as $v) {
            $result_word =$v->TOVNAME;

            foreach (\App\Config::instance()->bad_words as $word) {
                if (strpos($result_word, $word)>0) {
                    $result_word = substr($result_word, 0, strpos($result_word, $word));
                };
            };
            foreach (\App\Config::instance()->bad_regexp as $regexp) {
                $result_word = preg_replace("/^(.+)" . $regexp . "(.+)$/iU", "$1", $result_word);
            };
            $result_word = trim(preg_replace("/s+/"," ",$result_word));
            if (!in_array($result_word, $result)){
                $result[] = $result_word;
            };
        }
        return array_unique($result);
    }

    public function json_search($search = [])
    {
        $res = self::search($search);
        $result = self::prepare($res);
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

}
