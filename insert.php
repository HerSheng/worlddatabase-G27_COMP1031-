<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php

/**
  * Use an HTML form to create a new entry in the
  * users table.
  *
  */


if (isset($_POST['submit'])) {
  require "config.php";
  require "common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_user = array(
      "CityID" => $_POST['CityID'],
      "CityName"  => $_POST['CityName'],
      "CountryCode"     => $_POST['CountryCode'],
      "District"       => $_POST['District'],
      "Population"  => $_POST['Population']
    );

    $sql = sprintf(
"INSERT INTO city SET CityID=:CityID, CityName=:CityName, CountryCode=:CountryCode, District=:District, Population=:Population",
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
      max-width: 750px;
      margin: auto;
    }
    .w3-button {
      width:150px;
      border-radius: 4px;
    }
    </style>


<div id = "overlay">
<?php require "template/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  > <?php echo $_POST['CityName']; ?> successfully added.
<?php } ?>

<div id="content">
<h2>Add A City</h2>

    <form method="post">
		  <label for="CityID">City ID</label> 
		  <input type='text' name='CityID' id='CityID'/>
    	<label for="CityName">City Name</label>
    	<input type="text" name="CityName" id="CityName"/>
    	<label for="CountryCode">Country Code</label>
    	<input type="text" name="CountryCode" id="CountryCode"/>
    	<label for="District">District</label>
    	<input type="text" name="District" id="District"/>
    	<label for="Population">Population</label>
    	<input type="text" name="Population" id="Population"/>
    	<p><button class="w3-button w3-light-green" type="submit" name="submit" value="Submit">Submit</button></p>
    </form>

    <p><button class="w3-button w3-yellow" onclick="document.location = 'index.php'">Back to home</button> &nbsp;
    <button class="w3-button w3-yellow" onclick="document.location = 'insert2.php'">Insert Country</button></p>
<?php require "template/footer.php"; ?>
</div>
</div>