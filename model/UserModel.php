<?php
class UserModel {
    public function set_admin($id,$status){
        $query= "UPDATE users SET role_id = $status WHERE user_id = $id";
        pdo_query($query);
    }
    public function list_userss_black_list($offset,$per_page){
        $list="SELECT * FROM users WHERE  is_deleted=0  LIMIT $per_page OFFSET $offset "; 
        $list_use_black=pdo_query($list);
        return $list_use_black;
    }
    public function sort_delete_user($id,$status){
        $sql="UPDATE `users` SET `is_deleted`= $status WHERE  user_id =$id";
        pdo_query($sql);
    }
    public function list_userss($offset,$per_page) {
        $list="SELECT * FROM users WHERE  is_deleted=1  LIMIT $per_page OFFSET $offset "; 
        $list_use_ad=pdo_query($list);
        return $list_use_ad;
    }
    public function row_users($status){
        $list_users="SELECT COUNT(*) as total FROM users where is_deleted=$status";
        $row=pdo_query_one($list_users);
        return $row["total"];
    }
    public function register($username, $password,$date,$location,$email) {
        $insert_user="INSERT INTO `users`(`user_name`, `password`, `birth_day`, `address`,`email`) VALUES ('$username','$password','$date','$location','$email')";
        pdo_query($insert_user);
    }

    public function login($username, $password) {
        $user_login="SELECT * FROM users WHERE user_name = '$username' AND password = '$password' AND is_deleted =1";
        $session_user=pdo_query_one($user_login);
        return $session_user;
    }
    public function logout() {
        unset($_SESSION['user']);
		header('Location: index.php'); 
    }
    public function check_user($username){
        $user_select="SELECT * FROM users WHERE user_name = '$username'";
        $user_checkExists=pdo_query_one($user_select);
        return $user_checkExists;
    }
    public function forgotPassword($username, $email) {
        $user_forgot="SELECT * FROM users WHERE user_name = '$username' AND email = '$email' AND is_deleted =1 ";
        $user_mesege=pdo_query_one($user_forgot);
        return $user_mesege;
    }
    public function update($user,$username,$password,$date,$location,$email) {
        $update="UPDATE `users` SET `user_name`='$username',`email`='$email',`password`='$password',`address`='$location',`birth_day`='$date' WHERE user_name='$user'  ";
        pdo_query($update);
    }
}
?>