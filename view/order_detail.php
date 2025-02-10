<?php $order_detail=$cart_controller->get_order_details();
 $count= count($order_detail);
 ?>
<div class="col-md-12">
<div class="payment-order clearfix">
        <h3>Mã đơn hàng của bạn: <b><?php $number_id=  100000+ $order_detail[$count-1]["order_id"];
        echo $number_id; ?></b></h3>
        <p><b>Ngày đặt:</b> <i><?= $order_detail[$count-1]["order_date"] ?></i></p>
        <p><b>Phương thức thanh toán:</b> <i>


        <?php
        if($order_detail[$count-1]["payment_method"] == 0){
            echo "Thanh toán online qua momo";
        }else if($order_detail[$count-1]["payment_method"] == 1){
           echo "Thanh toán khi giao hàng (COD)";
        }else if($order_detail[$count-1]["payment_method"] == 2){
            echo "Chuyển khoản qua ngân hàng";
        }else if($order_detail[$count-1]["payment_method"] == 3){
            echo "Thanh toán online qua cổng OnePay bằng thẻ Visa/Master/JCB";
        }
        
        
        
        ?>
        </i></p>
        <h1>Thông tin đơn hàng</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Sản phâm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <?php
            $num=1;
         foreach ($order_detail as $key) {
        
            ?>
            <tbody>
                    <tr>
                        <td> <?= $num++ ?></td>
                        <td>
                            <span><?php  if(!empty($key["product_name"])){

                                echo $key["product_name"];
                            }else{
                                echo "sản phẩm ko tồn tại";
                            } ?></span>
                            <p class="note"></p>
                        </td>
                        <td><?= number_format($key["price"], 0, ',', '.') . ' đ'; ?></td>
                        <td><?= $key["quantily"] ?></td>
                        <td><?= number_format($key["price"]*$key["quantily"], 0, ',', '.') . ' đ';  ?></td>
                    </tr>
            </tbody>
            <?php  } ?>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right label-payment"><b>Tổng thanh toán:</b></td>
                    <td class="total-payment"><?=number_format($key["total_money"], 0, ',', '.') . ' đ'; ?></td>
                </tr>
            </tfoot>
        </table>
        <span id="print-order" class="print-order"><a  href=""><i class="fa fa-print"></i>In đơn hàng</a></span>
    </div>
    <?php if ($order_detail[$count-1]["is_on_order"] == 5) { ?>
    <?php $ratingValue = $rating->get_rating($order_detail[$count-1]["order_id"]); ?>

    <?php if (!empty($ratingValue)) { ?>
        <?php for ($i = 0; $i < 5; $i++) { ?>
            <?php if ($i < $ratingValue["value"]) { ?>
                <span class="star_red">&#9733;</span>
            <?php } else { ?>
                <span class="gray_star">&#9734;</span>
            <?php } ?>
        <?php } ?>
    <?php } else { ?>
        <form action="index.php?act=rating_order&id=<?=$order_detail[$count-1]["order_id"]; ?>" method="post" class="clearfix col-md-12">
            <fieldset>
                <legend>Đánh giá:</legend>
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <input type="radio" name="rating" id="rating-<?=$i?>" value="<?=$i?>">
                    <label for="rating-<?=$i?>"><?=$i?> Star</label>
                <?php } ?>
            </fieldset>
            <input style="width:70px; margin: 10px 0px; border-radius:5px" type="submit" value="đánh giá">
        </form>
    <?php } ?>
<?php } ?>

    <div class="clearfix col-md-12">
        <div class="button text-right">
            <?php if(isset($_SESSION["user"])){ ?>
                <?php  if($order_detail[$count-1]["is_on_order"] !=5 && $order_detail[$count-1]["is_on_order"] !=3){ ?>
            <a class="btnn btn-default" href="javascript:delete_order_detail(<?= $order_detail[$count-1]["order_id"] ?>)">hủy đơn hàng</a>
            <?php } ?>
            <?php } ?>
            <a class="btnn btn-default" href="index.php">Tiếp tục mua hàng</a>
        </div>
    </div>
    </div>
    <style>
        .star_red{
            font-size: 48px;
            color: #227093;
        }
        .gray_star{
            font-size: 48px;
        }
        :root {
  --primary-color: #227093;
  --size: 48px;
}
fieldset {
  display: flex;
  align-items: center;
  border: 2px solid var(--primary-color);
  border-radius: 0.25rem;
}
legend {
  padding-inline: 0.5rem;
  color: var(--primary-color);
  border-bottom: 2px solid var(--primary-color);
}
/* Hide label */
label {
  width: 0;
  overflow: hidden;
}
/* You can style inputs directly thanks to appearance:none! */
.clearfix input {
  appearance: none;
  width: var(--size);
  height: var(--size);
  text-align: center;
  cursor: pointer;
  &::after {
    content: "☆";
    font-size: calc(var(--size) * 3 / 4);
    line-height: var(--size);
    color: var(--primary-color);
  }
  &:is(:checked, :hover)::after,
  &:has(~ input:is(:checked, :hover))::after {
    content: "★";
  }
  &:hover ~ input::after {
    content: "☆";
  }
}
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
    function delete_order_detail(id){
        if(confirm("Bạn có muốn hủy đơn hàng")){
        window.location.href="index.php?act=delete_order_detail&id="+id;
        }

    }
    </script>