<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="/index.js"></script>
    <link rel="stylesheet" href="css/stylesds.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/themify-icons/themify-icons.css">
    <link rel="shortcut icon" href="css/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"    href="css/fontawesome-free-6.4.2-web/css/all.css">
    <script src="./js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</head>
<body>
     <div>
        <div class="navbar">
        <nav class="header_navbar">
            <ul class="header_navbar-list">
                <li class="header_navbar-item header_navbar-item-separate">Vào cửa hàng trên ứng dụng mobile-shop</li>
                <?php  if (!empty($_SESSION['user'])) {?>   
                    <li class="header_navbar-item">
                    <i class="fa-solid fa-user-tie"></i>
                    <a href="index.php?act=login_admin">vào trang quản trị</a>
                
                </li>
                    <?php } else {?>
                <li class="header_navbar-item">
                    Kết nối
                    <i class="header_navbar-icon fa-brands fa-facebook"></i>
                    <i class="header_navbar-icon fa-brands fa-instagram"></i>
                </li>
                <?php }  ?>
                <?php  if (!empty($_SESSION['user'])) {?>    
                <li class="header_navbar-item">
                <i class=" header_navbar-icon fa-solid fa-money-bills"></i>
                <a href="index.php?act=bill">Kiểm tra đơn hàng</a>
                </li>
                <?php } else {?>
                    <li class="header_navbar-item">Hotline: 0813783419</li>


                    <?php }                                           ?>
            </ul>
            <ul class="header_navbar-list">
                
                
                <?php  if (!empty($_SESSION['user'])) {?>    

           <li class="header_navbar-item header_navbar-item-link">

           <i style="margin-right: 2px;" class="fa-solid fa-user"></i> 
           <?=$_SESSION['user']['user_name']?>
           <li class="header_navbar-item header_navbar-item-link"><a href="index.php?act=logout">
             <i style="margin-right: 2px;" class="fa-solid fa-arrow-right-from-bracket"></i>
                    Đăng xuất</a></li>
                    <li class="header_navbar-item header_navbar-item-link"><a href="index.php?act=forgotpassword">

           <i style="margin-right: 2px;" class="fa-solid fa-lock"></i> 
              Quên mk</a></li>
              <li class="header_navbar-item"> <a href="index.php?act=updatepassword">
                    <i class="header_navbar-icon fas fa-bell"></i>
                    Cập nhật
                    </a>
                </li>
       <?php } else {?>
                <li class="header_navbar-item header_navbar-item-link"><a href="index.php?act=register">

                    <i style="margin-right: 2px;" class="fa-solid fa-key"></i>
                    Đăng ký</a></li>
            
                <li class="header_navbar-item header_navbar-item-link"><a href="index.php?act=login">
                    
                    <i style="margin-right: 2px;" class="fa-solid fa-right-to-bracket"></i>
                    Đăng nhập</a></li>
                    <li class="header_navbar-item header_navbar-item-link"><a href="index.php?act=forgotpassword">

           <i style="margin-right: 2px;" class="fa-solid fa-lock"></i>
              Quên mk</a></li>
                    <?php }                                           ?>
            </ul>
        </nav>
        <div class="header-with_search">
            <div class="header__logo">
                <img src="admin/upload/vbmvyphn.png" alt="">
            </div>
            <form class="header__search" action="index.php?act=search" method="post">
             <input type="text" class="header_search-input" name="search" placeholder="tìm kiếm" required>
             <input type="submit" value="Tìm kiếm" class="search-button">
        </form>
        <div class="header__cart">
            <a  style="text-decoration:none;" href="index.php?act=add_to_cart">
            <i class="header_cart-icon fas fa-shopping-cart"></i>
            </a>
        </div>
        </div>
    </div>
     <div class="header">
     <!-- <a href="#" class="logo_navbar">TPD</a> -->
        <ul class="nav">
           <li class="danhmuc">
                <a href="">
                <i class="fa-solid fa-list"></i>
                
                DANH MỤC

            </a>
                
             <?php 
               $cat_tree = $categoryController->list_categories();
               if(!empty($cat_tree)){
                $categoryController->show_categories_menu($cat_tree);
               } ?>

            </li>
            </ul>

        <ul class="nav">
           <li class=""><a href="index.php">TRANG CHỦ</a></li>
           <li><a href="index.php?act=intro">GIỚI THIỆU</a></li> 
           <li><a href="index.php?act=product_view">SẢN PHẨM</a></li>
           <li>
            <a href="index.php?act=contact">LIÊN HỆ
            </a>          
        </li> 
        <li>
            <a href="index.php?act=rules">ĐIỀU KHOẢN
            </a>          
        </li> 
        </ul>
</div>
       </div>

<script>
    
</script>
<style>
    .sub-menu{
        position: absolute;
        left: 0;
        width: 200px;
        background: #fff;
        display: none;
    }
    .header{
        background-color: #FFFFFF;
        display: flex;
        box-shadow: 0 5px 10px rgba(0,0,0,.1);
        padding: 0px 7%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1000;
    }
    .header .logo_navbar {
        font-weight: bold;
        text-decoration: none;
        font-size: 25px;
        color: #333;
    }
    .nav{
        list-style: none;
        display: flex;
    }
    .nav  li {
        position: relative;
    }
    .nav  li a{
        font-size: 20px;
        padding: 20px;
        color: #333;
        display: block;
        text-decoration: none;
    }
    .nav li a:hover{
        background: #333;
        color: #fff;
    }
    .sub-menu li .sub-menu{
        left: 200px;
        top: 0;
    }
    .nav li:focus-within >.sub-menu,
    .nav li:hover >.sub-menu{
        display: initial;
    }
</style>