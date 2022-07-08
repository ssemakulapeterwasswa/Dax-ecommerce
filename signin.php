<?php
    require('config/config.php');
    require('config/db.php');

    session_name('userDaxPlatform');
    session_start();

    $email = $password = "";
    $emailErr = $passwordErr = $err = $hashed_password = $userFound = $passwordVerified = "";
    $firstname = $lastname = $email = "";
    $loggedin = [];

    if(isset($_POST['submit'])) {
        if(empty($_POST['email'])) {
            $emailErr = "Email is required";
        } else {
            // check if e-mail address is well-formed
            if (!filter_var(htmlspecialchars($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format"; 
            } else {
                $email = htmlspecialchars($_POST["email"]);
            }
        }

        if(empty($_POST['password'])) {
            $passwordErr = "Password is required";   
        } else{
            $password = htmlspecialchars($_POST['password']);
        }


        //create query
        $query = "SELECT * FROM users WHERE email='$email'";

        //Get result
        $result = mysqli_query($conn, $query);

        //fetch data
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

        //free result
        mysqli_free_result($result);

        if(count($users) === 1) {
            $userFound = true;
            foreach ($users as $user) {
                $firstname = $user['firstname'];
                $lastname = $user['lastname'];
                $phone = $user['phone'];
                $email = $user['email'];
                $userid = $user['userid'];
                $hashed_password = $user['password'];
            }
        } else {
            $emailErr = "User not found";
        }

        if($userFound === true) {
            if(password_verify($password, $hashed_password)) {
                $passwordVerified = true;
            } else{
                $passwordErr = "Password incorrect";
            }
        }

        if($userFound === true && $passwordVerified === true) {

            //Start session
            session_name('userDaxPlatform');
            session_start();

            $_SESSION['loggedin'] = true;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['email'] = $email;
            
            header('Location: '.ROOT_URL.'');

        }

    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <metta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />   -->
    <link rel="stylesheet" href="signin.css"/>
    <!-- <link rel="stylesheet" href="./line/icon-font/lineicons.css"> -->
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
    <title>Signin-Signup</title>
</head>
<body>
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
    <div class="general">
        <section>
            <div class="img-box">
                <img src="img.jpg"/>
            </div>
            <div class="forms-container">
                <div class="sign_in">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="log_in">
                        <h2 class="title">Login</h2>
                        <div class="input_field">
                            <label>EmailAdress</label>
                            <div class="input">
                                <input type="text" name="email" value ="<?php echo isset($_POST['email']) ? $email : "" ?>"/>
                                <?php if($emailErr !== ""): ?>
                                    <div class="alert">
                                        <?php echo $emailErr; ?>
                                    </div>
                                <?php endif; ?>
                            </div> 
                        </div>
                        <div class="input_field">
                            <label>Password</label>
                            <div class="input">
                                <input type="password" name="password" value="<?php echo isset($_POST['password']) ? $password : "" ?>" />
                                <!-- <i class="lni lni-lock-alt psd-key"></i> -->
                                <?php if($passwordErr !== ""): ?>
                                    <div class="alert">
                                        <?php echo $passwordErr; ?>
                                    </div>
                                <?php endif; ?>
                            </div>  
                        </div>
                        <div class="remember">
                            <label>Remember Me</label>
                            <input type="checkbox" />
                        </div>
                        <input type="submit"value="Login" name="submit" class="button_solid">
                        <div class="input_field">
                        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>  
                        </div>
                    </form>
                </div>
                <div class="panels-container"></div>
            </div>
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
    <script src="app.js"></script>
</body>
</html>