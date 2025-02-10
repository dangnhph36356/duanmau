
<?php $search_input = $productscontrol->search_product(); 
?>


<div id="products" class="product-content">
     <?php
     if(!empty($search_input)){
     foreach ($search_input as $key) {     
            
            ?>
     <div class="product-item">
        <div class="product-image">
        <?php
    $avatarPath = "admin/" . $key["avatar"];
    if (file_exists($avatarPath)) {
        echo '<img style="
    width: 80%;
   height: 120px;
        " src="' . $avatarPath . '"  alt="">';
    } else {
        echo '<p>Sản phẩm không có ảnh</p>';
    }
    ?>
        </div>
        <div class="product-top-box">
              <h2 class="name"><a href="index.php?act=products_detail&&id=<?= $key["product_id"] ?>"><?=  $key["product_name"] ?></a></h2>
              <div class="price">
                <span class="price-new">
                <?= $key["price"] ?>
                đ
                 </span>
                <span class="text-line_thought">
                <?= ($key["is_on_sale"] == 1) ? $key["price_old"].'đ' : ""; ?>           
                
                </span>
        </div>
        <div class="button">
            <a id="btn_product" class="btn btn-default btn-add-cart" href="index.php?act=add_to_cart">Mua</a>
        </div>
        </div>
    </div>
    <?php }  ?>
    <?php }else{

        echo   ' <script>alert("không có kết quả tìm kiếm")
        window.location.href="index.php";
        </script>';
        exit();
    } ?>
   </div>
 