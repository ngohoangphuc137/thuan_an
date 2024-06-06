<?php 
namespace App\Controllers\admin;
use App\Controllers\BaseController;

use App\Models\UserModal;
class UserController extends BaseController{
    public $UserModal;
    public function __construct(){
        $this->UserModal = new UserModal();
    }
    public function listUser(){
        $listUser = $this->UserModal->listUser();
        return $this->render('backend.userManagement.listUser',compact('listUser'));
    }
    public function delete($id){
       $this->UserModal->delete($id);
    }
}
?>