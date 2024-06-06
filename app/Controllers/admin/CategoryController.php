<?php
namespace App\Controllers\admin;

use App\Models\Category;
use App\Controllers\BaseController;

class CategoryController extends BaseController implements InterfaceController
{
    public $category;
    public $convertVnCharset;
    public function __construct()
    {
        $this->category = new Category();
        $this->convertVnCharset = new ConvertVnCharset();
    }
    public function recursive(array $categorys, int $idParent = 0, int $lever = 0)
    {
        $listCategory = [];
        foreach ($categorys as $key => $value) {
            if ($value->id_parent == $idParent) {
                $indent = str_repeat('-', $lever * 2);
                $listCategory[] = [
                    'value' => $value->id_category,
                    'text' => $indent . ' ' . $value->name_category,
                    'idParent' => $value->id_parent,
                ];
                unset($categorys[$key]);
                $listCategory = array_merge($listCategory, $this->recursive($categorys, $value->id_category, $lever + 1));
            }
        }
        return $listCategory;
    }

    public function list()
    {
        $categorys = $this->category->getCategory();
        $menuTree = $this->recursive($categorys);
        return $this->render('backend.managerProduct.category', compact(['categorys', 'menuTree']));
    }
    public function more()
    {
        
        if (isset($_POST['namCate'])) {
            $nameCategory = $_POST['namCate'];
            $slugUrl=$this->convertVnCharset->convertVnCharset($nameCategory);
            $categoryMain = $_POST['categoryMain'];
            $status = 1;
            $date = date("Y/m/d");
            $this->category->insertCategory($nameCategory, $categoryMain, $status,$slugUrl, $date, $date);
        }
       
    }
    public function getallCategory(){
        $categorys = $this->category->getCategory();
        $menuTree = $this->recursive($categorys);
        $data = array();
        foreach ($categorys as $value) {
            $subarray = array(); // mảng con
            $subarray[] = $value->id_category;
            $subarray[] = $value->name_category;
            if ($value->id_parent == 0) {
                $subarray[] = "Thuộc cấp cha";
            } else {
                foreach ($categorys as $valueParent) {
                    if ($value->id_parent == $valueParent->id_category) {
                        $subarray[] = "Thuộc cấp " . $valueParent->name_category;
                    }
                }
            }
            $subarray[] = $value->status;
            $subarray[] = $value->created_at;
            $data[] = $subarray;
        }
        $output = [
            $data,
            $menuTree
        ];
        echo json_encode($output);
    }
    public function getIdCategory($id)
    {
        $getIdCategory = $this->category->getIdCategory($id);
        $categorys = $this->category->getCategory();
        $menuTree = $this->recursive($categorys);
        $getId = [
            (object) [
                'id_category' => $getIdCategory->id_category,
                'name_category' => $getIdCategory->name_category,
                'id_parent' => $getIdCategory->id_parent,
                'status' => $getIdCategory->status,
                'updated_at' => $getIdCategory->updated_at,
            ]
        ];

        $output = [
            $getId,
            $menuTree
        ];

        echo json_encode($output);
    }
    public function updata()
    {
        //file_get_contents()  Hàm này là cách ưa thích để đọc nội dung của tệp thành chuỗi. Nó sẽ sử dụng các kỹ thuật ánh xạ bộ nhớ, 
        //nếu điều này được máy chủ hỗ trợ, để nâng cao hiệu suất.

        //“php://input” là một luồng đặc biệt do PHP cung cấp cho phép bạn truy cập vào phần nội dung thô của yêu cầu HTTP đến
        //Khi luồng được mở, bạn có thể đọc dữ liệu từ luồng bằng cách sử dụng các hàm như fread(), file_get_contents() hoặc fgets()

        // $data = stripslashes(file_get_contents("php://input"));
        // $mydata = json_decode($data, true);

        if (isset($_POST['idCategory'])) {
            $date = date("Y/m/d");
            $slug = $this->convertVnCharset->convertVnCharset($_POST['NameCategory']);
            $this->category->updataCategory($_POST['idCategory'],$_POST['NameCategory'],$_POST['optionMenutree'],$_POST['statusCategory'],$slug,$date);
            
            $output = [
                'data' => 'success',
                'status' => '200',
            ];
        }
        echo json_encode($output);
    }
    public function delete()
    {
        if ($_POST['idcategory']) {
            $deleteCategory = $this->category->deleteCategory($_POST['idcategory']);
            if ($deleteCategory) {
                $output = [
                    'data' => 'success',
                    'status' => '200',
                ];
            } else {
                $output = [
                    'data' => 'error',
                    'status' => '201',
                ];
            }
        }
        echo json_encode($output);
    }


}
?>