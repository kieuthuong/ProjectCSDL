<?php
	require('connectdb.php');
	session_start();
?>

<?php
    $errMsg = '';
    if (isset($_POST["signup"])) {
    	$uid = $_POST["user_mail"];
    	$fullname = $_POST["user_fullname"];
    	$pwd1 = $_POST["user_password1"];
    	$pwd2 = $_POST["user_password2"];
    	$phone = $_POST["user_phone"];
    	$address = $_POST["user_address"];

    	if ($pwd1 != $pwd2){
?>
			<script language="javascript">                           
    	    	alert('<?php echo "Đăng kí thất bại. Password chưa đúng!!!"; ?>');                                                    
     		</script>

<?php  
		 $url="signup.php";
        echo "<meta http-equiv='refresh' content='0;url=$url' />"; 		
    	} else{

    	$sql = "INSERT INTO `user` (`user_mail`, `user_password`, `user_phone`, `user_fullname`, `user_address`)
    			VALUES ('$uid', '$pwd1', '$phone', '$fullname', '$address');";

		$result = mysqli_query($connect, $sql);
		if ($result) {
?>

			<script language="javascript">                           
    	    	alert('<?php echo "Đăng kí thành công!"; ?>');                                                    
     		</script>

<?php
		$_SESSION['user_fullname'] = $fullname;
		$_SESSION['user_id'] = $uid;
        $url="home.php";
        echo "<meta http-equiv='refresh' content='0;url=$url' />";
    	} else {
?>    		
		<script language="javascript">                           
    	    	alert('<?php echo "Đăng kí thất bại. Địa chỉ email đã tồn tại!!!"; ?>');                                                    
     		</script>

<?php   } 		
    }
}

?>

<!doctype html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng kí</title>
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
						<li><a href="signup.php">Đăng kí</a></li>
						<li><a href="login.php">Đăng nhập</a></li>
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
				<h6 class="inner-title">Đăng kí</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="home.php">Trang chủ</a> / <span>Đăng kí</span>
				</div>
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
						<h4>Đăng kí</h4>
						<div class="space20">&nbsp;</div>

						
						<div class="form-block">
							<label for="email">Địa chỉ email*</label>
							<input type="email" id="email" name="user_mail" required>
						</div>

						<div class="form-block">
							<label for="your_last_name">Tên đầy đủ*</label>
							<input type="text" id="your_last_name" name="user_fullname" required>
						</div>

						<div class="form-block">
							<label for="adress">Địa chỉ*</label>
							<input type="text" id="adress" value="Thành phố" name="user_address" required>
						</div>

						<div class="form-block">
							<label for="phone">Số điện thoại*</label>
							<input type="text" id="phone" name="user_phone" required>
						</div>

						<div class="form-block">
							<label for="phone">Mật khẩu*</label>
							<input style="height: 35px" type="password" id="phone" name="user_password1" required>
						</div>

						<div class="form-block">
							<label for="phone">Nhập lại mật khẩu*</label>
							<input style="height: 35px" type="password" id="phone" name="user_password2" required>
						</div>

						<div class="form-block">
							<button type="submit" class="btn btn-primary" name="signup">Đăng kí</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->

	<div class="copyright">
		<div class="container">
			<p class="pull-left">Dự án môn cơ sở dữ liệu</p>
			<p class="pull-right pay-options">
				<!-- <a href="#"><img src="assets/dest/images/pay/master.jpg" alt="" /></a> -->
				<!-- <a href="#"><img src="assets/dest/images/pay/pay.jpg" alt="" /></a>
				<a href="#"><img src="assets/dest/images/pay/visa.jpg" alt="" /></a>
				<a href="#"><img src="assets/dest/images/pay/paypal.jpg" alt="" /></a> -->
			</p>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .copyright -->
	

	<!-- include js files -->
	<!-- <script src="assets/dest/js/jquery.js"></script>
	<script src="assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
	<script src="assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
	<script src="assets/dest/vendors/animo/Animo.js"></script>
	<script src="assets/dest/vendors/dug/dug.js"></script>
	<script src="assets/dest/js/scripts.min.js"></script> -->
	<!--customjs-->
	<!-- <script type="text/javascript">
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
	</script> -->
</body>
</html>