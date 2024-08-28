-- 2. [15] Insert into each table at least 4 meaningful records. 
-- At least two tables must have 10 meaningful records


INSERT INTO patient(id, f_name, m_initial, l_name, dob, weight)values
	('0123456789', 'Maria', 'P', 'Arredondo', '1975-12-20', 170),
    ('0112345678', 'Alvaro', '', 'Espinoza', '1966-04-10', 180),
    ('0122345678', 'Karime', '', 'Espinoza', '2000-03-02', 135),
    ('0123345678', 'Cynthia', '', 'Espinoza', '2002-06-20', 120),
    ('0123445678', 'Alvaro', 'JR', 'Espinoza', '1995-11-28', 170),
    ('9876543210', 'Darlene', 'N', 'Mosqueda', '2003-01-04', 115),
    ('9876543211', 'Mizael', 'A', 'Mosqueda', '2010-01-17', 115),
    ('9876543222', 'David', 'J', 'Mosqueda', '2000-10-20', 150),
    ('9876543333', 'Cecilia', 'M', 'Arredondo', '1978-02-15', 160),
    ('9876544444', 'Everado', 'D', 'Mosqueda', '1972-09-27', 162),
    ('8756378922', 'Abel', 'A', 'Munoz', '2008-11-02', 130),
    ('8745689777', 'Kevin', 'A', 'Munoz', '2010-11-18', 105);


INSERT INTO vaccine(scient_name, disease, no_doses) VALUES
	('Vibrio cholerae', 'Cholera', 1),
    ('Coronavirus', 'COVID', 2),
    ('Hepatovirus', 'Hepatitus A', 2),
    ('Hepadnavirus', 'Hepatitus B', 2),
    ('Human Papillomavirus', 'HPV', 2),
    ('Japanese Encephalitis virus', 'Encephalitis', 2),
    ('Poliomyelitis', 'Polio', 4),
    ('Varicella-zoster virus', 'Chickenpox', 2),
    ('Vaccinia virus', 'Smallpox', 2),
    ('Rabies Lyssavirus', 'Rabies', 3);


INSERT INTO allergy(patient_id, allergy) VALUES 
	('0122345678', 'Ibuprofen'),
    ('0112345679', 'Pollen'),
    ('0123456789', 'Penicillin'),
    ('9876543211', 'Shellfish');


INSERT INTO lot(scient_name, number, mfr_place, expiration) VALUES	
	('Coronavirus', 876956453, 'New York Vax', 02012026),
    ('Hepadnavirus', 675438975, 'California Tech', 05012025),
    ('Poliomyelitis', 349876146, 'German Medical', 04012027),
    ('Varicella-zoster virus', 923167549, 'New York Vax', 07012027);


INSERT INTO vaccination_site(name, addr_street, addr_city, addr_state, addr_zip) VALUES 
	('Guilford Medical', 'Freeman Mill Rd', 'Greensboro', 'NC', '27406'),
    ('Atrium Health', 'N Church St', 'Raleigh', 'NC', '27568'),
    ('Cone Health', 'Alamance Rd', 'Charlotte', 'NC', '27659'),
    ('UNC Health', 'Manning Dr', 'Chapel Hill', 'NC', '27514');


INSERT INTO billing(site_name, patient_id) VALUES
	('Atrium Health', '0123345678'),
    ('UNC Health', '9876543210'),
    ('Cone Health', '0123456789'),
    ('Guilford Medical', '0123445678');



INSERT INTO insured(patient_id, company, co_pay) VALUES
	('9876543333', 'United Health', '$20'),
    ('9876543211', 'Blue Cross', '$15'),
    ('9876543210', 'Student Blue', '$50'),
    ('0123345678', 'WellCare', '$0'),
    ('8745689777', 'WellCare', '$0'),
    ('8756378922', 'WellCare', '$0'),
    ('9876544444', 'United Health', '$40');


INSERT INTO uninsured(patient_id, pmt_method, addr_street, addr_city, addr_state, addr_zip) VALUES
	('0123456789', 'CARD', 'Kivett Dr', 'Greensboro', 'NC', '27406'),
    ('9876543222', 'CASH', 'Yanceyville Rd', 'High Point', 'NC', '27456'),
    ('0123445678', 'CARD', 'South Hill Rd', 'Boydton', 'VA', '84791'),
    ('0122345678', 'CARD', 'Wiley David Rd', 'Durham', 'NC', '27568');



INSERT INTO takes(patient_id, site_name, scient_name) VALUES
	('9876543210', 'UNC Health', 'Vaccinia virus'),
    ('0123456789', 'Cone Health', 'Poliomyelitis'),
    ('0123445678', 'Cone Health', 'Coronavirus'),
    ('0123345678', 'Atrium Health', 'Varicella-zoster virus'),
    ('0122345678', 'Cone Health', 'Poliomyelitis'),
    ('9876544444', 'Cone Health', 'Poliomyelitis'),
    ('9876543222', 'Cone Health', 'Poliomyelitis'),
    ('9876543211', 'Atrium Health', 'Varicella-zoster virus'),
    ('8745689777', 'UNC Health', 'Vaccinia virus'),
    ('8756378922', 'Atrium Health', 'Rabies Lyssavirus'),
    ('0122345678', 'Cone Health', 'Vaccinia virus'),
    ('0123345678', 'Atrium Health', 'Coronavirus'),
    ('0123456789', 'Cone Health', 'Coronavirus'),
    ('0123456789', 'Cone Health', 'Varicella-zoster virus');
 


-- 3) Write an update statement that will update a single record 

UPDATE allergy
	SET allergy = 'Aspirin'
    	WHERE patient_id = '0122345678'


-- Write an update statement that will update several records at once 
-- based on some criteria that you define.

UPDATE insured
	INNER JOIN patient ON insured.patient_id = patient.id
    	AND insured.company = 'WellCare'
    	SET insured.co_pay = '$2'



-- 4) Ask questions about the data in your database that are not obvious and can be answered through queries.

-- [single join] who has taken what vaccine ?

SELECT f_name AS First_Name, l_name AS Last_Name, scient_name AS vaccine
FROM patient JOIN takes ON patient.id = takes.patient_id;


-- [one with at least two join operations] what clinic bills what patient and what is their payment method ?

SELECT f_Name AS First_Name, l_name AS Last_Name, site_name AS Clinic, pmt_method AS Payment_Method
FROM(patient INNER JOIN uninsured ON patient.id = uninsured.patient_id) 
INNER JOIN billing ON (uninsured.patient_id = billing.patient_id);


-- [one with a subquery in it] what are the clinics and how many patients does each clinic have?

SELECT vaccination_site.name,
	(SELECT COUNT(takes.patient_id)
     FROM takes
     WHERE takes.site_name = vaccination_site.name
     ) AS Num_Patients
     FROM vaccination_site
     GROUP BY vaccination_site.name;


-- [one with at least one aggregate function, with group by and having clauses in it] 
-- how many vaccines has each person taken, given that they have taken at least 1 vaccine?

SELECT f_name, l_name, COUNT(takes.scient_name) AS Num_Vaccines
FROM patient, takes
WHERE patient.id = takes.patient_id
GROUP BY patient.id
HAVING Num_Vaccines > 0
ORDER BY Num_Vaccines DESC;


-- [one with a set operation (union , intersect or except) in it] 
-- what patients recieved a covid vaccine at cone health?

(SELECT f_name, l_name, site_name, scient_name
 FROM patient, takes
 WHERE patient.id = takes.patient_id)
INTERSECT
(SELECT f_name, l_name, site_name, scient_name
 FROM patient, takes
 WHERE scient_name = 'Coronavirus' AND site_name = 'Cone Health')







