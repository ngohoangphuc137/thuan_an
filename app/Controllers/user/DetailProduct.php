<?php
namespace App\Controllers\user;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\Category;

class DetailProduct extends BaseController
{
    public $product;
    public $homeController;
    public $category;

    public function __construct()
    {
        $this->product = new Product();
        $this->homeController = new HomeController();
        $this->category = new Category();
        //$_SESSION['cart']=[];
    }
    public function cart()
    {
        $flag = false;
        $_SESSION['check'] = '';
        $idProduct = $_POST['idProduct'];
        $qty = $_POST['qty'];
        $price = $_POST['price'];
        $totalqty = $_POST['totalqty'];
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($key == $idProduct) {
                $flag = true;
                if ($value['quanity'] < $totalqty) {
                    $_SESSION['check']=" đã được thêm vào giỏ hàng";
                    $_SESSION['cart'][$idProduct] = [
                        'quanity' => $qty + $value['quanity'],
                        "price" => $price
                    ];
                } else {
                    $_SESSION['check']=" vượt quá số lượng cho phép";
                    $_SESSION['cart'][$idProduct] = [
                        'quanity' => $totalqty,
                        "price" => $price
                    ];
                }
            }
        }
        if ($flag == false) {
            $_SESSION['cart'][$idProduct] = ['quanity' => $qty, "price" => $price];
            $_SESSION['check']=" đã được thêm vào giỏ hàng";
        }
    }
    public function detailProduct($slugUrlProduct)
    {
        $arraySpes = array();
        $related_spes = new \stdClass();
        $getProductSlugUrl = $this->product->getProductSlugUrl($slugUrlProduct);
        $getImageId = $this->product->getImageId($getProductSlugUrl->id_product);
        $getCategory = $this->category->getCategory();
        $getIdSpes = $this->product->getIdSpes($getProductSlugUrl->id_product);
        if (!empty($getIdSpes)) {
            $arraySpes[] = (object) ['title' => 'Chiều cao', 'value' => $getIdSpes->height];
            $arraySpes[] = (object) ['title' => 'Chiều ngang', 'value' => $getIdSpes->horizontal];
            $arraySpes[] = (object) ['title' => 'Chiều sâu', 'value' => $getIdSpes->deep];
            $arraySpes[] = (object) ['title' => 'Màu sắc', 'value' => $getIdSpes->color];
            if (isset($getIdSpes->related_specifications)) {
                $related_spes = unserialize($getIdSpes->related_specifications);
            }
        }
        $navMenu = array_reverse($this->homeController->navMenu($getCategory, $id_parent = $getProductSlugUrl->id_category));

        foreach ($navMenu as $value) {
            $arrayNavMenu[] = '/ <a href="' . route('danh-muc') . '/' . $value['slugUrl'] . '">' . $value['name'] . '</a>';
        }
        return $this->render('frontend.page.detailProduct', compact([
            'getProductSlugUrl',
            'getImageId',
            'arrayNavMenu',
            'arraySpes',
            'related_spes'
        ]));
    }

}
?>