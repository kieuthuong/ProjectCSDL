<?php
	require('connectdb.php');
	session_start();
	require('getURL.php');
	$msgError = "";
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
	<title>Sản Phẩm</title>
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
												$_SESSION['bID'.$row['book_id']] = 0;
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

	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="home.php">Trang chủ</a> / <span>Đặt hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">
					<?php 
						$bookID = $_GET['book_id'];
						$sql = "SELECT * FROM book, category
								WHERE (book_id = $bookID) AND (category_id = book_category_id)";

						$result = mysqli_query($connect, $sql);
						$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					?>
					<div class="row">
						<div class="col-sm-4">
							<img src=<?php echo $row['book_image']?> alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title"><b><?php echo $row['book_name']?></b></p>
								<p class="single-item-price">
									<span><?php echo $row['book_price']?> VNĐ</span>
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p><b>Tác giả :</b><?php echo $row['book_author']?></p>
								<p><b>Thể loại :</b><?php echo $row['category_name']; $categoryID = $row['book_category_id'];?></p>
								<p><b>Số Trang :</b><?php echo $row['book_page']?></p>
								<p><b>Số lượng :</b><?php 
									if (!isset($_SESSION['bID'.$row['book_id']]))
										echo $row['book_quantity'];
									else
										echo $row['book_quantity'] - $_SESSION['bID'.$row['book_id']];
								?></p>
								<p><b>Kích thước :</b>13 x 20,5 cm</p>
							</div>
							<div class="space20">&nbsp;</div>
						<form method="POST">
							<p>Lựa Chọn:</p>
							<div class="single-item-options">
								<select class="wc-select" name="select">
									<option>Số lượng</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="5">5</option>
									<option value="5">5</option>
									<option value="5">5</option>
								</select>

							<button class="add-to-cart pull-left" type="submit" name="buy"><i class="fa fa-shopping-cart"></i></button>
						</form>

						<?php 
							if (isset($_POST['buy'])) {
								if (!isset($_SESSION['user_id'])){
						?>
							    	<script language="javascript">                           
										alert('<?php echo "Bạn chưa đăng nhập. Ấn vào \"OK\" để đăng nhập!!!"  ?>');                                                 
									</script>
						<?php
								$url = "login.php";
								echo "<meta http-equiv='refresh' content='0;url=$url' />";
								} elseif (!empty($_POST['select']) && ($_POST['select'] <= 0)){
									$msgError = "Bạn chưa chọn số lượng";
								} elseif (!isset($_SESSION['bID'.$row['book_id']]) && ($_SESSION['sl'.$row['book_id']] >= $_POST['select'])) {
									$_SESSION['bID'.$row['book_id']] = $_POST['select'];
									$url = url();
									echo "<meta http-equiv='refresh' content='0;url=$url' />";
								} elseif($_SESSION['sl'.$row['book_id']] >= ($_SESSION['bID'.$row['book_id']])+$_POST['select']) {
									$_SESSION['bID'.$row['book_id']]+=$_POST['select'];
									$url = url();
									echo "<meta http-equiv='refresh' content='0;url=$url' />";
								}elseif (($_SESSION['sl'.$row['book_id']] < ($_SESSION['bID'.$row['book_id']])+$_POST['select']) || ($_SESSION['sl'.$row['book_id']] == 0)) {
						?>
						    	<script language="javascript">                           
										alert('<?php echo "Số lượng không đủ."  ?>');                                                 
								</script>
						<?php
								$url = url();
								echo "<meta http-equiv='refresh' content='0;url=$url' />";
								}

							}
						?>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Sơ lược về tác phẩm</a></li>
						</ul>

						<div class="panel" id="tab-description">
							<p><?php echo $row['book_description']?></p>
						</div>
					</div>

					<div class="space50">&nbsp;</div>

					<div class="beta-products-list">
						<h4>Sách liên quan</h4>

						<div class="row">

							<?php
								$sql = "SELECT * FROM book
								WHERE (book_category_id = $categoryID) AND (book_id != $bookID)
								ORDER BY book_view DESC
								LIMIT 3";

								$result = mysqli_query($connect, $sql);
								while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) :
							?>

							<div class="col-sm-4">
								<div class="single-item">
									<div class="single-item-header">
										<a href="product.php?book_id=<?php echo $row['book_id']?>"><img src=<?php echo $row['book_image']?> alt=""></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title"><?php echo $row['book_name']?></p>
										<p class="single-item-price">
											<span><?php echo $row['book_price']?></span>
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="product.php?book_id=<?php echo $row['book_id']?>"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="product.php?book_id=<?php echo $row['book_id']?>">Chi tiết <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>

						<?php endwhile; ?>

						</div>
					</div> <!-- .beta-products-list -->
				</div>

				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Sách bán chạy</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">

								<?php 
									$sql = "SELECT * FROM book
								          	WHERE (book_view >= 100) AND (book_id != $bookID)
							          		ORDER BY book_view DESC
							          		LIMIT 5";

									if (mysqli_query($connect, $sql)) {
							    		$result = mysqli_query($connect, $sql);
							  		} else {
							    		die("Error <br/>". mysqli_error($connect));
							  		}

							  		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) :
								?>

								<div class="media beta-sales-item">
									<a class="pull-left" href="product.php?book_id=<?php echo $row['book_id']?>"><img src=<?php echo $row['book_image'] ?> alt=""></a>
									<div class="media-body">
										<a href="product.php?book_id=<?php echo $row['book_id']?>"><p><?php echo $row['book_name']; ?></p></a>
										<span class="beta-sales-price"><?php echo $row['book_price']; ?></span>
									</div>
								</div>

								<?php endwhile; ?>

							</div>
						</div>
					</div> <!-- best sellers widget -->

					<div class="widget">
						<h3 class="widget-title">Sách mới</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">

								<?php
									$sql = "SELECT * FROM book
								          	WHERE (book_new = 1) AND (book_id != $bookID)
							          		ORDER BY book_view DESC
							          		LIMIT 5";

									if (mysqli_query($connect, $sql)) {
							    		$result = mysqli_query($connect, $sql);
							  		} else {
							    		die("Error <br/>". mysqli_error($connect));
							  		}

							  		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) :
								?>

								<div class="media beta-sales-item">
									<a class="pull-left" href="product.php?book_id=<?php echo $row['book_id']?>"><img src=<?php echo $row['book_image'] ?> alt=""></a>
									<div class="media-body">
										<a href="product.php?book_id=<?php echo $row['book_id']?>"><p><?php echo $row['book_name']; ?></p></a>
										<span class="beta-sales-price"><?php echo $row['book_price']; ?></span>
									</div>
								</div>

								<?php endwhile; ?>


							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->

	<div class="copyright">
		<div class="container">
			<p class="pull-left">Dự án môn cơ sở dữ liệu</p>
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

	<!--customjs-->
	<script type="text/javascript">
    $(function() {
        // this will get the full URL at the address bar
        var url = window.location.href;

        // passes on every "a" tag
        $(".main-menu a").each(function() {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest("li").addClass("active");
				$(this).parents('li').addClass('parent-active');
            }
        });
    });


</script>
<script>
	 jQuery(document).ready(function($) {
                'use strict';

// color box

//color
      jQuery('#style-selector').animate({
      left: '-213px'
    });

    jQuery('#style-selector a.close').click(function(e){
      e.preventDefault();
      var div = jQuery('#style-selector');
      if (div.css('left') === '-213px') {
        jQuery('#style-selector').animate({
          left: '0'
        });
        jQuery(this).removeClass('icon-angle-left');
        jQuery(this).addClass('icon-angle-right');
      } else {
        jQuery('#style-selector').animate({
          left: '-213px'
        });
        jQuery(this).removeClass('icon-angle-right');
        jQuery(this).addClass('icon-angle-left');
      }
    });
				});
	</script>

	<?php 
		if ($msgError != "") {
	?>

	<script language="javascript">                           
   		alert('<?php echo $msgError  ?>');                                                 
	</script>

	<?php
		}
	?>
</body>
</html>
