<?php
namespace App\Controllers;

use App\Controller;
use App\Models\Drug_ostatok;
use App\Models\Pharmacy;

class Search extends Controller
{
    protected function beforeAction()
    {
    }
    protected function actionIndex()
    {
        $this->view->search = $_REQUEST['search'];
        $this->view->ostatok = Drug_ostatok::searchwithpharmacy($_REQUEST['search']);
        $this->view->pharmacy = Pharmacy::findAll();
        if (empty($this->view->ostatok)){
            $this->view->display(__DIR__ . '/../Views/emptysearch.php');
        } else {
            $this->view->display(__DIR__ . '/../Views/search.php');
        };
    }

}