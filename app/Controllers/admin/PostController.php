<?php
namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Controllers\admin\ConvertVnCharset;
use App\Models\PostModel;

class PostController extends BaseController
{
    public $convent;
    public $post;
    public function __construct()
    {
        $this->convent = new ConvertVnCharset();
        $this->post = new PostModel();
    }
    public function listPost()
    {
        $getAllPost = $this->post->getAllPost();

        $arrayPost = $this->convertPost($getAllPost);
        return $this->render('backend.postManagement.listPost', compact('arrayPost'));
    }
    public function convertPost($getAllPost)
    {
        $arrayPost = array();
        foreach ($getAllPost as $key => $value) {
            $arrayPost[] = (object) [
                'id_post' => $value->id_post,
                'title_post' => $value->title_post,
                'image_title' => empty($value->image_title) ? 'public/imageDescribe/' . $this->catch_that_image($value->content_post) : $value->image_title,
                'slugUrl_post' => $value->slugUrl_post,
                'time' => $value->time,
                'date' => $value->date,
                'moment' => $value->moment
            ];
        }
        return $arrayPost;
    }
    public function morePost()
    {
        return $this->render('backend.postManagement.morePost');
    }
    public function editPost($id)
    {
        $getPostId = $this->post->getPostId($id);
        return $this->render('backend.postManagement.editPost', compact('getPostId'));
    }
    public function insertPost()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if (isset($_POST['btn-morePost'])) {
            $image = '';
            $title = $_POST['title_post'];
            $convertTitle = $this->convent->convertVnCharset($title);
            if (!empty($_FILES['file-image']['name'])) {
                $image = 'public/images/' . $_FILES['file-image']['name'];
            }
            $image_tmp = $_FILES['file-image']['tmp_name'];

            $content = $_POST['summernote-post'];
            $date = date("Y/m/d H:i:s");
            $this->post->insertPost($title, $image, $convertTitle, $content, $date);
            move_uploaded_file($image_tmp, $image);
            header('location:' . BASE_URL . 'admin/morePost');

        }
    }
    public function catch_that_image($content_post)
    {
        $first_img = '';
        $output = preg_match_all('/<img src="([^"]+)"\s*/', $content_post, $matchs);
        $first_img = $matchs[1];
        if (empty($first_img)) {
            $first_img = 'default.jpg';
        } else {
            $first_img = $matchs[1][0];
            $first_img = str_replace(BASE_URL . 'public/imageDescribe/', '', $first_img);
        }
        return $first_img;
    }
    public function deletePost($id)
    {
        $getPostId = $this->post->getPostId($id);
        $arrayImgPost = $this->deleteImageContent($getPostId->content_post);
        if (!empty($getPostId->image_title)) {
            unlink($getPostId->image_title);
        }
        if (!empty($arrayImgPost)) {
            foreach ($arrayImgPost as $key => $value) {
                $first_img = str_replace(BASE_URL . 'public/imageDescribe/', '', $value);
                unlink('public/imageDescribe/' . $first_img);
            }
        }
        $this->post->deletePost($id);
        header('location:' . BASE_URL . 'admin/listPost');
    }
    public function deleteImageContent($content_post)
    {
        $first_img = '';
        $output = preg_match_all('/<img src="([^"]+)"\s*/', $content_post, $matchs);
        $first_img = $matchs[1];
        if (empty($first_img)) {
            return $first_img = array();
        } else {
            $first_img = $matchs[1];
            return $first_img;
        }
    }
    public function updataPost()
    {
        if (isset($_POST['btn-UpdataPost'])) {
            $id_post = $_POST['id_post'];
            $title_post = $_POST['title_post'];
            $slugUrl_post = $_POST['slugUrl_post'];
            $summernote_post = $_POST['summernote-post'];
            $image = $_FILES['file-image']['name'];
            $image_tmp = $_FILES['file-image']['tmp_name'];

            $getPostId = $this->post->getPostId($id_post);
            if (empty($image)) {
                $image = $getPostId->image_title;
            } else {
                unlink($getPostId->image_title);
                $image = 'public/images/' . $_FILES['file-image']['name'];
            }
            $this->post->updataPost($title_post, $image, $slugUrl_post, $summernote_post, $id_post);
            move_uploaded_file($image_tmp, $image);
            header('location:' . BASE_URL . 'admin/editPost/' . $id_post);
        }
    }
}
?>