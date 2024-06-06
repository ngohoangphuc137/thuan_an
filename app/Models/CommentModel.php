<?php
namespace App\Models;

class CommentModel extends BaseModel
{
    public function getAlComment()
    {
        $sql = "SELECT * FROM `comment`";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getproductComment()
    {
        $sql = "SELECT products.id_product,products.name_product,products.slugUrlProduct,COUNT(comment.id_comment) as total FROM `products` 
    LEFT JOIN comment ON comment.id_product = products.id_product
    GROUP BY products.id_product";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function GroupByImageProduct(){
        $sql = "SELECT products.id_product , imagedescribe.id_imgDescribe,imagedescribe.imageDescribe  FROM `products` 
        LEFT JOIN imagedescribe ON products.id_product = imagedescribe.id_product
        GROUP BY products.id_product";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getcomment($id)
    {
        $sql = "SELECT comment.*,DATE_FORMAT(comment.date_comment, '%H:%i') AS 'time', CONCAT(DAY(comment.date_comment),'/',MONTH(comment.date_comment),'/',YEAR(comment.date_comment)) AS 'date',
      CASE
        WHEN HOUR(comment.date_comment) >=0 AND HOUR(comment.date_comment) < 12 THEN 'Sáng'
        WHEN HOUR(comment.date_comment) >=12 AND HOUR(comment.date_comment) < 18 THEN 'Chiều'
        ELSE 'Tối'
      END  as 'moment'
      FROM `comment` WHERE comment.id_product=? ORDER BY id_comment ASC";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }
    public function isertComment($name_user_comment, $content, $id_product, $id_parent_comment, $date_comment)
    {
        $sql = "INSERT INTO `comment`(`name_user_comment`,`content`, `id_product`, `id_parent_comment`,`date_comment`) VALUES (?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$name_user_comment, $content, $id_product, $id_parent_comment, $date_comment]);
    }
    public function deleteComment($idComment)
    {
        $sql = "DELETE FROM `comment` WHERE comment.id_comment = ?";
        $this->setQuery($sql);
        return $this->execute([$idComment]);
    }
}
?>