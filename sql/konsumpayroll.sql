-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2013 at 03:44 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `konsumpayroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_cloud_id` varchar(100) NOT NULL,
  `payroll_system_account_id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `token` varchar(250) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `payroll_cloud_id`, `payroll_system_account_id`, `password`, `account_type_id`, `email`, `user_type_id`, `token`, `deleted`) VALUES
(1, 'admin@yahoo.com', 0, '7b591a2a55585e166465a838c28a2c5f', 1, 'admin@yahoo.com', 1, '85c2e269c6306a4e7a90d6ee7cb51f5f', '0'),
(2, 'owner@test.com', 2, '7b591a2a55585e166465a838c28a2c5f', 2, 'owner@test.com', 2, '', '0'),
(3, 'techgrowthglobal@techgrowthglobal.com', 4, 'tetew', 2, 'techgrowthglobal34@techgrowthglobal.com', 2, '', '0'),
(17, '12123123123', 0, 'f5bb0c8de146c67b44babbf4e6584cc0', 2, 'aldrin@techgrowthglobal.com', 3, '', '0'),
(12, '106007456', 0, '7b591a2a55585e166465a838c28a2c5f', 2, 'violet@zanoria.com', 3, '', '0'),
(13, '106007477', 0, 'e2a60dc55e43accc1747295d5c99a8dd', 2, 'allan@vergara.com', 3, '', '0'),
(14, '100600714', 0, '047314377899b3dafa0462ab2cb8e42a', 2, '', 3, '', '0'),
(15, '1006007146', 0, '9e2097cd96be7fb0d3771c16f1a58ae0', 2, 'email@email.com', 3, '', '0'),
(16, '10932093', 0, '7b591a2a55585e166465a838c28a2c5f', 2, 'kg@kg.com', 3, '', '0'),
(18, '121231231232323', 0, 'f5bb0c8de146c67b44babbf4e6584cc0', 2, 'aldrin@techgrowthglobal.com', 3, '', '0'),
(19, 'safsdf', 0, '12075f8459499dd19b4bc0eed7ccbf39', 2, 'aldrin@techgrowthglobal.com', 3, '', '0'),
(20, '12123123123123', 0, '0a909ffe7be1ffe2ec130aa243a64c26', 2, 'tetw2323@yahoo.com', 3, '', '0'),
(21, '123123123123', 0, '0a909ffe7be1ffe2ec130aa243a64c26', 2, 'tetw34@yahoo.com', 3, '', '0'),
(22, 'safsdffsdfsd', 0, '860b432652504fa60f8da945398e20de', 2, 'aldrin@techgrowthglobal.com', 3, '', '0'),
(23, 'sdfsdfsd', 0, '4297f44b13955235245b2497399d7a93', 2, '123123', 3, '', '0'),
(24, '1006007143', 0, '85545f99b90383f151150a9424dc9851', 2, 'website.qa@gmail.com', 3, '', '0'),
(25, '10060071434', 0, '85545f99b90383f151150a9424dc9851', 2, 'website.qa3@gmail.com', 3, '', '0'),
(26, '1006007143d', 0, '85545f99b90383f151150a9424dc9851', 2, 'jaymilcarredo@gmail.com', 3, '', '0'),
(27, 'haha@yahoo.com', 3, 'ac5ea27c0e088bfcc6d5283c53746128', 2, 'haha@yahoo.com', 2, '', '0'),
(28, '12234567890234567892', 0, '1ab331350769d33013e15806ddf260c5', 2, 'chris@techgrowthglobal.com', 3, '', '1'),
(29, '12234567890234567892', 0, '1ab331350769d33013e15806ddf260c5', 2, '', 3, '', '1'),
(30, '12234567890234567892', 0, '1ab331350769d33013e15806ddf260c5', 2, '', 3, '', '1'),
(31, '112344444', 0, '1f4f3059ee37bec5e053ec6a7e3aeba3', 2, '', 3, '', '0'),
(32, '1006007145', 0, 'ecf70ae11fa4f29d87a96ded477739f8', 2, '', 3, '', '0'),
(33, '123123123', 2, 'c6d57ad4535dd5250044d5f3bd570567', 2, '', 3, '', '0'),
(34, '23333333333', 2, 'c6d57ad4535dd5250044d5f3bd570567', 2, '', 3, '', '0'),
(35, '2222222', 0, 'f5bb0c8de146c67b44babbf4e6584cc0', 2, 'website.qa45@gmail.com', 3, '', '0'),
(36, '222222213213', 0, 'f5bb0c8de146c67b44babbf4e6584cc0', 2, 'website.qa445@gmail.com', 3, '', '0'),
(37, '2222222333', 0, '1bec5bd5a5f7d955acba078a359f4183', 2, 'website.qa344@gmail.com', 3, '', '0'),
(38, '100600714343', 0, '3119546afe85c9ab71aae9c98cccef6c', 2, '10060071434@yhaoo.com', 3, '', '0'),
(39, '100000000000', 2, '7b591a2a55585e166465a838c28a2c5f', 2, 'christophercuizons@techgrowthglobal.com', 3, '', '0'),
(40, '100600714346', 2, '782d39787e5b5f58fd8f8426aa49e3a7', 2, 'email32@email.com', 3, '', '0'),
(41, '100600714347', 2, '782d39787e5b5f58fd8f8426aa49e3a7', 2, 'email33@email.com', 3, '', '0'),
(42, '10060071412323', 2, '679a77cf6ab36fe241b81b497a444e5f', 2, '', 3, '', '0'),
(43, '10060071412325', 2, 'cf52405d7da749a787ab0140b9c00a27', 2, '', 3, '', '0'),
(44, '012391391230', 2, '', 2, 'aldrincatte@gmail.com', 3, '', '0'),
(45, '2222222434', 2, '', 2, 'aldrin234@techgrowthglobal.com', 3, '', '0'),
(46, '1006007143423', 2, '', 2, 'aldrin23444@techgrowthglobal.com', 3, '', '0'),
(47, '12333313123', 2, '', 2, 'aldrin454646@techgrowthglobal.com', 3, '', '0'),
(48, '100600714334234', 2, '', 2, 'aldrin4543123646@techgrowthglobal.com', 3, '', '0'),
(49, 'administrator', 0, 'd41d8cd98f00b204e9800998ecf8427e', 1, 'admin334@yahoo.com', 1, '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE IF NOT EXISTS `account_type` (
  `account_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`account_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`account_type_id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE IF NOT EXISTS `activity_logs` (
  `activity_logs_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `company_id` int(11) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`activity_logs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`activity_logs_id`, `name`, `date`, `company_id`, `deleted`) VALUES
(1, 'administrator has added a company', '2013-11-25 08:08:28', 0, '0'),
(2, 'administrator has added a company', '2013-11-25 08:15:41', 0, '0'),
(3, 'administrator has added a company', '2013-11-25 08:34:17', 1, '0'),
(4, 'administrator has added a company', '2013-11-30 07:27:42', 0, '0'),
(5, 'administrator has added a company', '2013-11-30 08:42:33', 0, '0'),
(6, 'administrator has added a company', '2013-12-02 03:22:49', 5, '0'),
(7, 'administrator has added a company', '2013-12-03 03:35:30', 10, '0'),
(8, 'administrator has added a company', '2013-12-05 10:04:08', 12, '0'),
(9, 'administrator has added a company', '2013-12-13 07:57:36', 13, '0');

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE IF NOT EXISTS `allowances` (
  `allowance_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `allowance_type` varchar(50) NOT NULL,
  `taxable` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`allowance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `allowance_type`
--

CREATE TABLE IF NOT EXISTS `allowance_type` (
  `allowance_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `allowance_type_name` varchar(80) NOT NULL,
  `taxable` enum('Yes','No') NOT NULL,
  `maximum_non_taxable_amount` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `minimum_ot_hours` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`allowance_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `approval_groups`
--

CREATE TABLE IF NOT EXISTS `approval_groups` (
  `approval_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `approval_process_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`approval_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `approval_groups`
--

INSERT INTO `approval_groups` (`approval_group_id`, `approval_process_id`, `emp_id`, `level`, `company_id`) VALUES
(1, 17, 4, 1, 4),
(2, 17, 3, 2, 4),
(3, 11, 11, 0, 1),
(4, 11, 12, 0, 1),
(5, 16, 13, 0, 4),
(6, 16, 14, 0, 4),
(7, 17, 15, 0, 4),
(8, 16, 23, 0, 4),
(9, 16, 24, 0, 4),
(10, 16, 25, 0, 4),
(11, 16, 26, 0, 4),
(12, 2, 29, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `approval_process`
--

CREATE TABLE IF NOT EXISTS `approval_process` (
  `approval_process_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`approval_process_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `approval_process`
--

INSERT INTO `approval_process` (`approval_process_id`, `name`, `company_id`) VALUES
(11, 'Finance', 1),
(13, 'administrators', 3),
(14, 'accountants', 3),
(15, 'senior accoutant', 3),
(16, 'administrators', 4),
(17, 'overtime', 4);

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `area_name` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `area_of_approval`
--

CREATE TABLE IF NOT EXISTS `area_of_approval` (
  `area_of_approval_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `read` enum('No','Yes') NOT NULL,
  `write` enum('No','Yes') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`area_of_approval_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_company`
--

CREATE TABLE IF NOT EXISTS `assigned_company` (
  `assigned_company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `payroll_system_account_id` int(11) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`assigned_company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `assigned_company`
--

INSERT INTO `assigned_company` (`assigned_company_id`, `company_id`, `payroll_system_account_id`, `deleted`) VALUES
(21, 1, 2, '0'),
(22, 2, 2, '0'),
(23, 3, 2, '0'),
(24, 4, 2, '0'),
(25, 5, 2, '0'),
(26, 6, 2, '0'),
(27, 7, 2, '0'),
(28, 8, 2, '0'),
(29, 9, 2, '0'),
(30, 10, 2, '0'),
(31, 11, 2, '0'),
(32, 12, 2, '0'),
(33, 13, 2, '0'),
(34, 14, 2, '0'),
(35, 15, 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `assign_company_head`
--

CREATE TABLE IF NOT EXISTS `assign_company_head` (
  `assign_company_head_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `payroll_system_account_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `user_created` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`assign_company_head_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `basic_pay_adjustment`
--

CREATE TABLE IF NOT EXISTS `basic_pay_adjustment` (
  `basic_pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `current_basic_pay` decimal(10,2) NOT NULL,
  `new_basic_pay` decimal(10,2) NOT NULL,
  `effective_date` datetime NOT NULL,
  `adjustment_date` datetime NOT NULL,
  `reasons` text NOT NULL,
  `attachment` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`basic_pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `commision`
--

CREATE TABLE IF NOT EXISTS `commision` (
  `commision_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `project` enum('reguar','non-regular','probie','project based') NOT NULL,
  `location` varchar(150) NOT NULL,
  `commision_type` varchar(50) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `withholding_tax_rate` decimal(10,2) NOT NULL,
  `sales_amount` decimal(10,2) NOT NULL,
  `commision_amount` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`commision_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `subscription_date` datetime NOT NULL,
  `company_name` varchar(80) NOT NULL,
  `number_of_employees` int(11) NOT NULL,
  `sub_domain` varchar(15) NOT NULL,
  `trade_name` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `business_address` varchar(180) NOT NULL,
  `city` varchar(80) NOT NULL,
  `province` varchar(100) NOT NULL,
  `zipcode` varchar(80) NOT NULL,
  `organization_type` varchar(80) NOT NULL,
  `industry` varchar(80) NOT NULL,
  `business_phone` varchar(80) NOT NULL,
  `extension` varchar(80) NOT NULL,
  `mobile_number` varchar(80) NOT NULL,
  `fax` varchar(80) NOT NULL,
  `tin` varchar(80) NOT NULL,
  `rdo_code` varchar(80) NOT NULL,
  `sss_id` varchar(80) NOT NULL,
  `hdmf` varchar(80) NOT NULL,
  `phil_health` varchar(80) NOT NULL,
  `business_category` varchar(80) NOT NULL,
  `company_logo` varchar(250) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `subscription_date`, `company_name`, `number_of_employees`, `sub_domain`, `trade_name`, `email_address`, `business_address`, `city`, `province`, `zipcode`, `organization_type`, `industry`, `business_phone`, `extension`, `mobile_number`, `fax`, `tin`, `rdo_code`, `sss_id`, `hdmf`, `phil_health`, `business_category`, `company_logo`, `status`, `deleted`) VALUES
(1, '2013-12-16 16:12:52', 'techgrowthglobal', 0, 'techgrowthgloba', 'web development', '', 'ramos cebu', 'cebu', '', '6000', 'government', 'outsourcing company', '1111111111111', '', '23123131231', '3123123', '', '', '', '', '', '', 'ed050562bb67f3c2538a3036c953f269.jpg', 'Active', '0'),
(2, '2013-11-25 09:31:33', 'callcenter', 0, 'callcenter', 'callcenter', '', 'callcenter', 'callcenter', '', '6000', 'government', 'callcenter', 'callcenter', '', 'callcenter', 'callcenter', '', '', '', '', '', '', 'f256113e23b7f80d6446243d76464588.jpg', 'Active', '0'),
(3, '2013-11-26 03:09:53', 'jacc lending', 0, 'jacclending', 'jacc lending', '', 'jacc lending', 'jacc lending', '', 'jacc lending', 'government', 'jacc lending', 'jacc lending', '', 'jacc lending', 'jacc lending', '', '', '', '', '', '', '61b8f68da84aa44ad7fa33eb9af870a4.jpg', 'Active', '0'),
(4, '2013-11-26 08:05:26', 'kons', 0, 'kons', 'kons', '', 'kons', 'kons', '', 'kons', 'private', 'kons', 'kons', '', 'kons', 'kons', '', '', '', '', '', '', 'c2685a2d6b3c6119a0ab1777e6a43279.jpg', 'Active', '0'),
(5, '2013-12-02 03:22:40', 'akonemo', 0, 'akonemo', 'akonemo', '', 'akonemo', 'akonemo', '', 'akonemo', 'private', 'akonemo', 'akonemo', '', 'akonemo', 'akonemo', '', '', '', '', '', '', '76e54263392fe0e4a901c28a630d5e3f.png', 'Active', '0'),
(6, '2013-12-02 08:12:49', 'a', 0, 'sfsdf', 'callcentershit', '', 'callcentershit', 'callcentershit', '', 'callcentershit', 'government', 'callcentershit', 'callcentershit', '', 'callcentershit', 'callcentershit', '', '', '', '', '', '', '2aef08d806e30cb060129df12931bcd6.jpg', 'Active', '0'),
(7, '2013-12-02 08:15:31', 'callcentershit2', 0, 'ddf', 'callcentershit2', '', 'callcentershit2', 'callcentershit2', '', 'callcentershit2', 'private', 'callcentershit2', 'callcentershit2', '', 'callcentershit2', 'callcentershit2', '', '', '', '', '', '', '6d3e1fc9ae0b508d5ee9db7a94ac385a.jpg', 'Active', '0'),
(8, '2013-12-02 08:16:34', 'a', 0, '444', '$dir.$id.', '', '$dir.$id.', '$dir.$id.', '', '$dir.$id.', 'government', '$dir.$id.', '$dir.$id.', '', '$dir.$id.', '$dir.$id.', '', '', '', '', '', '', '4ba42d6bc44891ba5b1900d3788eac37.jpg', 'Active', '0'),
(9, '2013-12-02 08:17:31', 'adsf', 0, 'd', '$dir.$id.$dir.$id.$dir.$id.', '', '$dir.$id.$dir.$id.', '$dir.$id.$dir.$id.$dir.$id.', '', '$dir.$id.$dir.$id.$dir.$id.', 'government', '$dir.$id.$dir.$id.$dir.$id.', '$dir.$id.$dir.$id.', '', '$dir.$id.$dir.$id.', '$dir.$id.$dir.$id.', '', '', '', '', '', '', '34d0807f2a96a1796286b82bfefdc57b.jpg', 'Active', '0'),
(10, '2013-12-03 03:35:21', 'Company Information', 0, 'CompanyInformat', 'Company Information', '', 'Company Information', 'Company Information', '', 'Company Information', 'government', 'Company Information', 'Company Information', '', 'Company Information', 'Company Information', '', '', '', '', '', '', 'ab7217c9b9d36f447dd3dc436acedc62.jpg', 'Active', '0'),
(11, '2013-12-03 06:04:34', 'Information', 0, 'Information', 'Information', '', 'Information', 'Information', '', 'Information', 'government', 'Information', 'Information', '', 'Information', 'Information', '', '', '', '', '', '', '02595883c736e846e9cb188dc04efca8.jpg', 'Active', '0'),
(12, '2013-12-05 10:03:59', 'Information2', 0, 'Information2', 'Information2', '', 'Information2', 'Information2', '', 'Information2', 'government', 'Information2', 'Information2', '', 'Information2', 'Information2', '', '', '', '', '', '', '0a99b80823479f4e117f099c464ca7e3.jpg', 'Active', '0'),
(13, '2013-12-13 07:57:25', 'ingko', 0, 'ingko', 'ingko', '', 'ingko', 'ingko', '', 'ingko', 'government', 'ingko', 'ingko', '', 'ingko', 'ingko', '', '', '', '', '', '', 'eecb8e910b1a50dc68fbfd7920cbdcba.jpg', 'Active', '0'),
(14, '2013-12-13 10:13:58', 'eug', 0, 'eug', 'eug', '', 'eug', 'eug', '', 'eug', 'government', 'eug', 'eug', '', 'eug', 'eug', '', '', '', '', '', '', '5cdafd167e7e8fb83ba83eee966dc0dd.jpg', 'Active', '0'),
(15, '2013-12-16 03:17:17', 'weeeeeee', 0, 'weeeeeee', 'weeeeeee', '', 'weeeeeee', 'weeeeeee', '', 'weeeeeee', 'private', 'weeeeeee', 'weeeeeee', '', 'weeeeeee', 'weeeeeee', '', '', '', '', '', '', '25c10e6de35558d8570108665000ca8c.png', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `company_approvers`
--

CREATE TABLE IF NOT EXISTS `company_approvers` (
  `company_approvers_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `users_roles_id` int(11) NOT NULL,
  `level` tinyint(11) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`company_approvers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `company_approvers`
--

INSERT INTO `company_approvers` (`company_approvers_id`, `account_id`, `company_id`, `users_roles_id`, `level`, `deleted`) VALUES
(100, 45, 4, 2, 0, '0'),
(101, 46, 4, 2, 0, '0'),
(102, 47, 4, 1, 0, '0'),
(103, 48, 4, 8, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `company_owner`
--

CREATE TABLE IF NOT EXISTS `company_owner` (
  `company_owner_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) NOT NULL,
  `middle_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `owner_name` varchar(60) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(150) NOT NULL,
  `street` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `zipcode` varchar(11) NOT NULL,
  `home_no` varchar(50) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `emergency_contact_person` varchar(80) NOT NULL,
  `emergency_contact_number` varchar(80) NOT NULL,
  `security_question` varchar(300) NOT NULL,
  `security_answer` varchar(80) NOT NULL,
  `country` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`company_owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `company_owner`
--

INSERT INTO `company_owner` (`company_owner_id`, `first_name`, `middle_name`, `last_name`, `owner_name`, `dob`, `address`, `street`, `city`, `zipcode`, `home_no`, `mobile_no`, `emergency_contact_person`, `emergency_contact_number`, `security_question`, `security_answer`, `country`, `date`, `account_id`) VALUES
(2, 'joe', 'mercado', 'mercados', 'Owner Profile', '0000-00-00', '0', '', '', '', '1463517832912312', '567819203-123123', 'my family', '1623761863', 'what is my favorite sports?', 'tech1234', '', '2013-11-25 04:26:19', 2),
(3, '', '', '', 'Techgrowth admin', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '2013-11-25 08:21:12', 3),
(4, '', '', '', 'christopher cuizon', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '2013-11-30 07:27:32', 27);

-- --------------------------------------------------------

--
-- Table structure for table `company_principal`
--

CREATE TABLE IF NOT EXISTS `company_principal` (
  `company_principal_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `level` varchar(5) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`company_principal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_principal`
--

INSERT INTO `company_principal` (`company_principal_id`, `emp_id`, `company_id`, `level`, `status`, `deleted`) VALUES
(1, 77, 1, '1', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `compliance`
--

CREATE TABLE IF NOT EXISTS `compliance` (
  `compliance_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `desc` text NOT NULL,
  `contributions` varchar(80) NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `status_type` varchar(50) NOT NULL,
  `type` enum('SSS','BIR','Phil_health','HDMF') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`compliance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cost_center`
--

CREATE TABLE IF NOT EXISTS `cost_center` (
  `cost_center_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `cost_center_code` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`cost_center_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cost_center`
--

INSERT INTO `cost_center` (`cost_center_id`, `company_id`, `cost_center_code`, `description`, `status`, `deleted`, `date_created`) VALUES
(7, 1, '78923', 'Hirota Works', 'Active', '0', '2013-11-25 08:37:55'),
(8, 1, '12356', 'Konsum WebDesigns', 'Active', '0', '2013-11-25 08:37:55'),
(9, 1, '76126', 'Techgrowth CSS', 'Active', '0', '2013-11-25 08:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

CREATE TABLE IF NOT EXISTS `deduction` (
  `deduction_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `deduction_name` varchar(80) NOT NULL,
  `recurring` int(11) NOT NULL,
  `standard_amount` int(11) NOT NULL,
  `deduction_taxable_income` enum('Yes','No') NOT NULL,
  `payroll_group_id` int(11) NOT NULL,
  `deduction_time` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`deduction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `department_name` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `company_id`, `department_name`, `status`, `deleted`) VALUES
(1, 13, 'department ', 'Active', '0'),
(2, 13, 'department 23', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE IF NOT EXISTS `earnings` (
  `earning_id` int(11) NOT NULL AUTO_INCREMENT,
  `earning_name` varchar(80) NOT NULL,
  `taxable` int(11) NOT NULL,
  `max_non_taxable` decimal(10,2) NOT NULL,
  `withholding_tax_rate` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`earning_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `payroll_group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `middle_name` varchar(80) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `marital_status` enum('Married','Single','Widow','Divorce') NOT NULL,
  `address` text NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `home_no` varchar(50) NOT NULL,
  `photo` text NOT NULL,
  `tin` varchar(80) NOT NULL,
  `hdmf` varchar(80) NOT NULL,
  `sss` varchar(80) NOT NULL,
  `phil_health` varchar(80) NOT NULL,
  `gsis` varchar(80) NOT NULL,
  `emergency_contact_person` varchar(80) NOT NULL,
  `emergency_contact_number` varchar(80) NOT NULL,
  `no_of_dependents` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `security_question` varchar(80) NOT NULL,
  `security_answer` varchar(80) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `account_id`, `payroll_group_id`, `permission_id`, `company_id`, `rank_id`, `dept_id`, `location_id`, `last_name`, `first_name`, `middle_name`, `dob`, `gender`, `marital_status`, `address`, `mobile_no`, `home_no`, `photo`, `tin`, `hdmf`, `sss`, `phil_health`, `gsis`, `emergency_contact_person`, `emergency_contact_number`, `no_of_dependents`, `position_id`, `security_question`, `security_answer`, `status`, `deleted`) VALUES
(1, 12, 13, 0, 1, 0, 0, 0, 'marquez', 'christopher', 'cuizon', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(2, 13, 14, 0, 1, 0, 0, 0, 'vergara', 'allan', 'mercado', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(3, 14, 0, 0, 4, 0, 0, 0, 'cuizon', 'jojane', 'montalban', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(4, 15, 0, 0, 4, 0, 0, 0, 'alcomendras1', 'jojane', 'montalban', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(5, 16, 0, 0, 4, 0, 0, 0, 'gallanida', 'kris', 'edward', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(6, 17, 0, 0, 1, 0, 0, 0, '123123', 'christopher', '123123213', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(7, 18, 0, 0, 1, 0, 0, 0, '123123', 'christopher', '123123213', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(8, 19, 0, 0, 1, 0, 0, 0, 'asfsdf', 'safas', 'dfasfas', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(9, 20, 0, 0, 1, 0, 0, 0, '123123', 'christopher', 'christopher', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(10, 21, 0, 0, 1, 0, 0, 0, '123123', 'christopher', 'christopher', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(11, 22, 0, 0, 1, 0, 0, 0, '31231', 'christopher', 'marquez', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Inactive', '1'),
(12, 23, 0, 0, 1, 0, 0, 0, '312312', '123123', '23123', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Inactive', '1'),
(13, 24, 0, 0, 4, 0, 0, 0, '100600714', '100600714', '100600714', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(14, 25, 0, 0, 4, 0, 0, 0, 'latang monggos', '100600714', 'marquez', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(15, 26, 0, 0, 4, 0, 0, 0, 'mendoza', 'jaymila', 'carredo', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(16, 28, 0, 0, 5, 0, 0, 0, 'banga', 'christopher', 'marquez', '0000-00-00', 'Male', 'Married', '', '123123', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '1'),
(17, 29, 0, 0, 5, 0, 0, 0, 'marquez', 'christopher', 'marquez', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '1'),
(18, 30, 0, 0, 5, 0, 0, 0, 'latang monggos', 'christopher', 'marquez', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '1'),
(19, 31, 0, 0, 5, 0, 0, 0, 'mendoza2', 'madonna', 'mendzon', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(20, 32, 0, 0, 10, 0, 0, 0, 'latang monggos', 'christopher', 'marquez', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(21, 33, 0, 0, 11, 0, 0, 0, 'Information', 'Information', 'Information', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(22, 34, 0, 0, 11, 0, 0, 0, 'Information', 'Information', 'Information', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(23, 38, 0, 0, 4, 0, 0, 0, '10060071434', '10060071434', '10060071434', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(24, 39, 0, 0, 4, 0, 0, 0, 'cuizon345', 'christopher234', 'cuizons234', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(25, 40, 0, 0, 4, 0, 0, 0, 'jojane', 'jojane', 'jojane', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(26, 41, 0, 0, 4, 0, 0, 0, 'jojane', 'jojane', 'jojane', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(27, 42, 0, 0, 12, 0, 0, 0, 'cuizon', 'christopher', 'marquez', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(28, 43, 0, 0, 12, 0, 0, 0, 'cuizon', 'christine ', 'reyes', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(29, 44, 0, 0, 4, 0, 0, 0, 'tugstugs', 'aldrin ', 'concuera', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(30, 45, 0, 0, 4, 0, 0, 0, 'latang monggos', 'jonatha', 'marquez', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Inactive', '1'),
(31, 46, 0, 0, 4, 0, 0, 0, 'aldrin234@techgrowthglobal.com', 'aldrin234@techgrowthglobal.com', 'aldrin234@techgrowthglobal.com', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(32, 47, 0, 0, 4, 0, 0, 0, 'biyat', 'reynei', 'lata', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0'),
(33, 48, 0, 0, 4, 0, 0, 0, 'asdfasdfs', 'dvvvvvvvvv', 'vsdfsdfs', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `employee_deductions`
--

CREATE TABLE IF NOT EXISTS `employee_deductions` (
  `deduction_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `deduction_type_id` varchar(80) NOT NULL,
  `recurring` enum('Yes','No') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `valid_from` date NOT NULL,
  `valid_until` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`deduction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_earnings`
--

CREATE TABLE IF NOT EXISTS `employee_earnings` (
  `earnings_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `minimum_wage_earner` varchar(80) NOT NULL,
  `statutory_min_wage` decimal(10,2) NOT NULL,
  `entitled_to_basic_pay` varchar(80) NOT NULL,
  `basic_pay_amount` decimal(10,2) NOT NULL,
  `pay_rate_type` enum('Month','Half Month') NOT NULL,
  `timesheet_required` enum('Yes','No') NOT NULL,
  `entitled_to_overtime` enum('Yes','No') NOT NULL,
  `entitled_to_night_differential_pay` int(11) NOT NULL,
  `night_diff_rate` int(11) NOT NULL,
  `entitled_to_commission` varchar(80) NOT NULL,
  `entitled_to_holiday_or_premium_pay` varchar(80) NOT NULL,
  `no_work_no_pay_on_special_day` varchar(80) NOT NULL,
  `no_work_no_pay_on_regular_day` varchar(80) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`earnings_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_fixed_allowances`
--

CREATE TABLE IF NOT EXISTS `employee_fixed_allowances` (
  `fixed_allowance_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `allowance_type_id` varchar(80) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`fixed_allowance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_leaves`
--

CREATE TABLE IF NOT EXISTS `employee_leaves` (
  `leaves_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `leave_credits` varchar(255) NOT NULL,
  `as_of` date NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`leaves_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `employee_leaves`
--

INSERT INTO `employee_leaves` (`leaves_id`, `emp_id`, `leave_type_id`, `leave_credits`, `as_of`, `company_id`, `status`, `deleted`) VALUES
(1, 4, 1, '3', '2013-12-13', 4, 'Active', '0'),
(2, 4, 1, '4', '2014-12-13', 4, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `employee_leaves_application`
--

CREATE TABLE IF NOT EXISTS `employee_leaves_application` (
  `employee_leaves_application_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `reasons` text NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `date_return` datetime NOT NULL,
  `date_filed` date NOT NULL,
  `note` text NOT NULL,
  `total_leave_requested` varchar(55) NOT NULL,
  `leave_application_status` enum('pending','approve','reject') NOT NULL DEFAULT 'pending',
  `attachments` text NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`employee_leaves_application_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `employee_leaves_application`
--

INSERT INTO `employee_leaves_application` (`employee_leaves_application_id`, `company_id`, `emp_id`, `leave_type_id`, `reasons`, `date_start`, `date_end`, `date_return`, `date_filed`, `note`, `total_leave_requested`, `leave_application_status`, `attachments`, `deleted`) VALUES
(1, 4, 4, 1, 'reasons lang', '2013-12-05 18:37:20', '2013-12-04 09:24:40', '2013-12-10 15:37:42', '0000-00-00', 'wataaaa', '', 'reject', 'asjlfsdfsd', '0'),
(2, 4, 5, 1, 'a8888', '2013-12-05 18:37:20', '2013-12-04 09:24:40', '2013-12-10 15:37:42', '0000-00-00', 'e3333333333333333123', '', 'approve', 'asjlfsdfsd', '0'),
(3, 4, 5, 1, 'reasons lang', '2013-12-06 18:37:20', '2013-12-04 09:24:40', '2013-12-10 15:37:42', '0000-00-00', 'wataaaa', '', 'pending', 'asjlfsdfsd', '0'),
(4, 4, 6, 1, 'reasons lang', '2013-12-06 18:37:20', '2013-12-04 09:24:40', '2013-12-10 15:37:42', '0000-00-00', 'wataaaa', '', 'reject', 'asjlfsdfsd', '0'),
(5, 4, 7, 1, 'b90', '2013-12-07 18:37:20', '2013-12-04 09:24:40', '2013-12-10 15:37:42', '0000-00-00', 'f8888888888888888', '', 'approve', 'asjlfsdfsd', '0'),
(6, 4, 6, 1, 'c09000000000000000000', '2013-12-07 18:37:20', '2013-12-04 09:24:40', '2013-12-10 15:37:42', '0000-00-00', 'g9999999999999999', '', 'approve', 'asjlfsdfsd', '0'),
(7, 4, 20, 1, 'reasons lang', '2013-12-07 18:37:20', '2013-12-04 09:24:40', '2013-12-10 15:37:42', '0000-00-00', 'wataaaa', '', 'reject', 'asjlfsdfsd', '0'),
(8, 4, 20, 1, 'd', '2014-01-01 18:37:20', '2014-01-30 09:24:40', '2013-12-10 15:37:42', '0000-00-00', 'h', '', 'approve', 'asjlfsdfsd', '0');

-- --------------------------------------------------------

--
-- Table structure for table `employee_loans`
--

CREATE TABLE IF NOT EXISTS `employee_loans` (
  `employee_loans_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `loan_no` int(11) NOT NULL,
  `loan_type_id` int(11) NOT NULL,
  `date_granted` date NOT NULL,
  `principal` decimal(10,2) NOT NULL,
  `terms` varchar(55) NOT NULL,
  `interest_rates` decimal(10,2) NOT NULL,
  `penalty_rates` decimal(10,2) NOT NULL,
  `beginning_balance` decimal(10,2) NOT NULL,
  `bank_route` varchar(255) NOT NULL,
  `bank_account` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `monthly_amortization` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`employee_loans_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `employee_loans`
--

INSERT INTO `employee_loans` (`employee_loans_id`, `emp_id`, `loan_no`, `loan_type_id`, `date_granted`, `principal`, `terms`, `interest_rates`, `penalty_rates`, `beginning_balance`, `bank_route`, `bank_account`, `account_type`, `monthly_amortization`, `company_id`, `status`, `deleted`) VALUES
(10, 3, 13123, 1, '2013-12-05', 12312312.00, '3123123', 123.00, 1.00, 2.00, '23', '123', '1231', 3123.00, 4, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `employee_overtime_application`
--

CREATE TABLE IF NOT EXISTS `employee_overtime_application` (
  `overtime_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `overtime_date_applied` date NOT NULL,
  `overtime_from` date NOT NULL,
  `overtime_to` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `no_of_hours` float NOT NULL,
  `with_nsd_hours` float NOT NULL,
  `company_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `notes` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `overtime_status` enum('pending','approve','reject') NOT NULL DEFAULT 'pending',
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`overtime_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `employee_overtime_application`
--

INSERT INTO `employee_overtime_application` (`overtime_id`, `emp_id`, `overtime_date_applied`, `overtime_from`, `overtime_to`, `start_time`, `end_time`, `no_of_hours`, `with_nsd_hours`, `company_id`, `reason`, `notes`, `status`, `overtime_status`, `deleted`) VALUES
(12, 4, '2013-12-11', '2013-12-18', '2013-12-18', '06:00:00', '08:00:00', 9, 43, 4, 'we', 'eeeeeeeeeeeeee', 'Active', 'reject', '0'),
(13, 4, '2013-12-11', '2013-12-18', '2013-12-18', '06:00:00', '08:00:00', 9, 43, 4, 'we', 'eeeeeeeeeeeeee', 'Active', 'approve', '0');

-- --------------------------------------------------------

--
-- Table structure for table `employee_payroll_information`
--

CREATE TABLE IF NOT EXISTS `employee_payroll_information` (
  `employee_payroll_information_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `sub_department_id` int(11) NOT NULL,
  `employment_type` enum('Apprentice','Real/Fixed') NOT NULL,
  `position` varchar(255) NOT NULL,
  `date_hired` date NOT NULL,
  `last_date` date NOT NULL,
  `tax_status` varchar(255) NOT NULL,
  `payment_method` enum('Cash','Debit') NOT NULL,
  `bank_route` varchar(255) NOT NULL,
  `bank_account` int(20) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `payroll_group_id` int(11) NOT NULL,
  `default_project` enum('Real','Real Regular') NOT NULL,
  `timeSheet_approval_grp` varchar(255) NOT NULL,
  `overtime_approval_grp` varchar(255) NOT NULL,
  `leave_approval_grp` varchar(255) NOT NULL,
  `expense_approval_grp` varchar(255) NOT NULL,
  `eBundy_approval_grp` varchar(255) NOT NULL,
  `sss_contribution_amount` int(255) NOT NULL,
  `hdmf_contribution_amount` int(255) NOT NULL,
  `philhealth_contribution_amount` int(255) NOT NULL,
  `witholding_tax` enum('Yes','No') NOT NULL,
  `cost_center` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`employee_payroll_information_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_qualifid_dependents`
--

CREATE TABLE IF NOT EXISTS `employee_qualifid_dependents` (
  `qualified_dependents_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `dependents_name` text NOT NULL,
  `dob` date NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`qualified_dependents_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `employee_qualifid_dependents`
--

INSERT INTO `employee_qualifid_dependents` (`qualified_dependents_id`, `emp_id`, `dependents_name`, `dob`, `company_id`, `status`, `deleted`) VALUES
(1, 1, 'dsf', '2013-11-05', 1, 'Active', '0'),
(2, 1, 'as', '2013-11-14', 1, 'Active', '0'),
(3, 13, 'asdf', '2013-12-12', 4, 'Active', '0'),
(5, 3, 'b', '2013-12-05', 4, 'Active', '0'),
(6, 3, 'c', '2013-12-03', 4, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `employee_roles`
--

CREATE TABLE IF NOT EXISTS `employee_roles` (
  `employee_roles_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `update_contact_info` enum('Yes','No') NOT NULL,
  `apply_leave` enum('Yes','No') NOT NULL,
  `apply_overtime` enum('Yes','No') NOT NULL,
  `apply_expense` enum('Yes','No') NOT NULL,
  `view_payroll_history` enum('Yes','No') NOT NULL,
  `view_tables` enum('Yes','No') NOT NULL,
  `view_loans` enum('Yes','No') NOT NULL,
  `ip` varchar(80) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`employee_roles_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_schedule`
--

CREATE TABLE IF NOT EXISTS `employee_schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `loan_type` varchar(80) NOT NULL,
  `date_granted` date NOT NULL,
  `principal` decimal(10,2) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_shifts_schedule`
--

CREATE TABLE IF NOT EXISTS `employee_shifts_schedule` (
  `shifts_schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `valid_from` date NOT NULL,
  `until` date NOT NULL,
  `Sunday` date NOT NULL,
  `Monday` date NOT NULL,
  `Tuesday` date NOT NULL,
  `Wednesday` date NOT NULL,
  `Thursday` date NOT NULL,
  `Friday` date NOT NULL,
  `Saturday` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`shifts_schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_termination`
--

CREATE TABLE IF NOT EXISTS `employee_termination` (
  `termination_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `last_date` date NOT NULL,
  `reason` text NOT NULL,
  `type` text NOT NULL,
  `approve_granted` date NOT NULL,
  `approval_date` date NOT NULL,
  `attachment` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`termination_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_timesheets`
--

CREATE TABLE IF NOT EXISTS `employee_timesheets` (
  `timesheets_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `date_applied` date NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `hoursworked` time NOT NULL,
  `tardiness` time NOT NULL,
  `undertime` time NOT NULL,
  `timesheet` text NOT NULL,
  `note` text NOT NULL,
  `timesheets_status` enum('pending','approve','reject') NOT NULL DEFAULT 'pending',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`timesheets_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `employee_timesheets`
--

INSERT INTO `employee_timesheets` (`timesheets_id`, `emp_id`, `company_id`, `date_applied`, `date_from`, `date_to`, `hoursworked`, `tardiness`, `undertime`, `timesheet`, `note`, `timesheets_status`, `deleted`) VALUES
(1, 4, 4, '0000-00-00', '2013-11-28 00:00:00', '2013-12-26 02:03:23', '03:00:00', '04:00:00', '04:00:00', 'my timesheet we', 'my timesheet we', 'pending', '0'),
(2, 5, 4, '0000-00-00', '2013-11-29 00:00:00', '2013-12-23 02:03:23', '03:00:00', '04:00:00', '04:00:00', 'my timesheet we', 'my timesheet we', 'pending', '0'),
(3, 6, 4, '0000-00-00', '2013-11-30 00:00:00', '2013-12-11 02:03:23', '03:00:00', '04:00:00', '04:00:00', 'my timesheet we', 'my timesheet we', 'reject', '0'),
(4, 7, 4, '0000-00-00', '2013-11-28 00:00:00', '2013-12-02 02:03:23', '03:00:00', '04:00:00', '04:00:00', 'my timesheet we', 'my timesheet we', 'reject', '0');

-- --------------------------------------------------------

--
-- Table structure for table `employee_training_details`
--

CREATE TABLE IF NOT EXISTS `employee_training_details` (
  `employee_training_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `course_name` varchar(55) NOT NULL,
  `organizer` varchar(55) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `training_hours` int(11) NOT NULL,
  PRIMARY KEY (`employee_training_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employment_type`
--

CREATE TABLE IF NOT EXISTS `employment_type` (
  `emp_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `selected` int(1) NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`emp_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `employment_type`
--

INSERT INTO `employment_type` (`emp_type_id`, `company_id`, `name`, `selected`, `deleted`) VALUES
(1, 13, 'employment_type_hr', 1, '0'),
(2, 13, 'employment_type_type', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `exclude_list_awol`
--

CREATE TABLE IF NOT EXISTS `exclude_list_awol` (
  `exclude_list_awol_id` int(11) NOT NULL AUTO_INCREMENT,
  `exclude_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `exclude` enum('yes','no') NOT NULL,
  `reasons` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`exclude_list_awol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exclude_periods`
--

CREATE TABLE IF NOT EXISTS `exclude_periods` (
  `exclude_periods_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_type` varchar(100) NOT NULL,
  `payroll_group` enum('regular','non-regular') NOT NULL,
  `period_date` date NOT NULL,
  `period_from` date NOT NULL,
  `peroid_to` date NOT NULL,
  `fiscal_year` year(4) NOT NULL,
  `exclude_list` varchar(100) NOT NULL,
  `status` enum('open','close','process') NOT NULL,
  `company_id` int(11) NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`exclude_periods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `expense_type` varchar(100) NOT NULL,
  `project` enum('regular','non-regular') NOT NULL,
  `details` text NOT NULL,
  `min` decimal(10,2) NOT NULL,
  `max` decimal(10,2) NOT NULL,
  `expense_date` datetime NOT NULL,
  `payroll_date` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `expense_status` enum('pending','approve','reject') NOT NULL DEFAULT 'pending',
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `emp_id`, `expense_type`, `project`, `details`, `min`, `max`, `expense_date`, `payroll_date`, `amount`, `company_id`, `expense_status`, `deleted`) VALUES
(1, 4, '1', 'regular', 'A couple of things to note here. First off, you’ll notice that I’m using an static class member to store the type of the request. That’s because we’re getting the response format correctly, but we cannot tell the rest of the application about it. At this early point of the application execution, the config class is not yet loaded so we need to use another hook. With that in mind, we’ll need to make it static so it’s not overridden when we call the next hook.', 1000000.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11123.00, 4, 'approve', '0'),
(2, 5, 'company', 'regular', 'test', 1000000.00, 99999999.99, '2013-11-01 00:00:00', '2013-11-11 00:00:00', 99999999.99, 4, 'reject', '0'),
(3, 5, 'company', 'regular', 'test', 1000000.00, 99999999.99, '2013-11-23 00:00:00', '2013-11-06 07:18:39', 99999999.99, 4, 'approve', '0'),
(4, 8, 'company', 'regular', 'test', 1000000.00, 99999999.99, '2013-11-25 00:00:00', '2013-11-20 00:00:00', 99999999.99, 4, 'approve', '0'),
(5, 8, 'company', 'regular', 'test', 1000000.00, 99999999.99, '2013-11-13 00:00:00', '2013-11-20 00:00:00', 99999999.99, 4, 'pending', '0'),
(6, 8, 'company', 'regular', 'test', 1000000.00, 99999999.99, '2013-11-13 00:00:00', '2013-12-10 00:00:00', 99999999.99, 4, 'pending', '0'),
(7, 11, 'company', 'regular', 'test', 1000000.00, 99999999.99, '2013-11-13 00:00:00', '2013-11-20 00:00:00', 99999999.99, 4, 'pending', '0'),
(8, 11, 'company', 'regular', 'test', 1000000.00, 99999999.99, '2013-11-13 00:00:00', '2013-11-16 00:00:00', 99999999.99, 4, 'pending', '0'),
(9, 4, 'company', 'regular', 'test', 1000000.00, 99999999.99, '2013-11-13 00:00:00', '2013-11-20 00:00:00', 99999999.99, 4, 'pending', '0'),
(10, 4, 'company', 'regular', 'test', 1000000.00, 99999999.99, '2013-11-13 00:00:00', '2013-11-20 00:00:00', 99999999.99, 4, 'approve', '0'),
(11, 4, 'company', 'regular', 'test', 1000000.00, 99999999.99, '2013-11-13 00:00:00', '2013-11-20 00:00:00', 99999999.99, 4, 'approve', '0');

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE IF NOT EXISTS `expense_type` (
  `expense_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_type_name` varchar(80) NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `require_receipt` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`expense_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `government_registration`
--

CREATE TABLE IF NOT EXISTS `government_registration` (
  `government_registration_id` int(11) NOT NULL AUTO_INCREMENT,
  `tin` varchar(100) NOT NULL,
  `rdo_code` varchar(100) NOT NULL,
  `sss_id` varchar(50) NOT NULL,
  `hdmf` varchar(50) NOT NULL,
  `phil_health` varchar(50) NOT NULL,
  `category` enum('household','regular','non-regular','probie') NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`government_registration_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `government_registration`
--

INSERT INTO `government_registration` (`government_registration_id`, `tin`, `rdo_code`, `sss_id`, `hdmf`, `phil_health`, `category`, `company_id`, `status`, `deleted`) VALUES
(1, '12234567890234567892', '1234567890123456789', '2345678901234567234', '1234567890234567834', '45678902312345678923', 'regular', 1, 'Active', '0'),
(2, '12234567890234567892', '12234567890234567892', '12234567890234567892', '12234567890234567892', '12234567890234567892', 'regular', 5, 'Active', '0'),
(3, '1222222', '1222222', '1222222', '1222222', '1222222', 'regular', 10, 'Active', '0'),
(4, '11111111111111', '11111111111111', '11111111111111', '11111111111111', '11111111111111', 'regular', 12, 'Active', '0'),
(5, '2312313123', '123123123123', '444444444444444444', '12312312', '123123123123', 'regular', 13, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `gsis`
--

CREATE TABLE IF NOT EXISTS `gsis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_of_insurance_coverage` varchar(100) NOT NULL,
  `personal_share_life` varchar(80) NOT NULL,
  `personal_share_retirement` varchar(80) NOT NULL,
  `gov_share_life` varchar(80) NOT NULL,
  `gov_share_retirement` varchar(80) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gsis`
--

INSERT INTO `gsis` (`id`, `type_of_insurance_coverage`, `personal_share_life`, `personal_share_retirement`, `gov_share_life`, `gov_share_retirement`, `status`, `deleted`) VALUES
(1, 'regular', '2%', '7%', '2%', '10%', 'Active', '0'),
(2, 'Employees Compensation Funds', '0%', '0%', '0%', '1% Not to Exceed P100', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `hdmf`
--

CREATE TABLE IF NOT EXISTS `hdmf` (
  `hdmf_id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_bracket_id` int(11) NOT NULL,
  `range_of_compensation_from` decimal(12,2) NOT NULL,
  `range_of_compensation_to` decimal(12,2) NOT NULL,
  `monthly_salary_credit` decimal(12,2) NOT NULL,
  `employer_contribution1` decimal(12,2) NOT NULL,
  `employee_contribution2` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`hdmf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `hdmf`
--

INSERT INTO `hdmf` (`hdmf_id`, `salary_bracket_id`, `range_of_compensation_from`, `range_of_compensation_to`, `monthly_salary_credit`, `employer_contribution1`, `employee_contribution2`, `total`, `status`, `deleted`) VALUES
(1, 1, 0.00, 999999999.00, 100.00, 100.00, 100.00, 200.00, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE IF NOT EXISTS `holiday` (
  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `holiday_name` varchar(80) NOT NULL,
  `type` enum('Regular','Special') NOT NULL,
  `date` date NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `holiday_premium`
--

CREATE TABLE IF NOT EXISTS `holiday_premium` (
  `holiday_premium_id` int(11) NOT NULL,
  `line` varchar(150) NOT NULL,
  `source` varchar(150) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hours_type` enum('rest day','holiday') NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `no_of_hours` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hours_type`
--

CREATE TABLE IF NOT EXISTS `hours_type` (
  `hour_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted` enum('0','1') NOT NULL,
  `hour_type_name` varchar(80) NOT NULL,
  `pay_rate` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`hour_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hours_worked`
--

CREATE TABLE IF NOT EXISTS `hours_worked` (
  `hours_worked_id` int(11) NOT NULL AUTO_INCREMENT,
  `hour_type_id` int(11) NOT NULL,
  `source` varchar(50) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `hours_required_regular` decimal(10,2) NOT NULL,
  `hours_required_holiday` decimal(10,2) NOT NULL,
  `hours_worked_regular` decimal(10,2) NOT NULL,
  `hours_worked_holiday` decimal(10,2) NOT NULL,
  `tardiness` decimal(10,2) NOT NULL,
  `undertime` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `overtime_id` int(11) NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`hours_worked_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hr_setup_properties`
--

CREATE TABLE IF NOT EXISTS `hr_setup_properties` (
  `hr_setup_properties_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `leave_day_num_of_hours` int(11) NOT NULL,
  `month_num_of_workdays` int(11) NOT NULL,
  PRIMARY KEY (`hr_setup_properties_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hr_setup_properties`
--

INSERT INTO `hr_setup_properties` (`hr_setup_properties_id`, `company_id`, `leave_day_num_of_hours`, `month_num_of_workdays`) VALUES
(2, 13, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `job_grade`
--

CREATE TABLE IF NOT EXISTS `job_grade` (
  `job_grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `job_grade` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`job_grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `konsum_admin`
--

CREATE TABLE IF NOT EXISTS `konsum_admin` (
  `konsum_admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`konsum_admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `konsum_admin`
--

INSERT INTO `konsum_admin` (`konsum_admin_id`, `account_id`, `name`, `status`, `deleted`) VALUES
(1, 1, 'administrator', 'Active', '0'),
(2, 49, 'konsumtech', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
  `leaves_id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_type` varchar(80) NOT NULL,
  `payable` int(11) NOT NULL,
  `required_documents` varchar(250) NOT NULL,
  `include_in_actual_hours_worked` int(11) NOT NULL,
  `leaves_used_to_deduct_no_of_work` int(11) NOT NULL,
  `leave_accrued` int(11) NOT NULL,
  `period` varchar(100) NOT NULL,
  `position_id` int(11) NOT NULL,
  `years_of_service` varchar(100) NOT NULL,
  `unused_leave` varchar(100) NOT NULL,
  `unused_leave_upon_termination` varchar(100) NOT NULL,
  `max_days_of_leave` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`leaves_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`leaves_id`, `leave_type`, `payable`, `required_documents`, `include_in_actual_hours_worked`, `leaves_used_to_deduct_no_of_work`, `leave_accrued`, `period`, `position_id`, `years_of_service`, `unused_leave`, `unused_leave_upon_termination`, `max_days_of_leave`, `company_id`, `deleted`) VALUES
(1, 'weeeeee', 1, '3', 1, 1, 34, 'quarterly', -1, 'below 3 months', 'convert to cash', 'convert to cash', 4524, 13, '0');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE IF NOT EXISTS `leave_type` (
  `leave_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_type_name` varchar(100) NOT NULL,
  `payable` enum('yes','no') NOT NULL,
  `required_document` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`leave_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`leave_type_id`, `leave_type_name`, `payable`, `required_document`, `company_id`, `status`, `deleted`) VALUES
(1, 'sick leave', 'yes', 'wer', 4, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `loans_deductions`
--

CREATE TABLE IF NOT EXISTS `loans_deductions` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `loan_number` varchar(100) NOT NULL,
  `loan_type` varchar(100) NOT NULL,
  `principal_due` date NOT NULL,
  `interest_due` date NOT NULL,
  `penalty` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loans_other_deductions`
--

CREATE TABLE IF NOT EXISTS `loans_other_deductions` (
  `loans_other_deductions_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `deducation_type` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`loans_other_deductions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loan_payment_history`
--

CREATE TABLE IF NOT EXISTS `loan_payment_history` (
  `loan_payment_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `loan_type` varchar(80) NOT NULL,
  `date_granted` date NOT NULL,
  `principal` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`loan_payment_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loan_type`
--

CREATE TABLE IF NOT EXISTS `loan_type` (
  `loan_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_type_name` varchar(80) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`loan_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `nightshift_differential`
--

CREATE TABLE IF NOT EXISTS `nightshift_differential` (
  `nightshift_differential_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hours_type` enum('double pay','holiday') NOT NULL,
  `no_of_hours` float NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`nightshift_differential_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `nightshift_differential_settings`
--

CREATE TABLE IF NOT EXISTS `nightshift_differential_settings` (
  `nightshift_differential_settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `rate` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`nightshift_differential_settings_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `nightshift_differential_settings`
--

INSERT INTO `nightshift_differential_settings` (`nightshift_differential_settings_id`, `from_time`, `to_time`, `rate`, `company_id`) VALUES
(1, '08:30:00', '23:30:00', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `payroll_system_account_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `date` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `account_id`, `payroll_system_account_id`, `name`, `date`, `deleted`) VALUES
(1, 0, 0, '2', '2013-11-25 08:08:28', '0'),
(2, 0, 0, '2', '2013-11-25 08:15:41', '0'),
(3, 0, 0, '27', '2013-11-30 07:27:42', '0'),
(4, 0, 0, '3', '2013-11-30 08:42:33', '0');

-- --------------------------------------------------------

--
-- Table structure for table `other_earnings`
--

CREATE TABLE IF NOT EXISTS `other_earnings` (
  `other_earnings_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `earning_type` varchar(50) NOT NULL,
  `withholding_tax_rate` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`other_earnings_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE IF NOT EXISTS `overtime` (
  `overtime_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `overtime_date_applied` datetime NOT NULL,
  `overtime_from` datetime NOT NULL,
  `overtime_to` datetime NOT NULL,
  `overtime_type_id` varchar(100) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `project` varchar(100) NOT NULL,
  `project_location` varchar(150) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `no_of_hours` float NOT NULL,
  `with_nsd_hours` float NOT NULL,
  `company_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `notes` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `overtime_status` enum('pending','approve','reject') NOT NULL DEFAULT 'pending',
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`overtime_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`overtime_id`, `emp_id`, `overtime_date_applied`, `overtime_from`, `overtime_to`, `overtime_type_id`, `rate`, `project`, `project_location`, `start_time`, `end_time`, `no_of_hours`, `with_nsd_hours`, `company_id`, `reason`, `notes`, `status`, `overtime_status`, `deleted`) VALUES
(1, 4, '2013-11-27 01:05:13', '0000-00-00 00:00:00', '2013-11-20 09:26:27', '1', 400.00, 'project location', 'project location', '06:00:00', '08:00:00', 2, 10, 4, 'reason', 'notes', 'Active', 'pending', '0'),
(2, 5, '2013-11-27 10:35:40', '2013-11-29 10:20:46', '2013-11-30 12:25:48', '1', 400.00, 'project location', 'project location', '06:00:00', '08:00:00', 9, 10, 4, 'weeeeeeeee', 'afasdfsd', 'Active', 'pending', '0'),
(3, 6, '2013-11-27 10:35:40', '2013-11-29 10:20:46', '2013-11-30 12:25:48', '1', 400.00, 'project location', 'project location', '06:00:00', '08:00:00', 9, 10, 4, 'weeeeeeeee', 'afasdfsd', 'Active', 'pending', '0'),
(4, 5, '2013-11-27 10:35:40', '2013-11-29 10:20:46', '2013-11-30 12:25:48', '1', 400.00, 'project location', 'project location', '06:00:00', '08:00:00', 9, 10, 4, 'weeeeeeeee', 'afasdfsd', 'Active', 'pending', '0'),
(5, 7, '2013-11-27 10:35:40', '2013-11-29 10:20:46', '2013-11-30 12:25:48', '1', 400.00, 'project location', 'project location', '06:00:00', '08:00:00', 9, 10, 4, 'weeeeeeeee', 'afasdfsd', 'Active', 'pending', '0'),
(6, 4, '2013-11-27 10:35:40', '2013-11-29 10:20:46', '2013-11-30 12:25:48', '1', 400.00, 'project location', 'project location', '06:00:00', '08:00:00', 9, 10, 4, 'weeeeeeeee', 'afasdfsd', 'Active', 'pending', '0'),
(7, 4, '2013-11-27 10:35:40', '2013-11-29 10:20:46', '2013-11-30 12:25:48', '1', 400.00, 'project location', 'project location', '06:00:00', '08:00:00', 9, 10, 4, 'weeeeeeeee', 'afasdfsd', 'Active', 'pending', '0'),
(8, 4, '2013-11-27 10:35:40', '2013-11-29 10:20:46', '2013-11-30 12:25:48', '1', 400.00, 'project location', 'project location', '06:00:00', '08:00:00', 9, 10, 4, 'weeeeeeeee', 'afasdfsd', 'Active', 'pending', '0'),
(9, 4, '2013-11-27 10:35:40', '2013-11-29 10:20:46', '2013-11-30 12:25:48', '1', 400.00, 'project location', 'project location', '06:00:00', '08:00:00', 9, 10, 4, 'weeeeeeeee', 'afasdfsd', 'Active', 'pending', '0'),
(10, 4, '2013-11-27 10:35:40', '2013-11-29 10:20:46', '2013-11-30 12:25:48', '1', 400.00, 'project location', 'project location', '06:00:00', '08:00:00', 9, 10, 4, 'weeeeeeeee', 'afasdfsd', 'Active', 'pending', '0'),
(11, 4, '2013-11-27 10:35:40', '2013-11-29 10:20:46', '2013-11-30 12:25:48', '1', 400.00, 'project location', 'project location', '06:00:00', '08:00:00', 9, 10, 4, 'weeeeeeeee', 'afasdfsd', 'Active', 'reject', '0');

-- --------------------------------------------------------

--
-- Table structure for table `overtime_type`
--

CREATE TABLE IF NOT EXISTS `overtime_type` (
  `overtime_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `overtime_type_name` varchar(80) NOT NULL,
  `pay_rate` decimal(10,2) NOT NULL,
  `ot_rate` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`overtime_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_approver`
--

CREATE TABLE IF NOT EXISTS `payroll_approver` (
  `company_contacts_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`company_contacts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_assigned_bank_accounts`
--

CREATE TABLE IF NOT EXISTS `payroll_assigned_bank_accounts` (
  `payroll_assigned_bank_accounts_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_group_id` int(11) NOT NULL,
  `bank_name` varchar(250) NOT NULL,
  `branch` varchar(250) NOT NULL,
  `bank_account_no` varchar(250) NOT NULL,
  `bank_account_type` varchar(250) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`payroll_assigned_bank_accounts_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `payroll_assigned_bank_accounts`
--

INSERT INTO `payroll_assigned_bank_accounts` (`payroll_assigned_bank_accounts_id`, `payroll_group_id`, `bank_name`, `branch`, `bank_account_no`, `bank_account_type`, `company_id`) VALUES
(1, 7, 'bank3', 'branch3', 'bank_an3', 'Current', 1),
(2, 8, 'bank2', 'branch2', 'bank_an2', 'Savings', 1),
(3, 9, '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_calendar`
--

CREATE TABLE IF NOT EXISTS `payroll_calendar` (
  `payroll_calendar_id` int(11) NOT NULL AUTO_INCREMENT,
  `semi_monthly` int(11) NOT NULL,
  `monthly` int(11) NOT NULL,
  `payroll_date` date NOT NULL,
  `cut_off_from` date NOT NULL,
  `cut_off_to` date NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`payroll_calendar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_group`
--

CREATE TABLE IF NOT EXISTS `payroll_group` (
  `payroll_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_group_name` varchar(100) NOT NULL,
  `minimum_net_pay` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`payroll_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_group_setup`
--

CREATE TABLE IF NOT EXISTS `payroll_group_setup` (
  `payroll_group_setup_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `period_type` varchar(250) NOT NULL,
  `pay_rate_type` varchar(250) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`payroll_group_setup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_run`
--

CREATE TABLE IF NOT EXISTS `payroll_run` (
  `payroll_run_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `period_from` datetime NOT NULL,
  `period_to` datetime NOT NULL,
  `run_by` varchar(80) NOT NULL,
  `payroll_group_id` int(11) NOT NULL,
  `details` text NOT NULL,
  `note` text NOT NULL,
  `payroll_run_status` enum('pending','approve','reject') NOT NULL DEFAULT 'pending',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`payroll_run_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `payroll_run`
--

INSERT INTO `payroll_run` (`payroll_run_id`, `company_id`, `emp_id`, `period_from`, `period_to`, `run_by`, `payroll_group_id`, `details`, `note`, `payroll_run_status`, `deleted`) VALUES
(1, 4, 4, '2013-11-29 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'approve', '0'),
(2, 4, 5, '2013-11-29 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'approve', '0'),
(3, 4, 5, '2013-12-10 09:20:16', '2013-12-15 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'approve', '0'),
(4, 4, 6, '2013-12-05 09:20:16', '2013-12-20 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'reject', '0'),
(5, 4, 6, '2013-11-01 09:20:16', '2013-11-10 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'approve', '0'),
(6, 4, 7, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'approve', '0'),
(7, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'approve', '0'),
(8, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'approve', '0'),
(9, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'approve', '0'),
(10, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'approve', '0'),
(11, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'approve', '0'),
(12, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'reject', '0'),
(13, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'reject', '0'),
(14, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'reject', '0'),
(15, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'reject', '0'),
(16, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'reject', '0'),
(17, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'reject', '0'),
(18, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'reject', '0'),
(19, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'reject', '0'),
(20, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'reject', '0'),
(21, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'reject', '0'),
(22, 4, 4, '2013-11-28 09:20:16', '2013-11-30 09:11:27', 'christopher cuizon', 1, 'this is a detail page', 'note here', 'reject', '0');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_system_account`
--

CREATE TABLE IF NOT EXISTS `payroll_system_account` (
  `payroll_system_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `sub_domain` varchar(55) NOT NULL,
  `subscription_date` datetime NOT NULL,
  `subscription_end_date` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`payroll_system_account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `payroll_system_account`
--

INSERT INTO `payroll_system_account` (`payroll_system_account_id`, `account_id`, `name`, `sub_domain`, `subscription_date`, `subscription_end_date`, `status`) VALUES
(2, 2, 'konsum TECHNOLOGY', 'konsum_technology', '2013-12-02 10:17:20', '2013-12-13 07:11:00', 'Active'),
(3, 27, 'jonathan admin bangga', 'jonathan_admin_bangga', '2013-12-16 00:00:00', '2013-12-19 00:00:00', 'Active'),
(4, 3, 'admin@yahoo.com', 'admin@yahoo.com', '2013-12-13 00:00:00', '2013-12-25 00:00:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `pay_rate_type`
--

CREATE TABLE IF NOT EXISTS `pay_rate_type` (
  `pay_rate_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_rate_type_name` varchar(80) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`pay_rate_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `period_type`
--

CREATE TABLE IF NOT EXISTS `period_type` (
  `period_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_group_id` int(11) NOT NULL,
  `peroid_type_name` enum('Monthly','Semi Monthly','Weekly') NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`period_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_type_name` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phil_health`
--

CREATE TABLE IF NOT EXISTS `phil_health` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_range` varchar(250) NOT NULL,
  `salary_base` decimal(10,2) NOT NULL,
  `total_monthly_premium` decimal(10,2) NOT NULL,
  `employee_share` decimal(10,2) NOT NULL,
  `employer_share` decimal(10,2) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `phil_health`
--

INSERT INTO `phil_health` (`id`, `salary_range`, `salary_base`, `total_monthly_premium`, `employee_share`, `employer_share`, `status`, `deleted`) VALUES
(1, '8,999.99 and below', 8000.00, 200.00, 100.00, 100.00, 'Active', '0'),
(2, '9,000.00 - 9,999.99', 9000.00, 225.00, 112.50, 112.50, 'Active', '0'),
(3, '10,000.00 - 10,999.99', 10000.00, 250.00, 125.00, 125.00, 'Active', '0'),
(4, '11,000.00 - 11,999.99', 11000.00, 275.00, 137.50, 137.50, 'Active', '0'),
(5, '12,000.00 - 12,999.99', 12000.00, 300.00, 150.00, 150.00, 'Active', '0'),
(6, '13,000.00 - 13,999.99', 13000.00, 325.00, 162.50, 162.50, 'Active', '0'),
(7, '14,000.00 - 14,999.99', 14000.00, 350.00, 175.00, 175.00, 'Active', '0'),
(8, '15,000.00 - 15,999.99', 15000.00, 375.00, 187.50, 187.50, 'Active', '0'),
(9, '16,000.00 - 16,999.99', 16000.00, 400.00, 200.00, 200.00, 'Active', '0'),
(10, '17,000.00 - 17,999.99', 17000.00, 425.00, 212.50, 212.50, 'Active', '0'),
(11, '18,000.00 - 18,999.99', 18000.00, 450.00, 225.00, 225.00, 'Active', '0'),
(12, '19,000.00 - 19,999.99', 19000.00, 475.00, 237.50, 237.50, 'Active', '0'),
(13, '20,000.00 - 20,999.99', 20000.00, 500.00, 250.00, 250.00, 'Active', '0'),
(14, '21,000.00 - 21,999.99', 21000.00, 525.00, 262.50, 262.50, 'Active', '0'),
(15, '22,000.00 - 22,999.99', 22000.00, 550.00, 275.00, 275.00, 'Active', '0'),
(16, '23,000.00 - 23,999.99', 23000.00, 575.00, 287.00, 287.00, 'Active', '0'),
(17, '24,000.00 - 24,999.99', 24000.00, 600.00, 300.00, 300.00, 'Active', '0'),
(18, '25,000.00 - 25,999.99', 25000.00, 625.00, 312.50, 312.50, 'Active', '0'),
(19, '26,000.00 - 26,999.99', 26000.00, 650.00, 325.00, 325.00, 'Active', '0'),
(20, '27,000.00 - 27,999.99', 27000.00, 675.00, 337.50, 337.50, 'Active', '0'),
(21, '28,000.00 - 28,999.99', 28000.00, 700.00, 350.00, 350.00, 'Active', '0'),
(22, '29,000.00 - 30,999.99', 29000.00, 725.00, 362.50, 362.50, 'Active', '0'),
(23, '30,000.00 - 31,999.99', 30000.00, 750.00, 375.00, 375.00, 'Active', '0'),
(24, '31,000.00 - 31,999.99', 31000.00, 775.00, 387.50, 387.50, 'Active', '0'),
(25, '32,000.00 - 32,999.99', 32000.00, 800.00, 400.00, 400.00, 'Active', '0'),
(26, '33,000.00 - 33,999.99', 33000.00, 825.00, 412.50, 412.50, 'Active', '0'),
(27, '34,000.00 - 34,999.99', 34000.00, 850.00, 425.00, 425.00, 'Active', '0'),
(28, '35,000.00 - and up', 35000.00, 875.00, 437.50, 437.50, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `piece_rate`
--

CREATE TABLE IF NOT EXISTS `piece_rate` (
  `piece_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `project` varchar(100) NOT NULL,
  `location` varchar(150) NOT NULL,
  `date` datetime NOT NULL,
  `piece_rate_type` varchar(50) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `units_produced` decimal(10,2) NOT NULL,
  `piece_rate_amount` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`piece_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` int(11) NOT NULL,
  `position_name` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `dept_id`, `position_name`, `company_id`, `status`, `deleted`) VALUES
(1, 1, 'weeeeeeeeee', 13, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(100) NOT NULL,
  `project_description` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE IF NOT EXISTS `rank` (
  `rank_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rest_day`
--

CREATE TABLE IF NOT EXISTS `rest_day` (
  `rest_day_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_group_id` int(11) NOT NULL,
  `rest_day` varchar(80) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`rest_day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `selected_position`
--

CREATE TABLE IF NOT EXISTS `selected_position` (
  `selected_position_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`selected_position_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sss`
--

CREATE TABLE IF NOT EXISTS `sss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_brackets` decimal(10,2) NOT NULL,
  `range_compensation_from` decimal(10,2) NOT NULL,
  `range_compensation_to` decimal(10,2) NOT NULL,
  `monthly_salary_credit` decimal(10,2) NOT NULL,
  `employer_monthly_contribution_ss` decimal(10,2) NOT NULL,
  `employer_monthly_contribution_ec` decimal(10,2) NOT NULL,
  `employee_ss` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `weight` int(2) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `sss`
--

INSERT INTO `sss` (`id`, `salary_brackets`, `range_compensation_from`, `range_compensation_to`, `monthly_salary_credit`, `employer_monthly_contribution_ss`, `employer_monthly_contribution_ec`, `employee_ss`, `total`, `weight`, `status`, `deleted`) VALUES
(1, 21323.00, 1000.00, 1249.99, 1000.00, 70.70, 10.00, 33.00, 70.00, 0, 'Active', '0'),
(2, 8888.00, 1250.00, 1749.99, 1500.00, 106.00, 10.00, 50.00, 156.00, 0, 'Active', '0'),
(3, 8888.00, 1750.00, 2249.99, 2000.00, 141.30, 10.00, 66.70, 208.00, 0, 'Active', '0'),
(4, 8888.00, 2250.00, 2749.99, 2500.00, 176.70, 10.00, 83.30, 260.00, 0, 'Active', '0'),
(5, 8888.00, 2750.00, 3249.99, 3000.00, 212.00, 10.00, 100.00, 312.00, 0, 'Active', '0'),
(6, 8888.00, 3250.00, 3749.99, 3500.00, 247.30, 10.00, 116.70, 364.00, 0, 'Active', '0'),
(7, 8888.00, 3750.00, 4249.99, 4000.00, 282.70, 10.00, 133.30, 416.00, 0, 'Active', '0'),
(8, 8888.00, 4250.00, 4749.99, 4500.00, 318.90, 10.00, 150.00, 468.00, 0, 'Active', '0'),
(9, 8888.00, 4750.00, 5249.99, 5000.00, 353.80, 10.00, 166.70, 520.00, 0, 'Active', '0'),
(10, 8888.00, 5250.00, 5749.99, 5500.00, 388.70, 10.00, 183.30, 572.00, 0, 'Active', '0'),
(11, 8888.00, 5750.00, 6249.99, 6000.00, 424.00, 10.00, 200.00, 624.00, 0, 'Active', '0'),
(12, 8888.00, 6250.00, 6749.99, 6500.00, 459.30, 10.00, 216.70, 676.00, 0, 'Active', '0'),
(13, 8888.00, 6750.00, 7249.99, 7000.00, 494.70, 10.00, 233.30, 728.00, 0, 'Active', '0'),
(14, 8888.00, 7250.00, 7749.99, 7500.00, 530.00, 10.00, 250.00, 780.00, 0, 'Active', '0'),
(15, 8888.00, 7750.00, 8249.99, 8000.00, 565.30, 10.00, 266.70, 832.00, 0, 'Active', '0'),
(16, 8888.00, 8250.00, 8749.99, 8500.00, 600.70, 10.00, 283.30, 884.00, 0, 'Active', '0'),
(17, 8888.00, 8750.00, 9249.99, 9000.00, 636.00, 10.00, 300.00, 936.00, 0, 'Active', '0'),
(18, 8888.00, 9250.00, 9749.99, 9500.00, 671.30, 10.00, 316.70, 988.00, 0, 'Active', '0'),
(19, 8888.00, 9750.00, 10299.99, 10000.00, 706.70, 10.00, 330.30, 1040.00, 0, 'Active', '0'),
(20, 8888.00, 10250.00, 10749.99, 10500.00, 742.00, 10.00, 350.00, 1092.00, 0, 'Active', '0'),
(21, 8888.00, 10750.00, 11249.99, 11000.00, 777.30, 10.00, 366.70, 1144.00, 0, 'Active', '0'),
(22, 8888.00, 11250.00, 11749.99, 11500.00, 812.70, 10.00, 383.30, 1196.00, 0, 'Active', '0'),
(23, 8888.00, 11750.00, 12249.99, 12000.00, 848.00, 10.00, 400.00, 1248.00, 0, 'Active', '0'),
(24, 8888.00, 12250.00, 12749.99, 12500.00, 883.30, 10.00, 416.70, 1300.00, 0, 'Active', '0'),
(25, 8888.00, 12750.00, 13249.99, 13000.00, 918.70, 10.00, 483.30, 1352.00, 0, 'Active', '0'),
(26, 8888.00, 13250.00, 13749.99, 13500.00, 954.00, 10.00, 450.00, 1404.00, 0, 'Active', '0'),
(27, 8888.00, 13750.00, 14249.99, 14000.00, 989.30, 10.00, 466.70, 1456.00, 0, 'Active', '0'),
(28, 8888.00, 14250.00, 14749.99, 14500.00, 1024.70, 10.00, 483.30, 1508.00, 0, 'Active', '0'),
(29, 8888.00, 14750.00, 14749.00, 15000.00, 1060.00, 30.00, 500.00, 1560.00, 0, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `time_sheet`
--

CREATE TABLE IF NOT EXISTS `time_sheet` (
  `time_sheet_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `project` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`time_sheet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `users_roles_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `users_account_type` int(11) NOT NULL,
  `roles` varchar(60) NOT NULL,
  `payroll_setup` int(2) NOT NULL,
  `payroll_setup_view` int(2) NOT NULL,
  `payroll_setup_edit` int(2) NOT NULL,
  `payroll_setup_delete` int(2) NOT NULL,
  `employee` int(2) NOT NULL,
  `employee_view` int(2) NOT NULL,
  `employee_edit` int(2) NOT NULL,
  `employee_delete` int(2) NOT NULL,
  `approval` int(2) NOT NULL,
  `approval_view` int(2) NOT NULL,
  `approval_edit` int(2) NOT NULL,
  `approval_delete` int(2) NOT NULL,
  `inquiry` int(2) NOT NULL,
  `inquiry_view` int(2) NOT NULL,
  `inquiry_edit` int(2) NOT NULL,
  `inquiry_delete` int(2) NOT NULL,
  `reports` int(2) NOT NULL,
  `reports_view` int(2) NOT NULL,
  `reports_edit` int(2) NOT NULL,
  `reports_delete` int(2) NOT NULL,
  `tables` int(2) NOT NULL,
  `tables_view` int(2) NOT NULL,
  `tables_edit` int(2) NOT NULL,
  `tables_delete` int(2) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`users_roles_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`users_roles_id`, `company_id`, `users_account_type`, `roles`, `payroll_setup`, `payroll_setup_view`, `payroll_setup_edit`, `payroll_setup_delete`, `employee`, `employee_view`, `employee_edit`, `employee_delete`, `approval`, `approval_view`, `approval_edit`, `approval_delete`, `inquiry`, `inquiry_view`, `inquiry_edit`, `inquiry_delete`, `reports`, `reports_view`, `reports_edit`, `reports_delete`, `tables`, `tables_view`, `tables_edit`, `tables_delete`, `deleted`) VALUES
(1, 4, 2, 'admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0'),
(2, 4, 1, 'blocked', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0'),
(3, 4, 1, 'c', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '0'),
(4, 4, 1, 'd', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0'),
(5, 4, 1, 'e', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0'),
(6, 4, 1, 'f', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0'),
(7, 4, 2, 'g', 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0'),
(8, 4, 1, 'h', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, '0'),
(9, 4, 2, 'i', 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, '0'),
(10, 4, 1, 'j', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, '0'),
(11, 12, 1, 'k', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, '0'),
(12, 12, 1, 'weeeeeeeeeee', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(115) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type`, `deleted`) VALUES
(1, 'admin', '0'),
(2, 'owner', '0'),
(3, 'hr', '0'),
(4, 'accountant', '0');

-- --------------------------------------------------------

--
-- Table structure for table `withholding_tax`
--

CREATE TABLE IF NOT EXISTS `withholding_tax` (
  ` 	withholding_tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_name` enum('Initial Tax','Additional Tax') NOT NULL,
  `tax_type` enum('Monthly','Weekly','Semi Monthly','Daily') NOT NULL,
  `tax1` decimal(10,2) NOT NULL,
  `tax2` decimal(10,2) NOT NULL,
  `tax3` decimal(10,2) NOT NULL,
  `tax4` decimal(10,2) NOT NULL,
  `tax5` decimal(10,2) NOT NULL,
  `tax6` decimal(10,2) NOT NULL,
  `tax7` decimal(10,2) NOT NULL,
  `tax8` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (` 	withholding_tax_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `withholding_tax`
--

INSERT INTO `withholding_tax` (` 	withholding_tax_id`, `tax_name`, `tax_type`, `tax1`, `tax2`, `tax3`, `tax4`, `tax5`, `tax6`, `tax7`, `tax8`, `company_id`, `status`) VALUES
(1, 'Initial Tax', 'Monthly', 0.00, 0.00, 41.67, 208.33, 708.33, 1875.00, 4166.67, 10416.67, 0, 'Active'),
(2, 'Initial Tax', 'Semi Monthly', 0.00, 0.00, 20.83, 104.17, 357.17, 937.50, 2083.33, 5208.33, 0, 'Active'),
(3, 'Additional Tax', 'Semi Monthly', 0.00, 5.00, 10.00, 15.00, 20.00, 25.00, 30.00, 32.00, 0, 'Active'),
(4, 'Initial Tax', 'Daily', 0.00, 0.00, 9.62, 48.08, 163.46, 432.69, 961.54, 2403.85, 0, 'Active'),
(5, 'Additional Tax', 'Monthly', 0.00, 5.00, 10.00, 15.00, 20.00, 25.00, 30.00, 32.00, 0, 'Active'),
(6, 'Additional Tax', 'Daily', 0.00, 5.00, 10.00, 15.00, 20.00, 25.00, 30.00, 32.00, 0, 'Active'),
(7, 'Initial Tax', 'Weekly', 0.00, 0.00, 1.65, 8.25, 28.05, 74.26, 165.02, 412.54, 0, 'Active'),
(8, 'Additional Tax', 'Weekly', 0.00, 5.00, 10.00, 15.00, 20.00, 25.00, 30.00, 32.00, 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `withholding_tax_annual`
--

CREATE TABLE IF NOT EXISTS `withholding_tax_annual` (
  `withholding_tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_bracket` int(11) NOT NULL,
  `range_of_tax_from` decimal(10,2) NOT NULL,
  `range_of_tax_to` varchar(55) NOT NULL,
  `initial_tax` decimal(10,2) NOT NULL,
  `additional_tax` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`withholding_tax_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `withholding_tax_annual`
--

INSERT INTO `withholding_tax_annual` (`withholding_tax_id`, `salary_bracket`, `range_of_tax_from`, `range_of_tax_to`, `initial_tax`, `additional_tax`, `company_id`, `status`) VALUES
(1, 1, 1.00, '10000.00', 0.00, 5.00, 0, 'Active'),
(2, 2, 10000.01, '30000.00', 500.00, 10.00, 0, 'Active'),
(3, 3, 30000.01, '70000.00', 2500.00, 15.00, 0, 'Active'),
(4, 4, 70000.01, '140000.00', 8500.00, 20.00, 0, 'Active'),
(5, 5, 140000.01, '250000.00', 225000.00, 25.00, 0, 'Active'),
(6, 6, 250000.01, '500000.00', 50000.00, 30.00, 0, 'Active'),
(7, 7, 500000.01, 'over', 125000.00, 32.00, 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `withholding_tax_settings`
--

CREATE TABLE IF NOT EXISTS `withholding_tax_settings` (
  `withholding_tax_settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `compensation_type` varchar(250) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`withholding_tax_settings_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `withholding_tax_settings`
--

INSERT INTO `withholding_tax_settings` (`withholding_tax_settings_id`, `compensation_type`, `company_id`) VALUES
(1, 'Regular Taxable Compenstation Income', 2);

-- --------------------------------------------------------

--
-- Table structure for table `withholding_tax_status`
--

CREATE TABLE IF NOT EXISTS `withholding_tax_status` (
  `withholding_tax_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(7) NOT NULL,
  `tax_type` enum('Monthly','Weekly','Semi Monthly','Daily') NOT NULL,
  `amount_excess1` decimal(10,2) NOT NULL,
  `amount_excess2` decimal(10,2) NOT NULL,
  `amount_excess3` decimal(10,2) NOT NULL,
  `amount_excess4` decimal(10,2) NOT NULL,
  `amount_excess5` decimal(10,2) NOT NULL,
  `amount_excess6` decimal(10,2) NOT NULL,
  `amount_excess7` decimal(10,2) NOT NULL,
  `amount_excess8` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`withholding_tax_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `withholding_tax_status`
--

INSERT INTO `withholding_tax_status` (`withholding_tax_status_id`, `tax_name`, `tax_type`, `amount_excess1`, `amount_excess2`, `amount_excess3`, `amount_excess4`, `amount_excess5`, `amount_excess6`, `amount_excess7`, `amount_excess8`, `company_id`, `status`) VALUES
(1, 'Z', 'Monthly', 1.00, 0.00, 833.00, 2500.00, 5833.00, 11667.00, 20833.00, 10416.67, 0, 'Active'),
(6, 'S', 'Monthly', 1.00, 4167.00, 5000.00, 6667.00, 10000.00, 15833.00, 25000.00, 41667.00, 0, 'Active'),
(7, 'M', 'Monthly', 1.00, 4167.00, 5000.00, 6667.00, 10000.00, 15833.00, 25000.00, 45833.00, 0, 'Active'),
(8, 'S-1', 'Monthly', 1.00, 6250.00, 7083.00, 8750.00, 12083.00, 17917.00, 27803.00, 47917.00, 0, 'Active'),
(9, 'S-2', 'Monthly', 1.00, 8333.00, 9167.00, 10833.00, 14167.00, 20000.00, 29167.00, 50000.00, 0, 'Active'),
(10, 'S-3', 'Monthly', 1.00, 10417.00, 11250.00, 12917.00, 16250.00, 22083.00, 31250.00, 52083.00, 0, 'Active'),
(11, 'S-4', 'Monthly', 1.00, 12500.00, 13333.00, 15000.00, 18333.00, 24167.00, 33333.00, 54167.00, 0, 'Active'),
(12, 'M-1', 'Monthly', 1.00, 6250.00, 7083.00, 8750.00, 12083.00, 17917.00, 27083.00, 47917.00, 0, 'Active'),
(13, 'M-2', 'Monthly', 1.00, 8333.00, 9167.00, 10833.00, 14167.00, 20000.00, 29167.00, 50000.00, 0, 'Active'),
(14, 'M-3', 'Monthly', 1.00, 10417.00, 11250.00, 12917.00, 16250.00, 22083.00, 31250.00, 52083.00, 0, 'Active'),
(15, 'M-4', 'Monthly', 1.00, 12500.00, 13333.00, 15000.00, 18333.00, 24167.00, 33333.00, 54167.00, 0, 'Active'),
(16, 'Z', 'Semi Monthly', 0.00, 0.00, 417.00, 1250.00, 2917.00, 5833.00, 10417.00, 20833.00, 0, 'Active'),
(17, 'S', 'Semi Monthly', 1.00, 2083.00, 2500.00, 3333.00, 5000.00, 71917.00, 12500.00, 22917.00, 0, 'Active'),
(18, 'Z', 'Monthly', 1.00, 0.00, 833.00, 2500.00, 5833.00, 11667.00, 20833.00, 10416.67, 0, 'Active'),
(19, 'Z', 'Monthly', 1.00, 0.00, 833.00, 2500.00, 5833.00, 11667.00, 20833.00, 10416.67, 0, 'Active'),
(20, 'Z', 'Monthly', 1.00, 0.00, 833.00, 2500.00, 5833.00, 11667.00, 20833.00, 10416.67, 0, 'Active'),
(21, 'Z', 'Monthly', 1.00, 0.00, 833.00, 2500.00, 5833.00, 11667.00, 20833.00, 10416.67, 0, 'Active'),
(22, 'Z', 'Monthly', 1.00, 0.00, 833.00, 2500.00, 5833.00, 11667.00, 20833.00, 10416.67, 0, 'Active'),
(23, 'Z', 'Monthly', 1.00, 0.00, 833.00, 2500.00, 5833.00, 11667.00, 20833.00, 10416.67, 0, 'Active'),
(24, 'Z', 'Monthly', 1.00, 0.00, 833.00, 2500.00, 5833.00, 11667.00, 20833.00, 10416.67, 0, 'Active'),
(25, 'Z', 'Daily', 1.00, 0.00, 33.00, 99.00, 231.00, 462.00, 825.00, 1650.00, 0, 'Active'),
(26, 'S', 'Daily', 1.00, 165.00, 198.00, 264.00, 396.00, 627.00, 990.00, 1815.00, 0, 'Active'),
(27, 'M', 'Daily', 1.00, 165.00, 198.00, 264.00, 396.00, 627.00, 990.00, 1815.00, 0, 'Active'),
(28, 'S-1', 'Daily', 1.00, 248.00, 281.00, 347.00, 479.00, 710.00, 1073.00, 1898.00, 0, 'Active'),
(29, 'S-2', 'Daily', 1.00, 330.00, 363.00, 429.00, 561.00, 792.00, 1155.00, 1980.00, 0, 'Active'),
(30, 'S-3', 'Daily', 1.00, 413.00, 446.00, 512.00, 644.00, 875.00, 1238.00, 2063.00, 0, 'Active'),
(31, 'S-4', 'Daily', 1.00, 495.00, 528.00, 594.00, 726.00, 957.00, 1320.00, 2145.00, 0, 'Active'),
(32, 'M-1', 'Daily', 1.00, 248.00, 281.00, 347.00, 479.00, 710.00, 1073.00, 1898.00, 0, 'Active'),
(33, 'M-2', 'Daily', 1.00, 330.00, 363.00, 429.00, 561.00, 792.00, 1155.00, 1980.00, 0, 'Active'),
(34, 'M-3', 'Daily', 1.00, 413.00, 446.00, 512.00, 644.00, 875.00, 1238.00, 2063.00, 0, 'Active'),
(35, 'M-4', 'Daily', 1.00, 495.00, 528.00, 594.00, 726.00, 957.00, 1320.00, 2145.00, 0, 'Active'),
(36, 'Z', 'Weekly', 1.00, 0.00, 192.00, 577.00, 1346.00, 2692.00, 4808.00, 9615.00, 0, 'Active'),
(37, 'S', 'Weekly', 1.00, 962.00, 1154.00, 1539.00, 2308.00, 3654.00, 5769.00, 10577.00, 0, 'Active'),
(38, 'M', 'Weekly', 1.00, 962.00, 1154.00, 1538.00, 2308.00, 3654.00, 5769.00, 10577.00, 0, 'Active'),
(39, 'S-1', 'Weekly', 1.00, 962.00, 1154.00, 1538.00, 2308.00, 3654.00, 5769.00, 10577.00, 0, 'Active'),
(40, 'S-2', 'Weekly', 1.00, 1923.00, 2115.00, 2500.00, 3268.00, 4615.00, 6731.00, 11538.00, 0, 'Active'),
(41, 'S-3', 'Weekly', 1.00, 2404.00, 2596.00, 2981.00, 3750.00, 5096.00, 7212.00, 12019.00, 0, 'Active'),
(42, 'S-4', 'Weekly', 1.00, 2885.00, 3077.00, 3462.00, 4231.00, 5577.00, 7692.00, 12500.00, 0, 'Active'),
(43, 'M-1', 'Weekly', 1.00, 1442.00, 1635.00, 2019.00, 2788.00, 4315.00, 6250.00, 11058.00, 0, 'Active'),
(44, 'M-2', 'Weekly', 1.00, 1923.00, 2115.00, 2500.00, 3268.00, 4615.00, 6731.00, 11538.00, 0, 'Active'),
(45, 'M-3', 'Weekly', 1.00, 2404.00, 2596.00, 2981.00, 3750.00, 5096.00, 7212.00, 12019.00, 0, 'Active'),
(46, 'M-4', 'Weekly', 1.00, 2885.00, 3077.00, 3462.00, 4231.00, 5577.00, 7692.00, 12500.00, 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `workday`
--

CREATE TABLE IF NOT EXISTS `workday` (
  `workday_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_group_id` int(11) NOT NULL,
  `working_day` varchar(80) NOT NULL,
  `work_start_time` time NOT NULL,
  `work_end_time` time NOT NULL,
  `break_start_time` time NOT NULL,
  `break_end_time` time NOT NULL,
  `working_hours` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`workday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
