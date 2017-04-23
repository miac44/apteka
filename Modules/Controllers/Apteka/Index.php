<?php
namespace Modules\Controllers\Apteka;
use App\Config, App\Controller;

class Index extends \App\Controllers\Main
{

    protected function beforeAction()
    {
    }
    protected function actionIndex()
    {
        $this->view->display('index');
    }
}