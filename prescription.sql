-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2021 at 05:33 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prescription`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `mid` int(11) NOT NULL,
  `med_name` varchar(50) NOT NULL,
  `indication` int(10) NOT NULL,
  `indication1` int(10) NOT NULL,
  `usages` varchar(255) NOT NULL,
  `instruction` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`mid`, `med_name`, `indication`, `indication1`, `usages`, `instruction`) VALUES
(5, 'Paractamal 500mg', 22, 2, '2 Times a Day', 'Take after meal'),
(10, 'Tab. Ace Plus 65mg + 500mg', 2, 15, '1-2 tablets every 6 hours.', 'May be taken with food.'),
(11, 'Syp. Ace 120mg/5ml', 2, 12, '1-2 Measuring Spoonful', 'May be taken with/without food.'),
(12, 'Tab. Acflam 100mg', 15, 13, '2 tablets once a day. ', 'Should be taken with food.'),
(13, 'Tab. Intafenac 50mg', 15, 12, '1 tablet every 8 hours.', 'Should be taken with food.'),
(14, 'Tab. Alterin TR 100mg', 22, 12, '1 tablet every 8 hours.', 'Should be taken with food.'),
(15, 'Tab. Adlorin 5mg', 9, 7, '5 mg once a day', 'May be taken with/without food.'),
(16, 'Tab. Deslor PLUS 5mg+240mg ', 9, 8, '1 Tablet once a day.', 'May be taken with/without food.'),
(17, 'Syrp. Dorenta 10mg/5ml', 9, 18, '3-4 Times daily.', 'May be taken with/without food.'),
(18, 'Ciprocin 250mg', 22, 2, '1 Tablet twice a day 7-14 days.', 'May be taken with/without food.'),
(19, 'Emistat 8mg', 4, 22, '1 Tablet twice a day 1-3 days.', 'May be taken with/without food.');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pid` int(10) NOT NULL,
  `upi` int(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `age` int(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bp` varchar(15) NOT NULL,
  `temparature` varchar(255) NOT NULL,
  `weight` int(10) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `doc_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `upi`, `fname`, `lname`, `age`, `address`, `phone`, `email`, `bp`, `temparature`, `weight`, `sex`, `doc_id`) VALUES
(1, 305735, 'Abdul', 'Alim', 49, 'Badda, dhaka', '01915640679', 'user@gmai.com', '120/80', '36', 70, 'Male', 679),
(2, 656187, 'Mahinur', 'Rahman', 5, '24/B Paltan, Dhaka 1000', '01710198659', 'm.saheen@yahoo.com', '120/80', 'Normal', 20, 'female', 122),
(4, 715480, 'Tahmina ', 'Islam', 3, 'Rasulpur, Jatrabari, Dhaka 1236', '01783446007', '', '', '', 40, '', 1025),
(2, 750217, 'Ms. Maisha', 'Rahman', 11, 'Dania, Jatrabari, Dhaka 1236', '01756217366', 'sadia@gmail.com', 'B+', '98 F', 50, 'female', 679);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescriptionID` int(11) NOT NULL,
  `did` int(10) NOT NULL,
  `pid` int(15) NOT NULL,
  `complain` varchar(255) CHARACTER SET latin1 NOT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescriptionID`, `did`, `pid`, `complain`, `added_date`) VALUES
(19, 122, 715480, '', '2021-09-05'),
(20, 122, 656187, '', '2021-09-05'),
(21, 122, 656187, '', '2021-09-05'),
(22, 122, 656187, 'dgdfgrgtdgertgdfgdfg dfb hdfh bdf er gdfg  ', '2021-09-05'),
(23, 122, 656187, '', '2021-09-05'),
(24, 122, 656187, 'fgdsgdfgs', '2021-09-05'),
(25, 122, 656187, '', '2021-09-05'),
(26, 679, 305735, '', '2021-09-05'),
(111610, 679, 305735, '', '2021-09-05'),
(860429, 679, 305735, '', '2021-09-05'),
(988495, 679, 305735, '', '2021-09-05');

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `pid` int(11) NOT NULL,
  `indications` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`pid`, `indications`) VALUES
(22, 'Abdominal Pain'),
(9, 'Allergies'),
(6, 'Asthma'),
(1, 'Cold & flu'),
(21, 'Constipation'),
(3, 'Cough'),
(20, 'Diarrhea'),
(11, 'Fatigue'),
(2, 'Fever'),
(17, 'Gastitis'),
(5, 'Headaches'),
(8, 'Hives'),
(18, 'Insomnia'),
(13, 'Joint Pain'),
(12, 'Migraine'),
(23, 'Nausea'),
(19, 'Neckache'),
(15, 'Pain'),
(7, 'Rashes'),
(14, 'Stress'),
(10, 'Sunburn'),
(24, 'Tension Headache'),
(16, 'Vertio'),
(4, 'Vomiting');

-- --------------------------------------------------------

--
-- Table structure for table `select_med`
--

CREATE TABLE `select_med` (
  `id` int(11) NOT NULL,
  `med` int(50) NOT NULL,
  `useage` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `patient_id` int(10) NOT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `select_med`
--

INSERT INTO `select_med` (`id`, `med`, `useage`, `duration`, `patient_id`, `added_date`) VALUES
(29, 10, '1+1+1', '7 days', 656187, '2021-09-04'),
(30, 13, '1+0+1', '7 days', 656187, '2021-09-04'),
(31, 5, '1+1+1', '15 days', 656187, '2021-09-04'),
(34, 5, '1+0+1', '15 days', 656187, '2021-09-05'),
(35, 10, '1+1+1', '15 days', 656187, '2021-09-05'),
(36, 15, '1+0+1', '2 Days', 656187, '2021-09-05'),
(37, 17, '1+0+1', '2 Days', 656187, '2021-09-05'),
(38, 19, '1+0+1', '7 days', 656187, '2021-09-05'),
(39, 10, '1+0+0', '5 days', 715480, '2021-09-05'),
(40, 5, '1+0+1', '15 days', 750217, '2021-09-05'),
(41, 11, '1+1+1', '7 days', 715480, '2021-09-05'),
(42, 19, '1+0+1', '2 Weeks', 305735, '2021-09-05'),
(43, 10, '1+0+0', '15 days', 305735, '2021-09-05'),
(44, 12, '1+1+1', '15 days', 305735, '2021-09-05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `doc_id` int(10) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `desig_other` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `hospital` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`doc_id`, `fullname`, `email`, `designation`, `desig_other`, `DOB`, `address`, `phone`, `password`, `gender`, `hospital`) VALUES
(122, 'Arif Hossen', 'arif@gmail.com', 'Prof. ', 'MBBS(DMC), FCPS(Medicine)', '1990-02-01', '1/86 East Rasulpur, Dania, Jatrabari, Dhaka, Bangladesh, 1236', '01795795441', '$2y$10$KvOs95DMYIvVARG3ol32su/tZfHz9n3DR9kSySuW7rEqHi8l9hz7m', 'Male', 'Dhaka Medical College'),
(679, 'Dr. Quazi Md. Enayet Hossain', 'quazi@gmail.com', 'Assoc. Prof.', 'MBBS', '1980-01-01', 'KutubKhali, Dhaka 1236', '01915640679', '$2y$10$Ru3vNZflqxzceRrVt2eVb.3.6nk2WUw63/DAArxLLwTpQf09Q3uXG', 'Male', 'New Padma Medical'),
(1012, 'Arif Hossen', 'arif1@gmail.com', 'Prof.', '', '2023-10-03', 'Dhaka', '01795795441', '$2y$10$KWQlXHiJi/iFu/Yd6/wRkOjdpLNkJwwcuEayAtc16wUjFXY2.LBbS', 'Male', 'BRB Hospital, Dhaka.'),
(1025, 'Dr. Shanaj Sarkar', 'shanaj.sarker@gmail.com', 'Prof. ,MBBS(DU), FCPS(UK)', '', '1980-06-15', '24/B Paltan, Dhaka 1000', '01795795895', '$2y$10$oWH0EWQ2mlQvwSFMhULIx./74GQegqhWXq75.NFSGeaGvV4zX0Fem', 'Female', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`mid`),
  ADD UNIQUE KEY `med_name` (`med_name`),
  ADD KEY `indication` (`indication`),
  ADD KEY `indication1` (`indication1`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`upi`),
  ADD KEY `pid` (`pid`),
  ADD KEY `doc_id` (`doc_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescriptionID`),
  ADD KEY `did` (`did`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `indications` (`indications`);

--
-- Indexes for table `select_med`
--
ALTER TABLE `select_med`
  ADD PRIMARY KEY (`id`),
  ADD KEY `med` (`med`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`doc_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `select_med`
--
ALTER TABLE `select_med`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`indication`) REFERENCES `problems` (`pid`),
  ADD CONSTRAINT `medicine_ibfk_2` FOREIGN KEY (`indication1`) REFERENCES `problems` (`pid`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `problems` (`pid`),
  ADD CONSTRAINT `patient_ibfk_2` FOREIGN KEY (`doc_id`) REFERENCES `users` (`doc_id`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`did`) REFERENCES `users` (`doc_id`),
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `patient` (`upi`);

--
-- Constraints for table `select_med`
--
ALTER TABLE `select_med`
  ADD CONSTRAINT `select_med_ibfk_1` FOREIGN KEY (`med`) REFERENCES `medicine` (`mid`),
  ADD CONSTRAINT `select_med_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`upi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
