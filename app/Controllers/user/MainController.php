<?php
namespace App\Controllers\user;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Product;
use App\Models\LoginRegisterModel;


class MainController extends BaseController
{
    public $product;
    public $category;
    public $loginRegiste;
    public function __construct()
    {
        $this->category = new Category();
        $this->product = new Product();
        $this->loginRegiste = new LoginRegisterModel();
    }

    public function getAllCaregory()
    {
        $getAllCaregory = $this->category->getCategory();
        return $getAllCaregory;
    }
    public function menutreeUser($category, $id_category)
    {
        $menutreeUser2 = $this->menutreeUser2($category, $id_category);
        if (!empty($menutreeUser2)) {
            $flag = true;
            foreach ($menutreeUser2 as $key => $value) {
                if ($value['lever'] !== 0) {
                    $flag = false;
                }
            }
            if ($flag) {
                return $this->render('frontend.layout.menuParent2', compact('menutreeUser2'));
            } else {
                return $this->render('frontend.layout.menuParent', compact('menutreeUser2'));
            }
        }
    }
    public function menutreeUser2($category, $id_category, $lever = 0)
    {
        $listCategorychildren = [];
        foreach ($category as $key => $value) {
            if ($value->id_parent === $id_category) {
                $listCategorychildren[] = [
                    'id_category' => $value->id_category,
                    'name_childCategory' => $value->name_category,
                    'slugUrl' => $value->slugUrl,
                    'id_parent' => $value->id_parent,
                    'status' => $value->status,
                    'lever' => $lever
                ];
                unset($category[$key]);
                $listCategorychildren = array_merge($listCategorychildren, $this->menutreeUser2($category, $value->id_category, $lever + 1));
            }
        }
        return $listCategorychildren;
    }
    public function getProductCart()
    {
        if (!empty($_SESSION['cart'])) {
            $implodeKeys = implode(',', array_keys($_SESSION['cart']));
            $getProductIN = $this->product->getProductIN($implodeKeys);
            return $getProductIN;
        }
        return $_SESSION['cart'] = array();
    }
    public function register()
    {
        return $this->render('frontend.page.register');
    }
    public function login()
    {
        return $this->render('frontend.page.login');
    }
    public function createAccountUser()
    {
        if (isset($_POST['btn-submit'])) {
            $name_use = htmlspecialchars($_POST['name_user']);
            $email = trim($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $regexEmail = "/^[_a-z0-9-]+(\.[a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/";
            $errors = array();
            if (!preg_match($regexEmail, $email)) {
                $errors[] = [
                    'name_input' => 'Email',
                    'isError' => 'không đúng định dạng'
                ];
            }
            if (count($errors) > 0) {
                flash('errors', $errors, 'register/');
            } else {
                $checkExist = $this->loginRegiste->checkExist($email);
                if ($checkExist->count > 0) {
                    $errors[] = [
                        'name_input' => 'Email',
                        'isError' => 'này đã tồn tại!'
                    ];
                    flash('errors', $errors, 'register/');
                } else {
                    $this->loginRegiste->insertRegister($name_use, $email, $password);
                    flash('success', 'Đăng ký thành công (*mời bạn đăng nhập để mua hàng)', 'register/');
                }
            }
        }
    }

    public function userLogin()
    {
        if (isset($_POST['btn-submit'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $selectUser = $this->loginRegiste->selectUser($email, $password);
            if (empty($selectUser)) {
                flash('errors', 'Đăng nhập thất bại (mời bạn đăng nhập lại)', 'login/');
            } else {
                $_SESSION['user'] = $selectUser;
                header('location:' . BASE_URL);
            }
        }
    }
    public function searchProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['query']) && $_POST['query'] !=="") {
                $searchText = $this->product->searchText($_POST['query']);
                foreach ($searchText as $key => $value) {
                    if ($value->sale !== 0) {
                        $searchText[$key]->price = $value->price * (100 - $value->sale) / 100;
                    }
                }
                if (count($searchText) > 0) {
                    return json_encode($searchText);
                } else {
                    return json_encode(['status'=>'empty']);
                }
            }else{
                return json_encode(['status'=>'empty']);
            }
        }
    }
}
?>