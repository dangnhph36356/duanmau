<?php

class CategoriesModel
{
  public function getCategory()
  {
    $list = "SELECT * FROM `categories`";
    $list_cantegory = pdo_query($list);
    return $list_cantegory;
  }

  public function get_category_by_id($id)
  {
    $sql = "SELECT * FROM categories WHERE category_id = ?";
    $category = pdo_query_one($sql, [$id]);

    return $category; // Trả về mảng chứa thông tin danh mục
  }


  public function add_category_admin($category_name, $select_input_cate)
  {
    $sql = "INSERT INTO `categories`(`category_name`, `parent_id`) VALUES ('$category_name','$select_input_cate')";
    pdo_query($sql);
  }
  public function update_category_admin($id, $category_name, $select_input_cate)
  {
    $sql = "UPDATE `categories` SET `category_name`='$category_name',`parent_id`='$select_input_cate' WHERE category_id = $id";
    pdo_query($sql);
  }
  public function delete_category_admin($id)
  {
    $sql = "DELETE  from `categories` WHERE category_id = $id";
    pdo_query($sql);
  }
  public function getProductsByCategory($category_id, $offset, $per_page)
  {
    $query = "SELECT * FROM products WHERE category_id = $category_id LIMIT $per_page  offset $offset ";
    $list = pdo_query($query);
    return $list;
  }
  public function get_row_pro_by_category($category_id)
  {
    $query = "SELECT * FROM products WHERE category_id = $category_id";
    $list = pdo_query($query);
    return $list;
  }
  public function getProductsByCategory_sort($category_id, $offset, $per_page, $sort)
  {
    $query = "SELECT * FROM products WHERE category_id = $category_id order by price $sort LIMIT $per_page  offset $offset";
    $list = pdo_query($query);
    return $list;
  }
  public function get_row_sale_by_category($category_id, $sale)
  {
    $query = "SELECT * FROM products WHERE category_id = $category_id  AND is_on_sale=$sale";

    $list = pdo_query($query);
    return $list;
  }
  public function get_product_sale_by_category($category_id, $offset, $per_page, $sale)
  {
    $query = "SELECT * FROM products WHERE category_id = $category_id  AND is_on_sale=$sale LIMIT $per_page offset $offset";
    $list = pdo_query($query);
    return $list;
  }
  public function get_product_sort_id_by_category($category_id, $offset, $per_page, $sort)
  {
    $query = "SELECT * FROM products WHERE category_id = $category_id order by product_id $sort LIMIT $per_page offset $offset";
    $list = pdo_query($query);
    return $list;
  }
  public function get_product_related($category_id, $product_id)
  {
    // Giả sử bạn có một bảng 'products' chứa thông tin sản phẩm
    $query = "SELECT * FROM products INNER JOIN categories ON products.category_id=categories.category_id WHERE products.category_id = $category_id OR categories.parent_id=$category_id AND products.product_id NOT IN ($product_id) Limit 4";
    $list = pdo_query($query);
    return $list;
  }
}
