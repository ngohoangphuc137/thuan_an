<?php
namespace App\Controllers\user;

use App\Controllers\BaseController;
use App\Controllers\user\MainController;
use App\Models\OrdelModel;

class OlderController extends BaseController
{
    public $mailController;
    public $ordel;
    public function __construct()
    {
        $this->mailController = new MainController();
        $this->ordel = new OrdelModel();
    }
    public function index()
    {
        $productCart = $this->mailController->getProductCart();
        return $this->render('frontend.page.older', compact('productCart'));
    }
    public function insertOrder()
    {
        if (isset($_POST['btn-submit'])) {
            $receiver = $_POST['receiver'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];
            $addrest = $_POST['addrest'];
            $regexPhoneNumber = '/^(0[3|5|7|8|9]{1})([0-9]{8})$/';
            $regexEmail = "/^[_a-z0-9-]+(\.[a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/";

            $errors = array();
            if(!preg_match($regexPhoneNumber,$phone_number)){
                $errors[] = [
                    'name_input'=>'Số điện thoại',
                    'isError'=>'không đúng định dạng'
                ];
            }
            if(!preg_match($regexEmail,$email)){
                $errors[] = [
                    'name_input'=>'Email',
                    'isError'=>'không đúng định dạng'
                ];
            }
            if(count($errors) > 0){
                flash('errors',$errors,'checkout/');
            }else{
                $total = array_reduce($_SESSION['cart'],function($total,$cart){
                    return $total+($cart['quanity']*$cart['price']);
                },0);
                $date = date("Y/m/d");
                $idOrdel = $this->ordel->insertOrdel($_SESSION['user']->id_user,$receiver,$phone_number,$email,$addrest,$total,1,$date);
                foreach ($_SESSION['cart'] as $key => $value) {                  
                    $this->ordel->insertOrdetails($idOrdel,$key,$value['quanity'],$value['price']);
                }
                unset($_SESSION['cart']);
                header('location:'.BASE_URL.'ordelComplete/'.$idOrdel);
            }
        }
    }

    public function buyNow(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $receiver = $_POST['receiver'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];
            $addrest = $_POST['addrest'];
            $date = date("Y/m/d");
            $qty = $_POST['qty-butnow'];
            $price = $_POST['price'];
            $idProduct = $_POST['idProduct'];
            $total = $qty*$price;
            $idOrdel = $this->ordel->insertOrdel($_SESSION['user']->id_user,$receiver,$phone_number,$email,$addrest,$total,1,$date);
            $this->ordel->insertOrdetails($idOrdel,$idProduct,$qty,$price);
        }
    }
    public function ordelComplete($id){
        $getOrdelId = $this->ordel->getOrdelId($id);
        $getAllOrdelId = $this->ordel->getAllOrdelId($id);
        return $this->render('frontend.page.ordelComplete',compact(['getOrdelId','getAllOrdelId']));
    }
}
?>