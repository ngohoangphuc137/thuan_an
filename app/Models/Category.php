<?php
namespace App\Models;

class Category extends BaseModel
{
    protected $table = 'category';
    public function getCategorySlugUrl($slugUrl){
      $sql = "SELECT * FROM `category` WHERE category.slugUrl = ?";
      $this->setQuery($sql);
      return $this->loadRow([$slugUrl]);
    }
    public function getCategory()
    {
        $sql = "SELECT * FROM $this->table ORDER BY name_category DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function insertCategory($name_category, $id_parent, $status,$slugUrl, $created_at, $updated_at)
    {
        $sql = "INSERT INTO $this->table (`name_category`, `id_parent`, `status`,`slugUrl`, `created_at`, `updated_at`) 
        VALUES (?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$name_category, $id_parent, $status,$slugUrl, $created_at, $updated_at]);
    }
    public function getIdCategory($id_category)
    {
        $sql = "SELECT * FROM $this->table WHERE `id_category`=?";
        $this->setQuery($sql);
        return $this->loadRow([$id_category]);
    }
    public function updataCategory($id_category, $name_category, $id_parent, $status,$slugUrl, $updated_at)
    {
        $sql = "UPDATE $this->table SET `name_category`=?,`id_parent`=?,`status`=?,`slugUrl`=?,`updated_at`=? WHERE `id_category`=?";
        $this->setQuery($sql);
        return $this->execute([$name_category, $id_parent, $status,$slugUrl, $updated_at, $id_category]);
    }
    public function deleteCategory($id_category)
    {
        $sql = "DELETE FROM $this->table WHERE `id_category`=?";
        $this->setQuery($sql);
        return $this->execute([$id_category]);
    }

}
?>