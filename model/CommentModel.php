<?php
class CommentModel
{
    public function sort_delete_comment($id, $status)
    {
        $sql = "UPDATE `comments` SET `is_deleted`= $status WHERE  comment_id =$id";
        pdo_query($sql);
    }
    public function list_comment_black_and_list($offset, $per_page, $status)
    {
        $get_comment   = "SELECT comments.comment_id, comments.user_id, comments.product_id, comments.content, comments.comment_date,users.user_name ,products.product_name
        FROM comments   JOIN users ON comments.user_id = users.user_id   Join products ON comments.product_id = products.product_id
        WHERE comments.is_deleted=$status
        ORDER BY `comment_id` DESC  LIMIT $per_page offset $offset ";
        $list_comment_ad = pdo_query($get_comment);
        return $list_comment_ad;
    }
    public function get_row_commnet_admin($status)
    {
        $list_comment_row = "SELECT COUNT(*) as total
        FROM comments
        JOIN users ON comments.user_id = users.user_id
        JOIN products ON comments.product_id = products.product_id
        WHERE comments.is_deleted = $status
        ";
        $row = pdo_query_one($list_comment_row);
        return $row["total"];
    }
    public function get_row($id)
    {
        $list_comment_row = "SELECT COUNT(*) as total FROM comments WHERE product_id=$id AND is_deleted=1";
        $row = pdo_query_one($list_comment_row);
        return $row["total"];
    }
    public function setcomment($comment, $id, $user_id)
    {
        $insert_comment = "INSERT INTO `comments`(`user_id`, `product_id`, `content`) VALUES ('$user_id','$id','$comment')";
        pdo_query($insert_comment);
    }
    public function getcomment($id)
    {
        $get_comment = "SELECT comments.comment_id, comments.user_id, comments.product_id, comments.content, comments.comment_date,users.user_name 
        FROM comments 
        JOIN users ON comments.user_id = users.user_id  
        WHERE comments.product_id=$id AND comments.is_deleted=1 
        ORDER BY `comment_id` DESC";


        $list_comment =  pdo_query($get_comment);
        return $list_comment;
    }
}
