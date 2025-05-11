-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 12:45 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `content`) VALUES
(1, 'My name is Mugisha Prince, and I am a CyberOps Associate with certifications in CC, CNSP, and expertise in Ethical Hacking. I specialize in penetration testing, ethical hacking, and digital forensics');

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`id`, `content`, `link`) VALUES
(1, 'Cisco CyberOps Associate', 'https://example.com/cyberops'),
(2, 'Certified Ethical Hacker', 'https://example.com/ceh'),
(3, 'CNSP', 'https://example.com/cnsp');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `type`, `link`) VALUES
(1, 'email', 'mailto:mugishaprinc3@gmail.com'),
(2, 'linkedin', 'https://www.linkedin.com/in/mugisha-prince-31b647252/'),
(3, 'github', 'https://github.com/HirwaAlainFabrice');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date_range` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `title`, `date_range`, `description`) VALUES
(1, 'Cyber Security Intern - Hacktify Cyber Security', 'Feb 2024 – Mar 2024', 'Gained hands-on experience in vulnerability analysis, risk management, and threat intelligence.'),
(2, 'Penetration Testing Intern - CFSS Cyber & Forensics Security Solutions', 'Dec 2023 – Jan 2024', 'Performed penetration testing following OWASP methodologies, executed security audits.'),
(3, 'Cyber Security and Digital Forensics Intern - Cyber Secured India', 'Aug 2023 – Nov 2023', 'Focused on web pen testing, android pen testing, and digital forensics.'),
(4, 'Student Intern (Cyber Security) - BICT', 'Mar 2023 – Aug 2023', 'Assisted with cyber security research and ethical hacking methodologies.'),
(5, 'Cyber Security Researcher - BICT', 'Oct 2022 – Aug 2023', 'Conducted cyber security research focusing on ethical hacking, malware analysis');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `emoji` varchar(10) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `emoji`, `category`, `description`) VALUES
(1, '🌐', 'Networking', 'Fundamentals of network design, routing, and switching.'),
(2, '🛡️', 'Cybersecurity', 'Penetration testing, threat analysis, and secure coding.'),
(3, '🛠️', 'Tools and Platforms', 'Proficient in tools like Wireshark, Burp Suite, and Nessus.'),
(4, '💻', 'Programming and Web Development', 'Coding expertise in Python, JavaScript, and web technologies.'),
(5, '📊', 'Security Monitoring and Analysis', 'Monitoring and analyzing threats using SIEM tools.'),
(6, '📘', 'Fundamental Concepts', 'Core principles of information security and cryptography.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
