# Database Programming
This course introduces the fundamentals of database programming, including relational databases, NoSQL databases, indexing, query optimisation and transaction management. Practical exercises and projects were implemented using MySQL and MongoDB

- [Topics Covered](#topics-covered)
- [Assignments](#assignments)
- [Projects](#projects)
- [Reflection](#reflection)

## Topics Covered
- SQL Queries and Data Manipulation
- Indexes
- Transaction Management and Concurrency Control
- Two-Phase Locking (2PL)
- Stored Procedures and Functions
- Indexing and Query Optimisation
- MongoDB CRUD Operations

## Technologies Involved
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![MongoDB](https://img.shields.io/badge/MongoDB-47A248?style=for-the-badge&logo=mongodb&logoColor=white)

## Certification
[Microsoft Certified: Azure Fundamentals](https://www.credly.com/badges/ca5cca51-5f60-4c5b-a277-9ddbc628e6e9/public_url)

## Assignments
### [Assignment 1 Structured Relational Database System using SQL](/assignment1-sql.pdf)
A hostel accommodation management database system was developed using MySQL.
#### Key Topics
- Database and table creation
- Entity and referential integrity constraints
- Data manipulation (`INSERT`, `UPDATE`, `DELETE`)
- Filtering and aggregation queries
- SQL joins and conditional expressions
- View creation and schema maintenance
- Reporting and summary queries
#### Highlights
- Used `LEFT JOIN`, `CASE`, `GROUP BY`, and aggregate functions
- Implemented room occupancy tracking
- Generated payment summaries and room status reports
- Applied filtering conditions for maintenance monitoring

### [Assignment 2 Transaction Management](/assignment2-transaction-management.pdf)
This assignment focused on transaction scheduling and concurrency control mechanisms.
#### Key Topics
- Transaction scheduling
- Serialisability checking
- Precedence graph construction
- Locking techniques
- Two-Phase Locking (2PL)
- Concurrency control issues
#### Highlights
- Constructed precedence graphs to analyse transaction conflicts
- Applied locking protocols to transaction schedules
- Identified concurrency issues such as deadlocks and waiting scenarios

### [Lab Assignment 1 Unique Index](/lab-assignment1-unique-index.pdf)
This lab explored the implementation and performance impact of unique indexes in MySQL.
#### Key Topics
- Unique Index vs Primary Key
- Query optimisation
- B-Tree indexing
- `EXPLAIN` statement analysis
#### Highlights
- Compared query performance before and after indexing
- Analysed execution plans using `EXPLAIN`
- Demonstrated how indexes reduce table scans
- Evaluated advantages and disadvantages of unique indexes

### [Lab Assignment 2 MongoDB Operations](/lab-assignment2-nosql.pdf)
A clinic management database was implemented using MongoDB Compass.
#### Key Topics
- MongoDB database and collection creation
- CRUD operations
- Aggregation pipelines
- Sorting and filtering
- Compound indexing
#### Highlights
- Managed appointment and login session records
- Performed aggregation summaries using $group
- Implemented sorting and filtering queries
- Created compound indexes for performance improvement
- Applied update and delete operations on collections

## Projects
### [Project 1 SQL](/project1-sql.pdf)
A relational database system for managing car rental operations was developed using MySQL Workbench.
#### Features
- Vehicle management
- Customer management
- Booking system
- Payment tracking
#### SQL Concepts Implemented
- Joins
- Subqueries
- Set operations (`UNION`)
- Conditional logic (`CASE WHEN`)
- Aggregation and filtering
- Referential integrity constraints
#### Optimisation Techniques
- BTREE indexing
- FULLTEXT indexing
- Query execution analysis using `EXPLAIN`
#### Highlights
- Improved query performance through indexing
- Reduced full table scans using optimized indexes
- Implemented searchable booking locations using FULLTEXT indexing
GitHub Link for the Project: [Project Link](https://github.com/tanyiya/DP-Project/tree/main/Project%20I)

### [Project 2 NoSQL](/project2-nosql.pdf)
A NoSQL implementation of the car rental system was developed using MongoDB Compass.
#### Features
- Document-based database design
- Aggregation pipelines
- Collection relationships using $lookup
- Data filtering and sorting
#### MongoDB Concepts Implemented
- Aggregation framework
- Compound queries
- Sorting operations
- Indexing
- Multi-collection joins using $lookup
#### Highlights
- Identified most rented vehicle classes
- Analysed payment and deposit refund statuses
- Generated customer and booking analytics
- Improved query performance using indexing and aggregation pipelines
GitHub Link for the Project: [Project Link](https://github.com/tanyiya/DP-Project/tree/main/Project%20II)

## Reflection
Through this course, I gained practical experience in both relational and NoSQL database systems. Although the course mainly focused on backend database implementation without frontend development, it provided a strong foundation in database programming and data management concepts.