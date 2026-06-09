-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2025 at 03:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_crs1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_course`
--

CREATE TABLE `tb_course` (
  `c_code` varchar(8) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_credit` int(11) NOT NULL,
  `c_department` int(11) NOT NULL,
  `c_coordinator` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_course`
--

INSERT INTO `tb_course` (`c_code`, `c_name`, `c_credit`, `c_department`, `c_coordinator`) VALUES
('SECD3761', 'Technopreneurship Seminar (WBL)', 1, 3, '1113'),
('SECI1013', 'Discrete Structure', 3, 3, '1112'),
('SECI1113', 'Computational Mathematics', 3, 4, '1113'),
('SECI1143', 'Probability and Statistical Data Analysis', 3, 1, '1114'),
('SECJ1013', 'Programming Technique I', 3, 3, '1115'),
('SECJ1023', 'Programming Technique II', 3, 4, '1116'),
('SECJ2013', 'Data Structure and Algorithm', 3, 2, '1125'),
('SECJ2154', 'Object-Oriented Programming', 4, 4, '1117'),
('SECJ2253', 'Requirements Engineering & Software Modelling', 3, 1, '1118'),
('SECJ2363', 'Software Project Management', 3, 2, '1119'),
('SECJ3032', 'Software Engineering Project I', 2, 3, '1120'),
('SECJ3203', 'Theory of Computer Science', 3, 4, '1121'),
('SECP1513', 'Technology and Information Systems  (WBL)', 3, 1, '1122'),
('SECP2523', 'Database (WBL)', 3, 2, '1123'),
('SECP2613', 'System Analysis and Design (WBL)', 3, 3, '1124'),
('SECP2633', 'Information Retrieval', 3, 4, '1125'),
('SECP2733', 'Multimedia Data Modeling (WBL)', 3, 1, '10199'),
('SECP2753', 'Data Mining', 3, 2, '7800'),
('SECP3106', 'Application Development (WBL)', 6, 3, '8960'),
('SECP3133', 'High Performance Data Processing', 3, 4, '1111'),
('SECP3204', 'Software Engineering (WBL)', 4, 1, '1112'),
('SECP3213', 'Business Intelligence', 3, 2, '1113'),
('SECP3223', 'Data Analytic Programming', 3, 3, '1114'),
('SECP3416', 'Management Information Systems (WBL)', 6, 4, '1115'),
('SECP3623', 'Database Programming', 3, 1, '1116'),
('SECP3713', 'Database Administration', 3, 2, '1117'),
('SECP3723', 'System Development Technology (WBL)', 3, 3, '10199'),
('SECP3744', 'Enterprise Systems Design and Modeling (WBL)', 4, 4, '1119'),
('SECP3823', 'Knowledge Management Systems (WBL)', 3, 1, '1120'),
('SECP3843', 'Special Topic in Data Engineering (WBL)', 3, 2, '1121'),
('SECP4112', 'Initial Industry Project Proposal', 4, 3, '1122'),
('SECP4114', 'Professional Development', 4, 4, '1123'),
('SECP4124', 'Professional Practice', 4, 1, '1124'),
('SECP4134', 'Professional Development and Practice Report', 4, 1, '1125'),
('SECP4223', 'Industrial Integrated Project Proposal', 3, 2, '7800'),
('SECR1013', 'Digital Logic', 3, 3, '8960'),
('SECR1033', 'Computer Organization and Architecture', 3, 4, '10199'),
('SECR1213', 'Network Comm', 3, 3, '1113'),
('SECR2043', 'Operating System', 3, 1, '1111'),
('SECR2213', 'Network Communication', 3, 2, '1112'),
('SECV2113', 'Human Computer Interaction', 3, 3, '1113'),
('SECV2223', 'Web Programming', 3, 4, '1114'),
('ULRF2492', 'Photocreative Services', 2, 2, '1123');

-- --------------------------------------------------------

--
-- Table structure for table `tb_department`
--

CREATE TABLE `tb_department` (
  `d_id` int(11) NOT NULL,
  `d_name` varchar(255) NOT NULL,
  `d_faculty` int(11) NOT NULL,
  `d_director` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_department`
--

INSERT INTO `tb_department` (`d_id`, `d_name`, `d_faculty`, `d_director`) VALUES
(1, 'Applied Computing And Artificial Intelligence', 5, '1121'),
(2, 'Computer Science', 5, '1122'),
(3, 'Emergent Computing', 5, '1123'),
(4, 'Software Engineering', 5, '1124');

-- --------------------------------------------------------

--
-- Table structure for table `tb_faculty`
--

CREATE TABLE `tb_faculty` (
  `f_id` int(11) NOT NULL,
  `f_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_faculty`
--

INSERT INTO `tb_faculty` (`f_id`, `f_desc`) VALUES
(1, 'Faculty of Civil Engineering'),
(2, 'Faculty of Chemical Engineering and Energy Engineering'),
(3, 'Faculty of Mechanical Engineering'),
(4, 'Faculty of Electrical Engineering'),
(5, 'Faculty of Computing'),
(6, 'Faculty of Artificial Intelligence'),
(7, 'Faculty of Science'),
(8, 'Faculty of Built Environment and Surverying'),
(9, 'Faculty of Social Sciences and Humanities'),
(10, 'Faculty of Management'),
(11, 'Malaysia-Japan International Institute of Technology'),
(12, 'Azman Hashim International Business School'),
(13, 'Faculty of Education Sciences and Technology');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lecturer`
--

CREATE TABLE `tb_lecturer` (
  `l_id` varchar(20) NOT NULL,
  `l_no` varchar(10) NOT NULL,
  `l_department` varchar(255) NOT NULL,
  `l_faculty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_lecturer`
--

INSERT INTO `tb_lecturer` (`l_id`, `l_no`, `l_department`, `l_faculty`) VALUES
('haza', '10199', '1', 5),
('izyanizzati', '1111', '1', 5),
('johanna', '1112', '1', 5),
('foad', '1113', '1', 5),
('muhammadaliif', '1114', '1', 5),
('miqbaltariq', '1115', '1', 5),
('noorfa', '1116', '1', 5),
('nureiliyah', '1117', '1', 5),
('rozilawati', '1118', '1', 5),
('aszuraini', '1119', '1', 5),
('zuriahati', '1120', '1', 5),
('dr.asri', '1121', '2', 5),
('sharin', '1122', '1', 5),
('farhan', '1123', '3', 5),
('radziahm', '1124', '4', 5),
('mrazak', '1125', '4', 5),
('ahmad', '1126', '3', 5),
('ali', '1127', '2', 5),
('zainal', '1128', '4', 5),
('hakim', '1129', '4', 5),
('aryati', '7800', '1', 5),
('ismailfauzi', '8960', '1', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_prerequsite`
--

CREATE TABLE `tb_prerequsite` (
  `p_course` varchar(8) NOT NULL,
  `p_prerequisite` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_prerequsite`
--

INSERT INTO `tb_prerequsite` (`p_course`, `p_prerequisite`) VALUES
('SECI1113', 'SECI1013'),
('SECJ1023', 'SECJ1013'),
('SECJ2013', 'SECJ1013'),
('SECJ2013', 'SECJ1023');

-- --------------------------------------------------------

--
-- Table structure for table `tb_programme`
--

CREATE TABLE `tb_programme` (
  `p_code` varchar(5) NOT NULL,
  `p_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_programme`
--

INSERT INTO `tb_programme` (`p_code`, `p_name`) VALUES
('SECBH', 'Bachelor of Computer Science (Bioinformatics) with Honours'),
('SECJH', 'Bachelor of Computer Science (Software Engineering) with Honours '),
('SECPH', 'Bachelor of Computer Science (Data \r\nEngineering) with Honours ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_registration`
--

CREATE TABLE `tb_registration` (
  `r_id` int(11) NOT NULL,
  `r_student` varchar(10) NOT NULL,
  `r_semester` varchar(11) NOT NULL,
  `r_course` varchar(8) NOT NULL,
  `r_section` int(11) NOT NULL,
  `r_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_registration`
--

INSERT INTO `tb_registration` (`r_id`, `r_student`, `r_semester`, `r_course`, `r_section`, `r_status`) VALUES
(6, 'A23CS0233', '2024/2025-1', 'SECP2523', 2, 3),
(10, 'A23CS0240', '2024/2025-1', 'SECP2523', 1, 3),
(12, 'A23CS0240', '2024/2025-1', 'SECP3723', 2, 3),
(17, 'A23CS0233', '2024/2025-1', 'SECJ1013', 1, 3),
(19, 'A23CS0187', '2024/2025-1', 'SECJ1013', 1, 3),
(20, 'A23CS0191', '2024/2025-1', 'SECJ1013', 1, 3),
(33, 'A23CS0191', '2024/2025-1', 'SECP2523', 2, 3),
(36, 'A23CS0233', '2024/2025-1', 'SECP3204', 2, 3),
(39, 'A23CS0240', '2024/2025-1', 'SECJ2013', 3, 3),
(40, 'A23CS0240', '2024/2025-1', 'SECP3204', 1, 3),
(42, 'A23CS0002', '2024/2025-1', 'SECP2523', 2, 3),
(43, 'A23CS0001', '2024/2025-1', 'SECP2523', 2, 3),
(44, 'A23CS0187', '2024/2025-1', 'SECP2523', 2, 3),
(46, 'A23CS0224', '2024/2025-1', 'SECP2523', 2, 3),
(47, 'A23CS0233', '2023/2024-2', 'SECP3213', 4, 3),
(48, 'A23CS0233', '2023/2024-2', 'SECI1013', 1, 3),
(49, 'A23CS0233', '2023/2024-2', 'SECI1143', 2, 3),
(50, 'A23CS0233', '2023/2024-2', 'SECP2613', 1, 3),
(51, 'A23CS0233', '2023/2024-2', 'SECP3723', 1, 3),
(52, 'A23CS0240', '2023/2024-2', 'SECJ1023', 2, 3),
(53, 'A23CS0240', '2023/2024-2', 'SECI1013', 2, 3),
(54, 'A23CS0240', '2023/2024-2', 'SECP3213', 1, 3),
(55, 'A23CS0240', '2023/2024-2', 'SECP2613', 1, 3),
(56, 'A23CS0240', '2023/2024-2', 'SECR2043', 2, 3),
(57, 'A23CS0187', '2023/2024-2', 'SECI1013', 1, 3),
(58, 'A23CS0187', '2023/2024-2', 'SECJ1023', 1, 3),
(59, 'A23CS0187', '2023/2024-2', 'SECP2613', 1, 3),
(60, 'A23CS0187', '2023/2024-2', 'SECP3213', 1, 3),
(61, 'A23CS0187', '2023/2024-2', 'SECP3723', 3, 3),
(62, 'A23CS0224', '2023/2024-2', 'SECP3723', 3, 3),
(63, 'A23CS0224', '2023/2024-2', 'SECJ1023', 1, 3),
(64, 'A23CS0224', '2023/2024-2', 'SECP3213', 1, 3),
(65, 'A23CS0224', '2023/2024-2', 'SECI1143', 3, 3),
(66, 'A23CS0224', '2023/2024-2', 'SECP2613', 2, 3),
(67, 'A23CS0001', '2023/2024-2', 'SECP3723', 3, 3),
(68, 'A23CS0001', '2023/2024-2', 'SECI1143', 3, 3),
(69, 'A23CS0001', '2023/2024-2', 'SECP3213', 3, 3),
(70, 'A23CS0001', '2023/2024-2', 'SECJ1023', 2, 3),
(71, 'A23CS0001', '2023/2024-2', 'SECI1013', 2, 3),
(72, 'A23CS0001', '2023/2024-2', 'SECR2043', 3, 3),
(73, 'A23CS0002', '2023/2024-2', 'SECI1143', 2, 3),
(74, 'A23CS0002', '2023/2024-2', 'SECP2613', 2, 3),
(75, 'A23CS0002', '2023/2024-2', 'SECP3213', 3, 3),
(76, 'A23CS0002', '2023/2024-2', 'SECJ1023', 5, 3),
(77, 'A23CS0002', '2023/2024-2', 'SECR2043', 2, 3),
(78, 'A23CS0002', '2023/2024-2', 'SECI1013', 1, 3),
(79, 'A23CS0233', '2024/2025-1', 'SECP3723', 1, 3),
(80, 'A23CS0233', '2024/2025-1', 'SECP3744', 1, 3),
(81, 'A23CS0224', '2024/2025-1', 'SECP3744', 1, 3),
(82, 'A23CS0001', '2024/2025-1', 'SECP3744', 1, 3),
(83, 'A23CS0001', '2024/2025-1', 'SECP3723', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_section`
--

CREATE TABLE `tb_section` (
  `s_course` varchar(8) NOT NULL,
  `s_no` int(11) NOT NULL,
  `s_lecturer` varchar(10) DEFAULT NULL,
  `s_capacity` int(11) NOT NULL,
  `s_semester` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_section`
--

INSERT INTO `tb_section` (`s_course`, `s_no`, `s_lecturer`, `s_capacity`, `s_semester`) VALUES
('SECI1013', 1, '10199', 20, '2023/2024-2'),
('SECI1013', 1, '1115', 20, '2024/2025-1'),
('SECI1013', 2, '1111', 10, '2023/2024-2'),
('SECI1013', 2, '1126', 25, '2024/2025-1'),
('SECI1013', 3, '1112', 30, '2023/2024-2'),
('SECI1013', 3, '1125', 35, '2024/2025-1'),
('SECI1013', 4, '1121', 30, '2024/2025-1'),
('SECI1013', 5, '1113', 25, '2024/2025-1'),
('SECI1143', 1, '1113', 20, '2023/2024-2'),
('SECI1143', 1, NULL, 0, '2024/2025-1'),
('SECI1143', 2, '1114', 30, '2023/2024-2'),
('SECI1143', 2, NULL, 0, '2024/2025-1'),
('SECI1143', 3, '1115', 30, '2023/2024-2'),
('SECI1143', 4, '1116', 30, '2023/2024-2'),
('SECI1143', 5, '1117', 30, '2023/2024-2'),
('SECJ1013', 1, '10199', 30, '2024/2025-1'),
('SECJ1013', 2, '1111', 20, '2024/2025-1'),
('SECJ1013', 3, '1114', 25, '2024/2025-1'),
('SECJ1013', 4, '1112', 30, '2024/2025-1'),
('SECJ1013', 5, '1111', 30, '2024/2025-1'),
('SECJ1013', 6, '1113', 30, '2024/2025-1'),
('SECJ1013', 7, '1111', 30, '2024/2025-1'),
('SECJ1013', 8, '1124', 30, '2024/2025-1'),
('SECJ1013', 9, '7800', 30, '2024/2025-1'),
('SECJ1023', 1, '10199', 20, '2023/2024-2'),
('SECJ1023', 2, '1118', 20, '2023/2024-2'),
('SECJ1023', 3, '1119', 20, '2023/2024-2'),
('SECJ1023', 4, '1120', 20, '2023/2024-2'),
('SECJ1023', 5, '1121', 20, '2023/2024-2'),
('SECJ1023', 6, '1122', 20, '2023/2024-2'),
('SECJ2013', 2, '1117', 30, '2024/2025-1'),
('SECJ2013', 3, '1120', 20, '2024/2025-1'),
('SECJ2013', 4, '1126', 25, '2024/2025-1'),
('SECJ2013', 5, '1128', 25, '2024/2025-1'),
('SECP2523', 1, '1118', 30, '2024/2025-1'),
('SECP2523', 2, '1116', 30, '2024/2025-1'),
('SECP2613', 1, '1122', 20, '2023/2024-2'),
('SECP2613', 2, '1123', 30, '2023/2024-2'),
('SECP3204', 1, '7800', 30, '2024/2025-1'),
('SECP3204', 2, '1113', 30, '2024/2025-1'),
('SECP3213', 1, '1124', 20, '2023/2024-2'),
('SECP3213', 2, '1125', 30, '2023/2024-2'),
('SECP3213', 3, '1126', 30, '2023/2024-2'),
('SECP3213', 4, '1127', 20, '2023/2024-2'),
('SECP3723', 1, '7800', 20, '2023/2024-2'),
('SECP3723', 1, '10199', 30, '2024/2025-1'),
('SECP3723', 2, '8960', 30, '2023/2024-2'),
('SECP3723', 2, '1116', 30, '2024/2025-1'),
('SECP3723', 3, '10199', 20, '2023/2024-2'),
('SECP3723', 3, '1114', 20, '2024/2025-1'),
('SECP3723', 4, '1125', 30, '2024/2025-1'),
('SECP3744', 1, '1116', 30, '2024/2025-1'),
('SECP3744', 2, '1117', 30, '2024/2025-1'),
('SECP3744', 3, '1118', 30, '2024/2025-1'),
('SECP3744', 4, '1119', 30, '2024/2025-1'),
('SECR2043', 1, '1128', 20, '2023/2024-2'),
('SECR2043', 2, '1129', 30, '2023/2024-2'),
('SECR2043', 3, '10199', 20, '2023/2024-2'),
('SECR2213', 1, NULL, 0, '2024/2025-1'),
('SECR2213', 2, NULL, 0, '2024/2025-1'),
('SECR2213', 3, NULL, 0, '2024/2025-1'),
('SECR2213', 4, NULL, 0, '2024/2025-1'),
('SECR2213', 5, NULL, 0, '2024/2025-1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_staff`
--

CREATE TABLE `tb_staff` (
  `s_id` varchar(20) NOT NULL,
  `s_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_staff`
--

INSERT INTO `tb_staff` (`s_id`, `s_no`) VALUES
('azmaniza', '2000'),
('mawarabdul', '2002'),
('siti', '2003'),
('sp-rohani', '2001');

-- --------------------------------------------------------

--
-- Table structure for table `tb_state`
--

CREATE TABLE `tb_state` (
  `s_id` int(11) NOT NULL,
  `s_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_state`
--

INSERT INTO `tb_state` (`s_id`, `s_desc`) VALUES
(1, 'Johor'),
(2, 'Kedah'),
(3, 'Kelantan'),
(4, 'Malacca'),
(5, 'Negeri Sembilan'),
(6, 'Pahang'),
(7, 'Penang'),
(8, 'Perak'),
(9, 'Perlis'),
(10, 'Sabah'),
(11, 'Sarawak'),
(12, 'Selangor'),
(13, 'Tenrengganu'),
(14, 'WP Kuala Lumpur'),
(15, 'WP Labuan'),
(16, 'WP Putrajaya');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `s_id` int(11) NOT NULL,
  `s_desc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`s_id`, `s_desc`) VALUES
(1, 'Draft'),
(2, 'Submitted'),
(3, 'Approved'),
(4, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `tb_student`
--

CREATE TABLE `tb_student` (
  `s_id` varchar(20) NOT NULL,
  `s_no` varchar(10) NOT NULL,
  `s_programme` varchar(5) NOT NULL,
  `s_intake` varchar(11) NOT NULL,
  `s_advisor` varchar(10) NOT NULL,
  `s_faculty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_student`
--

INSERT INTO `tb_student` (`s_id`, `s_no`, `s_programme`, `s_intake`, `s_advisor`, `s_faculty`) VALUES
('roslan', 'A23CS0001', 'SECJH', '2024/2025-1', '10199', 5),
('dayang', 'A23CS0002', 'SECPH', '2024/2025-1', '10199', 5),
('johan', 'A23CS0003', 'SECBH', '2024/2025-1', '1128', 5),
('linzhiping', 'A23CS004', 'SECBH', '2024/2025-1', '1127', 5),
('tanyiya', 'A23CS0187', 'SECPH', '2023/2024-1', '1114', 5),
('tehruqian', 'A23CS0191', 'SECPH', '2023/2024-1', '10199', 5),
('goeying', 'A23CS0224', 'SECPH', '2023/2024-1', '1115', 5),
('lam.yu', 'A23CS0233', 'SECPH', '2023/2024-1', '10199', 5),
('xinroulim', 'A23CS0240', 'SECJH', '2023/2024-1', '1115', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `u_id` varchar(20) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_type` int(11) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `u_ic` varchar(14) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_contact` varchar(20) NOT NULL,
  `u_address1` varchar(255) NOT NULL,
  `u_address2` varchar(255) NOT NULL,
  `u_city` varchar(100) NOT NULL,
  `u_postcode` int(11) NOT NULL,
  `u_state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`u_id`, `u_password`, `u_type`, `u_name`, `u_ic`, `u_email`, `u_contact`, `u_address1`, `u_address2`, `u_city`, `u_postcode`, `u_state`) VALUES
('ahmad', '$2y$10$TOxa4fzoHZWf0rtIDsAruuYKh2OIiVQIKbfBGzoCL1rCUT96GR87i', 2, 'Ahmad bin Ahman', '000000-00-0000', 'ahmad@utm.my', '0123456', 'Jalan Indah', 'Taman Indah', 'Indah', 50000, 4),
('ali', '$2y$10$LQfUkj5rECv43wOtm0/lLOt.t1h6AzvVW8CZqE3eB2gqTI9uFkgQy', 2, 'Ali bin Abu', '000000-00-000', 'ali@utm.my', '0123456789', 'Jalan Ali', 'Taman Ali', 'Ali', 40000, 8),
('aryati', '$2y$10$pWJSn0NGi17d3KC5Olrdwunata/GRt3KvOlz.cuBvfhXzAA3JZ0.u', 2, 'Dr. Aryati binti Bakri', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('aszuraini', '123456', 2, 'Dr. Zuraini binti Ali Shah', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('azmaniza', '123456', 3, 'Azmaniza binti Aziz', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('dayang', '$2y$10$tOEbf0WHlOEr8sukhIPs4.Q3G7my9L./ia3/6sZ1oeK3jeWkWsK9W', 1, 'Dayang Farah', '000000-00-0000', 'dayang@graduate.utm.my', '0123456789', 'Jalan Kuching', 'Taman Kuching', 'Kuching', 10000, 11),
('dr.asri', '123456', 2, 'Prof. Ts. Dr. Md Asri bin Ngadi', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('farhan', '123456', 2, 'Assoc. Prof. Ts. Dr. Farhan bin Mohamed', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('foad', '123456', 2, 'Dr. Mohd Fo’ad bin Rohani', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('goeying', '$2y$10$ekwr3bwc8gqSKYun0xkHmeYoY/gckrjPoXf.YsD2GjfobEvhnDu9S', 1, 'Goe Jie Ying', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('hakim', '$2y$10$RE3M3QpdyIPjScSsgTl.Ruj3ghiDKhmcusT4q1R0lohe97OQ4wj1C', 2, 'Hakim bin Hakim', '000000-00-0000', 'hakim@utm.my', '0123456789', 'Jalan Mahkamah', 'Taman Mahkamah', 'Mahkamah', 12345, 4),
('haza', '$2y$10$2JNHJK1HBIOMnwNwp7ddKepu36.3xdINH6bldykew2D4frvIGKFAy', 2, 'Assoc. Prof. Dr. Haza Nuzly bin Abdull Hamed', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('ismailfauzi', '123456', 2, 'Assoc. Prof. Dr. Ismail Fauzi bin Isnin', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('izyanizzati', '123456', 2, 'Dr. Izyan Izzati binti Kamsani', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('johan', '$2y$10$506mlEi/9Tfgjmgzvhcw/uuE.2yrp0TenUgwprSqD7k.RISmjUghS', 1, 'Johan A/L Johan', '000000-00-0000', 'johan@graduate.utm.my', '0123456789', 'Jalan Johan', 'Taman Johan', 'Johan', 20000, 1),
('johanna', '123456', 2, 'Ts. Dr. Johanna binti Ahmad', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('lam.yu', '$2y$10$Pcjyw28p1s3zb8skxdjJ2uDCnCWc7nC3c92X7O7pRqcjFqjUQw/2e', 1, 'Lam Yoke Yu', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('linzhiping', '$2y$10$Y88C4UpybXTXxpJja0AbMefhFNIIn9B0BuaY72N9Q4K/St3sWWjiW', 1, 'Lin Zhi Ping', '000000-00-0000', 'linzhiping@graduate.utm.my', '0123456789', 'Jalan Selamat', 'Taman Selamat', 'Selamat', 23678, 12),
('mawarabdul', '$2y$10$0Jo5/GBqy392nm8Rq1c6senw.uaxYHaLLC8TRfa4Hq.LRnk1/ya5.', 3, 'Mawar binti Abdul', '000000-00-0000', 'mawarabdul@utm.my', '0123456789', 'Jalan Mawar', 'Taman Mawar', 'Mawar', 45678, 4),
('miqbaltariq', '$2y$10$XP50STD8HA5vH6MWwjyWUOHvy5Y16TzHMfyZlfy5v13NriVHueoOS', 2, 'Dr. Muhammad Iqbal Tariq bin Idris', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('mrazak', '123456', 2, 'Dr. Mohd Razak bin Samingan', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('muhammadaliif', '123456', 2, 'Dr. Muhammad Aliif bin Ahmad', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('noorfa', '123456', 2, 'Dr. Noorfa Haszlinna binti Mustaffa', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('nureiliyah', '123456', 2, 'Dr. Nur Eiliyah @ Wong Yee Leng', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('radziahm', '123456', 2, 'Assoc. Prof. Dr. Radziah binti Mohamad', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('roslan', '$2y$10$TitB6c5pVzcGmOMM.YTvgOXJQXJ3/GkV9k1cCH.FYFY6xdtC01bpS', 1, 'Roslan bin Roslan', '000000-00-0000', 'roslan@utm.my', '0123456789', 'Jalan Mawar', 'Taman Mawar', 'Mawar', 20000, 1),
('rozilawati', '123456', 2, 'Rozilawati binti Dollah @ Md Zain', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('sharin', '123456', 2, 'Dr. Sharin Hazlin binti Huspi', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('siti', '$2y$10$he1gV7makSC14y0UzfLe1.7PlH7pID81Fr.XHjrXo36X3N8aqIpZ2', 3, 'Siti binti Siti', '000000-00-0000', 'siti@utm.my', '0123456789', 'Jalan Bunga', 'Taman Bunga', 'Bunga', 30000, 3),
('sp-rohani', '$2y$10$/XX4yvb5hB7kI.lWHpv08Or1hvrqKj3zBESJhMluPJf/.biZ3Nbom', 3, 'Rohani binti Mohd Zain', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('tanyiya', '$2y$10$kmPLoabynQGXt0jP4EhMAOvxHvAzD2cK5izsgFwbpvquxP9/4NC0K', 1, 'Tan Yi Ya', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('tehruqian', '123456', 1, 'Teh Ru Qian', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('xinroulim', '$2y$10$N3ZM197cc53a7mCiYet1nOR4aqMe8vrsjHVRQObt8Y102t5bfZlgm', 1, 'Lim Xin Rou', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8),
('zainal', '$2y$10$PLmhlvgIT5XOYz9hINMnqOlnw4W0MZrpp5vDCETur4TbAk9zLoPJS', 2, 'Zainal bin Zainal', '000000-00-0000', 'zai@utm.my', '0123456789', 'Jalan Zainal', 'Taman Zainal', 'Zainal', 50000, 3),
('zuriahati', '123456', 2, 'Dr. Zuriahati binti Mohd Yunosi', '000000-00-0000', 'lam.yu@graduate.utm.my', '0123456789', 'Jalan Rishah', 'Taman Rishah', 'Ipoh', 30100, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tb_utype`
--

CREATE TABLE `tb_utype` (
  `ut_id` int(11) NOT NULL,
  `ut_desc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_utype`
--

INSERT INTO `tb_utype` (`ut_id`, `ut_desc`) VALUES
(1, 'Student'),
(2, 'Lecturer'),
(3, 'Staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_course`
--
ALTER TABLE `tb_course`
  ADD PRIMARY KEY (`c_code`),
  ADD KEY `c_department` (`c_department`),
  ADD KEY `c_coordinator` (`c_coordinator`);

--
-- Indexes for table `tb_department`
--
ALTER TABLE `tb_department`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `d_faculty` (`d_faculty`),
  ADD KEY `d_director` (`d_director`);

--
-- Indexes for table `tb_faculty`
--
ALTER TABLE `tb_faculty`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `tb_lecturer`
--
ALTER TABLE `tb_lecturer`
  ADD PRIMARY KEY (`l_no`),
  ADD KEY `l_no` (`l_no`),
  ADD KEY `l_faculty` (`l_faculty`),
  ADD KEY `tb_lecturer_ibfk_1` (`l_id`);

--
-- Indexes for table `tb_prerequsite`
--
ALTER TABLE `tb_prerequsite`
  ADD PRIMARY KEY (`p_course`,`p_prerequisite`),
  ADD KEY `p_course` (`p_course`),
  ADD KEY `p_prerequisite` (`p_prerequisite`);

--
-- Indexes for table `tb_programme`
--
ALTER TABLE `tb_programme`
  ADD PRIMARY KEY (`p_code`);

--
-- Indexes for table `tb_registration`
--
ALTER TABLE `tb_registration`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `r_student` (`r_student`),
  ADD KEY `course_section` (`r_course`,`r_section`),
  ADD KEY `r_status` (`r_status`);

--
-- Indexes for table `tb_section`
--
ALTER TABLE `tb_section`
  ADD PRIMARY KEY (`s_course`,`s_no`,`s_semester`),
  ADD KEY `s_lecturer` (`s_lecturer`),
  ADD KEY `s_code` (`s_course`);

--
-- Indexes for table `tb_staff`
--
ALTER TABLE `tb_staff`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `tb_state`
--
ALTER TABLE `tb_state`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tb_student`
--
ALTER TABLE `tb_student`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `s_no` (`s_no`),
  ADD KEY `s_programme` (`s_programme`),
  ADD KEY `s_advisor` (`s_advisor`),
  ADD KEY `s_faculty` (`s_faculty`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `u_utype` (`u_type`),
  ADD KEY `u_state` (`u_state`);

--
-- Indexes for table `tb_utype`
--
ALTER TABLE `tb_utype`
  ADD PRIMARY KEY (`ut_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_department`
--
ALTER TABLE `tb_department`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_registration`
--
ALTER TABLE `tb_registration`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_course`
--
ALTER TABLE `tb_course`
  ADD CONSTRAINT `tb_course_ibfk_1` FOREIGN KEY (`c_coordinator`) REFERENCES `tb_lecturer` (`l_no`),
  ADD CONSTRAINT `tb_course_ibfk_2` FOREIGN KEY (`c_department`) REFERENCES `tb_department` (`d_id`);

--
-- Constraints for table `tb_department`
--
ALTER TABLE `tb_department`
  ADD CONSTRAINT `tb_department_ibfk_1` FOREIGN KEY (`d_faculty`) REFERENCES `tb_faculty` (`f_id`),
  ADD CONSTRAINT `tb_department_ibfk_2` FOREIGN KEY (`d_director`) REFERENCES `tb_lecturer` (`l_no`);

--
-- Constraints for table `tb_lecturer`
--
ALTER TABLE `tb_lecturer`
  ADD CONSTRAINT `tb_lecturer_ibfk_1` FOREIGN KEY (`l_id`) REFERENCES `tb_user` (`u_id`),
  ADD CONSTRAINT `tb_lecturer_ibfk_2` FOREIGN KEY (`l_faculty`) REFERENCES `tb_faculty` (`f_id`);

--
-- Constraints for table `tb_prerequsite`
--
ALTER TABLE `tb_prerequsite`
  ADD CONSTRAINT `tb_prerequsite_ibfk_1` FOREIGN KEY (`p_course`) REFERENCES `tb_course` (`c_code`),
  ADD CONSTRAINT `tb_prerequsite_ibfk_2` FOREIGN KEY (`p_prerequisite`) REFERENCES `tb_course` (`c_code`);

--
-- Constraints for table `tb_registration`
--
ALTER TABLE `tb_registration`
  ADD CONSTRAINT `tb_registration_ibfk_1` FOREIGN KEY (`r_course`) REFERENCES `tb_section` (`s_course`),
  ADD CONSTRAINT `tb_registration_ibfk_2` FOREIGN KEY (`r_student`) REFERENCES `tb_student` (`s_no`),
  ADD CONSTRAINT `tb_registration_ibfk_3` FOREIGN KEY (`r_status`) REFERENCES `tb_status` (`s_id`);

--
-- Constraints for table `tb_section`
--
ALTER TABLE `tb_section`
  ADD CONSTRAINT `tb_section_ibfk_1` FOREIGN KEY (`s_course`) REFERENCES `tb_course` (`c_code`),
  ADD CONSTRAINT `tb_section_ibfk_2` FOREIGN KEY (`s_lecturer`) REFERENCES `tb_lecturer` (`l_no`);

--
-- Constraints for table `tb_staff`
--
ALTER TABLE `tb_staff`
  ADD CONSTRAINT `tb_staff_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `tb_user` (`u_id`);

--
-- Constraints for table `tb_student`
--
ALTER TABLE `tb_student`
  ADD CONSTRAINT `tb_student_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `tb_user` (`u_id`),
  ADD CONSTRAINT `tb_student_ibfk_2` FOREIGN KEY (`s_programme`) REFERENCES `tb_programme` (`p_code`),
  ADD CONSTRAINT `tb_student_ibfk_3` FOREIGN KEY (`s_advisor`) REFERENCES `tb_lecturer` (`l_no`),
  ADD CONSTRAINT `tb_student_ibfk_4` FOREIGN KEY (`s_faculty`) REFERENCES `tb_faculty` (`f_id`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`u_state`) REFERENCES `tb_state` (`s_id`),
  ADD CONSTRAINT `tb_user_ibfk_2` FOREIGN KEY (`u_type`) REFERENCES `tb_utype` (`ut_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
