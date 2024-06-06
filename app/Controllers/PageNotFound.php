<?php
namespace App\Controllers;

class PageNotFound extends BaseController
{
    public function index()
    {
        return $this->render('404.404');
    }
}
?>