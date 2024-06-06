<?php
namespace App\Models;

class PostModel extends BaseModel
{
    public function insertPost($title_post, $image_title, $slugUrl_post, $content_post, $created_at)
    {
        $sql = "INSERT INTO `post`(`title_post`, `image_title`, `slugUrl_post`, `content_post`, `created_at`) 
        VALUES (?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$title_post, $image_title, $slugUrl_post, $content_post, $created_at]);
    }
    public function getAllPost()
    {
        $sql = "SELECT post.id_post,post.title_post,post.image_title,post.slugUrl_post,post.content_post,DATE_FORMAT(post.created_at, '%H:%i') AS 'time',
        CONCAT(DAY(post.created_at),'/',MONTH(post.created_at),'/',YEAR(post.created_at)) AS 'date',
        CASE
                WHEN HOUR(post.created_at) >=0 AND HOUR(post.created_at) < 12 THEN 'Sáng'
                WHEN HOUR(post.created_at) >=12 AND HOUR(post.created_at) < 18 THEN 'Chiều'
                ELSE 'Tối'
              END  as 'moment'
        FROM `post`";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPostId($id)
    {
        $sql = "SELECT * FROM `post` WHERE post.id_post = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    public function deletePost($id){
        $sql = "DELETE FROM `post` WHERE post.id_post = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
    public function updataPost($title_post,$image_title,$slugUrl_post,$content_post,$id_post){
        $sql = "UPDATE `post` SET `title_post`=?,`image_title`=?,`slugUrl_post`=?,`content_post`=? WHERE `id_post`=?";
        $this->setQuery($sql);
        return $this->execute([$title_post,$image_title,$slugUrl_post,$content_post,$id_post]);
    }
    public function getPostSlug($slugUrl_post){
        $sql = "SELECT * FROM `post` WHERE post.slugUrl_post =?";
        $this->setQuery($sql);
        return $this->loadRow([$slugUrl_post]);
    }

}
?>