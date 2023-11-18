-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2023 年 11 月 18 日 01:50
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `codecamp`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `order_detail_table`
--

CREATE TABLE `order_detail_table` (
  `order_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL COMMENT '数量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `order_detail_table`
--
ALTER TABLE `order_detail_table`
  ADD KEY `goods_id` (`goods_id`),
  ADD KEY `order_id` (`order_id`);

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `order_detail_table`
--
ALTER TABLE `order_detail_table`
  ADD CONSTRAINT `order_detail_table_ibfk_1` FOREIGN KEY (`goods_id`) REFERENCES `goods_table` (`goods_id`),
  ADD CONSTRAINT `order_detail_table_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order_table` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
