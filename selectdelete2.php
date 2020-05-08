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
    FROM country
    WHERE countrycode= :countrycode";

    $CountryCode = $_POST['countrycode'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':countrycode', $CountryCode, PDO::PARAM_STR);
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
    div.wrapper {
  width: 2000px;
  height: 100px;
  overflow: auto;
}
</style>

<div id = "overlay">
<?php require "template/header.php"; ?>

<?php
$display= True;
if (isset($_POST['submit'])) {
	$display= False;
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>
    <div class="wrapper">
    <table>
      <thead>
<tr>
<th>Country Code</th>
  <th>Country Name</th>
  <th>Continent</th>
  <th>Region</th>
  <th>Surfacearea</th>
  <th>Year of Independent</th>
  <th>Population</th>
  <th>Life Expectancy</th>
  <th>GNP</th>
  <th>GNPOLD</th>
  <th>Local Name</th>
  <th>Form of Government</th>
  <th>Head of State</th>
  <th>Capital</th>
  <th>Internet Code</th>
  <th>Delete</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
      <td><?php echo escape($row["countrycode"]); ?></td>
      <td><?php echo escape($row["countryname"]); ?></td>
      <td><?php echo escape($row["continent"]); ?></td>
      <td><?php echo escape($row["region"]); ?></td>
      <td><?php echo escape($row["surfacearea"]); ?></td>
      <td><?php echo escape($row["independentyear"]); ?></td>
      <td><?php echo escape($row["population"]); ?></td>
      <td><?php echo escape($row["lifeexpectancy"]); ?></td>
      <td><?php echo escape($row["gnp"]); ?></td>
      <td><?php echo escape($row["gnpold"]); ?></td>
      <td><?php echo escape($row["localname"]); ?></td>
      <td><?php echo escape($row["formofgovernment"]); ?></td>
      <td><?php echo escape($row["headofstate"]); ?></td>
      <td><?php echo escape($row["capital"]); ?></td>
      <td><?php echo escape($row["internetcode"]); ?></td>
      <td><a class="w3-button w3-red" href="delete2.php?countrycode=<?php echo escape($row["countrycode"]);?>">delete</a></td>
      </tr>

    <?php } ?>
      </tbody>
  </table>
  </div>
  <?php } else { ?>
  <br>
    &#9658; No results found.
	<br>
  <?php }
  
} 
if ($display){
?>

<h2>Delete Country Based On Country Code</h2>

<form method="post" name="post">
  <label for="countrycode">Country Code</label>
  <input type="text" id="countrycode" name="countrycode">
  <p><button class="w3-button w3-blue" type="submit" name="submit" value="View Result">View Result</button></p>
</form>
<?php
}?>
<br>
<div id="content">
<p><button class="w3-button w3-yellow" onclick="document.location = 'index.php'">Back to home</button>&nbsp;
<button class="w3-button w3-yellow" onclick="document.location = 'selectdelete.php'">Delete City</button></p>
<?php require "template/footer.php"; ?>
</div>
</div>