<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<?php

/**
  * Delete a user
  */

require "config.php";
require "common.php";

if (isset($_GET["countrycode"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $countrycode = $_GET["countrycode"];

    $sql = "DELETE FROM country WHERE countrycode = :countrycode";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':countrycode', $countrycode);
	if($statement->execute()){
        // redirect to read records page and 
        // tell the user record was deleted
        header('Location: delete2.php?action=deleted');
    }else{
        die('Unable to delete record.');
    }
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM country";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<style>
    body{
      background-image: url('https://cdn.hipwallpaper.com/i/46/98/ixUKTZ.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
    #overlay{
      position : fixed;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgb(0, 0, 0);
      background: rgba(0, 0, 0, 0.5);
      color: #f1f1f1;
      overflow: auto;
      text-align: center;
    }
    .w3-button {
      width:150px;
      border-radius: 4px;
    }
</style>

<div id = "overlay">
<div id="content">
<?php require "template/header.php"; ?>

<?php
	$action = isset($_GET['action']) ? $_GET['action'] : "";
if($action=='deleted'){
    echo "<div class='alert alert-success'>&#9658; Record was deleted.</div>";
}
?>


<<p><button class="w3-button w3-yellow" onclick="document.location = 'selectdelete2.php'">Back to Delete</button> &nbsp;
<button class="w3-button w3-yellow" onclick="document.location = 'index.php'">Back to home</button></p>

<?php require "template/footer.php"; ?>
</div>
</div>