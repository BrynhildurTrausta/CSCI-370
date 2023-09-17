-- MySQL setup file
-- Password: qx3yOXrCHxkL

DROP DATABASE IF EXISTS rateyourprofessor;
CREATE DATABASE rateyourprofessor;
USE rateyourprofessor;

CREATE TABLE student (
	sId INTEGER PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(100) UNIQUE,
	password VARCHAR(100)
);

CREATE TABLE department (
	department VARCHAR(100) PRIMARY KEY UNIQUE,
	nofRating INTEGER,
	avgD INTEGER
);

CREATE TABLE professor (
	pId INTEGER PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(100),
	department VARCHAR(100),
	avgP INTEGER
);

CREATE TABLE prof_dep (
	department VARCHAR(100),
	profId INTEGER,
	UNIQUE(department, profId),
	FOREIGN KEY (department) REFERENCES department(department)
		ON DELETE CASCADE,
	FOREIGN KEY (profId) REFERENCES professor(pID)
		ON DELETE CASCADE
		ON UPDATE SET NULL
);

CREATE TABLE rating (
	rId INTEGER PRIMARY KEY AUTO_INCREMENT,
	profId INTEGER,
	studId INTEGER,
	rDepartment VARCHAR(100),
	rate INTEGER,
	comment VARCHAR(200),
	FOREIGN KEY (profId) REFERENCES professor(pId)
		ON DELETE CASCADE,
	FOREIGN KEY (rDepartment) REFERENCES department(department)
		ON DELETE CASCADE,
	FOREIGN KEY (studId) REFERENCES student(sId),
	UNIQUE (profId, studId)		
);


-- Other table definitions here

-- Starter data
INSERT INTO student (email, password) VALUES
	("user1@uindy.edu", "password"),
	("user2@uindy.edu", "password"),
	("user3@uindy.edu", "password"),
	("user4@uindy.edu", "password"),
	("user5@uindy.edu", "password");

INSERT INTO department (department) VALUES
	("Mathematics"),
	("Biology"),
	("Communication"),
	("History"),
	("Business"),
	("Computer Science");

INSERT INTO professor (name, department) VALUES
	("Paul Joans", "Mathematics"),
	("Carter Mahome", "Mathematics"),
	("Rebekkah Laundry", "Biology"),
	("Sydney Miller", "Communication"),
	("Patric Jonsson", "Computer Science"),
	("Emily Carter", "History"),
	("Savannah Mueller", "Computer Science"),
	("Ringen Candice", "Business");

INSERT INTO rating (profId, studId, rate, comment) VALUES
	(1, 1, 1, "Bad teacher!"),
	(1, 2, 4, "Great teacher!"),
	(4, 1, 2, "Could be better at speaking louder"),
	(8, 1, 1, "Business is just boring"),
	(3, 1, 4, "Loved the teaching methods"),
	(6, 1, 4, "She's good"),
	(2, 1, 0, "Very unorganized"),
	(2, 2, 0, "Shoudl not be a teacher"),
	(1, 3, 3, "Needs to fix his hair"),
	(4, 2, 3, "Was not good at communicating with us"),
	(5, 1, 5, "Amazing, funny and great teachnig methods"),
	(5, 2, 5, "The classes are so much fun!!"),
	(3, 2, 5, "Should get an award for being her"),
	(3, 3, 2, "Biology sucks"),
	(7, 1, 4, "An amazing class, could give us more sites with tips and stuff."),
	(7, 2, 3, "Such a hard class but she did okay"),
	(6, 2, 1, "Needs to work on teaching"),
	(8, 2, 0, "Should find a new job"),
	(8, 3, 2, "She was meh ok"),
	(4, 3, 3, "Tests were about stuff we hadn't covered in class"),
	(5, 3, 4, "Good, could give us less hw. Some of it was pointless!"),
	(6, 3, 4, "She's really good, could be more on time often");

UPDATE professor 
SET avgP = (SELECT AVG(rate) FROM rating WHERE profId = 1)
WHERE pId = 1;

UPDATE professor 
SET avgP = (SELECT AVG(rate) FROM rating WHERE profId = 2)
WHERE pId = 2;

UPDATE professor 
SET avgP = (SELECT AVG(rate) FROM rating WHERE profId = 3)
WHERE pId = 3;

UPDATE professor 
SET avgP = (SELECT AVG(rate) FROM rating WHERE profId = 4)
WHERE pId = 4;

UPDATE professor 
SET avgP = (SELECT AVG(rate) FROM rating WHERE profId = 5)
WHERE pId = 5;

UPDATE professor 
SET avgP = (SELECT AVG(rate) FROM rating WHERE profId = 6)
WHERE pId = 6;

UPDATE professor 
SET avgP = (SELECT AVG(rate) FROM rating WHERE profId = 7)
WHERE pId = 7;

UPDATE professor 
SET avgP = (SELECT AVG(rate) FROM rating WHERE profId = 8)
WHERE pId = 8;

UPDATE department d
SET nofRating = (SELECT COUNT(rate) FROM rating WHERE profId = 1 OR profId = 2)
WHERE d.department = 'Mathematics';

UPDATE department d
SET avgD = (SELECT AVG(rate) FROM rating WHERE profId = 1 OR profId = 2)
WHERE d.department = 'Mathematics';

UPDATE department d
SET nofRating = (SELECT COUNT(rate) FROM rating WHERE profId = 3)
WHERE d.department = 'Biology';

UPDATE department d
SET avgD = (SELECT AVG(rate) FROM rating WHERE profId = 3)
WHERE d.department = 'Biology';

UPDATE department d
SET nofRating = (SELECT COUNT(rate) FROM rating WHERE profId = 4)
WHERE d.department = 'Communication';

UPDATE department d
SET avgD = (SELECT AVG(rate) FROM rating WHERE profId = 4)
WHERE d.department = 'Communication';

UPDATE department d
SET nofRating = (SELECT COUNT(rate) FROM rating WHERE profId = 5 OR profId = 7)
WHERE d.department = 'Computer Science';

UPDATE department d
SET avgD = (SELECT AVG(rate) FROM rating WHERE profId = 5 OR profId = 7)
WHERE d.department = 'Computer Science';

UPDATE department d
SET avgD = (SELECT AVG(rate) FROM rating WHERE profId = 6)
WHERE d.department = 'History';

UPDATE department d
SET nofRating = (SELECT COUNT(rate) FROM rating WHERE profId = 6)
WHERE d.department = 'History';

UPDATE department d
SET nofRating = (SELECT COUNT(rate) FROM rating WHERE profId = 8)
WHERE d.department = 'Business';

UPDATE department d
SET avgD = (SELECT AVG(rate) FROM rating WHERE profId = 8)
WHERE d.department = 'Business';

UPDATE rating 
SET rDepartment = 'Mathematics'
WHERE profId = 1 OR profId = 2;

UPDATE rating 
SET rDepartment = 'Biology'
WHERE profId = 3;

UPDATE rating 
SET rDepartment = 'Communication'
WHERE profId = 4;

UPDATE rating 
SET rDepartment = 'Computer Science'
WHERE profId = 5 OR profId = 7;

UPDATE rating 
SET rDepartment = 'History'
WHERE profId = 6;

UPDATE rating 
SET rDepartment = 'Business'
WHERE profId = 8;
