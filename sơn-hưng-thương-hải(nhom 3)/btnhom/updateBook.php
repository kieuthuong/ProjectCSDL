<?php
	require('connectdb.php');
	require('getURL.php');
	session_start();
?>

<?php
	$bookID = $_GET["book_id"];
    $errMsg = '';
    if (isset($_POST["update"])) {
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
    	$bookStatus = $_POST["bookStatus"];
    	if ($bookStatus == "Mới") $bookNew = 1;
    	else $bookNew = 0;
    	$bookPrice = $_POST["bookPrice"];
    	$bookDescription = $_POST["bookDescription"];
    	$bookPage = $_POST["bookPage"];
    	$bookQuantity = $_POST["bookQuantity"];
    	$bookNXB = $_POST["bookNXB"];
    	date_default_timezone_set('Asia/Ho_Chi_Minh');
		$dateUpdate = date("Y/m/d H:i:s");

    	$sql = "UPDATE `book` SET `book_name` = '$bookName', `book_author` = '$bookAuthor', `book_price` = '$bookPrice', `book_description` = '$bookDescription', `book_category_id` = '$bookCategoryId', `book_new` = '$bookNew', `book_page` = '$bookPage', `book_quantity` = '$bookQuantity', `book_nsx` = '$bookNXB', `updated_at` = '$dateUpdate' WHERE `book`.`book_id` = $bookID";
    	$result = mysqli_query($connect, $sql);
    	if ($result){
?>
	
		    <script language="javascript">                           
	    	    alert('<?php echo "Cập nhật dữ liệu thành công. Nhấn \'OK\' để quay về trang ADMIN." ?>');                                                
	     	</script>

<?php 
			$url="admin.php";
			echo "<meta http-equiv='refresh' content='0;url=$url' />";   		
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
	<title>Cập nhật thông tin sách</title>
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
						<!-- Truy vấn thông tin sách -->
						<?php
							$sql = "SELECT * FROM book, category WHERE book_category_id = category_id AND book_id = $bookID";
							$result = mysqli_query($connect, $sql);
							$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
						?>
						
						<div class="form-block">
							<label for="email">Tên sách*</label>
							<input type="text" id="bookName" name="bookName" value="<?php echo $row['book_name']?>" required>
						</div>

						<div class="form-block">
							<label for="your_last_name">Tác giả*</label>
							<input type="text" id="your_last_name" name="bookAuthor" value="<?php echo $row['book_author']?>" required>
						</div>

						<div class="form-block">
							<label for="your_last_name">Thể loại*</label>
							<input type="text" id="your_last_name" name="bookCategory" value="<?php echo $row['category_name']?>" required>
						</div>

						<div class="form-block">
							<label for="adress">Giá</label>
							<input type="text" id="adress" value="<?php echo $row['book_price']?>" name="bookPrice" required>
						</div>

						<div class="form-block">
							<label for="phone">Số lượng</label>
							<input type="text" id="phone" name="bookQuantity" value="<?php echo $row['book_quantity']?>" required>
						</div>

						<div class="form-block">
							<label for="phone">Mô tả</label>
							<input type="text" id="phone" name="bookDescription" value="<?php echo $row['book_description']?>" required>
						</div>
						
						<div class="form-block">
							<label for="phone">Số trang</label>
							<input type="text" id="phone" name="bookPage" value="<?php echo $row['book_page']?>" required>
						</div>
						<div class="form-block">
							<label for="phone">Nhà xuất bản</label>
							<input type="text" id="phone" name="bookNXB" value="<?php echo $row['book_nsx']?>" required>
						</div>
						<div class="form-block">
							<label for="phone">Trạng thái</label>
							<input type="text" id="phone" name="bookStatus" value="<?php if($row['book_new'] == 1) echo "Mới";else echo "Cũ"?>" required>
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