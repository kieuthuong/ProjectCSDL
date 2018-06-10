-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 30, 2017 lúc 06:52 PM
-- Phiên bản máy phục vụ: 10.1.26-MariaDB
-- Phiên bản PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sondb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `book_author` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `book_price` int(20) NOT NULL,
  `book_description` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `book_image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `book_view` int(11) DEFAULT '0',
  `book_category_id` int(11) NOT NULL,
  `book_new` int(11) NOT NULL,
  `book_page` int(11) NOT NULL,
  `book_quantity` int(11) NOT NULL DEFAULT '0',
  `book_nsx` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `book_author`, `book_price`, `book_description`, `book_image`, `book_view`, `book_category_id`, `book_new`, `book_page`, `book_quantity`, `book_nsx`, `created_at`, `updated_at`) VALUES
(1, 'Alice lạc vào xứ sở kì diệu', 'Lewis Carroll', 69000, '“Thần nên bắt đầu từ đâu, thưa Bệ hạ?”“Bắt đầu từ đầu chứ sao, và cứ đọc cho tới hết rồi mới được dừng.” Và biết bao độc giả từ nhỏ đến lớn đã tự nguyện sung sướng tuân theo mệnh lệnh của Vua Cơ, đến nỗi tới cuối thế kỷ 19, cặp đôi truyện phiêu lưu của Alice đã đạt tới một vị trí vượt trội trong kho tàng văn học thiếu nhi, và ngày nay vững chắc trong hàng ngũ kinh điển. Khi đuổi theo Thỏ Trắng xuống hang sâu, cô bé Alice chẳng thể ngờ mình sắp bước vào những cuộc phiêu lưu lạ lùng nhất, đối mặt với những nhân vật vô tiền khoáng hậu, từ các muông thú nhỏ bé đến bộ tú lơ khơ, bàn cờ vua, kẻ sau lập dị hơn kẻ trước - tất cả chỉ có thể được tạo ra bởi bậc thầy của những điều tưởng chừng ngớ ngẩn vô nghĩa: Lewis Carroll. Carroll là một trong số hiếm hoi những nhà văn người lớn thâm nhập thành công vào tâm tưởng trẻ con: nơi những điều không thể thành có thể, không thực thành rất thực, và nơi đỉnh điểm của phiêu lưu chỉ bị giới hạn bởi chiều sâu của trí tưởng tượng.', 'assets/dest/images/products/1.jpg', 100, 2, 1, 296, 1, 'Nhà xuất bản KIm Đồng', '2017-03-11 00:00:00', '2017-12-30 23:00:44'),
(2, 'Harold và bút sáp màu tím', 'Crokett Johnson', 42000, '“Một cuốn sách tranh tinh tế và độc đáo, kể về một cậu nhóc đi dạo dưới ánh trăng, tung tăng tay cầm bút sáp tím, tự vẽ ra cho mình những chuyến phiêu lưu phi thường.”- The Horn Book“Niềm vui nằm ở những tình tiết bước ngoặt bất ngờ khiến người đọc không khỏi ngạc nhiên và bị cuốn hút không thể rời mắt, cùng với khiếu hài hước tuyệt vời.”- The New York Times', 'assets/dest/images/products/2.jpg', 246, 2, 0, 100, 366, 'Nhà xuất bản KIm Đồng', '2017-03-11 00:00:00', '2017-12-27 23:40:56'),
(3, 'Hỏi đáp cùng em', 'Sabine Boccador', 149000, 'Trái đất bao nhiêu tuổi? Ai đã phát minh ra la bàn? Cuốn lịch đầu tiên ra đời năm nào? Vũ trụ có chết không? Có phải hành tinh nào cũng có Mặt trăng vệ tinh? Vì sao dầu không tan trong nước?...Cuốn sách gồm 212 câu hỏi-đápvề những phát minh và khám phá  đã giúp nhân loại tiến \r\nhóa, với 4 chủ đề lớn: Phát minh; Trái đất; Không gian và Hiện tượng thường ngày.\r\nCùng nhiều minh họa sinh động rực rỡ, các em sẽ tự mình khám phá lời giải dễ hiểu cho những câu hỏi lớn về thế giới bao la.\r\nCùng bộ sách\r\n', 'assets/dest/images/products/3.jpg', 70, 3, 0, 110, 381, 'Nhà xuất bản KIm Đồng', '2017-11-03 00:00:00', '2017-11-03 00:00:00'),
(4, 'Những ngày tươi đẹp', 'Jennifer Niven', 109000, 'Ngày hôm nay có phải ngày thích hợp để chết? Từ chỗ gờ tường tháp chuông cách mặt đất sáu tầng nhà, Finch tự hỏi như vậy để bỗng nhận ra cậu không đơn độc, vì phía bên kia tháp chuông, Violet dường như cũng đang có cùng suy nghĩ. Ngày hôm ấy, Finch không rõ cậu đã thuyết phục được Violet lùi lại hay chính sự xuất hiện của Violet đã ngăn cậu nhảy xuống, nhưng tình bạn, tình yêu đã khởi đầu từ đó. Liệu tất cả những điều ấy có đủ để đưa họ trở lại cuộc sống?\r\nNhững ngày tươi đẹp hài hước, lãng mạn nhưng cũng không thiếu những khoảnh khắc nao lòng. Cuốn sách cho ta thấy những gì thực sự diễn ra trong tâm trí của người đang chìm trong hố đen trầm cảm, cho ta biết cảm thông và sống sao cho trọn vẹn từng khoảnh khắc.\r\n', 'assets/dest/images/products/4.jpg', 70, 2, 0, 434, 381, 'Nhà xuất bản KIm Đồng', '2017-03-11 00:00:00', '2017-03-11 00:00:00'),
(5, 'Để con được ốm', 'BS.Nguyễn Trí Đoàn', 80000, 'Trong xã hội hiện nay, khi người mẹ luôn dễ dàng tiếp cận với vô vàn các nguồn thông tin thì việc chăm sóc trẻ đã trở nên dễ dàng nhưng đồng thời lại khó hơn gấp bội. Để con được ốm, do đó, còn hơn cả một cuốn sách thường thức về y khoa xung quanh việc chăm sóc cơ bản cho trẻ giai đoạn 0-2 tuổi. Nó bao hàm một thái độ của bậc làm cha mẹ, rằng để con có thể trưởng thành, con có quyền bị ốm đau, bị mắc bệnh; và vì vậy, có quyền không bị mang ra so sánh... [với con nhà hàng xóm]. Để con được ốm giúp làm đúng lại các quan niệm nuôi con cả cũ lẫn mới, vốn đầy những ngộ nhận và sai lạc, cung cấp các kiến thức y khoa được công bố mới nhất và được nghiên cứu, chứng thực, giúp cho các bậc cha mẹ tự tin hơn trong quá trình nuôi dưỡng một đứa trẻ.', 'assets/dest/images/products/5.jpg', 133, 3, 0, 300, 371, 'Nhà xuất bản KIm Đồng', '2017-11-03 00:00:00', '2017-12-30 22:29:53'),
(6, 'Rừng Na Uy', 'Haruki Murakami', 85000, 'Một cuốn sách ẩn chứa mọi điều khiến bạn phải say mê và đau đớn, tình yêu với muôn vàn màu sắc và cung bậc khác nhau, cảm giác trống rỗng và hẫng hụt của cả một thế hệ thanh niên vô hướng, ý niệm về sự sinh tồn tất yếu của cái chết trong lòng cuộc sống, những gắng gượng âm thầm nhưng quyết liệt của con người để vượt qua mất mát trong đời...Tất cả đã tạo nên vẻ đẹp riêng cho ', 'assets/dest/images/products/6.jpg', 79, 1, 1, 554, 373, 'Nhà xuất bản Kim Đồng', '2017-02-11 00:00:00', '2017-12-27 23:40:41'),
(7, 'Mẹ trẻ chăm con khỏe', 'Fujita Koichiro', 47000, 'Rất nhiều người lo sợ sự xâm nhập của vi khuẩn hay virus, vì vậy họ đã biến môi trường sống của mình trở nên sạch sẽ quá mức, đồng thời dùng thật nhiều chất tẩy rửa để đề phòng. Tuy nhiên, do cha mẹ quá chú trọng việc giữ cho môi trường xung quanh luôn trong trạng thái ít vi khuẩn nên sẽ dẫn đến hệ quả là sức đề kháng của trẻ sẽ ngày càng giảm. Số trẻ mắc các bệnh như hen suyễn, bệnh Atopy, bệnh dị ứng ngày càng gia tăng…\r\nMột cuốn sách bổ ích về nuôi dạy trẻ\r\n', 'assets/dest/images/products/7.jpg', 73, 3, 1, 100, 378, 'Nhà xuất bản KIm Đồng', '2017-11-03 00:00:00', '2017-11-03 00:00:00'),
(8, 'Đời về cơ bản là buồn', 'Lê Bích', 40000, 'Lê Bích – Nhân vật ảo với chiếc bụng phệ, rốn lồi, khuôn mặt luôn tỏ vẻ tư lự, trên thông thiên văn, dưới tường địa lý, tam giáo, cửu lưu, tứ thư, ngũ kinh, tinh thần yêu nước trung trinh, đạo đức lung linh, phong tục, luật lệ, bản quyền, Horoscope, vật lý lượng tử... cái gì Lê Bích cũng tưởng là chàng biết.', 'assets/dest/images/products/8.jpg', 72, 1, 1, 123, 379, 'Nhà xuất bản KIm Đồng', '2017-11-03 00:00:00', '2017-11-03 00:00:00'),
(9, 'Câu chuyện vô hình và đảo', 'Hamvat Béla', 72000, 'Câu chuyện vô hình và Đảo là tập tiểu luận triết học đầu tiên của Hamvas Béla viết vào năm 1943, cũng là tập tiểu luận duy nhất được xuất bản khi ông còn sống. Tác phẩm gồm mười bốn tiểu luận, chia làm hai phần: phần thứ nhất là Câu chuyện vô \r\nhình và phần thứ hai mang tên Đảo. Những tiểu luận của Hamvas Béla được đánh giá là “vượt tầm thời đại”, và “không chỉ quyến rũ bởi bởi đề tài ông lựa chọn hết sức li kỳ và mang đậm hình ảnh tượng trưng mà còn bởi văn phong của ông cực kỳ sinh động, nhiều màu sắc, nội dung dày đặc nhiều tầng như mỏ đá quý, mỗi lúc lại mở ra trước mắt người đọc một tầng miêu tả khác lạ”.\r\n', 'assets/dest/images/products/9.jpg', 248, 2, 1, 134, 378, 'Nhà xuất bản KIm Đồng', '2017-11-03 00:00:00', '2017-11-03 00:00:00'),
(10, 'Máu thời gian', 'Maxime Chattan', 109000, 'Nước Pháp, năm 2005: Nắm giữ một bí mật khiến mạng sống của chính cô bị đe dọa, Marion được bí mật đưa đến lâu đài Mont-Saint-Michel để ở ẩn, chờ đến khi có thể an toàn trở về nhà.\r\n Ai Cập, năm 1928: xác của những đứa trẻ bị cắt xẻo man rợ được tìm thấy trong vùng ngoại ô Cairo, với những dấu vết khiến người ta nghĩ rằng hung thủ không thể là con người mà chỉ có thể là quái vật. Tuy nhiên, viên thám tử phụ trách vụ án không chịu tin theo lời đồn, mà lao vào điều tra để làm rõ chân tướng sự thật.\r\n Hai địa điểm, hai mốc thời gian rất đỗi xa xôi ấy bỗng được gắn kết với nhau bằng một cuốn sổ bí ẩn, để rồi quá khứ và hiện tại đan xen nhau, đưa Marion đến với sự thật hết sức bất ngờ về hung thủ của vụ án.\r\n Nhưng liệu sự thật mà cô tìm ra có hoàn toàn chính xác không? Bởi vì, như Lord Byron từng nói, “sự thật luôn lạ lùng, còn lạ lùng hơn là hư cấu”.\r\n', 'assets/dest/images/products/10.jpg', 70, 2, 0, 234, 381, 'Nhà xuất bản KIm Đồng', '2017-11-03 00:00:00', '2017-11-03 00:00:00'),
(11, 'Trí tuệ Do Thái', 'Eran Katz', 80000, 'Cho đến nay, người Do Thái luôn được gắn với phẩm chất về chất xám và trí tuệ. Thuật ngữ “Bộ óc Do Thái”, dùng để chỉ một người nào đó thật thông thái, đã trở thành cụm từ được sử dụng bởi cả những người Do Thái và người không phải Do Thái. Không còn nghi ngờ gì nữa, Do Thái có lẽ là dân tộc giàu có nhất trên thế giới nếu tính về tài năng. Những cái tên Do Thái nổi bật, chiếm giữ nhiều vị trí quan trọng và có tầm ảnh hưởng lớn trong nhiều lĩnh vực khác nhau. Những số liệu thống kê sau đây cho thấy sự thành công vĩ đại mà dân tộc nhỏ bé này đã đạt được.', 'assets/dest/images/products/11.jpg', 70, 3, 0, 234, 381, 'Nhà xuất bản KIm Đồng', '2017-11-03 00:00:00', '2017-11-03 00:00:00'),
(12, 'Nỗi đau nào rồi cũng sẽ qua', 'Douglas Kennedy', 104000, '\"Nỗi đau nào rồi cũng sẽ qua\" là câu chuyện về những vật lộn cá nhân giữa những bi kịch đời thường, về mất mát và hàn gắn, về tuyệt vọng và tái sinh. Là cha đẻ của các tiểu thuyết Best seller quốc tế, Douglas Kennedy dĩ nhiên chẳng thể quên vài tình tiết gay cấn về cuối truyện để chiều lòng những ai kiếm tìm trải nghiệm đọc nhiều \r\nkịch tính, nhưng rốt cuộc, nhưng rốt cuộc, \"Nỗi đau nào rồi cũng sẽ qua vẫn là cuốn sách phù hợp hơn vào những buổi chiều lặng lẽ riêng tư, như là một người bạn tâm tình hơn là một màn giải trí li kỳ hay rộn rã\r\n', 'assets/dest/images/products/12.jpg', 322, 1, 0, 234, 380, 'Nhà xuất bản KIm Đồng', '2017-11-03 00:00:00', '2017-11-03 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Văn học'),
(2, 'Tiểu thuyết'),
(3, 'Khoa học');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_customer`
--

CREATE TABLE `order_customer` (
  `order_id` int(11) NOT NULL,
  `user_mail` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_add` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_phone` char(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_note` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `totalmoney` int(20) DEFAULT NULL,
  `order_status` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'Đang chờ',
  `order_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `order_customer`
--

INSERT INTO `order_customer` (`order_id`, `user_mail`, `customer_name`, `customer_add`, `customer_phone`, `customer_note`, `totalmoney`, `order_status`, `order_datetime`) VALUES
(455883936, 'hai@gmail.com', 's', 'me so', '097654321', 'dsad', 390000, 'Đang chờ', '2017-12-30 22:27:40'),
(541418742, 'son@gmail.com', 's', 's', 's', 's', 112000, 'Đang chờ', '2017-12-30 22:13:18'),
(736114427, 'son@gmail.com', 's', 's', 's', 's', 85000, 'Đã nhận', '2017-12-30 22:12:23'),
(901616966, 'hai@gmail.com', 's', 's', '1', '1', 47000, 'Đang chờ', '2017-12-30 22:15:25'),
(980977669, 'son@gmail.com', 's', 's', 's', 's', 80000, 'Đang chờ', '2017-12-30 22:12:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_item`
--

CREATE TABLE `order_item` (
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_mail` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `order_item`
--

INSERT INTO `order_item` (`order_id`, `book_id`, `user_mail`, `quantity`) VALUES
(455883936, 1, 'hai@gmail.com', 4),
(455883936, 2, 'hai@gmail.com', 1),
(455883936, 9, 'hai@gmail.com', 1),
(541418742, 8, 'son@gmail.com', 1),
(541418742, 9, 'son@gmail.com', 1),
(736114427, 6, 'son@gmail.com', 1),
(901616966, 7, 'hai@gmail.com', 1),
(980977669, 5, 'son@gmail.com', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `user_fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_mail`, `user_password`, `user_phone`, `user_fullname`, `user_address`) VALUES
('admin@gmail.com', 'admin', '0168424095', 'Admin', 'Hưng Yên'),
('hai@gmail.com', 'hai', '018765532', 'Đỗ Thị Hải', 'Bắc Ninh'),
('son@gmail.com', 'son', '01684240954', 'Dương Ngọc Sơn', 'Hưng Yên');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `book_category_id` (`book_category_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `order_customer`
--
ALTER TABLE `order_customer`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk` (`user_mail`);

--
-- Chỉ mục cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_id`,`book_id`),
  ADD KEY `fk1` (`book_id`),
  ADD KEY `fk2` (`order_id`) USING BTREE,
  ADD KEY `fk3` (`user_mail`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_mail`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `order_customer`
--
ALTER TABLE `order_customer`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;

--
-- AUTO_INCREMENT cho bảng `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`book_category_id`) REFERENCES `category` (`category_id`);

--
-- Các ràng buộc cho bảng `order_customer`
--
ALTER TABLE `order_customer`
  ADD CONSTRAINT `order_customer_ibfk_1` FOREIGN KEY (`user_mail`) REFERENCES `user` (`user_mail`);

--
-- Các ràng buộc cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`order_id`) REFERENCES `order_customer` (`order_id`),
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`user_mail`) REFERENCES `user` (`user_mail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
