<?php
require_once("connection.php");

//list all instructor datta for comp sci instructors
//$sql = "SELECT * FROM instructor WHERE dept_name=:dept_name;";

//$statement = $connection->prepare($sql);

//$dept = "Comp. Sci.";

//$statement->bindParam(':dept_name',$dept,PDO::PARAM_STR);

//$statement->execute();

//$cs_instructors = $statement->fetchAll(PDO::FETCH_ASSOC);

//print('testing')

if ( isset($_POST['patientId']) && isset($_POST['fName']) && isset($_POST['mInitial'])
&& isset($_POST['lName']) && isset($_POST['dob']) && isset($_POST['weight'])) {
$sql = "INSERT INTO patient (fName, mInitial, lName, dob, weight)
VALUES (:fName, :mInitial, :lName, :dob, :weight)";
echo("<pre>\n".$sql."\n</pre>\n");
$stmt = $pdo->prepare($sql);
$stmt->execute(array(
':fName' => $_POST['fName'],
':mInitial' => $_POST['mInital'],
':lName' => $_POST['lName'],
':dob' => $_POST['dob'],
':weight' => $_POST['weight']));
}
?><html><head></head><body>
<p>Add A New User</p>
<form method="post">
<p>Name:<input type="text" name="name" size="40"></p>
<p>Email:<input type="text" name="email"></p>
<p>Password:<input type="password" name="password"></p>
<p><input type="submit" value="Add New"/></p>
</form>
</body> user1.php


<PRE>
<?php

//print_r($cs_instructors);

//foreach($cs_instructors as $instructor){
//    echo "Name: ".$instructor['name']. "<br>";

//}

?>
</PRE>



<?php include "templates/header.php"; ?>

<ul>
  <li>
    <a href="create.php"><strong>Create</strong></a> - add a user
  </li>
  <li>
    <a href="read.php"><strong>Read</strong></a> - find a user
  </li>
</ul>




<?php include "templates/footer.php"; ?>