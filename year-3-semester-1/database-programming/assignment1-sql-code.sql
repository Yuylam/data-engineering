# SECP3623 Database Programming
# Assignment 1
# Lam Yoke Yu A23CS0233
# Tan Yi Ya A23CS0187

# Task 1
# 1. Create database
CREATE DATABASE host_mgmt_yokeyu_yiya;
USE host_mgmt_yokeyu_yiya;

# 2. Create tables with entity and referential integrity
# 3. Apply contraints
CREATE TABLE room_types(
	type_id INT PRIMARY KEY,
    type_name VARCHAR(10) NOT NULL,
    rent DOUBLE NOT NULL,
    deposit DOUBLE NOT NULL,
    capacity INT NOT NULL
);

CREATE TABLE rooms(
	room_id INT PRIMARY KEY,
    room_no VARCHAR(5) NOT NULL,
    floor_no INT NOT NULL,
    is_occupied BOOL DEFAULT FALSE,
    type_id INT NOT NULL,
    FOREIGN KEY (type_id) REFERENCES room_types(type_id)
);

CREATE TABLE students(
	student_id INT PRIMARY KEY,
    fname VARCHAR(20) NOT NULL,
    lname VARCHAR(20) NOT NULL,
    status VARCHAR(20) NOT NULL,
    checkin_date DATE,
    room_id INT,
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
);

CREATE TABLE maintenance(
	maint_id INT PRIMARY KEY,
    room_id INT NOT NULL,
    issue_desc TEXT NOT NULL,
    severity VARCHAR(10),
    status VARCHAR(10) NOT NULL,
    reported_on DATE NOT NULL,
    resolved_on DATE,
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
);

CREATE TABLE payments(
	payment_id INT PRIMARY KEY,
    student_id INT NOT NULL,
    amount DOUBLE NOT NULL,
    paid_on DATE NOT NULL,
    method VARCHAR(5) NOT NULL,
    note TEXT,
    FOREIGN KEY (student_id) REFERENCES students(student_id)
);

# 5. Schema Maintenance
# 5.1 ALTER TABLE
ALTER TABLE students
	ADD COLUMN email VARCHAR(30) UNIQUE;
    
# 5.2 DROP TABLE
CREATE TABLE testing(
	test_id INT PRIMARY KEY,
    test_desc TEXT NOT NULL
);

DROP TABLE testing;

#Task 2
# 1. Data Insertion
INSERT INTO room_types (type_id, type_name, rent, deposit, capacity) VALUES
(1, 'Single', 550, 300, 1),
(2, 'Double', 700, 350, 2),
(3, 'Premium', 900, 450, 2),
(4, 'Family', 1200, 600, 4),
(5, 'Economy', 450, 250, 1),
(6, 'Twin', 750, 350, 2),
(7, 'Suite', 1000, 500, 3),
(8, 'Deluxe', 850, 400, 2),
(9, 'Dorm', 400, 200, 6),
(10, 'Studio', 650, 300, 2);
SELECT * FROM room_types;

INSERT INTO rooms (room_id, room_no, floor_no, is_occupied, type_id) VALUES
(1, 'A101', 1, TRUE, 2),
(2, 'A102', 1, FALSE, 2),
(3, 'A103', 1, TRUE, 2),
(4, 'A201', 2, FALSE, 1),
(5, 'A202', 2, TRUE, 1),
(6, 'A301', 1, TRUE, 5),
(7, 'B101', 1, FALSE, 4),
(8, 'B201', 2, TRUE, 8),
(9, 'C101', 1, FALSE, 9),
(10, 'C201', 2, TRUE, 10);
SELECT * FROM rooms;

INSERT INTO students (student_id, fname, lname, status, checkin_date, room_id, email) VALUES
(1, 'Aiman', 'Rahman', 'Active', '2025-01-10', 1, 'aiman@graduate.utm.my'),
(2, 'Siti', 'Zahra', 'Active', '2025-01-12', 3, 'siti@graduate.utm.my'),
(3, 'Daniel', 'Tan', 'Active', '2025-02-01', 5, 'daniel@graduate.utm.my'),
(4, 'Nurul', 'Izzah', 'Inactive', NULL, NULL, 'nurul@graduate.utm.my'),
(5, 'Arif', 'Hakim', 'Active', '2025-01-15', 6, 'arif@graduate.utm.my'),
(6, 'Li', 'Wei', 'Active', '2025-02-05', 8, 'li@graduate.utm.my'),
(7, 'Amira', 'Sofea', 'Active', '2025-03-01', 10, 'amira@graduate.utm.my'),
(8, 'Ravi', 'Kumar', 'Inactive', NULL, NULL, 'ravi@graduate.utm.my'),
(9, 'Farah', 'Nadia', 'Active', '2025-02-20', 7, 'farah@graduate.utm.my'),
(10, 'Hafiz', 'Azlan', 'Active', '2025-03-10', 9, 'hafiz@graduate.utm.my');
SELECT * FROM students;

INSERT INTO maintenance (maint_id, room_id, issue_desc, severity, status, reported_on, resolved_on) VALUES
(1, 7, 'Water leakage', 'HIGH', 'RESOLVED', '2025-01-12', '2025-01-15'),
(2, 3, 'Broken chair', 'LOW', 'RESOLVED', '2025-02-03', '2025-02-05'),
(3, 6, 'Fan have noise', 'MEDIUM', 'RESOLVED', '2025-03-22', '2025-03-24'),
(4, 2, 'Door lock broken', 'HIGH', 'RESOLVED', '2025-03-25', '2025-03-26'),
(5, 9, 'Missing pillow', 'LOW', 'OPEN', '2025-04-04', NULL),
(6, 4, 'Broken window', 'HIGH', 'RESOLVED', '2025-04-15', '2025-04-17'),
(7, 1, 'Unstable WiFi connection', 'LOW', 'OPEN', '2025-05-02', NULL),
(8, 10, 'Power socket not functioning', 'MEDIUM', 'RESOLVED', '2025-07-12', '2025-07-13'),
(9, 5, 'Window lock rusty', 'LOW', 'OPEN', '2025-08-05', NULL),
(10, 8, 'Air conditioner not working', 'MEDIUM', 'OPEN', '2025-11-08', NULL);
SELECT * FROM maintenance;

INSERT INTO payments (payment_id, student_id, amount, paid_on, method, note) VALUES
(1, 1, 700.00, '2025-01-10', 'CASH', 'Aiman, A101, January'),
(2, 2, 700.00, '2025-01-12', 'FPX', 'Siti, A103, January'),
(3, 3, 550.00, '2025-01-15', 'CARD', 'Daniel, A202, January'),
(4, 5, 450.00, '2025-01-20', 'TNG', 'Arif, A301, January'),
(5, 6, 850.00, '2025-01-25', 'FPX', 'Li, B201, January'),
(6, 7, 650.00, '2025-02-01', 'CARD', 'Amira, C201, February'),
(7, 9, 1200.00, '2025-02-05', 'CASH', 'Farah, B101, February'),
(8, 10, 400.00, '2025-02-07', 'TNG', 'Hafiz, C101, February'),
(9, 1, 700.00, '2025-02-10', 'FPX', 'Aiman, A101, February'),
(10, 2, 700.00, '2025-02-12', 'CARD', 'Siti, A103, February');
SELECT * FROM payments;

# 2. Update and delete operation
# update operation
SET SQL_SAFE_UPDATES = 0;
UPDATE rooms r
LEFT JOIN students s
    ON r.room_id = s.room_id
SET r.is_occupied = 
CASE
    WHEN s.status = 'Active' THEN TRUE
    ELSE FALSE
END;
SELECT * FROM rooms;

# delete operation
DELETE FROM maintenance
WHERE 
	status = 'RESOLVED' AND
    reported_on <= DATE_SUB(CURDATE(), INTERVAL 60 DAY); 
SET SQL_SAFE_UPDATES = 1;
SELECT * FROM maintenance;

# 3. Data retrieval and filtering queries
#Display room types where rent is between rm400 and rm800
SELECT type_name FROM room_types WHERE rent BETWEEN 400 AND 800;

#Retrieve students whose fname start with the letter 'A'
SELECT fname, lname FROM students WHERE fname LIKE 'A%';

#Display payments where the payment method is FPX or CARD
SELECT * FROM payments WHERE method IN ('FPX', 'CARD');

#combine AND, OR and NOT
SELECT m.room_id, m.issue_desc, m.severity, m.status, r.room_no, r.floor_no
FROM maintenance m
LEFT JOIN rooms r ON m.room_id = r.room_id
WHERE m.status = 'OPEN'
AND m.severity != 'LOW'
	AND (
        m.severity = 'HIGH'
        OR  reported_on <= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
    );
    
# 4. Functions and Expressions
# Aggregate Function
SELECT AVG(rent) AS average_rent
FROM room_types;
    
# String Functions
SELECT UPPER(CONCAT(fname, ' ', lname)) AS full_name_uppercase, status
FROM students;

# Task 3
# 1. Create v_room_status
CREATE VIEW v_room_status AS
	SELECT r.room_no, rt.type_name, rt.rent, r.floor_no, rt.capacity, 
		COUNT(CASE WHEN s.status = 'ACTIVE' THEN 1 END) AS n_occupants,
		COUNT(CASE WHEN m.status = 'OPEN' THEN 1 END) AS pending_issues,
		CASE
			WHEN COUNT(CASE WHEN s.status = 'ACTIVE' THEN 1 END) = 0 THEN TRUE
			ELSE FALSE
		END AS is_vacant
	FROM rooms r
	LEFT OUTER JOIN room_types rt ON (r.type_id = rt.type_id)
	LEFT OUTER JOIN students s ON (r.room_id = s.room_id)
	LEFT OUTER JOIN maintenance m ON (r.room_id = m.room_id)
	GROUP BY r.room_no, rt.type_name, rt.rent, r.floor_no, rt.capacity;
    
SELECT * FROM v_room_status;

# 2. Summary Queries
# 2.1 Total number of students per room type
SELECT rt.type_name, COUNT(CASE WHEN s.status = 'ACTIVE' THEN 1 END) AS n_occupants
FROM room_types rt 
LEFT OUTER JOIN rooms r ON (r.type_id = rt.type_id)
LEFT OUTER JOIN students s ON (r.room_id = s.room_id)
GROUP BY rt.type_name;

# 2.2 Average rent and total deposit per room type
SELECT UPPER(rt.type_name), 
	ROUND(AVG(rt.rent), 2) AS avg_rent,
    ROUND(SUM(rt.deposit), 2) AS total_deposit,
	CASE 
		WHEN AVG(rt.rent) > 1000 THEN 'High'
        WHEN AVG(rt.rent) > 500 THEN 'Medium'
        ELSE 'Low'
	END AS rent
FROM students s
LEFT OUTER JOIN  rooms r ON (r.room_id = s.room_id)
LEFT OUTER JOIN room_types rt ON (r.type_id = rt.type_id)
WHERE s.status = 'Active'
GROUP BY rt.type_name;

# 2.3 Monthly payment totals grouped by year & month
SELECT 
	YEAR(paid_on) AS payment_year,
	MONTH(paid_on) AS payment_month,
	ROUND(SUM(amount), 2) AS total_payment
FROM payments
GROUP BY YEAR(paid_on), MONTH(paid_on);

# 2.4 Count of OPEN maintenance issues per floor
INSERT INTO maintenance (maint_id, room_id, issue_desc, severity, status, reported_on, resolved_on) VALUES
(11, 7, 'Water leakage', 'HIGH', 'OPEN', '2025-01-12', NULL),
(12, 3, 'Broken chair', 'LOW', 'OPEN', '2025-02-03', NULL),
(13, 6, 'Fan have noise', 'MEDIUM', 'OPEN', '2025-03-22', NULL),
(14, 2, 'Door lock broken', 'HIGH', 'OPEN', '2025-03-25', NULL),
(15, 7, 'No water', 'HIGH', 'OPEN', '2025-01-12', NULL),
(16, 3, 'Broken window', 'LOW', 'OPEN', '2025-02-03', NULL),
(17, 6, 'Broken ceiling', 'MEDIUM', 'OPEN', '2025-03-22', NULL),
(18, 2, 'Loose window', 'HIGH', 'OPEN', '2025-03-25', NULL);

SELECT * FROM maintenance;

SELECT r.floor_no, COUNT(m.maint_id) AS open
FROM maintenance m
LEFT OUTER JOIN rooms r ON (m.room_id = r.room_id)
WHERE m.status = 'OPEN'
GROUP BY r.floor_no
HAVING COUNT(m.maint_id) > 2;

