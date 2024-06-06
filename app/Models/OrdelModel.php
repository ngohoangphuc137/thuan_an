<?php
namespace App\Models;

use App\Models\BaseModel;

class OrdelModel extends BaseModel
{
    public function getallOrdel()
    {
        $sql = "SELECT * FROM `ordel`";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getordelconfirmation()
    {
        $sql = "SELECT * FROM `ordelconfirmation`";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function insertOrdel($user_id, $receiver, $phone_number, $email, $addrest, $total,$status,$date)
    {
        $sql = "INSERT INTO `ordel`(`user_id`, `receiver`, `phone_number`, `email`, `addrest`,`total`,`status`,`creadate`) VALUES (?,?,?,?,?,?,?,?)";
        $this->setQuery($sql);
        $this->execute([$user_id, $receiver, $phone_number, $email, $addrest, $total,$status, $date]);
        return $this->getLastId();
    }
    public function insertOrdetails($ordel_id, $product_id, $quanity, $price)
    {
        $sql = "INSERT INTO `ordel_detail`(`ordel_id`, `product_id`, `quanity`, `price`) VALUES (?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$ordel_id, $product_id, $quanity, $price]);
    }
    public function getAllOrdelId($idOrdel)
    {
        $sql = "SELECT ordel.*,products.id_product,products.name_product,products.price,products.slugUrlProduct,products.quanity as productQuanity,imagedescribe.imageDescribe,ordel_detail.* FROM `ordel`
                LEFT JOIN ordel_detail ON ordel.id_order = ordel_detail.ordel_id
                RIGHT JOIN products ON products.id_product = ordel_detail.product_id
                LEFT JOIN imagedescribe ON imagedescribe.id_product = products.id_product
                WHERE ordel.id_order = ?
                GROUP BY products.id_product";
        $this->setQuery($sql);
        return $this->loadAllRows([$idOrdel]);
    }
    public function getOrdelId($idOrdel)
    {
        $sql = "SELECT * FROM `ordel` WHERE ordel.id_order=?";
        $this->setQuery($sql);
        return $this->loadRow([$idOrdel]);
    }
    public function getOrdelIdUser($idUser)
    {
        $sql = "SELECT * FROM `ordel` WHERE ordel.user_id=?";
        $this->setQuery($sql);
        return $this->loadAllRows([$idUser]);
    }
    public function updataStatusOrdel($status, $id_order)
    {
        $sql = "UPDATE `ordel` SET `status`=? WHERE ordel.id_order=?";
        $this->setQuery($sql);
        return $this->execute([$status, $id_order]);
    }
    public function deleteOrdel($id_order)
    {
        $sql = "DELETE FROM `ordel` WHERE ordel.id_order=?";
        $this->setQuery($sql);
        return $this->execute([$id_order]);
    }
    public function total_order(){
        $sql = "SELECT COUNT(ordel.id_order) as total_ordel FROM `ordel`";
        $this->setQuery($sql);
        return $this->loadRow();
    }
    
}

?>