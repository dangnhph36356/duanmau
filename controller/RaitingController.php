<?php
include __DIR__ . "/../model/RaitingModel.php";

class RaitingController
{
    public function set_rating()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_GET["id"] ? $_GET["id"] : "";
            if (isset($_SESSION["user"])) {
                $id_user = $_SESSION["user"]["user_id"];
            }

            if (isset($_POST["rating"])) {
                $selectedRating = $_POST["rating"];
                $rating_model = new RaitingModel();
                $rating_model->set_rating_model($selectedRating, $id_user, $id);

                echo "<script>
                    alert('Đánh giá thành công');
                    window.location.href='index.php?act=order_details&id=$id';
                    </script>";
                exit();
            } else {
                echo "<script>
                    alert('Bạn cần phải đánh giá');
                    window.location.href='index.php?act=order_details&id=$id';
                    </script>";
                exit();
            }
        }
    }
    public function get_rating($order_id)
    {
        if (isset($_SESSION["user"])) {
            $id_user = $_SESSION["user"]["user_id"];
        }
        $rating_model = new RaitingModel();
        $value_raiting = $rating_model->get_rating_by_user($id_user, $order_id);
        return $value_raiting;
    }
    public function get_rating_admin($order_id, $user_id)
    {
        $rating_model = new RaitingModel();
        $value_raiting = $rating_model->get_rating_by_user($user_id, $order_id);
        return $value_raiting;
    }
}
