<?php $order_detail=$cart_controller->get_order_user();
 $count= count($order_detail);
 ?>
<div class="col-md-12">
<div class="payment-order clearfix">
        <h1>Lịch Sử Đơn hàng</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <?php
            $num=1;
         foreach ($order_detail as $key) {
        
            ?>
          <?php  if($key["is_on_order"] !=4){ ?>
                           
            <tbody>
                    <tr>
                        <td> <?= $num++ ?></td>
                        <td>
                            <span><?= 100000+$key["order_id"] ?></span>
                            <p class="note"></p>
                        </td>
                        <td><?= $key["user_name"] ?></td>
                        <td><?= number_format($key["total_money"], 0, ',', '.') . ' đ';  ?></td>
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
                        <td><a style="text-decoration: none;" href="index.php?act=order_details&id=<?=$key["order_id"]?>">Xem chi tiết</a></td>

                    </tr>
            </tbody>
            <?php } ?>
            <?php  } ?>
            <tfoot>
            </tfoot>
        </table>
    </div>
    <div class="clearfix col-md-12">
        <div class="button text-right">
            <a class="btnn btn-default" href="index.php">Tiếp tục mua hàng</a>
        </div>
    </div>
    </div>
    <style>
        .col-md-12{
            width: 868px;
            margin: 20px auto;
        }
        .text-right{
        text-align: right;
    }
    .btn-primary{
        width: 200px;
        color: #ffffff;
    text-decoration: none;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: none;
    background-color: #01c4c4;
    display: inline-block;
    padding: 7px 20px;
    margin-bottom: 0;
    font-size: 12px;
    text-transform: uppercase;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color: #ff0000;
    color: #ffffff;
}
    .btn-default {
        width: 200px;
    color: #ffffff;
    text-decoration: none;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: none;
    background-color: #01c4c4;
    display: inline-block;
    padding: 7px 20px;
    margin-bottom: 0;
    font-size: 12px;
    text-transform: uppercase;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    }
        .col-md-12{
            padding-left: 10px;
    padding-right: 10px;
        }
    @media print {
    body * {
        visibility: hidden;
    }
    
    .payment-order, .payment-order * {
        visibility: visible;
    }    
}
        .payment-order {
    position: relative;
    line-height: 30px;
    padding: 40px;
    margin-bottom: 15px;
    border: 1px solid #dddddd;
    margin: 40px auto;
    padding-left: 10px;
    padding-right: 10px;
}
.payment-order h3{
    margin-top: 20px;
}
.payment-order p{
    margin: 0 10px;
}
.payment-order h1{
   
    color: #373737;
    font-size: 19px;
    font-weight: bold;
    margin-bottom: 15px;
    margin-top: 0;
    text-transform: uppercase;

}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse;
    text-indent: initial;
    border-spacing: 2px;
    border-color: gray;
    display: table;
}
.payment-order table thead {
    background-color: #eaeaea;
    text-transform: uppercase;
    vertical-align: middle;
}
.text-right {
    text-align: right;
}
 .payment-order .label-payment {
    text-transform: uppercase;
}
 .payment-order .total-payment {
    color: #ff0000;
    font-size: 18px;
}
.table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}
.table>thead>tr>th {
    vertical-align: bottom;
    border-bottom: 2px solid #ddd;
}
.table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
    border-top: 0;
}
.table > thead > tr > th {
    vertical-align: middle;
}
.table > tfoot > tr > td{
    vertical-align: middle;
}
.table>tbody>tr>td{
    vertical-align: middle;
}
.table>tfoot>tr>td{
    padding: 2px 0px;
    line-height: 1.42857143;
}
.table>tbody>tr>td{
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;
}
 .payment-order .print-order a {
    color: #ffffff;
    background-color: #ff0000;
    line-height: 20px;
    padding: 5px;
    position: absolute;
    text-decoration: none;
    left: 0;
    top: 0;
}



    </style>
    <script>
        document.getElementById("print-order").addEventListener("click", function(){
    window.print();
});
  function update_status(id) {
if(confirm("Bạn có muốn hủy đơn hàng chưa giao")){
    window.location.href="index.php?act=update_status&id="+id +"&status=4";
}
  }
    </script>