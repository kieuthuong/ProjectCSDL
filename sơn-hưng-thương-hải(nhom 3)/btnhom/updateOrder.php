<?php
	require('connectdb.php');
	require('getURL.php');
	session_start();
?>

<!-- Cập nhật lại đơn hàng và chuyển về trang đơn hàng -->
<?php
	$orderID = $_GET['order_id'];
	if(isset($_POST["update"])) {
		$customer_name = $_POST["customer_name"];
		$customer_add = $_POST["customer_add"];
		$customer_phone = $_POST["customer_phone"];
		$customer_note = $_POST["customer_note"];
		$order_status = $_POST["order_status"];

		// Cập nhật đơn hàng vào cơ sở dữ liệu

		$sql = "UPDATE `order_customer` SET `customer_name` = '$customer_name', `customer_add` = '$customer_add', `customer_phone` = '$customer_phone', `customer_note` = '$customer_note', `order_status` = '$order_status' WHERE `order_customer`.`order_id` = $orderID";
		$result = mysqli_query($connect, $sql);
		if(!$result) {
			echo "That bai.". mysqli_error($result);
		} else {
?>
		<script language="javascript">                           
		    alert('<?php echo "Cập nhật dữ liệu thành công. Nhấn \'OK\' để chuyển đến trang ĐƠN HÀNG." ?>');
	 	</script>
<?php
		$url = "order.php";
		echo "<meta http-equiv='refresh' content='0;url=$url' />";
		}
	}
?>
<!doctype html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cập nhật đơn hàng</title>
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
							alert('<?php echo "Bạn chưa đăng nhập hoặc tài khoản của bạn không phải là ADMIN. Chúng tôi sẽ chuyển sang trang đăng nhập sau 5s." ?>');                   
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
				<div class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform" action="search.php">
					        <input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..." />
					        <button class="fa fa-search" type="submit" id="searchsubmit" name="search"></button>
						</form>
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

	<div class="inner-header">
		<div class="container">
			
			<div class="pull-right">
				
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

		<!-- Lấy ID đơn hàng -->
	<?php
		$sql = "SELECT * FROM order_customer WHERE order_id = $orderID";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	?>

	<div class="container">
		<div id="content">
			<form action="#" method="post" class="beta-form-checkout">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Thông tin đơn hàng có mã : <span style="color: #33cc33; font-size: 30px"><?php echo $orderID?></span></h4>
						<h6>Tài khoản đặt hàng: <?php echo $row['user_mail']?></h6>
						<h6>Tổng tiền : <?php echo $row['totalmoney']?> VNĐ</h6>
						<h6>Ngày giờ đặt hàng: <?php echo $row['order_datetime']?></h6>
						<div class="space20">&nbsp;</div>
						<div class="form-block">
							<label for="email">Tên khách hàng</label>
							<input type="text" name="customer_name" value="<?php echo $row['customer_name']?>" required>
						</div>

						<div class="form-block">
							<label for="adress">Địa chỉ</label>
							<input type="text" id="adress" value="<?php echo $row['customer_add']?>" name="customer_add" required>
						</div>

						<div class="form-block">
							<label for="phone">Số điện thoại</label>
							<input type="text" id="phone" name="customer_phone" value="<?php echo $row['customer_phone']?>" required>
						</div>

						<div class="form-block">
							<label for="phone">Ghi chú</label>
							<input type="text" id="phone" name="customer_note" value="<?php echo $row['customer_note']?>" required>
						</div>
						
						<div class="form-block">
							<label for="phone">Trạng thái</label>
							<input type="text" id="phone" name="order_status" value="<?php echo $row['order_status']?>" required>
						</div>

						<div class="form-block">
							<button type="submit" name="update" class="btn btn-primary"> Cập nhật </button>
							
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->	

</body>