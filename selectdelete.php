<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<?php

/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */

if (isset($_POST['submit'])) {
  try {
    require "config.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

 

    $sql = "SELECT *
    FROM city
    WHERE CountryCode= :CountryCode";

    $CountryCode = $_POST['CountryCode'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':CountryCode', $CountryCode, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>

<style>
    body{
      background-image: url('https://cdn.hipwallpaper.com/i/46/98/ixUKTZ.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      color: #f1f1f1;
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
    #content{
      max-width: 500px;
      margin: auto;
    }
    .w3-button {
      width:150px;
      border-radius: 4px;
    }
</style>

<div id = "overlay">
<?php require "template/header.php"; ?>

<?php
$display= True;
if (isset($_POST['submit'])) {
	$display= False;
  if ($result && $statement->rowCount() > 0) { ?>
  <div id="content">
    <h2>Results</h2>

    <table>
      <thead>
<tr>
  <th>City ID</th>
  <th>City Name</th>
  <th>Country Code</th>
  <th>District</th>
  <th>Population</th>
  <th>Delete</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["CityID"]); ?></td>
<td><?php echo escape($row["CityName"]); ?></td>
<td><?php echo escape($row["CountryCode"]); ?></td>
<td><?php echo escape($row["District"]); ?></td>
<td><?php echo escape($row["Population"]); ?></td>
<td><a  class="w3-button w3-red" href="delete.php?CityID=<?php echo escape($row["CityID"]);?>">Delete</a></td>
      </tr>

    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
  <br>
    &#9658; No results found.
	<br>
  <?php }
  
} 
if ($display){
?>

<h2>Delete City Based On Country Code</h2>

<form method="post" name="post">
  <label for="CountryCode">Country Code</label>
  <input type="text" id="CountryCode" name="CountryCode">
  <p><button class="w3-button w3-blue" type="submit" name="submit" value="View Result">View Result</button></p>
</form>
<?php
}?>
<br>
<p><button class="w3-button w3-yellow" onclick="document.location = 'index.php'">Back to home</button>&nbsp;
<button class="w3-button w3-yellow" onclick="document.location = 'selectdelete2.php'">Delete Country</button></p>
<?php require "template/footer.php"; ?>
</div>
</div>