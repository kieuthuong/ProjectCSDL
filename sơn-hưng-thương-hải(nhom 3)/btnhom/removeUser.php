<?php
	require('connectdb.php');
	require('getURL.php');
	session_start();

	$userID = $_GET["user_id"];
	$sql = "DELETE FROM `order_item` WHERE `order_item`.`user_mail` = '$userID';";
	$result = mysqli_query($connect, $sql);
	$sql = "DELETE FROM `order_customer` WHERE `order_customer`.`user_mail` = '$userID';";
	$result = mysqli_query($connect, $sql);
	$sql = "DELETE FROM `user` WHERE `user`.`user_mail` = '$userID';";
	$result = mysqli_query($connect, $sql);
	if($result) {
?>
		<script language="javascript">                           
			alert('<?php echo "Đã xoá thành công. Nhấn \"OK\" để quay lại trang THÔNG TIN TÀI KHOẢN." ?>');                   
		</script>
<?php
		$url="user.php";
		echo "<meta http-equiv='refresh' content='0;url=$url' />";
	} else {
?>
		<script language="javascript">                           
			alert('<?php echo "Thất bại. Đã có lỗi xảy ra!!!" ?>');                   
		</script>

<?php
	echo "That bai". mysqli_error($result);
	}
?>