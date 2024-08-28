<PRE>
<?php
try {
  require_once("dbconfig.php"); //database access details

  //Populate these four variables
  $host = "localhost"; //Domain name of database server
  $dbname = "c_espinozaa_project"; //name of your database
  $username = "c_espinozaa"; //SQL user
  $options = null;

  configure($host, $username, $password, $options, $dbname, $dsn);

  $connection = new PDO($dsn, $username, $password, $options); //create database connection and get handler

//  $sql = "SELECT * FROM patient;";
  //  $dept = "Comp. Sci.";
//  $statement = $connection->prepare($sql);

//  $statement->bindParam(':patient', $patient, PDO::PARAM_STR);

//  $statement->execute();

//  $patient = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
  //if connection failed, print error and exit;
  echo "Database connection error: " . $error->getMessage() . "<BR>";
  die;
}
?>
</PRE>