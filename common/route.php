<?php

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;

$url = !isset($_GET['url']) ? "/" : $_GET['url'];

$router = new RouteCollector();


// filter check đăng nhập
$router->filter('auth', function () {
    if (!isset($_SESSION['auth']) || empty($_SESSION['auth'])) {
        header('location:' . BASE_URL);
        die;
    }
});
$router->filter('user', function () {
    if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
        header('location:' . BASE_URL);
        die;
    }
});

// khu vực cần quan tâm -----------
// bắt đầu định nghĩa ra các đường dẫn
// $router->get('/', function () {
//     return "trang chủ";
// });
//Admin
$router->get('admin/', [App\Controllers\admin\LoginAdminContrller::class, 'login']);
$router->post('checkLoginSession', [App\Controllers\admin\LoginAdminContrller::class, 'checkLoginSession']);


// quản lý phiên đăng nhập
$router->group(['before' => 'auth'], function ($router) {
    $router->get('admin/logout', [App\Controllers\admin\LoginAdminContrller::class, 'logout']);
    $router->get('admin/dashboard', [App\Controllers\admin\DashboardController::class, 'index']);
    //route category controller
    $router->get('admin/category', [App\Controllers\admin\CategoryController::class, 'list']);
    $router->get('getallCategory', [App\Controllers\admin\CategoryController::class, 'getallCategory']);
    $router->post('moreCategory', [App\Controllers\admin\CategoryController::class, 'more']);
    $router->post('deleteCategory', [App\Controllers\admin\CategoryController::class, 'delete']);
    $router->post('getIdCategory/{id}', [App\Controllers\admin\CategoryController::class, 'getIdCategory']);
    $router->post('updataCategory', [App\Controllers\admin\CategoryController::class, 'updata']);

    //router product controller
    $router->get('admin/product', [App\Controllers\admin\ProductController::class, 'list']);
    $router->get('admin/moreProduct', [App\Controllers\admin\ProductController::class, 'moreProduct']);
    //$router->get('detailProduct', [App\Controllers\admin\ProductController::class, 'detailProduct']);
    $router->post('uploadFile', [App\Controllers\admin\ProductController::class, 'uploadFile']);
    $router->post('deleteFile', [App\Controllers\admin\ProductController::class, 'deleteFile']);
    $router->post('more', [App\Controllers\admin\ProductController::class, 'more']);
    $router->get('admin/detail-Product/{id}/', [App\Controllers\admin\ProductController::class, 'detailProduct']);
    $router->post('getProduct/{id}', [App\Controllers\admin\ProductController::class, 'getProduct']);
    $router->post('updataProduct', [App\Controllers\admin\ProductController::class, 'updata']);
    $router->post('deleteProduct', [App\Controllers\admin\ProductController::class, 'delete']);


    // route user management
    $router->get('admin/listUser', [App\Controllers\admin\UserController::class, 'listUser']);
    $router->post('deleteuser/{id}', [App\Controllers\admin\UserController::class, 'delete']);

    // route ordel management
    $router->get('admin/ordel', [App\Controllers\admin\OrdelController::class, 'listOrdel']);
    $router->get('admin/hoa-don/{id}', [App\Controllers\admin\OrdelController::class, 'invoice']);
    $router->get('delete-invoice/{id}', [App\Controllers\admin\OrdelController::class, 'deleteInvoice']);

    // route commnet management
    $router->get('admin/comment', [App\Controllers\admin\CommentController::class, 'comment']);
    $router->get('binh-luan-san-pham/{slug}', [App\Controllers\admin\CommentController::class, 'listCommentIdproduct']);
    $router->post('deleteComment', [App\Controllers\admin\CommentController::class, 'deleteComment']);

    //route layout home management
    $router->get('admin/homeLayoutUser', [App\Controllers\admin\HomeLayoutUser::class, 'homeLayoutUser']);
    $router->post('getdata', [App\Controllers\admin\HomeLayoutUser::class, 'getData']);
    $router->post('insertLayout', [App\Controllers\admin\HomeLayoutUser::class, 'more']);
    $router->post('getDataLayoutId', [App\Controllers\admin\HomeLayoutUser::class, 'getDataLayoutId']);
    $router->post('updataLayout', [App\Controllers\admin\HomeLayoutUser::class, 'updata']);
    $router->post('deleteLayout', [App\Controllers\admin\HomeLayoutUser::class, 'delete']);

    // route post management
    $router->get('admin/listPost', [App\Controllers\admin\PostController::class, 'listPost']);
    $router->get('admin/morePost', [App\Controllers\admin\PostController::class, 'morePost']);
    $router->get('admin/editPost/{id}', [App\Controllers\admin\PostController::class, 'editPost']);
    $router->post('insertPost', [App\Controllers\admin\PostController::class, 'insertPost']);
    $router->post('updataPost', [App\Controllers\admin\PostController::class, 'updataPost']);
    $router->get('deletePost/{id}', [App\Controllers\admin\PostController::class, 'deletePost']);
});


// user
// route comment controller
$router->get('getComment/{id}', [App\Controllers\admin\CommentController::class, 'getComment']);
$router->post('replyComment', [App\Controllers\admin\CommentController::class, 'isertComment']);
// search
$router->post('searchProduct', [App\Controllers\user\MainController::class, 'searchProduct']);

$router->get('/', [App\Controllers\user\HomeController::class, 'home']);
$router->post('addcart', [App\Controllers\user\DetailProduct::class, 'cart']);
$router->get('danh-muc/{slugUrl}', [App\Controllers\user\HomeController::class, 'listProductCategory']);

$router->group(['before' => 'user'], function ($router) {
    $router->get('account/', [App\Controllers\user\AccountController::class, 'account']);
    $router->get('logout', [App\Controllers\user\AccountController::class, 'logout']);
});

$router->get('san-pham/{slugUrlProduct}', [App\Controllers\user\DetailProduct::class, 'detailProduct']);
$router->get('cart', [App\Controllers\user\CartController::class, 'viewCart']);
$router->get('getCartProduct', [App\Controllers\user\CartController::class, 'getCartProduct']);
$router->post('updataCart', [App\Controllers\user\CartController::class, 'updataCart']);
$router->post('deleteCart', [App\Controllers\user\CartController::class, 'deleteCart']);
$router->get('checkout/', [App\Controllers\user\OlderController::class, 'index']);
$router->post('insertOrder', [App\Controllers\user\OlderController::class, 'insertOrder']);
$router->get('ordelComplete/{id}', [App\Controllers\user\OlderController::class, 'ordelComplete']);
$router->get('register/', [App\Controllers\user\MainController::class, 'register']);
$router->post('createAccountUser', [App\Controllers\user\MainController::class, 'createAccountUser']);
$router->get('login/', [App\Controllers\user\MainController::class, 'login']);
$router->post('userLogin', [App\Controllers\user\MainController::class, 'userLogin']);
$router->post('buyNow', [App\Controllers\user\OlderController::class, 'buyNow']);
$router->get('bai-viet/{slug}', [App\Controllers\user\PostController::class, 'post']);


// khu vực cần quan tâm -----------
$router->get('404', [App\Controllers\PageNotFound::class, 'index']);

# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
try {
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'],$url);
}   catch (HttpRouteNotFoundException $e) {

    echo $e->getMessage();
    header("location:".BASE_URL.'404');

    die();
} catch (HttpMethodNotAllowedException $e) {

    $router->get('404', [App\Controllers\PageNotFound::class, 'index']);
    //echo $e->getMessage();

    die();
}

// $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// Print out the value returned from the dispatched function
echo $response;


?>