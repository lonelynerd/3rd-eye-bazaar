<?php

session_start();
include "database.php";

?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8" />
    <title>3rd Eye Bazaar</title>
    <link rel="stylesheet" href="css/index<?php
                                            $amogus = (rand(0, 20) == 20);
                                            if ($amogus) {
                                                echo "mogus";
                                            }
                                            ?>.css" />
    <link rel="icon" href="im/favicon.png">
</head>

<body>
    <div class="header">
        <a href="index.php">
            <img src="im/typo.png" width="300" height="150" alt="3rd Eye Bazaar" />
        </a>
    </div>

    <div class="categ">
        <div class="search-field">
            <form action="index.php" method="GET">
                <input type="text" class="search-bar" name="search" placeholder="Search something !" value="<?php if (isset($_GET["search"])) {
                                                                                                                $search = $_GET["search"];
                                                                                                                echo "$search";
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>" />
                <input type="submit" class="search-button" value="Search..." />
            </form>
        </div>
        <div>
            <form action="index.php" method="GET">
                <select name="category" onchange="if(this.value != 'dummy') { this.form.submit(); }">
                    <option value="dummy">Category...</option>
                    <option value="food">Food</option>
                    <option value="tools">Tools</option>
                    <option value="game">Game</option>
                    <option value="animal">Animal</option>
                    <option value="cosmetic">Cosmetic</option>
                    <option value="furniture">Furniture</option>
                    <option value="miscellaneous">Miscellaneous</option>
                </select>
                <select name="state" onchange="if(this.value != 'dummy') { this.form.submit(); }">
                    <option value="dummy">State...</option>
                    <option value="mint">Mint</option>
                    <option value="nearmint">Near mint</option>
                    <option value="excellent">Excellent</option>
                    <option value="good">Good</option>
                    <option value="used">Used</option>
                    <option value="poor">Poor</option>
                    <option value="annihilated">Annihilated</option>
                </select>
                <select name="price" onchange="if(this.value != 'dummy') { this.form.submit(); }">
                    <option value="dummy">Price range...</option>
                    <option value="l10">
                        < 10 $</option>
                    <option value="l25">10 $ << 25 $</option>
                    <option value="l50">25 $ << 50 $</option>
                    <option value="l100">50 $ << 100 $</option>
                    <option value="m100">> 100 $</option>
                </select>
                <input type="submit" class="search-button" value="Search..." />
            </form>
        </div>
        <div class="signup">
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

    <?php
    $req = "SELECT id,title,descript,price,cat,grading,image FROM product ORDER BY id DESC;";
    if (isset($_GET["category"]) or isset($_GET["state"]) or isset($_GET["price"])) {
        echo "<div class='cquery'>";
        echo "<img src='https://img.icons8.com/fluency-systems-filled/48/000000/diversity.png' height=20 alt='Search icon' />";
        echo "<p>You wanted to see :</p>";
        if ($_GET["category"] != "dummy") {
            echo "<h3>Category</h3>";
            echo "<p>></p><p>";
            $cats = $_GET["category"];
            switch ($cats) {
                case "dummy":
                    echo "Nothing";
                    break;
                case "food":
                    echo "Food";
                    break;
                case "tools":
                    echo "Tools";
                    break;
                case "game":
                    echo "Games";
                    break;
                case "animal":
                    echo "Animals";
                    break;
                case "cosmetic":
                    echo "Cosmetic";
                    break;
                case "furniture":
                    echo "Furniture";
                    break;
                case "miscellaneous":
                    echo "Miscellaneous";
                    break;
                default:
                    echo "What the fuck !?";
                    break;
            }
            echo "</p>";
            $req = "SELECT id,title,descript,price,cat,grading,image FROM product WHERE cat = '$cats' ORDER BY id DESC;";
        } elseif ($_GET["state"] != "dummy") {
            echo "<h3>State</h3>";
            echo "<p>></p><p>";
            $stat = $_GET["state"];
            switch ($stat) {
                case "dummy":
                    echo "Nothing";
                    break;
                case "mint":
                    echo "Mint";
                    break;
                case "nearmint":
                    echo "Near mint";
                    break;
                case "excellent":
                    echo "Excellent";
                    break;
                case "good":
                    echo "Good";
                    break;
                case "used":
                    echo "Used";
                    break;
                case "poor":
                    echo "Poor";
                    break;
                case "annihilated":
                    echo "Annihilated";
                    break;
                default:
                    echo "What have you done !?";
                    break;
            }
            $req = "SELECT id,title,descript,price,cat,grading,image FROM product WHERE grading = '$stat' ORDER BY id DESC;";
            echo "</p>";
        } elseif ($_GET["price"] != "dummy") {
            echo "<h3>Price range</h3>";
            echo "<p>></p><p>";
            switch ($_GET["price"]) {
                case "dummy":
                    echo "Nothing";
                    break;
                case "l10":
                    echo "Less than 10 $";
                    $req = "SELECT id,title,descript,price,cat,grading,image FROM product WHERE price < 10.0 ORDER BY id DESC;";
                    break;
                case "l25":
                    echo "Between 10 $ and 25 $";
                    $req = "SELECT id,title,descript,price,cat,grading,image FROM product WHERE price >= 10.0 AND price < 25.0 ORDER BY id DESC;";
                    break;
                case "l50":
                    echo "Between 25 $ and 50 $";
                    $req = "SELECT id,title,descript,price,cat,grading,image FROM product WHERE price >= 25.0 AND price < 50.0 ORDER BY id DESC;";
                    break;
                case "l100":
                    echo "Between 50 $ and 100 $";
                    $req = "SELECT id,title,descript,price,cat,grading,image FROM product WHERE price >= 50.0 AND price < 100.0 ORDER BY id DESC;";
                    break;
                case "m100":
                    echo "More than 100 $";
                    $req = "SELECT id,title,descript,price,cat,grading,image FROM product WHERE price >= 100.0 ORDER BY id DESC;";
                    break;
                default:
                    echo "Our code is broken !";
                    break;
            }
            echo "</p>";
        }
        echo "</div>";
    }
    ?>
    <?php

    if (isset($_GET["del"])) {
        if ($_GET["del"] == "true") {
            echo "<div class='delsucc'>";
            echo "<img src='https://img.icons8.com/ios-filled/50/000000/delete-forever.png' height=20 alt='Deleted' />";
            echo "<p>Your post has been succesfully deleted !</p>";
        } elseif ($_GET["del"] == "false") {
            echo "<div class='delfail'>";
            echo "<img src='https://img.icons8.com/ios-filled/50/000000/delete-forever.png' height=20 alt='Deleted' />";
            echo "<p>An error occured during the post deletion !</p>";
        } else {
            echo "<div class='delfail'>";
            echo "<img src='https://img.icons8.com/ios-filled/50/000000/delete-forever.png' height=20 alt='Deleted' />";
            echo "<p>You tried to \"hack\" things didn't you ?</p>";
        }
        echo "</div>";
    }

    if (isset($_GET["search"])) {
        echo "<div class='squery'>";
        echo "<img src='https://img.icons8.com/ios-filled/50/000000/search--v2.png' height=20 alt='Search icon' />";
        echo "<p>You wanted to search :</p>";
        $rech = $_GET["search"];
        echo "<h3>$rech</h3></div>";
        $req = "SELECT id,title,descript,price,cat,grading,image FROM product WHERE title LIKE '%$rech%' OR descript LIKE '%$rech%' ORDER BY id DESC;";
    }

    if (isset($_GET["usr"]) and isset($_SESSION["id"])) {
        echo "<div class='uquery'>";
        echo "<img src='https://img.icons8.com/ios-filled/50/000000/search--v2.png' height=20 alt='Search icon' />";
        echo "<p>You wanted to see ads by :</p>";
        $db = mysqli_connect(DBURL, DBUSR, DBPWD, DBNAM);
        if ($db == false or mysqli_connect_errno()) {
            header("Location: 500.php"); //no database
        }
        $id = $_GET['usr'];
        $req2 = "SELECT id,fname,lname FROM account WHERE id = $id;";
        $dat = mysqli_query($db, $req2);
        $data = mysqli_fetch_array($dat);
        if (!isset($data[0])) {
            $identity = $id;
        } else {
            $identity = $data[1] . " " . $data[2];
        }
        echo "<h3>$identity</h3></div>";
        echo "</div>";
        $req = "SELECT id,title,descript,price,cat,grading,image FROM product WHERE userid ='$id' ORDER BY id DESC;";
    }
    ?>

    <?php

    $db = mysqli_connect(DBURL, DBUSR, DBPWD, DBNAM);
    if ($db == false or mysqli_connect_errno()) {
        header("Location: 500.php"); //no database
        exit();
    }
    $dat = mysqli_query($db, $req);
    if ($dat == false) {
        header("Location: 500.php");
        exit();
    }
    $cnt = 0;
    while ($data = mysqli_fetch_array($dat)) {
        $postid = $data[0];
        $posttitle = $data[1];
        $postdesc = $data[2];
        $postprice = $data[3];
        $postcat = $data[4];
        $poststate = $data[5];
        $postimage = $data[6];

        if (!file_exists($postimage)) {
            $postimage = "im/noimage.png";
        }

        echo "<div class='ad'>";
        echo "<a href='showpost.php?id=$postid'>";
        echo "<div class='postimage'>";
        echo "<img src='$postimage' width='180' height='180' alt='$postimage' />";
        echo "</div>";
        echo "<div class='postinfo'>";
        echo "<h3>$posttitle</h3>";
        echo "<p>$postdesc</p>";
        echo "<p class='smol'>$postcat - $poststate</p>";
        echo "<h2>$postprice $</h2>";
        echo "</div>";
        echo "</a>";
        echo "</div>";
        $cnt += 1;
    }
    if ($cnt == 0) {
        echo "<div class='wow'>";
        if ($amogus){
            echo "<img src='im/amogus.png' height=60 alt='Much image' />";
            echo "<p>Wow, sus empty !</p>";
        }else{
            echo "<img src='https://img.icons8.com/ios-filled/50/000000/doge.png' height=60 alt='Much image' />";
            echo "<p>Wow, such empty !</p>";
        }
        echo "</div>";
    }
    ?>

    <p class="footnote"><a href="contact.php">Contact <?php if ($amogus) {
                                                            echo "s";
                                                        } ?>us</a><a href="index.php"> - </a><a href="https://shattereddisk.github.io/rickroll/rickroll.mp4">Legal notice</a></p>

</body>

</html>