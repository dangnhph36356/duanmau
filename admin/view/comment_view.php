<main role="main">

<div class="box_search">
    <form method="post" action="index.php?act=search_comment" class="flex_1">
    <input type="text" name="content"  placeholder="tìm kiếm theo nội dung">
    <input type="text" name="comment_id" placeholder="tìm kiếm theo id">
    <button type="submit">gửi</button>
</form>
    <div class="flex2">
        <a href="index.php?act=black_list_comment">Danh sách đen</a>
    </div>
    <div class="flex2">
        <a href="index.php?act=user_admin">Quản lý người dùng</a>
    </div>
    </div>
      <?php if(isset($_GET["page"]) && $_GET["per_page"]){
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
        $sql_search_comment="SELECT comments.comment_id, comments.user_id, comments.product_id, comments.content,products.product_name, comments.comment_date,users.user_name 
        FROM comments 
        JOIN users ON comments.user_id = users.user_id  
        Join products ON comments.product_id = products.product_id
        WHERE $where AND comments.is_deleted=1 
        ORDER BY `comment_id` DESC LIMIT $per_page OFFSET $offset";
        $list_comment_admin=pdo_query($sql_search_comment);
        $row_where= "SELECT * FROM `comments` JOIN users ON comments.user_id = users.user_id
        JOIN products ON comments.product_id = products.product_id WHERE $where AND comments.is_deleted=1";
        $numrow=count(pdo_query($row_where));
        $total_page=ceil($numrow / $per_page);
     }else{
        $numrow=$commentcontroller->getComment_ad(1);
        $total_page=ceil($numrow / $per_page);
        $list_comment_admin= $commentcontroller->show_comment($offset,$per_page,1);
     }
     ?>
     <div class="col-md-12">
<div class="payment-order clearfix">
        <h1>Danh sách bình luận</h1>
        <table class="table">
            <thead>
                <tr>
                <td>id</td>
                <td>Nội dung</td>
                <td>Người dùng</td>
               <td>Sản phẩm</td>
            <td>Ngày bình luận</td>
            <td>ẩn</td>
                </tr>
            </thead>  
            <?php
            
            foreach ($list_comment_admin as $key) {    ?>
            <tbody>
              
                
                    
                
              
            <td><?= $key["comment_id"]   ?></td>
            <td>
            <?= $key["content"]   ?>
            </td>
            <td>
            <?= $key["user_name"]   ?>
            </td>
            <td>
            <?=   $key["product_name"]   ?>
            </td>
            <td>
            <?= $key["comment_date"]   ?>
            </td>
            <td><a href="javascript:corfirm_delete(<?= $key["comment_id"] ?>)">ẩn</a></td>

            </tbody>
         <?php } ?>
            <tfoot>
            </tfoot>
        </table>
    </div>
    </div> 
    <div class="pagination">
    <?php if($page>2){ ?>
        <a href="index.php?act=commment_view&<?= $searchParams ?>&page=<?php echo 1?>&per_page=6" class="page-item">Trang đầu</a>

        <?php     }?>
    <?php for($i=1;$i<=$total_page;$i++){  ?>
        <?php if($i!=$page){ ?>
        <?php  if($i>=$page-2&&$i<=$page+2){ ?>
        <a href="index.php?act=commment_view&<?= $searchParams ?>&page=<?php echo $i?>&per_page=6" class="page-item"> <?= $i ?></a>
        <?php     }?>
        <?php }else{?>
            <strong style="background-color: black;" class="page-item"><?= $page?></strong>
            
   <?php     }?>
        <?php } ?>
        <?php if($page<$total_page){ ?>
        <a href="index.php?act=commment_view&<?= $searchParams ?>&page=<?php echo $total_page?>&per_page=6" class="page-item">Trang cuối</a>

        <?php     }?>
    </div>
</main>
<script>
    function corfirm_delete(id){
        if (confirm("Bạn có muốn ẩn bình luận")) {
            window.location.href="index.php?act=delete_comment&id="+id;
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