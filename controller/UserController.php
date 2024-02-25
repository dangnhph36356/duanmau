<?php
include __DIR__ . "/../model/UserModel.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// include __DIR__ . "/../PHPMailer/src/Exception.php";
// include __DIR__ . "/../PHPMailer/src/PHPMailer.php";
// include __DIR__ . "/../PHPMailer/src/SMTP.php";

ob_start();
class UserController
{
    public function search_user()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_SESSION["filter_user"] = $_POST;
            if (!empty($_SESSION["filter_user"])) {
                $where = "";
                foreach ($_SESSION["filter_user"] as $key => $value) {
                    if (!empty($value)) {
                        switch ($key) {
                            case "user_name":
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
                header("Location: index.php?act=user_admin&$searchParams");
                exit();
            } else {
                echo "<script>
           alert('Cần nhập giá trị tìm kiếm')
           window.location.href='index.php?act=user_admin';
           </script>";
            }
        }
    }
    public function set_admin()
    {
        $id = isset($_GET["id"]) ? $_GET["id"] : "";
        $status = isset($_GET["status"]) ? $_GET["status"] : "";
        $userModel = new UserModel();
        $userModel->set_admin($id, $status);
        echo "<script>
        alert('phân quyền thành công');
        window.location.href='index.php?act=user_admin';
        </script>";
    }
    public function login_admin()
    {
        if (isset($_SESSION["user"]) && $_SESSION["user"]["role_id"] != 0) {
            header("Location: admin/index.php");
            exit();
        } else {
            echo " <script>
           alert('Bạn không đủ quyền để truy cập')
            window.location.href='index.php';
           </script>";
        }
    }
    public function sort_delete_users($status)
    {
        $id = isset($_GET["id"]) ? $_GET["id"] : "";
        $userModel = new UserModel();
        $userModel->sort_delete_user($id, $status);
        if ($status == 0) {
            header("Location: index.php?act=user_admin");
            exit();
        } else {
            header("Location: index.php?act=black_list_user");
            exit();
        }
    }
    public function show_user_black_list($offset, $per_page)
    {
        $userModel = new UserModel();
        $user_list_admin_black_list = $userModel->list_userss_black_list($offset, $per_page);
        return $user_list_admin_black_list;
    }
    public function user_row_list_black()
    {
        $userModel = new UserModel();
        $user_list_rows = $userModel->row_users(0);
        return $user_list_rows;
    }
    public function show_user($offset, $per_page)
    {
        $userModel = new UserModel();
        $user_list_admin = $userModel->list_userss($offset, $per_page);
        return $user_list_admin;
    }
    public function user_row_list()
    {
        $userModel = new UserModel();
        $user_list_rows = $userModel->row_users(1);
        return $user_list_rows;
    }
    public function check_user_productdetails($user_name)
    {
        $userModel = new UserModel();
        $user_comment = $userModel->check_user($user_name);
        return $user_comment;
    }
    public function register()
    {
        include "client/users/register.php";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['name'];
            $password = $_POST['password'];
            $date = $_POST["birthday"];
            $location = $_POST["location"];
            $email = $_POST["email"];

            $userModel = new UserModel();

            // Kiểm tra tên người dùng tồn tại
            $userExists = $userModel->check_user($username);

            if (empty($userExists)) {
                $userModel->register($username, $password, $date, $location, $email);
                echo  "<script>   alert('Đăng kí thành công')
                login();
                
                
                </script>";
            } else {
                echo "<script>
                jscomfirm()
                </script>";
            }
        }
    }

    public function login()
    {
        include "client/users/login.php";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['user_login'];
            $password = $_POST['password_login'];

            $userModel = new UserModel();
            $authenticated = $userModel->login($username, $password);

            if (!empty($authenticated)) {
                $_SESSION['user'] = $authenticated;
                header("Location: index.php");
                exit;
            } else {
                echo "<script>alert('Sai mật khẩu hoặc tên đăng nhập')
                login();
                </script>";
                exit;
            }
        } else {
        }
    }
    public function logout()
    {
        $usermodel = new UserModel();
        $usermodel->logout();
    }
    public function forgotPassword()
    {
        include "client/users/updatepassword.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['user_forgot'];
            $email = $_POST['email'];

            $userModel = new UserModel();
            $userInfo = $userModel->forgotPassword($username, $email);

            if (!empty($userInfo)) {


                // Gửi mật khẩu qua email
                $this->sendPasswordEmail($email, $userInfo['password']);
                echo " <script>  alert('mật khẩu đã được gửi qua email') 
                     window.location.href='index.php'
                    </script>";
            } else {
                echo "<script>
                    alert('Tên đăng nhập hoặc mật khẩu không chính xác')
                     index()   </script>
                    ";
            }
        } else {
        }
    }
    private function sendPasswordEmail($to, $password)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'dang36356@gmail.com';                     //SMTP username
            $mail->Password   = 'mltfzovbskeltupx';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;
            $mail->setFrom('dang36356@gmail.com', 'Người gửi');
            $mail->addAddress($to);

            // Thiết lập nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'SENDCODE';
            $mail->Body = 'Mật khẩu của bạn là: ' . $password;

            // Gửi email
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    public function  update_user()
    {
        include "client/users/updateuser.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['name'];
            $password = $_POST['password'];
            $date = $_POST["birthday"];
            $location = $_POST["location"];
            $email = $_POST["email"];
            $userModel = new UserModel();
            $checked = $userModel->check_user($username);
            if (isset($_SESSION["user"]) && (empty($checked))) {
                $user = $_SESSION["user"]["user_name"];
                $userModel->update($user, $username, $password, $date, $location, $email);
                $_SESSION["user"]["user_name"] = $username;
                echo "<script> 
            alert('cập nhật thành công');
            index()
            </script>";
            } else {
                echo "<script> 
              alert('Tên đăng nhập đã tồn tại')
              window.location.href='index.php?act=capnhat'
              </script>
              ";
            }
        }
    }
}
ob_flush()
?>
<script>
    function jscomfirm() {
        alert("Tên đăng nhập đã tồn tại")
        window.location.href = "index.php?act=register";
    }

    function index() {
        window.location.href = 'index.php';
    }

    function login() {
        window.location.href = "index.php?act=login"
    }

    function jsupdate() {
        alert("Tên đăng nhập đã tồn tại")
        window.location.href = "index.php?act=updatepassword";
    }
</script>