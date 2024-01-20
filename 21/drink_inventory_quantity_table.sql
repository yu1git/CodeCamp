-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2024 年 1 月 20 日 11:49
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
-- テーブルの構造 `drink_inventory_quantity_table`
--

CREATE TABLE `drink_inventory_quantity_table` (
  `drink_id` int(10) NOT NULL,
  `quantit` int(10) NOT NULL,
  `created_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `drink_inventory_quantity_table`
--
ALTER TABLE `drink_inventory_quantity_table`
  ADD KEY `drink_id` (`drink_id`);

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `drink_inventory_quantity_table`
--
ALTER TABLE `drink_inventory_quantity_table`
  ADD CONSTRAINT `drink_inventory_quantity_table_ibfk_1` FOREIGN KEY (`drink_id`) REFERENCES `drink_table` (`drink_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
