-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 10:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chronological_database_sis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_back_order_list`
--

CREATE TABLE `tbl_back_order_list` (
  `back_order_id` int(11) NOT NULL,
  `purchase_item_id` int(11) DEFAULT NULL,
  `quantity_back_ordered` int(11) DEFAULT 0,
  `backorder_expected_delivery_date` date DEFAULT NULL,
  `backorder_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `category_name`, `category_description`, `created_at`, `updated_at`) VALUES
(2, 'Milkteas', 'Sweet', '2025-03-05 03:18:16', '2025-03-05 03:18:16'),
(4, 'Pizza Ingredients', 'for pizza\r\n\r\n', '2025-03-05 03:19:32', '2025-03-05 03:19:32'),
(5, 'Materials Used', 'for finished product and etc', '2025-03-05 03:20:43', '2025-03-05 03:20:43'),
(6, 'Chicken', 'for customers', '2025-03-05 03:22:20', '2025-03-05 03:22:20'),
(7, 'Pork ', 'for customers', '2025-03-05 03:22:34', '2025-03-05 03:22:34'),
(8, 'Seasonings', 'for lamas sa foods', '2025-03-05 03:22:58', '2025-03-05 03:22:58'),
(10, 'Beverages', 'pahilis\r\n', '2025-03-05 03:39:13', '2025-03-05 03:39:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cust_id` int(11) NOT NULL,
  `customer_type` enum('individual','business') NOT NULL,
  `customer_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `hired_date` date DEFAULT NULL,
  `address_info` varchar(255) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`employee_id`, `first_name`, `middle_name`, `last_name`, `email`, `gender`, `hired_date`, `address_info`, `job_id`) VALUES
(5, 'das', 'das', 'dsa', 'dasd@dasdas.com', NULL, '2025-03-04', 'dasdsadsa', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ingredient_usage`
--

CREATE TABLE `tbl_ingredient_usage` (
  `usage_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `raw_ingredient_id` int(11) DEFAULT NULL,
  `usage_quantity_used` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_list`
--

CREATE TABLE `tbl_item_list` (
  `item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_item_list`
--

INSERT INTO `tbl_item_list` (`item_id`, `name`, `description`, `supplier_id`, `employee_id`, `category_id`, `cost`, `status`, `date_created`, `date_updated`) VALUES
(4, 'Milktea Classic', 'A refreshing classic milktea with tapioca pearls', 1, 5, 6, 3.50, 'Active', '2025-03-05 04:06:58', '2025-03-05 04:22:58'),
(5, 'Pizza Dough', 'Freshly prepared pizza dough ready for toppings', 2, 5, 2, 5.00, 'Active', '2025-03-05 04:06:58', '2025-03-05 04:23:02'),
(6, 'BBQ Pork', 'Tender BBQ pork marinated with special spices', 3, 5, 8, 8.00, 'Inactive', '2025-03-05 04:06:58', '2025-03-05 04:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobs`
--

CREATE TABLE `tbl_jobs` (
  `job_id` int(11) NOT NULL,
  `job_name` varchar(255) NOT NULL,
  `job_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jobs`
--

INSERT INTO `tbl_jobs` (`job_id`, `job_name`, `job_created_at`) VALUES
(3, 'dsad', '2025-03-04 13:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `payment_id` int(11) NOT NULL,
  `pos_order_id` int(11) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` enum('cash','credit','debit','gcash','online') NOT NULL,
  `payment_status` enum('pending','completed','failed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pos_orders`
--

CREATE TABLE `tbl_pos_orders` (
  `pos_order_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `cust_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_total_amount` decimal(10,2) DEFAULT NULL,
  `order_status` enum('pending','completed','cancelled') NOT NULL,
  `order_type` enum('qr_code','counter') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pos_order_items`
--

CREATE TABLE `tbl_pos_order_items` (
  `pos_order_item_id` int(11) NOT NULL,
  `pos_order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity_sold` int(11) NOT NULL,
  `item_price` decimal(10,2) DEFAULT NULL,
  `item_total_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_selling_price` decimal(10,2) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT 0,
  `product_restock_qty` int(11) DEFAULT 0,
  `category_id` int(11) DEFAULT NULL,
  `product_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_name`, `product_selling_price`, `product_image`, `product_quantity`, `product_restock_qty`, `category_id`, `product_created_at`, `employee_id`) VALUES
(1, 'Mocha', 120.00, 'product_67c7c53b14bc15.35128939.jpg', 100, 10, 2, '2025-03-05 03:30:03', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_items`
--

CREATE TABLE `tbl_purchase_items` (
  `purchase_item_id` int(11) NOT NULL,
  `purchase_order_id` int(11) DEFAULT NULL,
  `raw_ingredient_id` int(11) DEFAULT NULL,
  `quantity_ordered` int(11) NOT NULL DEFAULT 0,
  `quantity_received` int(11) DEFAULT 0,
  `back_ordered_quantity` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_order_list`
--

CREATE TABLE `tbl_purchase_order_list` (
  `purchase_order_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `purchase_order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('ordered','received','partially_received','back_ordered') NOT NULL,
  `purchase_expected_delivery_date` date DEFAULT NULL,
  `purchase_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_raw_ingredients`
--

CREATE TABLE `tbl_raw_ingredients` (
  `raw_ingredient_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `raw_unit_of_measure` varchar(50) DEFAULT NULL,
  `raw_stock_quantity` int(11) DEFAULT 0,
  `raw_reorder_level` int(11) DEFAULT NULL,
  `raw_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `raw_stock_in` int(11) DEFAULT 0,
  `raw_stock_out` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_raw_ingredients`
--

INSERT INTO `tbl_raw_ingredients` (`raw_ingredient_id`, `item_id`, `raw_unit_of_measure`, `raw_stock_quantity`, `raw_reorder_level`, `raw_created_at`, `raw_stock_in`, `raw_stock_out`) VALUES
(3, 6, 'L', 323, 32, '2025-03-05 08:28:29', 3587, 2147483647),
(4, 4, 'g', 32, 32, '2025-03-05 08:31:10', 0, 0),
(5, 6, 'L', 23464, 323, '2025-03-05 08:35:50', 23232, 0),
(6, 4, 'g', 23, 32, '2025-03-05 09:02:18', 0, 0),
(7, 6, 'g', 23, 32, '2025-03-05 09:20:16', 0, 0),
(8, 4, 'kg', 232, 12, '2025-03-05 09:33:55', 0, 0),
(9, 6, 'kg', 23, 232, '2025-03-05 09:37:38', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receipts`
--

CREATE TABLE `tbl_receipts` (
  `receipt_id` int(11) NOT NULL,
  `pos_order_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `receipt_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `receipt_total_amount` decimal(10,2) DEFAULT NULL,
  `receipt_status` enum('paid','unpaid','refunded') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receiving_list`
--

CREATE TABLE `tbl_receiving_list` (
  `receiving_id` int(11) NOT NULL,
  `purchase_item_id` int(11) DEFAULT NULL,
  `quantity_received` int(11) DEFAULT 0,
  `receiving_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `receiving_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_return_list`
--

CREATE TABLE `tbl_return_list` (
  `return_id` int(11) NOT NULL,
  `purchase_item_id` int(11) DEFAULT NULL,
  `quantity_returned` int(11) DEFAULT 0,
  `return_reason` text DEFAULT NULL,
  `return_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = completed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `sale_id` int(11) NOT NULL,
  `receipt_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `sale_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_sale_amount` decimal(10,2) DEFAULT NULL,
  `sale_status` enum('completed','cancelled','refunded') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suppliers`
--

CREATE TABLE `tbl_suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_suppliers`
--

INSERT INTO `tbl_suppliers` (`supplier_id`, `supplier_name`, `contact_person`, `address`, `phone`, `email`, `created_at`) VALUES
(1, 'Chicken Suppliers', 'Go , Mar Loius', 'Canitoan cdo ', '1234567890', 'go@gmail.com', '2025-03-05 03:24:55'),
(2, 'Pork Suppliers', 'Khendal', 'Bayanga', '1234567890', 'Khendal@gmail.com', '2025-03-05 03:25:28'),
(3, 'Seasoning Suppliers', 'Clemenz', 'Carmen', '1234567890', 'clemens@gmail.com', '2025-03-05 03:26:30'),
(4, 'Materials Supplier', 'Francis', 'Bulua', '1234567890', 'francis@gmail.com', '2025-03-05 03:27:43'),
(5, 'Milktea Inc', 'Riko', 'Manolo', '1234567890', 'Riko@gmail.com', '2025-03-05 03:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_log`
--

CREATE TABLE `tbl_transaction_log` (
  `transaction_log_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `transaction_type` enum('purchase','refund','adjustment') NOT NULL,
  `transaction_amount` decimal(10,2) DEFAULT NULL,
  `transaction_description` text DEFAULT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_back_order_list`
--
ALTER TABLE `tbl_back_order_list`
  ADD PRIMARY KEY (`back_order_id`),
  ADD KEY `purchase_item_id` (`purchase_item_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `tbl_ingredient_usage`
--
ALTER TABLE `tbl_ingredient_usage`
  ADD PRIMARY KEY (`usage_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `raw_ingredient_id` (`raw_ingredient_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_item_list`
--
ALTER TABLE `tbl_item_list`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `pos_order_id` (`pos_order_id`);

--
-- Indexes for table `tbl_pos_orders`
--
ALTER TABLE `tbl_pos_orders`
  ADD PRIMARY KEY (`pos_order_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `tbl_pos_order_items`
--
ALTER TABLE `tbl_pos_order_items`
  ADD PRIMARY KEY (`pos_order_item_id`),
  ADD KEY `pos_order_id` (`pos_order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_purchase_items`
--
ALTER TABLE `tbl_purchase_items`
  ADD PRIMARY KEY (`purchase_item_id`),
  ADD KEY `purchase_order_id` (`purchase_order_id`),
  ADD KEY `raw_ingredient_id` (`raw_ingredient_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_purchase_order_list`
--
ALTER TABLE `tbl_purchase_order_list`
  ADD PRIMARY KEY (`purchase_order_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_raw_ingredients`
--
ALTER TABLE `tbl_raw_ingredients`
  ADD PRIMARY KEY (`raw_ingredient_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `tbl_receipts`
--
ALTER TABLE `tbl_receipts`
  ADD PRIMARY KEY (`receipt_id`),
  ADD KEY `pos_order_id` (`pos_order_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_receiving_list`
--
ALTER TABLE `tbl_receiving_list`
  ADD PRIMARY KEY (`receiving_id`),
  ADD KEY `purchase_item_id` (`purchase_item_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_return_list`
--
ALTER TABLE `tbl_return_list`
  ADD PRIMARY KEY (`return_id`),
  ADD KEY `purchase_item_id` (`purchase_item_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `receipt_id` (`receipt_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_suppliers`
--
ALTER TABLE `tbl_suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_transaction_log`
--
ALTER TABLE `tbl_transaction_log`
  ADD PRIMARY KEY (`transaction_log_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_back_order_list`
--
ALTER TABLE `tbl_back_order_list`
  MODIFY `back_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_ingredient_usage`
--
ALTER TABLE `tbl_ingredient_usage`
  MODIFY `usage_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_item_list`
--
ALTER TABLE `tbl_item_list`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pos_orders`
--
ALTER TABLE `tbl_pos_orders`
  MODIFY `pos_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pos_order_items`
--
ALTER TABLE `tbl_pos_order_items`
  MODIFY `pos_order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_purchase_items`
--
ALTER TABLE `tbl_purchase_items`
  MODIFY `purchase_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_purchase_order_list`
--
ALTER TABLE `tbl_purchase_order_list`
  MODIFY `purchase_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_raw_ingredients`
--
ALTER TABLE `tbl_raw_ingredients`
  MODIFY `raw_ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_receipts`
--
ALTER TABLE `tbl_receipts`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_receiving_list`
--
ALTER TABLE `tbl_receiving_list`
  MODIFY `receiving_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_return_list`
--
ALTER TABLE `tbl_return_list`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_suppliers`
--
ALTER TABLE `tbl_suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_transaction_log`
--
ALTER TABLE `tbl_transaction_log`
  MODIFY `transaction_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_back_order_list`
--
ALTER TABLE `tbl_back_order_list`
  ADD CONSTRAINT `fk_back_order_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`),
  ADD CONSTRAINT `fk_back_order_purchase_item` FOREIGN KEY (`purchase_item_id`) REFERENCES `tbl_purchase_items` (`purchase_item_id`);

--
-- Constraints for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD CONSTRAINT `fk_employee_job` FOREIGN KEY (`job_id`) REFERENCES `tbl_jobs` (`job_id`);

--
-- Constraints for table `tbl_ingredient_usage`
--
ALTER TABLE `tbl_ingredient_usage`
  ADD CONSTRAINT `fk_ingredient_usage_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`),
  ADD CONSTRAINT `fk_ingredient_usage_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`),
  ADD CONSTRAINT `fk_ingredient_usage_raw_ingredient` FOREIGN KEY (`raw_ingredient_id`) REFERENCES `tbl_raw_ingredients` (`raw_ingredient_id`);

--
-- Constraints for table `tbl_item_list`
--
ALTER TABLE `tbl_item_list`
  ADD CONSTRAINT `tbl_item_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`),
  ADD CONSTRAINT `tbl_item_list_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`),
  ADD CONSTRAINT `tbl_item_list_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `tbl_categories` (`category_id`);

--
-- Constraints for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD CONSTRAINT `fk_payment_pos_order` FOREIGN KEY (`pos_order_id`) REFERENCES `tbl_pos_orders` (`pos_order_id`);

--
-- Constraints for table `tbl_pos_orders`
--
ALTER TABLE `tbl_pos_orders`
  ADD CONSTRAINT `fk_pos_order_customer` FOREIGN KEY (`cust_id`) REFERENCES `tbl_customer` (`cust_id`),
  ADD CONSTRAINT `fk_pos_order_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_pos_order_items`
--
ALTER TABLE `tbl_pos_order_items`
  ADD CONSTRAINT `fk_pos_order_item_order` FOREIGN KEY (`pos_order_id`) REFERENCES `tbl_pos_orders` (`pos_order_id`),
  ADD CONSTRAINT `fk_pos_order_item_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`);

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `tbl_categories` (`category_id`),
  ADD CONSTRAINT `fk_product_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);

--
-- Constraints for table `tbl_purchase_items`
--
ALTER TABLE `tbl_purchase_items`
  ADD CONSTRAINT `fk_purchase_item_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`),
  ADD CONSTRAINT `fk_purchase_item_order` FOREIGN KEY (`purchase_order_id`) REFERENCES `tbl_purchase_order_list` (`purchase_order_id`),
  ADD CONSTRAINT `fk_purchase_item_raw_ingredient` FOREIGN KEY (`raw_ingredient_id`) REFERENCES `tbl_raw_ingredients` (`raw_ingredient_id`);

--
-- Constraints for table `tbl_purchase_order_list`
--
ALTER TABLE `tbl_purchase_order_list`
  ADD CONSTRAINT `fk_purchase_order_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`),
  ADD CONSTRAINT `fk_purchase_order_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_suppliers` (`supplier_id`);

--
-- Constraints for table `tbl_raw_ingredients`
--
ALTER TABLE `tbl_raw_ingredients`
  ADD CONSTRAINT `fk_raw_ingredient_item` FOREIGN KEY (`item_id`) REFERENCES `tbl_item_list` (`item_id`);

--
-- Constraints for table `tbl_receipts`
--
ALTER TABLE `tbl_receipts`
  ADD CONSTRAINT `fk_receipt_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`),
  ADD CONSTRAINT `fk_receipt_pos_order` FOREIGN KEY (`pos_order_id`) REFERENCES `tbl_pos_orders` (`pos_order_id`);

--
-- Constraints for table `tbl_receiving_list`
--
ALTER TABLE `tbl_receiving_list`
  ADD CONSTRAINT `fk_receiving_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`),
  ADD CONSTRAINT `fk_receiving_purchase_item` FOREIGN KEY (`purchase_item_id`) REFERENCES `tbl_purchase_items` (`purchase_item_id`);

--
-- Constraints for table `tbl_return_list`
--
ALTER TABLE `tbl_return_list`
  ADD CONSTRAINT `fk_return_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_return_purchase_item` FOREIGN KEY (`purchase_item_id`) REFERENCES `tbl_purchase_items` (`purchase_item_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD CONSTRAINT `fk_sale_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`),
  ADD CONSTRAINT `fk_sale_receipt` FOREIGN KEY (`receipt_id`) REFERENCES `tbl_receipts` (`receipt_id`);

--
-- Constraints for table `tbl_transaction_log`
--
ALTER TABLE `tbl_transaction_log`
  ADD CONSTRAINT `fk_transaction_log_payment` FOREIGN KEY (`payment_id`) REFERENCES `tbl_payments` (`payment_id`);

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `fk_user_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
