<?php
namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\HomeUser;

class HomeLayoutUser extends BaseController
{
    public $layout;
    public function __construct()
    {
        $this->layout = new HomeUser();
    }
    public function homeLayoutUser()
    {
        return $this->render('backend.layoutPageUser.home');
    }
    public function getData()
    {
        $listNameTitle = $this->layout->getNameTitleNotExits();
        $getLayout = $this->layout->getLayout();
        foreach ($getLayout as $value) {
            if ($value->name_layout == 1) {
                $value->name_layout = 'Thanh trượt sản phẩm';
            } elseif ($value->name_layout == 2) {
                $value->name_layout = 'Danh sách sản phẩm';
            } else {
                $value->name_layout = 'Danh mục và danh sách sản phẩm';
            }
        }

        $output = [
            'listNameTitle' => $listNameTitle,
            'getLayout' => $getLayout
        ];
        echo json_encode($output);
    }
    public function more()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['nameTitle'])) {
                $this->layout->insertLayoutHome($_POST['nameTitle'], $_POST['categoryId'], $_POST['numberProductShow'], $_POST['interfaceType']);
                $output = [
                    'data' => 'succsess',
                    'status' => '200'
                ];
                echo json_encode($output);
            }
        }
    }
    public function getDataLayoutId()
    {
        if (isset($_POST['idlayout'])) {
            $getLayoutId = $this->layout->getLayoutId($_POST['idlayout']);
            echo json_encode($getLayoutId);
        }
    }
    public function updata()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['idLayout'])) {
                $this->layout->updata($_POST['updataNumberProduct'], $_POST['updataInterfaceType'], $_POST['idLayout']);
                $output = [
                    'data' => 'succsess',
                    'status' => '200'
                ];
                echo json_encode($output);
            }
            if (isset($_POST['data'])) {
                $ids = explode(',', $_POST['data']);
                $priority = 1;
                foreach ($ids as $value) {
                    $this->layout->updataPriority($priority, $value);
                    $priority++;
                }
                $output = [
                    'data' => 'succsess',
                    'status' => '200'
                ];
                echo json_encode($output);
            }
        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['idlayout'])) {
                $this->layout->delete($_POST['idlayout']);
                $output = [
                    'data' => 'succsess',
                    'status' => '200'
                ];
                echo json_encode($output);
            }
        }
    }
}
?>