<?php 
namespace App\Models;
class UserModal extends BaseModel{
    public function listUser(){
        $sql = "SELECT * FROM `user`";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function delete($id){
        $sql = "DELETE FROM `user` WHERE user.id_user = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
    public function total_user(){
        $sql = "SELECT COUNT(user.id_user) as total_user FROM `user`";
        $this->setQuery($sql);
        return $this->loadRow();
    }
}
?>