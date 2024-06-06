<?php
namespace App\Controllers\user;

use App\Controllers\BaseController;
use App\Controllers\admin\PostController as Post;
use App\Models\PostModel;
use App\Models\HomeUser;

class PostController extends BaseController
{
    public $post;
    public $HomeUser;
    public $postAdmin;
    public function __construct()
    {
        $this->post = new PostModel();
        $this->postAdmin = new Post();
        $this->HomeUser = new HomeUser();
        
    }
    public function post($slug)
    {
      $getPostSlug = $this->post->getPostSlug($slug);
      $getAllPost = $this->post->getAllPost();
      $postLimit = $this->postAdmin->convertPost($getAllPost);
      $getProductSale = $this->HomeUser->getProductSale();
      return $this->render('frontend.page.post',compact(['getPostSlug','postLimit','getProductSale']));
    }
}
?>