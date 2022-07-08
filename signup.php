<?php

  require('config/config.php');
  require('config/db.php');

  session_name('userDaxPlatform');
  session_start();

    $query = '';

    $firstname =  $lastname = $email = $tel = $type = $password = $confirm_psd = "";

    $lastnameError = $firstnameError =  $emailError = $telError = $typeError = $passwordError = $confirm_psdError = "";

    // check for submit
    if(isset($_POST['submit'])) {
        if(!empty($_POST['fname'])) {
            $firstname = htmlspecialchars($_POST['fname']);
        } else {
            $firstnameError = "First name is required";

        }
        
        if(!empty($_POST['lname'])) {
            $lastname = htmlspecialchars($_POST['lname']);
        } else {
            $lastnameError = "Last name is required";

        }

        if(!empty($_POST['tel'])) {
          $tel = htmlspecialchars($_POST['tel']);
      } else {
          $telError = "Phone number is required";
      }

        if(!empty($_POST['email'])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
                $emailError = "Enter a valid email";
    
            } else {
                $email = htmlspecialchars($_POST['email']);
            }
        } else {
            $emailError = "Email is required";

        }

        if(!empty($_POST['pswd'])) {
            if(strlen($_POST['pswd']) < 6) {
                $passwordError = "Password must be a minimum of 6 characters";
    
            } else {
                $password = htmlspecialchars($_POST['pswd']);
            }
        } else {
            $passwordError = "Password is required";

        }

        if(!empty($_POST['cpswd'])) {
            if(strlen($_POST['cpswd']) < 6) {
                $confirm_psdError = "Password must be a minimum of 6 characters";
    
            } else {
                if($password === $_POST['cpswd']) {
                    $confirm_psd = password_hash(htmlspecialchars($_POST['cpswd']), PASSWORD_BCRYPT);;
                } else {
                    $confirm_psdError = "Passwords don't match";
        
                }
            }
        } else {
            $confirm_psdError = "Please enter password again";

        }

        // check if user email exists
        //create query
        $query2 = "SELECT * FROM users WHERE email='$email'";

        //Get result
        $result = mysqli_query($conn, $query2);

        //fetch data
        $user = mysqli_fetch_all($result, MYSQLI_ASSOC);

        //free result
        mysqli_free_result($result);

        if(count($user) === 1) {
            $emailError = 'User already exists';
        } else {
          if($firstnameError === "" && $lastnameError === "" && $emailError === "" && $passwordError === "" && $confirm_psdError === "" && $telError === "" && $typeError === "") {
              $query = "INSERT INTO users(firstname, lastname, email, phone, type, password) VALUES ('$firstname','$lastname','$email', '$tel','$type', '$confirm_psd')";

              if(mysqli_query($conn, $query)) {
                // header('Location: '.ROOT_URL.'/signin.php');
                mysqli_close($conn);
              } else {
                  $queryFail = "Query failed";
              }
          }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="signup.css" />
    <link rel="stylesheet" href="./line/icon-font/lineicons.css" />
    <link rel="stylesheet" href="./dist/output.css" />
    <title>Sign Up</title>
  </head>
  <body>
    <section>
      <nav>
        <label class="logo">DAX-platform</label>
        <ul>
          <li><a clas="action" href="index.php">Home</a></li>
          <li><a href="#">DEALS</a></li>
          <li><a href="#">Categories</a></li>
          <li><a href="#">Seller</a></li>
          <li>
            <a href="#"><i class="lni lni-cart"></i>Cart</a>
          </li>
          <li><a href="#">Help</a></li>
          <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
              <li><p class="user-name"><?php echo $_SESSION['firstname']; ?></p></li>
              <li><a href="logout.php">Log Out</a></li>
            <?php else: ?>
              <li><a href="signin.php">Sign In</a></li>
            <?php endif; ?>
        </ul>
      </nav>
    </section>
    <div class="cont">
      <!--<h1 class="text-3xl font-bold underline">Hello world!</h1>-->
      <section id="signup-form">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="Sign_up">
          <h2 class="title">SignUp</h2>
          <p>Already have an account? <a href="signin.php">Login</a></p>
          <div class="input_field">
            <label>FirstName</label>
            <div class="input">
              <input type="text" name="fname" value="<?php echo isset($_POST['fname']) ? $firstname : "" ?>" />
              <?php if($firstnameError !== ""): ?>
                  <div class="alert">
                      <?php echo $firstnameError; ?>
                  </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="input_field">
            <label>LastName</label>
            <div class="input">
              <input type="text" name="lname" value="<?php echo isset($_POST['lname']) ? $lastname : "" ?>" />
              <?php if($lastnameError !== ""): ?>
                  <div class="alert">
                      <?php echo $lastnameError; ?>
                  </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="input_field">
            <label>Email</label>
            <div class="input">
              <input type="text" name="email" value ="<?php echo isset($_POST['email']) ? $email : "" ?>"/>
              <?php if($emailError !== ""): ?>
                  <div class="alert">
                      <?php echo $emailError; ?>
                  </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="input_field">
            <label>TelephoneNumber</label>
            <div class="input">
              <input type="text" name="tel" value="<?php echo isset($_POST['tel']) ? $tel : "" ?>" />
              <?php if($telError !== ""): ?>
                  <div class="alert">
                      <?php echo $telError; ?>
                  </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="input_field">
            <label>Type Of Account</label>
            <div class="input">
              <select name="type">
                <option>Seller</option>
                <option>Buyer</option>
              </select>
            </div>
          </div>
          <div class="input_field">
            <label>Password</label>
            <div class="input">
              <input type="password" name="pswd" value="<?php echo isset($_POST['pswd']) ? $password : "" ?>" />
              <?php if($passwordError !== ""): ?>
                    <div class="alert">
                        <?php echo $passwordError; ?>
                    </div>
                <?php endif; ?>
            </div>
          </div>
          <div class="input_field">
            <label>ConfirmPassword</label>
            <div class="input">
              <input type="password" name="cpswd" />
              <?php if($confirm_psdError !== ""): ?>
                    <div class="alert">
                        <?php echo $confirm_psdError; ?>
                    </div>
                <?php endif; ?>
            </div>
          </div>
          <input type="submit" value="Submit" name="submit" class="button_solid" />
        </form>
      </section>
    </div>
    <footer class="flex">
      <div class="wrapper">&copy;</div>
      <div class="footer-nav flex">
        <p>2022 Dax-platform.</p>
        <p>All rights Reserved.</p>
        <p>Developed by Aljem</p>
      </div>
    </footer>
  </body>
</html>
