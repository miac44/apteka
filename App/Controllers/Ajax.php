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
        $this->view->json_data = \App\Models\Drug::json_search($_REQUEST['search']);
//        $this->view->json_data = json_encode(['911', '9', '09991', '011']);
        $this->view->display(__DIR__ . '/../Views/ajax.php');
    }
}