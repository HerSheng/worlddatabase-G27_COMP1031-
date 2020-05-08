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
      width: 100%;
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
      width:100px;
      border-radius: 4px;
    }
    </style>

<body>
<div id="overlay">
<?php include "template/header.php"; ?>
<div id="content">
<ul>
<h1>Please choose the action you want to perform: </h1>
  <p><button class="w3-button w3-blue" onclick="document.location = 'select2.php'">Select</button></p>
  <p><button class="w3-button w3-blue" onclick="document.location = 'insert2.php'">Insert</button></p>
  <p><button class="w3-button w3-blue" onclick="document.location = 'selectupdate2.php'">Update</button></p>
  <p><button class="w3-button w3-blue" onclick="document.location = 'selectdelete2.php'">Delete</button></p>
</ul>
<?php include "template/footer.php"; ?>
</div>
</div>
</body>