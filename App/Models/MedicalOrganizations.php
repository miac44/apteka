<?php

namespace App\Models;

use App\Model;


class MedicalOrganizations extends Model
{

    protected static $instance;


    protected function __construct()
    {
    }

    public static function instance()
    {
        if (null === static::$instance) {
            $medicalorganizations = json_decode(file_get_contents(\App\Config::instance()->medical_organizations_list_url));
            foreach ($medicalorganizations as $medicalorganization) {
                $mo = new MedicalOrganization();
                $mo->id = $medicalorganization->id;
                $mo->name = $medicalorganization->Name;
                $article = new Article($mo->id);
                $mo->article_url = $article->getURL();
                static::$instance[] = $mo;
            }
        }
        return static::$instance;
    }


}