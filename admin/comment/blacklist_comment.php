<main role="main">

<div class="box_search">
    <div class="flex_1">
    </div>
    <div class="flex2">
        <a href="index.php?act=black_list_comment">Danh sách đen</a>
    </div>
    <div class="flex2">
        <a href="index.php?act=commment_view">Quản lý bình luận</a>
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
     $numrow=$commentcontroller->getComment_ad(0);
     $total_page=ceil($numrow / $per_page);
     $list_comment_admin= $commentcontroller->show_comment($offset,$per_page,0);
     ?>
     <table>
        <tr>
            <td>id</td>
            <td>Nội dung</td>
            <td>Người dùng</td>
            <td>Sản phẩm</td>
            <td>Ngày bình luận</td>
            <td></td>
        </tr>
        <?php foreach ($list_comment_admin as $key){ ?>
        <tr>
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
            <td><a href="javascript:corfirm_delete(<?= $key["comment_id"] ?>)">khôi phục</a></td>
        </tr>
      <?php   } ?>
    </table>
    
        
        <div class="pagination">
    <?php if($page>2){ ?>
        <a href="index.php?act=black_list_comment&page=<?php echo 1?>&per_page=6" class="page-item">Trang đầu</a>

        <?php     }?>
    <?php for($i=1;$i<=$total_page;$i++){  ?>
        <?php if($i!=$page){ ?>
        <?php  if($i>=$page-2&&$i<=$page+2){ ?>
        <a href="index.php?act=black_list_comment&page=<?php echo $i?>&per_page=6" class="page-item"> <?= $i ?></a>
        <?php     }?>
        <?php }else{?>
            <strong style="background-color: black;" class="page-item"><?= $page?></strong>
            
   <?php     }?>
        <?php } ?>
        <?php if($page<$total_page){ ?>
        <a href="index.php?act=black_list_comment&page=<?php echo $total_page?>&per_page=6" class="page-item">Trang cuối</a>

        <?php     }?>
    </div>
</main>
<script>
    function corfirm_delete(id){
        if (confirm("Bạn có muốn khôi phục bình luận")) {
            window.location.href="index.php?act=restore_comment&id="+id;
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
       flex :1;
       margin: 0 120px;
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