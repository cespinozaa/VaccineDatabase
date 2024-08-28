# VaccineDatabase

This project designs a vaccine database using SQL and PHP. It consists of multiple parts, starting from the creation of an ER Diagram and ending at a performance analysis. UNCG's phpmyadmin was used to manage the database (https://csc471.uncg.edu/phpMyAdmin/) as this project was created for the course CSC471: Principles of Database Systems.

## Features
This database keeps a log of patients, their allergies, and whether or not they are insured. It also keeps a log of vaccines, vaccines' lot numbers, vaccination sites, and bills for patients. 

SQL commands were used to create and insert some data, as well as to answer certain questions about the data gathered. The fakerphp library was also used to generate fake data.

## Process
### Part I 
This step involved creating an ER diagram of the database:

<br>
<img src="https://github.com/user-attachments/assets/a01d9410-a3f0-4b85-addb-1494ad064b49" width="600" height="500">
<br>

<br>

### Part II
This step involved creating a relational design:
<br>

<img src="https://github.com/user-attachments/assets/c5adb608-5deb-4f20-a5d4-f99bbfb85114" width="720" height="600">
<br>

<br>

### Part III
This step involved adding the SQL design. In this step, the SQL commands insert, create, update, join, inner join, and intersect were used. This step focused on creating tables for the database, inserting dummy data into those tables, updating data records, and answering questions about the data (such as 'What patients received a covid vaccine at Cone Health?'). 
Images from the database on phpmyadmin follow:

<br>
<img src="https://github.com/user-attachments/assets/f1524949-01ec-479c-b156-c4871c6e97ee" width="600" height="500">
<br>

<br>
<img src="https://github.com/user-attachments/assets/c6b29a2e-4317-4075-93ae-92e07b8c276d" width="600" height="300">
<br>

<br>
<img src="https://github.com/user-attachments/assets/c6a81927-63a5-4232-a6fb-047e24d2708a" width="600" height="500">
<br>

<br>
<img src="https://github.com/user-attachments/assets/26887b05-d0dd-4d21-9133-1e2ae866373b" width="600" height="300">
<br>

<br>
<img src="https://github.com/user-attachments/assets/345b1201-a385-4469-bb44-7c65fb72e828" width="500" height="600">
<br>

<br>
<img src="https://github.com/user-attachments/assets/02fc99ca-02f8-4057-9d51-fc22911aca60" width="500" height="300">
<br>

<br>
<img src="https://github.com/user-attachments/assets/466c311d-8968-4eea-abb4-14ef0c072d84" width="400" height="400">
<br>

<br>
<img src="https://github.com/user-attachments/assets/73f8061c-5eb7-4cab-9fb4-af15cbf475ad" width="300" height="300">
<br>

<br>
<img src="https://github.com/user-attachments/assets/e48a38db-33ed-4ef1-a2ea-365d4ef0f1b8" width="300" height="300">
<br>

Other SQL commands which answer questions about the database can be found in the sql files.

### Part IV
This step focused on performance analysis. 
The code in the dataload.php file first connects to the connection.php file which establishes the connection to the database. Then it gets the contents of the dump.json file previously created in datagen.php and assigns the contents to an array called $allData. This associative array stores the arrays created based on the necessary tables. Then, the code queries the database to delete any existing information from the database tables. The tables are then read and the new information, which was previously created in datagen.php using the php faker library, is inserted using bindParam statements.
