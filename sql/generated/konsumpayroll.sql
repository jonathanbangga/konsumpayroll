-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2013 at 08:30 AM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `payroll_cloud_id`, `payroll_system_account_id`, `password`, `account_type_id`, `email`, `user_type_id`, `token`, `deleted`) VALUES
(1, 'admin', 0, '7b591a2a55585e166465a838c28a2c5f', 1, 'admin@yahoo.com', 1, '85c2e269c6306a4e7a90d6ee7cb51f5f', '0'),
(2, 'owner@test.com', 2, '7b591a2a55585e166465a838c28a2c5f', 2, 'owner@test.com', 2, '', '0'),
(3, 'techgrowthglobal@techgrowthglobal.com', 0, '0630f267362249665efde740072e77c3', 2, 'techgrowthglobal@techgrowthglobal.com', 2, '', '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`activity_logs_id`, `name`, `date`, `company_id`, `deleted`) VALUES
(1, 'administrator has added a company', '2013-11-25 08:08:28', 0, '0'),
(2, 'administrator has added a company', '2013-11-25 08:15:41', 0, '0');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `company_owner`
--

INSERT INTO `company_owner` (`company_owner_id`, `first_name`, `middle_name`, `last_name`, `owner_name`, `dob`, `address`, `street`, `city`, `zipcode`, `home_no`, `mobile_no`, `emergency_contact_person`, `emergency_contact_number`, `security_question`, `security_answer`, `country`, `date`, `account_id`) VALUES
(2, '', '', '', 'Owner Profile', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '2013-11-25 04:26:19', 2),
(3, '', '', '', 'Techgrowth admin', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '2013-11-25 08:21:12', 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
  `security_question` varchar(80) NOT NULL,
  `security_answer` varchar(80) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

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
  `remaining_hours` varchar(255) NOT NULL,
  `as_of` date NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`leaves_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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
  `note` text NOT NULL,
  `leave_application_status` enum('pending','approve','reject') NOT NULL DEFAULT 'pending',
  `attachments` text NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`employee_leaves_application_id`)
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
  `selected` int(1) NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`emp_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `konsum_admin`
--

INSERT INTO `konsum_admin` (`konsum_admin_id`, `account_id`, `name`, `status`, `deleted`) VALUES
(1, 1, 'administrator', 'Active', '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `account_id`, `payroll_system_account_id`, `name`, `date`, `deleted`) VALUES
(1, 0, 0, '2', '2013-11-25 08:08:28', '0'),
(2, 0, 0, '2', '2013-11-25 08:15:41', '0');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payroll_system_account`
--

INSERT INTO `payroll_system_account` (`payroll_system_account_id`, `account_id`, `name`, `sub_domain`, `subscription_date`, `subscription_end_date`, `status`) VALUES
(2, 2, 'konsum TECHNOLOGY', 'konsum-technology', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `hr_setup_properties`
--

CREATE TABLE IF NOT EXISTS `hr_setup_properties` (
  `hr_setup_properties_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `include_hr_for_confirmation` int(11) NOT NULL,
  `leave_day_num_of_hours` int(11) NOT NULL,
  `month_num_of_workdays` int(11) NOT NULL,
  PRIMARY KEY (`hr_setup_properties_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


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
