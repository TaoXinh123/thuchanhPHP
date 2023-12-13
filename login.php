<?php 
    define('Access', TRUE);
    include "./AdditionalPHP/startSession.php";
	// use PHPMailer\PHPMailer\PHPMailer;
	// use PHPMailer\PHPMailer\Exception;
	// require 'C:\xampp\composer\vendor\autoload.php';
?>

<?php
    include "connection.php";

    $uname = $password= "";
    $errCriteria = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if ((empty($_POST['uname'])) || (empty($_POST['password']))){
            $errCriteria = "Incorrect Username or Password!";
        } else {
            $uname = test_input($_POST['uname']);
            $password = test_input($_POST['password']);

            // select row
            $sql = "SELECT * FROM user WHERE uname='$uname'";
            $result= mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);

                // check if user has verified his email
                if($row['verified'] == 0)
                {
                    setcookie("thankYouCookie", "verificationEmailSent", time() - 3600);
                    setcookie("verifiedEmailCookie", "emailInvalid", time() - 3600);
                    setcookie("resetPassword","resetMailSent", time() - 3600);
                    // check if hashed passwords match
                    if(password_verify($password, $row['pass']))
                    {
                        include "./AdditionalPHP/startSession.php";

                        // store the user data in this session
                        // $_SESSION['uname'] = $row['uname'];
                        $_SESSION['Admin'] = $row;

                        header('location:admin/index1.php');
                    } else {
                        $errCriteria = "Incorrect Username or Password!";
                    }
                }else{
                    setcookie("thankYouCookie", "verificationEmailSent", time() - 3600);
                    setcookie("verifiedEmailCookie", "emailInvalid", time() - 3600);
                    setcookie("resetPassword","resetMailSent", time() - 3600);
                    if(password_verify($password, $row['pass']))
                    {
                        include "./AdditionalPHP/startSession.php";

                        // store the user data in this session
                        $_SESSION['uname'] = $row['uname'];
                        $_SESSION['isAdmin'] = $row['isAdmin'];

                        header('location:index.php');
                    } else {
                        $errCriteria = "Incorrect Username or Password!";
                    }
                }
            }
        }
    }
 
      
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>


<!DOCTYPE html>
<html lang="en-MU">
    <head>
        <meta charset="utf-8">
        <title>Boulangerie | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="Common.css">
        <link rel="stylesheet" type="text/css" href="Account.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <title>Boulangerie | Login</title>
    </head>

    <body>
        <?php $page = 'login';?>

        <!--Start Navigation Bar-->
        <?php include './Includes/MobileNavBar.php';?>
        <!--End Navigation Bar-->


        <!--Start Navigation Bar @media 1200px-->
        <?php include './Includes/PcNavBar.php';?>
        <!--End Navigation Bar @media 1200px-->


        <!--Start Background Image-->
        <div class="bg-image-container">
            <div class="bg-image"></div>
        </div>
        <!--End Background Image-->

        
        <!--Start Login Panel-->
        <div class="login-page">
            <div class="form">
                <div class="login">
                    <div class="login-header">
                        <h3>LOGIN</h3>
                        <p>Please enter your credentials to login</p>
                    </div>
                </div>

                <form class="login-form" method="post" actions="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input type="text" name="uname" placeholder="Username" value="<?php echo $uname;?>"/>
                    <input type="password" name="password" placeholder="Password"/>
                    <span class="Password-Error"><?php if($errCriteria != ""){echo "$errCriteria <br><br>";}?></span>
                    
                    <button>login</button>
                    <p class="message">Not registered? <a  data-bs-toggle="modal" data-bs-target="#myModal">Create an account</a></p>
                    <br><span class="forget-text"><a href="forgetPassword.php">Forgot Password?</a></span>

                </form>
                
            </div>
        </div>
        <!--End Login Panel-->
        <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="register_admin">
                                    <a href="adregister.php">Admin</a>
                                </div>
                            </div>
                            <div>
                                <div class="register_admin">
         
                                    <a href="registration.php">User</a>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
    </body>
    
</html>