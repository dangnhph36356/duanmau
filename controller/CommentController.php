<?php
include __DIR__ . "/../model/CommentModel.php";

class CommentController
{
    public function search_comment()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_SESSION["filter_comment"] = $_POST;
            if (!empty($_SESSION["filter_comment"])) {
                $where = "";
                foreach ($_SESSION["filter_comment"] as $key => $value) {
                    if (!empty($value)) {
                        switch ($key) {
                            case "content":
                                $where .= (!empty($where)) ? " AND `$key` LIKE '%$value%'" : " `$key` LIKE '%$value%'";
                                break;
                            default:
                                $where .= (!empty($where)) ? " AND `$key` = $value" : " `$key` = $value";
                                break;
                        }
                    }
                }
            }
            if (!empty($where)) {
                $searchParams = http_build_query(['where' => $where]);
                header("Location: index.php?act=commment_view&$searchParams");
                exit();
            } else {
                echo "<script>
           alert('Cần nhập giá trị tìm kiếm')
           window.location.href='index.php?act=commment_view';
           </script>";
            }
        }
    }
    public function sort_delete_comment($status)
    {
        $id = isset($_GET["id"]) ? $_GET["id"] : "";
        $commment_model = new CommentModel();
        $commment_model->sort_delete_comment($id, $status);
        if ($status == 0) {
            header("Location: index.php?act=commment_view");
        } else {
            header("Location: index.php?act=black_list_comment");
        }
    }
    public function show_comment($offset, $per_page, $status)
    {
        $commment_model = new CommentModel();
        $list_comment_black_and_list = $commment_model->list_comment_black_and_list($offset, $per_page, $status);
        return $list_comment_black_and_list;
    }
    public function getComment_ad($status)
    {
        $commment_model = new CommentModel();
        $get_list_comments = $commment_model->get_row_commnet_admin($status);
        return $get_list_comments;
    }
    public function comment_count($id)
    {
        $commment_model = new CommentModel();
        $get_row_comments = $commment_model->get_row($id);
        return $get_row_comments;
    }
    public function getComments($id)
    {
        $commment_model = new CommentModel();
        $get_list_comments = $commment_model->getcomment($id);
        return $get_list_comments;
    }
    public function insertComment()
    {
        $id = isset($_GET["id"]) ?  $_GET["id"] : null;
        if (isset($_SESSION["user"])) {
            // kiểm tra 
            $userController_list = new UserController();
            $user_getlist = $userController_list->check_user_productdetails($_SESSION['user']['user_name']);
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $content_comment = $_POST["comment"];
                $commment_model = new CommentModel();
                $commment_model->setComment($content_comment, $id, $user_getlist["user_id"]);
                header('Location: index.php?act=products_detail&&id=' . $id . '');
                exit();
            }
        } else {
            echo "<script>
            alert('Bạn cần đăng nhập để bình luận');
            window.location.href = 'index.php?act=products_detail&id=" . $id . "';
        </script>";
            exit();
        }
    }
}
