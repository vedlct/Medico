-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2019 at 02:20 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medico`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentId` int(11) NOT NULL,
  `fkdoctorId` int(11) NOT NULL,
  `fkpatientId` int(11) NOT NULL,
  `services_servicesId` int(11) DEFAULT NULL,
  `serialnumber` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `reminder` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorId` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `degree` varchar(100) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL COMMENT '1=male,2=female',
  `phone` varchar(45) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `fkuserId` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0=Deleted ,1=Active,2=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorId`, `firstName`, `lastName`, `degree`, `email`, `gender`, `phone`, `image`, `address`, `fkuserId`, `status`) VALUES
(1, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '01680674598', '1Image.jpg', 'Shewrapara , Mirpur', 2, 1),
(2, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 3, 0),
(3, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 4, 0),
(4, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 5, 0),
(5, 'MD.Umar', 'Ekanto', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', '5Image.jpg', 'Shewrapara , Mirpur', 6, 1),
(6, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 7, 1),
(7, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 8, 1),
(8, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 9, 1),
(9, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 10, 1),
(10, 'Umar', 'Ekanto', 'MBBS', 'medico@test.com', 1, '01978278378', '10Image.png', 'jbdiqwjhbdioqwd', 11, 0),
(11, 'efef', '30', NULL, NULL, 1, '01942993375', NULL, 'wdwdwdw', 12, 0),
(12, 'cqawcq', '23', NULL, 'company@gmail.com', 1, '01942993375', NULL, 'wdwwdwdwdwdd', 13, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_service_relation`
--

CREATE TABLE `doctor_service_relation` (
  `doctor_service_relation` int(11) NOT NULL,
  `fkservicesId` int(11) NOT NULL,
  `fkdoctorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientId` int(11) NOT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `age` int(150) DEFAULT NULL,
  `gender` int(4) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientId`, `firstName`, `lastName`, `age`, `gender`, `address`, `phone`, `email`) VALUES
(1, 'iyiyui', '40', NULL, 1, '5fghfhfgh', '01942993375', 'sayed@gmail.com'),
(2, 'iyiyui', '40', NULL, 1, '5fghfhfgh', '01942993375', 'sayed@gmail.com'),
(3, 'asdf', 'asdf', NULL, 1, 'sdfafs', '324324324', 'sayed@gmail.com'),
(4, 'Umar', 'Ekanto', 20, 1, 'dqawdwqdqwd', '01942993375', 'user@test.com'),
(5, 'wgerwgr', 'ergerg', 20, 1, 'efwefwef', '01942993375', 'umarekanto@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `servicesId` int(11) NOT NULL,
  `servicesName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`servicesId`, `servicesName`) VALUES
(1, 'company update'),
(2, 'rifat');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `fkusertypeId` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0=Deleted ,1=Active,2=Inactive',
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `firstName`, `lastName`, `email`, `password`, `phone`, `fkusertypeId`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Farzad', 'Rahman', 'admin@gmail.com', '$2y$10$UCH8hBMvfPAfU237Dq4Tf.xKz5S/n8iH4Lf4q2bwo7ymIi6wXyime', '01731893442', 1, 1, 'bjJStbWkdgCYYygjejC1jFj4BUwx7oUBHYRiSwohPWZGlySeEVxYZdir4v16', '2019-05-22 08:35:59', NULL),
(2, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', NULL, '01680674598', 3, 1, NULL, '2019-05-23 02:33:26', '2019-08-23 00:32:58'),
(3, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '123456', '1680674598', 3, 0, NULL, '2019-05-23 03:12:33', '2019-08-22 03:12:23'),
(4, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '123456', '1680674598', 3, 0, NULL, '2019-05-23 03:12:45', '2019-08-22 03:12:34'),
(5, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '123456', '1680674598', 3, 0, NULL, '2019-05-23 03:12:56', '2019-08-22 03:12:40'),
(6, 'MD.Umar', 'Ekanto', 'mujtaba.rumi1@gmail.com', NULL, '1680674598', 3, 1, NULL, '2019-05-23 03:13:13', '2019-08-22 23:40:39'),
(7, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '789', '1680674598', 3, 1, NULL, '2019-05-23 03:14:31', '2019-05-23 03:14:31'),
(8, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '258', '1680674598', 3, 1, NULL, '2019-05-23 03:15:11', '2019-05-23 03:15:11'),
(9, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '159', '1680674598', 3, 1, NULL, '2019-05-23 03:15:59', '2019-05-23 03:15:59'),
(10, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '147', '1680674598', 3, 1, NULL, '2019-05-23 03:16:38', '2019-05-23 03:16:38'),
(11, 'Umar', 'Ekanto', 'medico@test.com', '12345678', '01978278378', 3, 0, NULL, '2019-08-21 23:49:07', '2019-08-22 03:12:57'),
(12, 'efef', '30', NULL, NULL, '01942993375', 3, 0, NULL, '2019-08-22 23:50:44', '2019-08-22 23:50:58'),
(13, 'cqawcq', '23', 'company@gmail.com', NULL, '01942993375', 3, NULL, NULL, '2019-08-23 04:03:44', '2019-08-23 04:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `usertypeId` int(11) NOT NULL,
  `usertypeName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`usertypeId`, `usertypeName`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'doctor');

-- --------------------------------------------------------

--
-- Table structure for table `working_hour`
--

CREATE TABLE `working_hour` (
  `working_hourId` int(11) NOT NULL,
  `fkdoctorId` int(11) NOT NULL,
  `day` varchar(45) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentId`),
  ADD UNIQUE KEY `serial_appimt` (`serialnumber`,`appointment_date`),
  ADD KEY `fk_appointment_doctor1_idx` (`fkdoctorId`),
  ADD KEY `fk_appointment_patient1_idx` (`fkpatientId`),
  ADD KEY `fk_appointment_services1_idx` (`services_servicesId`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorId`),
  ADD KEY `fk_doctor_user_idx` (`fkuserId`);

--
-- Indexes for table `doctor_service_relation`
--
ALTER TABLE `doctor_service_relation`
  ADD PRIMARY KEY (`doctor_service_relation`),
  ADD KEY `fk_doctor_service_relation_services1_idx` (`fkservicesId`),
  ADD KEY `fk_doctor_service_relation_doctor1_idx` (`fkdoctorId`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientId`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`servicesId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `fk_user_usertype1_idx` (`fkusertypeId`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`usertypeId`);

--
-- Indexes for table `working_hour`
--
ALTER TABLE `working_hour`
  ADD PRIMARY KEY (`working_hourId`),
  ADD KEY `fk_working_hour_doctor1_idx` (`fkdoctorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doctor_service_relation`
--
ALTER TABLE `doctor_service_relation`
  MODIFY `doctor_service_relation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `servicesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `usertypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `working_hour`
--
ALTER TABLE `working_hour`
  MODIFY `working_hourId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fk_appointment_doctor1` FOREIGN KEY (`fkdoctorId`) REFERENCES `doctor` (`doctorId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_appointment_patient1` FOREIGN KEY (`fkpatientId`) REFERENCES `patient` (`patientId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_appointment_services1` FOREIGN KEY (`services_servicesId`) REFERENCES `services` (`servicesId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `fk_doctor_user` FOREIGN KEY (`fkuserId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `doctor_service_relation`
--
ALTER TABLE `doctor_service_relation`
  ADD CONSTRAINT `fk_doctor_service_relation_doctor1` FOREIGN KEY (`fkdoctorId`) REFERENCES `doctor` (`doctorId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_doctor_service_relation_services1` FOREIGN KEY (`fkservicesId`) REFERENCES `services` (`servicesId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_usertype1` FOREIGN KEY (`fkusertypeId`) REFERENCES `usertype` (`usertypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `working_hour`
--
ALTER TABLE `working_hour`
  ADD CONSTRAINT `fk_working_hour_doctor1` FOREIGN KEY (`fkdoctorId`) REFERENCES `doctor` (`doctorId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
