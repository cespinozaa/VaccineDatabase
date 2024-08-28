<?php
require_once("connection.php");

print("\n");

try {
    require("connection.php");
    $allData = json_decode(file_get_contents("redump.json"));

    echo "inserting tables...\n";
    //read & insert patient data
    foreach ($allData->patient as $row) {
        $query_str = "INSERT INTO patient VALUES (:patientId,:fName,:mInitial,:lName,:dob,:weight)";
        $stmt = $connection->prepare($query_str);

        $stmt->bindParam(":patientId", $row->patientId, PDO::PARAM_STR);
        $stmt->bindParam(":fName", $row->fName, PDO::PARAM_STR);
        $stmt->bindParam(":mInitial", $row->mInitial, PDO::PARAM_STR);
        $stmt->bindParam(":lName", $row->lName, PDO::PARAM_STR);
        $stmt->bindParam(":dob", $row->dob, PDO::PARAM_INT);
        $stmt->bindParam(":weight", $row->weight, PDO::PARAM_INT);
        
        $stmt->execute();
    }     

    //read & insert vaccine
    foreach($allData->vaccine as $row){
        $query_str = "INSERT INTO vaccine VALUES (:scientificName,:disease, :noDoses)";
        $stmt = $connection->prepare($query_str);
    
        $stmt->bindParam(":scientificName", $row->scientificName, PDO::PARAM_STR);
        $stmt->bindParam(":disease", $row->disease, PDO::PARAM_STR);
        $stmt->bindParam(":noDoses", $row->noDoses, PDO::PARAM_INT);
      
        $stmt->execute();
    } 

    //read & insert vaccination sites
    foreach($allData->vaccinationSite as $row){
        $query_str = "INSERT INTO vaccinationSite VALUES (:siteName,:addrStreet, :addrCity, :addrState, :addrZip)";
        $stmt = $connection->prepare($query_str);
        
        $stmt->bindParam(":siteName", $row->siteName, PDO::PARAM_STR);
        $stmt->bindParam(":addrStreet", $row->addrStreet, PDO::PARAM_STR);
        $stmt->bindParam(":addrCity", $row->addrCity, PDO::PARAM_STR);
        $stmt->bindParam(":addrState", $row->addrState, PDO::PARAM_STR);
        $stmt->bindParam(":addrZip", $row->addrZip, PDO::PARAM_STR);
          
        $stmt->execute();
    } 

    //read & insert takes
    foreach($allData->takes as $row){
        $query_str = "INSERT INTO takes VALUES (:patientId,:siteName, :scientificName, :dateTaken)";
        $stmt = $connection->prepare($query_str);
            
        $stmt->bindParam(":patientId", $row->patientId, PDO::PARAM_STR);
        $stmt->bindParam(":siteName", $row->siteName, PDO::PARAM_STR);
        $stmt->bindParam(":scientificName", $row->scientificName, PDO::PARAM_STR);
        $stmt->bindParam(":dateTaken", $row->dateTaken, PDO::PARAM_STR);
              
        $stmt->execute();
    } 

    print("Done inserting all tables.\n");
} catch (PDOException $error) {
    //if database failed, print error and exit;
    echo "Database error: " . $error->getMessage() . "
";
    die;
}
?>