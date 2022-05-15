<!DOCTYPE html>
<html lang="en-us">

<?php
session_start();
if (isset($_SESSION["id"])) {
    //echo "HERE !";
    header("Location: 403.php");
    exit();
}
?>

<head>
    <meta charset="utf-8" />
    <title>Log in - 3rd Eye Bazaar</title>
    <link rel="stylesheet" href="css/login.css" />
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
            <a href="login.php">Log in</a><a href="index.php"> - </a><a href="signup.php">Sign up</a>
        </div>
    </div>
    <?php
    if (isset($_GET["err"])) {
        $err = $_GET["err"];
        echo "<div class='error'>";
        switch ($err) {
            case "nodb":
                echo "<p>An internal error occured. You can try again in 5 minutes.</p>";
                break;
            case "wgpw":
                echo "<p>The password or login is incorrect. Please try again.</p>";
                break;
            case "empt":
                echo "<p>One or several fields are empty. Please fill the form correctly.</p>";
                break;
            default:
                echo "<p>An unknown error occured. Please try again later.</p>";
                break;
        }
        echo "</div>";
    }
    ?>
    <div class="handler">
        <div class="formu">
            <form method="POST" action="acc_redirect.php">
                <h2 class="flabel">Log in</h2>
                <input type="hidden" name="inscr" value="login">
                <input type="hidden" name="hasaccess" value="yes">
                <input class="finput" type="text" name="id" pattern=".{3,124}" placeholder="Login / E-mail" /> <!-- Pattern à éditer selon taille ds° SQL-->
                <input class="finput" type="password" name="mdp" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" placeholder="Password" />
                <input class="fsubmit" type="submit" value="Log in" />
                </fieldset>
            </form>
            <div class="add">
                <p>No account ? Join us by </p>
                <a href="signup.php"> signing up !</a>
            </div>
        </div>
    </div>
    <p class="footnote"><a href="contact.php">Contact us</a><a href="index.php"> - </a><a href="https://shattereddisk.github.io/rickroll/rickroll.mp4">Legal notice</a></p>
</body>

</html>