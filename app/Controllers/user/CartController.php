<?php
namespace App\Controllers\user;

use App\Controllers\BaseController;
use App\Models\Product;

class CartController extends BaseController
{
  public $product;
  public function __construct()
  {
    $this->product = new Product();
  }
  public function viewCart()
  {
    return $this->render('frontend.page.cart');
  }
  public function getCartProduct()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if (!empty($_SESSION['cart'])) {
        $getProductIN = $this->product->getProductIN(implode(',', array_keys($_SESSION['cart'])));
        $sessionCart = $_SESSION['cart'];
        $output = [
          'data' => [
            'getProductIN' => $getProductIN,
            'sessionCart' => $sessionCart
          ],
          'status' => 200
        ];
        return json_encode($output);
      }
    }
  }
  public function updataCart(){
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if (isset($_POST['quanity'])) {
        foreach ($_POST['quanity'] as $id => $quanity) {
          $_SESSION['cart'][$id]['quanity'] = $quanity; 
        }
      }
    }
    
  }
  public function deleteCart()
  {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      
      if (isset($_POST['id_product'])) {
          $id_product = $_POST['id_product'];
          unset($_SESSION['cart'][$id_product]);
          if(empty($_SESSION['cart'])){
            $output = [
              'data'=>false,
               'content'=>'data empty'
            ];
            return json_encode($output);
          }
          $output = [
            'data'=>true,
          ];
          return json_encode($output);
      }
    }
  }
}
?>