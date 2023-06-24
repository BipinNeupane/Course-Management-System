-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 12:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courses`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assignment_id` int(11) NOT NULL,
  `assignment_name` varchar(100) DEFAULT NULL,
  `assignmentType` varchar(50) DEFAULT NULL,
  `assignmentToDo` varchar(255) DEFAULT NULL,
  `assignmentSubmitted` blob DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `totalMarks` int(11) DEFAULT NULL,
  `gottenMarks` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assignment_id`, `assignment_name`, `assignmentType`, `assignmentToDo`, `assignmentSubmitted`, `dueDate`, `totalMarks`, `gottenMarks`, `module_id`, `student_id`, `status`) VALUES
(12, 'ASSIGNMENT 1', 'ASSIGNMENT', 'uploads/courses (5).sql', NULL, '2023-04-30', 100, NULL, 11, NULL, 1),
(14, 'Assignment 2', 'Assignment', 'uploads/completionCheck.doc', NULL, '2023-05-04', 100, NULL, 11, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `Present` tinyint(1) DEFAULT NULL,
  `joinedTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `class_id`, `date`, `Present`, `joinedTime`) VALUES
(10, '2023NPS6823', 3, '2023-04-18', 1, NULL),
(11, '2023NPS6823', 4, '2023-04-18', 1, NULL),
(12, '2023NPS6823', 10, '2023-04-23', 1, NULL),
(13, '2023NPS6823', 10, '2023-04-23', 1, '0000-00-00 00:00:00'),
(14, '2023NPS6823', 10, '2023-04-23', 1, '0000-00-00 00:00:00'),
(15, '2023NPS6823', 10, '2023-04-23', 1, '0000-00-00 00:00:00'),
(16, '2023NPS6823', 11, '2023-04-23', 1, '2023-04-23 14:56:45'),
(17, '2023NPS6823', 10, '2023-04-23', 1, '2023-04-23 14:56:58'),
(18, '2023NLJ2404', 13, '2023-04-23', 1, '2023-04-23 15:29:27'),
(19, '2023NPS6823', 10, '2023-05-06', 1, '2023-05-06 16:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `classLink` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `classLink`, `status`, `module_id`) VALUES
(3, 'http://localhost/gpsidebar/staffs/class.php', 1, NULL),
(4, 'https://www.google.com/search?q=what+is+fa+fa+icon', 0, NULL),
(9, 'https://mail.google.com/mail/u/1/#inbox', 1, 11),
(10, 'https://mail.google.com/mail/u/1/#inbox', 0, 11),
(11, 'https://www.google.com/search?q=what+is+fa+fa+icon', 0, 11),
(12, 'https://mail.google.com/mail/u/1/#inbox', 1, 13),
(13, 'https://mail.google.com/mail/u/1/#inbox', 0, 13),
(14, 'https://mail.google.com/mail/u/1/#inbox', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `courseCredits` varchar(50) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `courseLeader` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `courseCredits`, `startDate`, `endDate`, `status`, `courseLeader`) VALUES
(1, 'BSc (Hons) Computing', '3', '2023-04-27', '2025-12-19', 1, 8),
(3, 'BSc(Hons) Software Engineering', '3', '2023-04-08', '2025-10-21', 1, NULL),
(4, 'BSc (Hons) Environmental Science', '4', '2023-04-08', '2025-11-08', 1, NULL),
(5, 'MSc Computing', '3', '2023-04-11', '2025-11-11', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diary`
--

CREATE TABLE `diary` (
  `diary_id` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `title` varchar(25) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diary`
--

INSERT INTO `diary` (`diary_id`, `student_id`, `date`, `description`, `title`, `staff_id`, `status`) VALUES
(1, '2023NPS6823', '2023-04-10', 'modul', 'old assignment ', NULL, 0),
(2, '2023NPS6823', '2023-04-10', 'modul', 'new assignment ', NULL, 0),
(5, '2023NLJ2404', '2023-05-20', 'new', 'New assignment', NULL, 0),
(6, '2023NPS6823', '2024-01-20', 'Same', 'Same', NULL, 0),
(7, '2023NPS6823', '2024-01-31', 'dont', 'Dont', NULL, 0),
(9, '2023NLJ2404', '2023-04-22', 'new d', 'DEADLINE', NULL, 0),
(11, NULL, '2024-02-22', 'new', 'submission', 1, 0),
(12, NULL, '2023-04-22', 'new', 'NEW', 1, 0),
(13, NULL, '2023-04-22', 'same', 'Same', 7, 0),
(14, NULL, '2023-04-30', 'few', 'few', 7, 0),
(15, NULL, '2023-04-27', 'Today', 'Test', 7, 1),
(16, NULL, '2023-04-28', 'there', 'Tommorrow', 7, 0),
(17, NULL, '2023-04-28', 'there', 'Tommorrow', 7, 1),
(18, '2023NPS6823', '2023-04-27', 'There', 'Presentation', NULL, 1),
(19, '2023NPS6823', '2023-04-27', 'today', 'Revision', NULL, 1),
(20, '2023NPS6823', '2023-04-28', 'tomor', 'Tommorrow', NULL, 1),
(21, NULL, '2023-04-27', 'assig', 'Assignment', 1, NULL),
(22, NULL, '2023-04-27', 'Assig', 'Assign', 1, 1),
(23, NULL, '2023-05-03', 'I hav', 'Phurbu', 1, 1),
(24, NULL, '0000-00-00', 'I hav', 'Today', 7, 0),
(25, NULL, '2023-05-03', 'i have meeting', 'Phurbu', 7, 1),
(26, '2023NPS6823', '2023-05-06', 'content', 'New', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(100) DEFAULT NULL,
  `moduleCredits` varchar(50) DEFAULT NULL,
  `LearningYear` varchar(25) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `personal_tutor_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `module_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `moduleCredits`, `LearningYear`, `course_id`, `staff_id`, `personal_tutor_id`, `status`, `module_code`) VALUES
(11, 'Computer Communications', '10', '1', 1, 1, 2, 1, 'CSY101'),
(12, 'Group Project', '30', '2', 1, 1, 3, 1, 'csy1010'),
(13, 'Computer Systems', '30', '2', 3, 1, 3, 1, 'csy202');

-- --------------------------------------------------------

--
-- Table structure for table `personaltutor`
--

CREATE TABLE `personaltutor` (
  `personal_tutor_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `staff_id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personaltutor`
--

INSERT INTO `personaltutor` (`personal_tutor_id`, `name`, `staff_id`, `student_id`) VALUES
(1, 'cobra', 3, '2023NLJ2404'),
(2, 'ZEBRA', 3, '2023NLJ2404'),
(3, 'Nischal Khadka ', 1, '2023NPS6823'),
(6, 'Tutor', 1, '2023NRB1186'),
(7, 'Tuto', 5, '2023NRB1186');

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `resource_id` int(11) NOT NULL,
  `resource` varchar(50) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `resourceName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`resource_id`, `resource`, `module_id`, `resourceName`) VALUES
(20, 'resource/courses (6).sql', 11, 'week 1 Practice'),
(25, 'resource/completionCheck.doc', 11, 'Week 2 tutorial'),
(28, 'resource/completionCheck.doc', 11, 'week 3 tutorial'),
(30, 'resource/completionCheck.doc', 11, 'Week 4 Tutorial'),
(36, 'resource/completionCheck.doc', 11, 'Week 5 tutorial'),
(45, 'resource/completionCheck.doc', 11, 'Week 6 Tutorial');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staffName` varchar(50) DEFAULT NULL,
  `StaffEmail` varchar(100) DEFAULT NULL,
  `staffContact` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staffName`, `StaffEmail`, `staffContact`, `status`, `password`, `type`) VALUES
(1, 'Nischal Khadka ', 'phurbu.2022126@nami.edu.np', '9742466846', 1, 'abcde123', 'Staff'),
(3, 'Phurbu lama', 'phurbu.2022126@nami.edu.np', '9742466845', 0, 'abcde123', 'Staff'),
(5, 'Chirag Thapa', 'chirag123@gmail.com', '9742466847', 1, 'abcde123', 'Staff'),
(7, 'Suresh Gautam', 'suresh1232@gmail.com', '9742466809', 1, 'abcde123', 'admin'),
(8, 'Chandan Kumar', 'chandan67@gmail.com', '9742466845', 1, 'abcde123', 'Course Leader'),
(9, 'Ramesh Yadav', 'ram123@gmail.com', '9742466845', 1, 'abcde123', 'Course Leader');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` varchar(20) NOT NULL,
  `studentName` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `studentContact` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `studentName`, `email`, `studentContact`, `status`, `course_id`, `password`) VALUES
('2023AMN2475', 'Phurbu lama', 'phurbu.2022126@nami.edu.np', '9742466845', 1, 3, 'abcde123'),
('2023NLJ2404', 'Alisha Singh', 'alisha12@gmail.com', '9742466845', 1, 3, 'abcde123'),
('2023NPS6823', 'Samden Tshering Sherp', 'phurbu.2022126@nami.edu.np', '974246684', 1, 1, 'abcde123'),
('2023NRB1186', 'Sandesh Ghimire', 'sandesh12@gmail.com', '986745342', 1, 1, 'abcde123'),
('2023UXQ1031', 'Shrekshya Lama', 'shrekshya12@gmail.com', '9742466847', 0, 5, 'abcde123'),
('2023YPR224', 'Bipin Neupane', 'bipin12@gmail.com', '9742466845', 0, NULL, 'abcde123');

-- --------------------------------------------------------

--
-- Table structure for table `student_assignment`
--

CREATE TABLE `student_assignment` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `assignment_id` int(11) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `assignment_submitted` varchar(50) DEFAULT NULL,
  `isGraded` tinyint(1) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_assignment`
--

INSERT INTO `student_assignment` (`id`, `student_id`, `assignment_id`, `grade`, `assignment_submitted`, `isGraded`, `feedback`) VALUES
(7, '2023NPS6823', 12, 70, 'submission/courses (6).sql', 0, NULL),
(11, '2023NPS6823', 12, 100, 'submission/completionCheck.doc', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `timetable_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `room` varchar(25) DEFAULT NULL,
  `startDateTime` datetime DEFAULT NULL,
  `endDateTime` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `courseLeader` (`courseLeader`);

--
-- Indexes for table `diary`
--
ALTER TABLE `diary`
  ADD PRIMARY KEY (`diary_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `personal_tutor_id` (`personal_tutor_id`);

--
-- Indexes for table `personaltutor`
--
ALTER TABLE `personaltutor`
  ADD PRIMARY KEY (`personal_tutor_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`resource_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `fk_course_id` (`course_id`);

--
-- Indexes for table `student_assignment`
--
ALTER TABLE `student_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `assignment_id` (`assignment_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`timetable_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `diary`
--
ALTER TABLE `diary`
  MODIFY `diary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personaltutor`
--
ALTER TABLE `personaltutor`
  MODIFY `personal_tutor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student_assignment`
--
ALTER TABLE `student_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`),
  ADD CONSTRAINT `assignment_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`courseLeader`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `diary`
--
ALTER TABLE `diary`
  ADD CONSTRAINT `diary_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `diary_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `module_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `module_ibfk_3` FOREIGN KEY (`personal_tutor_id`) REFERENCES `personaltutor` (`personal_tutor_id`);

--
-- Constraints for table `personaltutor`
--
ALTER TABLE `personaltutor`
  ADD CONSTRAINT `personaltutor_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `personaltutor_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `resource`
--
ALTER TABLE `resource`
  ADD CONSTRAINT `resource_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `student_assignment`
--
ALTER TABLE `student_assignment`
  ADD CONSTRAINT `student_assignment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `student_assignment_ibfk_2` FOREIGN KEY (`assignment_id`) REFERENCES `assignment` (`assignment_id`);

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`),
  ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
