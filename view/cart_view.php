<div class="step-clearfix">
    <div class="step z_index">
    <i class="fas fa-shopping-cart"></i>
        <span class="step-number">1</span>
        <span class="step-label">Giỏ hàng</span>
    </div>
    <div class="step z_index">
    <i class="fa-solid fa-dollar-sign"></i>
        <span class="step-number">2</span>
        <span class="step-label">Thanh toán</span>
    </div>
    <div class="step">
    <i class="fas fa-check"></i>
        <span class="step-number">3</span>
        <span class="step-label">Hoàn thành </span>
    </div>
</div>

<?php   
?>
<div class="modal-body">
      <div class="cart_text">
         <h2>GIỎ HÀNG CỦA TÔI</h2>
      </div>
                        <div class="cart-row">
                            <span class="cart-item cart-header cart-column">Sản Phẩm</span>
                            <span class="cart-price cart-header cart-column">Thành Tiền</span>
                            <span class="cart-quantity cart-header cart-column">Số Lượng</span>
                        </div>
                        <div class="cart-items">
                       <?php  $initialTotal = 0;
                       if(!empty($cartlist)) { ?>
                            <?php foreach($cartlist as $key){
                                $initialTotal += $key["price"] * $_SESSION["cart"][$key["product_id"]];
                                $intomoney= $key["price"] * $_SESSION["cart"][$key["product_id"]];
                                ?>
                            <div class="cart-row ">
                            <div class="cart-item cart-column">
                                <img class="cart-item-image" src="admin/<?= $key["avatar"] ?>" width="100" height="100">
                                <span data-productid="<?= $key["product_id"] ?>" class="cart-item-title"><?= $key["product_name"] ?></span>
                            </div>
                            <span data-value=<?= $key["price"] ?> class="cart-price cart-column"><?=  number_format($intomoney, 0, ',', '.');  ?> đ</span>
                            <div class="cart-quantity cart-column">
                                <input min="1" class="cart-quantity-input" name="quantily[<?=$key["product_id"] ?>]" type="number" value="<?= $_SESSION["cart"][$key["product_id"]]?>" >
                                <a href="index.php?act=delete_cart&id=<?=$key["product_id"] ?>" class="btn btn-danger" type="button">Xóa</a>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        <!-- <div class="cart-row">
                            <div class="cart-item cart-column">
                                <img class="cart-item-image" src="https://bizweb.dktcdn.net/thumb/large/100/228/168/products/sp1-a45a32a1-38d4-4a8a-9c37-e936013858b2.jpg?v=1575877003000" width="100" height="100">
                                <span class="cart-item-title">Máy Bơm Chìm Hộ Gia Đình QDX 1500W 220VAC 40L/1min H=8m</span>
                            </div>
                            <span class="cart-price cart-column">1599000đ</span>
                            <div class="cart-quantity cart-column">
                                <input class="cart-quantity-input" type="number" value="2">
                                <button class="btn btn-danger" type="button">Xóa</button>
                            </div>
                        </div> -->
                        <div class="cart-total">
                            <strong class="cart-total-title">Tổng Cộng:</strong>
                            <span class="cart-total-price"><?php echo number_format($initialTotal, 0, ',', '.') . ' đ';
                          ?></span>
                        </div>
                        <form action="index.php?act=checkout"  method="post" class="button text-right" id="checkout-form">
                    
                    <a class=" btn-default" href="index.php">Tiếp tục mua hàng</a>
                    <input type="hidden" id="total-amount" name="total_amount" value="<?= number_format($initialTotal, 0, ',', '.') ?>">
                     <button class="btn-primary" name="check_out" type="submit">Tiến hành thanh toán</button>
                            </form>
                    </div>
                    </div>

<style>
    /* Biểu tượng FontAwesome cho mỗi bước */
    .step i {
    font-size: 24px;
    color: #4CAF50;
    position: relative; /* Sử dụng position relative để có thể điều chỉnh vị trí con */
     /* Điều chỉnh vị trí theo ý muốn */
    overflow: hidden;
    right: 2px;
}

.z_index::before {
    content: "";
    position: absolute;
    top: 15px; /* Điều chỉnh độ cao của dấu gạch nối */
    left: calc(52% + 5px); /* Điều chỉnh vị trí của dấu gạch nối */
    height: 2px; /* Chiều cao của dấu gạch nối */
    width: calc(100%); /* Độ dài của dấu gạch nối */
    background-color: #4CAF50; /* Màu sắc của dấu gạch nối */
    z-index: -1;
}
.step-clearfix {
    overflow: hidden;
    margin-bottom: 20px;
    margin-top: 30px;
}

.step {
    float: left;
    width: 30%; /* Giảm chiều rộng của bước để tạo khoảng cách */
    position: relative;
    text-align: center;
    margin-right: 2%; /* Thêm khoảng cách giữa các bước */
}

.step-number {
    display: block;
    background-color: #4CAF50;
    color: #fff;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    line-height: 30px;
    margin: 2px auto 10px;
}

.step-label {
    display: block;
    font-size: 14px;
}

/* Hiệu ứng chọn bước */
.step.active .step-number,
.step.active .step-label {
    background-color: #007BFF;
    color: #fff;
}

.step.complete .step-number,
.step.complete .step-label {
    background-color: #28A745;
    color: #fff;
}

/* Hiệu ứng kết thúc */
.step:last-child .step-number,
.step:last-child .step-label {
    border-color: transparent;
}

.text-right {
    margin-top: 20px;
}

/* Thêm lớp mới để điều chỉnh khoảng cách chung */
.step-container {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

    .text-right{
        margin: 10px 0px;
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
    .cart_text{
        margin: 10px 0px;
    }
    .modal-body{
        margin: 40px 10px;
    }
    .cart-header {
  font-weight: bold;
  font-size: 1.25em;
  color: #333;
}

.cart-column {
  display: flex;
  align-items: center;
  border-bottom: 1px solid black;
  margin-right: 1.5em;
  padding-bottom: 10px;
  margin-top: 10px;
}

.cart-row {
  display: flex;
}

.cart-item {
  width: 45%;
}

.cart-price {
  width: 20%;
  font-size: 1.2em;
  color: #333;
}

.cart-quantity {
  width: 35%;
}

.cart-item-title {
  color: #333;
  margin-left: .5em;
  font-size: 1.2em;
}

.cart-item-image {
  width: 75px;
  height: auto;
  border-radius: 10px;
}

.btn-danger {
  color: white;
  background-color: #EB5757;
  border: none;
  border-radius: .3em;
  font-weight: bold;
}

.btn-danger:hover {
  background-color: #CC4C4C;
}

.cart-quantity-input {
  height: 34px;
  width: 50px;
  border-radius: 5px;
  border: 1px solid #56CCF2;
  background-color: #eee;
  color: #333;
  padding: 0;
  text-align: center;
  font-size: 1.2em;
  margin-right: 25px;
}

.cart-row:last-child {
  border-bottom: 1px solid black;
}

.cart-row:last-child .cart-column {
  border: none;
}

.cart-total {
  text-align: end;
  margin-top: 10px;
  margin-right: 10px;
}

.cart-total-title {
  font-weight: bold;
  font-size: 1.5em;
  color: black;
  margin-right: 20px;
}

.cart-total-price {
  color: #333;
  font-size: 1.1em;
}

</style>

<script>
    $(document).on("change", ".cart-quantity-input", function () {
        updateTotalAmount();
        updateCartTotal();
        sendUpdateRequest($(this));
        var number = $(this).val();
        var price = $(this).closest(".cart-row").find(".cart-price").data("value");

        if ($.isNumeric(number)) {
            var totalMoney = parseFloat(number) * parseFloat(price);
            var format = formatCurrency(totalMoney);
            $(this).closest(".cart-row").find(".cart-price").text(format);
        }
    });
    function sendUpdateRequest(element) {
        var productId = element.closest(".cart-row").find(".cart-item-title").data("productid");
        var quantity = element.val();

        $.ajax({
            url: "index.php?act=update_cart", 
            type: "POST",
            data: { productId: productId, quantity: quantity },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log("Error: " + error);
            }
        });
    }
    function updateTotalAmount() {
        var totalAmount = 0;
        $(".cart-row").each(function () {
            var price = parseFloat($(this).find(".cart-price").data("value"));
            var quantity = parseFloat($(this).find(".cart-quantity-input").val());
            if ($.isNumeric(price) && $.isNumeric(quantity)) {
                totalAmount += price * quantity;
            }
        });

        if ($.isNumeric(totalAmount)) {
            var formatTotalAmount = formatCurrency(totalAmount);
            $("#total-amount").val(formatTotalAmount);
        } else {
            $("#total-amount").val("");
        }
    }

    function updateCartTotal() {
        var cartRows = $(".cart-row");
        var total = 0;

        cartRows.each(function () {
            var priceElement = $(this).find(".cart-price");
            var quantityElement = $(this).find(".cart-quantity-input");

            var price = parseFloat(priceElement.data("value"));
            var quantity = parseFloat(quantityElement.val());

            if ($.isNumeric(price) && $.isNumeric(quantity)) {
                total += price * quantity;
            }
        });

        if ($.isNumeric(total)) {
            var formatTotal = formatCurrency(total);
            $(".cart-total-price").text(formatTotal);
            $.ajax({
            url: "index.php?act=checkout", // Đặt tên file hoặc URL xử lý yêu cầu AJAX
            type: "POST",
            data: { total: formatTotal },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log("Error: " + error);
            }
        });
        } else {
            $(".cart-total-price").text("");
        }
    }
    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
    }

</script>