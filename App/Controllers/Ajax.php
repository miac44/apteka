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
        $this->view->json_data = \App\Models\Drug::search("911");
        $this->view->header = "------------------------------------------------------------";
        $this->view->footer = "------------------------------------------------------------";
        $this->view->display(__DIR__ . '/../Views/ajax.php');
    }
}