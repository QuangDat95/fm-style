﻿# Host: fmxuong.ovn.vn  (Version 5.5.31)
# Date: 2021-11-12 11:09:49
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "tracnghiem_cauhoi"
#

CREATE TABLE `tracnghiem_cauhoi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDGroup` int(11) DEFAULT '0',
  `Name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Rank` decimal(20,0) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `ma` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NameN` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `IDnhom` int(11) DEFAULT '0',
  `IDloai` int(11) DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `ngaytao` datetime DEFAULT NULL,
  `id_user_sua` int(11) DEFAULT NULL,
  `ngaysua` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "tracnghiem_cauhoi"
#

INSERT INTO `tracnghiem_cauhoi` VALUES (1,0,'Quần rộng nhất là quần gì?','',1,'','B','Quan-rong-nhat-la-quan-gi?',0,0,46,'2019-10-11 08:39:38',46,'2019-10-11 08:43:48'),(2,0,'Có 1 con trâu. Đầu nó thì hướng về hướng mặt trời mọc, nó quay trái 2 vòng sau đó quay ngược lại sau đó lại quay phải hay vòng hỏi cái đuôi của nó chỉ hướng nào?\t','',1,'','A','Co-1-con-trau.-Dau-no-thi-huong-ve-huong-mat-troi-moc,-no-quay-trai-2-vong-sau-do-quay-nguoc-lai-sau-do-lai-quay-phai-hay-vong-hoi-cai-duoi-cua-no-chi-huong-nao?\t',0,0,46,'2019-10-11 08:43:38',NULL,NULL),(3,0,'Con trai có gì quý nhất?','',1,'','B','Con-trai-co-gi-quy-nhat?',0,0,46,'2019-10-11 08:44:18',NULL,NULL),(4,0,'Nắng ba năm ta chưa hề bỏ bạn?','',1,'','D','Nang-ba-nam-ta-chua-he-bo-ban?',0,0,46,'2019-10-11 08:44:50',NULL,NULL),(5,0,'Con đường nào dài nhất?','',1,'','B','Con-duong-nao-dai-nhat?',0,0,46,'2019-10-11 08:45:20',NULL,NULL),(6,0,'Một ly thuỷ tinh đựng đầy nước, làm thế nào để lấy nước dưới đáy ly mà không đổ nước ra ngoài?','',1,'','B','Mot-ly-thuy-tinh-dung-day-nuoc,-lam-the-nao-de-lay-nuoc-duoi-day-ly-ma-khong-do-nuoc-ra-ngoai?',0,0,46,'2019-10-11 08:46:00',NULL,NULL),(7,0,'Cái gì người mua biết, người bán biết, người xài không bao giờ biết?','',1,'','C','Cai-gi-nguoi-mua-biet,-nguoi-ban-biet,-nguoi-xai-khong-bao-gio-biet?',0,0,46,'2019-10-11 08:47:28',NULL,NULL),(8,0,'Con chó đen người ta gọi là con chó mực. Con chó vàng, người ta gọi là con chó phèn. Con chó sanh người ta gọi là con chó đẻ. Vậy con chó đỏ, người ta gọi là con chó gì?','',1,'','B','Con-cho-den-nguoi-ta-goi-la-con-cho-muc.-Con-cho-vang,-nguoi-ta-goi-la-con-cho-phen.-Con-cho-sanh-nguoi-ta-goi-la-con-cho-de.-Vay-con-cho-do,-nguoi-ta-goi-la-con-cho-gi?',0,0,46,'2019-10-11 08:47:59',NULL,NULL),(9,0,'Cơ quan quan trọng nhất của phụ nữ là gì?','',1,'','D','Co-quan-quan-trong-nhat-cua-phu-nu-la-gi?',0,0,46,'2019-10-11 08:48:30',NULL,NULL),(10,0,'1 người đi vào rừng sâu để thám hiểm, thật không may cho ông ta khi bắt gặp 1 con đười ươi rất hung dữ muốn xé xác ông ta ra. Trong tay ông ta có 2 con dao, ông sợ quá vứt 2 con dao ra đó, con đười ươi nhặt lên và sau vài phút nó nằm vật xuống đất chết luôn. Bạn có biết tại sao không?','',1,'','C','1-nguoi-di-vao-rung-sau-de-tham-hiem,-that-khong-may-cho-ong-ta-khi-bat-gap-1-con-duoi-uoi-rat-hung-du-muon-xe-xac-ong-ta-ra.-Trong-tay-ong-ta-co-2-con-dao,-ong-so-qua-vut-2-con-dao-ra-do,-con-duoi-uoi-nhat-len-va-sau-vai-phut-no-nam-vat-xuong-dat-chet-luon.-Ban-co-biet-tai-sao-khong?',0,0,46,'2019-10-11 08:49:48',NULL,NULL),(11,0,'Theo truyền thuyết dân gian, Ông Táo về trời bằng máy bay, tàu lượn siêu tốc hay phi thuyền?','',1,'','D','Theo-truyen-thuyet-dan-gian,-Ong-Tao-ve-troi-bang-may-bay,-tau-luon-sieu-toc-hay-phi-thuyen?',0,0,46,'2019-10-11 08:50:16',NULL,NULL),(12,0,'Con gì đầu dê mình ốc?','',1,'','D','Con-gi-dau-de-minh-oc?',0,0,46,'2019-10-11 08:55:02',NULL,NULL),(13,0,'Có một cây cầu có trọng tải là 10 tấn, có nghĩa là nếu vượt quá trọng tải trên 10 tấn thì cây cầu sẽ sập. Có một chiếc xe tải chở hàng, tổng trọng tải của xe 8 tấn + hàng 4 tấn = 12 tấn. Vậy đố các bạn làm sao bác tài qua được cây cầu này (Không được bớt hàng ra khỏi xe)?','',1,'','A','Co-mot-cay-cau-co-trong-tai-la-10-tan,-co-nghia-la-neu-vuot-qua-trong-tai-tren-10-tan-thi-cay-cau-se-sap.-Co-mot-chiec-xe-tai-cho-hang,-tong-trong-tai-cua-xe-8-tan-+-hang-4-tan-=-12-tan.-Vay-do-cac-ban-lam-sao-bac-tai-qua-duoc-cay-cau-nay-(Khong-duoc-bot-hang-ra-khoi-xe)?',0,0,46,'2019-10-11 08:56:10',NULL,NULL),(14,0,'Bạn có thể kể ra ba ngày liên tiếp mà không có tên là thứ hai, thứ ba, thứ tư, thứ năm, thứ sáu, thứ bảy, chủ nhật?','',1,'','C','Ban-co-the-ke-ra-ba-ngay-lien-tiep-ma-khong-co-ten-la-thu-hai,-thu-ba,-thu-tu,-thu-nam,-thu-sau,-thu-bay,-chu-nhat?',0,0,46,'2019-10-11 08:57:45',NULL,NULL),(15,0,'Có 1 bà kia không biết bơi, xuống nước là bả chết. Một hôm bà đi tàu, bỗng nhiên tàu chìm, nhưng bà không chết. Tại sao (không ai cứu hết)?','',1,'','B','Co-1-ba-kia-khong-biet-boi,-xuong-nuoc-la-ba-chet.-Mot-hom-ba-di-tau,-bong-nhien-tau-chim,-nhung-ba-khong-chet.-Tai-sao-(khong-ai-cuu-het)?',0,0,46,'2019-10-11 08:59:05',46,'2019-10-11 08:59:13'),(16,0,'Con gì đập thì sống, không đập thì chết?','',1,'','D','Con-gi-dap-thi-song,-khong-dap-thi-chet?',0,0,46,'2019-10-11 09:00:24',NULL,NULL),(17,0,'Cái gì đánh cha, đánh má, đánh anh, đánh chị, đánh em?','',1,'','A','Cai-gi-danh-cha,-danh-ma,-danh-anh,-danh-chi,-danh-em?',0,0,46,'2019-10-11 09:01:10',NULL,NULL),(18,0,'Cái gì đánh cha, đánh má, đánh anh, đánh chị, đánh em?','',1,'','A','Cai-gi-danh-cha,-danh-ma,-danh-anh,-danh-chi,-danh-em?',0,0,46,'2019-10-11 09:01:11',NULL,NULL),(19,0,'con vịt đi trước 2 con vịt, 2 con vịt đi sau 2 con vịt, 2 con vịt đi giữa 2 con vịt. Hỏi có mấy con vịt?','',1,'','A','con-vit-di-truoc-2-con-vit,-2-con-vit-di-sau-2-con-vit,-2-con-vit-di-giua-2-con-vit.-Hoi-co-may-con-vit?',0,0,46,'2019-10-11 09:01:37',NULL,NULL),(20,0,'Cái gì của người con gái lúc nào cũng ẩm ướt?','',1,'','D','Cai-gi-cua-nguoi-con-gai-luc-nao-cung-am-uot?',0,0,46,'2019-10-11 09:02:18',NULL,NULL),(21,0,'Có 1 đàn chuột điếc đi ngang qua, hỏi có mấy con?','',1,'','D','Co-1-dan-chuot-diec-di-ngang-qua,-hoi-co-may-con?',0,0,46,'2019-10-11 09:02:49',NULL,NULL);

#
# Structure for table "tracnghiem_dapan"
#

CREATE TABLE `tracnghiem_dapan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDGroup` int(11) DEFAULT '0',
  `Name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Rank` decimal(20,0) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `ma` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NameN` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `IDnhom` int(11) DEFAULT '0',
  `IDloai` int(11) DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `ngaytao` datetime DEFAULT NULL,
  `id_user_sua` int(11) DEFAULT NULL,
  `ngaysua` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "tracnghiem_dapan"
#

INSERT INTO `tracnghiem_dapan` VALUES (1,1,'Quần tây','',1,'','B','Quan-rong-nhat-la-quan-gi?',0,1,46,'2019-10-11 08:39:38',46,'2019-10-11 08:43:48'),(2,1,'Quần đảo','',1,'','B','Quan-rong-nhat-la-quan-gi?',0,2,46,'2019-10-11 08:39:38',46,'2019-10-11 08:43:48'),(3,1,'Quần thảo','',1,'','B','Quan-rong-nhat-la-quan-gi?',0,3,46,'2019-10-11 08:39:38',46,'2019-10-11 08:43:48'),(4,1,'Quần quật','',1,'','B','Quan-rong-nhat-la-quan-gi?',0,4,46,'2019-10-11 08:39:38',46,'2019-10-11 08:43:48'),(5,2,'Chỉ xuống đất','',0,'','','',0,1,46,'2019-10-11 08:43:38',NULL,NULL),(6,2,'Chỉ hướng Bắc-Nam','',0,'','','',0,2,46,'2019-10-11 08:43:38',NULL,NULL),(7,2,'Chỉ lên trời','',0,'','','',0,3,46,'2019-10-11 08:43:38',NULL,NULL),(8,2,'Hướng vào trong','',0,'','','',0,4,46,'2019-10-11 08:43:38',NULL,NULL),(9,3,'Bàn tay','',0,'','','',0,1,46,'2019-10-11 08:44:18',NULL,NULL),(10,3,'Ngọc trai','',0,'','','',0,2,46,'2019-10-11 08:44:18',NULL,NULL),(11,3,'Vỏ trai','',0,'','','',0,3,46,'2019-10-11 08:44:18',NULL,NULL),(12,3,'Đôi mắt','',0,'','','',0,4,46,'2019-10-11 08:44:18',NULL,NULL),(13,4,'Cái cây','',0,'','','',0,1,46,'2019-10-11 08:44:50',NULL,NULL),(14,4,'Mặt trăng','',0,'','','',0,2,46,'2019-10-11 08:44:50',NULL,NULL),(15,4,'Mặt trời','',0,'','','',0,3,46,'2019-10-11 08:44:50',NULL,NULL),(16,4,'Cái bóng','',0,'','','',0,4,46,'2019-10-11 08:44:50',NULL,NULL),(17,5,'Đường cao tốc','',0,'','','',0,1,46,'2019-10-11 08:45:20',NULL,NULL),(18,5,'Đường đời','',0,'','','',0,2,46,'2019-10-11 08:45:20',NULL,NULL),(19,5,'Đường tăng','',0,'','','',0,3,46,'2019-10-11 08:45:20',NULL,NULL),(20,5,'Đường tình yêu','',0,'','','',0,4,46,'2019-10-11 08:45:20',NULL,NULL),(21,6,'Uống hết nước','',0,'','','',0,1,46,'2019-10-11 08:46:00',NULL,NULL),(22,6,'Dùng ống hút','',0,'','','',0,2,46,'2019-10-11 08:46:00',NULL,NULL),(23,6,'Đổ nước ra','',0,'','','',0,3,46,'2019-10-11 08:46:00',NULL,NULL),(24,6,'Đập bể ly','',0,'','','',0,4,46,'2019-10-11 08:46:00',NULL,NULL),(25,7,'Cái xe','',0,'','','',0,1,46,'2019-10-11 08:47:28',NULL,NULL),(26,7,'Đôi tất','',0,'','','',0,2,46,'2019-10-11 08:47:28',NULL,NULL),(27,7,'Cái quan tài','',0,'','','',0,3,46,'2019-10-11 08:47:28',NULL,NULL),(28,7,'Ngôi nhà','',0,'','','',0,4,46,'2019-10-11 08:47:28',NULL,NULL),(29,8,'Chó con','',0,'','','',0,1,46,'2019-10-11 08:47:59',NULL,NULL),(30,8,'Chó đỏ','',0,'','','',0,2,46,'2019-10-11 08:47:59',NULL,NULL),(31,8,'Chó thám tử','',0,'','','',0,3,46,'2019-10-11 08:47:59',NULL,NULL),(32,8,'Chó Phú Quốc','',0,'','','',0,4,46,'2019-10-11 08:47:59',NULL,NULL),(33,9,'Hội người mù','',0,'','','',0,1,46,'2019-10-11 08:48:30',NULL,NULL),(34,9,'Hội người cao tuổi','',0,'','','',0,2,46,'2019-10-11 08:48:30',NULL,NULL),(35,9,'Tuyến giáp','',0,'','','',0,3,46,'2019-10-11 08:48:30',NULL,NULL),(36,9,'Hội Liên Hiệp Phụ Nữ','',0,'','','',0,4,46,'2019-10-11 08:48:30',NULL,NULL),(37,10,'Nó sợ nên chết','',0,'','','',0,1,46,'2019-10-11 08:49:48',NULL,NULL),(38,10,'Nó bỏ chạy','',0,'','','',0,2,46,'2019-10-11 08:49:48',NULL,NULL),(39,10,'Nó cầm dao và đâm vào ngực nó','',0,'','','',0,3,46,'2019-10-11 08:49:48',NULL,NULL),(40,10,'Nó lại gần người đàn ông cầm dao đâm nó','',0,'','','',0,4,46,'2019-10-11 08:49:48',NULL,NULL),(41,11,'Máy bay','',0,'','','',0,1,46,'2019-10-11 08:50:16',NULL,NULL),(42,11,'Tàu lượn','',0,'','','',0,2,46,'2019-10-11 08:50:16',NULL,NULL),(43,11,'Tàu vũ trụ','',0,'','','',0,3,46,'2019-10-11 08:50:16',NULL,NULL),(44,11,'Cá chép','',0,'','','',0,4,46,'2019-10-11 08:50:16',NULL,NULL),(45,12,'Con cá sấu','',0,'','','',0,1,46,'2019-10-11 08:55:02',NULL,NULL),(46,12,'Con Ngựa','',0,'','','',0,2,46,'2019-10-11 08:55:02',NULL,NULL),(47,12,'Con ốc','',0,'','','',0,3,46,'2019-10-11 08:55:02',NULL,NULL),(48,12,'Con dốc','',0,'','','',0,4,46,'2019-10-11 08:55:02',NULL,NULL),(49,13,'Bác tài cứ đi qua thôi, còn xe ở lại','',0,'','','',0,1,46,'2019-10-11 08:56:10',NULL,NULL),(50,13,'Bác tài ở lại, xe chạy qua cho nhẹ','',0,'','','',0,2,46,'2019-10-11 08:56:10',NULL,NULL),(51,13,'Bác tài và xe đi đường khác','',0,'','','',0,3,46,'2019-10-11 08:56:10',NULL,NULL),(52,13,'Bác tài chạy xuống sông','',0,'','','',0,4,46,'2019-10-11 08:56:10',NULL,NULL),(53,14,'Monday, Tuesday, Wednesday','',0,'','','',0,1,46,'2019-10-11 08:57:45',NULL,NULL),(54,14,'Thứ 2, Thứ 3, Thứ 4','',0,'','','',0,2,46,'2019-10-11 08:57:45',NULL,NULL),(55,14,'Hôm qua, hôm nay và ngày mai','',0,'','','',0,3,46,'2019-10-11 08:57:45',NULL,NULL),(56,14,'Chủ nhật, thứ 2, thứ ba','',0,'','','',0,4,46,'2019-10-11 08:57:45',NULL,NULL),(57,15,'Bà ấy nổi lên mặt nước','',1,'','B','Co-1-ba-kia-khong-biet-boi,-xuong-nuoc-la-ba-chet.-Mot-hom-ba-di-tau,-bong-nhien-tau-chim,-nhung-ba-khong-chet.-Tai-sao-(khong-ai-cuu-het)?',0,1,46,'2019-10-11 08:59:05',46,'2019-10-11 08:59:13'),(58,15,'Bà ấy đi tàu ngầm','',1,'','B','Co-1-ba-kia-khong-biet-boi,-xuong-nuoc-la-ba-chet.-Mot-hom-ba-di-tau,-bong-nhien-tau-chim,-nhung-ba-khong-chet.-Tai-sao-(khong-ai-cuu-het)?',0,2,46,'2019-10-11 08:59:05',46,'2019-10-11 08:59:13'),(59,15,'Bà ấy đang ngủ','',1,'','B','Co-1-ba-kia-khong-biet-boi,-xuong-nuoc-la-ba-chet.-Mot-hom-ba-di-tau,-bong-nhien-tau-chim,-nhung-ba-khong-chet.-Tai-sao-(khong-ai-cuu-het)?',0,3,46,'2019-10-11 08:59:05',46,'2019-10-11 08:59:13'),(60,15,'Bà ấy đang mơ','',1,'','B','Co-1-ba-kia-khong-biet-boi,-xuong-nuoc-la-ba-chet.-Mot-hom-ba-di-tau,-bong-nhien-tau-chim,-nhung-ba-khong-chet.-Tai-sao-(khong-ai-cuu-het)?',0,4,46,'2019-10-11 08:59:05',46,'2019-10-11 08:59:13'),(61,16,'Con muỗi','',0,'','','',0,1,46,'2019-10-11 09:00:24',NULL,NULL),(62,16,'Con Quỷ','',0,'','','',0,2,46,'2019-10-11 09:00:24',NULL,NULL),(63,16,'Con lật đật','',0,'','','',0,3,46,'2019-10-11 09:00:24',NULL,NULL),(64,16,'Con tim','',0,'','','',0,4,46,'2019-10-11 09:00:24',NULL,NULL),(65,17,'Bàn chải đánh răng','',0,'','','',0,1,46,'2019-10-11 09:01:10',NULL,NULL),(66,17,'Cái tay','',0,'','','',0,2,46,'2019-10-11 09:01:10',NULL,NULL),(67,17,'Cái mặt nạ','',0,'','','',0,3,46,'2019-10-11 09:01:10',NULL,NULL),(68,17,'Cái túi bóng','',0,'','','',0,4,46,'2019-10-11 09:01:10',NULL,NULL),(69,18,'Bàn chải đánh răng','',0,'','','',0,1,46,'2019-10-11 09:01:11',NULL,NULL),(70,18,'Cái tay','',0,'','','',0,2,46,'2019-10-11 09:01:11',NULL,NULL),(71,18,'Cái mặt nạ','',0,'','','',0,3,46,'2019-10-11 09:01:11',NULL,NULL),(72,18,'Cái túi bóng','',0,'','','',0,4,46,'2019-10-11 09:01:11',NULL,NULL),(73,19,'4 con','',0,'','','',0,1,46,'2019-10-11 09:01:37',NULL,NULL),(74,19,'5 con','',0,'','','',0,2,46,'2019-10-11 09:01:37',NULL,NULL),(75,19,'6 con','',0,'','','',0,3,46,'2019-10-11 09:01:37',NULL,NULL),(76,19,'10 con','',0,'','','',0,4,46,'2019-10-11 09:01:37',NULL,NULL),(77,20,'Cái tay','',0,'','','',0,1,46,'2019-10-11 09:02:18',NULL,NULL),(78,20,'Cái chân','',0,'','','',0,2,46,'2019-10-11 09:02:18',NULL,NULL),(79,20,'Cái mũi','',0,'','','',0,3,46,'2019-10-11 09:02:18',NULL,NULL),(80,20,'Cái lưỡi','',0,'','','',0,4,46,'2019-10-11 09:02:18',NULL,NULL),(81,21,'10','',0,'','','',0,1,46,'2019-10-11 09:02:49',NULL,NULL),(82,21,'12','',0,'','','',0,2,46,'2019-10-11 09:02:49',NULL,NULL),(83,21,'22','',0,'','','',0,3,46,'2019-10-11 09:02:49',NULL,NULL),(84,21,'24','',0,'','','',0,4,46,'2019-10-11 09:02:49',NULL,NULL);

#
# Structure for table "tracnghiem_ketqua"
#

CREATE TABLE `tracnghiem_ketqua` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDGroup` int(11) DEFAULT '0',
  `Name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Rank` decimal(20,0) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `ma` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NameN` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `IDnhom` int(11) DEFAULT '0',
  `IDloai` int(11) DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `ngaytao` datetime DEFAULT NULL,
  `id_user_sua` int(11) DEFAULT NULL,
  `ngaysua` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "tracnghiem_ketqua"
#

INSERT INTO `tracnghiem_ketqua` VALUES (1,0,NULL,NULL,NULL,'1@#@1@#@B@$$@2@#@3@#@B@$$@3@#@8@#@A@$$@4@#@14@#@B@$$@5@#@9@#@B@$$@6@#@5@#@C@$$@7@#@19@#@C@$$@8@#@13@#@B@$$@9@#@11@#@A@$$@10@#@10@#@D@$$@','2','Kém',20,10,1,'2019-10-12 10:45:51',NULL,NULL),(2,0,NULL,NULL,NULL,'1@#@8@#@B@$$@2@#@3@#@B@$$@3@#@19@#@A@$$@4@#@11@#@D@$$@5@#@12@#@D@$$@6@#@7@#@C@$$@7@#@2@#@A@$$@8@#@20@#@D@$$@9@#@17@#@A@$$@10@#@9@#@D@$$@','10','Rất Tốt',100,10,1,'2019-10-12 10:46:11',NULL,NULL),(3,0,NULL,NULL,NULL,'1@#@14@#@C@$$@2@#@18@#@C@$$@3@#@1@#@C@$$@4@#@8@#@C@$$@5@#@4@#@C@$$@6@#@19@#@C@$$@7@#@15@#@C@$$@8@#@16@#@C@$$@9@#@10@#@C@$$@10@#@12@#@C@$$@','2','Kém',20,10,1,'2019-10-12 10:46:18',NULL,NULL),(4,0,NULL,NULL,NULL,'1@#@5@#@D@$$@2@#@13@#@D@$$@3@#@21@#@D@$$@4@#@7@#@D@$$@5@#@16@#@D@$$@6@#@4@#@D@$$@7@#@20@#@D@$$@8@#@9@#@D@$$@9@#@15@#@D@$$@10@#@12@#@D@$$@','6','Khá',60,10,1,'2019-10-12 10:46:28',NULL,NULL),(5,0,NULL,NULL,NULL,'1@#@18@#@B@$$@2@#@17@#@B@$$@3@#@12@#@B@$$@4@#@3@#@B@$$@5@#@21@#@B@$$@6@#@8@#@B@$$@7@#@4@#@B@$$@8@#@9@#@B@$$@9@#@11@#@B@$$@10@#@1@#@B@$$@','3','Kém',30,10,1,'2019-10-12 10:46:38',NULL,NULL),(6,0,NULL,NULL,NULL,'1@#@3@#@A@$$@2@#@8@#@A@$$@3@#@7@#@A@$$@4@#@16@#@A@$$@5@#@9@#@A@$$@6@#@15@#@A@$$@7@#@18@#@A@$$@8@#@13@#@A@$$@9@#@12@#@A@$$@10@#@10@#@A@$$@','2','Kém',20,10,1,'2019-10-12 10:46:46',NULL,NULL),(7,0,NULL,NULL,NULL,'1@#@18@#@A@$$@2@#@6@#@A@$$@3@#@7@#@A@$$@4@#@14@#@A@$$@5@#@17@#@A@$$@6@#@8@#@A@$$@7@#@2@#@A@$$@8@#@11@#@A@$$@9@#@16@#@A@$$@10@#@13@#@A@$$@','4','Trung bình',40,10,1,'2019-10-12 10:46:55',NULL,NULL),(8,0,NULL,NULL,NULL,'1@#@12@#@B@$$@2@#@1@#@B@$$@3@#@13@#@B@$$@4@#@20@#@B@$$@5@#@3@#@B@$$@6@#@10@#@C@$$@7@#@17@#@B@$$@8@#@16@#@B@$$@9@#@6@#@B@$$@10@#@5@#@B','5','Trung bình',50,10,1,'2019-10-12 10:56:29',NULL,NULL),(10,0,NULL,NULL,NULL,'1@#@6@#@A@$$@2@#@10@#@C@$$@3@#@21@#@C@$$@4@#@19@#@C@$$@5@#@7@#@B@$$@6@#@14@#@B@$$@7@#@18@#@B@$$@8@#@1@#@C@$$@9@#@9@#@C@$$@10@#@13@#@D','1','Quá kém',10,10,46,'2019-10-12 11:06:03',NULL,NULL),(11,0,NULL,NULL,NULL,'1@#@20@#@D@$$@2@#@18@#@A@$$@3@#@12@#@D@$$@4@#@15@#@B@$$@5@#@14@#@C@$$@6@#@19@#@A@$$@7@#@13@#@A@$$@8@#@4@#@D@$$@9@#@16@#@D@$$@10@#@8@#@B','10','Rất Tốt',100,10,46,'2019-10-12 11:06:36',NULL,NULL),(12,0,NULL,NULL,NULL,'1@#@1@#@B@$$@2@#@12@#@D@$$@3@#@3@#@B@$$@4@#@6@#@B@$$@5@#@20@#@D@$$@6@#@7@#@C@$$@7@#@11@#@D@$$@8@#@9@#@D@$$@10@#@18@#@A@$$@','9','Rất Tốt',90,10,1,'2019-10-12 20:16:39',NULL,NULL),(13,0,NULL,NULL,NULL,'1@#@18@#@A@$$@2@#@10@#@C@$$@3@#@2@#@C@$$@4@#@12@#@D@$$@5@#@8@#@B@$$@6@#@1@#@B@$$@10@#@14@#@C@$$@','6','Khá',60,10,1,'2019-10-12 20:18:14',NULL,NULL),(14,0,NULL,NULL,NULL,'1@#@16@#@B@$$@2@#@10@#@C@$$@3@#@11@#@C@$$@4@#@6@#@C@$$@5@#@5@#@B@$$@6@#@12@#@B@$$@7@#@21@#@B@$$@8@#@9@#@B@$$@9@#@2@#@B@$$@10@#@1@#@B','3','Kém',30,10,1,'2019-11-15 14:11:30',NULL,NULL),(15,0,NULL,NULL,NULL,'1@#@3@#@B@$$@2@#@20@#@C@$$@3@#@15@#@B@$$@4@#@11@#@B@$$@5@#@6@#@B@$$@6@#@9@#@B@$$@7@#@21@#@C@$$@8@#@8@#@C@$$@9@#@19@#@C@$$@10@#@10@#@C','4','Trung bình',40,10,1,'2020-03-10 20:23:56',NULL,NULL),(16,0,NULL,NULL,NULL,'1@#@9@#@B@$$@2@#@19@#@B@$$@3@#@21@#@C@$$@4@#@16@#@C@$$@5@#@10@#@D@$$@','0','Quá kém',0,10,1,'2020-05-22 10:56:24',NULL,NULL),(17,0,NULL,NULL,NULL,'1@#@7@#@C@$$@2@#@19@#@C@$$@3@#@10@#@C@$$@4@#@17@#@D@$$@5@#@4@#@C@$$@6@#@5@#@B@$$@7@#@11@#@A@$$@10@#@16@#@B@$$@','3','Kém',30,10,1,'2020-06-14 21:31:36',NULL,NULL),(18,0,NULL,NULL,NULL,'1@#@5@#@A@$$@2@#@15@#@B@$$@3@#@10@#@D@$$@4@#@18@#@B@$$@5@#@3@#@A@$$@6@#@16@#@B@$$@7@#@13@#@C@$$@8@#@20@#@B@$$@9@#@19@#@A@$$@10@#@7@#@C','3','Kém',30,10,1,'2020-06-14 21:42:46',NULL,NULL),(19,0,NULL,NULL,NULL,'','0','Quá kém',0,10,1,'2020-06-15 08:31:43',NULL,NULL),(20,0,NULL,NULL,NULL,'','0','Quá kém',0,10,1,'2020-06-15 10:39:47',NULL,NULL),(21,0,NULL,NULL,NULL,'','0','Quá kém',0,10,1,'2020-06-15 10:44:01',NULL,NULL),(22,0,NULL,NULL,NULL,'','0','Quá kém',0,10,1,'2020-06-15 10:50:46',NULL,NULL);