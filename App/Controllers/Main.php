<?php

namespace App\Controllers;

use App\View;
use App\Controller;
use App\Config;

class Main extends Controller
{

    protected function beforeAction()
    {
        $this->view->site = Config::instance()->site;
        $this->view->addTemplateDir(ROOT_DIR . '/Modules/Views/' . Config::instance()->template_engine);
    }

    protected function actionIndex()
    {
        $module = new \Modules\Controllers\Apteka\Index();
        $module->view = $this->view;
        return $module->action('Index');
    }

}
