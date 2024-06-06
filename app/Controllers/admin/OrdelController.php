<?php
namespace App\Controllers\admin;

use App\Controllers\BaseController;

use App\Models\OrdelModel;
use App\Models\Product;

class OrdelController extends BaseController
{
  public $OrdelModel;
  public $Product;
  public function __construct()
  {
    $this->OrdelModel = new OrdelModel();
    $this->Product = new Product();
  }
  public function listOrdel()
  {
    $getallOrdel = $this->OrdelModel->getallOrdel();
    return $this->render('backend.OrdelManagement.listOrdel', compact('getallOrdel'));
  }
  public function invoice($id)
  {
    $getOrdelId = $this->OrdelModel->getOrdelId($id);
    $getordelconfirmation = $this->OrdelModel->getordelconfirmation();
    $getAllOrdelId = $this->OrdelModel->getAllOrdelId($id);
    if (isset($_GET['ordel-confirm'])) {
      if ($_GET['ordel-confirm'] == 4) {
        foreach ($getAllOrdelId as $key => $value) {
          $updataQuanity = $value->productQuanity - 1;
          $id_product = $value->id_product;
          $this->Product->updataQuanity($updataQuanity, $id_product);
        }
      }
      $this->OrdelModel->updataStatusOrdel($_GET['ordel-confirm'], $id);
      header('location:' . BASE_URL . 'admin/hoa-don/' . $id);
    }
    return $this->render('backend.OrdelManagement.invoice', compact(['getOrdelId', 'getAllOrdelId', 'getordelconfirmation']));
  }
  public function deleteInvoice($id)
  {
    $this->OrdelModel->deleteOrdel($id);
    header('location:' . BASE_URL . 'admin/ordel');
  }
}
?>