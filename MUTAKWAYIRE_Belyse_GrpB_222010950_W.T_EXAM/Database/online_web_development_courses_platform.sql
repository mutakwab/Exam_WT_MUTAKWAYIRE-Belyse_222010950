-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 03:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_web_development_courses_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Description` varchar(455) DEFAULT NULL,
  `InstructorID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `Title`, `Description`, `InstructorID`) VALUES
(1, 'Web Development Basics', 'Learn the fundamentals of web development.', 3),
(2, 'JavaScript Programming', 'Master JavaScript programming concepts.', 1),
(3, 'Node.js and Express', 'Explore server-side development with Node.js and Express.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `course_feedback`
--

CREATE TABLE `course_feedback` (
  `FeedbackID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Feedback` varchar(500) DEFAULT NULL,
  `FeedbackDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_feedback`
--

INSERT INTO `course_feedback` (`FeedbackID`, `CourseID`, `UserID`, `Feedback`, `FeedbackDate`) VALUES
(6, 1, 2, 'Great course! Really enjoyed it.', '2024-05-10'),
(7, 1, 1, 'Excellent content, very informative.', '2024-05-11'),
(8, 2, 4, 'Could use more practical exercises.', '2024-05-12'),
(9, 2, 3, 'Informative but could be more engaging.', '2024-05-13'),
(10, 3, 1, 'Amazing course, learned a lot!', '2024-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `course_materials`
--

CREATE TABLE `course_materials` (
  `MaterialID` int(11) NOT NULL,
  `SectionID` int(11) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_materials`
--

INSERT INTO `course_materials` (`MaterialID`, `SectionID`, `Type`, `Link`) VALUES
(6, 1, 'Video', 'https://example.com/video1'),
(7, 2, 'Text', 'https://example.com/text1'),
(8, 3, 'PDF', 'https://example.com/pdf1'),
(9, 4, 'Video', 'https://example.com/video2'),
(10, 5, 'Text', 'https://example.com/text2');

-- --------------------------------------------------------

--
-- Table structure for table `course_progress_tracking`
--

CREATE TABLE `course_progress_tracking` (
  `ProgressID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `SectionID` int(11) DEFAULT NULL,
  `Progress` float DEFAULT NULL,
  `LastAccessed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_progress_tracking`
--

INSERT INTO `course_progress_tracking` (`ProgressID`, `CourseID`, `SectionID`, `Progress`, `LastAccessed`) VALUES
(1, 1, 1, 0.5, '2024-05-10'),
(2, 1, 2, 0.3, '2024-05-11'),
(3, 2, 1, 0.7, '2024-05-12'),
(4, 2, 2, 0.4, '2024-05-13'),
(5, 3, 1, 0.6, '2024-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `course_ratings`
--

CREATE TABLE `course_ratings` (
  `RatingID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `RatingDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_ratings`
--

INSERT INTO `course_ratings` (`RatingID`, `CourseID`, `UserID`, `Rating`, `RatingDate`) VALUES
(1, 1, 4, 5, '2024-05-10'),
(2, 1, 3, 4, '2024-05-11'),
(3, 2, 2, 3, '2024-05-12'),
(4, 2, 4, 1, '2024-05-13'),
(5, 3, 2, 2, '2024-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `course_sections`
--

CREATE TABLE `course_sections` (
  `SectionID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Description` varchar(455) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_sections`
--

INSERT INTO `course_sections` (`SectionID`, `CourseID`, `Title`, `Description`) VALUES
(1, 2, 'Introduction to Web Development', 'Learn the basics of HTML, CSS, and JavaScript.'),
(2, 1, 'Responsive Web Design', 'Understand how to create websites that work on all devices.'),
(3, 2, 'JavaScript Fundamentals', 'Master the core concepts of JavaScript programming.'),
(4, 1, 'DOM Manipulation', 'Learn how to manipulate the Document Object Model.'),
(5, 3, 'Server-Side Development', 'Explore server-side programming with Node.js and Express.');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `EnrollmentID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `EnrollmentDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`EnrollmentID`, `UserID`, `CourseID`, `EnrollmentDate`) VALUES
(6, 101, 1, '2024-05-10'),
(7, 102, 1, '2024-05-11'),
(8, 103, 2, '2024-05-12'),
(9, 104, 2, '2024-05-13'),
(10, 105, 3, '2024-05-14'),
(11, 2, 1, '2024-05-10'),
(12, 1, 1, '2024-05-11'),
(13, 4, 2, '2024-05-12'),
(14, 3, 2, '2024-05-13'),
(15, 1, 3, '2024-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `InstructorID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Bio` varchar(455) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`InstructorID`, `Name`, `Email`, `Bio`) VALUES
(1, 'John Smith', 'john@example.com', 'Experienced web developer with a passion for teaching.'),
(2, 'Emily Johnson', 'emily@example.com', 'JavaScript expert with a knack for explaining complex concepts.'),
(3, 'Michael Davis', 'michael@example.com', 'Node.js enthusiast and advocate for server-side JavaScript.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'mutakwayire', 'belysee', 'belyse5', 'belysemutakway@gmail.com', '0784533222', '$2y$10$ieBm4CD4n7ZidTg75l2lNuI4fx/Zma6N1ebR9owYrhqHFTzplwxhW', '2024-05-15 13:59:59', '888999', 0),
(2, 'domina', 'Ntakirutimana', 'domina', 'dominantakirut@gmail.com', '0788888888', '$2y$10$xACrxgKnBHgFeLmyCOgLvOkyW8WNVOxz9OmRFVa.Rf4l5FSipKEvy', '2024-05-15 14:00:34', '3443', 0),
(3, 'timote', 'rukundo', 'rukunderictiomo', 'rukundotimote33@gmail.com', '0783222111', '$2y$10$gKqDAiD9mB0Qt8yFSiY3YutRtdYVQau2kvIzeOwBl8wQ7xPDWI18S', '2024-05-15 14:01:35', '4556', 0),
(4, 'gad', 'bihibindi', 'gad55', 'bihibindgad@gmail.com', '0784533222', '$2y$10$ZHT.whfoqioFqrPKb8H7f.tvhh/0zFEp60vR/JMigb1JRXNmA5T12', '2024-05-15 14:02:21', '987676', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_certificates`
--

CREATE TABLE `user_certificates` (
  `CertificateID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `IssueDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_certificates`
--

INSERT INTO `user_certificates` (`CertificateID`, `UserID`, `CourseID`, `IssueDate`) VALUES
(1, 2, 1, '2024-05-12'),
(2, 1, 1, '0000-00-00'),
(3, 3, 2, '2024-05-14'),
(4, 4, 2, '2024-05-15'),
(5, 1, 3, '2024-05-16'),
(6, 4, 2, '2024-05-12'),
(7, 3, 1, '2024-05-13'),
(8, 1, 2, '2024-05-14'),
(9, 3, 2, '2024-05-15'),
(10, 2, 3, '2024-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `web_development_resources`
--

CREATE TABLE `web_development_resources` (
  `ResourceID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `web_development_resources`
--

INSERT INTO `web_development_resources` (`ResourceID`, `Title`, `Description`, `Link`) VALUES
(1, 'HTML Crash Course', 'A quick introduction to HTML basics.', 'https://example.com/html_course'),
(2, 'CSS Tutorial', 'Learn CSS from scratch with this comprehensive tutorial.', 'https://example.com/css_tutorial'),
(3, 'JavaScript Reference Guide', 'A handy reference guide for JavaScript syntax and concepts.', 'https://example.com/js_reference'),
(4, 'Node.js Documentation', 'Official documentation for Node.js and its various modules.', 'https://example.com/nodejs_docs'),
(5, 'Express.js Guide', 'A guide to building web applications with Express.js framework.', 'https://example.com/express_guide');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`),
  ADD KEY `InstructorID` (`InstructorID`);

--
-- Indexes for table `course_feedback`
--
ALTER TABLE `course_feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `course_materials`
--
ALTER TABLE `course_materials`
  ADD PRIMARY KEY (`MaterialID`),
  ADD KEY `SectionID` (`SectionID`);

--
-- Indexes for table `course_progress_tracking`
--
ALTER TABLE `course_progress_tracking`
  ADD PRIMARY KEY (`ProgressID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `SectionID` (`SectionID`);

--
-- Indexes for table `course_ratings`
--
ALTER TABLE `course_ratings`
  ADD PRIMARY KEY (`RatingID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `course_sections`
--
ALTER TABLE `course_sections`
  ADD PRIMARY KEY (`SectionID`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`EnrollmentID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`InstructorID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_certificates`
--
ALTER TABLE `user_certificates`
  ADD PRIMARY KEY (`CertificateID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `web_development_resources`
--
ALTER TABLE `web_development_resources`
  ADD PRIMARY KEY (`ResourceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_feedback`
--
ALTER TABLE `course_feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course_materials`
--
ALTER TABLE `course_materials`
  MODIFY `MaterialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course_progress_tracking`
--
ALTER TABLE `course_progress_tracking`
  MODIFY `ProgressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_ratings`
--
ALTER TABLE `course_ratings`
  MODIFY `RatingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_sections`
--
ALTER TABLE `course_sections`
  MODIFY `SectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `EnrollmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `InstructorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_certificates`
--
ALTER TABLE `user_certificates`
  MODIFY `CertificateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `web_development_resources`
--
ALTER TABLE `web_development_resources`
  MODIFY `ResourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`InstructorID`) REFERENCES `instructors` (`InstructorID`);

--
-- Constraints for table `course_feedback`
--
ALTER TABLE `course_feedback`
  ADD CONSTRAINT `course_feedback_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `course_feedback_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`);

--
-- Constraints for table `course_materials`
--
ALTER TABLE `course_materials`
  ADD CONSTRAINT `course_materials_ibfk_1` FOREIGN KEY (`SectionID`) REFERENCES `course_sections` (`SectionID`);

--
-- Constraints for table `course_progress_tracking`
--
ALTER TABLE `course_progress_tracking`
  ADD CONSTRAINT `course_progress_tracking_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `course_progress_tracking_ibfk_2` FOREIGN KEY (`SectionID`) REFERENCES `course_sections` (`SectionID`);

--
-- Constraints for table `course_ratings`
--
ALTER TABLE `course_ratings`
  ADD CONSTRAINT `course_ratings_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `course_ratings_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`);

--
-- Constraints for table `user_certificates`
--
ALTER TABLE `user_certificates`
  ADD CONSTRAINT `user_certificates_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `user_certificates_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
