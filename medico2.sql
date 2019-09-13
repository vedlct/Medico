-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2019 at 03:00 PM
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
-- Database: `medico2`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentId` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `patientName` varchar(100) NOT NULL,
  `age` int(150) NOT NULL,
  `gender` int(11) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `fkdoctorId` int(11) NOT NULL,
  `fkpatientId` int(11) NOT NULL,
  `services_servicesId` int(11) DEFAULT NULL,
  `serialnumber` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentId`, `phone`, `patientName`, `age`, `gender`, `address`, `email`, `fkdoctorId`, `fkpatientId`, `services_servicesId`, `serialnumber`, `status`, `appointment_date`, `appointment_time`) VALUES
(1, '01978278378', '0', 20, 1, 'y5j5j', 'admin@gmail.com', 1, 2, NULL, NULL, NULL, NULL, '11:32:00'),
(2, '01942993375', '3', 90, 1, 'fwewefwefwe', 'company@gmail.com', 2, 3, NULL, NULL, NULL, NULL, '11:48:00');

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
(1, 'Test ', 'Doctor', NULL, 'mujtaba.rumi1@gmail.com', 1, '01680674598', '1Image.jpg', 'Shewrapara , Mirpur', 2, 0),
(2, 'doc1', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 3, 0),
(3, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 4, 0),
(5, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 6, 0),
(6, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 7, 0),
(7, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 8, 0),
(8, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 9, 1),
(9, 'MD . MUJTABA', 'RUMI', NULL, 'mujtaba.rumi1@gmail.com', 1, '1680674598', NULL, 'Shewrapara , Mirpur', 10, 1),
(10, 'Rararara', 'Lalalala', 'MBBS', 'admin@test.com', 1, '01942993375', NULL, 'qwefewgwergrg', 11, 1);

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
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `age` int(150) NOT NULL,
  `gender` int(11) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientId`, `firstName`, `lastName`, `age`, `gender`, `address`, `phone`) VALUES
(1, 'Umar', 'Ekanto', 10, 1, 'qewfewfwef', '01942993375'),
(2, 'Rifat', 'Abir', 20, 1, 'fefefe', '01942993375'),
(3, 'Umar', 'Ekanto', 10, 1, 'wegeger', '01942993375'),
(5, 'Rara', 'Lalla', 90, 1, 'fwefwef', '01917589434');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `servicesId` int(11) NOT NULL,
  `servicesName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Farzad', 'Rahman', 'admin@gmail.com', '$2y$10$UCH8hBMvfPAfU237Dq4Tf.xKz5S/n8iH4Lf4q2bwo7ymIi6wXyime', '01731893442', 1, 1, 'dXOWz16jlsoHkCBOXjmf1DDSFzBSwMrq5mVqddSyisbkW9mWhwa87znUNukE', '2019-05-22 08:35:59', NULL),
(2, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '159', '01680674598', 3, 0, NULL, '2019-05-23 02:33:26', '2019-05-23 05:07:11'),
(3, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '123456', '1680674598', 3, 0, NULL, '2019-05-23 03:12:33', '2019-09-06 02:56:21'),
(4, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '123456', '1680674598', 3, 0, NULL, '2019-05-23 03:12:45', '2019-09-06 02:56:25'),
(5, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '123456', '1680674598', 3, 0, NULL, '2019-05-23 03:12:56', '2019-09-06 02:56:28'),
(6, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '159', '1680674598', 3, 0, NULL, '2019-05-23 03:13:13', '2019-09-06 02:56:31'),
(7, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '789', '1680674598', 3, 0, NULL, '2019-05-23 03:14:31', '2019-09-06 02:56:34'),
(8, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '258', '1680674598', 3, 0, NULL, '2019-05-23 03:15:11', '2019-09-06 02:56:38'),
(9, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '159', '1680674598', 3, 1, NULL, '2019-05-23 03:15:59', '2019-05-23 03:15:59'),
(10, 'MD . MUJTABA', 'RUMI', 'mujtaba.rumi1@gmail.com', '147', '1680674598', 3, 1, NULL, '2019-05-23 03:16:38', '2019-05-23 03:16:38'),
(11, 'Rararara', 'Lalalala', 'admin@test.com', '123456', '01942993375', 3, 1, NULL, '2019-09-06 02:59:12', '2019-09-06 02:59:12');

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
-- Dumping data for table `working_hour`
--

INSERT INTO `working_hour` (`working_hourId`, `fkdoctorId`, `day`, `start_time`, `end_time`) VALUES
(1, 2, 'Monday', '11:00:00', '18:00:00'),
(3, 10, 'Tuesday', '12:00:00', '12:15:00'),
(4, 10, 'Thursday', '16:50:00', '16:50:00');

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
  MODIFY `appointmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `doctor_service_relation`
--
ALTER TABLE `doctor_service_relation`
  MODIFY `doctor_service_relation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `servicesId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `usertypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `working_hour`
--
ALTER TABLE `working_hour`
  MODIFY `working_hourId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
