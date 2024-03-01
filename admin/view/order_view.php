

<main role="main">
<?php   
if(isset($_GET["page"]) && $_GET["per_page"]){
    $page = $_GET["page"];
    $per_page = $_GET["per_page"];
 }else{
    $page = 1;
    $per_page = 6;
 }
  $offset= ($page-1) * $per_page;
  $list_card_admin= $cart_controller->get_orders_user_admin($offset,$per_page);
  $numrow=$cart_controller->row_cat();
  $total_page=ceil($numrow / $per_page);
 ?>
<div class="col-md-12">
<div class="payment-order clearfix">
        <h1>Thông tin Đơn hàng</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <td>Vị trí</td>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>  
            <?php
            $num=0;
            
            foreach ($list_card_admin as $key) {    ?>
            <tbody>
              
                
                    
                
              
                    <tr>
                        <td>
                            <span>
                                <?= 100000 +$key["order_id"] ?>
                            </span>
                            <p class="note"></p>
                        </td>
                        <td>
                            <?php if(($key["user_id"])==0){
                                  echo $key["name"];
                            }else{
                                echo $key["user_name"];
                            } ?>
                        </td>
                        <td>

                          <?= $key["address_shipping"] ?>
                        </td>
                        <td>
                            <?= number_format($key["total_money"] , 0, ',', '.') . ' đ';?>
                        </td>
                        <td><?php  
                        if($key["is_on_order"] ==0){
                            echo "chưa vận chuyển";
                        }else if($key["is_on_order"] ==1){
                            echo "chưa xử lý";
                        }else if($key["is_on_order"] ==2){
                            echo "đang xử lý";

                        }else if($key["is_on_order"] ==3){
                            echo "đang giao hàng";
                        }else if($key["is_on_order"] ==4){
                            echo "hủy đơn hàng";
                        }else if($key["is_on_order"] ==5){
                            echo "đã giao hàng";
                        }
                        ?></td>
                        <td><a href="index.php?act=update_order&id=<?=$key["order_id"]?>">Cập nhật</a></td>
                    </tr>

            </tbody>
         <?php } ?>
            <tfoot>
            </tfoot>
        </table>
    </div>
    <div class="clearfix col-md-12">
    </div>
    </div>
    <div class="pagination">
    <?php if($page>2){ ?>
        <a href="index.php?act=order&page=<?php echo 1?>&per_page=6" class="page-item">Trang đầu</a>

        <?php     }?>
    <?php for($i=1;$i<=$total_page;$i++){  ?>
        <?php if($i!=$page){ ?>
        <?php  if($i>=$page-2&&$i<=$page+2){ ?>
        <a href="index.php?act=order&page=<?php echo $i?>&per_page=6" class="page-item"> <?= $i ?></a>
        <?php     }?>
        <?php }else{?>
            <strong style="background-color: black;" class="page-item"><?= $page?></strong>
            
   <?php     }?>
        <?php } ?>
        <?php if($page<$total_page){ ?>
        <a href="index.php?act=order&page=<?php echo $total_page?>&per_page=6" class="page-item">Trang cuối</a>

        <?php     }?>
    </div>
        </main>
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
    <script>
        document.getElementById("print-order").addEventListener("click", function(){
    window.print();
});

    </script>