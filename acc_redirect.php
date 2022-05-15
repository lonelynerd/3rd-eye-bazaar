<!DOCTYPE html>
<html>

<head>
  <title>Redirecting... - 3rd Eye Bazaar</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" href="css/postsend.css">
  <link rel="icon" href="im/favicon.png">
</head>

<body>
<?php
session_start();
include "database.php";

if (isset($_GET["c"]) and $_GET["c"] == "logout") {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

if (isset($_SESSION["id"])) {
    //echo $_SESSION["id"];
    header("Location: 403.php");
    exit();
}

if (!isset($_POST["hasaccess"])) {
    header("Location: 403.php");
    exit();
}

if (!isset($_GET["c"]) and !(isset($_POST["inscr"]) and in_array($_POST["inscr"], ["signup", "login"]))) {
    header("Location: 403.php");
    exit();
}

if ($_POST["inscr"] == "signup") {
    $pseudo = $_POST["id"];
    $mail = $_POST["email"];
    $mdp = $_POST["mdp"];
    $mdp2 = $_POST["mdp2"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    if (($pseudo == "") or ($mail == "") or ($mdp == "") or ($mdp2 == "") or ($fname == "") or ($lname == "")) {
        header("Location: signup.php?err=empt"); //fields empty
        exit();
    };
    $db = mysqli_connect(DBURL, DBUSR, DBPWD, DBNAM);
    if ($db == false or mysqli_connect_errno()) {
        header("Location: signup.php?err=nodb"); //no database
        exit();
    }
    $req = "SELECT COUNT(pseudo) FROM account WHERE pseudo = '$pseudo';";
    $dat = mysqli_query($db, $req);
    $data = mysqli_fetch_array($dat);
    if ($data[0] != "0" or $data[0] != 0) {
        header("Location: signup.php?err=psae"); //pseudo already exist
        exit();
    }
    $req = "SELECT COUNT(email) FROM account WHERE email = '$mail';";
    $dat = mysqli_query($db, $req);
    $data = mysqli_fetch_array($dat);
    if ($data[0] != 0) {
        header("Location: signup.php?err=emae"); //email already exist
        exit();
    }
    if ($mdp !== $mdp2) {
        header("Location: signup.php?err=pwnm"); //passwords not matching
        exit();
    }
    $mdpe = hash("sha256", $mdp, false);
    $req = "INSERT INTO `account`(`pseudo`, `fname`, `lname`, `email`, `pwd`) VALUES ('$pseudo','$fname','$lname','$mail','$mdpe');";
    if (!mysqli_query($db, $req)) {
        header("Location: signup.php?err=iter"); //internal error
        exit();
    }
    $req = "SELECT id,fname,lname,pseudo FROM account WHERE email = '$mail';";
    $dat = mysqli_query($db, $req);
    $data = mysqli_fetch_array($dat);
    $_SESSION["id"] = $data[0];
    $_SESSION["fname"] = $data[1];
    $_SESSION["lname"] = $data[2];
    $_SESSION["pseudo"] = $data[3];
    //echo $_SESSION["id"];
    //echo $_SESSION["fname"];
    //echo $_SESSION["lname"];
    //echo $_SESSION["pseudo"];
    header("Location: account.php?mode=first");
} elseif ($_POST["inscr"] == "login") {
    $idlog = $_POST["id"];
    $mdplog = $_POST["mdp"];
    if (($idlog == "") or ($mdplog == "")) {
        header("Location: login.php?err=empt"); //fields empty
        exit();
    }
    $db = mysqli_connect(DBURL, DBUSR, DBPWD, DBNAM);
    if ($db == false or mysqli_connect_errno()) {
        header("Location: login.php?err=nodb"); //no database
        exit();
    }
    $mdploge = hash("sha256", $mdplog, false);
    $req = "SELECT pwd FROM account WHERE pseudo = '$idlog' or email = '$idlog';";
    $dat = mysqli_query($db, $req);
    if ($dat == false) {
        header("Location: 500.php");
        exit();
    }
    $data = mysqli_fetch_array($dat);
    if ($data[0] != $mdploge) {
        header("Location: login.php?err=wgpw"); //wrong password
        exit();
    }
    $req = "SELECT id,fname,lname,pseudo FROM account WHERE email = '$idlog' OR pseudo = '$idlog';";
    $dat = mysqli_query($db, $req);
    $data = mysqli_fetch_array($dat);
    $_SESSION["id"] = $data[0];
    $_SESSION["fname"] = $data[1];
    $_SESSION["lname"] = $data[2];
    $_SESSION["pseudo"] = $data[3];
    //echo $_SESSION["id"];
    //echo $_SESSION["fname"];
    //echo $_SESSION["lname"];
    //echo $_SESSION["pseudo"];
    header("Location: account.php");
}

?>
</body>

</html>