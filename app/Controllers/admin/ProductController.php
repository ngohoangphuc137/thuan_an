<?php
namespace App\Controllers\admin;

use App\Models\Product;
use App\Controllers\BaseController;

class ProductController extends BaseController implements InterfaceController
{
    public $product;
    public $categoryController;
    public $queryCatecory;
    public $convertVnCharset;
    public function __construct()
    {
        $this->product = new Product();
        $this->categoryController = new CategoryController();
        $this->queryCatecory = $this->categoryController->category;
        $this->convertVnCharset = new ConvertVnCharset();
    }
   
    public function list()
    {
        $listProduct = $this->product->listProducts();
        return $this->render('backend.managerProduct.listProduct', compact('listProduct'));
    }
    public function uploadFile()
    {
        $dirDescribe = 'public/imageDescribe/';
        $files = scandir($dirDescribe);
        // scandir - Liệt kê các tập tin và thư mục bên trong đường dẫn đã chỉ định
        //is_file - Cho biết tên tệp có phải là tệp thông thường không

        if (isset($_FILES['file']['name'])) {
            $file_name = $_FILES['file']['name'];
            $file_path = $dirDescribe . $file_name;
            $files_linkImage = BASE_URL . $dirDescribe . $file_name;
            $file_extenxion = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
            $arr = array();
            if ($file_extenxion == 'jpg' || $file_extenxion == 'png' || $file_extenxion == 'jpeg') {
                move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
                $arr['file'] = $files_linkImage;
                return json_encode($arr);
            }
        }
    }

    public function deleteFile()
    {
        $dirDescribe = 'public/imageDescribe/';
        if (isset($_POST['imgSrc'])) {
            $file_delete = $_POST['imgSrc'];
            $file_replace = str_replace(BASE_URL . 'public/imageDescribe/', '', $file_delete);
            if (unlink($dirDescribe . $file_replace)) {
                echo 'image delete successfully';
            }
        }
    }
    public function moreProduct()
    {
        $Category = $this->queryCatecory->getCategory();
        $menuTree = $this->categoryController->recursive($Category);
        return $this->render('backend.managerProduct.moreProduct', compact('menuTree'));
    }

    public function more()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageDec = count(json_decode($_POST['imageDec']));
            $aloweed_ext = array('jpg', 'jpeg', 'png', 'gif');

            $specifications = json_decode($_POST['specifications'], true);
            $arr = (array) $specifications;

            $nameProduct = $_POST['nameProduct'];
            $slugUrlProduct = $this->convertVnCharset->convertVnCharset($nameProduct);
            $price = intval(str_replace('.', '', $_POST['price']));

            $sale = $_POST['sale'];
            $menuProduct = $_POST['menuProduct'];
            $quanity = $_POST['quanity'];
            $editordata = $_POST['editordata'];
            $date = date("Y/m/d");
            $idProduct = $this->product->insertProduct($nameProduct, $price, $sale, $menuProduct, $quanity, $editordata, $slugUrlProduct, $date);
            if ($imageDec > 0) {
                $countImages = count($_FILES['imageDectibe']['name']);
                for ($i = 0; $i < $countImages; $i++) {
                    $fileImage = $_FILES['imageDectibe']['name'][$i];
                    $fileImageForder = 'public/relatedPhotos/' . $fileImage;
                    $fileImage_tmp = $_FILES['imageDectibe']['tmp_name'][$i];
                    $fileType = pathinfo($fileImage, PATHINFO_EXTENSION);
                    if (in_array($fileType, $aloweed_ext)) {
                        if (move_uploaded_file($fileImage_tmp, 'public/relatedPhotos/' . $fileImage)) {
                            $this->product->insertImages($fileImageForder, $idProduct);
                        }
                    }
                }
            }

            if (count($arr) > 0) {
                $information =
                    (object) [
                        $_POST['information1'],
                        $_POST['information2'],
                        $_POST['information3'],
                        $_POST['information4'],
                    ];
                $related_specifications = serialize($information);
                $this->product->insertSpecifications(
                    $_POST['height'],
                    $_POST['horizontal'],
                    $_POST['deep'],
                    $_POST['color'],
                    $related_specifications,
                    $idProduct,
                );
            }
            $output = [
                'data' => 'success',
                'status' => '200',
            ];

            echo json_encode($output);
        }
    }

    public function detailProduct($id)
    {
        $getProductSlug = $this->product->getProductSlugUrl($id);
        $getImageId = $this->product->getImageId($id);
        // $convert = $this->convertVnCharset->convertVnCharset($getProductId->name_product);
        return $this->render('backend.managerProduct.detailProduct', compact(['getProductSlug', 'getImageId']));
    }
    public function getProduct($id)
    {
        $getProductId = $this->product->getProductId($id);
        $Category = $this->queryCatecory->getCategory();
        $menuTree = $this->categoryController->recursive($Category);
        if ($getProductId->sale !== 0) {
            $priceSale = $getProductId->price * (100 - $getProductId->sale) / 100;
            $getProductId->{'priceSale'} = $priceSale;
        }
        $getImageId = $this->product->getImageId($id);
        $getIdSpes = $this->product->getIdSpes($id);
        if (!empty($getIdSpes) && isset($getIdSpes->related_specifications)) {
            $getIdSpes->related_specifications = unserialize($getIdSpes->related_specifications);
        }
        $output = array(
            'getProductId' => $getProductId,
            'getImageId' => $getImageId,
            'getSpes' => $getIdSpes,
            'menuTree' => $menuTree,
        );
        echo json_encode($output);
    }


    public function updata()
    {
        if ($_SERVER['REQUEST_METHOD']) {
            $flag = false;
            $aloweed_ext = array('jpg', 'jpeg', 'png', 'gif');
            $output = [
                'data' => 'success',
                'status' => '200',
            ];
            if (isset($_POST['arrayImage'])) {
                $images = json_decode($_POST['arrayImage']);
                for ($i = 0; $i < count($images); $i++) {
                    $idImage = $images[$i]->idImage;
                    $fileNameImage = $images[$i]->LinkImage;
                    $flag = true;
                    $this->product->deleteImage($idImage);
                    unlink('public/relatedPhotos/' . $fileNameImage);
                }
                if ($flag == true) {
                    echo json_encode($output);
                }
            }
            if (isset($_FILES['imagesProduct']['name'])) {
                $imagesProduct = count($_FILES['imagesProduct']['name']);
                $idProduct = $_POST['IdProduct'];
                if ($imagesProduct > 0) {
                    $flag == true;
                    for ($i = 0; $i < $imagesProduct; $i++) {
                        $fileImage = $_FILES['imagesProduct']['name'][$i];
                        $fileImageForder = 'public/relatedPhotos/' . $fileImage;
                        $fileImage_tmp = $_FILES['imagesProduct']['tmp_name'][$i];
                        $fileType = pathinfo($fileImage, PATHINFO_EXTENSION);
                        if (in_array($fileType, $aloweed_ext)) {
                            if (move_uploaded_file($fileImage_tmp, 'public/relatedPhotos/' . $fileImage)) {
                                $this->product->insertImages($fileImageForder, $idProduct);
                            }
                        }
                    }

                }
            }
            if (isset($_POST['id_product']) && isset($_POST['id_specificactions'])) {
                $information =
                    (object) [
                        $_POST['information1'],
                        $_POST['information2'],
                        $_POST['information3'],
                        $_POST['information4'],
                    ];
                $related_specifications = serialize($information);
                if (!empty($_POST['id_specificactions'])) {

                    $this->product->updataSpecifications(
                        $_POST['id_specificactions'],
                        $_POST['height'],
                        $_POST['horizontal'],
                        $_POST['deep'],
                        $_POST['color'],
                        $related_specifications
                    );
                } else {
                    $this->product->insertSpecifications(
                        $_POST['height'],
                        $_POST['horizontal'],
                        $_POST['deep'],
                        $_POST['color'],
                        $related_specifications,
                        $_POST['id_product']
                    );
                }
            }
            if (isset($_POST['id_product']) && isset($_POST['nameProduct']) && isset($_POST['menuProduct'])) {
                $id_product = $_POST['id_product'];
                $nameProduct = $_POST['nameProduct'];
                $converNameSlug = $this->convertVnCharset->convertVnCharset($nameProduct);
                $price = intval(str_replace('.', '', $_POST['price']));
                $sale = $_POST['sale'];
                $menuProduct = $_POST['menuProduct'];
                $quanity = $_POST['quanity'];
                $editorProduct = $_POST['editorProduct'];
                $date = date("Y/m/d");
                $this->product->updataProduct(
                    $id_product,
                    $nameProduct,
                    $price,
                    $sale,
                    $menuProduct,
                    $quanity,
                    $editorProduct,
                    $converNameSlug,
                    $date
                );
            }


        }
    }
    public function delete()
    {
        if (isset($_POST['idProduct'])) {
            $idProduct = $_POST['idProduct'];
            $imageIdProduct = $this->product->getImageId($idProduct);
            foreach ($imageIdProduct as $value) {
                unlink($value->imageDescribe);
            }
            $this->product->deleteProduct($idProduct);
            $output = [
                'data' => 'success',
                'status' => '200',
            ];
           echo json_encode($output);
        }
    }

}
?>