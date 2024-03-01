<section class="product-container">

<?php    

    $id=isset($_GET["id"]) ? $_GET["id"] : null;
    $product_detail= $productscontrol->products_list_of_admin($id);
    $list_galery_detail=$productscontrol->list_galery($id);
        ?>
        <!-- left side -->
        <div class="img-card">
        <?php
    $avatarPath = "admin/" . $product_detail["avatar"];
    if (file_exists($avatarPath)) {
        echo '<img src="' . $avatarPath . '"  alt="" id="featured-image">';
    } else {
        echo '<p>Sản phẩm không có ảnh</p>';
    }
    ?>
            <!-- small img -->
            <?php   if(!empty($list_galery_detail)){  ?>
            <div class="small-Card">
                <?php echo '<img src="' . $avatarPath . '"  alt="" class="small-Img"' ?>
                <?php  foreach($list_galery_detail as $key){ ?>
          <?php          $galery_path = "admin/" . $key["image_url"];
    if (file_exists($galery_path)) {
        echo '<img src="' . $galery_path . '"  alt="" class="small-Img">';
    } else {
    }   ?>
              <?php } ?>
            </div>
            <?php } ?>
        </div>
        <!-- Right side -->
        <div class="product-info">
            <h3><?= $product_detail["product_name"]  ?></h3>
            <?php  if($product_detail["is_on_sale"]==1) { ?>
            <h5><?=number_format($product_detail["price"], 0, ',', '.'); ?> đ<del><?=number_format($product_detail["price_old"], 0, ',', '.'); ?> đ</del></h5>
            <?php  } else  { ?>
                <h5><?=number_format($product_detail["price"], 0, ',', '.');?> đ<del></del></h5>
                <?php  }?>
            <p><?= $product_detail["descritipion"] ?></p>

            <!-- <div class="sizes">
                <p>Dung lượng</p>
                <select name="Size" id="size" class="size-option">
                    <option value="32">32Gb</option>
                    <option value="64">64Gb</option>
                    <option value="128">128Gb</option>
                    <option value="256">256Gb</option>
                </select>
            </div> -->

            <form method="post" action="index.php?act=add_to_cart" class="quantity">
                <input type="number" value="1" min="1" name="quantily[<?= $id?>]">
                <button type="submit" name="cart_submit">Mua ngay</button>
            </form>

            <div>
                
            <p> Vận chuyển:</p>
                <p>Giao hàng tiêu chuẩn miễn phí cho các đơn hàng trên 13.000.000đ , cộng với việc hoàn tiền miễn phí..</p>
                <div class="delivery">
                    <p>Hình thức</p> <p>Thời gian</p> <p>Mức giá</p>
                </div>
                <hr>
                <div class="delivery">
                    <p>Giao hàng thông thường</p> 
                    <p>1-4 ngày</p> 
                    <p>60.000đ</p>
                </div>
                <hr>
                <div class="delivery">
                    <p>Giao hàng nhanh</p> 
                    <p>1 ngày</p> 
                    <p>200.000đ</p>
                </div>
                <hr>
                <div class="delivery">
                    <p>Mua tại cửa hàng</p> 
                    <p>từ thứ 2 đến thứ 7</p> 
                    <p>Miễn phí</p>
                </div>
            </div>
        </div>
    </section>

</div>
    <?php 
     $list_comment_product=$commentcontroller->getComments($id);
     $row_comment=$commentcontroller->comment_count($id);
    ?>
    <div class="container_comment">
		<div class="col-md-12" id="comment_product">
			<div class="header_comment">
				<div class="row-comment">
					<div class="col-md-6 text-left">
					  <span class="count_comment"><?= $row_comment ?> Bình luận</span>
					</div>
					<!-- <div class="col-md-6 text-right">
					  <span class="sort_title">Sắp xếp theo</span>
					  <select class="sort_by">
						<option>Mới nhất</option>
						<option>Cũ nhất</option>
					  </select>
					</div> -->
				</div>
			</div>

			<div class="body_comment">
				<div class="row-comment">
					<div class="avatar_comment col-md-1">
					  <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
					</div>
					<form action="index.php?act=comment&id=<?= $product_detail["product_id"] ?>" class="box_comment col-md-11" method="post">
					  <textarea class="commentar" name="comment" placeholder="Thêm Bình luận" required></textarea>
					  <div class="box_post">
						<div class="pull-left">
						  <input type="checkbox" id="post_fb"/>
						  <label for="post_fb">
               Để lại bình luận dưới đây
              </label>
						</div>
						<div class="pull-right">
						  <span>
							<img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar" />
							<i class="fa fa-caret-down"></i>
						  </span>
						  <input type="submit" value="gửi">
						</div>
					  </div>
            </form>
				</div>
				<div class="row-comment">
          <?php      if (!empty($list_comment_product)) { ?>
					<ul id="list_comment" class="col-md-12">
						<!-- Start List Comment 1 -->
            <?php $count = 0;
            foreach ($list_comment_product as $key) {
              if ($count < 6) { 
                ?>
           
            
						<li class="box_result row">
							<div class="avatar_comment col-md-1">
								<img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
							</div>
							<div class="result_comment col-md-11">
								<h4><?= $key["user_name"] ?></h4>
								<p><?= $key["content"] ?></p>
								<div class="tools_comment">
									<span aria-hidden="true"> </span>
									<span aria-hidden="true"> </span>
									<i class="fa fa-thumbs-o-up"></i> <span class="count"></span> 
									<span aria-hidden="true"> </span>
									<span>
                    <?php 
                    
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $currentDateTime = date('Y-m-d H:i:s');  // Sửa định dạng ngày giờ để phù hợp với strtotime
                    $commentTime = strtotime($key["comment_date"]);

                    $timeDifference = round((strtotime($currentDateTime) - $commentTime) / 60);

                    if ($timeDifference >= 60) {
                    $hours = floor($timeDifference / 60);
                    $minutes = $timeDifference % 60;
                    if ($hours >= 24) {
                    $days = floor($hours / 24);
                    $hours = $hours % 24;
                    echo "$days ngày $hours giờ $minutes phút trước";
                    } else {
                   echo "$hours giờ $minutes phút trước";
                    }
                     } else {
                      echo "$timeDifference phút trước";
                      }

                  
                     ?>
                     
                  </span>
								</div>
								<!-- <ul class="child_replay">
									<li class="box_reply row">
										<div class="avatar_comment col-md-1">
											<img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
										</div>
										 <div class="result_comment col-md-11">
											<h4>Sugito</h4>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>
											<div class="tools_comment">
												<a class="like" href="#">Like</a>
												<span aria-hidden="true"> · </span>
												<a class="replay" href="#">Reply</a>
												<span aria-hidden="true"> · </span>
												<i class="fa fa-thumbs-o-up"></i> <span class="count">1</span> 
												<span aria-hidden="true"> · </span>
												<span>26m</span>
											</div>
											<ul class="child_replay"></ul>
										</div>
									</li>
								</ul> -->
							</div>
						</li>
            <?php
        $count++;
      } else {
        break; 
      }  ?>
						<?php } ?>
           
					</ul>
          <?php  } ?>
          <?php  if($row_comment>6) {?>
				  <button class="show_more" onclick="showMoreComments()" type="button">Xem thêm <?=  $row_comment-6 ?> bình luận</button>
          <?php } ?>
          <div id="additionalComments" style="display:none"  class="row-comment">
          <?php      if (!empty($list_comment_product)) { ?>
					<ul id="list_comment" class="col-md-12">
						<!-- Start List Comment 1 -->
            <?php
            for($i=6;$i<count($list_comment_product);$i++) {
              ?>
            
						<li class="box_result row">
							<div class="avatar_comment col-md-1">
								<img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
							</div>
							<div class="result_comment col-md-11">
								<h4><?= $list_comment_product[$i]["user_name"] ?></h4>
								<p><?= $list_comment_product[$i]["content"] ?></p>
								<div class="tools_comment">
									<span aria-hidden="true"> </span>
									<span aria-hidden="true"> </span>
									<i class="fa fa-thumbs-o-up"></i> <span class="count"></span> 
									<span aria-hidden="true">  </span>
									<span>
                    <?php 
                    
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $currentDateTime = date('Y-m-d H:i:s');  // Sửa định dạng ngày giờ để phù hợp với strtotime
                    $commentTime = strtotime($list_comment_product[$i]["comment_date"]);

                    $timeDifference = round((strtotime($currentDateTime) - $commentTime) / 60);

                    if ($timeDifference >= 60) {
                    $hours = floor($timeDifference / 60);
                    $minutes = $timeDifference % 60;
                    if ($hours >= 24) {
                    $days = floor($hours / 24);
                    $hours = $hours % 24;
                    echo "$days ngày $hours giờ $minutes phút trước";
                    } else {
                   echo "$hours giờ $minutes phút trước";
                    }
                     } else {
                      echo "$timeDifference phút trước";
                      }

                  
                     ?>
                     
                  </span>
								</div>
							
							</div>
						</li>
						<?php } ?>
           
					</ul>
          <?php  } ?>
				</div>
				</div>
			</div>
		</div>
	</div>


    




    <style>
      .related_products{
        display: grid;
        grid-template-columns: 200px 200px 200px 200px 200px 200px;
        justify-content: space-around;
        align-items: center;
        text-align: center;
        margin-top: 10px;
       margin-left: 4px;
        
      }
.pull-right{
  float:right;
}
.pull-left{
  float:left;
}
#comment_product{
  background:#fff;
  border: 1px solid #dddfe2;
  border-radius: 3px;
  color: #4b4f56;
  padding:50px;
}
.header_comment{
    font-size: 14px;
    overflow: hidden;
    border-bottom: 1px solid #e9ebee;
    line-height: 25px;
    margin-bottom: 24px;
    padding: 10px 0;
}
.sort_title{
  color: #4b4f56;
}
.sort_by{
  background-color: #f5f6f7;
  color: #4b4f56;
  line-height: 22px;
  cursor: pointer;
  vertical-align: top;
  font-size: 12px;
  font-weight: bold;
  vertical-align: middle;
  padding: 4px;
  justify-content: center;
  border-radius: 2px;
  border: 1px solid #ccd0d5;
}
.count_comment{
  font-weight: 600;
}
.body_comment{
    padding: 0 8px;
    font-size: 14px;
    display: block;
    line-height: 25px;
    word-break: break-word;
}
.avatar_comment{
  display: block;
}
.avatar_comment img{
  height: 48px;
  width: 48px;
}
.box_comment{
	display: block;
    position: relative;
    line-height: 1.358;
    word-break: break-word;
    border: 1px solid #d3d6db;
    word-wrap: break-word;
    background: #fff;
    box-sizing: border-box;
    cursor: text;
    font-family: Helvetica, Arial, sans-serif;
    font-size: 16px;
	padding: 0;
}
.box_comment textarea{
	min-height: 40px;
	padding: 12px 8px;
	width: 100%;
	border: none;
	resize: none;
}
.box_comment textarea:focus{
  outline: none !important;
}
.box_comment .box_post{
	border-top: 1px solid #d3d6db;
    background: #f5f6f7;
    padding: 8px;
    display: block;
    overflow: hidden;
}
.box_comment label{
  display: inline-block;
  vertical-align: middle;
  font-size: 11px;
  color: #90949c;
  line-height: 22px;
}
.box_comment input[type="submit"]{
  margin-left:8px;
  background-color: #4267b2;
  border: 1px solid #4267b2;
  color: #fff;
  text-decoration: none;
  line-height: 22px;
  border-radius: 2px;
  font-size: 14px;
  font-weight: bold;
  position: relative;
  text-align: center;
}
.box_comment input[type="submit"]:hover{
  background-color: #29487d;
  border-color: #29487d;
}
.box_comment .cancel{
	margin-left:8px;
	background-color: #f5f6f7;
	color: #4b4f56;
	text-decoration: none;
	line-height: 22px;
	border-radius: 2px;
	font-size: 14px;
	font-weight: bold;
	position: relative;
	text-align: center;
  border-color: #ccd0d5;
}
.box_comment .cancel:hover{
	background-color: #d0d0d0;
	border-color: #ccd0d5;
}
.box_comment img{
  height:16px;
  width:16px;
}
.box_result{
  margin-top: 24px;
}
.box_result .result_comment h4{
  font-weight: 600;
  white-space: nowrap;
  color: #365899;
  cursor: pointer;
  text-decoration: none;
  font-size: 14px;
  line-height: 1.358;
  margin:0;
}
.box_result .result_comment{
  display:block;
  overflow:hidden;
  padding: 0;
}
.child_replay{
	border-left: 1px dotted #d3d6db;
	margin-top: 12px;
	list-style: none;
	padding:0 0 0 8px
}
.reply_comment{
	margin:12px 0;
}
.box_result .result_comment p{
  margin: 4px 0;
  text-align:justify;
}
.box_result .result_comment .tools_comment{
  font-size: 12px;
  line-height: 1.358;
}
.box_result .result_comment .tools_comment a{
  color: #4267b2;
  cursor: pointer;
  text-decoration: none;
}
.box_result .result_comment .tools_comment span{
  color: #90949c;
}
.body_comment .show_more, .body_comment .show_less{
  background: #3578e5;
  border: none;
  box-sizing: border-box;
  color: #fff;
  font-size: 14px;
  margin-top: 24px;
  padding: 12px;
  text-shadow: none;
  width: 100%;
  font-weight:bold;
  position: relative;
  text-align: center;
  vertical-align: middle;
  border-radius: 2px;
}





    </style>
    <style>

        .product-container {
  display: flex;
  justify-content: start;
  align-items: start;
  gap: 40px;
  margin: 20px 20px;
}

/* .img-card{
    width: 40%;
} */

.img-card img {
  width: 500px;
  flex-shrink: 0;
  border-radius: 4px;
  height: 520px;
  object-fit: cover;
}

.small-Card {
  display: grid;
  grid-template-columns: auto auto auto auto;
  justify-content: start;
  align-items: center;
  margin-top: 15px;
  gap: 12px;
}

.small-Card img {
  width: 104px;
  height: 104px;
  border-radius: 4px;
  cursor: pointer;
}

.small-Card img:active {
  border: 1px solid #17696a;
}

.sm-card {
  border: 2px solid darkred;
}

.product-info{
  width: 60%;
}
.product-info h3 {
  font-size: 32px;
  font-family: Lato;
  font-weight: 600;
  line-height: 130%;
}

.product-info h5 {
  font-size: 24px;
  font-family: Lato;
  font-weight: 500;
  line-height: 130%;
  color: #ff4242;
  margin: 6px 0;
}

.product-info del {
  color: #a9a9a9;
}

.product-info p {
  color: #424551;
  margin: 15px 0;
  width: 70%;
  white-space: pre-line;
}

.sizes p {
  font-size: 22px;
  color: black;
}

.size-option {
  width: 200px;
  height: 30px;
  margin-bottom: 15px;
  padding: 5px;
}

.quantity input {
  width: 51px;
  height: 33px;
  margin-bottom: 15px;
  padding: 6px;
}

.product-container button {
  background: #17696a;
  border-radius: 4px;
  padding: 10px 37px;
  border: none;
  color: white;
  font-weight: 600;
}

.product-container button:hover {
  background: #ff4242;
  transition: ease-in 0.4s;
}

.delivery {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 70%;
  color: #787a80;
  font-size: 12px;
  font-family: Lato;
  line-height: 150%;
  letter-spacing: 1px;
}

.product-container hr {
  color: #787a80;
  width: 58%;
  opacity: 0.67;
}

.pagination {
    color: #787a80;
    margin: 15px 0;
    cursor: pointer;
}

@media screen and (max-width: 576px) {
  .product-container{
    flex-direction: column;
  }
  .small-Card img{
    width: 80px;
  }
  .product-info{
    width: 100%;
  }
  .product-info p{
    width: 100%;
  }

  .delivery{
    width: 100%;
  }

  hr{
    width: 100%;
  }
}
    </style>
    <script>
let featuredImg = document.getElementById('featured-image');
let smallImgs = document.getElementsByClassName('small-Img');

function changeImage(src, index) {
    featuredImg.src = src;
    for (let i = 0; i < smallImgs.length; i++) {
        smallImgs[i].classList.remove('sm-card');
    }
    smallImgs[index].classList.add('sm-card');
}

for (let i = 0; i < smallImgs.length; i++) {
    smallImgs[i].addEventListener('click', () => {
        changeImage(smallImgs[i].src, i);
    });
}
    // $(document).ready(function () {
    //     const priceElement = $('.product-info h5');
    //     const additionalCosts = {
    //         '64': 400000,
    //         '128': 600000,  // Có thể thêm chi phí cho các dung lượng khác nếu cần
    //         '256': 800000   // Tương tự, có thể thêm chi phí cho các dung lượng khác nếu cần
    //     };

    //     $('#size').on('change', function () {
    //         const selectedSize = $(this).val();
            
    //         if (additionalCosts[selectedSize]) {
    //             const totalPrice = basePrice + additionalCosts[selectedSize];
    //             priceElement.html(formatPrice(totalPrice));
    //             $.ajax({
    //                 type: 'POST',
    //                 url: 'index.php?act=update_cart', // Thay đổi đường dẫn tùy theo cấu trúc của ứng dụng bạn
    //                 data: { size: selectedSize, price: totalPrice },
    //                 success: function (response) {
    //                     console.log('Giá đã được lưu vào session.');
    //                 }
    //             });
    //         } else {
    //             priceElement.html(formatPrice(basePrice));
    //         }
    //     });

    //     function formatPrice(price) {
    //         return price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
    //     }
    // });
    function showMoreComments() {
        // Display additional comments when "Xem thêm" is clicked
        document.getElementById('additionalComments').style.display = 'block';

        // Hide the "Xem thêm" button
        document.querySelector('.show_more').style.display = 'none';
    }




</script>

