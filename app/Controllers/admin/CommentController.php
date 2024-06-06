<?php
namespace App\Controllers\admin;

use App\Models\CommentModel;
use App\Controllers\BaseController;
use App\Models\Product;

class CommentController extends BaseController
{
    public $productController;
    public $comment;
    public $product;
    public function __construct()
    {
        $this->productController = new ProductController();
        $this->comment = new CommentModel();
        $this->product = new Product();
    }
    // comment
    public function getComment($id)
    {
        $getcomment = $this->comment->getcomment($id);
        $getReplyComment = $this->getReplyComment($getcomment, $id);

        echo json_encode($getReplyComment);
    }

    public function getReplyComment($getcomment, $id)
    {
        $output = '';
        $output .= '<h4>Bình luận<span>(' . count($getcomment) . ')</span></h4>
         <ul class="comment-list mt-30" id="accordion">';
        foreach ($getcomment as $value) {
            if ($value->id_parent_comment == 0) {
                $count = $this->countComment($getcomment, $value->id_comment);
                $output .= '
             <li class="li_comment_user">
               <div class="comment-user">
                 <img src="https://haycafe.vn/wp-content/uploads/2022/02/Tai-anh-girl-gai-dep-de-thuong-ve-may.jpg"alt="Honour">
               </div>
               <div class="comment-detail">
                     <div class="user-name">' . $value->name_user_comment . '</div>
                     <div class="postinfo">
                         <ul>
                         <li>' . $value->date . ' AT ' . $value->time . ' ' . $value->moment . '</li>
                             <li class="replyUser" data-idComment="' . $value->id_comment . '" data-idProduct="' . $id . '" data-nameUser="' . $value->name_user_comment . '">
                                 <i class="fa fa-reply"></i>Trả lời
                             </li>';
                if ($count > 1) {
                    $output .= '
                                <li class="watch_comment" data-toggle="collapse" href="#collapse' . $value->id_comment . '">
                               ' . $count . ' phản hồi
                                 </li>
                                
                                ';
                }
                if(isset($_SESSION['auth'])){
                $output .= '
                          <li>
                          <button data-idproduct="' . $value->id_comment . '" class="btn-remove-comment">
                            xóa
                          </button>
                          </li>';
                }
                $output .= '</ul>
                         <p>' . $value->content . '<br>
                         </p>
                         
                     </div>
                     
                 </div>
                 <div class="reply-user container-fluid reply"></div>';

                if ($count > 1) {
                    $output .= '
                     <div id="collapse' . $value->id_comment . '" class="collapse in"
                      data-parent="#accordion">
                      <ul class="comment-list child-comment">
                     ';
                } else {
                    $output .= '
                     <div>
                      <ul class="comment-list child-comment">
                     ';
                }
                $output .= $this->commentChildren($getcomment, $value->id_comment);
                $output .= '</ul></div>
                 </li>';
            }
        }
        $output .= '</ul>';
        return $output;
    }
    public function countComment($getcomment, $idComment)
    {
        $count = 0;
        foreach ($getcomment as $key => $value2) {
            if ($idComment == $value2->id_parent_comment) {
                $count++;
            }
        }
        return $count;
    }
    public function commentChildren($getcomment, $id_parent = 0)
    {

        $output = '';
        foreach ($getcomment as $value) {
            if ($value->id_parent_comment === $id_parent) {
                $output .= '
                 <li>
                   <div class="comment-user">
                     <img src="https://haycafe.vn/wp-content/uploads/2022/02/Tai-anh-girl-gai-dep-de-thuong-ve-may.jpg"alt="Honour">
                   </div>
                   <div class="comment-detail">
                         <div class="user-name">' . $value->name_user_comment . '</div>
                         <div class="postinfo">
                             <ul>
                                 <li>' . $value->date . ' AT ' . $value->time . ' ' . $value->moment . '</li>';
                                if(isset($_SESSION['auth'])){
                                 $output.='<li>
                                 <button data-idproduct="' . $value->id_comment . '" class="btn-remove-comment">
                                   xóa
                                 </button>
                                 </li>';
                                }
                             '</ul>
                             <p>' . $value->content . '<br>
                             </p>
                         </div>
                     </div>';
                $output .= $this->commentChildren($getcomment, $value->id_comment);
                $output .= '</li>';
            }
        }
        return $output;
    }
    public function isertComment()
    {
        if (isset($_POST['idProduct'])) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $dateTime = date("Y/m/d H:i:s");
            $comment = htmlspecialchars($_POST['commentContent']);
            if (isset($_POST['idComment'])) {
                $idcomment = $_POST['idComment'];
            } else {
                $idcomment = 0;
            }
            $this->comment->isertComment($_POST['name_user'], $comment, $_POST['idProduct'], $idcomment, $dateTime);
            $output = [
                'data' => 'success',
                'status' => '200',
            ];
            echo json_encode($output);
        }
    }

    public function comment()
    {
        $getproductComment = $this->comment->getproductComment();
        $GroupByImageProduct = $this->comment->GroupByImageProduct();
        return $this->render('backend.commentManegement.listComment', compact(['getproductComment','GroupByImageProduct']));
    }
    public function listCommentIdproduct($slug)
    {
        $getProductSlugUrl = $this->product->getProductSlugUrl($slug);
        
        return $this->render('backend.commentManegement.commentProduct', compact('getProductSlugUrl'));
    }
    public function deleteComment()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['idProduct'])) {
                $getcomment = $this->comment->getAlComment();
                $id = $_POST['idProduct'];
                $arrayCommentId = $this->recursiveComment($getcomment, $id);
                $arrayCommentId[] = $id;
                foreach ($arrayCommentId as $key => $value) {
                    $this->comment->deleteComment($value);
                }
            }
        }
    }
    public function recursiveComment($getcomment, $id)
    {
        $array = [];
        foreach ($getcomment as $value) {
            if ($value->id_parent_comment == $id) {
                $array[] = $value->id_comment;
                $array = array_merge($array, $this->recursiveComment($getcomment, $value->id_comment));
            }
        }
        return $array;
    }

}
?>