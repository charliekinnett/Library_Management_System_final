-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 12:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookID` int(11) NOT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Author` varchar(100) DEFAULT NULL,
  `ISBN` varchar(13) DEFAULT NULL,
  `PublisherID` int(11) DEFAULT NULL,
  `GenreID` int(11) DEFAULT NULL,
  `PublicationYear` year(4) DEFAULT NULL,
  `Availability` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookID`, `Title`, `Author`, `ISBN`, `PublisherID`, `GenreID`, `PublicationYear`, `Availability`) VALUES
(1, 'To Kill a Mockingbird', 'Harper Lee', '9780061120084', 2, 1, '1960', 1),
(2, '1984', 'George Orwell', '9780451524935', 4, 1, '1949', 1),
(3, 'The Great Gatsby', 'F. Scott Fitzgerald', '9780743273565', 5, 1, '1925', 1),
(4, 'Pride and Prejudice', 'Jane Austen', '9780486284736', 3, 1, '0000', 1),
(5, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', '9780590353427', 1, 2, '1997', 1);

-- --------------------------------------------------------

--
-- Table structure for table `borrowing`
--

CREATE TABLE `borrowing` (
  `BorrowingID` int(11) NOT NULL,
  `MemberID` int(11) DEFAULT NULL,
  `BookID` int(11) DEFAULT NULL,
  `LibrarianID` int(11) DEFAULT NULL,
  `CheckOutDate` date DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `ReturnDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowing`
--

INSERT INTO `borrowing` (`BorrowingID`, `MemberID`, `BookID`, `LibrarianID`, `CheckOutDate`, `DueDate`, `ReturnDate`) VALUES
(1, 1, 1, 1, '2023-01-10', '2023-01-24', NULL),
(2, 2, 2, 2, '2023-02-15', '2023-03-01', NULL),
(3, 3, 3, 3, '2023-03-20', '2023-04-03', NULL),
(4, 4, 4, 4, '2023-04-25', '2023-05-09', NULL),
(5, 5, 5, 5, '2023-05-30', '2023-06-13', NULL),
(6, 5, 4, 5, '2024-06-07', '2024-06-08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `GenreID` int(11) NOT NULL,
  `GenreName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`GenreID`, `GenreName`) VALUES
(1, 'Fiction'),
(2, 'Non-Fiction'),
(3, 'Mystery'),
(4, 'Science Fiction'),
(5, 'Thriller');

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE `librarian` (
  `LibrarianID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `HireDate` date DEFAULT NULL,
  `JobTitle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`LibrarianID`, `Name`, `Email`, `PhoneNumber`, `Address`, `HireDate`, `JobTitle`) VALUES
(1, 'John Smith', 'john@example.com', '123-456-7890', '123 Main St, Cityville', '2022-01-15', 'Head Librarian'),
(2, 'Emily Brown', 'emily@example.com', '987-654-3210', '456 Elm St, Townsville', '2022-02-20', 'Assistant Librarian'),
(3, 'Michael Johnson', 'michael@example.com', '111-222-3333', '789 Oak St, Villagetown', '2022-03-10', 'Library Clerk'),
(4, 'Sarah Wilson', 'sarah@example.com', '444-555-6666', '321 Pine St, Hamletville', '2022-04-05', 'Library Assistant'),
(5, 'David Lee', 'david@example.com', '777-888-9999', '567 Maple St, Metropolis', '2022-05-15', 'Library Technician');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `MemberID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `MembershipStatus` varchar(50) DEFAULT NULL,
  `RegistrationDate` date DEFAULT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MemberID`, `Name`, `Email`, `PhoneNumber`, `Address`, `MembershipStatus`, `RegistrationDate`, `Password`) VALUES
(1, 'Alice Johnson', 'alice@example.com', '123-456-7890', '123 Main St, Cityville', 'Active', '2022-01-15', ''),
(2, 'Bob Smith', 'bob@example.com', '987-654-3210', '456 Elm St, Townsville', 'Active', '2022-02-20', ''),
(3, 'Emma Davis', 'emma@example.com', '111-222-3333', '789 Oak St, Villagetown', 'Active', '2022-03-10', ''),
(4, 'Grace Wilson', 'grace@example.com', '444-555-6666', '321 Pine St, Hamletville', 'Active', '2022-04-05', ''),
(5, 'James Brown', 'james@example.com', '777-888-9999', '567 Maple St, Metropolis', 'Active', '2022-05-15', ''),
(6, 'JamesBond', 'james@gmail.com', '0900786014', 'United Kingdom', 'Regular', '2024-05-05', '$2y$10$a3fWCFb.fLk2.99GFAEonue.7LaK70vMQVQoaPapbXK1W2.NWsHXa'),
(7, 'kamran', 'james@gmail.com', '0900786014', 'United Kingdom', 'Regular', '2024-05-05', '$2y$10$10hO9Y5cuEyrtJq2GIiiZOa0ER2nyDPZakRPpM/6DzedzDyD4pMuS');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `PublisherID` int(11) NOT NULL,
  `PublisherName` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`PublisherID`, `PublisherName`, `Address`, `PhoneNumber`, `Email`) VALUES
(1, 'Penguin Random House', '1745 Broadway, New York, NY 10019', '+1 (212) 782-9000', 'info@penguinrandomhouse.com'),
(2, 'HarperCollins Publishers', '195 Broadway, New York, NY 10007', '+1 (212) 207-7000', 'info@harpercollins.com'),
(3, 'Simon & Schuster', '1230 Avenue of the Americas, New York, NY 10020', '+1 (212) 698-7000', 'info@simonandschuster.com'),
(4, 'Macmillan Publishers', '120 Broadway, New York, NY 10271', '+1 (212) 226-7521', 'info@macmillan.com'),
(5, 'Hachette Book Group', '1290 Avenue of the Americas, New York, NY 10104', '+1 (212) 364-1100', 'info@hachettebookgroup.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `PublisherID` (`PublisherID`),
  ADD KEY `GenreID` (`GenreID`);

--
-- Indexes for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD PRIMARY KEY (`BorrowingID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `BookID` (`BookID`),
  ADD KEY `LibrarianID` (`LibrarianID`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`GenreID`);

--
-- Indexes for table `librarian`
--
ALTER TABLE `librarian`
  ADD PRIMARY KEY (`LibrarianID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`PublisherID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `BookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `borrowing`
--
ALTER TABLE `borrowing`
  MODIFY `BorrowingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `GenreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `librarian`
--
ALTER TABLE `librarian`
  MODIFY `LibrarianID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `PublisherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`PublisherID`) REFERENCES `publisher` (`PublisherID`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`GenreID`) REFERENCES `genre` (`GenreID`);

--
-- Constraints for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD CONSTRAINT `borrowing_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`),
  ADD CONSTRAINT `borrowing_ibfk_2` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`),
  ADD CONSTRAINT `borrowing_ibfk_3` FOREIGN KEY (`LibrarianID`) REFERENCES `librarian` (`LibrarianID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
