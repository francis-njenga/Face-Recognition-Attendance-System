-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 11:45 AM
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
-- Database: `attendancemsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `Id` int(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`Id`, `firstName`, `lastName`, `emailAddress`, `password`) VALUES
(1, 'Admin', '', 'admin@gmail.com', 'c670ddc55c979ea11545f3d52d1b9f5f');

-- --------------------------------------------------------

--
-- Table structure for table `tblattendance`
--

CREATE TABLE `tblattendance` (
  `attendanceID` int(50) NOT NULL,
  `studentRegistrationNumber` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `attendanceStatus` varchar(100) NOT NULL,
  `dateMarked` date NOT NULL,
  `unit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblattendance`
--

INSERT INTO `tblattendance` (`attendanceID`, `studentRegistrationNumber`, `course`, `attendanceStatus`, `dateMarked`, `unit`) VALUES
(478, 'CIT-222-003-2020', 'BCT', 'Absent', '2024-05-02', 'BCT 2411'),
(479, 'CIT-222-002-2020', 'BCT', 'Absent', '2024-05-02', 'BCT 2411'),
(480, 'CIT-222-001-2020', 'BCT', 'Absent', '2024-05-02', 'BCT 2411'),
(481, 'CIT-222-005-2020', 'BCT', 'present', '2024-05-02', 'BCT 2411'),
(482, 'CIT-222-004-2020', 'BCT', 'Absent', '2024-05-02', 'BCT 2411');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `ID` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `facultyID` int(50) NOT NULL,
  `dateCreated` date NOT NULL,
  `courseCode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`ID`, `name`, `facultyID`, `dateCreated`, `courseCode`) VALUES
(10, 'Computer Technology', 8, '2024-04-07', 'BCT'),
(11, 'Software Engineering', 8, '2024-04-07', 'BSE'),
(12, 'Computer Science', 8, '2024-04-07', 'BCS'),
(13, 'Information Technology', 8, '2024-04-07', 'BIT'),
(14, 'Mass Communication', 11, '2024-04-07', 'BMC'),
(15, 'Political Science', 9, '2024-04-07', 'BPS'),
(16, 'Analytical chemistry', 9, '2024-04-09', 'APA'),
(17, 'BCOM', 13, '2024-04-26', 'BCOM'),
(18, 'Mathematic for Science', 14, '2024-05-02', 'SMA 2103');

-- --------------------------------------------------------

--
-- Table structure for table `tblfaculty`
--

CREATE TABLE `tblfaculty` (
  `Id` int(10) NOT NULL,
  `facultyName` varchar(255) NOT NULL,
  `facultyCode` varchar(50) NOT NULL,
  `dateRegistered` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblfaculty`
--

INSERT INTO `tblfaculty` (`Id`, `facultyName`, `facultyCode`, `dateRegistered`) VALUES
(8, 'Computing and Information Technology', 'CIT', '2024-04-07'),
(9, ' Faculty of Social Sciences and Technology', 'FoSST', '2024-04-07'),
(10, 'Faculty of Science and Technology', 'FoST', '2024-04-07'),
(11, 'Faculty of Media and Communication', 'FAMECO', '2024-04-07'),
(12, 'Faculty of Engineering & Technology', 'FoENG', '2024-04-07'),
(13, 'MASS COM', 'MSC', '2024-04-09'),
(14, 'ENGINEERING', 'FENG', '2024-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `tbllecture`
--

CREATE TABLE `tbllecture` (
  `Id` int(10) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNo` varchar(50) NOT NULL,
  `facultyCode` varchar(50) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbllecture`
--

INSERT INTO `tbllecture` (`Id`, `firstName`, `lastName`, `emailAddress`, `password`, `phoneNo`, `facultyCode`, `dateCreated`) VALUES
(22, 'frank', 'Tech', 'tech@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '07123456789', 'CIT', '2024-05-02'),
(16, 'John', 'Mark', 'john@gmail.com', '1f431fac09e825fc2e5d03fa5ed0b42d', '07123456789', 'FoSST', '2024-04-07'),
(15, 'mark', 'lila', 'mark@gmail.com', '15c1469d0495004588968a3bde955397', '07123456789', 'CIT', '2024-04-07'),
(14, 'Francis', 'Njenga', 'francis@gmail.com', '72fff2824f94462c2eaaa739b6e7d496', '07123456789', 'CIT', '2024-04-07');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `Id` int(10) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `registrationNumber` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `faculty` varchar(10) NOT NULL,
  `courseCode` varchar(20) NOT NULL,
  `studentImage1` varchar(300) NOT NULL,
  `studentImage2` varchar(300) NOT NULL,
  `dateRegistered` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`Id`, `firstName`, `lastName`, `registrationNumber`, `email`, `faculty`, `courseCode`, `studentImage1`, `studentImage2`, `dateRegistered`) VALUES
(3, 'John', 'Macharia', 'CIT-222-003-2020', 'john@gmail.com', 'CIT', 'BCT', 'CIT-222-003-2020_image1.png', 'CIT-222-003-2020_image2.png', '2024-04-09'),
(2, 'Mercy', 'Wambui', 'CIT-222-002-2020', 'mercy@gmail.com', 'CIT', 'BCT', 'CIT-222-002-2020_image1.png', 'CIT-222-002-2020_image2.png', '2024-04-09'),
(1, 'Kevin', 'Ochieng', 'CIT-222-001-2020', 'kevin@gmail.com', 'CIT', 'BCT', 'CIT-222-001-2020_image1.png', 'CIT-222-001-2020_image2.png', '2024-04-09'),
(123, 'student1', 'testing', 'CIT-222-005-2020', 'student1@gmail.com', 'CIT', 'BCT', 'CIT-222-005-2020_image1.png', 'CIT-222-005-2020_image2.png', '2024-05-02'),
(4, 'frank', 'Tech', 'CIT-222-004-2020', 'tech@gmail.com', 'CIT', 'BCT', 'CIT-222-004-2020_image1.png', 'CIT-222-004-2020_image2.png', '2024-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `tblunit`
--

CREATE TABLE `tblunit` (
  `ID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `unitCode` varchar(50) NOT NULL,
  `courseID` varchar(50) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblunit`
--

INSERT INTO `tblunit` (`ID`, `name`, `unitCode`, `courseID`, `dateCreated`) VALUES
(3, 'Project Implementation', 'BCT 2411', '10', '2024-04-07'),
(4, 'Project Management', 'BCT 2409', '10', '2024-04-07'),
(5, 'E-Commerce', 'BIT 2315', '10', '2024-04-07'),
(6, 'Calculus 1', 'SMA 2102', '13', '2024-04-09'),
(7, 'Computer Architecture', 'BCT 2401', '10', '2024-04-26'),
(8, 'Computer Introduction', 'CIA 2103', '10', '2024-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `tblvenue`
--

CREATE TABLE `tblvenue` (
  `ID` int(10) NOT NULL,
  `className` varchar(50) NOT NULL,
  `facultyCode` varchar(50) NOT NULL,
  `currentStatus` varchar(50) NOT NULL,
  `capacity` int(10) NOT NULL,
  `classification` varchar(50) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblvenue`
--

INSERT INTO `tblvenue` (`ID`, `className`, `facultyCode`, `currentStatus`, `capacity`, `classification`, `dateCreated`) VALUES
(4, 'B 06', 'CIT', 'available', 100, 'class', '2024-04-07'),
(5, 'B 08', 'CIT', 'available', 80, 'class', '2024-04-07'),
(6, 'Korea 4', 'CIT', 'available', 80, 'laboratory', '2024-04-07'),
(7, 'Lecture Hall LH01', 'FAMECO', 'available', 200, 'lectureHall', '2024-04-07'),
(8, 'LH 4', 'MSC', 'available', 100, 'computerLab', '2024-04-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblattendance`
--
ALTER TABLE `tblattendance`
  ADD PRIMARY KEY (`attendanceID`);

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbllecture`
--
ALTER TABLE `tbllecture`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblunit`
--
ALTER TABLE `tblunit`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblvenue`
--
ALTER TABLE `tblvenue`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblattendance`
--
ALTER TABLE `tblattendance`
  MODIFY `attendanceID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=483;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbllecture`
--
ALTER TABLE `tbllecture`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `tblunit`
--
ALTER TABLE `tblunit`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblvenue`
--
ALTER TABLE `tblvenue`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

