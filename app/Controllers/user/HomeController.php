<?php
namespace App\Controllers\user;

use App\Controllers\admin\PostController;
use App\Controllers\BaseController;
use App\Controllers\user\MainController;
use App\Models\Category;
use App\Models\Product;
use App\Models\HomeUser;
use App\Models\PostModel;

class HomeController extends BaseController
{
    public $category;
    public $product;
    public $homeUser;
    public $post;
    public $postController;
    public $mailController;
    public function __construct()
    {
        $this->category = new Category();
        $this->product = new Product();
        $this->homeUser = new HomeUser();
        $this->post = new PostModel();
        $this->postController = new PostController();
        $this->mailController = new MainController();
    }
    public function home()
    {
        $getProductSale = $this->homeUser->getProductSale();

        $getLayout = $this->homeUser->getLayout();
        $getCategory = $this->category->getCategory();
        $array = array();
        foreach ($getLayout as $value) {
            $array[] = (object) 
                [
                    'title' => $value->title,
                    'id_category' => $value->id_category,
                    'limitProduct' => $value->limitProduct,
                    'layoutType' => $value->name_layout,
                    'getProductCategory' => $this->homeUser->getProduct_by_Category($value->id_category, $value->limitProduct)
                ];
        }
        $getAllPost = $this->post->getAllPost();
        $postLimit = $this->postController->convertPost($getAllPost);
        return $this->render('frontend.page.home', compact(['getProductSale', 'array', 'postLimit', 'getCategory']));
    }
    public function listProductCategory($slugUrl)
    {
        $getProductCategory = array();
        $getIdCategory = $this->category->getCategorySlugUrl($slugUrl);
        $getCategory = $this->category->getCategory();

        $navMenu = array_reverse($this->navMenu($getCategory, $id_parent = $getIdCategory->id_category));

        $idCategory = $getIdCategory->id_category;

        $menutree = $this->mailController->menutreeUser2($getCategory, $idCategory);
      
        $menutree[] = ['id_category'=>$getIdCategory->id_category];
        foreach ($menutree as $key => $value) {
            $idCategory = $value['id_category'];
            $getProductCategory = array_merge($getProductCategory, $this->homeUser->getProductIdCategory($idCategory));

        }

        foreach ($navMenu as $value) {
            if ($value['id_category'] != $idCategory) {
                $arrayNavMenu[] = '/ <a href="' . route('danh-muc') . '/' . $value['slugUrl'] . '">' . $value['name'] . '</a>';
            } else {
                $arrayNavMenu[] = '/ <strong>' . $value['name'] . '</strong>';
            }
        }

        return $this->render('frontend.page.productCategory', compact(['getProductCategory','arrayNavMenu', 'getIdCategory']));
    }


    public function navMenu($getCategory, $id_parent)
    {
        $navcategory = [];
        foreach ($getCategory as $value) {
            if ($value->id_category === $id_parent) {
                $navcategory[] = [
                    'name' => $value->name_category,
                    'slugUrl' => $value->slugUrl,
                    'id_category' => $value->id_category
                ];
                $navcategory = array_merge($navcategory, $this->navMenu($getCategory, $value->id_parent));
            }
        }
        return $navcategory;
    }
}
?>