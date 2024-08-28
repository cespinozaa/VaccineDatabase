<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
<h1>Vaccination System </h1>
<?php
//create mysql connection
require_once("connection.php");

$patient = array();
$i= 10;

if($_POST['patientId']){
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $patient[$i]["patientId"] = $_POST['patientId'];
    $patient[$i]["fName"] = $_POST['fName'];
    $patient[$i]["mInitial"] = $_POST['mInitial'];
    $patient[$i]["lName"] = $_POST['lName'];
    $patient[$i]["dob"] = $_POST['dob'];
    $patient[$i]["weight"] = $_POST['weight'];
    print_r($patient);
    
    $query_str = "INSERT INTO patient VALUES (:patientId,:fName, :mInitial, :lName, :dob, :weight)";
    $stmt = $connection->prepare($query_str);

    $stmt->bindParam(":patientId", $patientId, PDO::PARAM_STR);
    $stmt->bindParam(":fName", $fName, PDO::PARAM_STR);
    $stmt->bindParam(":mInitial", $mInitial, PDO::PARAM_STR);
    $stmt->bindParam(":lName", $lName, PDO::PARAM_STR);
    $stmt->bindParam(":dob", $dob, PDO::PARAM_INT);
    $stmt->bindParam(":weight", $weight, PDO::PARAM_INT);

    $stmt->execute(); 

    $i+=1;    

  echo 'patient was inserted successfully.<br><br><br>';
}
?>

<?php
?>

<span style="display: inline-block; width:50%">
  <form class="form-horizontal" action="appdev.php" method="post">
    <strong>Insert New Patient</strong><br>
    <div>
      Patient ID:
        <input class="form-control" type="string" name="patientId" oninvalid="this.setCustomValidity('Please enter a valid id number.')" pattern="^[0-9]+$" required>
        <br>
      First Name:
        <input class="form-control" type="string" name="fName" oninvalid="this.setCustomValidity('Please enter a valid first name.')" pattern="^[A-Z]{1}+$" required>
        <br>
      Middle Initial:
        <input class="form-control" type="string" name="mInitial" oninvalid="this.setCustomValidity('Please enter a valid initial.')" pattern="^[A-Z]{1}+$" required> 
        <br>
      Last Name:
        <input class="form-control" type="string" name="lName" oninvalid="this.setCustomValidity('Please enter a valid last name.')" required> 
        <br>
      DOB:
        <input class="form-control" type="number" name="dob" oninvalid="this.setCustomValidity('Please enter a valid dob.')" required> 
        <br>
      Weight:
        <input class="form-control" type="number" name="weight" oninvalid="this.setCustomValidity('Please enter a valid weight.')" required> 
        <br>
      <input class="form-control" type="submit">
   </div>
  </form>
</span>
</body>

<head>
    <meta charset="UTF-8">
    <style>
        table {
            margin: 0 auto;
            font-size: medium;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            font-size: x-large;
        }
 
        td {
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
        }
    </style>
</head>

<body>
    <br></br>
    <section>
        <h1>Patient</h1>
        <table>
        <?php
          $query_str = "SELECT * FROM patient";
          $stmt = $connection->query($query_str);

          echo '<table border = "0" cellspacing = "2" cellpadding ="2">
            <tr>
              <td>PatientId</td>
              <td>fName</td>
              <td>mInitial</td>
              <td>lName</td>
              <td>dob</td>
            <td>weight</td>
            </tr>';

          while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            $patientStmt = $connection->prepare("SELECT * FROM patient;");
            $patientStmt->execute(null); 

            //get all results into an array
            //only gets associative keys
            $patientResults = $patientStmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($patientResults as $row){
              echo '<tr>
                <td>'.$row['patientId'].'</td>
                <td>'.$row['fName'].'</td>
                <td>'.$row['mInitial'].'</td>
                <td>'.$row['lName'].'</td>
                <td>'.$row['dob'].'</td>
                <td>'.$row['weight'].'</td>
              </tr>';
            }
          }
        ?>
        </table>
    </section>
    <br></br>
    <section>
      <span style="display: inline-block; width:50%">
      <form class="form-horizontal" action="appdev.php" method="post">
        <strong>Insert New Vaccine</strong><br>
        <div>
          Scientific Name:
            <input class="form-control" type="string" name="scientificName" oninvalid="this.setCustomValidity('Please enter a valid name.')" pattern="^[0-9]+$" required>
            <br>
          Disease:
            <input class="form-control" type="string" name="disease" oninvalid="this.setCustomValidity('Please enter a valid disease.')" pattern="^[A-Z]{1}+$" required>
            <br>
          Number of Doses:
            <input class="form-control" type="string" name="noDoses" oninvalid="this.setCustomValidity('Please enter # of doses.')" pattern="^[A-Z]{1}+$" required> 
            <br>
          <input class="form-control" type="submit">
        </div>
      </form>
      </span>
    </section>
    <br></br>
    <section>
        <h1>Vaccine</h>
        <br></br>
        <table>
        <?php
          $query_str = "SELECT * FROM vaccine";
          $stmt = $connection->query($query_str);

          echo '<table border = "0" cellspacing = "2" cellpadding ="2">
            <tr>
              <td>scientificName</td>
              <td>disease</td>
              <td>noDoses</td>
            </tr>';

          while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            $vaccineStmt = $connection->prepare("SELECT * FROM vaccine;");
            $vaccineStmt->execute(null); 

            //get all results into an array
            //only gets associative keys
            $vaccineResults = $vaccineStmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($vaccineResults as $row){
                echo '<tr>
                <td>'.$row['scientificName'].'</td>
                <td>'.$row['disease'].'</td>
                <td>'.$row['noDoses'].'</td>
              </tr>';
            }
          }
        ?>
        </table>
    </section>

    <br></br>
    <section>
      <span style="display: inline-block; width:50%">
      <form class="form-horizontal" action="appdev.php" method="post">
        <strong>Insert New Vaccination Site</strong><br>
        <div>
          Site Name:
          <input class="form-control" type="string" name="siteName" oninvalid="this.setCustomValidity('Please enter a valid site name.')" pattern="^[0-9]+$" required>
          <br>
          Street:
          <input class="form-control" type="string" name="addrStreet" oninvalid="this.setCustomValidity('Please enter a valid street.')" pattern="^[A-Z]{1}+$" required>
          <br>
          City:
          <input class="form-control" type="string" name="addrCity" oninvalid="this.setCustomValidity('Please enter a valid city.')" pattern="^[A-Z]{1}+$" required> 
          <br>
          State:
          <input class="form-control" type="string" name="addrState" oninvalid="this.setCustomValidity('Please enter a valid state.')" required> 
          <br>
          ZIP:
          <input class="form-control" type="number" name="addrZip" oninvalid="this.setCustomValidity('Please enter a valid zip code.')" required> 
          <br>
        <input class="form-control" type="submit">
        </div>
      </form>
      </span>
    </section>
        <br></br>
    <section>
        <h1>Vaccination Site</h>
        <br></br>
        <table>
        <?php
          $query_str = "SELECT * FROM vaccinationSite";
          $stmt = $connection->query($query_str);

          echo '<table border = "0" cellspacing = "2" cellpadding ="2">
            <tr>
              <td>siteName</td>
              <td>addrStreet</td>
              <td>addrCity</td>
              <td>addrState</td>
              <td>addrZip</td>
            </tr>';

          while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            $vacSiteStmt = $connection->prepare("SELECT * FROM vaccinationSite;");
            $vacSiteStmt->execute(null); 

            //get all results into an array
            //only gets associative keys
            $vacSiteResults = $vacSiteStmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($vacSiteResults as $row){
                echo '<tr>
                <td>'.$row['siteName'].'</td>
                <td>'.$row['addrStreet'].'</td>
                <td>'.$row['addrCity'].'</td>
                <td>'.$row['addrState'].'</td>
                <td>'.$row['addrZip'].'</td>
              </tr>';
            }
          }
        ?>
        </table>
    </section>

    <br></br>
    <section>
      <span style="display: inline-block; width:50%">
      <form class="form-horizontal" action="appdev.php" method="post">
        <strong>Insert New Takes</strong><br>
        <div>
        Patient ID:
        <input class="form-control" type="string" name="patientId" oninvalid="this.setCustomValidity('Please enter a valid id number.')" pattern="^[0-9]+$" required>
        <br>
        Site Name:
        <input class="form-control" type="string" name="siteName" oninvalid="this.setCustomValidity('Please enter a valid site name.')" pattern="^[A-Z]{1}+$" required>
        <br>
        Scientific Name:
        <input class="form-control" type="string" name="scientificName" oninvalid="this.setCustomValidity('Please enter a valid scientific name.')" pattern="^[A-Z]{1}+$" required> 
        <br>
        dateTaken:
        <input class="form-control" type="string" name="dateTaken" oninvalid="this.setCustomValidity('Please enter a valid date.')" required> 
        <br>
      <input class="form-control" type="submit">
        </div>
      </form>
      </span>
    </section>
    <br></br>
    <section>
        <h1>Takes</h>
        <br></br>
        <table>
        <?php
          $query_str = "SELECT * FROM takes";
          $stmt = $connection->query($query_str);

          echo '<table border = "0" cellspacing = "2" cellpadding ="2">
            <tr>
              <td>patientId</td>
              <td>siteName</td>
              <td>scientificName</td>
              <td>dateTaken</td>
            </tr>';

          while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            $takesStmt = $connection->prepare("SELECT * FROM takes;");
            $takesStmt->execute(null); 

            //get all results into an array
            //only gets associative keys
            $takesResults = $takesStmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($takesResults as $row){
                echo '<tr>
                <td>'.$row['patientId'].'</td>
                <td>'.$row['siteName'].'</td>
                <td>'.$row['scientificName'].'</td>
                <td>'.$row['dateTaken'].'</td>
              </tr>';
            }
          }
        ?>
        </table>
    </section>
</body>

</html>