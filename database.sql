-- 1. [25] Create the tables. Write SQL statements for the CREATE TABLE commands. 
-- Execute the statements in the SQL tab of phpMyAdmin in the class server. 
-- Make sure that you enforce key and referential integrity constraints and any 
-- other constraints you have (e.g. unique, not null, check etc.). Submit the 
-- CREATE TABLE commands. You cannot export the tables from phpMyAdmin, 
-- but rather submit the statements that you will write by yourself.


CREATE TABLE patient(
    id VARCHAR(10) PRIMARY KEY,
    f_name VARCHAR(50) NOT NULL,
    m_initial VARCHAR(50),
    l_name VARCHAR(50) NOT NULL,
    dob DATE NOT NULL,
    weight INT(3) NOT NULL
    );


CREATE TABLE vaccine(
    scient_name VARCHAR(50) PRIMARY KEY,
    disease VARCHAR(50) NOT NULL,
    no_doses INT (10) NOT NULL
    );


CREATE TABLE takes(
    patient_id VARCHAR(10),
    site_name VARCHAR(50) NOT NULL,
    scient_name VARCHAR(50) NOT NULL,
    PRIMARY KEY(patient_id, site_name, scient_name),
    FOREIGN KEY(patient_id) REFERENCES patient(id),
    FOREIGN KEY(scient_name) REFERENCES vaccine(scient_name),
    FOREIGN KEY(site_name) REFERENCES vaccination_site(name)
    );

CREATE TABLE lot(
    scient_name VARCHAR(50) NOT NULL,
    number INT(50) NOT NULL,
    mfr_place VARCHAR(50) NOT NULL,
    expiration INT(8) NOT NULL,
    PRIMARY KEY(scient_name, number),
    FOREIGN KEY(scient_name) REFERENCES vaccine(scient_name)
    );

CREATE TABLE allergy(
    patient_id VARCHAR(10) NOT NULL,
    allergy VARCHAR(100),
    PRIMARY KEY(patient_id, allergy),
    FOREIGN KEY(patient_id) REFERENCES patient(id)
    );


CREATE TABLE insured(
    patient_id VARCHAR(10) PRIMARY KEY,
    company VARCHAR(50) NOT NULL,
    co_pay VARCHAR(5) NOT NULL
    );


CREATE TABLE uninsured (
    patient_id VARCHAR(10) PRIMARY KEY,
    pmt_method VARCHAR(10) NOT NULL,
    addr_street VARCHAR(50) NOT NULL,
    addr_city VARCHAR(50) NOT NULL,
    addr_state VARCHAR(50) NOT NULL,
    addr_zip VARCHAR(5) NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patient(id)
    );


CREATE TABLE vaccination_site (
    name VARCHAR(50) PRIMARY KEY,
    addr_street VARCHAR(50) NOT NULL,
    addr_city VARCHAR(50) NOT NULL,
    addr_state VARCHAR(50) NOT NULL,
    addr_zip VARCHAR(5) NOT NULL
    );


CREATE TABLE billing (
    site_name VARCHAR(50) NOT NULL,
    patient_id VARCHAR(10) NOT NULL,
    PRIMARY KEY(site_name, patient_id),
    FOREIGN KEY(site_name) REFERENCES vaccination_site(name),
    FOREIGN KEY(patient_id) REFERENCES patient(id)
    );



CREATE TABLE billingtest (
    site_name VARCHAR(50) NOT NULL,
    patient_id VARCHAR(10) NOT NULL,
    PRIMARY KEY(site_name, patient_id),
    FOREIGN KEY(site_name) REFERENCES vaccination_site(name),
    FOREIGN KEY(patient_id) REFERENCES patient(id),
    CHECK(patient_id IN uninsured(patient_id))
    );





