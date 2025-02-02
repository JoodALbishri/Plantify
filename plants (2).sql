-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02 فبراير 2025 الساعة 05:34
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plantify`
--

-- --------------------------------------------------------

--
-- بنية الجدول `plants`
--

CREATE TABLE `plants` (
  `PlantID` int(11) NOT NULL,
  `PlantName` varchar(255) NOT NULL,
  `Classification` varchar(255) DEFAULT NULL,
  `Region` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Benefits` text DEFAULT NULL,
  `UsageMethods` text DEFAULT NULL,
  `Warnings` text DEFAULT NULL,
  `ImagePath` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `plants`
--

INSERT INTO `plants` (`PlantID`, `PlantName`, `Classification`, `Region`, `Description`, `Benefits`, `UsageMethods`, `Warnings`, `ImagePath`, `added_by`) VALUES
(1, 'Aloe Vera', 'Anti-inflammatory', 'Central Region', 'Aloe Vera is known for its healing properties, especially for burns and skin wounds.', 'Helps to soothe burns, heal wounds, and moisturize skin.', 'Apply the gel to the skin or use it as a mask on the face.', 'Some people may have allergic reactions, avoid using it on open wounds.', 'uploads/plants/Aloe Vera.jpg', NULL),
(2, 'Harmal', 'Antioxidant', 'Western Region', 'Harmal (Syrian Rue) is known for its antibacterial properties and is used in traditional medicine.', 'It has antibacterial properties and helps to improve mood.', 'Boil the seeds in water and drink as tea. The powder can also be used topically.', 'Not safe for pregnant women, may cause dizziness when taken in large amounts.', 'uploads/plants/Harmal.jpg', NULL),
(3, 'Moringa', 'Digestive', 'Eastern Region', 'Moringa is also known as the \"miracle tree\" due to its high nutritional value.', 'Boosts immunity, reduces blood pressure, and helps with inflammation.', 'Add fresh leaves to smoothies or soups. It can also be used in salads.', 'Be careful if you are on blood pressure medication, as it can interact with it.', 'uploads/plants/Moringa.jpg', NULL),
(4, 'Indian Costus', 'Respiratory', 'Central Region', 'Indian Costus is a plant used in traditional medicine for respiratory issues.', 'Helps with respiratory health, reduces inflammation, and aids digestion.', 'Boil the roots to make tea or use the dried powder in different preparations.', 'Overuse can lead to liver problems.', 'uploads/plants/Indian Costus.jpg', NULL),
(5, 'Lavender', 'Anti-inflammatory', 'Western Region', 'Lavender is an aromatic plant with relaxing and therapeutic properties.', 'Helps to reduce anxiety, improve sleep, and relax the muscles.', 'Add dried lavender flowers to tea or use lavender oil for aromatherapy.', 'Avoid applying lavender oil directly to sensitive skin.', 'uploads/plants/Lavender.jpg', NULL),
(6, 'Rosemary', 'Antioxidant', 'Eastern Region', 'Rosemary is used in traditional medicine for its healing effects on the digestive system.', 'Helps with digestion, reduces stress, and enhances memory.', 'Use rosemary in cooking or prepare tea using the leaves.', 'May cause allergic reactions in some people. Be cautious if you have high blood pressure.', 'uploads/plants/Rosemary.jpg', NULL),
(7, 'Basil', 'Aromatic', 'Northern Region', 'Basil is a widely used herb known for its strong aroma and medicinal properties.', 'Aids digestion, reduces inflammation, and fights infections.', 'Use fresh leaves in cooking or prepare herbal tea.', 'May cause allergic reactions in some individuals.', 'uploads/plants/Basil.jpg', NULL),
(8, 'Chamomile', 'Calming', 'Southern Region', 'Chamomile is known for its calming effects and use in teas.', 'Relieves stress, improves sleep, and aids digestion.', 'Prepare tea using dried chamomile flowers.', 'Avoid if allergic to daisies.', 'uploads/plants/chamomlie.jpg', NULL),
(9, 'Thyme', 'Antiseptic', 'Central Region', 'Thyme is commonly used in cooking and traditional medicine.', 'Boosts immunity, relieves coughs, and improves digestion.', 'Use fresh or dried in food, or prepare thyme tea.', 'Avoid excessive consumption as it may cause stomach irritation.', 'uploads/plants/Thyme.jpg', NULL),
(10, 'Mint', 'Cooling', 'Western Region', 'Mint is a refreshing herb used in teas, cooking, and medicine.', 'Aids digestion, relieves headaches, and freshens breath.', 'Use fresh or dried in tea, salads, or desserts.', 'Excessive use may cause acid reflux.', 'uploads/plants/Mint.jpg', NULL),
(11, 'Sage', 'Antioxidant', 'Eastern Region', 'Sage is known for its strong flavor and medicinal properties.', 'Improves memory, reduces inflammation, and supports oral health.', 'Use in cooking, tea, or as an essential oil.', 'Not recommended for pregnant women in large amounts.', 'uploads/plants/Sage.jpg', NULL),
(12, 'Eucalyptus', 'Respiratory', 'Northern Region', 'Eucalyptus is used for its antibacterial and respiratory benefits.', 'Relieves coughs, clears sinuses, and fights infections.', 'Use leaves in steam inhalation or as an essential oil.', 'Avoid ingestion as it may be toxic.', 'uploads/plants/eucalyptus.jpg', NULL),
(13, 'Lemon Balm', 'Calming', 'Southern Region', 'Lemon Balm is a herb known for its relaxing and antiviral properties.', 'Reduces anxiety, improves sleep, and soothes indigestion.', 'Use fresh or dried in tea or as an extract.', 'May interact with thyroid medications.', 'uploads/plants/Lemon balm.jpg', NULL),
(14, 'Ginger', 'Digestive', 'Central Region', 'Ginger is a widely used root for its anti-inflammatory and digestive benefits.', 'Aids digestion, reduces nausea, and fights colds.', 'Use fresh, dried, or as a tea.', 'May interact with blood-thinning medications.', 'uploads/plants/Ginger.jpg', NULL),
(15, 'Turmeric', 'Anti-inflammatory', 'Western Region', 'Turmeric is a spice known for its powerful anti-inflammatory effects.', 'Supports joint health, boosts immunity, and improves skin health.', 'Use in cooking, teas, or as a supplement.', 'High doses may cause stomach discomfort.', 'uploads/plants/turmeric.jpg', NULL),
(16, 'Fenugreek', 'Hormonal', 'Eastern Region', 'Fenugreek is used in traditional medicine for its effects on blood sugar and digestion.', 'Regulates blood sugar, supports lactation, and aids digestion.', 'Use seeds in cooking or tea.', 'May lower blood sugar levels too much if taken with diabetes medication.', 'uploads/plants/Fenugreek.jpg', NULL),
(17, 'Cinnamon', 'Antioxidant', 'Northern Region', 'Cinnamon is a spice known for its antioxidant properties and blood sugar regulation.', 'Lowers blood sugar, improves circulation, and supports digestion.', 'Use in cooking, teas, or as an extract.', 'Excessive intake may affect liver health.', 'uploads/plants/cinnamon.jpg', NULL),
(18, 'Cardamom', 'Digestive', 'Southern Region', 'Cardamom is a fragrant spice used for its digestive and antibacterial properties.', 'Aids digestion, freshens breath, and improves circulation.', 'Use in cooking, teas, or as an essential oil.', 'May lower blood pressure, so use with caution.', 'uploads/plants/Cardamom.jpg', NULL),
(19, 'Clove', 'Antibacterial', 'Central Region', 'Clove is known for its strong antibacterial and pain-relieving properties.', 'Relieves toothaches, fights infections, and aids digestion.\r\n', 'Use as a spice in food or clove oil for pain relief.', 'Avoid excessive consumption as it may cause stomach irritation.', 'uploads/plants/Clove.jpg', NULL),
(20, 'Anise', 'Calming', 'Western Region', 'Anise is a sweet spice known for its digestive and calming effects.', 'Aids digestion, relieves bloating, and reduces stress.', 'Use seeds in teas or as a spice in food.', 'May interact with hormonal medications.', 'uploads/plants/Anise.jpg', NULL),
(21, 'Fennel', 'Digestive', 'Eastern Region', 'Fennel is a plant known for its digestive and anti-inflammatory benefits.', 'Reduces bloating, supports eye health, and aids digestion.', 'Use seeds in cooking, teas, or as an extract.', 'Excessive consumption may cause low blood pressure.', 'uploads/plants/feneel.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`PlantID`),
  ADD KEY `added_by` (`added_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `PlantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `plants_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
