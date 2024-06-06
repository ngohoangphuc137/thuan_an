<?php
namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\OrdelModel;

class AccountController extends BaseController
{
    public $ordelModel;
    public function __construct()
    {
        $this->ordelModel = new OrdelModel();
    }
    public function account()
    {
        $getOrdelIdUser = $this->ordelModel->getOrdelIdUser($_SESSION['user']->id_user);
        $getordelconfirmation = $this->ordelModel->getordelconfirmation();
        if (isset($_GET['idOrdel']) && isset($_GET['status'])) {
            $this->ordelModel->updataStatusOrdel($_GET['status'], $_GET['idOrdel']);
            header('location:' . BASE_URL . 'account/');
        }
        return $this->render('frontend.page.account', compact(['getOrdelIdUser', 'getordelconfirmation']));
    }
    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['cart']);
        header('location:' . BASE_URL);
    }
}
?>