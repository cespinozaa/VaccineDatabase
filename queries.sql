-- 3) Create indexes for columns in at least 3 tables. 

CREATE INDEX disease_index ON vaccine(disease);
CREATE INDEX state_index ON vaccinationSite(addrState);
CREATE INDEX state_index ON uninsured_patient(addrState);

-- Ask a question that involves the indexed columns and write a query that answers this question.
-- What are the most common diseases prevented through vaccines for
-- uninsured people who live in NC?

SELECT vaccine.disease, vaccinationSite.addrState, uninsured_patient.addrState,
	COUNT(takes.scientificName) AS Num
FROM vaccine, vaccinationSite, uninsured_patient, takes
WHERE uninsured_patient.addrState = 'NC' AND vaccinationSite.addrState = 'NC' 
	AND takes.patientId = uninsured_patient.patientId 
    	AND takes.scientificName = vaccine.scientificName
GROUP BY vaccine.disease
ORDER BY Num DESC;

-- 4) Formulate a problem for which a view can be a good solution. 
-- The problem should involve, at a minimum:(1) summary data (aggregation)
-- (2) 3 tables, and (3) results in sorted order. 

CREATE VIEW covid_copay_view AS
SELECT insured_patient.company, AVG(insured_patient.copay) AS average_copay, vaccine.disease
FROM takes, insured_patient, vaccine
WHERE takes.patientId = insured_patient.patientId AND vaccine.disease = "COVID-19"
GROUP BY insured_patient.copay, insured_patient.company
ORDER BY insured_patient.copay DESC;


--what is the average copay per company for the covid vaccine?

-- not using view
SELECT insured_patient.company, AVG(insured_patient.copay) AS average_copay, vaccine.disease 
FROM takes, insured_patient, vaccine 
WHERE takes.patientId = insured_patient.patientId AND vaccine.disease = 'COVID-19' 
GROUP BY insured_patient.copay, insured_patient.company
ORDER BY insured_patient.copay DESC;

-- using view
SELECT company, average_copay
FROM covid_copay_view;


-- 5) Create a view that shows the number of vaccinations each patient has. 
-- Name the view "vaccinationsByPatient. 

CREATE VIEW vaccinationsByPatient AS
SELECT patient.patientId AS patientID,
    CASE
        WHEN uninsured_patient.patientId IS NOT NULL THEN 'Uninsured'
        WHEN insured_patient.patientId IS NOT NULL THEN 'Insured'
    END AS type,
    CONCAT(patient.fName, ' ', patient.lName) AS Name,
    COUNT(takes.patientId) AS numVaccinations
FROM patient
INNER JOIN takes ON patient.patientId = takes.patientId
LEFT JOIN uninsured_patient ON patient.patientId = uninsured_patient.patientId
LEFT JOIN insured_patient ON patient.patientId = insured_patient.patientId
GROUP BY patient.patientId, patient.fName, patient.lName;

-- query using view
SELECT * 
FROM vaccinationsByPatient 
WHERE type = 'Insured';



