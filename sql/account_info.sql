

use test;

CREATE TABLE `account_info` (
  `uid` int(30) NOT NULL AUTO_INCREMENT  COMMENT '流水號',
  `user_account` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '帳號',
  `user_name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '姓名',
  `user_sex` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT '性別',
  `user_birthday` date NOT NULL COMMENT '生日',
  `user_email` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '信箱',
  `memo` text CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `account_info` (`uid`, `user_account`, `user_name`, `user_sex`, `user_birthday`, `user_email`, `memo`) VALUES
(1, 'Abcde2333', '王大明', '1', '2020-05-26', 'aaa@gmail.com', NULL),
(2, 'gFF5556', '林大名', '1', '2020-05-26', 'ffff@gmail.com', NULL),
(7, 'jo77nsle', 'jon', '1', '2020-05-26', 'jon@gmail.com', NULL),
(8, 'KEVIN2', 'kevin', '1', '2020-05-26', 'kevin@gmail.com', NULL),
(9, 'Lin0909', 'lin', '1', '2020-05-26', 'lin@gmail.com', NULL),
(3, 'appl101yCat', '小惠', '0', '2020-05-26', 'okyouuosdhfe@gmail.com', NULL);