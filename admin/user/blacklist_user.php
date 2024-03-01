<main role="main">

<div class="box_search">
    <div class="flex_1">
    </div>
    <div class="flex2">
        <a href="index.php?act=user_admin">Danh sách người dùng</a>
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
     $numrow=$userController->user_row_list_black();
     $total_page=ceil($numrow / $per_page);
     $list_user_admin= $userController->show_user_black_list($offset,$per_page);
     ?>
     <table>
        <tr>
            <td>id</td>
            <td>Tên đăng nhập</td>
            <td>email</td>
            <td>địa chỉ</td>
            <td>Ngày sinh</td>
            <td>Trạng thái</td>
            <td>Khôi phục</td>
        </tr>
        <?php foreach ($list_user_admin as $key){ ?>
        <tr>
            <td><?= $key["user_id"]   ?></td>
            <td>
            <?= $key["user_name"]   ?>
            </td>
            <td>
            <?= $key["email"]   ?>
            </td>
            <td>
            <?= $key["address"]   ?>
            </td>
            <td>
                <?= $key["birth_day"] ?>
            </td>
            <td>ẩn</td>

            <td><a href="javascript:corfirm_delete(<?= $key["user_id"] ?>)">khôi phục</a></td>
        </tr>
      <?php   } ?>
    </table>
    <div class="pagination">
    <?php if($page>2){ ?>
        <a href="index.php?act=black_list_user&page=<?php echo 1?>&per_page=6" class="page-item">Trang đầu</a>

        <?php     }?>
    <?php for($i=1;$i<=$total_page;$i++){  ?>
        <?php if($i!=$page){ ?>
        <?php  if($i>=$page-2&&$i<=$page+2){ ?>
        <a href="index.php?act=black_list_user&page=<?php echo $i?>&per_page=6" class="page-item"> <?= $i ?></a>
        <?php     }?>
        <?php }else{?>
            <strong style="background-color: black;" class="page-item"><?= $page?></strong>
            
   <?php     }?>
        <?php } ?>
        <?php if($page<$total_page){ ?>
        <a href="index.php?act=black_list_user&page=<?php echo $total_page?>&per_page=6" class="page-item">Trang cuối</a>

        <?php     }?>
    </div>
  
</main>
<script>
    function corfirm_delete(id){
        if (confirm("Bạn có muốn khôi phục người dùng")) {
            window.location.href="index.php?act=restore&id="+id;
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
       display: flex;
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