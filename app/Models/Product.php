<?php
namespace App\Models;

class Product extends BaseModel
{
    protected $table = 'products';

    public function listProducts()
    {
        $sql = "SELECT products.* ,category.name_category, imagedescribe.id_imgDescribe,imagedescribe.imageDescribe  FROM `products` 
        LEFT JOIN category ON products.id_category =  category.id_category
        LEFT JOIN imagedescribe ON products.id_product = imagedescribe.id_product
        GROUP BY products.id_product";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function insertProduct($name_product, $price, $sale, $id_category, $quanity, $describe, $slugUrlProduct, $data)
    {
        $sql = "INSERT INTO $this->table (`name_product`, `price`, `sale`, `id_category`, `quanity`, `describe`,`slugUrlProduct`, `created_at`, `updated_at`) 
        VALUES (?,?,?,?,?,?,?,?,?)";
        $this->setQuery($sql);
        $this->execute([$name_product, $price, $sale, $id_category, $quanity, $describe, $slugUrlProduct, $data, $data]);
        return $this->getLastId();
    }
    public function insertImages($imageDescribe, $id_product)
    {
        $sql = "INSERT INTO `imagedescribe`(`imageDescribe`, `id_product`) VALUES (?,?)";
        $this->setQuery($sql);
        return $this->execute([$imageDescribe, $id_product]);
    }
    public function insertSpecifications($height, $horizontal, $deep, $color, $related_specifications, $id_product)
    {
        $sql = "INSERT INTO `specifications`(`height`, `horizontal`, `deep`, `color`, `related_specifications`, `id_product`) 
        VALUES (?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$height, $horizontal, $deep, $color, $related_specifications, $id_product]);
    }
    public function getProductId($id)
    {
        $sql = "SELECT products.*,category.name_category,category.id_category  FROM `products` 
       LEFT JOIN category ON products.id_category = category.id_category 
       WHERE products.id_product=?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    public function getProductSlugUrl($slugUrlProduct)
    {
        $sql = "SELECT products.*,category.name_category,category.id_category  FROM `products` 
       LEFT JOIN category ON products.id_category = category.id_category 
       WHERE products.slugUrlProduct=?";
        $this->setQuery($sql);
        return $this->loadRow([$slugUrlProduct]);
    }
    public function getIdSpes($idProduct)
    {
        $sql = "SELECT * FROM `specifications` WHERE specifications.id_product = ? AND specifications.id_product IS NOT NULL";
        $this->setQuery($sql);
        return $this->loadRow([$idProduct]);
    }
    public function getImageId($id)
    {
        $sql = "SELECT * FROM `imagedescribe` WHERE imagedescribe.id_product = ? AND imagedescribe.id_product IS NOT NULL";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }
   
    public function deleteImage($id)
    {
        $sql = "DELETE FROM `imagedescribe` WHERE id_imgDescribe = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
    public function deleteProduct($id){
        $sql="DELETE FROM $this->table WHERE id_product=?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
    public function updataSpecifications($id_specificactions, $height, $horizontal, $deep, $color, $related_specifications)
    {
        $sql = "UPDATE `specifications` SET `height`=?,`horizontal`=?,`deep`=?,`color`=?,`related_specifications`=? 
        WHERE `id_specificactions`=?";
        $this->setQuery($sql);
        return $this->execute([$height, $horizontal, $deep, $color, $related_specifications, $id_specificactions]);
    }
    public function updataProduct($id_product, $name_product, $price, $sale, $id_category, $quanity, $describe,$slugUrlProduct, $updated_at)
    {
        $sql = "UPDATE $this->table SET `name_product`=?,`price`=?,`sale`=?,`id_category`=?,`quanity`=?,`describe`=?,`slugUrlProduct`=?,`updated_at`=? WHERE `id_product`=?";
        $this->setQuery($sql);
        return $this->execute([$name_product, $price, $sale, $id_category, $quanity, $describe,$slugUrlProduct, $updated_at, $id_product]);
    }
    public function getProductIN($listId){
        $sql = "SELECT products.id_product,products.name_product,products.price,products.sale,products.quanity,imagedescribe.imageDescribe FROM `products`
        LEFT JOIN imagedescribe ON imagedescribe.id_product = products.id_product
        WHERE products.id_product IN (".$listId.")
        GROUP BY products.id_product";
        $this->setQuery($sql);
        return $this->loadAllRows();    
    }
    public function searchText($text){
      $sql = "SELECT products.id_product,products.name_product,products.price,products.sale,products.slugUrlProduct,imagedescribe.imageDescribe FROM `products` 
      LEFT JOIN imagedescribe ON imagedescribe.id_product = products.id_product
      WHERE products.name_product LIKE  '%".$text."%'
      GROUP BY products.id_product";
      $this->setQuery($sql);
      return $this->loadAllRows();
    }
    public function total_prdouct(){
        $sql = "SELECT COUNT(products.id_product) as total_products FROM `products`";
        $this->setQuery($sql);
        return $this->loadRow();
    }
    public function Depot(){
        $sql = "SELECT SUM(products.quanity) as Depot FROM `products`";
        $this->setQuery($sql);
        return $this->loadRow();
    }
    public function getTop5ProductSale(){
        $sql = "SELECT products.id_product , products.name_product,imagedescribe.imageDescribe,products.price,products.sale FROM `products`
        LEFT JOIN imagedescribe ON imagedescribe.id_product = products.id_product
        WHERE products.sale > 0
        GROUP BY products.id_product
        ORDER BY products.sale DESC LIMIT 5";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function updataQuanity($quanity,$id){
        $sql = "UPDATE `products` SET `quanity`=? WHERE `id_product`=?";
        $this->setQuery($sql);
        return $this->execute([$quanity,$id]);
    }
}

?>