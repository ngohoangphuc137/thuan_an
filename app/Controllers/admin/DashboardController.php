<?php 
namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\OrdelModel;
use App\Models\UserModal;
use App\Models\Product;
class DashboardController extends BaseController{
    public $ordelModel;
    public $userModel;
    public $Product;
    public function __construct(){
       $this->ordelModel = new OrdelModel();
       $this->userModel = new UserModal();
       $this->Product = new Product();
       
    }
    public function index()
    {
        $total_order = $this->ordelModel->total_order();
        $total_user = $this->userModel->total_user();
        $total_prdouct = $this->Product->total_prdouct();
        $Depot = $this->Product->Depot();
        $getTop5ProductSale = $this->Product->getTop5ProductSale();
        return $this->render('backend.controlPanel.dashboard',compact(['total_order','total_user','total_prdouct','Depot','getTop5ProductSale']));
    }
}
?>