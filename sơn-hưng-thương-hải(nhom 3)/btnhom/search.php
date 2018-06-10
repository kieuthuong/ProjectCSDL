<?php
	require('connectdb.php');
	require('getURL.php');
	session_start();
		$sql = "SELECT * FROM book";
	$result = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$_SESSION['sl'.$row['book_id']] = $row['book_quantity'];
	}
?>

<!doctype html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Trang chủ </title>
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" href="assets/dest/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="assets/dest/rs-plugin/css/responsive.css">
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

									<?php 
										
										$_SESSION['total'] = 0;
										$sql = "SELECT * FROM book";

										$result = mysqli_query($connect, $sql);
										while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
									?>

									<?php 
										if (isset($_SESSION['bID'.$row['book_id']]))
											if ($_SESSION['bID'.$row['book_id']] > 0){

									?>
									<div class="cart-item">
										<form method="POST">
											<button type="submit" class="close" name=<?php echo "del".$row['book_id'];?>><i class="fa fa-times"></i></button>
										</form>
										

										<?php 
											if (isset($_POST['del'.$row['book_id']])) {
												$_SESSION['total'] = $_SESSION['total'] - ($_SESSION['bID'.$row['book_id']] * $row['book_price']);
												unset($_SESSION['bID'.$row['book_id']]);
												$url = url();
												echo "<meta http-equiv='refresh' content='0;url=$url' />";
											}
										?>

										<div class="media">
											<a class="pull-left" href="#"><img src=<?php echo $row['book_image']?> alt=""></a>
											<div class="media-body">
												<span class="cart-item-title"><?php echo $row['book_name'] ?></span>
												<span class="cart-item-options">Size: XS; Colar: Navy</span>
												<span class="cart-item-amount"><?php echo $_SESSION['bID'.$row['book_id']];?>*<span><?php echo $row['book_price']; $_SESSION['total']+=$row['book_price'] * $_SESSION['bID'.$row['book_id']];?></span></span>
											</div>
										</div>
									</div>
									<?php } ?>

									<?php endwhile; ?>

									<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value"><?php echo $_SESSION['total']?> VNĐ</span></div>
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="checkout.php" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
						</div> <!-- .cart -->
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

	<?php
		if (isset($_GET['search'])) {
			$data = $_GET['s'];

			$sql = "SELECT * FROM book
					WHERE book_name LIKE '%$data%'";

			$result = mysqli_query($connect, $sql);

			if ($result) {
				$numResult = mysqli_num_rows($result);
			}
		}
	?>

		<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Có <?php echo $numResult; ?> kết quả</h4>
							<div class="beta-products-details">
								<p class="pull-left"></p>
								<div class="clearfix"></div>
							</div>

							<?php 
								if ($numResult < 8)
									$i = 0;
								else
									$i = 1;
								$j = $numResult/4;
								$buffer = 1;
								while ($i <= $j) :
							?>

							<div class="row">

								<?php while ($buffer % 5 != 0) : ?>
								<?php
									if (!($row = mysqli_fetch_array($result, MYSQLI_ASSOC)))
										break;
								 ?>

								<div class="col-sm-3">
									<div class="single-item">
										<div class="single-item-header">
											<a href="product.php?book_id=<?php echo $row['book_id']?>"><img src=<?php echo $row['book_image'] ?> alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">
												<?php echo $row['book_name']; ?>
											</p>
											<p class="single-item-price">
												<span>
													<?php echo $row['book_price']; ?>
												</span>
											</p>
										</div>
										<div class="single-item-caption">
											<form method="POST">
												<button class="add-to-cart pull-left" type="submit" name=<?php echo "new".$row['book_id']?>><i class="fa fa-shopping-cart"></i></button>
											</form>

									<!-- Khi click vào biểu tg giỏ hàng thì tăng số lượng sách lên 1 đơn vị và tải lại trang home.php-->
									<?php 

										if (isset($_POST['new'.$row['book_id']]) && !isset($_SESSION['user_fullname'])) { ?>
									    	<script language="javascript">                           
   												alert('<?php echo "Bạn chưa đăng nhập. Ấn vào \"OK\" để đăng nhập!!!"  ?>');                                                 
											</script>
									<?php
										$url = "login.php";
										echo "<meta http-equiv='refresh' content='0;url=$url' />";
										}elseif (isset($_POST['new'.$row['book_id']]) && isset($_SESSION['user_fullname'])) {
											if (!isset($_SESSION['bID'.$row['book_id']]) && ($_SESSION['sl'.$row['book_id']] >= 1)) {
												$_SESSION['bID'.$row['book_id']] = 1;
											} elseif($_SESSION['sl'.$row['book_id']] > $_SESSION['bID'.$row['book_id']]) {
												$_SESSION['bID'.$row['book_id']]++;
											}elseif (isset($_POST['new'.$row['book_id']]) && (($_SESSION['sl'.$row['book_id']] <= $_SESSION['bID'.$row['book_id']]) || ($_SESSION['sl'.$row['book_id']] == 0))) {
									?>
									    	<script language="javascript">                           
   												alert('<?php echo "Số lượng không đủ."  ?>');                                                 
											</script>
									<?php
											}
											$url = url();
											echo "<meta http-equiv='refresh' content='0;url=$url' />";
										}
									?>

											<a class="beta-btn primary" href="product.php?book_id=<?php echo $row['book_id']?>">Chi tiết <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>

								<?php 
									$buffer++;
									endwhile; 
								?>

							</div>
							<div class="space50">&nbsp;</div>
							<?php 
								$i++;
								$buffer = 1;
								endwhile; 
							?>

						</div> <!-- .beta-products-list Sách mới-->

						<div class="space50">&nbsp;</div>

					</div>
				</div> <!-- end section with sidebar and main content-->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->

	<div class="copyright">
		<div class="container">
			<p class="pull-left">Dự án môn cơ sở dữ liệu</p>
			<!-- <p class="pull-right pay-options">
				<a href="#"><img src="assets/dest/images/pay/master.jpg" alt="" /></a>
				<a href="#"><img src="assets/dest/images/pay/pay.jpg" alt="" /></a>
				<a href="#"><img src="assets/dest/images/pay/visa.jpg" alt="" /></a>
				<a href="#"><img src="assets/dest/images/pay/paypal.jpg" alt="" /></a>
			</p> -->
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .copyright -->


	<!-- include js files -->
	<script src="assets/dest/js/jquery.js"></script>
	<script src="assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
	<script src="assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
	<script src="assets/dest/vendors/animo/Animo.js"></script>
	<script src="assets/dest/vendors/dug/dug.js"></script>
	<script src="assets/dest/js/scripts.min.js"></script>
	<script src="assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script src="assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script src="assets/dest/js/waypoints.min.js"></script>
	<script src="assets/dest/js/wow.min.js"></script>
	<!--customjs-->
	<script src="assets/dest/js/custom2.js"></script>
	<script>
	$(document).ready(function($) {    
		$(window).scroll(function(){
			if($(this).scrollTop()>150){
			$(".header-bottom").addClass('fixNav')
			}else{
				$(".header-bottom").removeClass('fixNav')
			}}
		)
	})
	</script>
</body>
</html>
