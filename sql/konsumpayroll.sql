-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2013 at 05:33 AM
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
-- Table structure for table `activity_logs`
--

CREATE TABLE IF NOT EXISTS `activity_logs` (
  `activity_logs_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `company_id` int(11) NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`activity_logs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`activity_logs_id`, `name`, `date`, `company_id`, `deleted`) VALUES
(1, 'administrator has login', '2013-10-18 11:16:27', 0, '0'),
(2, 'administrator has login', '2013-10-18 11:19:19', 0, '0'),
(3, 'administrator has login', '2013-10-21 02:32:20', 0, '0'),
(4, 'administrator has login', '2013-10-21 02:40:10', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE IF NOT EXISTS `allowances` (
  `allowance_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `allowance_type` varchar(50) NOT NULL,
  `taxable` decimal(10,0) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
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
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`allowance_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `area_name` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
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
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`area_of_approval_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `assign_company_head`
--

CREATE TABLE IF NOT EXISTS `assign_company_head` (
  `assign_company_head_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
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
  `current_basic_pay` decimal(10,0) NOT NULL,
  `new_basic_pay` decimal(10,0) NOT NULL,
  `effective_date` datetime NOT NULL,
  `adjustment_date` datetime NOT NULL,
  `reasons` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
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
  `rate` decimal(10,0) NOT NULL,
  `withholding_tax_rate` decimal(10,0) NOT NULL,
  `sales_amount` decimal(10,0) NOT NULL,
  `commision_amount` decimal(10,0) NOT NULL,
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
  `registered_business_name` varchar(80) NOT NULL,
  `sub_domain` varchar(15) NOT NULL,
  `trace_name` int(80) NOT NULL,
  `business_address` int(80) NOT NULL,
  `city` int(80) NOT NULL,
  `zipcode` int(80) NOT NULL,
  `organization_type` int(80) NOT NULL,
  `industy` int(80) NOT NULL,
  `business_phone` int(80) NOT NULL,
  `extension` int(80) NOT NULL,
  `mobile_number` int(80) NOT NULL,
  `fax` int(80) NOT NULL,
  `tin` int(80) NOT NULL,
  `rdo_code` int(80) NOT NULL,
  `sss_id` int(80) NOT NULL,
  `hdmf` int(80) NOT NULL,
  `phil_health` int(80) NOT NULL,
  `business_category` int(80) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `company_owner`
--

CREATE TABLE IF NOT EXISTS `company_owner` (
  `company_owner_id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_name` varchar(60) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `address` varchar(150) NOT NULL,
  `street` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `mobile` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`company_owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `company_owner`
--

INSERT INTO `company_owner` (`company_owner_id`, `owner_name`, `email_address`, `password`, `address`, `street`, `city`, `zipcode`, `mobile`, `country`, `date`, `status`, `deleted`) VALUES
(1, 'Joe Mercado', 'j.m@techgrowthglobal.com', '', 'Cebu', 'Street ', 'Cebu City', 6000, 1234857485, 'philippines', '2013-10-18 01:06:25', 'Active', '0'),
(2, 'Julian Tan', 'j.t@julian.com', '', 'Australia', 'Sydney', 'Australia', 6001, 1234857485, 'Australia', '2013-10-19 00:08:10', 'Active', '0'),
(3, 'Juan Dela Cruz', 'juan_dela@text.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(4, 'michi', 'arkitson@gmail.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(5, 'Juan Dela Cruz', 'arkitson@gmail.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(6, 'heheh', 'arkitdson@gmail.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(7, 'we234e', 'tes234324223423434t@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(8, 'we234e', 'adsfsfsdf@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(9, 'we234e', 'adssfsfsdf@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(10, 'we234e', 'adssfsfssdfdf@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(11, 'we234e', 'adsssdfsfssdfdf@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(12, 'we234e', 'adsssdfsdsffssdfdf@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(13, 'we234e', 'adsssdfsfdsffssdfdf@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(14, 'we234e', 'adsssdfsffdsffssdfdf@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(15, 'we234e', 'adsssdfsffdsbffssdfdf@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(16, 'we234e', 'adsssdfsffdssdfbffssdfdf@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(17, 'we234e', 'adsssdfsffdssdfbffssddfsfdf@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(18, 'sfsf', 'sdfsdf@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(19, 'megan', 'fox@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(20, 'megan', 'fox@yahodo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(21, 'megansd', 'fomegansdx@yahodo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(22, 'safsf', 'sdfsdf@test.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(23, 'safsffsdf', 'sdfsdsdff@test.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(24, 'users234', 'tewtew@yahoo.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(25, 'sdfsdf', 'sdfs323df@test.com', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(26, 'obama', 'obama@yahoo.com', '12345678', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0'),
(27, 'atan', 'atan@yahoo.com', 'atanatan', '', '', '', 0, 0, '', '0000-00-00 00:00:00', 'Active', '0');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE IF NOT EXISTS `earnings` (
  `earning_id` int(11) NOT NULL AUTO_INCREMENT,
  `earning_name` varchar(80) NOT NULL,
  `taxable` enum('Yes','No') NOT NULL,
  `max_non_taxable_amount_per_month` decimal(10,0) NOT NULL,
  `withholding_tax_rate` decimal(10,0) NOT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `lname` varchar(80) NOT NULL,
  `fname` varchar(80) NOT NULL,
  `mname` varchar(80) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `marital_status` enum('Married','Single','Widow','Divorce') NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(80) NOT NULL,
  `photo` text NOT NULL,
  `tin` varchar(80) NOT NULL,
  `sss` varchar(80) NOT NULL,
  `phil_health` varchar(80) NOT NULL,
  `gsis` varchar(80) NOT NULL,
  `emergency_contact_person` varchar(80) NOT NULL,
  `emergency_contact_number` varchar(80) NOT NULL,
  `position_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `amount` decimal(10,0) NOT NULL,
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
  `statutory_min_wage` decimal(10,0) NOT NULL,
  `entitled_to_basic_pay` varchar(80) NOT NULL,
  `basic_pay_amount` decimal(10,0) NOT NULL,
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
  `amount` decimal(10,0) NOT NULL,
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
  `principal` decimal(10,0) NOT NULL,
  `terms` decimal(10,0) NOT NULL,
  `interest_rates` decimal(10,0) NOT NULL,
  `penalty_rates` decimal(10,0) NOT NULL,
  `beginning_balance` decimal(10,0) NOT NULL,
  `monthly_amortization` decimal(10,0) NOT NULL,
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
  `principal` decimal(10,0) NOT NULL,
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
  `emp_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
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
  `min` decimal(10,0) NOT NULL,
  `max` decimal(10,0) NOT NULL,
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
  `minimum_amount` decimal(10,0) NOT NULL,
  `maximum_amount` decimal(10,0) NOT NULL,
  `require_receipt` decimal(10,0) NOT NULL,
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
  `tin` int(11) NOT NULL,
  `rdo_code` int(11) NOT NULL,
  `sss_id` varchar(50) NOT NULL,
  `hdmf` varchar(50) NOT NULL,
  `phil_health` varchar(50) NOT NULL,
  `category` enum('household','regular','non-regular','probie') NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`government_registration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gsis`
--

CREATE TABLE IF NOT EXISTS `gsis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `type_of_insurance_coverage` varchar(100) NOT NULL,
  `personal_share_life` decimal(10,0) NOT NULL,
  `personal_share_retirement` decimal(10,0) NOT NULL,
  `gov_share_life` decimal(10,0) NOT NULL,
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
  `range_of_compensation_from` decimal(10,0) NOT NULL,
  `range_of_compensation_to` decimal(10,0) NOT NULL,
  `monthly_salary_credit` decimal(10,0) NOT NULL,
  `employer_contribution1` decimal(10,0) NOT NULL,
  `employee_contribution2` decimal(10,0) NOT NULL,
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
  `rate` decimal(10,0) NOT NULL,
  `no_of_hours` decimal(10,0) NOT NULL,
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
  `pay_rate` decimal(10,0) NOT NULL,
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
  `hours_required_regular` decimal(10,0) NOT NULL,
  `hours_required_holiday` decimal(10,0) NOT NULL,
  `hours_worked_regular` decimal(10,0) NOT NULL,
  `hours_worked_holiday` decimal(10,0) NOT NULL,
  `tardiness` decimal(10,0) NOT NULL,
  `undertime` decimal(10,0) NOT NULL,
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
  `username` varchar(80) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`konsum_admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `konsum_admin`
--

INSERT INTO `konsum_admin` (`konsum_admin_id`, `username`, `password`, `name`, `email_address`, `status`, `deleted`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'christopher cuizon', 'admin@yahoo.com', 'Active', '1'),
(8, 'madz@yaho', '6829185cd5d11a4b191a2615873a93f8', 'madz', 'madz@yahoo.com', 'Active', '0'),
(9, 'jonathan', '78842815248300fa6ae79f7776a5080a', 'jonathan', 'jonathan@gmail.com', 'Active', '0'),
(10, 'joechristian', '541d98adec241e382bbcba5e1bd21f38', 'joechristian', 'joechristian@yahoo.com', 'Active', '0');

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
  `penalty` decimal(10,0) NOT NULL,
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
  `amount` decimal(10,0) NOT NULL,
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
  `principal` decimal(10,0) NOT NULL,
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
-- Table structure for table `other_earnings`
--

CREATE TABLE IF NOT EXISTS `other_earnings` (
  `other_earnings_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `earning_type` varchar(50) NOT NULL,
  `withholding_tax_rate` decimal(10,0) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
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
  `rate` decimal(10,0) NOT NULL,
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
  `pay_rate` decimal(10,0) NOT NULL,
  `ot_rate` decimal(10,0) NOT NULL,
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
  `minimum_net_pay` decimal(10,0) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`payroll_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `salary_bracket` decimal(10,0) NOT NULL,
  `range_of_compensation_from` decimal(10,0) NOT NULL,
  `range_of_compensation_to` decimal(10,0) NOT NULL,
  `monthly_salary_credit` decimal(10,0) NOT NULL,
  `employer_contribution1` decimal(10,0) NOT NULL,
  `employer_contribution2` decimal(10,0) NOT NULL,
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
  `rate` decimal(10,0) NOT NULL,
  `units_produced` decimal(10,0) NOT NULL,
  `piece_rate_amount` decimal(10,0) NOT NULL,
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
  `position_name` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `sss`
--

CREATE TABLE IF NOT EXISTS `sss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_brackets` decimal(10,0) NOT NULL,
  `range_compensation_from` decimal(10,0) NOT NULL,
  `range_compensation_to` decimal(10,0) NOT NULL,
  `monthly_salary_credit` decimal(10,0) NOT NULL,
  `employer_monthly_contribution_ss` decimal(10,0) NOT NULL,
  `employer_monthly_contribution_ec` decimal(10,0) NOT NULL,
  `employee_ss` decimal(10,0) NOT NULL,
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
-- Table structure for table `user_credentials`
--

CREATE TABLE IF NOT EXISTS `user_credentials` (
  ` emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_cloud_id` int(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  `access_level` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `payroll_group_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (` emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `withholding tax_status`
--

CREATE TABLE IF NOT EXISTS `withholding tax_status` (
  `withholding_tax_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `withholding_tax_id` int(11) NOT NULL,
  `tax_name` varchar(7) NOT NULL,
  `tax_type` enum('Monthly','Weekly','Semi Monthly','Daily') NOT NULL,
  `amount_excess1` decimal(10,0) NOT NULL,
  `amount_excess2` decimal(10,0) NOT NULL,
  `amount_excess3` decimal(10,0) NOT NULL,
  `amount_excess4` decimal(10,0) NOT NULL,
  `amount_excess5` decimal(10,0) NOT NULL,
  `amount_excess6` decimal(10,0) NOT NULL,
  `amount_excess7` decimal(10,0) NOT NULL,
  `amount_excess8` decimal(10,0) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`withholding_tax_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `withholding_tax`
--

CREATE TABLE IF NOT EXISTS `withholding_tax` (
  ` 	withholding_tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_name` enum('Initial Tax','Additional Tax') NOT NULL,
  `tax_type` enum('Monthly','Weekly','Semi Monthly','Daily') NOT NULL,
  `tax1` decimal(10,0) NOT NULL,
  `tax2` decimal(10,0) NOT NULL,
  `tax3` decimal(10,0) NOT NULL,
  `tax4` decimal(10,0) NOT NULL,
  `tax5` decimal(10,0) NOT NULL,
  `tax6` decimal(10,0) NOT NULL,
  `tax7` decimal(10,0) NOT NULL,
  `tax8` date NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (` 	withholding_tax_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `withholding_tax_annual`
--

CREATE TABLE IF NOT EXISTS `withholding_tax_annual` (
  `withholding_tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_bracket` int(11) NOT NULL,
  `range_of_tax_from` decimal(10,0) NOT NULL,
  `range_of_tax_to` decimal(10,0) NOT NULL,
  `initial_tax` decimal(10,0) NOT NULL,
  `additional_tax` date NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`withholding_tax_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `user_credentials` (` emp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
