<?php
namespace App\Controllers;

use App\Controller;

class Search extends Controller
{
    protected function beforeAction()
    {
    }
    protected function actionIndex()
    {
        $this->view->title = "Поиск по аптекам";
        $this->view->display(__DIR__ . '/../Views/search.php');
    }

}