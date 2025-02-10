<section class="client">
  <div class="container-section">
      <div class="client-row">

          <div class="section-title">
              <h2 style="text-align: center;"> Đối tác</h2>
          </div>

          <div class="carousel-client">
              <div class="slide"><img src="https://mariongrandvincent.github.io/HTML-Personal-website/img-codePen/slider-logo1.png"></div>
              <div class="slide"><img src="https://mariongrandvincent.github.io/HTML-Personal-website/img-codePen/slider-logo2.png"></div>
              <div class="slide"><img src="https://mariongrandvincent.github.io/HTML-Personal-website/img-codePen/slider-logo3.png"></div>
              <div class="slide"><img src="https://mariongrandvincent.github.io/HTML-Personal-website/img-codePen/slider-logo1.png"></div>
              <div class="slide"><img src="https://mariongrandvincent.github.io/HTML-Personal-website/img-codePen/slider-logo2.png"></div>
              <div class="slide"><img src="https://mariongrandvincent.github.io/HTML-Personal-website/img-codePen/slider-logo3.png"></div>
          </div>
      </div>
  </div>
</section>  
<footer class="footer">
		<div class="container row">
			<div class="footer-col">
				<h4>Về chúng tôi</h4>
				<ul>
					<li><a href="#">Giới thiệu</a></li> 
					<li><a href="#">Giao hàng-đổi trả</a></li>
					<li><a href="#">Chính sách bảo mật</a></li>
					<li><a href="#">Liên hệ</a></li>
				</ul>
			</div>
			<div class="footer-col">
				<h4>Trợ giúp</h4>
				<ul>
					<li><a href="#">Hướng dẫn mua hàng</a></li>
					<li><a href="#">Hướng dẫn thanh toán</a></li>
					<li><a href="#">Tài khoản giao dịch</a></li>
				</ul>
			</div>
			<div class="footer-col">
				<h4>Thông Tin Công Ty</h4>
				<ul>
					<li><a href="#">CÔNG TY TNHH PHÁT TRIỂN CÔNG NGHỆ TPD</a></li>
					<li><a href="#"> 132/66 Cầu diễn,Minh Khai,Hà Nội</a></li>
					<li><a href="#"> info@mobileshop.vn

</a></li>
					<li><a href="#">Phone: (08) 66 85 85 38</a></li>
				</ul>
			</div>
			<div class="footer-col">
				<h4>theo dõi chúng tôi</h4>
				<div class="social-links">
					<a href="#"><i class="fa-brands fa-facebook-f"></i></a>
					<a href="#"><i class="fa-brands fa-x-twitter"></i></a>
					<a href="#"><i class="fa-brands fa-instagram"></i></a>
					<a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
				</div>
			</div>
		</div>
	</footer>
<style>
	.footer {
	background-color: #151515;
	padding: 80px 0;
}

.container {
	margin: auto;
}

.row {
	display: flex;
	flex-wrap: wrap;
}

ul {
	list-style: none;
}

.footer-col {
	width: 25%;
	padding: 0 15px;
}

.footer-col h4 {
	font-size: 18px;
	color: #FFF;
	text-transform: capitalize;
	margin-bottom: 35px;
	font-weight: 500;
	position: relative;
}

.footer-col h4::before {
	content: "";
	position: absolute;
	left: 0;
	bottom: -10px;
	background-color: #E91E63;
	width: 50px;
	height: 2px;
}

.footer-col ul li:not(:last-child) {
	margin-bottom: 10px;
}

.footer-col ul li a {
	color: #DDD;
	display: block;
	font-size: 1rem;
	font-weight: 300;
	text-transform: capitalize;
	text-decoration: none;
	transition: all 0.3s ease;
}

.footer-col ul li a:hover {
	color: #FFF;
	padding-left: 7px;
}

.footer-col .social-links a {
	color: #FFF;
    /* background-color: rgba(255, 255, 255, 0.2); */
    /* display: inline-block; */
    height: 40px;
    width: 40px;
    /* border-radius: 50%; */
    /* text-align: center; */
    /* margin: 0 10px 10px 0; */
    line-height: 40px;
    transition: all 0.5s ease;
}

.footer-col .social-links a:hover {
	color: #151515;
	background-color: #FFF;
}

@media(max-width: 767px) {
	.footer-col {
		width: 50%;
		margin-bottom: 30px;
	}
}

@media(max-width: 574px) {
	.footer-col {
		width: 100%;
	}
}
</style>
<script>
		let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 5000); // Change image every 2 seconds
}
</script>