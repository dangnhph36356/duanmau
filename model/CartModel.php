<?php
class CartModel
{
    public function update_status_details_delete($id)
    {
        $sql = "UPDATE `orders` SET  `is_on_order`=4 where `order_id` = $id";
        pdo_query($sql);
    }
    public function delete_order_admin($id)
    {
        $sql = "DELETE FROM `orders` WHERE order_id=$id";
        pdo_query($sql);
    }
    public function add_to_cart($implode_in)
    {
        $sql = "SELECT * FROM `products` WHERE `product_id` IN ($implode_in)";
        $list = pdo_query($sql);
        return $list;
    }
    public function  setCart($phone, $address, $area, $name, $email, $list_cart, $total_money, $payment_method)
    {
        $conn = pdo_get_connection();
        $sql = "INSERT INTO `orders`(`address_shipping`,`name`, `phone_number`,`text_area`,`email`,`total_money`,`payment_method`) 
           VALUES ('$address','$name','$phone','$area','$email','$total_money','$payment_method')";
        $conn->query($sql);
        $last_id = $conn->lastInsertId();
        $this->set_order_detail($last_id, $list_cart);
    }
    public function setCart_user($phone, $address, $area, $user, $list_cart, $total_money, $payment_method)
    {
        $conn = pdo_get_connection();
        $user_name = $user["user_name"];
        $user_id = $user["user_id"];
        $user_email = $user["email"];
        $sql = "INSERT INTO`orders`(`address_shipping`,`user_id`, `name`, `phone_number`, `text_area`, `email`,`total_money`,`payment_method`) VALUES ('$address','$user_id','$user_name','$phone','$area','$user_email','$total_money','$payment_method')";
        $conn->query($sql);
        $last_id = $conn->lastInsertId();
        $this->set_order_detail($last_id, $list_cart);
    }
    public function set_order_detail($last_id, $list_cart)
    {
        $cart_list =  $this->add_to_cart(implode(",", array_keys($list_cart)));
        foreach ($list_cart as $key => $value) {
            foreach ($cart_list as $product) {
                if ($product["product_id"] == $key) {
                    $sql = "INSERT INTO `details` (`order_id`, `product_id`, `quantily`, `price`) VALUES ('$last_id', '$key', '$value', '{$product["price"]}')";
                    pdo_query($sql);
                    break;
                }
            }
            echo "<script>alert('mua hàng thành công')
     window.location.href='index.php?act=order_details&id=$last_id';
     </script>";
        }
    }
    public function get_order_detail($id)
    {
        $sql = "SELECT orders.order_id, orders.address_shipping, orders.is_on_order, orders.order_date, orders.user_id, orders.name,orders.payment_method,orders.phone_number, orders.text_area, orders.email, orders.total_money, details.order_id AS details_order_id, details.product_id, details.quantily, details.price, products.product_name, users.user_name, users.email AS user_email, users.address AS user_address FROM orders  JOIN details ON orders.order_id = details.order_id LEFT JOIN users ON orders.user_id = users.user_id LEFT JOIN products ON details.product_id = products.product_id WHERE orders.order_id = $id";
        $list = pdo_query($sql);
        return $list;
    }
    public function get_order_user($id)
    {
        $sql = "SELECT 
    orders.`order_id`, 
    orders.`address_shipping`, 
    orders.`is_on_order`, 
    orders.`order_date`, 
    orders.`user_id`, 
    orders.`name`, 
    orders.`phone_number`, 
    orders.`text_area`, 
    orders.`email` AS order_email, 
    orders.`total_money`,
    users.`user_name`, 
    users.`email` AS user_email,  
    users.`address`
FROM 
    orders
JOIN 
    users ON orders.user_id = users.user_id where  orders.user_id = $id";
        $list = pdo_query($sql);
        return $list;
    }
    public function get_orders_user_admin($offset, $per_page)
    {
        $sql = "SELECT 
    orders.`order_id`, 
    orders.`address_shipping`, 
    orders.`is_on_order`, 
    orders.`order_date`, 
    orders.`user_id`, 
    orders.`name`, 
    orders.`phone_number`, 
    orders.`text_area`, 
    orders.`email` AS order_email, 
    orders.`total_money`,
    users.`user_name`, 
    users.`email` AS user_email,  
    users.`address`
FROM 
    orders
 LEFT JOIN 
   users ON orders.user_id = users.user_id  LIMIT $per_page OFFSET $offset";
        $list = pdo_query($sql);
        return $list;
    }
    public function update_status_details($status, $id)
    {
        $sql = "UPDATE `orders` SET  `is_on_order`='$status' where `order_id` = $id";
        pdo_query($sql);
    }
    public function get_order_chart()
    {
        $sql = "SELECT 
        DATE(orders.order_date) as year,
        SUM(orders.total_money) as sale,
        SUM(details.quantily) as quantily
    FROM 
        orders
    JOIN 
        details ON orders.order_id = details.order_id
    GROUP BY DATE(orders.order_date);"; // Nhóm theo ngày

        $list = pdo_query($sql);
        return $list;
    }

    public function get_row_cat()
    {
        $sql = "SELECT COUNT(*) as total FROM orders";
        $list = pdo_query_one($sql);
        return $list["total"];
    }
}
