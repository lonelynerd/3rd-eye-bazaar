<?php session_start() ?>

<!DOCTYPE html>
<html lang="en-us">

<head>
  <title>Contact us ! - 3rd Eye Bazaar</title>
  <link rel="stylesheet" href="css/contact.css" />
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
  <div class="intro">
    <div>
      <img src="im/creators.png" width="300" height="400" />
    </div>
    <div class="text-i">
      <h1>Who are we ?</h1>
      <p><strong>Third-Eye Bazzar</strong> is a brand new growing interdimensional market place ! We
        are helping customers get in touch from all sides of the galaxy ! Our dream is
        to live in a fully connected society in wich we wouldn't have to wait for an
        entire hour before receiving a product from a planete that's just aside !
      </p>
    </div>

  </div>

  <div class="contact">
    <div class="text-c">
      <h1>Contact us !</h1>
      <p>
        No weirdos here ! Encountered a bug, any issue with a customer or product ?
        Feel free to contact us, and we will take appropriate measures !
        Thanks for making the <strong>Third-eye Bazaar</strong> a safer place !
      </p>
    </div>
    <div class="form-c" id="msg">
      <form method="post" action="contact.php#msg">
        <input class="finput" type="text" name="mail" pattern=".{3,124}" placeholder="E-mail adress" />
        <textarea class="flinput" name="msg" rows="5" cols="30" placeholder="Describe your issue..."></textarea>
        <button type="submit" class="fsubmit">Submit</button>
        <?php
        if (isset($_POST["mail"]) and isset($_POST["msg"])) {
          $mail = $_POST['mail'];
          $msg = $_POST['msg'];
          if ($mail == "" or $msg == "") {
            echo "<p>Please fill the form !</p>";
            exit();
          }
          $f = fopen("ct/" . strval(time()) . " - " . $mail . ".txt", "w");
          if ($f == NULL) {
            header("Location: 500.php");
            exit();
          }
          if (!fwrite($f, $mail . "-" . $msg)) {
            header("Location: 500.php");
            exit();
          }
          fclose($f);
          echo "<p>Message sent !</p>";
        }

        ?>
      </form>
    </div>
  </div>
  <p class="footnote"><a href="https://shattereddisk.github.io/rickroll/rickroll.mp4">Legal notice</a></p>

</body>

</html>