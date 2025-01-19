
-- ***********************************************************************
-- Medicinal Plants Project
-- Purpose: To store information about medicinal plants found in Saudi Arabia
-- and their uses in traditional medicine.
-- ***********************************************************************

-- Create a database for medicinal plants
CREATE DATABASE MedicinalPlantsDB;

-- Select the database to use
USE MedicinalPlantsDB;

-- Create the table to store information about plants
CREATE TABLE Plants (
    PlantID INT AUTO_INCREMENT PRIMARY KEY,
    PlantName VARCHAR(100) NOT NULL, 
    Classification VARCHAR(50),
    Region VARCHAR(50),
    Description TEXT,
    Benefits TEXT,
    UsageMethods TEXT,
    Warnings TEXT
);

-- Insert data for each plant in the table
INSERT INTO Plants (PlantName, Classification, Region, Description, Benefits, UsageMethods, Warnings)
VALUES 
('Aloe Vera', 'Anti-inflammatory', 'Central Region', 
 'Aloe Vera is known for its healing properties, especially for burns and skin wounds.', 
 'Helps to soothe burns, heal wounds, and moisturize skin.', 
 'Apply the gel to the skin or use it as a mask on the face.',
 'Some people may have allergic reactions, avoid using it on open wounds.'),

('Harmal', 'Antioxidant', 'Western Region', 
 'Harmal (Syrian Rue) is known for its antibacterial properties and is used in traditional medicine.', 
 'It has antibacterial properties and helps to improve mood.', 
 'Boil the seeds in water and drink as tea. The powder can also be used topically.',
 'Not safe for pregnant women, may cause dizziness when taken in large amounts.'),

('Moringa', 'Digestive', 'Eastern Region', 
 'Moringa is also known as the "miracle tree" due to its high nutritional value.', 
 'Boosts immunity, reduces blood pressure, and helps with inflammation.', 
 'Add fresh leaves to smoothies or soups. It can also be used in salads.',
 'Be careful if you are on blood pressure medication, as it can interact with it.'),

('Indian Costus', 'Respiratory', 'Central Region', 
 'Indian Costus is a plant used in traditional medicine for respiratory issues.', 
 'Helps with respiratory health, reduces inflammation, and aids digestion.', 
 'Boil the roots to make tea or use the dried powder in different preparations.',
 'Overuse can lead to liver problems.'),

('Lavender', 'Anti-inflammatory', 'Western Region', 
 'Lavender is an aromatic plant with relaxing and therapeutic properties.', 
 'Helps to reduce anxiety, improve sleep, and relax the muscles.', 
 'Add dried lavender flowers to tea or use lavender oil for aromatherapy.',
 'Avoid applying lavender oil directly to sensitive skin.'),

('Rosemary', 'Antioxidant', 'Eastern Region', 
 'Rosemary is used in traditional medicine for its healing effects on the digestive system.',
 'Helps with digestion, reduces stress, and enhances memory.', 
 'Use rosemary in cooking or prepare tea using the leaves.',
 'May cause allergic reactions in some people. Be cautious if you have high blood pressure.'),

('Thyme', 'Digestive', 'Central Region', 
 'Thyme is a well-known herb for its medicinal properties.', 
 'Helps with digestion and has antibacterial effects.', 
 'Add fresh thyme to meals or make tea from dried leaves.',
 'May cause allergic reactions for some individuals.'),

('Chamomile', 'Anti-inflammatory', 'Western Region', 
 'Chamomile is commonly used for its calming effects and is widely used in tea.',
 'Helps with relaxation, improves sleep, and aids digestion.',
 'Drink chamomile tea before bedtime or add to hot water for a calming effect.',
 'Avoid if allergic to ragweed or similar plants.'),

('Peppermint', 'Antioxidant', 'Eastern Region', 
 'Peppermint has a cooling effect and is used for its medicinal properties.', 
 'Helps with digestion, headaches, and muscle pain.',
 'Use peppermint oil for headaches or drink peppermint tea for digestive issues.',
 'Excessive use can lead to heartburn in some people.'),

('Eucalyptus', 'Antioxidant', 'Central Region', 
 'Eucalyptus leaves are known for their antiseptic and healing properties.',
 'Helps with respiratory problems and muscle relaxation.',
 'Inhale the vapor or use eucalyptus oil in a diffuser.',
 'Avoid for young children under 2 years of age.'),

('Sage', 'Digestive', 'Western Region', 
 'Sage is a herb that has been used for its medicinal properties for centuries.',
 'Improves digestion and reduces inflammation.',
 'Add fresh sage to tea or use it in cooking.',
 'Large amounts should be avoided during pregnancy or breastfeeding.'),

('Ginger', 'Anti-inflammatory', 'Eastern Region', 
 'Ginger is a widely used herb known for its strong medicinal properties.',
 'Helps with digestion, nausea, and inflammation.',
 'Use fresh ginger in cooking or make ginger tea.',
 'Can cause stomach upset in high doses.'),

('Turmeric', 'Antioxidant', 'Central Region', 
 'Turmeric is a common spice with many medicinal benefits.',
 'Reduces inflammation, helps with joint health, and supports skin health.',
 'Use turmeric in cooking or take it as a supplement.',
 'Large amounts may cause stomach discomfort. Avoid if you have gallbladder issues.'),

('Basil', 'Digestive', 'Western Region', 
 'Basil is a common herb known for its digestive benefits.',
 'Helps with digestion, reduces stress, and strengthens the immune system.',
 'Add fresh basil to salads, soups, or drink basil tea.',
 'May cause allergic reactions in some people.'),

('Oregano', 'Antioxidant', 'Eastern Region', 
 'Oregano is a strong herb used for its antibacterial properties.',
 'Has antibacterial and antiviral effects.',
 'Add oregano to meals or brew oregano leaves to make tea.',
 'May cause allergic reactions for some people.');
