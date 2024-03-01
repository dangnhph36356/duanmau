<?php
include __DIR__ . "/../model/pdo.php";

include __DIR__ . "/../controller/UserController.php";
include __DIR__ . "/../controller/ProductsController.php";
include __DIR__ . "/view/header.php";

include __DIR__ . "/../controller/CommentController.php";
include __DIR__ . "/../controller/CategoriesController.php";
include __DIR__ . "/../controller/CartController.php";
include __DIR__ . "/../controller/RaitingController.php";

$cat = new CategoriesController();
$productscontrol = new ProductController();
$userController = new UserController();
$commentcontroller = new CommentController();
$cart_controller = new CartController();
$rating = new RaitingController();

session_start();

if (isset($_GET['act']) && ($_GET['act'] != "")) {
    $act = $_GET['act'];
    switch ($act) {
        case 'product':
            include __DIR__ . '/view/product.php';

            break;
        case 'add_product':
            include __DIR__ . "/Product/product_add.php";
            break;
        case 'product_form_add':
            $productscontrol->insert_Product_admin();
            break;
        case "upadate_product":
            include __DIR__ . "/Product/edit_product.php";
            break;
        case "product_form_edit":
            $productscontrol->edit_product_admin();
            break;
        case "delete_product":
            $productscontrol->delete_product();
            break;
        case "delete_galery":
            $productscontrol->delete_galery();
            break;
        case "categories":
            include __DIR__ . '/view/category_view.php';

            break;
        case "add_categories":
            include __DIR__ . '/categories/add_category.php';


            break;
        case "category_form_add":
            $cat->add_category();
            break;
        case "update_category":
            $cat->update_category();
            break;
        case "set_category":
            include __DIR__ . "/categories/update_category.php";

            break;
        case "delete_category":
            $id = isset($_GET["id"]) ? $_GET["id"] : '';
            $cat_tree = $productscontrol->cantegory();
            $cat->delete_category($id, $cat_tree);
            header("Location: index.php?act=categories");
            exit();
            break;
        case "user_admin":
            include __DIR__ . "/view/user_view.php";
            break;
        case "user_detail":
            include __DIR__ . "/view/user/user_detail.php";
            break;
        case "delete_user":
            $userController->sort_delete_users(0);
            break;
        case "black_list_user":
            include __DIR__ . "/user/blacklist_user.php";

            break;
        case "restore":
            $userController->sort_delete_users(1);
            break;
        case "commment_view":
            include __DIR__ . "/view/comment_view.php";
            break;
        case "delete_comment":
            $commentcontroller->sort_delete_comment(0);
            break;
        case "restore_comment":
            $commentcontroller->sort_delete_comment(1);
            break;
        case "black_list_comment":
            include __DIR__ . "/comment/blacklist_comment.php";
            break;
        case "order":
            include __DIR__ . "/view/order_view.php";
            break;
        case "update_order":
            include __DIR__ . "/view/order_detail_admin.php";
            break;
        case "update_detail":
            $cart_controller->update_detail();
            break;
        case "delete_order":
            $cart_controller->delete_order();
            break;
        case "set_admin":
            $userController->set_admin();
            break;
        case "search_product":
            $productscontrol->search_product_admin();
            break;
        case "search_user":
            $userController->search_user();
            break;
        case "search_comment":
            $commentcontroller->search_comment();
            break;
    }
} else {
    include __DIR__ . "/view/home.php";
}

include __DIR__ . "/view/footer.php";
