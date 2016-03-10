<?php
    //Check access
   if (isset($_COOKIE['username'])) {
     $name = $_COOKIE['username'];
     $pass = $_COOKIE['password'];
     $granted = false;
     //Process login
     $mysqli = new mysqli("eu-cdbr-azure-north-d.cloudapp.net", "b2a32c755154bf", "c0b4e78d", "anspiritMain");
     $query = "SELECT * FROM `developers` WHERE `userName`='". $name ."'";
     if($result = $mysqli -> query($query)){
       //Query executed
       if ($row = $result -> fetch_assoc()) {
         //User found
         if ($pass == $row['password']) {
           //Done, everything is correct
           //Access granted
           $granted = true;
         }
       }
     }
   }
   if (!$granted) {
     //No access for current user here!
     $newURL = 'http://anspirit.org/developers';
     header('Location: '.$newURL);
   }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Anspirit - Manage Developer</title>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <meta name="description" content="IOT is our future. Everyday people create more and more smart devices. These devices are irreplaceable part of our lives. But how we use them? Every smart device means new app on your smartphone, desktop, smartwatch edc. Anspirit and qproject will connect all of them with each other using one simple ecosystem based on Rest API. Every device can control each other and get information from them.">
    <meta property="og:description" content="IOT is our future. Everyday people create more and more smart devices. These devices are irreplaceable part of our lives. But how we use them? Every smart device means new app on your smartphone, desktop, smartwatch edc. Anspirit and qproject will connect all of them with each other using one simple ecosystem based on Rest API. Every device can control each other and get information from them.">
    <link rel="shortcut icon" type="image/x-icon" href="../../../images/anspirit.ico">
    <link rel="apple-touch-icon" href="../../../images/anspirit.ico">
    <title>Anspirit - Developer login</title>
    <style media="screen">
    body {
        background: url('http://i.imgur.com/Eor57Ae.jpg') no-repeat fixed center center;
        background-size: cover;
        font-family: Montserrat;
    }
    footer{
      position: absolute;
      bottom: 100px;
      left: 100px;
    }
    </style>
  </head>
  <body>

    <footer>
      <a href="http://anspirit.org"><img src="../../../images/anspirit.ico" width="100px"/></a>
    </footer>
  </body>
</html>