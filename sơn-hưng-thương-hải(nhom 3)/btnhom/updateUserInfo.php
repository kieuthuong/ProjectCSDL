<?php
	require('connectdb.php');
	require('getURL.php');
	session_start();
?>

<!-- Cập nhân lại thông tin tài khoản người dùng -->

<?php
	$userID = $_GET["user_id"];
	if(isset($_POST["update"])) {
		$user_name = $_POST["user_fullname"];
		$user_address = $_POST["user_address"];
		$user_phone = $_POST["user_phone"];
		$user_password = $_POST["user_password"];

		// Cập nhật đơn hàng vào cơ sở dữ liệu

		$sql = "UPDATE `user` SET `user_fullname` = '$user_name', `user_address` = '$user_address', `user_phone` = '$user_phone', `user_password` = '$user_password' WHERE `user_mail` = '$userID'";
		$result = mysqli_query($connect, $sql);
		if(!$result) {
			echo "That bai.". mysqli_error($result);
		} else {
?>
		<script language="javascript">                           
		    alert('<?php echo "Cập nhật dữ liệu thành công. Nhấn \'OK\' để chuyển đến trang THÔNG TIN TÀI KHOẢN." ?>');
	 	</script>
<?php
		$url = "user.php";
		echo "<meta http-equiv='refresh' content='0;url=$url' />";
		}
	}
?>
<!doctype html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Thông tin tài khoản người dùng</title>
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

	<div class="inner-header">
		<div class="container">
			
			<div class="pull-right">
				
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<!-- Lấy thông tin người dùng có user_id -->

	<?php
		$sql = "SELECT * FROM user WHERE user_mail = '$userID'";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	?>

	<div class="container">
		<div id="content">
			<form action="#" method="post" class="beta-form-checkout">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Thông tin tài khoản : <span style="color: #33cc33; font-size: 30px"><?php echo $row['user_mail']?></span></h4>
						<div class="space20">&nbsp;</div>
						<div class="form-block">
							<label for="email">Tên người dùng</label>
							<input type="text" name="user_fullname" value="<?php echo $row['user_fullname']?>" required>
						</div>

						<div class="form-block">
							<label for="adress">Địa chỉ</label>
							<input type="text" id="adress" name="user_address" value="<?php echo $row['user_address']?>" name="customer_add" required>
						</div>

						<div class="form-block">
							<label for="phone">Số điện thoại</label>
							<input type="text" id="phone" name="user_phone" value="<?php echo $row['user_phone']?>" required>
						</div>

						<div class="form-block">
							<label for="phone">Mật khẩu</label>
							<input type="text" id="phone" name="user_password" value="<?php echo $row['user_password']?>" required>
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