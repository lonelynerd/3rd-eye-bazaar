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
    <title>Sign up - 3rd Eye Bazaar</title>
    <link rel="stylesheet" href="css/signup.css" />
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
            case "psae":
                echo "<p>This login already exists. Please enter an other login.</p>";
                break;
            case "emae":
                echo "<p>This e-mail already exists. Please enter an other e-mail.</p>";
                break;
            case "pwnm":
                echo "<p>The two passwords does not match. Please, try again.</p>";
                break;
            case "empt":
                echo "<p>One or several fields are empty.  Please fill the form correctly.</p>";
                break;
            case "iter":
                echo "<p>An internal error occured during the registration. Please try again.</p>";
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
                <div>
                    <h2 class="flabel">Sign up</h2>
                    <div class="form-left">
                        <input type="hidden" name="inscr" value="signup">
                        <input class="finput" type="text" id="fname" name="fname" pattern=".{3,44}" placeholder="First Name" />
                        <input class="finput" type="text" id="lname" name="lname" pattern=".{3,56}" placeholder="Last Name" />
                        <input class="finput" type="text" id="id" name="id" pattern=".{3,56}" placeholder="Login" />
                        <input class="finput" type="email" id="email" name="email" pattern=".{3,124}" placeholder="E-mail" />

                    </div>
                    <div class="poutre"></div>


                    <div class="form-right">
                        <input class="finput" type="password" id="mdp" name="mdp" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" placeholder="Password" />
                        <input type="hidden" name="hasaccess" value="yes">
                        <div class="instruc">
                            <p>> At least 8 characters</p>
                            <p>> Upper-cased and lower-cased characters</p>
                            <p>> Numbers</p>
                            <p>> 1 symbol ( among @$!%*#?& )</p>
                        </div>
                        <input class="finput" type="password" id="mdp2" name="mdp2" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" placeholder="Repeat your password" />
                    </div>
                </div>
                <input class="fsubmit" type="submit" value="Create your account !" />
            </form>

            <div class="add">
                <p>Already have an account ? </p>
                <a href="login.php">Log in</a>
                <p> here !</p>
            </div>
        </div>
    </div>
    <p class="footnote"><a href="contact.php">Contact us</a><a href="index.php"> - </a><a href="https://shattereddisk.github.io/rickroll/rickroll.mp4">Legal notice</a></p>
</body>

</html>