<?php

/**
  * Use an HTML form to create a new entry in the
  * users table.
  *
  */


if (isset($_POST['submit'])) {
  require "dbconfig.php";
  require "common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_user = array(
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
      "age"       => $_POST['age'],
      "location"  => $_POST['location']
    );

    $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"users",
implode(", ", array_keys($new_user)),
":" . implode(", :", array_keys($new_user))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  > <?php echo $_POST['firstname']; ?> successfully added.
<?php } ?>

<h2>Add a user</h2>

<form method="post">
  <label for="dept_name">dept_name</label>
  <input type="text" name="dept_name" id="dept_name">
  <label for="ID">ID</label>
  <input type="text" name="ID" id="ID">
  <label for="name">name</label>
  <input type="text" name="name" id="name">
  <label for="salary">salary</label>
  <input type="text" name="salary" id="salary">
  <input type="submit" name="submit" value="Submit">
</form>


<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

