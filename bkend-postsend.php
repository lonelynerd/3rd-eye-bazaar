<!DOCTYPE html>
<html lang="en-us">

<?php

session_start();
include "database.php";

?>

<head>
    <title>Sending post... - 3rd Eye Bazaar</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="css/bkend-postsend.css">
    <link rel="icon" href="im/favicon.png">
</head>

<body>
    <?php

    if (isset($_POST["suppid"])) {
        $suppid = $_POST["suppid"];
        $db = mysqli_connect(DBURL, DBUSR, DBPWD, DBNAM);
        if (!$db) {
            header("Location: 500.php");
            exit();
        }
        $req = "DELETE FROM `product` WHERE id = $suppid";
        $dat = mysqli_query($db, $req);
        if (!$dat) {
            header("Location: index.php?del=false");
            exit();
        }
        if ($_POST["suppfile"] != "im/noimage.png") {
            if (!unlink($_POST["suppfile"])) {
                header("Location: index.php?del=false");
                exit();
            }
        }
        header("Location: index.php?del=true");
        exit();
    }

    if (!isset($_POST["hasaccess"])) {
        header("Location: 403.php");
        exit();
    }

    if (!isset($_SESSION["id"])) {
        header("Location: 403.php");
        exit();
    }

    if (
        !((isset($_POST["title"]) and $_POST["title"] != "")
            and (isset($_POST["desc"]) and $_POST["desc"] != "")
            and (isset($_POST["coord"]) and $_POST["coord"] != "")
            and (isset($_POST["contact"]) and $_POST["contact"] != "")
            and (isset($_POST["price"]) and $_POST["price"] != "")
            and (isset($_POST["category"]) and $_POST["category"] != "dummy")
            and (isset($_POST["state"]) and $_POST["state"] != "dummy"))
    ) {
        header("Location: postsend.php?err=empt");
        exit();
    }
    if (!($_FILES["image"]["tmp_name"] != "")) {
        $image = "im/noimage.png";
    } else {
        if ($_FILES["image"]['size'] >= 10000000) { //10MB
            header("Location: postsend.php?err=ibig");
            exit();
        }
        $rd1 = strval(time());
        $rd2 = strval(rand(0, 1000000));
        $imagepath = "C:\\xampp\\htdocs\\www\\3rdEyeBazaar\\im-part\\" . $rd1 . "-" . $rd2 . "-" . substr($_FILES["image"]["name"], -5);
        $image = "im-part/" . $rd1 . "-" . $rd2 . "-" . substr($_FILES["image"]["name"], -5);
        $f = fopen($imagepath, "wb");
        $f2 = fopen($_FILES["image"]['tmp_name'], "rb");
        if ($f == NULL or $f2 == NULL) {
            header("Location: postsend.php?err=esav");
            exit();
        }
        $imdata = fread($f2, $_FILES["image"]['size']);
        if (!fwrite($f, $imdata)) {
            header("Location: postsend.php?err=esav");
            fclose($f);
            fclose($f2);
            exit();
        }
        fclose($f);
        fclose($f2);
    }
    $db = mysqli_connect(DBURL, DBUSR, DBPWD, DBNAM);
    if ($db == false or mysqli_connect_errno()) {
        header("Location: postsend.php?err=nodb");
        exit();
    }
    $id = $_SESSION["id"];
    $title = $_POST["title"];
    $title = str_replace(array("'", "\"", "&quot;"), "", htmlspecialchars($title));
    $desc = $_POST["desc"];
    $desc = str_replace(array("'", "\"", "&quot;"), "", htmlspecialchars($desc));
    $coord = $_POST["coord"];
    $coord = str_replace(array("'", "\"", "&quot;"), "", htmlspecialchars($coord));
    $contact = $_POST["contact"];
    $contact = str_replace(array("'", "\"", "&quot;"), "", htmlspecialchars($contact));
    $price = floatval($_POST["price"]);
    $category = $_POST["category"];
    $state = $_POST["state"];
    $req = "INSERT INTO `product`(`userid`, `title`, `descript`, `coord`, `contact`, `cat`, `grading`, `price`, `image`) VALUES (" . $id . ",'" . $title . "','" . $desc . "','" . $coord . "','" . $contact . "','" . $category . "','" . $state . "'," . $price . ",'" . $image . "')";

    if (mysqli_query($db, $req) == false) {
        header("Location: postsend.php?err=psve");
        exit();
    }
    $req2 = "SELECT LAST_INSERT_ID();";
    $dat2 = mysqli_query($db, $req2);
    if ($dat2 == false) {
        header("Location: postsend.php?err=psve");
        exit();
    }
    $data2 = mysqli_fetch_array($dat2);
    if ($data2 == null or $data2 == false or !isset($data2[0])) {
        header("Location: postsend.php?err=psve");
        exit();
    }
    $postid = $data2[0];
    header("Location: showpost.php?id=$postid");
    exit();
    ?>

</body>

</html>