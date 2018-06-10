<?php
	require('connectdb.php');
	require('getURL.php');
	session_start();
?>

<?php
    $errMsg = '';
    if (isset($_POST["add"])) {
    	$bookName = $_POST["bookName"];
    	$bookAuthor = $_POST["bookAuthor"];
    	$bookCategory = $_POST["bookCategory"];
    	// Đoạn code này để truy vấn thể loại sách
    	// Nếu đã tồn tại thì lấy ra ID thể loại sách
    	// Nếu chưa tồn tại thì thêm thể loại sách mới rồi lấy ra ID của nó
    	$sql = "SELECT * FROM category
    			WHERE category_name = '$bookCategory'";
    	$result = mysqli_query($connect, $sql);
    	if (mysqli_num_rows($result) > 0) {
    		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    		$bookCategoryId = $row['category_id'];
    	} else {
    		$sql = "INSERT INTO `category` (`category_id`, `category_name`) VALUES (NULL, '$bookCategory')";
    		if (mysqli_query($connect, $sql)) {
				$sql = "SELECT * FROM category
						WHERE category_name = '$bookCategory'";
				if (mysqli_query($connect, $sql)) {
					$result = mysqli_query($connect, $sql);
				} else {
					die("Error.<br/>". mysqli_error($connect));
				}

				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	    		$bookCategoryId = $row['category_id'];
			} else {
				die("Error.<br/>". mysqli_error($connect));
			}
    	}

    	$bookPrice = $_POST["bookPrice"];
    	$bookDescription = $_POST["bookDescription"];
    	$bookPage = $_POST["bookPage"];
    	$bookQuantity = $_POST["bookQuantity"];
    	$bookNXB = $_POST["bookNXB"];
    	date_default_timezone_set('Asia/Ho_Chi_Minh');
		$dateCreat = date("Y/m/d H:i:s");
    	$bookImage = "assets/dest/images/products/".$_POST["bookImage"];
    	$sql = "INSERT INTO `book` (`book_id`, `book_name`, `book_author`, `book_price`, `book_description`, `book_image`, `book_view`, `book_category_id`, `book_new`, `book_page`, `book_quantity`, `book_nsx`, `created_at`, `updated_at`) 
    			VALUES (NULL, '$bookName', '$bookAuthor', 'bookPrice', '$bookDescription', '$bookImage', '0', '$bookCategoryId', '1', '$bookPage', '$bookQuantity', '$bookNXB', '$dateCreat', '$dateCreat')";
    	$result = mysqli_query($connect, $sql);
    	if ($result){
?>
	
		    <script language="javascript">                           
	    	    alert('<?php echo "Thêm dữ liệu thành công. Nhấn \'OK\' để tiếp tục." ?>');                                                    
	     	</script>

<?php    		
    	} else {
?>

			<script language="javascript">                           
	    	    alert('<?php echo "Thêm dữ liệu thất bại." ?>');                                                    
	     	</script>

<?php
		}
	}
?>

<!doctype html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Thêm sản phẩm</title>
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
						<li><a href="order.php">Đơn Hàng</a></li>
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
	
	<div class="container">
		<div id="content">
			
			<form action="#" method="post" class="beta-form-checkout">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Thông tin</h4>
						<div class="space20">&nbsp;</div>

						
						<div class="form-block">
							<label for="email">Tên sách*</label>
							<input type="text" id="bookName" name="bookName" required>
						</div>

						<div class="form-block">
							<label for="your_last_name">Tác giả*</label>
							<input type="text" id="your_last_name" name="bookAuthor" required>
						</div>

						<div class="form-block">
							<label for="your_last_name">Thể loại*</label>
							<input type="text" id="your_last_name" name="bookCategory" required>
						</div>

						<div class="form-block">
							<label for="adress">Giá</label>
							<input type="text" id="adress" value="" name="bookPrice" required>
						</div>

						<div class="form-block">
							<label for="phone">Số lượng</label>
							<input type="text" id="phone" name="bookQuantity" required>
						</div>

						<div class="form-block">
							<label for="phone">Mô tả</label>
							<input type="text" id="phone" name="bookDescription" required>
						</div>
						
						<div class="form-block">
							<label for="phone">Số trang</label>
							<input type="text" id="phone" name="bookPage" required>
						</div>
						<div class="form-block">
							<label for="phone">Nhà xuất bản</label>
							<input type="text" id="phone" name="bookNXB" required>
						</div>
						<div class="form-block" >
							<label for="phone">Ảnh</label>
							<input type="file" id="phone" name="bookImage" required>
						</div>
						<div class="form-block">
							<button type="submit" name="add" class="btn btn-primary"> THÊM </button>
							
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->	
</body>

</html>