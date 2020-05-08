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
      "countrycode" => $_POST['countrycode'],
      "countryname"  => $_POST['countryname'],
      "continent"     => $_POST['continent'],
      "region"       => $_POST['region'],
      "surfacearea"  => $_POST['surfacearea'],
      "independentyear"     => $_POST['indepedentyear'],
      "population"     => $_POST['population'],
      "lifeexpectancy"     => $_POST['lifeexpectancy'],
      "gnp"     => $_POST['gnp'],
      "gnpold"     => $_POST['gnpold'],
      "localname"     => $_POST['localname'],
      "formofgovernment"     => $_POST['formofgovernment'],
      "headofstate"     => $_POST['headofstate'],
      "capital"     => $_POST['capital'],
      "internetcode"     => $_POST['internetcode']
    );

    $sql = sprintf(
"INSERT INTO country SET countrycode=:countrycode, countryname=:countryname, continent=:continent, region=:region, surfacearea=:surfacearea, independentyear=:independentyear, population=:population, lifeexpectancy=:lifeexpectancy, gnp=:gnp, gnpold=:gnpold, localname=:localname, formofgovernment=:formofgovernment, headofstate=:headofstate, capital=:capital, internetcode=:internetcode",
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
  > <?php echo $_POST['countrycode']; ?> successfully added.
<?php } ?>

<div id="content">
<h2>Add A Ccountry</h2>

    <form method="post">
		  <label for="countrycode">Country Code</label> 
		  <input type='text' name='countrycode' id='countrycode'/>
          <label for="countryname">Country Name</label> 
		  <input type='text' name='countryname' id='countryname'/>
          <label for="continent">Continent</label> 
		  <input type='text' name='continent' id='continent'/>
          <label for="region">Region</label> 
		  <input type='text' name='region' id='region'/>
          <label for="surfacearea">Surface Area</label> 
		  <input type='text' name='surfacearea' id='surfacearea'/>
          <label for="independentyear">Year of Independence</label> 
		  <input type='text' name='indepedentyear' id='independentyear'/>
          <label for="population">Population</label> 
		  <input type='text' name='population' id='population'/>
          <label for="lifeexpectancy">Life Expectancy</label> 
		  <input type='text' name='lifeexpectancy' id='lifeexpectancy'/>
          <label for="gnp">GNP</label> 
		  <input type='text' name='gnp' id='gnp'/>
          <label for="gnpold">GNPOLD</label> 
		  <input type='text' name='gnpold' id='gnpold'/>
          <label for="localname">Local Name</label> 
		  <input type='text' name='localname' id='localname'/>
          <label for="formofgovernment">Form of Government</label> 
		  <input type='text' name='formofgovernment' id='formofgovernment'/>
          <label for="headofstate">Head of State</label> 
		  <input type='text' name='headofstate' id='headofstate'/>
          <label for="capital">Capital</label> 
		  <input type='text' name='capital' id='capital'/>
          <label for="internetcode">Internet Code</label> 
		  <input type='text' name='internetcode' id='internetcode'/>
    	<p><button class="w3-button w3-light-green" type="submit" name="submit" value="Submit">Submit</button></p>
    </form>

    <p><button class="w3-button w3-yellow" onclick="document.location = 'index.php'">Back to home</button> &nbsp;
    <button class="w3-button w3-yellow" onclick="document.location = 'insert.php'">Insert City</button></p>
<?php require "template/footer.php"; ?>
</div>
</div>