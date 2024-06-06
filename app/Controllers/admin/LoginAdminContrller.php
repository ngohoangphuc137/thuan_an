<?php
namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\LoginRegisterModel;

class LoginAdminContrller extends BaseController
{
    public $login;
    public function __construct()
    {
        $this->login = new LoginRegisterModel();
    }
    public function login()
    {
        return $this->render('backend.layout.loginAdmin');
    }
    public function checkLoginSession()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['btn_submitAdmin'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $selectUser = $this->login->selectUser($email, $password);
                if (!empty($selectUser)) {
                    if ($selectUser->role == 1) {
                        $_SESSION['auth']=$selectUser;
                        header('location:' . BASE_URL . 'admin/dashboard');
                    } else {
                        header('location:' . BASE_URL . 'admin');
                    }
                } else {
                    header('location:' . BASE_URL . 'admin');
                }
            }
        }
    }
    public function logout(){
        unset($_SESSION['auth']);
        header('location:' . BASE_URL . 'admin');
    }
}
?>