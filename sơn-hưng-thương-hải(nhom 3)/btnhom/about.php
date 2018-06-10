<?php
	require('connectdb.php');
	session_start();
?>

<!doctype html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Giới thiệu</title>
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" title="style" href="assets/dest/css/style.css">
	<link rel="stylesheet" href="assets/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="assets/dest/css/huong-style.css">
</head>
<body>
	
	<div id="header">
		<div class="header-top">
			<div class="container">
				<div class="pull-left auto-width-left">
					<ul class="top-menu menu-beta l-inline">
						<li><a href=""><i class="fa fa-home"></i> Số 1,Đại Cồ Việt,Hai Bà Trưng,Hà Nội</a></li>
						<li><a href=""><i class="fa fa-phone"></i> 0123456789</a></li>
					</ul>
				</div>
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">
						<?php
							if (isset($_SESSION['user_fullname']) && ($_SESSION['user_id'] != "admin@gmail.com")) {
						?>
							<li><a href="#"><i class="fa fa-user"></i>Tài khoản: <?php echo $_SESSION['user_fullname']; ?></a></li>
							<li><a href="logout.php">Đăng suất</a></li>
						<?php
							} else {
						?>
							<li><a href="signup.php">Đăng kí</a></li>
							<li><a href="login.php">Đăng nhập</a></li>
						<?php
							}
						?>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="home.php" id="logo"><img src="assets/dest/images/logo-cake.png" width="200px" alt=""></a>
					<h6>Nhà Sách Bách Khoa</h6>
				</div>
				<div class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform" action="search.php">
					        <input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..." />
					        <button class="fa fa-search" type="submit" id="searchsubmit" name="search"></button>
						</form>
					</div>

					<div class="beta-comp">
						<div class="cart">
							<div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng<i class="fa fa-chevron-down"></i></div>
							<div class="beta-dropdown cart-body">
								<div class="cart-caption">
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="checkout.html" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="header-bottom" style="background-color: #0277b8;">
			<div class="container">
				<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu">
					<ul class="l-inline ov">
						<li><a href="home.php">Trang chủ</a></li>
						<li><a href="#">Thể loại</a>
							<ul class="sub-menu">
								<?php 
									$sql = "SELECT * FROM category
											WHERE 1";
									if (mysqli_query($connect, $sql)) {
										$result = mysqli_query($connect, $sql);
									} else {
										die("Error.<br/>". mysqli_error($connect));
									}

									while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) :
								?>
								<li><a href="product_type.php?category_id=<?php echo $row['category_id']?>"><?php echo $row['category_name']?></a></li>
								<?php endwhile; ?>
							</ul>
						</li>
						<li><a href="about.php">Giới thiệu</a></li>
						<li><a href="contacts.php">Liên hệ</a></li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
	</div> <!-- #header -->
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title"></h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html"></a> <span></span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content">
			<div class="our-history">
				
				<div class="space35">&nbsp;</div>

				<div class="history-slider">
					

						
						
						
						<div> 
							<div class="row">
							<div class="col-sm-5">
								<img src="assets/dest/images/history.jpg" alt="">
							</div>
							<div class="col-sm-7">
								<h3 class="other-title"></h3>
								<p>
									<h5>Công ty cổ phần Văn hóa và Truyền thông Sơn Đẹp Trai</h5>
									<br>Trụ sở chính: Số 1,Đại Cồ Việt,Hai Bà Trưng,Hà Nội.<br>
									 Điện thoại: 0123456789; Email: sondeptraideptrai@gmail.com
									
								</p>
								<div class="space20">&nbsp;</div>
								<p>

									<br>Công ty cổ phần Văn hóa và Truyền thông Sơn Đẹp Trai.<br>
Tháng 10 năm 2017,Công ty Cổ phần Văn hóa và Truyền thông Sơn Đẹp Trai, gia nhập thị trường sách. Sự chuẩn bị đã đến từ trước đó, với một nhóm bạn bè yêu thích văn chương và quý trọng sách vở Ngay lập tức từ cuốn sách đầu tiên, độc giả đã dành sự quan tâm và yêu mến cho một thương hiệu sách mới mẻ mang trong mình khát vọng góp phần tạo lập diện mạo mới cho xuất bản văn học tại Việt Nam.</p>
							<p>Từ cuối năm 2016, với sự trưởng thành mạnh mẽ của tổ chức, nhà sách đã mở rộng sự quan tâm sang các mảng sách non-fiction như lịch sử, triết học, khoa học, sách về các vấn đề xã hội, văn hóa đương đại, sách khai trí, tham khảo, triết lý sống... Trong lĩnh vực này, Nhã Nam đã trở thành nhà xuất bản của những tác gia quan trọng trên thị trường xuất bản thế giới hiện nay: Đức Đạt Lai Lạt Ma, Deepak Chopra, Don Miguel Ruiz, Naomi Klein, Elisabeth Gilbert... Trong thời gian tới, công ty sẽ tiếp tục phát triển mạnh các mảng sách văn học mà lâu nay vẫn chưa được quan tâm đúng mức ở Việt Nam, như tiểu thuyết khoa học giả tưởng, văn chương kỳ ảo, truyện tranh thế hệ mới… Sự ra đời của các bộ sách lớn của J.R.R Tolkien hay Frank Herbert trong năm 2009 là một minh chứng cho điều đó.</p>

							<p>Hiểu thời đại đang sống thông qua sách, song hành với những biến chuyển sâu sắc trong lòng xã hội bằng những hoạt động xuất bản miệt mài và quả cảm, con đường Sơn Đẹp Trai đã chọn để đi sẽ còn dài. Nhiều khó khăn, thử thách đang ở phía trước. Bước qua thời kỳ sơ khai với những bài học và những kinh nghiệm đầu tiên, Nhã Nam giờ đã sẵn sàng cho một chặng đường phát triển mới. Và chúng tôi muốn hoàn thiện mình trong sự cầu thị và cẩn trọng. Tất cả vì một gia sản sách to lớn, có sức sống dài lâu, có ý nghĩa với nhiều thế hệ bạn đọc.</p>

							<p>Bởi vì sách là thế giới. </p>
 
							</div>
							</div> 
						</div>
						
						
						
					</div>
				</div>
			</div>

			<div class="space50">&nbsp;</div>
			<hr />
			<div class="space50">&nbsp;</div>
			<h2 class="text-center wow fadeInDown">Chúng tôi nỗ lực hết mình để mang tri thức đến với mọi người</h2>
			

			<div class="row">
				<div class="col-sm-2 col-sm-push-2">
					<div class="beta-counter">
						<p class="beta-counter-icon"><i class="fa fa-user"></i></p>
						<p class="beta-counter-value timer numbers" data-to="19855" data-speed="2000">19855</p>
						<p class="beta-counter-title">Khách hàng hài lòng</p>
					</div>
				</div>

				<div class="col-sm-2 col-sm-push-2">
					<div class="beta-counter">
						<p class="beta-counter-icon"><i class="fa fa-picture-o"></i></p>
						<p class="beta-counter-value timer numbers" data-to="3568" data-speed="2000">3568</p>
						<p class="beta-counter-title">Số lượng đầu sách</p>
					</div>
				</div>

				<div class="col-sm-2 col-sm-push-2">
					<div class="beta-counter">
						<p class="beta-counter-icon"><i class="fa fa-clock-o"></i></p>
						<p class="beta-counter-value timer numbers" data-to="258934" data-speed="2000">258934</p>
						<p class="beta-counter-title">Số giờ phục vụ</p>
					</div>
				</div>

				<div class="col-sm-2 col-sm-push-2">
					<div class="beta-counter">
						<p class="beta-counter-icon"><i class="fa fa-pencil"></i></p>
						<p class="beta-counter-value timer numbers" data-to="150" data-speed="2000">150</p>
						<p class="beta-counter-title">Dự án mới</p>
					</div>
				</div>
			</div> <!-- .beta-counter block end -->

			
		</div> <!-- #content -->
	</div> <!-- .container -->

	<div class="copyright">
		<div class="container">
			<p class="pull-left">Dự án môn cơ sở dữ liệu</p>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .copyright -->
</body>
</html>