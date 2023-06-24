-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2023 at 08:40 AM
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
(1, 'Try', 'TCA', '~$Y2027 Group Project Brief Body and Appendix 1 (2022-23) - Final.doc', NULL, '2023-05-07', 100, NULL, 1, NULL, 0),
(2, 'NEW', 'TCA', 'CSY2027 Group Project Brief Body and Appendix 1 (2022-23) - Final.doc', NULL, '2023-04-28', 100, NULL, 1, NULL, 0),
(3, 'Newer', 'TCA', '??ࡱ\Z?\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0>\0\0??	\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0?\0\0\0\0\0\0\0\0\0\0?\0\0\0\0\0\0????\0\0\0\0?\0\0\0?\0\0\0?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????', NULL, '2023-04-27', 100, NULL, 3, NULL, 0),
(4, 'question', 'assignment', 'PK\0\0\0\0\0???U\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0web2assignment1/.git/PK\0\0\0\0\0???U?qpG\0\0\0\0\0\0#\0\0\0web2assignment1/.git/COMMIT_EDITMSGibuy completion\nPK\0\0\0\0\r??U?6?<?\0\0\04\0\0\0\0\0web2assignment1/.git/configM?Kn?0D??)/S j???]P6-	?D??R??e??r0o>?B?n`?I??7?\nzC?Lm???n?r', NULL, '2023-05-03', 1, NULL, 1, NULL, 1),
(5, 'j', 'TCA', 'uploads/csy2061-phurbuDhundupTamang-report.docx', NULL, '2023-04-27', 100, NULL, 3, NULL, 1),
(6, 'k', 'TCA', 'uploads/web2assignment2.zip', NULL, '2023-04-04', 100, NULL, 1, NULL, 1),
(7, 'Introduction', 'TCA', 'uploads/Introduction.docx', NULL, '2023-04-21', 100, NULL, 3, NULL, 1),
(8, 'csy2061-phurbuDhundupTamang-report', 'TCA', 'uploads/csy2061-phurbuDhundupTamang-report.docx', NULL, '2023-04-27', 67, NULL, 1, NULL, 1),
(9, 'try', 'TCA', 'uploads/csy2061-phurbuDhundupTamang-report.docx', NULL, '2023-04-26', 100, NULL, 1, NULL, 1),
(10, 'TCA 1', 'TCA', 'uploads/compiled.docx', NULL, '2023-04-27', 100, NULL, 1, NULL, 1);

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
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `courseCredits`, `startDate`, `endDate`, `status`) VALUES
(1, 'BSc (Hons) Computing', '3', '2023-04-08', '2025-12-19', 1),
(3, 'BSc(Hons) Software Engineering', '3', '2023-04-08', '2025-10-21', 1),
(4, 'BSc (Hons) Environmental Science', '4', '2023-04-08', '2025-11-08', 1),
(5, 'MSc Computing', '3', '2023-04-11', '2025-11-11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diary`
--

CREATE TABLE `diary` (
  `diary_id` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(5) DEFAULT NULL,
  `title` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diary`
--

INSERT INTO `diary` (`diary_id`, `student_id`, `date`, `description`, `title`) VALUES
(1, '2023NPS6823', '2023-04-10', 'modul', 'old assignment '),
(2, '2023NPS6823', '2023-04-10', 'modul', 'new assignment ');

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
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `moduleCredits`, `LearningYear`, `course_id`, `staff_id`, `personal_tutor_id`, `status`) VALUES
(1, 'Computer Communications', '30', '3', 1, 1, 1, 1),
(2, 'Computer Systems', '20', '1', 1, 1, 1, 1),
(3, 'Operating System', '30', '2', 1, 1, 1, 1),
(7, 'Computer Communications', '20', '2', 1, 1, 1, NULL);

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
(0, 'phurbu lama', 3, '2023YPR224'),
(1, 'Nischal Khadka', 1, '2023NPS6823');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staffName` varchar(50) DEFAULT NULL,
  `StaffEmail` varchar(100) DEFAULT NULL,
  `staffContact` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staffName`, `StaffEmail`, `staffContact`, `status`) VALUES
(1, 'Nischal Khadka ', 'phurbu.2022126@nami.edu.np', '9742466845', 1),
(2, 'phurbu lama', 'phurbu.2022126@nami.edu.np', '9742466845', 0),
(3, 'phurbu lama', 'phurbu.2022126@nami.edu.np', '9742466845', 1);

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
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `studentName`, `email`, `studentContact`, `status`, `course_id`) VALUES
('2023NPS6823', 'Samden Tshering Sherp', 'phurbu.2022126@nami.edu.np', '974246684', 0, 1),
('2023WPR5448', 'phurbu lama', 'phurbu.2022126@nami.edu.np', '9742466845', 1, NULL),
('2023WXP5646', 'phurbu lama', 'phurbu.2022126@nami.edu.np', '9742466845', 1, 1),
('2023YPR224', 'Bipin Neupane', 'bipin12@gmail.com', '9742466845', 0, NULL);

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
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`timetable_id`, `staff_id`, `module_id`, `course_id`, `room`, `startDateTime`, `endDateTime`, `status`) VALUES
(6, 1, 1, 1, '304', '2023-04-12 07:32:00', '2023-04-11 08:32:00', 1);

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
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `diary`
--
ALTER TABLE `diary`
  ADD PRIMARY KEY (`diary_id`),
  ADD KEY `student_id` (`student_id`);

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
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `diary`
--
ALTER TABLE `diary`
  MODIFY `diary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Constraints for table `diary`
--
ALTER TABLE `diary`
  ADD CONSTRAINT `diary_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

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
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

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
