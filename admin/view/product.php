<main role="main">
<div class="box_search">
    <form action="index.php?act=search_product" method="post" class="flex_1">
    <input type="text" name="product_name" placeholder="tìm kiếm theo tên">
    <input type="text" name="product_id" placeholder="tìm kiếm theo id">
    <button type="submit" >Gửi</button>
    </form>
    </div>
    <div class="flex2">
        <a href="index.php?act=add_product">Thêm</a>
    </div>
    </div>
      <?php 
      if(isset($_GET["page"]) && $_GET["per_page"]){
        $page = $_GET["page"];
        $per_page = $_GET["per_page"];
     }else{
        $page = 1;
        $per_page = 6;
     }
     $offset= ($page-1) * $per_page;
     $where =!empty($_GET["where"]) ? $_GET["where"] : "";
     $searchParams = http_build_query(['where' => $where]);
     if(!empty($where)){
        $sql_search_product="SELECT * FROM `products`WHERE $where limit $per_page offset $offset";
        $list_product_admin=pdo_query($sql_search_product);
        $row_where= "SELECT * FROM `products`WHERE $where";
        $numrow=count(pdo_query($row_where));
        $total_page=ceil($numrow / $per_page);
     }else{
        $list_product_admin = $productscontrol->showProducts($offset,$per_page);
        $numrow=$productscontrol->row();
        $total_page=ceil($numrow / $per_page);
     }
     ?>
     <div class="col-md-12">
<div class="payment-order clearfix">
        <h1>Quản lý sản phẩm</h1>
        <table class="table">
            <thead>
            <tr>
            <td>id</td>
            <td>Tên Sản Phẩm</td>
            <td>Giá</td>
            <td>ảnh</td>
            <td>Sửa</td>
            <td>Xóa</td>
        </tr>
            </thead>  
            <?php
            
            foreach ($list_product_admin as $key) {    ?>
            <tbody>

            <td><?= $key["product_id"] ?></td>
            <td><?= $key["product_name"]   ?></td>
            <td>
            <?=number_format($key["price"], 0, ',', '.')   ?> đ
            </td>
            <td>
            <?php
    $avatarPath = $key["avatar"];
    if (file_exists($avatarPath)) {
        echo '<img  src="' . $avatarPath . '"
        style="
    width: 100px;
    height: 100px;
" alt="">';
    } else {
        echo '<p>Sản phẩm không có ảnh</p>';
    }

    ?>
            </td>
            <td><a href="index.php?act=upadate_product&id=<?=$key["product_id"]?>">Sửa</a></td>
            <td><a href="javascript:corfirm_delete(<?= $key["product_id"] ?>)">Xóa</a></td>

        </tr>
            </tbody>
            <?php   } ?>
            <tfoot>
            </tfoot>
        </table>

    </div>
    </div>
      
  
    
    <div class="pagination">
    <?php if($page>2){ ?>
        <a href="index.php?act=product&<?= $searchParams ?>&page=<?php echo 1?>&per_page=6" class="page-item">Trang đầu</a>

        <?php     }?>
    <?php for($i=1;$i<=$total_page;$i++){  ?>
        <?php if($i!=$page){ ?>
        <?php  if($i>=$page-2&&$i<=$page+2){ ?>
        <a href="index.php?act=product&<?= $searchParams ?>&page=<?php echo $i?>&per_page=6" class="page-item"> <?= $i ?></a>
        <?php     }?>
        <?php }else{?>
            <strong style="background-color: black;" class="page-item"><?= $page?></strong>
            
   <?php     }?>
        <?php } ?>
        <?php if($page<$total_page){ ?>
        <a href="index.php?act=product&<?= $searchParams ?>&page=<?php echo $total_page?>&per_page=6" class="page-item">Trang cuối</a>

        <?php     }?>
    </div>
  
</main>
<script>
    function corfirm_delete(id){
        if (confirm("Bạn có muốn xóa sản phẩm")) {
            window.location.href="index.php?act=delete_product&id="+id;
        }


    }
</script>
<style>
       .box_search{
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: space-around;
    }
    .flex_1{
        display: inline-flex;
        float: left;
    }
    .flex_1 input{
        margin: 0 5px;
    }
    .flex2 a{
        background-color: #ccc;
        display:  inline-block;
        text-decoration: none;
        color: white;
        padding: 10px;
    }
    .flex2 {
        float: right;
        margin: 0 130px;
    }
</style>
