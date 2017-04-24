<?php

namespace Modules\Controllers\Apteka;

use App\Config;
use App\Controller;
use \Modules\Models\Apteka;

class Index extends \App\Controllers\Main
{

    protected function actionIndex()
    {
        $this->view->pharmacies = \Modules\Models\Apteka\Pharmacy::findAll();
	$this->view->content = $this->view->render('Apteka/search_form');
        $this->view->display('index');
    }
    protected function actionSearch()
    {
        $this->view->search = $_REQUEST['search'];
        $this->view->drugs = \Modules\Models\Apteka\DrugBalance::extendedSearch(['NOMNAME'=>$_REQUEST['search']]);
        if (empty($this->view->drugs)){
            $this->view->content = $this->view->render('Apteka/emptysearch');
        } else {
            $this->view->content = $this->view->render('Apteka/search');
        };
        $this->view->display('index');
    }
    protected function actionAjaxSearch()
    {
        $this->view->json_data = \Modules\Models\Apteka\Drug::json_search(['TOVNAME'=>$_REQUEST['search']]);
        $this->view->display('Apteka/ajax');
    }

    protected function actionPharmacy($data)
    {
        $this->view->pharmacy = \Modules\Models\Apteka\Pharmacy::findByUniqueField('APTKOD', $data['APTKOD']);
        $this->view->content = $this->view->render('Apteka/pharmacy');
        $this->view->display('index');
    }

}