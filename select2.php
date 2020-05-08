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
    
    .w3-button {
      width:150px;
      border-radius: 4px;
    }
    h1{
        text-align: center;
    }
    div.wrapper {
  width: 2000px;
  height: 1000px;
  overflow: auto;
}
    </style>


<div id = "overlay">
<div id="content">
<body>
<h1>Countries All Around the World</h1>
<div class="wrapper">
<?php
echo "<table style='border: solid 1px grey;'>";
echo "<tr><th>countrycode</th>
      <th>countryname</th>
      <th>continent</th>
      <th>region</th>
      <th>surfacearea</th>
      <th>independentyear</th>
      <th>population</th>
      <th>lifeexpectancy</th>
      <th>gnp</th>
      <th>gnpold</th>
      <th>localname</th>
      <th>formoggoverment</th>
      <th>headofstate</th>
      <th>capital</th>
      <th>internetcode</th>
      </tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid grey;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "world";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT countrycode, countryname, continent, region, surfacearea, independentyear, population, lifeexpectancy, gnp, gnpold, localname, formofgovernment, headofstate, capital, internetcode FROM country");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
</div>
<p><button class="w3-button w3-yellow" onclick="document.location = 'index.php'">Back to home</button> &nbsp;
<button class="w3-button w3-yellow" onclick="document.location = 'select.php'">Show City</button></p>
</div>
</div>
