<?php
session_start();
if (!isset($_SESSION["id"])) {
    //echo "HERE !";
    header("Location: 403.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8" />
    <title><?php echo $_SESSION["fname"]; ?>'s account - 3rd Eye Bazaar</title>
    <link rel="stylesheet" href="css/account.css" />
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
            <a class="firstelem" href="postsend.php">Create post</a>
            <a class="other" href="acc_redirect.php?c=logout">Log out</a>
        </div>
    </div>

    <div class="window">
        <div class="main">
            <img src="im/placeholder.png" height="100" width="100" alt="Profile picture (WIP)" />
            <h2>Welcome back, <?php 
            if(rand(1,100) == 100){
                 echo $_SERVER['REMOTE_ADDR'];
            }else{
                echo $_SESSION["fname"];
            }
             ?> !</h2>
        </div>
    </div>
    <?php if (isset($_GET["mode"]) and $_GET["mode"] == "first") {
        echo '<div class="firsttime">';
        $fname = $_SESSION["fname"];
        echo "<h3>Welcome to your main account page, $fname !</h3>";
        echo '<p>From here, you will be able to create posts and see them. More functions and options are coming, so stay tuned !</p>';
        echo '</div>';
    }

    ?>

    <div class="button-container">
        <a href="postsend.php">
            <div class="button1">
                <img src="https://img.icons8.com/ios-filled/50/000000/sign-up.png" height="24" width="24" alt="Post icon" />
                <p>Post something !</p>
            </div>
        </a>
        <a href="index.php?usr=<?php echo $_SESSION["id"]; ?>">
            <div class="button2">
                <img src="https://img.icons8.com/ios-filled/50/000000/visible--v1.png" height="24" width="24" alt="See icon" />
                <p>See your posts !</p>
            </div>
        </a>
        <a href="acc_redirect.php?c=logout">
            <div class="button3">
                <img src="https://img.icons8.com/ios-filled/50/000000/logout-rounded-down.png" height="24" width="24" alt="Logoff icon" />
                <p>Log off :(</p>
            </div>
        </a>
    </div>

    <p class="footnote"><a href="contact.php">Contact us</a><a href="index.php"> - </a><a href="https://shattereddisk.github.io/rickroll/rickroll.mp4">Legal notice</a></p>

</body>

</html>