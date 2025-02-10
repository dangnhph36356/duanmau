<form action="index.php?act=ordercheck"  method="POST" class="payment-block clearfix ng-invalid ng-invalid-required ng-valid-email ng-dirty ng-valid-parse" id="checkout-container" ng-submit="checkout()">
    <?php if(!isset($_SESSION["user"])){ ?>
        <div class="col-md-4 col-sm-12 col-xs-12 payment-step step2">
            <h4>1. Địa chỉ thanh toán và giao hàng</h4>
            <div class="step-preview clearfix">
                <h2 class="title">Thông tin thanh toán</h2>
                <!-- ngIf: CustomerId>0 -->
                <!-- ngIf: CustomerId<=0 --><div class="form-block ng-scope" ng-if="CustomerId<=0">
                    <div class="user-login"><a href="/dang-ky.html">Đăng ký tài khoản mua hàng</a><a href="/dang-nhap.html">Đăng nhập</a></div>
                    <label>Mua hàng không cần tài khoản</label>
                    <div class="form-group"><input class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" name="name" placeholder="Họ &amp; Tên" type="text" ng-model="$parent.CustomerName" required=""></div>
                    <div class="form-group"><input class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" name="phone" placeholder="Số điện thoại" type="text" ng-model="$parent.CustomerPhone" required=""></div>
                    <div class="form-group"><input class="form-control ng-pristine ng-valid-email ng-invalid ng-invalid-required ng-touched" name="email" placeholder="Email" type="email" ng-model="$parent.CustomerEmail" required=""></div>
                    <div class="form-group"><input class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" name="address" placeholder="Địa chỉ" type="text" ng-model="$parent.CustomerAddress" required=""></div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                    </div>
                    <textarea name="area" class="form-control ng-pristine ng-untouched ng-valid" rows="4" placeholder="Ghi chú đơn hàng" ng-model="$parent.Description"></textarea>
                </div><!-- end ngIf: CustomerId<=0 -->
                <h2 class="title">Thông tin giao hàng</h2>
                <!-- <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="IsOtherAddress" ng-change="changeAddress()" class="ng-valid ng-dirty ng-valid-parse ng-touched"> Giao hàng địa chỉ khác
                    </label>
                </div>
                <div class="form-block ng-hide" ng-show="IsOtherAddress==true">
                    <div class="form-group"><input class="form-control ng-pristine ng-untouched ng-valid" placeholder="Họ &amp; Tên" type="text" ng-model="DeliveryName"></div>
                    <div class="form-group"><input class="form-control ng-pristine ng-untouched ng-valid" placeholder="Số điện thoại" type="text" ng-model="DeliveryPhone"></div>
                    <div class="form-group"><input class="form-control ng-pristine ng-untouched ng-valid" placeholder="Email" type="text" ng-model="DeliveryEmail"></div>
                    <div class="form-group"><input class="form-control ng-pristine ng-untouched ng-valid" placeholder="Địa chỉ" type="text" ng-model="DeliveryAddress"></div>
                    <div class="form-group">
                        <select class="form-control ng-pristine ng-untouched ng-valid" ng-model="DeliveryProvinceId" ng-options="item.Id as item.Name for item in ProvinceDeliverys" ng-change="changeDeliveryProvince()"><option selected="selected"></option><option value="number:0" label="Vui lòng chọn tỉnh/thành phố">Vui lòng chọn tỉnh/thành phố</option><option value="number:1" label="Hồ Chí Minh">Hồ Chí Minh</option><option value="number:2" label="Hà Nội">Hà Nội</option><option value="number:3" label="Đà Nẵng">Đà Nẵng</option><option value="number:4" label="Cần Thơ">Cần Thơ</option><option value="number:5" label=" Thừa Thiên - Huế"> Thừa Thiên - Huế</option><option value="number:6" label="An Giang">An Giang</option><option value="number:7" label="Bà Rịa-Vũng Tàu">Bà Rịa-Vũng Tàu</option><option value="number:8" label="Bạc Liêu">Bạc Liêu</option><option value="number:9" label="Bắc Kạn">Bắc Kạn</option><option value="number:10" label="Bắc Giang">Bắc Giang</option><option value="number:11" label="Bắc Ninh">Bắc Ninh</option><option value="number:12" label="Bến Tre">Bến Tre</option><option value="number:13" label="Bình Dương">Bình Dương</option><option value="number:14" label="Bình Định">Bình Định</option><option value="number:15" label="Bình Phước">Bình Phước</option><option value="number:16" label="Bình Thuận">Bình Thuận</option><option value="number:17" label="Cà Mau">Cà Mau</option><option value="number:18" label="Cao Bằng">Cao Bằng</option><option value="number:19" label="Đắk Lắk">Đắk Lắk</option><option value="number:20" label="Đắk Nông">Đắk Nông</option><option value="number:21" label="Điện Biên">Điện Biên</option><option value="number:22" label="Đồng Nai">Đồng Nai</option><option value="number:23" label="Đồng Tháp">Đồng Tháp</option><option value="number:24" label="Gia Lai">Gia Lai</option><option value="number:25" label="Hà Giang">Hà Giang</option><option value="number:26" label="Hà Nam">Hà Nam</option><option value="number:27" label="Hà Tây">Hà Tây</option><option value="number:28" label="Hà Tĩnh">Hà Tĩnh</option><option value="number:29" label="Hải Dương">Hải Dương</option><option value="number:30" label="Hải Phòng">Hải Phòng</option><option value="number:31" label="Hòa Bình">Hòa Bình</option><option value="number:32" label="Hậu Giang">Hậu Giang</option><option value="number:33" label="Hưng Yên">Hưng Yên</option><option value="number:34" label="Khánh Hòa">Khánh Hòa</option><option value="number:35" label="Kiên Giang">Kiên Giang</option><option value="number:36" label="Kon Tum">Kon Tum</option><option value="number:37" label="Lai Châu">Lai Châu</option><option value="number:38" label="Lào Cai">Lào Cai</option><option value="number:39" label="Lạng Sơn">Lạng Sơn</option><option value="number:40" label="Lâm Đồng">Lâm Đồng</option><option value="number:41" label="Long An">Long An</option><option value="number:42" label="Nam Định">Nam Định</option><option value="number:43" label="Nghệ An">Nghệ An</option><option value="number:44" label="Ninh Bình">Ninh Bình</option><option value="number:45" label="Ninh Thuận">Ninh Thuận</option><option value="number:46" label="Phú Thọ">Phú Thọ</option><option value="number:47" label="Phú Yên">Phú Yên</option><option value="number:48" label="Quảng Bình">Quảng Bình</option><option value="number:49" label="Quảng Nam">Quảng Nam</option><option value="number:50" label="Quảng Ngãi">Quảng Ngãi</option><option value="number:51" label="Quảng Ninh">Quảng Ninh</option><option value="number:52" label="Quảng Trị">Quảng Trị</option><option value="number:53" label="Sóc Trăng">Sóc Trăng</option><option value="number:54" label="Sơn La">Sơn La</option><option value="number:55" label="Tây Ninh">Tây Ninh</option><option value="number:56" label="Thái Bình">Thái Bình</option><option value="number:57" label="Thái Nguyên">Thái Nguyên</option><option value="number:58" label="Thanh Hóa">Thanh Hóa</option><option value="number:59" label="Thừa Thiên - Huế">Thừa Thiên - Huế</option><option value="number:60" label="Tiền Giang">Tiền Giang</option><option value="number:61" label="Trà Vinh">Trà Vinh</option><option value="number:62" label="Tuyên Quang">Tuyên Quang</option><option value="number:63" label="Vĩnh Long">Vĩnh Long</option><option value="number:64" label="Vĩnh Phúc">Vĩnh Phúc</option><option value="number:65" label="Yên Bái">Yên Bái</option></select>
                    </div>
                    <div class="form-group">
                        <select class="form-control ng-pristine ng-untouched ng-valid" ng-model="DeliveryDistrictId" ng-options="item.Id as item.Name for item in DistrictDeliverys" ng-change="changeDeliveryDistrict()"><option selected="selected"></option></select>
                    </div>
                </div> -->
            </div>
        </div>
        <?php }else{ ?>
            <div class="col-md-4 col-sm-12 col-xs-12 payment-step step2">
            <h4>1. Địa chỉ thanh toán và giao hàng</h4>
            <div class="step-preview clearfix">
                <h2 class="title">Thông tin thanh toán</h2>
                <!-- ngIf: CustomerId>0 -->
                <!-- ngIf: CustomerId<=0 --><div class="form-block ng-scope" ng-if="CustomerId<=0">
                    <div class="user-login"><a href="/dang-ky.html"><?=$_SESSION["user"]["user_name"] ?></a><a href="/dang-nhap.html"></a></div>
                    <div class="form-group"><input class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" name="phone" placeholder="Số điện thoại" type="text" ng-model="$parent.CustomerPhone" required=""></div>
                    <div class="form-group"><input class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" name="address" placeholder="Địa chỉ" type="text" ng-model="$parent.CustomerAddress" required=""></div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                    </div>
                    <textarea name="area" class="form-control ng-pristine ng-untouched ng-valid" rows="4" placeholder="Ghi chú đơn hàng" ng-model="$parent.Description"></textarea>
                </div><!-- end ngIf: CustomerId<=0 -->
                <h2 class="title">Thông tin giao hàng</h2>
                <!-- <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="IsOtherAddress" ng-change="changeAddress()" class="ng-valid ng-dirty ng-valid-parse ng-touched"> Giao hàng địa chỉ khác
                    </label>
                </div>
                <div class="form-block ng-hide" ng-show="IsOtherAddress==true">
                    <div class="form-group"><input class="form-control ng-pristine ng-untouched ng-valid" placeholder="Họ &amp; Tên" type="text" ng-model="DeliveryName"></div>
                    <div class="form-group"><input class="form-control ng-pristine ng-untouched ng-valid" placeholder="Số điện thoại" type="text" ng-model="DeliveryPhone"></div>
                    <div class="form-group"><input class="form-control ng-pristine ng-untouched ng-valid" placeholder="Email" type="text" ng-model="DeliveryEmail"></div>
                    <div class="form-group"><input class="form-control ng-pristine ng-untouched ng-valid" placeholder="Địa chỉ" type="text" ng-model="DeliveryAddress"></div>
                    <div class="form-group">
                        <select class="form-control ng-pristine ng-untouched ng-valid" ng-model="DeliveryProvinceId" ng-options="item.Id as item.Name for item in ProvinceDeliverys" ng-change="changeDeliveryProvince()"><option selected="selected"></option><option value="number:0" label="Vui lòng chọn tỉnh/thành phố">Vui lòng chọn tỉnh/thành phố</option><option value="number:1" label="Hồ Chí Minh">Hồ Chí Minh</option><option value="number:2" label="Hà Nội">Hà Nội</option><option value="number:3" label="Đà Nẵng">Đà Nẵng</option><option value="number:4" label="Cần Thơ">Cần Thơ</option><option value="number:5" label=" Thừa Thiên - Huế"> Thừa Thiên - Huế</option><option value="number:6" label="An Giang">An Giang</option><option value="number:7" label="Bà Rịa-Vũng Tàu">Bà Rịa-Vũng Tàu</option><option value="number:8" label="Bạc Liêu">Bạc Liêu</option><option value="number:9" label="Bắc Kạn">Bắc Kạn</option><option value="number:10" label="Bắc Giang">Bắc Giang</option><option value="number:11" label="Bắc Ninh">Bắc Ninh</option><option value="number:12" label="Bến Tre">Bến Tre</option><option value="number:13" label="Bình Dương">Bình Dương</option><option value="number:14" label="Bình Định">Bình Định</option><option value="number:15" label="Bình Phước">Bình Phước</option><option value="number:16" label="Bình Thuận">Bình Thuận</option><option value="number:17" label="Cà Mau">Cà Mau</option><option value="number:18" label="Cao Bằng">Cao Bằng</option><option value="number:19" label="Đắk Lắk">Đắk Lắk</option><option value="number:20" label="Đắk Nông">Đắk Nông</option><option value="number:21" label="Điện Biên">Điện Biên</option><option value="number:22" label="Đồng Nai">Đồng Nai</option><option value="number:23" label="Đồng Tháp">Đồng Tháp</option><option value="number:24" label="Gia Lai">Gia Lai</option><option value="number:25" label="Hà Giang">Hà Giang</option><option value="number:26" label="Hà Nam">Hà Nam</option><option value="number:27" label="Hà Tây">Hà Tây</option><option value="number:28" label="Hà Tĩnh">Hà Tĩnh</option><option value="number:29" label="Hải Dương">Hải Dương</option><option value="number:30" label="Hải Phòng">Hải Phòng</option><option value="number:31" label="Hòa Bình">Hòa Bình</option><option value="number:32" label="Hậu Giang">Hậu Giang</option><option value="number:33" label="Hưng Yên">Hưng Yên</option><option value="number:34" label="Khánh Hòa">Khánh Hòa</option><option value="number:35" label="Kiên Giang">Kiên Giang</option><option value="number:36" label="Kon Tum">Kon Tum</option><option value="number:37" label="Lai Châu">Lai Châu</option><option value="number:38" label="Lào Cai">Lào Cai</option><option value="number:39" label="Lạng Sơn">Lạng Sơn</option><option value="number:40" label="Lâm Đồng">Lâm Đồng</option><option value="number:41" label="Long An">Long An</option><option value="number:42" label="Nam Định">Nam Định</option><option value="number:43" label="Nghệ An">Nghệ An</option><option value="number:44" label="Ninh Bình">Ninh Bình</option><option value="number:45" label="Ninh Thuận">Ninh Thuận</option><option value="number:46" label="Phú Thọ">Phú Thọ</option><option value="number:47" label="Phú Yên">Phú Yên</option><option value="number:48" label="Quảng Bình">Quảng Bình</option><option value="number:49" label="Quảng Nam">Quảng Nam</option><option value="number:50" label="Quảng Ngãi">Quảng Ngãi</option><option value="number:51" label="Quảng Ninh">Quảng Ninh</option><option value="number:52" label="Quảng Trị">Quảng Trị</option><option value="number:53" label="Sóc Trăng">Sóc Trăng</option><option value="number:54" label="Sơn La">Sơn La</option><option value="number:55" label="Tây Ninh">Tây Ninh</option><option value="number:56" label="Thái Bình">Thái Bình</option><option value="number:57" label="Thái Nguyên">Thái Nguyên</option><option value="number:58" label="Thanh Hóa">Thanh Hóa</option><option value="number:59" label="Thừa Thiên - Huế">Thừa Thiên - Huế</option><option value="number:60" label="Tiền Giang">Tiền Giang</option><option value="number:61" label="Trà Vinh">Trà Vinh</option><option value="number:62" label="Tuyên Quang">Tuyên Quang</option><option value="number:63" label="Vĩnh Long">Vĩnh Long</option><option value="number:64" label="Vĩnh Phúc">Vĩnh Phúc</option><option value="number:65" label="Yên Bái">Yên Bái</option></select>
                    </div>
                    <div class="form-group">
                        <select class="form-control ng-pristine ng-untouched ng-valid" ng-model="DeliveryDistrictId" ng-options="item.Id as item.Name for item in DistrictDeliverys" ng-change="changeDeliveryDistrict()"><option selected="selected"></option></select>
                    </div>
                </div> -->
            </div>
        </div>


            <?php } ?>
        <div class="col-md-4 col-sm-12 col-xs-12 payment-step step3">
            <h4>2. Thanh toán và vận chuyển</h4>
            <div class="step-preview clearfix">
                <h2 class="title">Vận chuyển</h2>
                <div class="form-group ">
                    <select class="form-control ng-pristine ng-valid ng-touched" ng-model="ShippingRateId" ng-options="item.Id as item.Name for item in ShippingRates" ng-change="changeShippingRate()"><option value="number:122" label="Giao hàng tận nơi - 40,000" selected="selected">Giao hàng tận nơi - 40,000</option></select>
                </div>
                <h2 class="title">Thanh toán</h2>
                <!-- ngRepeat: item in PaymentMethods --><div class="radio ng-scope" ng-repeat="item in PaymentMethods">
                    <label class="ng-binding">
                        <input type="radio" value="0" name="optionsRadios" ng-model="PaymentMethodId" ng-click="changePaymentMethod(item.Id)" class="ng-pristine ng-untouched ng-valid">
                        Thanh toán online qua momo
                    </label>
                </div><!-- end ngRepeat: item in PaymentMethods --><div class="radio ng-scope" ng-repeat="item in PaymentMethods">
                    <label class="ng-binding">
                        <input type="radio" value="1" name="optionsRadios" ng-model="PaymentMethodId" ng-click="changePaymentMethod(item.Id)" class="ng-valid ng-dirty ng-valid-parse ng-touched">
                        Thanh toán khi giao hàng (COD)
                    </label>
                </div><!-- end ngRepeat: item in PaymentMethods --><div class="radio ng-scope" ng-repeat="item in PaymentMethods">
                    <label class="ng-binding">
                        <input type="radio" value="2" name="optionsRadios" ng-model="PaymentMethodId" ng-click="changePaymentMethod(item.Id)" class="ng-pristine ng-untouched ng-valid">
                        Chuyển khoản qua ngân hàng
                    </label>
                </div><!-- end ngRepeat: item in PaymentMethods --><div class="radio ng-scope" ng-repeat="item in PaymentMethods">
                    <label class="ng-binding">
                        <input type="radio" value="3" name="optionsRadios" ng-model="PaymentMethodId" ng-click="changePaymentMethod(item.Id)" class="ng-pristine ng-untouched ng-valid">
                        Thanh toán online qua cổng OnePay bằng thẻ Visa/Master/JCB
                    </label>
                </div><!-- end ngRepeat: item in PaymentMethods -->
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12 payment-step step1">
            <h4>3. Thông tin đơn hàng</h4>
            <div class="step-preview">
                <div class="cart-info">
                    <div class="cart-items">
                        <!-- ngRepeat: item in OrderDetails -->
                    </div>
                    <div class="total-price">
                        Thành tiền  <label class="ng-binding"> <?php
                          if(isset($_POST["total_amount"])){
                            $total_amount=$_POST["total_amount"];
                            $_SESSION["total"]=$total_amount;
                        }
                        if(isset($_SESSION["total"])){
                            echo $_SESSION["total"];
                        }else{
                            echo 0;
                        }
                        ?> </label>
                    </div>
                    <div class="shiping-price">
                        Phí vận chuyển  <label class="ng-binding">40,000 ₫</label>
                    </div>
                    <!-- <div class="btn-coupon hidden">
                        <a href="#" class="btn btn-primary"><span></span>Sử dụng mã giảm giá </a>
                    </div> -->
                    <!-- <div class="use-coupon hidden">
                        <div class="form-group">
                            <input placeholder="Nhập mã giảm giá" class="coupon-code form-control">
                            <a class="btn btn-primary">Sử dụng</a>
                        </div>
                    </div> -->
                    <div class="total-payment">
                        Thanh toán  <span class="ng-binding"> <?php echo isset($_SESSION["total"]) ? number_format((float) str_replace([',', '.'], '', $_SESSION["total"]) + 40000, 0, ',', '.') . 'đ' : ''; ?></span>
                    <input type="hidden" name="total_money" value=<?php 
                    if(isset($_SESSION["total"])){
                    $numeric_value = (float) str_replace([',', '.', 'đ'], '', $_SESSION["total"]);
                    $total_money = $numeric_value + 40000;
                    echo $total_money;
                    }else{
                        echo 0;
                    }
                    ?>>
                    </div>
                        <input class="btn btn-default" type="submit" name="check_out_oder" value="đặt hàng"></input>
                </div>
            </div>
        </div>
    </form>
    <style>
        .step3 .title{
            margin-bottom: 20px;
        }
       .step-preview  .title{
            margin-top: 20px ;
        }
.payment-block {
    margin: 40px 0px;
    display: grid;
    grid-template-columns: auto auto auto;
}
.payment-block  .payment-step {
    padding: 0 2px;
    margin: 0px 20px;
    border-radius: 5px;
}
.form-group {
    margin-bottom: 15px;
}
.form-control {
    color: #aaaaaa;
    font-size: 11px;
    box-shadow: none;
}
.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
.payment-block h2.title {
    color: #01c4c4;
    font-weight: bold;
    text-transform: uppercase;
}
.payment-block .payment-step h4 {
    margin-top: 0;
    padding: 10px;
    background-color: #01c4c4;
    font-size: 14px;
    text-transform: uppercase;
    color: #ffffff;
    margin-bottom: 0;
}
 .payment-block .payment-step .step-preview {
    background-color: #ffffff;
    padding: 10px;
    min-height: 580px;
    border: 1px solid #dddddd;
}
.checkbox, .radio {
    position: relative;
    display: block;
    margin-top: 10px;
    margin-bottom: 10px;
}
.checkbox+.checkbox, .radio+.radio {
    margin-top: -5px;
}
 .payment-block .payment-step .step-preview {
    background-color: #ffffff;
    padding: 10px;
    min-height: 580px;
    border: 1px solid #dddddd;
}
 .payment-block .payment-step h4 {
    margin-top: 0;
    padding: 10px;
    background-color: #01c4c4;
    font-size: 14px;
    text-transform: uppercase;
    color: #ffffff;
    margin-bottom: 0;
}
 .payment-block .payment-step .step-preview .cart-info .total-price, .payment-content .payment-block .payment-step .step-preview .cart-info .shiping-price {
    font-weight: 600;
    padding: 10px 0;
    border-bottom: 1px solid #eaeaea;
}
 .payment-block .payment-step .step-preview .cart-info .total-price, .payment-content .payment-block .payment-step .step-preview .cart-info .shiping-price {
    font-weight: 600;
    padding: 10px 0;
    border-bottom: 1px solid #eaeaea;
}
.payment-block .payment-step .step-preview .cart-info .total-price label, .payment-content .payment-block .payment-step .step-preview .cart-info .shiping-price label {
    float: right;
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
}
.payment-content .payment-block .payment-step .step-preview .cart-info .use-coupon {
    text-align: right;
    border-bottom: 1px solid #eaeaea;
    padding: 10px 0;
}
.payment-block .payment-step .step-preview .user-login {
    margin-bottom: 15px;
}
 .payment-block .payment-step .step-preview .user-login a:first-child {
    margin-right: 5px;
    padding-right: 5px;
    border-right: 1px solid #aaaaaa;
}
.payment-block .payment-step .step-preview .user-login a {
    color: #ff0000;
   text-decoration: none;
}
 .payment-block .payment-step .step-preview .form-group input {
    width: 100%;
    margin-bottom: 5px;
}
textarea.form-control {
    height: auto;
}
.shiping-price{
    font-weight: 600;
    padding: 10px 0;
    border-bottom: 1px solid #eaeaea;
}
.total-payment{
    font-weight: 600;
    padding: 10px 0;
    border-bottom: 1px solid #eaeaea;
}
 .btn-default{
    background-color: #01c4c4;
    margin-top: 10px;
    padding: 10px;
    float: right;
    margin-bottom: 0;
    border-radius: 5px;
 }
    </style>
<script>

document.addEventListener("DOMContentLoaded", function () {  
    document.getElementById("checkout-container").addEventListener("submit", function (event){
        var radioButtons = document.getElementsByName('optionsRadios');
        var isChecked = false;
         for (var i = 0; i < radioButtons.length; i++) {
        if (radioButtons[i].checked) {
            isChecked = true;
            break;
        }
    }

    if (!isChecked) {
        alert('Vui lòng chọn một phương thức thanh toán');
        event.preventDefault();
        return false;
    }
    return true;

    } );

   
});
</script>
