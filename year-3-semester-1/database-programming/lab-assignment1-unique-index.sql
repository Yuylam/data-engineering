# Lab Assignment 1 - Unique Index
# Goe Jie Ying A23CS0224
# Lam Yoke Yu A23CS0233
# Tan Yi Ya A23CS0187
# Teh Ru Qian A23CS0191

CREATE DATABASE index_lab;
USE index_lab;

DROP TABLE customer;
CREATE TABLE customer(
	cust_id INT AUTO_INCREMENT,
    email VARCHAR(50),
    phone VARCHAR(15),
    PRIMARY KEY(cust_id)
);

INSERT INTO customer (email, phone) VALUES
('alice@gmail.com', '0123456789'),
('bob@yahoo.com', '0112233445'),
('charlie@outlook.com', '0198765432'),
('david@gmail.com', '0131122334'),
('eva@hotmail.com', '0179988776'),
('frank@gmail.com', '0165566778'),
('grace@gmail.com', '0153344556'),
('henry@gmail.com', '0126677889'),
('alice@gmail.com', '0142233445'), -- duplicated
('ivan@gmail.com', '0184455667');

ALTER TABLE customer ADD UNIQUE idx_email (email);

DELETE FROM customer
WHERE cust_id = 9;

EXPLAIN SELECT * FROM customer WHERE email = 'grace@gmail.com'; -- Task 9

ALTER TABLE customer ADD UNIQUE idx_email (email);

EXPLAIN SELECT * FROM customer WHERE email = 'henry@gmail.com'; -- Task 9

INSERT INTO customer (email, phone) VALUES ('alice@gmail.com', '0199999999');

SHOW INDEX FROM customer;



