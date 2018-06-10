<?php
	require('connectdb.php');
	require('getURL.php');
	session_start();
?>

<!doctype html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Trang Admin</title>
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
							if (isset($_SESSION['user_fullname']) && ($_SESSION['user_id'] == "admin@gmail.com")) {
						?>
							<li><a href="#"><i class="fa fa-user"></i>Tài khoản: <?php echo $_SESSION['user_fullname']; ?></a></li>
							<li><a href="logout.php">Đăng suất</a></li>
						<?php
							} else {
						?>
						<script language="javascript">                           
							alert('<?php echo "Bạn chưa đăng nhập hoặc tài khoản của bạn không phải là ADMIN. Nhấn \"OK\" để đăng nhập." ?>');                   
						</script>
						<?php
							header('Location: 404.php');
							// $url = "login.php";
							// echo "<meta http-equiv='refresh' content='0;url=$url' />";
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
					<a href="admin.php" id="logo"><img src="assets/dest/images/logo-cake.png" width="200px" alt=""></a>
					<h6>Nhà Sách Bách Khoa</h6>
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
						<li><a href="admin.php">Trang chủ</a></li>
						<li><a href="add.php">Thêm sản phẩm</a></li>
						<li><a href="order.php">Đơn Hàng</a>
						</li>
						<li><a href="user.php">Thành viên</a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
	</div> <!-- .header -->

	<div class="container">
		<div id="content">
			
			<div class="table-responsive">
				<!-- Shop Products Table -->
				<table class="shop_table beta-shopping-cart-table" cellspacing="0">
					<thead>
						<tr>
							<th class="product-name">Sản phẩm</th>
							<th class="book_author">Tác giả</th>
							<th class="book_price">Giá</th>
							<th class="book_category_id">Thể loại</th>
							<th class="book_page">Số trang</th>
							<th class="book_quantily">Số lượng</th>
							<th class="book_status">Trạng thái</th>
							<th class="product-update">Sửa</th>
						</tr>
					</thead>
					<tbody>
						
						<?php

							$sql = "SELECT * FROM book, category WHERE (book_category_id = category_id) AND (book_new = 1)
									ORDER BY book_name";
							$result = mysqli_query($connect, $sql);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) :;
						?>

						<tr class="cart_item">
							<td class="product-name">
								<div class="media">
									<img class="pull-left" src=<?php echo $row['book_image'] ?> alt="">
									<div class="media-body">
										<p class="font-large table-title"><?php echo $row['book_name']; ?></p>
										<p class="table-option">Color: Red</p>
										<p class="table-option">Size: M</p>

										<a class="table-edit" href="#">Edit</a>
									</div>
								</div>
							</td>
							
							
							<td class="book_author">
								<span class="amount"><?php echo $row['book_author']?></span>
							</td>
							<td class="book_price">
								<span class="amount"><?php echo $row['book_price']; ?> VNĐ</span>
							</td>
							
							
							<td class="book_category_id">
								<span class="amount"><?php echo $row['category_name']?></span>
							</td>
							<td class="book_page" style="font-size: 22px">
								<?php echo $row['book_page']; ?>
							</td>
							<td class="book_quantily" style="font-size: 22px">
								<?php echo $row['book_quantity']?>
							</td>

							<?php 
								if($row['book_new'] == 1) {
							?>
									<td class="book_status" style="font-size: 22px;color: blue"><?php echo "Mới"?></td>
							<?php		
								} else {
							?>
									<td class="book_status" style="font-size: 22px;"><?php echo "Cũ"?></td>
							<?php
								}
							?>

							<td class="product-update">
								<a href="updateBook.php?book_id=<?php echo $row['book_id']?>" class="remove" title="Update this item"><i class="fa fa-refresh"></i></a>
							</td>
						
						<?php endwhile;?>

						<?php

							$sql = "SELECT * FROM book, category WHERE (book_category_id = category_id) AND (book_new = 0)
									ORDER BY book_name";
							$result = mysqli_query($connect, $sql);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) :;
						?>

						<tr class="cart_item">
							<td class="product-name">
								<div class="media">
									<img class="pull-left" src=<?php echo $row['book_image'] ?> alt="">
									<div class="media-body">
										<p class="font-large table-title"><?php echo $row['book_name']; ?></p>
										<p class="table-option">Color: Red</p>
										<p class="table-option">Size: M</p>

										<a class="table-edit" href="#">Edit</a>
									</div>
								</div>
							</td>
							
							
							<td class="book_author">
								<span class="amount"><?php echo $row['book_author']?></span>
							</td>
							<td class="book_price">
								<span class="amount"><?php echo $row['book_price']; ?> VNĐ</span>
							</td>
							
							
							<td class="book_category_id">
								<span class="amount"><?php echo $row['category_name']?></span>
							</td>
							<td class="book_page" style="font-size: 22px">
								<?php echo $row['book_page']; ?>
							</td>
							<td class="book_quantily" style="font-size: 22px">
								<?php echo $row['book_quantity']?>
							</td>

							<?php 
								if($row['book_new'] == 1) {
							?>
									<td class="book_status" style="font-size: 22px;color: blue"><?php echo "Mới"?></td>
							<?php		
								} else {
							?>
									<td class="book_status" style="font-size: 22px;"><?php echo "Cũ"?></td>
							<?php
								}
							?>

							<td class="product-update">
								<a href="updateBook.php?book_id=<?php echo $row['book_id']?>" class="remove" title="Update this item"><i class="fa fa-refresh"></i></a>
							</td>
						
						<?php endwhile;?>
					</tbody>

				</table>
				<!-- End of Shop Table Products -->
			</div>
			<div class="clearfix"></div>

		</div> <!-- #content -->
	</div> <!-- .container -->

	<div class="copyright">
		<div class="container">
			<p class="pull-left">Hà Nội 2017</p>
			<p class="pull-right pay-options">
				<a href="#"><img src="assets/dest/images/pay/master.jpg" alt="" /></a>
				<a href="#"><img src="assets/dest/images/pay/pay.jpg" alt="" /></a>
				<a href="#"><img src="assets/dest/images/pay/visa.jpg" alt="" /></a>
				<a href="#"><img src="assets/dest/images/pay/paypal.jpg" alt="" /></a>
			</p>
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
</body>
</html>