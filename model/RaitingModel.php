<?php
 class RaitingModel{
    public function set_rating_model($selectedRating,$id_user,$id){
     $sql= "INSERT INTO `rating`(`user_id`, `value`,`order_id`) VALUES ('$id_user','$selectedRating','$id')";
     pdo_query($sql);
    }
    public function get_rating_by_user($user_id,$order_id){
    $sql="SELECT `rating_id`, `user_id`, `value`, `rating_date`, `order_id` FROM `rating` WHERE user_id=$user_id AND order_id=$order_id";
    $list_rating=pdo_query_one($sql);
    return $list_rating;

    }
 }





?>