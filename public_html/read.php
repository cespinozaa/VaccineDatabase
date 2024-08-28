<?php

/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */

if (isset($_POST['submit'])) {
  try {
    require "dbconfig.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM instructor
    WHERE dept_name = :dept_name";

    $location = $_POST['dept_name'];

    $statement = $connection->prepare($sql);
    $dept = "Comp. Sci.";
    $statement->bindParam(':dept_name', $dept, PDO::PARAM_STR);
    $statement->execute();
    $cs_instructors = $statement->fetchAll(PDO::FETCH_ASSOC);

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
<tr>
  <th>#</th>
  <th>dept_name</th>
  <th>ID</th>
  <th>name</th>
  <th>salary</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["dept_name"]); ?></td>
<td><?php echo escape($row["ID"]); ?></td>
<td><?php echo escape($row["name"]); ?></td>
<td><?php echo escape($row["salary"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['location']); ?>.
  <?php }
} ?>

<h2>Find user based on location</h2>

<form method="post">
  <label for="dept_name">dept_name</label>
  <input type="text" id="dept_name" name="dept_name">
  <input type="submit" name="submit" value="View Results">
</form>

<?php

    //print_r($cs_instructors)
    foreach($cs_instructors as $instructor){
      echo "Instructor<br>";
      foreach($instructor as $key => $value){
        echo $key.": ".$value;
        echo "<br>";
      }
      echo "<br>";
    } 
    ?>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>