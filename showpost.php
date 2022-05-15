<!DOCTYPE html>
<html lang="en-us">

<?php
session_start();
include "database.php";

if (!isset($_GET["id"])) {
  header("Location: 500.php");
  exit();
}
?>

<head>
  <meta charset="utf-8" />
  <title>
    <?php

    $pid = $_GET["id"];
    $db = mysqli_connect(DBURL, DBUSR, DBPWD, DBNAM);
    if (!$db) {
      header("Location: 500.php");
      exit();
    }
    $req = "SELECT COUNT(id) FROM product WHERE id = $pid";
    $dat = mysqli_query($db, $req);
    if (!$dat) {
      header("Location: 500.php");
      exit();
    }
    $data = mysqli_fetch_array($dat);
    if ($data[0] == 0) {
      header("Location: 500.php");
      exit();
    }
    $req = "SELECT title,cat,grading,descript,coord,price,contact,image,userid FROM product WHERE id = $pid";
    $dat = mysqli_query($db, $req);
    if (!$dat) {
      header("Location: 500.php");
      exit();
    }
    $data = mysqli_fetch_array($dat);
    $postname = $data[0];
    $postcategory = $data[1];
    $poststate = $data[2];
    $postdesc = $data[3];
    $postcoord = $data[4];
    $postprice = $data[5];
    $postcontact = $data[6];
    $postimage = $data[7];
    if (rand(0, 1000) == 1000) {
      $postimage = "im/uwu.png";
    }
    $userid = $data[8];

    echo $data[0];

    $req = "SELECT fname,lname,pseudo FROM account WHERE id = $userid";
    $dat = mysqli_query($db, $req);
    if (!$dat) {
      header("Location: 500.php");
      exit();
    }
    $data = mysqli_fetch_array($dat);

    $postfname = $data[0];
    $postlname = $data[1];
    $postpseudo = $data[2];

    ?> - 3rd Eye Bazaar</title>
  <link rel="stylesheet" href="css/showpost.css" />
  <link rel="icon" href="im/favicon.png">
</head>

<body>
  <div class="header">
    <a href="index.php">
      <img src="im/typo.png" width="300" height="150" alt="3rd Eye Bazaar" />
    </a>
  </div>

  <div class="categ">
    <div>
      <?php if (!isset($_SESSION["id"])) {
        echo '<a href="login.php">Log in</a><a href="index.php"> - </a><a href="signup.php">Sign up</a>';
      } else {
        $fname = $_SESSION["fname"];
        $lname = $_SESSION["lname"];
        echo "<a href='account.php'>$fname $lname</a>";
      }
      ?>
    </div>
  </div>
  <div class="window">
    <div class="pimage">
      <img src='<?php echo $postimage; ?>' width="500" height="300" alt='<?php echo $postimage; ?>' />
      <div class="title">
        <p class="smol">Post title</p>
        <h1><?php echo $postname; ?></h1>
        <p class="smol">Price</p>
        <h2><?php echo $postprice . " $"; ?></h2>
      </div>
    </div>
    <div class="desc">
      <p class="smol">Description</p>
      <p><?php echo $postdesc; ?></p>
    </div>
    <div class="info">
      <div class="basic">
        <p class="smol">Category - State</p>
        <p><?php echo $postcategory . " - " . $poststate; ?></p>
        <p class="smol">Origin planet</p>
        <p><?php echo $postcoord ?></p>
      </div>
      <div class="contact">
        <p class="smol">Post creator :</p>
        <p class="bold"><?php echo $postfname . " " . $postlname . " (" . $postpseudo . ")"; ?></p>
        <p class="smol">Contact</p>
        <p><?php echo $postcontact; ?></p>
      </div>
    </div>
    <div class="button_c">
      <div class="bcontact">
        <a href="https://shattereddisk.github.io/rickroll/rickroll.mp4">
          <img src="https://img.icons8.com/ios-filled/24/000000/new-message.png" alt="Contact" />
          <p> Contact the seller !</p>
        </a>
      </div>
      <?php if (isset($_SESSION["id"]) and $_SESSION["id"] == $userid) {
        echo "<div class='bdelete'>";
        echo "<img src='https://img.icons8.com/ios-filled/24/000000/delete-forever.png' alt='Delete' />";
        echo "<form method='POST' action='bkend-postsend.php'>";
        echo "<input type='hidden' name='suppid' value='$pid'>";
        echo "<input type='hidden' name='suppfile' value='$postimage'>";
        echo "<input type='submit' value='Delete that post' />";
        echo "</form>";
        echo "</div>";
      }
      ?>
    </div>
  </div>

  <p class="footnote"><a href="contact.php">Contact us</a><a href="index.php"> - </a><a href="https://shattereddisk.github.io/rickroll/rickroll.mp4">Legal notice</a></p>

</body>

</html>