
-- AirAsia Rewards Sample Data
-- HW3: 5 accounts and 20 gift cards

INSERT INTO ACCOUNT (userId, accountType, points)
VALUES
(1, 'Standard', 5000),
(2, 'Premium', 12000),
(3, 'Standard', 7500),
(4, 'Premium', 20000),
(5, 'Standard', 3000);

INSERT INTO GIFTCARD (cardName, cardType, cardValue, points)
VALUES
('Amazon Gift Card', 'Shopping', 50.00, 5000),
('Starbucks Gift Card', 'Dining', 25.00, 2500),
('Visa Gift Card', 'Shopping', 100.00, 10000),
('Target Gift Card', 'Shopping', 50.00, 5000),
('Walmart Gift Card', 'Shopping', 25.00, 2500),
('Nike Gift Card', 'Shopping', 75.00, 7500),
('Apple Gift Card', 'Shopping', 100.00, 10000),
('Google Play Gift Card', 'Entertainment', 25.00, 2500),
('Netflix Gift Card', 'Entertainment', 50.00, 5000),
('Spotify Gift Card', 'Entertainment', 30.00, 3000),
('Uber Gift Card', 'Travel', 50.00, 5000),
('Airbnb Gift Card', 'Travel', 100.00, 10000),
('Delta Gift Card', 'Travel', 100.00, 10000),
('Southwest Gift Card', 'Travel', 75.00, 7500),
('Disney Gift Card', 'Entertainment', 100.00, 10000),
('Chipotle Gift Card', 'Dining', 25.00, 2500),
('DoorDash Gift Card', 'Dining', 50.00, 5000),
('Best Buy Gift Card', 'Shopping', 75.00, 7500),
('PlayStation Gift Card', 'Entertainment', 50.00, 5000),
('Xbox Gift Card', 'Entertainment', 25.00, 2500);
