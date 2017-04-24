<?php

namespace Modules\Controllers\Apteka;

use App\Config;
use App\Controller;
use \Modules\Models\Apteka;

class Index extends \App\Controllers\Main
{

    protected function beforeAction()
    {
        $this->view->site = Config::instance()->site;
        $this->view->addTemplateDir(ROOT_DIR . '/Modules/Views/' . Config::instance()->template_engine);
    }
    protected function actionIndex()
    {
	    $this->view->content = $this->view->render('Apteka/search_form');
        $this->view->display('index');
    }
    protected function actionAjaxSearch()
    {
        $this->view->json_data = \Modules\Models\Apteka\Drug::json_search(['TOVNAME'=>$_REQUEST['search']]);
        $this->view->display('Apteka/ajax');
    }
    protected function actionSearch()
    {
        $this->view->search = $_REQUEST['search'];
        $this->view->drugs = \Modules\Models\Apteka\DrugBalance::searchwithpharmacy($_REQUEST['search']);
        $this->view->pharmacy = \Modules\Models\Apteka\Pharmacy::findAll();
        if (empty($this->view->drugs)){
            $this->view->content = $this->view->render('Apteka/emptysearch');
        } else {
            $this->view->content = $this->view->render('Apteka/search');
        };
        $this->view->display('index');
    }


}