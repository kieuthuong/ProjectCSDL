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
	<title>Đặt hàng</title>
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
						<script language="javascript">                           
							alert('<?php echo "Bạn chưa đăng nhập. Nhấn \"OK\" để đăng nhập." ?>');                   
						</script>
						<?php
							$url = "login.php";
							echo "<meta http-equiv='refresh' content='0;url=$url' />";
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
				<h6 class="inner-title">Đặt hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="home.php">Trang chủ</a> / <span>Đặt hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
			<form action="#" method="POST" class="beta-form-checkout">
				<div class="row">
					<div class="col-sm-6">
						<h4>Đặt hàng</h4>
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="name">Họ tên người nhận*</label>
							<input type="text" id="name" name="name" placeholder="Họ tên" required>
						</div>
						<div class="form-block">
							<label>Giới tính </label>
							<input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
							<input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>
										
						</div>

						<div class="form-block">
							<label for="adress">Địa chỉ*</label>
							<input type="text" id="adress" name="address" placeholder="Street Address" required>
						</div>
						

						<div class="form-block">
							<label for="phone">Điện thoại*</label>
							<input type="text" id="phone" name="phone" required>
						</div>
						
						<div class="form-block">
							<label for="notes">Ghi chú</label>
							<textarea id="notes" name="note"></textarea>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="your-order">
							<div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
							<div class="your-order-body" style="padding: 0px 10px">
								<div class="your-order-item">
									<div>
									<!--  one item	 -->
										<?php 
											$sql = "SELECT * FROM book";

											$result = mysqli_query($connect, $sql);
											while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
												if (isset($_SESSION['bID'.$row['book_id']]) && ($_SESSION['bID'.$row['book_id']] > 0)) {
										?>

										<div class="media">
											<img width="25%" src=<?php echo $row['book_image']?> alt="" class="pull-left">
											<div class="media-body">
												<p class="font-large">Thông tin sách</p>
												<span class="color-gray your-order-info"><b>Tên sách:</b> <?php echo $row['book_name']?></span>
												<span class="color-gray your-order-info"><b>Giá:</b> <?php echo $row['book_price']?> VNĐ</span>
												<span class="color-gray your-order-info"><b>Số lượng:</b> <?php echo $_SESSION['bID'.$row['book_id']]?></span>
											</div>
										</div>
									<!-- end one item -->

										<?php 
											};
											endwhile;
										?>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="your-order-item">
									<div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
									<div class="pull-right"><h5 class="color-black"><?php echo $_SESSION['total']?>VNĐ</h5></div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
							
							<div class="your-order-body">
								<ul class="payment_methods methods">
									<li class="payment_method_bacs">
										<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
										<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
										<div class="payment_box payment_method_bacs" style="display: block;">
											Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
										</div>						
									</li>

									<li class="payment_method_cheque">
										<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
										<label for="payment_method_cheque">Chuyển khoản </label>
										<div class="payment_box payment_method_cheque" style="display: none;">
											Chuyển tiền đến tài khoản sau:
											<br>- Số tài khoản: 123 456 789
											<br>- Chủ TK: Nguyễn A
											<br>- Ngân hàng ACB, Chi nhánh Hà Nội
										</div>						
									</li>
									
								</ul>
							</div>
								<input class="order-item" type="submit" name="order-item" value="Đặt hàng">
						</div> <!-- .your-order -->
					</div>
				</div>
			</form>

						<!-- Cập nhật đơn hàng vào cơ sở dữ liệu -->
			<?php
				if (isset($_POST['order-item'])) {
					$user_id = $_SESSION['user_id'];
					$name = $_POST['name'];
					$address = $_POST['address'];
					$phone = $_POST['phone'];
					$note = $_POST['note'];
					$gender = $_POST['gender'];
					$total = $_SESSION['total'];

					if ($total == 0) {
						$check = 0;
			?>

						<script language="javascript">                           
							alert('<?php echo "Thất bại. Bạn chưa mua sản phẩm nào!!!" ?>');                   
						</script>

			<?php
					} else {
						$check = 1;
						date_default_timezone_set('Asia/Ho_Chi_Minh');
						$today = date("Y/m/d H:i:s");
						$order_id = mt_rand(1, 999999999);
						$num = 1;
						while ($num != 0) {
							$sql = "SELECT * FROM order_customer WHERE order_id = $order_id";
							$result = mysqli_query($connect, $sql);
							$num = mysqli_num_rows($result);
							if ($num == 0) break;
							else $order_id = mt_rand(1, 9999999999);
						}

						$sql = "INSERT INTO order_customer (order_id, user_mail, customer_name, customer_add, customer_phone, customer_note, totalmoney, order_datetime) VALUES ('$order_id', '$user_id','$name', '$address', '$phone', '$note', '$total', '$today');";
						$result = mysqli_query($connect, $sql);
						if (!$result) {
							die("Error.<br/>". mysqli_error($connect));
						}
						$sql = "SELECT * FROM book";
						$result = mysqli_query($connect, $sql);
						while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
							if (isset($_SESSION['bID'.$row['book_id']]) && ($_SESSION['bID'.$row['book_id']] > 0)) {
								$book_id = $row['book_id'];
								$quantity = $_SESSION['bID'.$row['book_id']];
								$purchases = $row['book_view'] + $_SESSION['bID'.$row['book_id']];
								$rest = $row['book_quantity'] - $_SESSION['bID'.$row['book_id']];
								$sql1 = "INSERT INTO order_item(order_id, book_id, user_mail, quantity)
										VALUES ('$order_id', '$book_id', '$user_id', '$quantity')";
								$res = mysqli_query($connect, $sql1);
														if (!$res) {
							die("Error.<br/>". mysqli_error($connect));
						}
								$sql2 = "UPDATE book 
										SET book_view = '$purchases', book_quantity = '$rest'
										WHERE book_id = $book_id";
								$res = mysqli_query($connect, $sql2);
								unset($_SESSION['bID'.$row['book_id']]);
							}
						}
					}
					
					if ($check) {
			?>

						<script language="javascript">                           
							alert('<?php echo "Cảm ơn bạn đã mua sản phẩm của chúng tôi. Hàng sẽ được chuyển đến bạn sau 1h nữa." ?>');                   
						</script>
			<?php
						$url="home.php";
            			echo "<meta http-equiv='refresh' content='0;url=$url' />";
					}
				}
			?>

		</div> <!-- #content -->
	</div> <!-- .container -->


	<div class="copyright">
		<div class="container">
			<p class="pull-left">Privacy policy. (&copy;) 2017</p>
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