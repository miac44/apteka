<?php
namespace App\Controllers;
use App\View, App\Controller;

class Ajax extends Controller
{

    protected function beforeAction()
    {
    }
    protected function actionSearch()
    {
        $this->view->json_data = \App\Models\Drug::ajax_search($_REQUEST['search']);
        $this->view->display(__DIR__ . '/../Views/ajax.php');
    }
}