<?php session_start();
if (!isset($_SESSION["id"])) {
  header("Location: 403.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en-us">

<head>
  <title>Create a post - 3rd Eye Bazaar</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" href="css/postsend.css">
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
  <?php if (isset($_GET["err"])) {
    echo "<div class='error'>";
    switch ($_GET["err"]) {
      case "empt":
        echo "<p>One or several fields are empty. Please fill the form correctly.</p>";
        break;
      case "ibig":
        echo "<p>The image you picked is too big... Please, try again with a smaller image.</p>";
        break;
      case "esav":
        echo "<p>We had some trouble saving your image. Please try again later.</p>";
        break;
      case "nodb":
        echo "<p>An internal error occured. You can try again in 5 minutes.</p>";
        break;
      case "psve":
        echo "<p>We had some trouble sharing your post. Please try again later.</p>";
        break;
      default:
        echo "<p>An unknown error occured. Please try again later.</p>";
        break;
    }
    echo "</div>";
  }
  ?>

  <div class="window">
    <form method="POST" action="bkend-postsend.php" enctype="multipart/form-data">
      <h2 class="flabel">Create a post</h2>
      <div class="leftw">
        <input type="text" class="finput" name="title" placeholder="Object's name" />
        <textarea id="desc" class="flinput" name="desc" rows="5" cols="30" placeholder="Description"></textarea>
        <input type="text" class="finput" name="coord" placeholder="Planet" />
        <input type="hidden" name="hasaccess" value="yes">
      </div>

      <div class="poutre"></div>

      <div class="rightw">
        <div class="instruc">
          <p>Valid formats : .jp(e)g , .png , .gif</p>
          <p>Max size : 10 Mb</p>
        </div>
        <div class="wimage">
          <label for="image" class="labelim">Choose a picture</label>
          <input class="fimage" type="file" id="image" name="image" accept=".gif,.png,.jpg,.jpeg" />
        </div>
        <input type="text" class="finput" name="contact" placeholder="Contact" />

        <select class="fchoice" name="category">
          <option value="dummy">Category...</option>
          <option value="food">Food</option>
          <option value="tools">Tools</option>
          <option value="game">Game</option>
          <option value="animal">Animal</option>
          <option value="cosmetic">Cosmetic</option>
          <option value="furniture">Furniture</option>
          <option value="miscellaneous">Miscellaneous</option>
        </select>

        <select class="fchoice" name="state">
          <option value="dummy">State...</option>
          <option value="mint">Mint</option>
          <option value="nearmint">Near mint</option>
          <option value="excellent">Excellent</option>
          <option value="good">Good</option>
          <option value="used">Used</option>
          <option value="poor">Poor</option>
          <option value="annihilated">Annihilated</option>
        </select>

        <input type="number" min="0" step="0.01" class="finput" name="price" placeholder="Price" />
      </div>

      <button class="fsubmit" type="submit" class="button">Submit</button>

    </form>
  </div>


  <p class="footnote"><a href="contact.php">Contact us</a><a href="index.php"> - </a><a href="https://shattereddisk.github.io/rickroll/rickroll.mp4">Legal notice</a></p>

</body>

</html>