<?php
include "model/pdo.php";
include "controller/CartController.php";
include "controller/UserController.php";
include "controller/ProductsController.php";
include "controller/CommentController.php";
include "controller/CategoriesController.php";
include "controller/RaitingController.php";

session_start();

$userController = new UserController();
$productscontrol = new ProductController();
$commentcontroller = new CommentController();
$categoryController = new CategoriesController();
$cart_controller = new CartController();
$rating = new RaitingController();

include "view/header.php";

if (isset($_GET['act']) && !empty($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'register':
            $userController->register();
            break;
        case 'login':
            $userController->login();
            break;
        case "logout":
            $userController->logout();
            break;
        case "forgotpassword":
            $userController->forgotPassword();
            break;
        case "updatepassword":
            $userController->update_user();
            break;
        case "intro":
            include "view/intro.php";
            break;
        case "contact":
            include "view/contact.php";
            break;
        case "rules":
            include "view/rules.php";
            break;
        case "search":
            include "view/search.php";
            break;
        case "product_view":
            include "view/product.php";
            break;
        case "products_detail":
            include "client/Products/Products_detail.php";
            break;
        case "comment":
            $commentcontroller->insertComment();
            break;
        case "add_to_cart":
            $cart_controller->Cart_SESSION(true);
            break;
        case "cart":
            include "view/cart_view.php";
            break;
        case "delete_cart":
            $cart_controller->delete_cart();
            break;
        case "checkout":
            include "view/check_out.php";
            break;
        case "update_cart":
            $cart_controller->update_cart();
            break;
        case "ordercheck":
            $cart_controller->oder_check();
            break;
        case "order_details":
            include "view/order_detail.php";
            break;
        case "bill":
            include "view/detail_order_user.php";
            break;
        case "show_cate_product":
            include "view/product_with_category_view.php";
            break;
        case "rating_order":
            $rating->set_rating();
            break;
        case "delete_order_detail":
            $cart_controller->update_status_order_detail();
            break;
        case "login_admin":
            $userController->login_admin();
            break;
    }
} else {
    include "view/home.php";
}

include "view/footer.php";
