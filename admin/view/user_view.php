<main role="main">

<div class="box_search">
    <form action="index.php?act=search_user" method="post" class="flex_1">
    <input type="text" name="user_name"  placeholder="tìm kiếm theo tên">
    <input type="text" name="user_id" placeholder="tìm kiếm theo id">
    <button type="submit"  >Gửi</button>
    </form>
    <div class="flex2">
        <a href="index.php?act=black_list_user">Danh sách đen</a>
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
     $where =!empty($_GET["where"]) ? $_GET["where"] : "";
     $searchParams = http_build_query(['where' => $where]);
     if(!empty($where)){
        $sql_search_user="SELECT * FROM `users` WHERE $where AND is_deleted=1 limit $per_page offset $offset";
        $list_user_admin=pdo_query($sql_search_user);
        $row_where= "SELECT * FROM `users` WHERE $where AND is_deleted=1";
        $numrow=count(pdo_query($row_where));
        $total_page=ceil($numrow / $per_page);
     }else{
        $numrow=$userController->user_row_list();
        $total_page=ceil($numrow / $per_page);
        $list_user_admin= $userController->show_user($offset,$per_page);
     }
     ?>
     <div class="col-md-12">
<div class="payment-order clearfix">
        <h1>Danh sách người dùng</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Tên đăng nhập</th>
                    <th>email</th>
                    <th>địa chỉ</th>
                    <th>Vai trò</th>
                    <th>Ngày sinh</th>
                    <th>
                    phân quyền
                    </th>
                    <th>
                    ẩn
                    </th>
                </tr>
            </thead>  
            <?php
            $num=0;
            
            foreach ($list_user_admin as $key) {    ?>
            <tbody>
              
                
                    
                
              
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
            <?php if(($key["role_id"])==0){
                    echo "Người dùng";
                    $status=1;
            
            }elseif($key["role_id"]==1) {
                echo "Quản trị";
                $status=0;
            }  ?>
            </td>
            <td>
                <?= $key["birth_day"] ?>
            </td>
            <td>
                <a href="javascript:set_admin(<?=$key["user_id"]?>,<?= $status ?>)">phân quyền</a>
            </td>
            <td><a href="javascript:corfirm_delete(<?= $key["user_id"] ?>)">ẩn</a></td>

            </tbody>
         <?php } ?>
            <tfoot>
            </tfoot>
        </table>
    </div>
    </div>
    <div class="pagination">
    <?php if($page>2){ ?>
        <a href="index.php?act=user_admin&<?= $searchParams?>&page=<?php echo 1?>&per_page=6" class="page-item">Trang đầu</a>

        <?php     }?>
    <?php for($i=1;$i<=$total_page;$i++){  ?>
        <?php if($i!=$page){ ?>
        <?php  if($i>=$page-2&&$i<=$page+2){ ?>
        <a href="index.php?act=user_admin&<?= $searchParams?>&page=<?php echo $i?>&per_page=6" class="page-item"> <?= $i ?></a>
        <?php     }?>
        <?php }else{?>
            <strong style="background-color: black;" class="page-item"><?= $page?></strong>
            
   <?php     }?>
        <?php } ?>
        <?php if($page<$total_page){ ?>
        <a href="index.php?act=user_admin&<?= $searchParams?>&page=<?php echo $total_page?>&per_page=6" class="page-item">Trang cuối</a>

        <?php     }?>
    </div>
    
  
</main>
<script>
    function corfirm_delete(id){
        if (confirm("Bạn có muốn ẩn người dùng")) {
            window.location.href="index.php?act=delete_user&id="+id;
        }
    }
   function set_admin(id,status){
    if(confirm("phân quyền lại cho người dùng")){
     window.location.href='index.php?act=set_admin&id='+id+"&status="+status;
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