-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2013 at 02:40 AM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `payroll_cloud_id`, `payroll_system_account_id`, `password`, `account_type_id`, `email`, `user_type_id`, `token`, `deleted`) VALUES
(1, '', 4, '05d5d1168a8c16e9bab0f0ed956d691e', 2, 'joe@techgrowthglobal.com', 2, '', '0'),
(2, '', 5, '05d5d1168a8c16e9bab0f0ed956d691e', 2, 'christopher.cuizon@techgrowthglobal.com', 2, '', '0'),
(3, '', 6, '9dacbf073f9938a03acd10b23a6817b7', 2, 'joe@alcomendras.com', 2, '', '0'),
(4, '', 7, 'fbee1c9abffe28f2d1a144fbdfd5c27a', 2, 'jonathan@banga.com', 2, '', '0'),
(5, '', 0, '8cb52caf041ccba4e435bc393bc638ed', 2, 'ronelo@yahoo.com', 2, '', '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`activity_logs_id`, `name`, `date`, `company_id`, `deleted`) VALUES
(1, 'administrator has added a company', '2013-11-13 02:29:55', 2, '0'),
(2, 'administrator has added a company', '2013-11-14 02:40:05', 3, '0'),
(3, 'administrator has added a company', '2013-11-14 02:59:00', 3, '0'),
(4, 'administrator has added a company', '2013-11-14 06:02:00', 3, '0'),
(5, 'administrator has added a company', '2013-11-19 06:43:23', 0, '0'),
(6, 'administrator has added a company', '2013-11-19 06:43:23', 0, '0'),
(7, 'administrator has added a company', '2013-11-19 06:43:40', 0, '0'),
(8, 'admins has added a company', '2013-11-19 08:13:53', 0, '0'),
(9, 'admins cuizon has added a company', '2013-11-19 08:14:12', 0, '0'),
(10, 'admins cuizon has added a company', '2013-11-19 10:27:40', 0, '0'),
(11, 'admins cuizon has added a company', '2013-11-19 10:34:14', 0, '0'),
(12, 'admins cuizon has added a company', '2013-11-19 11:40:26', 0, '0'),
(13, 'admins cuizon has added a company', '2013-11-19 11:40:27', 0, '0'),
(14, 'admins cuizon has added a company', '2013-11-19 11:40:49', 0, '0'),
(15, 'admins cuizon has added a company', '2013-11-19 11:40:49', 0, '0'),
(16, 'admins cuizon has added a company', '2013-11-19 11:41:31', 0, '0'),
(17, 'admins cuizon has added a company', '2013-11-19 11:46:54', 0, '0'),
(18, 'admins cuizon has added a company', '2013-11-19 11:46:54', 0, '0'),
(19, 'admins cuizon has added a company', '2013-11-19 11:48:01', 0, '0'),
(20, 'admins cuizon has added a company', '2013-11-19 12:01:21', 0, '0'),
(21, 'admins cuizon has added a company', '2013-11-19 12:01:21', 0, '0'),
(22, 'admins cuizon has added a company', '2013-11-19 12:06:01', 0, '0'),
(23, 'admins cuizon has added a company', '2013-11-19 12:06:01', 0, '0'),
(24, 'admins cuizon has added a company', '2013-11-19 12:07:12', 0, '0'),
(25, 'admins cuizon has added a company', '2013-11-19 12:14:42', 0, '0');

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
  `name` varchar(100) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`approval_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `approval_groups`
--

INSERT INTO `approval_groups` (`approval_group_id`, `name`, `emp_id`, `level`) VALUES
(1, 'Accounting', 4, 1),
(2, 'HR', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `approval_process`
--

CREATE TABLE IF NOT EXISTS `approval_process` (
  `approval_process_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`approval_process_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `approval_process`
--

INSERT INTO `approval_process` (`approval_process_id`, `name`, `company_id`) VALUES
(1, 'Timesheet', 6),
(2, 'Overtime', 6),
(3, 'Leaves', 6),
(4, 'Expenses', 6),
(5, 'process1', 6),
(6, 'process2', 6),
(7, 'process3', 6),
(8, 'process4', 6),
(9, 'process5', 6),
(10, 'process 6', 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `assigned_company`
--

INSERT INTO `assigned_company` (`assigned_company_id`, `company_id`, `payroll_system_account_id`, `deleted`) VALUES
(1, 1, 17, '0'),
(2, 2, 17, '0'),
(3, 3, 17, '0'),
(4, 4, 17, '0'),
(5, 5, 17, '0'),
(6, 6, 17, '0'),
(7, 7, 17, '0'),
(8, 8, 17, '0'),
(9, 9, 17, '0'),
(10, 10, 17, '0'),
(11, 11, 17, '0'),
(12, 12, 17, '0'),
(13, 13, 17, '0'),
(14, 14, 17, '0');

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
  `current_basic_pay` decimal(10,2) NOT NULL,
  `new_basic_pay` decimal(10,2) NOT NULL,
  `effective_date` datetime NOT NULL,
  `adjustment_date` datetime NOT NULL,
  `reasons` text NOT NULL,
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
  `company_owner_id` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_owner_id`, `subscription_date`, `company_name`, `number_of_employees`, `sub_domain`, `trade_name`, `email_address`, `business_address`, `city`, `province`, `zipcode`, `organization_type`, `industry`, `business_phone`, `extension`, `mobile_number`, `fax`, `tin`, `rdo_code`, `sss_id`, `hdmf`, `phil_health`, `business_category`, `company_logo`, `status`, `deleted`) VALUES
(1, 0, '2013-11-12 03:31:18', 'hirota paint', 0, 'Code', 'industries', '', 'ramos cebu', 'city', '', '6000', 'non-profit organization', 'painting', '511111111', '', '5333333', '544444', '', '', '', '', '', '', '', 'Inactive', '0'),
(2, 0, '2013-11-13 02:12:36', 'qualfong', 0, 'qualfong', 'qualfonggy', '', 'qualfonggy', 'city', '', '6000', 'private', 'industry', 'office', '', '3409324', '3423434', '', '', '', '', '', '', '', 'Active', '0'),
(3, 0, '2013-11-14 11:14:01', 'techgrowthglobal', 0, 'te', 'techgrowthglobal2', '', 'techgrowthglobal3', 'techgrowthglobal4', '', 'techgrowthglobal5', 'non-profit organization', 'techgrowthglobal6', '111111111117', '', '22222222222238', '333333333333339', '', '', '', '', '', '', '', 'Inactive', '0'),
(4, 0, '2013-11-15 03:27:06', 'exlibris', 0, 'exlibris', 'exlibris', '', 'exlibries', 'lahug', '', '6000', 'non-profit organization', 'books', 'books2', '', 'books3', 'books4', '', '', '', '', '', '', '', 'Inactive', '0'),
(5, 0, '2013-11-15 03:28:44', 'a', 0, 'a', 'b', '', 'c', 'd', '', 'e', 'private', 'f', 'g', '', 'h', 'j', '', '', '', '', '', '', '', 'Inactive', '0'),
(6, 0, '2013-11-15 03:33:51', 'qualfongqualfong', 0, 'qualfongqualfon', 'qualfongqualfong', '', 'qualfongqualfong', 'qualfongqualfong', '', 'qualfongqualfong', 'private', 'qualfongqualfong', 'qualfongqualfong', '', 'qualfongqualfong', 'qualfongqualfong', '', '', '', '', '', '', '', 'Inactive', '0'),
(7, 0, '2013-11-15 04:06:08', 'tetws', 0, 'tetws', 'tetws', '', 'tetws', 'tetws', '', 'tetws', 'government', 'tetws', 'tetws', '', 'tetws', 'tetws', '', '', '', '', '', '', 'ba3fc271f67a0ff2473f444fc83719ab.jpg', 'Inactive', '0'),
(8, 0, '2013-11-15 04:07:48', 'asaaaaaaaaaaa', 0, 'asaaaaaaaaaaa', 'asaaaaaaaaaaa', '', 'asaaaaaaaaaaa', 'asaaaaaaaaaaa', '', 'asaaaaaaaaaaa', 'private', 'asaaaaaaaaaaa', 'asaaaaaaaaaaa', '', 'asaaaaaaaaaaa', 'asaaaaaaaaaaa', '', '', '', '', '', '', '118625b202d8f505fc40650b0d40ff06.jpg', 'Inactive', '0'),
(9, 0, '2013-11-15 04:09:46', 'bbbbbbbbb', 0, 'bbbbbbbbb', 'bbbbbbbbb', '', 'bbbbbbbbbbbbbbbbbb', 'bbbbbbbbb', '', 'bbbbbbbbb', 'non-profit organization', 'bbbbbbbbb', 'bbbbbbbbb', '', 'bbbbbbbbb', 'bbbbbbbbb', '', '', '', '', '', '', '', 'Inactive', '0'),
(10, 0, '2013-11-15 04:13:04', 'Company Information', 0, 'CompanyInformat', 'Company Information', '', 'Company Information', 'Company Information', '', 'Company Information', 'private', 'Company Information', 'Company Information', '', 'Company Information', 'Company Information', '', '', '', '', '', '', '', 'Inactive', '0'),
(11, 0, '2013-11-15 04:14:59', 'Information', 0, 'Information', 'Information', '', 'InformationInformation', 'Information', '', 'Information', 'private', 'Information', 'Information', '', 'Information', 'Information', '', '', '', '', '', '', 'b5dbe6c534c4d95dd401626db6adde29.jpg', 'Inactive', '0'),
(12, 0, '2013-11-15 04:22:35', 'Code', 0, 'Code', 'Code', '', 'Code', 'Code', '', 'Code', 'private', 'Code', 'Code', '', 'Code', 'Code', '', '', '', '', '', '', '27a5c614395e6803be7282373f750d90.jpg', 'Inactive', '0'),
(13, 0, '2013-11-15 06:12:33', 'jcboy', 0, 'jcboy', 'jcboy', '', 'jcboy', 'jcboy', '', 'jcboy', 'private', 'jcboy', 'jcboy', '', 'jcboy', 'jcboy', '', '', '', '', '', '', 'ba815fd99d8091c3de27403e645bfe92.jpg', 'Inactive', '0'),
(14, 0, '2013-11-18 03:40:08', 'techgrowthglobal332', 0, 'techgrowthgloba', 'techgrowthglobal332', '', 'techgrowthglobal332', 'techgrowthglobal332', '', 'techgrowthglobal332', 'private', 'techgrowthglobal332', 'techgrowthglobal332', '', 'techgrowthglobal332', 'techgrowthglobal332', '', '', '', '', '', '', '3699a194b3a0632b5213fae22e1512be.jpg', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `company_approvers`
--

CREATE TABLE IF NOT EXISTS `company_approvers` (
  `company_approvers_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `level` tinyint(11) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`company_approvers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `company_approvers`
--

INSERT INTO `company_approvers` (`company_approvers_id`, `account_id`, `company_id`, `level`, `deleted`) VALUES
(37, 17, 1, 0, '1'),
(38, 18, 1, 0, '1'),
(39, 19, 1, 0, '1'),
(40, 20, 1, 0, '1'),
(41, 21, 1, 0, '1'),
(42, 22, 1, 0, '1'),
(43, 23, 1, 0, '1'),
(44, 24, 1, 0, '1'),
(45, 25, 1, 0, '1'),
(46, 26, 1, 0, '1'),
(47, 27, 1, 0, '1'),
(48, 28, 1, 0, '1'),
(49, 43, 2, 3, '0'),
(50, 44, 2, 3, '0'),
(51, 46, 3, 2, '1'),
(52, 47, 3, 1, '1'),
(53, 48, 3, 2, '1'),
(54, 50, 3, 1, '1'),
(55, 51, 3, 2, '1'),
(56, 52, 3, 3, '0'),
(57, 53, 3, 3, '1'),
(58, 54, 3, 4, '1'),
(59, 55, 3, 1, '1'),
(60, 56, 3, 2, '0'),
(61, 57, 3, 3, '0'),
(62, 58, 3, 127, '0');

-- --------------------------------------------------------

--
-- Table structure for table `company_owner`
--

CREATE TABLE IF NOT EXISTS `company_owner` (
  `company_owner_id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_name` varchar(60) NOT NULL,
  `address` varchar(150) NOT NULL,
  `street` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `zipcode` varchar(11) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`company_owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `company_owner`
--

INSERT INTO `company_owner` (`company_owner_id`, `owner_name`, `address`, `street`, `city`, `zipcode`, `mobile`, `country`, `date`, `account_id`) VALUES
(1, 'christopher cuizon', '', '', '', '', '', '', '2013-11-19 11:59:20', 1),
(2, 'erap estrada', '', '', '', '', '', '', '2013-11-19 11:59:20', 2),
(3, 'joe christian alcomendras', '', '', '', '', '', '', '2013-11-19 12:06:58', 3),
(4, 'jonathan bangga', '', '', '', '', '', '', '2013-11-19 12:09:51', 4),
(5, 'ronelo ronelo', '', '', '', '', '', '', '2013-11-19 12:15:49', 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `company_principal`
--

INSERT INTO `company_principal` (`company_principal_id`, `emp_id`, `company_id`, `level`, `status`, `deleted`) VALUES
(1, 23, 9, '0', 'Active', '0'),
(2, 24, 9, '0', 'Active', '0'),
(3, 26, 8, '0', 'Inactive', '1'),
(4, 27, 8, '0', 'Inactive', '1'),
(5, 33, 8, '0', 'Inactive', '1'),
(6, 34, 8, '0', 'Inactive', '1'),
(7, 35, 8, '0', 'Inactive', '1'),
(8, 36, 8, '0', 'Inactive', '1'),
(9, 37, 8, '0', 'Inactive', '1'),
(10, 38, 8, '0', 'Inactive', '1'),
(11, 39, 8, '0', 'Active', '0'),
(12, 27, 1, '0', 'Active', '0'),
(13, 28, 1, '0', 'Inactive', '1'),
(14, 29, 1, '0', 'Inactive', '1'),
(15, 30, 1, '0', 'Inactive', '1'),
(16, 31, 1, '0', 'Inactive', '1'),
(17, 32, 1, '0', 'Inactive', '1'),
(18, 33, 1, '0', 'Inactive', '1'),
(19, 34, 1, '0', 'Inactive', '1'),
(20, 35, 1, '0', 'Inactive', '1'),
(21, 36, 2, '0', 'Active', '0'),
(22, 37, 2, '0', 'Active', '0'),
(23, 38, 2, '3', 'Inactive', '1'),
(24, 39, 2, '34', 'Inactive', '1'),
(25, 42, 3, '2', 'Inactive', '1'),
(26, 46, 3, '3', 'Active', '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `cost_center`
--

INSERT INTO `cost_center` (`cost_center_id`, `company_id`, `cost_center_code`, `description`, `status`, `deleted`, `date_created`) VALUES
(1, 2, 'c', 'd', 'Inactive', '1', '2013-11-13 06:14:58'),
(2, 2, 'd', 'h', 'Inactive', '1', '2013-11-13 06:16:29'),
(3, 2, 'e', 'j', 'Inactive', '1', '2013-11-13 06:16:29'),
(4, 2, 'f', 'k', 'Inactive', '1', '2013-11-13 06:16:29'),
(5, 2, 'fg', 'a', 'Inactive', '1', '2013-11-13 06:21:52'),
(6, 2, 'g', 'a', 'Inactive', '1', '2013-11-13 06:21:52'),
(7, 2, 'fg', 'b', 'Inactive', '1', '2013-11-13 06:21:52'),
(8, 2, 'fsdf', 'sdfsdf', 'Inactive', '1', '2013-11-13 06:27:21'),
(9, 2, 'safs', 'fsdf', 'Inactive', '1', '2013-11-13 06:27:33'),
(10, 2, 'safssd', 'sdf', 'Inactive', '1', '2013-11-13 06:27:51'),
(11, 2, 'sdf', 'sdf', 'Inactive', '1', '2013-11-13 06:53:45'),
(12, 0, '', '', 'Inactive', '1', '0000-00-00 00:00:00'),
(13, 0, '', '', 'Inactive', '1', '0000-00-00 00:00:00'),
(14, 0, '', '', 'Inactive', '1', '0000-00-00 00:00:00'),
(15, 0, '', '', 'Inactive', '1', '0000-00-00 00:00:00'),
(16, 0, '', '', 'Inactive', '1', '0000-00-00 00:00:00'),
(17, 2, 'asd', 'asdas', 'Inactive', '1', '2013-11-13 07:19:56'),
(18, 2, 'dasd', 'asd', 'Inactive', '1', '2013-11-13 07:19:56'),
(19, 2, '12323', '232323', 'Inactive', '1', '2013-11-13 07:26:10'),
(20, 2, 'safssd3', '334', 'Inactive', '1', '2013-11-13 07:26:21'),
(21, 2, 'f88', '8', 'Inactive', '1', '2013-11-13 07:27:54'),
(22, 2, 'dfdsf', 'sf', 'Inactive', '1', '2013-11-13 07:28:22'),
(23, 2, 'asdf', 'asdfasd', 'Inactive', '1', '2013-11-13 07:28:27'),
(24, 2, 'fasdf', 'sadfsdf', 'Inactive', '1', '2013-11-13 07:28:27'),
(25, 2, 'asdfasd', 'dfadsfsdf', 'Inactive', '1', '2013-11-13 07:28:33'),
(26, 2, 'f3', 'sdfsd', 'Inactive', '1', '2013-11-13 07:31:03'),
(27, 2, 'fsdfsdf', 'f3', 'Inactive', '1', '2013-11-13 07:31:03'),
(28, 2, '434', '343434', 'Inactive', '1', '2013-11-13 07:34:00'),
(29, 2, 'a', 'd', 'Inactive', '1', '2013-11-13 07:39:31'),
(30, 2, 'b', 'e', 'Inactive', '1', '2013-11-13 07:39:31'),
(31, 2, 'c3', 'f', 'Inactive', '1', '2013-11-13 07:39:31'),
(32, 2, 'csdf', 'f', 'Inactive', '1', '2013-11-13 08:23:34'),
(33, 2, 'heheheh sdf', 'csdfsdfsdfdf', 'Active', '0', '2013-11-13 08:29:39'),
(34, 2, 'heheheh2', 'werwwwwwwwwwwff', 'Inactive', '1', '2013-11-13 08:31:19'),
(35, 2, 'heheheh', 'lata ng monggos dong !  !1', 'Inactive', '1', '2013-11-13 08:31:19'),
(36, 2, 'heheheh23 ', 'sdf23', 'Inactive', '1', '2013-11-13 10:10:52'),
(37, 2, '1234', '123123sdfdsf', 'Inactive', '1', '2013-11-13 10:11:12'),
(38, 2, '123', '23', 'Active', '0', '2013-11-13 10:22:51'),
(39, 2, '123123', 'df', 'Inactive', '1', '2013-11-13 10:23:00'),
(40, 3, 'b78888888', 'sdf85', 'Active', '0', '2013-11-14 09:36:40');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `company_id`, `department_name`, `status`, `deleted`) VALUES
(1, 0, '4', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE IF NOT EXISTS `earnings` (
  `earning_id` int(11) NOT NULL AUTO_INCREMENT,
  `earning_name` varchar(80) NOT NULL,
  `taxable` enum('Yes','No') NOT NULL,
  `max_non_taxable_amount_per_month` decimal(10,2) NOT NULL,
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
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `account_id`, `payroll_group_id`, `permission_id`, `company_id`, `rank_id`, `dept_id`, `location_id`, `last_name`, `first_name`, `middle_name`, `dob`, `gender`, `marital_status`, `address`, `mobile_no`, `home_no`, `photo`, `tin`, `hdmf`, `sss`, `phil_health`, `gsis`, `emergency_contact_person`, `emergency_contact_number`, `no_of_dependents`, `position_id`, `status`, `deleted`) VALUES
(36, 39, 0, 0, 2, 0, 0, 0, 'christopher2', 'cuizon3', '123234', '0000-00-00', 'Male', 'Married', '', '10293235', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '0'),
(37, 40, 0, 0, 2, 0, 0, 0, 'c', 'joe christian alcomendras', 'Marquez', '0000-00-00', 'Male', 'Married', '', '11121314', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '0'),
(38, 41, 0, 0, 2, 0, 0, 0, '', '2', '', '0000-00-00', 'Male', 'Married', '', '4', '', '', '', '', '', '', '', '', '', 0, 0, 'Inactive', '1'),
(39, 42, 0, 0, 2, 0, 0, 0, '', '4', '', '0000-00-00', 'Male', 'Married', '', '6', '', '', '', '', '', '', '', '', '', 0, 0, 'Inactive', '1'),
(40, 43, 0, 0, 2, 0, 0, 0, 'banga', '123', '132', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '0'),
(41, 44, 0, 0, 2, 0, 0, 0, 'banga', '123', 'sdf', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '0'),
(42, 45, 0, 0, 3, 0, 0, 0, '', 'christopher cuizon', '', '0000-00-00', 'Male', 'Married', '', '1029323', '', '', '', '', '', '', '', '', '', 0, 0, 'Inactive', '1'),
(43, 46, 0, 0, 3, 0, 0, 0, '3333333', 'christopher', 'marquez', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '1'),
(44, 47, 0, 0, 3, 0, 0, 0, 'cuizon', 'christopher', 'marquez', '0000-00-00', 'Male', 'Married', '', '1111111111111', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '1'),
(45, 48, 0, 0, 3, 0, 0, 0, 'banga', 'reyneil', 'marquez', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '1'),
(46, 49, 0, 0, 3, 0, 0, 0, '', '3', '', '0000-00-00', 'Male', 'Married', '', '3', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '0'),
(47, 50, 0, 0, 3, 0, 0, 0, '1', '1', '1', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '1'),
(48, 51, 0, 0, 3, 0, 0, 0, '232', '667', '23', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '1'),
(49, 52, 0, 0, 3, 0, 0, 0, '3', '4', '23', '0000-00-00', 'Male', 'Married', '', '23', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '0'),
(50, 53, 0, 0, 3, 0, 0, 0, 'cuizon', 'chris gwapo cute', 'marquez2', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '1'),
(51, 2, 0, 0, 3, 0, 0, 0, 'cuizon', 'christopher', 'gwapo', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '1'),
(52, 55, 0, 0, 3, 0, 0, 0, '313123', '1213', '12312', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '1'),
(53, 56, 0, 0, 3, 0, 0, 0, '213', 'ee12', '323', '0000-00-00', 'Male', 'Married', '', '1', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '0'),
(54, 57, 0, 0, 3, 0, 0, 0, '232', '12', '2323', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '0'),
(55, 58, 0, 0, 3, 0, 0, 0, '22222222222', '222222222222', '2222222222222222222', '0000-00-00', 'Male', 'Married', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `employee_deductions`
--

CREATE TABLE IF NOT EXISTS `employee_deductions` (
  `deduction_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `deducation_type` varchar(80) NOT NULL,
  `recurring` varchar(80) NOT NULL,
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
  `allowance_type` varchar(80) NOT NULL,
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
  `leave_type` varchar(80) NOT NULL,
  `remaining_hours` time NOT NULL,
  `as_of` date NOT NULL,
  `detail` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`leaves_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_loans`
--

CREATE TABLE IF NOT EXISTS `employee_loans` (
  `employee_loans_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `loan_no` int(11) NOT NULL,
  `loan_type` enum('SSS Salary Loan','Company Loan','Philhealth Loan','Pagibig Loan') NOT NULL,
  `date_granted` date NOT NULL,
  `principal` decimal(10,2) NOT NULL,
  `terms` decimal(10,2) NOT NULL,
  `interest_rates` decimal(10,2) NOT NULL,
  `penalty_rates` decimal(10,2) NOT NULL,
  `beginning_balance` decimal(10,2) NOT NULL,
  `monthly_amortization` decimal(10,2) NOT NULL,
  `loan_type_status` enum('New','Existing') NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`employee_loans_id`)
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `employment_type`
--

CREATE TABLE IF NOT EXISTS `employment_type` (
  `emp_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`emp_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `min` decimal(10,2) NOT NULL,
  `max` decimal(10,2) NOT NULL,
  `expense_date` date NOT NULL,
  `amount` date NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE IF NOT EXISTS `expense_type` (
  `expense_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_type_name` varchar(80) NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `require_receipt` decimal(10,2) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `government_registration`
--

INSERT INTO `government_registration` (`government_registration_id`, `tin`, `rdo_code`, `sss_id`, `hdmf`, `phil_health`, `category`, `company_id`, `status`, `deleted`) VALUES
(1, '1', '2', '3', '4', '5', 'regular', 2, 'Active', '0'),
(2, '123456', '123123123123', '4123123', '123123123', '3123123', 'regular', 3, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `gsis`
--

CREATE TABLE IF NOT EXISTS `gsis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `type_of_insurance_coverage` varchar(100) NOT NULL,
  `personal_share_life` decimal(10,2) NOT NULL,
  `personal_share_retirement` decimal(10,2) NOT NULL,
  `gov_share_life` decimal(10,2) NOT NULL,
  `gov_share_retirement` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hdmf`
--

CREATE TABLE IF NOT EXISTS `hdmf` (
  `hdmf_id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_bracket_id` int(11) NOT NULL,
  `range_of_compensation_from` decimal(10,2) NOT NULL,
  `range_of_compensation_to` decimal(10,2) NOT NULL,
  `monthly_salary_credit` decimal(10,2) NOT NULL,
  `employer_contribution1` decimal(10,2) NOT NULL,
  `employee_contribution2` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`hdmf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `job_grade`
--

CREATE TABLE IF NOT EXISTS `job_grade` (
  `job_grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `job_grade_name` varchar(100) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `konsum_admin`
--

INSERT INTO `konsum_admin` (`konsum_admin_id`, `account_id`, `name`, `status`, `deleted`) VALUES
(1, 1, 'admins cuizon', 'Active', '0'),
(7, 60, 'adminski', 'Inactive', '1'),
(8, 62, 'admin@yahoo.com', 'Inactive', '1'),
(9, 63, 'admin@yahoo.com', 'Inactive', '1'),
(10, 64, 'admin@yahoo.com', 'Inactive', '1'),
(11, 65, 'a', 'Inactive', '1'),
(12, 66, 'femae', 'Inactive', '1'),
(13, 67, 'christopher admin cuizon', 'Active', '0'),
(14, 68, 'jonathan admin bangga', 'Active', '0'),
(15, 69, 'adf', 'Active', '0'),
(16, 70, 'admin@yahoo.com', 'Active', '0'),
(17, 71, 'jonathan admin bangga', 'Active', '0'),
(18, 72, 'jonathan admin bangga', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

CREATE TABLE IF NOT EXISTS `leave` (
  `leave_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `to` date NOT NULL,
  `no_of_hours` float NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`leave_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `location_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `project_id`, `location_name`, `description`, `company_id`, `status`, `deleted`) VALUES
(1, 3, 'ramos street', 'oh yeah', 2, 'Active', '0'),
(2, 0, '', '', 8, 'Active', '0'),
(3, 0, '', '', 8, 'Active', '0'),
(4, 0, '', '', 8, 'Active', '0'),
(5, 0, '', '', 8, 'Active', '0'),
(6, 0, '', '', 8, 'Active', '0'),
(7, 0, '', '', 9, 'Active', '0'),
(8, 0, '', '', 9, 'Active', '0'),
(9, 0, '', '', 9, 'Active', '0'),
(10, 0, '', '', 9, 'Active', '0'),
(11, 0, '', '', 9, 'Active', '0'),
(12, 0, '', '', 9, 'Active', '0'),
(13, 0, '', '', 9, 'Active', '0'),
(14, 0, '', '', 9, 'Active', '0'),
(15, 0, '', '', 9, 'Active', '0'),
(16, 0, '', '', 9, 'Active', '0'),
(17, 0, '', '', 9, 'Active', '0'),
(18, 0, '', '', 9, 'Active', '0'),
(19, 0, '', '', 9, 'Active', '0'),
(20, 0, '', '', 9, 'Active', '0'),
(21, 0, '', '', 8, 'Active', '0'),
(22, 0, '', '', 4, 'Active', '0'),
(23, 0, '', '', 4, 'Active', '0'),
(24, 0, '', '', 2, 'Active', '0'),
(25, 0, '', '', 2, 'Active', '0'),
(26, 0, '', '', 2, 'Active', '0'),
(27, 0, '', '', 2, 'Active', '0'),
(28, 0, '', '', 2, 'Active', '0');

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
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `date` datetime NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `overtime_date` date NOT NULL,
  `overtime_type_id` varchar(100) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `project` varchar(100) NOT NULL,
  `project_location` varchar(150) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `no_of_hours` float NOT NULL,
  `with_nsd_hours` float NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`overtime_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `payroll_group`
--

INSERT INTO `payroll_group` (`payroll_group_id`, `payroll_group_name`, `minimum_net_pay`, `company_id`, `status`, `deleted`) VALUES
(1, 'konsum hrs', 4000.00, 2, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_system_account`
--

CREATE TABLE IF NOT EXISTS `payroll_system_account` (
  `payroll_system_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `subscription_date` datetime NOT NULL,
  `subscription_end_date` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`payroll_system_account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `payroll_system_account`
--

INSERT INTO `payroll_system_account` (`payroll_system_account_id`, `account_id`, `name`, `subscription_date`, `subscription_end_date`, `status`) VALUES
(4, 1, 'tetew', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Active'),
(5, 2, 'dsfsf', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Active'),
(6, 3, 'tetews', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Active'),
(7, 4, 'asdasd', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Active');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `permission_type_name`, `company_id`, `status`, `deleted`) VALUES
(1, 'hr only', 2, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `phil_health`
--

CREATE TABLE IF NOT EXISTS `phil_health` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_bracket` decimal(10,2) NOT NULL,
  `range_of_compensation_from` decimal(10,2) NOT NULL,
  `range_of_compensation_to` decimal(10,2) NOT NULL,
  `monthly_salary_credit` decimal(10,2) NOT NULL,
  `employer_contribution1` decimal(10,2) NOT NULL,
  `employer_contribution2` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `dept_id`, `position_name`, `company_id`, `status`, `deleted`) VALUES
(1, 0, 'human rights', 2, 'Active', '0'),
(2, 1, '8*', 0, 'Active', '0'),
(3, 1, '58', 0, 'Active', '0');

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
  `rank_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`rank_id`, `rank_name`, `description`, `company_id`, `status`, `deleted`) VALUES
(1, 'hr', 'hr ni siya oh yeha', 2, 'Active', '0'),
(2, '', '', 8, 'Active', '0'),
(3, '', '', 8, 'Active', '0'),
(4, '', '', 8, 'Active', '0'),
(5, '', '', 8, 'Active', '0'),
(6, '', '', 8, 'Active', '0'),
(7, '', '', 9, 'Active', '0'),
(8, '', '', 9, 'Active', '0'),
(9, '', '', 9, 'Active', '0'),
(10, '', '', 9, 'Active', '0'),
(11, '', '', 9, 'Active', '0'),
(12, '', '', 9, 'Active', '0'),
(13, '', '', 9, 'Active', '0'),
(14, '', '', 9, 'Active', '0'),
(15, '', '', 9, 'Active', '0'),
(16, '', '', 9, 'Active', '0'),
(17, '', '', 9, 'Active', '0'),
(18, '', '', 9, 'Active', '0'),
(19, '', '', 9, 'Active', '0'),
(20, '', '', 9, 'Active', '0'),
(21, '', '', 8, 'Active', '0'),
(22, '', '', 4, 'Active', '0'),
(23, '', '', 4, 'Active', '0'),
(24, '', '', 2, 'Active', '0'),
(25, '', '', 2, 'Active', '0'),
(26, '', '', 2, 'Active', '0'),
(27, '', '', 2, 'Active', '0'),
(28, '', '', 2, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `rest_day`
--

CREATE TABLE IF NOT EXISTS `rest_day` (
  `rest_day_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_group_id` int(11) NOT NULL,
  `rest_day_name` varchar(80) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

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
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(1, 'Initial Tax', 'Daily', 0.00, 0.00, 9.62, 48.08, 163.46, 432.69, 961.54, 2403.85, 1, 'Active'),
(2, 'Additional Tax', 'Daily', 0.00, 5.00, 10.00, 15.00, 20.00, 25.00, 30.00, 32.00, 1, 'Active'),
(3, 'Initial Tax', 'Semi Monthly', 0.00, 0.00, 20.83, 104.17, 354.17, 937.50, 2083.33, 5208.33, 1, 'Active'),
(4, 'Additional Tax', 'Semi Monthly', 0.00, 0.00, 417.00, 1250.00, 2917.00, 5833.00, 10417.00, 20833.00, 1, 'Active'),
(5, 'Initial Tax', 'Monthly', 0.00, 0.00, 41.67, 208.33, 708.33, 1875.00, 4166.67, 10416.67, 1, 'Active'),
(6, 'Additional Tax', 'Monthly', 0.00, 5.00, 10.00, 15.00, 20.00, 25.00, 30.00, 32.00, 1, 'Active'),
(7, 'Initial Tax', 'Weekly', 0.00, 0.00, 1.65, 8.25, 28.05, 74.26, 165.02, 412.54, 1, 'Active'),
(8, 'Additional Tax', 'Weekly', 0.00, 5.00, 10.00, 15.00, 20.00, 25.00, 30.00, 32.00, 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `withholding_tax_annual`
--

CREATE TABLE IF NOT EXISTS `withholding_tax_annual` (
  `withholding_tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_bracket` int(11) NOT NULL,
  `range_of_tax_from` decimal(10,2) NOT NULL,
  `range_of_tax_to` decimal(10,2) NOT NULL,
  `initial_tax` decimal(10,2) NOT NULL,
  `additional_tax` decimal(10,2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`withholding_tax_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `withholding_tax_annual`
--

INSERT INTO `withholding_tax_annual` (`withholding_tax_id`, `salary_bracket`, `range_of_tax_from`, `range_of_tax_to`, `initial_tax`, `additional_tax`, `company_id`, `status`) VALUES
(1, 1, 1.00, 10000.00, 0.00, 5.00, 1, 'Active'),
(2, 2, 10000.01, 30000.00, 500.00, 10.00, 1, 'Active');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `withholding_tax_status`
--

INSERT INTO `withholding_tax_status` (`withholding_tax_status_id`, `tax_name`, `tax_type`, `amount_excess1`, `amount_excess2`, `amount_excess3`, `amount_excess4`, `amount_excess5`, `amount_excess6`, `amount_excess7`, `amount_excess8`, `company_id`, `status`) VALUES
(1, 'z', 'Daily', 1.00, 0.00, 33.00, 99.00, 231.00, 462.00, 825.00, 1650.00, 1, 'Active'),
(2, 's', 'Daily', 1.00, 165.00, 198.00, 264.00, 396.00, 627.00, 990.00, 1815.00, 1, 'Active'),
(3, 'z', 'Semi Monthly', 0.00, 0.00, 417.00, 1250.00, 2917.00, 5833.00, 10417.00, 20833.00, 1, 'Active'),
(4, 's', 'Semi Monthly', 1.00, 2083.00, 2500.00, 3333.00, 5000.00, 7917.00, 12500.00, 22917.00, 1, 'Active'),
(5, 'z', 'Monthly', 1.00, 0.00, 833.00, 2500.00, 5833.00, 11667.00, 20833.00, 41667.00, 1, 'Active'),
(6, 's', 'Monthly', 1.00, 4167.00, 5000.00, 6667.00, 10000.00, 15833.00, 25000.00, 45833.00, 1, 'Active'),
(7, 'z', 'Weekly', 1.00, 0.00, 192.00, 577.00, 1346.00, 2692.00, 4808.00, 9615.00, 1, 'Active'),
(8, 's', 'Weekly', 1.00, 962.00, 1154.00, 1538.00, 2308.00, 3654.00, 5769.00, 10577.00, 1, 'Active');

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
