<?php


use App\View, App\Controller;
class Main extends Controller
{

    protected function beforeAction()
    {
    }
    protected function actionIndex()
    {
    	$this->view->title = "Поиск по аптекам";
        $this->view->display(__DIR__ . '/../Views/main.php');
    }
}