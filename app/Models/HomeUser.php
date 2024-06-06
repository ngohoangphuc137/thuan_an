<?php
namespace App\Models;

class HomeUser extends BaseModel
{
    public function getNameTitleNotExits()
    {
        $sql = "SELECT * FROM category WHERE category.id_parent !=0 AND category.id_category NOT IN (SELECT layout.id_category FROM layout)";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getLayout()
    {
        $sql = "SELECT * FROM layout ORDER BY priority";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getProductSale()
    {
        $sql = "SELECT products.* ,category.name_category, imagedescribe.id_imgDescribe,imagedescribe.imageDescribe  FROM `products` 
        LEFT JOIN category ON products.id_category =  category.id_category
        LEFT JOIN imagedescribe ON products.id_product = imagedescribe.id_product
        GROUP BY products.id_product
        HAVING products.sale != 0
        LIMIT 10";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getProduct_by_Category($id_category, $limitProduct)
    {
        $sql = "SELECT products.id_product,name_product,price,sale,slugUrlProduct ,category.id_category,category.name_category, imagedescribe.id_imgDescribe,imagedescribe.imageDescribe  FROM `products` 
        LEFT JOIN category ON products.id_category =  category.id_category
        LEFT JOIN imagedescribe ON products.id_product = imagedescribe.id_product
        GROUP BY products.id_product
        HAVING category.id_category = $id_category LIMIT $limitProduct";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function insertLayoutHome($title, $id_category, $limitProduct, $name_layout)
    {
        $sql = "INSERT INTO `layout`(`title`, `id_category`, `limitProduct`, `name_layout`) 
        VALUES (?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$title, $id_category, $limitProduct, $name_layout]);
    }
    public function getLayoutId($id_layout)
    {
        $sql = "SELECT * FROM `layout` WHERE layout.id_layout=?";
        $this->setQuery($sql);
        return $this->loadRow([$id_layout]);
    }
    public function updata($limitProduct, $name_layout, $id_layout)
    {
        $sql = "UPDATE `layout` SET `limitProduct`=?,`name_layout`=? WHERE `id_layout`=?";
        $this->setQuery($sql);
        return $this->execute([$limitProduct, $name_layout, $id_layout]);
    }
    public function updataPriority($priority, $id_layout)
    {
        $sql = "UPDATE `layout` SET `priority`=? WHERE `id_layout`=?";
        $this->setQuery($sql);
        return $this->execute([$priority, $id_layout]);
    }
    public function delete($id_layout)
    {
        $sql = "DELETE FROM `layout` WHERE layout.id_layout=?";
        $this->setQuery($sql);
        return $this->execute([$id_layout]);
    }
    public function getProductIdCategory($id_category){
        $sql = "SELECT products.id_product, products.name_product,products.price,products.sale,products.slugUrlProduct,imagedescribe.imageDescribe FROM `products` 
        LEFT JOIN imagedescribe ON imagedescribe.id_product = products.id_product
        WHERE products.id_category = ?
        GROUP BY products.id_product";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_category]);
    }
}
?>