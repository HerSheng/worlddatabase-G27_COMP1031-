<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

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
<div id="content">
<?php
/**
  * Use an HTML form to edit an entry in the
  * users table.
  *
  */
require "config.php";
require "common.php";
if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $user =[
        "countrycode" => $_POST['countrycode'],
        "countryname"  => $_POST['countryname'],
        "continent"     => $_POST['continent'],
        "region"       => $_POST['region'],
        "surfacearea"  => $_POST['surfacearea'],
        "independentyear"     => $_POST['independentyear'],
        "population"     => $_POST['population'],
        "lifeexpectancy"     => $_POST['lifeexpectancy'],
        "gnp"     => $_POST['gnp'],
        "gnpold"     => $_POST['gnpold'],
        "localname"     => $_POST['localname'],
        "formofgovernment"     => $_POST['formofgovernment'],
        "headofstate"     => $_POST['headofstate'],
        "capital"     => $_POST['capital'],
        "internetcode"     => $_POST['internetcode']
    ];

    $sql = "UPDATE country
            SET
            countrycode=:countrycode, countryname=:countryname, continent=:continent, region=:region, surfacearea=:surfacearea, independentyear=:independentyear, population=:population, lifeexpectancy=:lifeexpectancy, gnp=:gnp, gnpold=:gnpold, localname=:localname, formofgovernment=:formofgovernment, headofstate=:headofstate, capital=:capital, internetcode=:internetcode
            WHERE countrycode = :countrycode";

  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['countrycode'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $countrycode = $_GET['countrycode'];
    $sql = "SELECT * FROM country WHERE countrycode = :countrycode";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':countrycode', $countrycode);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "template/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
  <?php echo escape($_POST['countryname']); ?> successfully updated.
<?php endif; ?>

<br>
<h2>Edit a user</h2>

<form method="post">
    <?php foreach ($user as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'countrycode' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <p><button class="w3-button w3-light-green" type="submit" name="submit" value="Submit">Submit</button></p>
</form>

<p><button class="w3-button w3-yellow" onclick="document.location = 'selectupdate2.php'">Back to Edit</button> &nbsp;
<button class="w3-button w3-yellow" onclick="document.location = 'index.php'">Back to home</button></p>

<?php require "template/footer.php"; ?>
</div>
</div>