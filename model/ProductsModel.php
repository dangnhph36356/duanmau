<?php
class ProductsModel
{
    public function listProducts_pagination_sort_by_id($offset, $per_page, $sort_product)
    {
        $query = "SELECT * FROM products ORDER BY product_id $sort_product LIMIT $per_page offset $offset";
        $list_product = pdo_query($query);
        return $list_product;
    }
    public function delete_galery_id($id)
    {
        $sql = "DELETE FROM `galery` WHERE `galery_id`=$id";
        pdo_query($sql);
    }
    public function update_product_admin($id, $product_name, $description, $price, $category_id, $price_old, $is_on_sale, $avatar)
    {
        $sql = "UPDATE products 
                SET product_name = ?, descritipion = ?, price = ?, category_id = ?, price_old = ?, is_on_sale = ?, avatar = ?
                WHERE product_id = ?";

        pdo_query($sql, $product_name, $description, $price, $category_id, $price_old, $is_on_sale, $avatar, $id);
    }


    public function update_galery($newPaths, $id)
    {
        foreach ($newPaths as $key) {
            $insert_path = "INSERT INTO `galery`(`product_id`, `image_url`) VALUES ('$id','$key')";
            pdo_query($insert_path);
        }
    }
    public function list_galery_by_id($update_id)
    {
        $query = "SELECT * FROM galery where product_id =$update_id";
        $list = pdo_query($query);
        return $list;
    }
    public function list_products_by_id($update_id)
    {
        $query = "SELECT * FROM products where product_id =$update_id";
        $list = pdo_query_one($query);
        return $list;
    }
    public function listProducts_pagination($offset, $limit)
    {
        $list = "SELECT products.product_id,products.avatar,products.is_on_sale,products.product_name, products.descritipion, products.price, products.category_id, products.price_old
        FROM products LIMIT $limit OFFSET $offset";
        $list_product = pdo_query($list);
        return $list_product;
    }
    public function listProducts_pagination_sort($offset, $limit, $sort)
    {
        $query = "SELECT * FROM products ORDER BY price $sort LIMIT $limit offset $offset";
        $list_product = pdo_query($query);
        return $list_product;
    }
    public function listProducts_pagination_sale($offset, $limit, $is_on_sale)
    {
        $is_sale = "SELECT * FROM products where is_on_sale = $is_on_sale LIMIT $limit offset $offset";
        $list_product = pdo_query($is_sale);
        return $list_product;
    }
    public function row_products()
    {
        $list_products = "SELECT COUNT(*) as total FROM products";
        $row = pdo_query_one($list_products);
        return $row["total"];
    }
    public function row_products_sale()
    {
        $list_products = "SELECT COUNT(*) as total FROM products where is_on_sale = 1";
        $row = pdo_query_one($list_products);
        return $row["total"];
    }
    public function list_cantegory()
    {
        $list = "SELECT * FROM `categories`";
        $list_cantegory = pdo_query($list);
        return $list_cantegory;
    }

    public function insert_product($product_name, $product_price, $productDescription, $cantegory_product, $sale_price, $sale_select, $newFilePath, $newPaths)
    {
        $conn = pdo_get_connection();

        // Kiểm tra và thay thế giá trị rỗng
        $product_price = (!empty($product_price) && is_numeric($product_price)) ? $product_price : 0;
        $sale_price = (!empty($sale_price) && is_numeric($sale_price)) ? $sale_price : 0;

        $query = "INSERT INTO `products`(`product_name`, `descritipion`, `price`, `category_id`, `price_old`, `is_on_sale`, `avatar`) 
              VALUES (:product_name, :productDescription, :product_price, :cantegory_product, :sale_price, :sale_select, :newFilePath)";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':productDescription', $productDescription);
        $stmt->bindParam(':product_price', $product_price, PDO::PARAM_INT);
        $stmt->bindParam(':cantegory_product', $cantegory_product);
        $stmt->bindParam(':sale_price', $sale_price, PDO::PARAM_INT);
        $stmt->bindParam(':sale_select', $sale_select);
        $stmt->bindParam(':newFilePath', $newFilePath);

        $stmt->execute();

        $last_id = $conn->lastInsertId();
        $this->insert_galery($newPaths, $last_id);
    }


    private function insert_galery($newPaths, $last_id)
    {
        foreach ($newPaths as $key) {
            $insert_path = "INSERT INTO `galery`(`product_id`, `image_url`) VALUES ('$last_id','$key')";
            pdo_query($insert_path);
        }
    }
    public function search_product($key)
    {
        $sql = "SELECT * FROM `products` WHERE product_name LIKE '%$key%'";
        $search_product = pdo_query($sql);
        return $search_product;
    }
    public function delete_product($key)
    {
        $sql = "DELETE  from `products` WHERE product_id = $key";
        pdo_query($sql);
        header('location:index.php?act=product');
        exit();
    }
}
