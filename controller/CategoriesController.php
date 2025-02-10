<?php
include __DIR__ . "/../model/CategoriesModel.php";

class CategoriesController
{
    public function list_categories()
    {
        $catemodel = new CategoriesModel();
        $list_category = $catemodel->getCategory();
        $list_categorys = $this->create_cate_tree($list_category, 0);
        return $list_categorys;
    }

    public function create_cate_tree(&$list_category, $parent_id)
    {
        $cate_tree = [];
        foreach ($list_category as $key => $value) {
            if ($value["parent_id"] == $parent_id) {
                $children = $this->create_cate_tree($list_category, $value["category_id"]);
                if ($children) {
                    $value['children'] = $children;
                }
                $cate_tree[] = $value;
                unset($list_category[$key]);
            }
        }

        return $cate_tree;
    }
    public function show_cat_select_box($cat_tree, $repeat)
    {
        $repeat++;
        foreach ($cat_tree as $key) {
            echo '<option value="' . $key["category_id"] . '">' . str_repeat("---", $repeat - 1) . $key['category_name'] . '</option>';
            if (!empty($key['children'])) {
                $this->show_cat_select_box($key["children"], $repeat);
            }
        }
    }
    public function show_cat_admin($cat_tree, $repeat)
    {
        $repeat++;
        foreach ($cat_tree as $key) {
            echo "
            <tr>
            <td> {$key['category_id']} </td>
            <td>" . str_repeat("---", $repeat - 1) . $key['category_name'] . "</td> 
            <td><a href='index.php?act=set_category&id={$key['category_id']}'>sửa</a></td>
            <td><a href='javascript:category_delete({$key['category_id']})'>xóa</td>
            </tr>
            ";
            if (!empty($key['children'])) {
                $this->show_cat_admin($key["children"], $repeat);
            }
        }
    }

    
    public function add_category()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $category_name = isset($_POST["category_name"]) ? $_POST["category_name"] : '';
            $select_input_cate = isset($_POST["select_input_cate"]) ? $_POST["select_input_cate"] : "";
            $catemodel = new CategoriesModel();
            $catemodel->add_category_admin($category_name, $select_input_cate);
        }
        header("Location: index.php?act=categories");
        exit();
    }
    public function update_category()
    {
        $id = isset($_GET["id"]) ? $_GET["id"] : '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $category_name = isset($_POST["category_name"]) ? $_POST["category_name"] : '';
            $select_input_cate = isset($_POST["select_input_cate"]) ? $_POST["select_input_cate"] : "";
            $catemodel = new CategoriesModel();
            $catemodel->update_category_admin($id, $category_name, $select_input_cate);
            header("Location: index.php?act=categories");
            exit();
        }
    }
    public function delete_category($id, $cat_tree)
    {
        $catemodel = new CategoriesModel();
        foreach ($cat_tree as $key) {
            if ($key["parent_id"] == $id) {
                $this->delete_category($key["category_id"], $cat_tree);
                $catemodel->delete_category_admin($key["category_id"]);
            } else {
                $catemodel->delete_category_admin($id);
            }
        }
    }
    public function show_categories_menu($cat_tree, $repeat = 0)
    {
        echo '<ul class="sub-menu">';
        foreach ($cat_tree as $key) {
            echo '<li>';
            echo '<a href="index.php?act=show_cate_product&id=' . $key['category_id'] . '">' . $key['category_name'] . '</a>';


            if (!empty($key['children'])) {
                $this->show_categories_menu($key['children'], $repeat + 1);
            }

            echo '</li>';
        }
        echo '</ul>';
    }
    public function get_row_cat_pro($cat_tree, $id)
    {
        $row_pro = [];

        foreach ($cat_tree as $key) {
            if ($key["category_id"] == $id) {
                $products = $this->list_row_product_cat($key["category_id"]);

                if (!empty($products)) {
                    $row_pro = array_merge($row_pro, $products);
                }
            }

            if (!empty($key['children'])) {
                $row_pro = array_merge($row_pro, $this->get_row_cat_pro($key['children'], $id));
            }

            if (!empty($key['children']) && $key["category_id"] == $id) {
                foreach ($key['children'] as $child) {
                    $childProducts = $this->list_row_product_cat($child["category_id"]);
                    if (!empty($childProducts)) {
                        $row_pro = array_merge($row_pro, $childProducts);
                    }
                }
            }
        }

        return $row_pro;
    }

    public function get_categories_menu_with_products($cat_tree, $id, $offset, $per_page)
    {
        $result = [];

        foreach ($cat_tree as $key) {
            if ($key["category_id"] == $id) {
                $products = $this->list_categories_with_products($key["category_id"], $offset, $per_page);

                if (!empty($products)) {
                    $result = array_merge($result, $products);
                }
            }

            if (!empty($key['children'])) {
                $result = array_merge($result, $this->get_categories_menu_with_products($key['children'], $id, $offset, $per_page));
            }

            if (!empty($key['children']) && $key["category_id"] == $id) {
                foreach ($key['children'] as $child) {
                    $childProducts = $this->list_categories_with_products($child["category_id"], $offset, $per_page);
                    if (!empty($childProducts)) {
                        $result = array_merge($result, $childProducts);
                    }
                }
            }
        }

        return $result;
    }

    public function list_categories_with_products($category_id, $offset, $per_page)
    {

        $catemodel = new CategoriesModel();
        $products = $catemodel->getProductsByCategory($category_id, $offset, $per_page);
        return $products;
    }
    public function list_row_product_cat($category_id)
    {
        $catemodel = new CategoriesModel();
        $products = $catemodel->get_row_pro_by_category($category_id);
        return $products;
    }

    public function get_categories_menu_with_products_sort($cat_tree, $id, $offset, $per_page, $sort)
    {
        $result = [];

        foreach ($cat_tree as $key) {
            if ($key["category_id"] == $id) {
                $products = $this->list_categories_with_products_sort($key["category_id"], $offset, $per_page, $sort);

                if (!empty($products)) {
                    $result = array_merge($result, $products);
                }
            }

            if (!empty($key['children'])) {
                $result = array_merge($result, $this->get_categories_menu_with_products_sort($key['children'], $id, $offset, $per_page, $sort));
            }

            if (!empty($key['children']) && $key["category_id"] == $id) {
                foreach ($key['children'] as $child) {
                    $childProducts = $this->list_categories_with_products_sort($child["category_id"], $offset, $per_page, $sort);
                    if (!empty($childProducts)) {
                        $result = array_merge($result, $childProducts);
                    }
                }
            }
        }

        return $result;
    }
    public function list_categories_with_products_sort($category_id, $offset, $per_page, $sort)
    {

        $catemodel = new CategoriesModel();
        $products = $catemodel->getProductsByCategory_sort($category_id, $offset, $per_page, $sort);
        return $products;
    }
    public function get_row_sale_cate_pro($cat_tree, $id, $sale)
    {
        $row_pro = [];

        foreach ($cat_tree as $key) {
            if ($key["category_id"] == $id) {
                $products = $this->row_sale($key["category_id"], $sale);

                if (!empty($products)) {
                    $row_pro = array_merge($row_pro, $products);
                }
            }

            if (!empty($key['children'])) {
                $row_pro = array_merge($row_pro, $this->get_row_sale_cate_pro($key['children'], $id, $sale));
            }

            if (!empty($key['children']) && $key["category_id"] == $id) {
                foreach ($key['children'] as $child) {
                    $childProducts = $this->row_sale($child["category_id"], $sale);
                    if (!empty($childProducts)) {
                        $row_pro = array_merge($row_pro, $childProducts);
                    }
                }
            }
        }

        return $row_pro;
    }
    public function get_categories_menu_with_products_sale($catetre, $id, $offset, $per_page, $sale)
    {
        $result = [];

        foreach ($catetre as $key) {
            if ($key["category_id"] == $id) {
                $products = $this->list_categories_with_products_sale($key["category_id"], $offset, $per_page, $sale);

                if (!empty($products)) {
                    $result = array_merge($result, $products);
                }
            }

            if (!empty($key['children'])) {
                $result = array_merge($result, $this->get_categories_menu_with_products_sale($key['children'], $id, $offset, $per_page, $sale));
            }

            if (!empty($key['children']) && $key["category_id"] == $id) {
                foreach ($key['children'] as $child) {
                    $childProducts = $this->list_categories_with_products_sale($child["category_id"], $offset, $per_page, $sale);
                    if (!empty($childProducts)) {
                        $result = array_merge($result, $childProducts);
                    }
                }
            }
        }

        return $result;
    }
    public function row_sale($category_id, $sale)
    {
        $catemodel = new CategoriesModel();
        $products = $catemodel->get_row_sale_by_category($category_id, $sale);
        return $products;
    }
    public function list_categories_with_products_sale($category_id, $offset, $per_page, $sale)
    {
        $catemodel = new CategoriesModel();
        $products = $catemodel->get_product_sale_by_category($category_id, $offset, $per_page, $sale);
        return $products;
    }
    public function get_categories_menu_with_products_sort_by_id($catetre, $id, $offset, $per_page, $sort)
    {
        $result = [];

        foreach ($catetre as $key) {
            if ($key["category_id"] == $id) {
                $products = $this->list_categories_with_products_sort_by_id($key["category_id"], $offset, $per_page, $sort);

                if (!empty($products)) {
                    $result = array_merge($result, $products);
                }
            }

            if (!empty($key['children'])) {
                $result = array_merge($result, $this->get_categories_menu_with_products_sort_by_id($key['children'], $id, $offset, $per_page, $sort));
            }

            if (!empty($key['children']) && $key["category_id"] == $id) {
                foreach ($key['children'] as $child) {
                    $childProducts = $this->list_categories_with_products_sort_by_id($child["category_id"], $offset, $per_page, $sort);
                    if (!empty($childProducts)) {
                        $result = array_merge($result, $childProducts);
                    }
                }
            }
        }

        return $result;
    }
    public function  list_categories_with_products_sort_by_id($category_id, $offset, $per_page, $sort)
    {
        $catemodel = new CategoriesModel();
        $products = $catemodel->get_product_sort_id_by_category($category_id, $offset, $per_page, $sort);
        return $products;
    }


    public function get_product_related($category_id, $product_id)
    {
        $catemodel = new CategoriesModel();
        $products = $catemodel->get_product_related($category_id, $product_id);
        return $products;
    }
}
?>
<tr>
    <td></td>
</tr>