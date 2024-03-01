<main role="main">
<div class="container-form-add">
    <?php   $update_id= isset($_GET["id"]) ? $_GET["id"] :  "";  
           $list_product_admin =$productscontrol->products_list_of_admin($update_id);
           $list_galery=$productscontrol->list_galery($update_id);
    ?>
        <form  action="index.php?act=product_form_edit&id=<?= $update_id ?>" id="productForm"  method="post" enctype="multipart/form-data">
            <h2>Sửa sản phẩm</h2>           
            <input type="text" id="productName" name="productName" placeholder="Nhập tên sản phẩm" value="<?=$list_product_admin["product_name"] ?>">
            <input type="text" name="price" placeholder="Giá" value="<?=$list_product_admin["price"] ?> ">
            <textarea id="productDescription" name="productDescription" placeholder="Mô tả" rows="4"><?=htmlspecialchars($list_product_admin["descritipion"], ENT_QUOTES, 'UTF-8')?></textarea>
            <label for="">Giảm giá sản phẩm</label>
            <select name="sale_select" id="saleSelect">
            <option  value="0">Không</option>
                <option
                
                <?php if($list_product_admin["is_on_sale"]==1){
                    echo "selected";
                    }?>
                value="1">Có</option>
            </select>
            <div id="salePriceContainer" style="display: none;">
                <input type="text" placeholder="Giá sale" name="sale_price" id="salePrice"  value="<?php
                if($list_product_admin["is_on_sale"]==1){
                    echo $list_product_admin["price_old"];
                    }
                ?>">
            </div>
            <label for="">Ảnh đại diện</label>
            <div class="wrapper_image_left">
                <?php  if (file_exists($list_product_admin["avatar"])) { ?>
                
                 <img src="<?=$list_product_admin["avatar"]  ?>" alt="">
                
             <?php   }else{
                echo "sp ko có ảnh";
             }
             
             
             ?>
            </div>
            <input type="hidden" name="curent_image" value="<?=$list_product_admin["avatar"]  ?>">
            <input type="file" name="image" accept="image/*" >
            <label for=""> ảnh liên quan</label>
            <div class="wrapper_image_right">
                
               <?php foreach ($list_galery as $key) {
             ?>
             <div class="img_link">
               <?php if (file_exists($key["image_url"])) { ?>
                <img src="<?=$key["image_url"]?>" alt="">
                <a href="index.php?act=delete_galery&id=<?=$key["galery_id"]?>&product_id=<?=$update_id ?>">xóa</a>
                <?php }else{
                      echo "sp ko có ảnh";
                } ?>             
                </div>
          <?php    }?>
            </div>
            <input type="file" name="files[]" accept="image/*" multiple>
            <label for="">Hãng sản xuất</label>
            <select name="category_id" id="">
            <?php $cat_tree = $cat->list_categories();
            if(!empty($cat_tree)){
            $cat->show_cat_select_box($cat_tree,0);
            }
            ?>
            </select>
            <input type="submit">
        </form>
    </div>
    
</main>
    <style>
.container-form-add {
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
    max-width: 400px;
    margin: 0 auto;
}

h2 {
    text-align: center;
    color: #3498db;
}
.img_link{
   position: relative;
}
.wrapper_image_right{
    display: flex;
}
.wrapper_image_right img{
    width: 100px;
    height: 100px;
}
.wrapper_image_right a{
    display: inline-block;
    background-color: #fff;
    box-shadow: inset;
    padding: 5px;
    text-align: center;
    bottom: 0;
    left: 0;
    position: absolute;
    text-decoration: none;
}
label {
    margin-top: 10px;
    font-size: 14px;
    color: #333;
}
.wrapper_image_left img{
    width: 150px;
    height: 150px;
}
            
input, textarea {
    padding: 10px;
    margin: 5px 0 15px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #3498db;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #217dbb;
}

    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Lắng nghe sự kiện thay đổi giá trị của select
            document.getElementById("saleSelect").addEventListener("change", function () {
                // Hiển thị hoặc ẩn input Giá Sale tùy thuộc vào giá trị của select
                var salePriceContainer = document.getElementById("salePriceContainer");
                var salePriceInput = document.getElementById("salePrice");

                if (this.value == 0) {
                    salePriceContainer.style.display = "none";
                    salePriceInput.required = false;
                } else {
                    salePriceContainer.style.display = "block";
                    salePriceInput.required = true; 
                }
            });
            document.getElementById("saleSelect").dispatchEvent(new Event("change"));
        });
    </script>