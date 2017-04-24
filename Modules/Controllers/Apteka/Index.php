<?php

namespace Modules\Controllers\Apteka;

use App\Config;
use App\Controller;


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
    protected function actionSearch()
    {
        $this->view->json_data = \Modules\Models\Apteka\Drug::json_search(['TOVNAME'=>$_REQUEST['search']]);
        $this->view->display('Apteka/ajax');
    }

}