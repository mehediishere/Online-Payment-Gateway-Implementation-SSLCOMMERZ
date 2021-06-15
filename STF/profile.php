<?php
    session_start();
    include'db.php';
    
    if(isset($_COOKIE['userC'])){
        header("location:order.php");
    }
    
    $status = 0;
    if(isset($_POST['submit-login'])){
        $eml = $_POST['eml'];
        $pas = $_POST['pas'];
        $sql = "SELECT * FROM `user` WHERE email = '$eml'";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $email2 = $row['email'];
                    $password2 = $row['pass'];
                    if($eml = $email2 && $pas = $password2){
                        // $_SESSION["user"] = $row['email'];
                        setcookie("userC", json_encode($row['email']), time() + 86400,'/');
                        header("location:order.php");
                    }
                    else{
                        // echo "<script> alert('Something went wrong. $email2 && $password2'); </script>";
                        $status = 1;
                    }
                }
            } else{
                $status = 1;
            }
        } else{
            header("location:profile.php");
        }
    }

    if(isset($_POST['submit-signup'])){
        $emlS = $_POST['s-eml'];
        $pasS = $_POST['s-pas'];
        $pasSC = $_POST['s-pasC'];
        if($pasS != $pasSC){
            $status = 2;
        }else{
            $userSQL = "INSERT INTO user (`email`, `pass`) VALUES ('$emlS', '$pasS')";
            if(mysqli_query($conn, $userSQL))
            {
                $status = 3;
            }
            else{
                $status = 4;
            }
        }
    }


    if(!empty($_SESSION["shopping_cart"])) {
        $cart_count = count(array_keys($_SESSION["shopping_cart"]));
    }else{
        $cart_count = 0;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>STF</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jaldi:400,700&amp;subset=devanagari">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body style="overflow-y: visible;">
    <script>
        <?php if($status == 1){ ?>
            Swal.fire({
                icon: 'error',
                title: 'Invalid user input!',
                showCloseButton: true,
                showConfirmButton: false,
                allowOutsideClick: false
            })
        <?php
            $status = 0; 
            }elseif($status == 2){?>
                Swal.fire({
                    icon: 'warning',
                    title: 'Password mismatched!',
                    showCloseButton: true,
                    showConfirmButton: false,
                    allowOutsideClick: false
                })  
            <?php $status = 0;
            }elseif($status == 3){?>
                Swal.fire({
                    icon: 'success',
                    title: 'Registration successfull!',
                    showCloseButton: true,
                    showConfirmButton: false,
                    allowOutsideClick: false
                })
            <?php $status = 0;  
            }elseif($status == 4){?>
                Swal.fire({
                    icon: 'error',
                    title: 'Registration failed!',
                    text: 'Your may already registered with this email!',
                    showCloseButton: true,
                    showConfirmButton: false,
                    allowOutsideClick: false
                })
            <?php $status = 0;  
            }
        ?>
    </script>
    <nav class="navbar navbar-light navbar-expand-md navbar-bg-color" style="background: rgb(253, 249, 246);">
        <div class="container"><a class="navbar-brand" href="#">S T F</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ml-auto mr-2" id="nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#product">Food</a></li>
                    <li class="nav-item"><a class="nav-link active" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.php">Cart&nbsp;<span class="badge badge-secondary"><?php echo $cart_count; ?></span></a></li>
                </ul><i class="fas fa-search" style="color: var(--gray);"></i><input type="search" class="form-control src-nav">
            </div>
        </div>
    </nav><!-- Start: login section -->
    <section>
        <div class="container" id="login-display">
            <!-- Start: Login div -->
            <form action="" method="POST">
                <div class="d-flex flex-column justify-content-center mb-4 login-signup-box" id="login-box">
                    <div class="login-box-header">
                        <h4 style="color:rgb(139,139,139);margin-bottom:0px;font-weight:400;font-size:27px;">Login</h4>
                    </div>
                    <div class="login-box-content">
                        <div class="fb-login box-shadow"><a class="d-flex flex-row align-items-center social-login-link" href="#"><i class="fa fa-facebook" style="margin-left:0px;padding-right:20px;padding-left:22px;width:56px;"></i>Login with Facebook</a></div>
                        <div class="gp-login box-shadow"><a class="d-flex flex-row align-items-center social-login-link" style="margin-bottom:10px;" href="#"><i class="fa fa-google" style="color:rgb(255,255,255);width:56px;"></i>Login with Google+</a></div>
                    </div>
                    <div class="d-flex flex-row align-items-center login-box-seperator-container">
                        <div class="login-box-seperator"></div>
                        <div class="login-box-seperator-text">
                            <p style="margin-bottom:0px;padding-left:10px;padding-right:10px;font-weight:400;color:rgb(201,201,201);">or</p>
                        </div>
                        <div class="login-box-seperator"></div>
                    </div>
                    <div class="email-login" style="background-color:#ffffff;">
                        <input type="email" class="email-imput form-control" style="margin-top:10px;" required="" placeholder="Email" minlength="6" name="eml">
                        <input type="password" class="password-input form-control" style="margin-top:10px;" required="" placeholder="Password" minlength="6" name="pas">
                    </div>
                    <div class="submit-row" style="margin-bottom:8px;padding-top:0px;">
                        <button class="btn btn-warning btn-block box-shadow submit-id-submit" id="submit-login" name="submit-login" type="submit">Login</button>
                        <div class="d-flex justify-content-between">
                            <div class="form-check form-check-inline" id="form-check-rememberMe"><input class="form-check-input" type="checkbox" id="formCheck-1" for="remember" style="cursor:pointer;" name="check"><label class="form-check-label" for="formCheck-1"><span class="label-text">Remember Me</span></label></div><a id="forgot-password-link" href="#">Forgot Password?</a>
                        </div>
                    </div>
                    <div id="login-box-footer" style="padding:10px 20px;padding-bottom:23px;padding-top:18px;">
                        <p style="margin-bottom:0px;">Don't you have an account?<a id="register-link" class="register-link" href="#">Sign Up!</a></p>
                    </div>
                </div><!-- End: Login div -->
            </form>
        </div>
    </section><!-- End: login section -->

    <!-- Start: signUp section -->
    <section>
        <div class="container" id="signup-display" style="display: none;">
            <!-- Start: signUp div -->
            <form action="" method="POST">
                <div class="d-flex flex-column justify-content-center mb-4 login-signup-box" id="signup-box">
                    <div class="login-box-header">
                        <h4 style="color:rgb(139,139,139);margin-bottom:0px;font-weight:400;font-size:27px;">Sign Up</h4>
                    </div>
                    <div class="login-box-content">
                        <div class="fb-login box-shadow"><a class="d-flex flex-row align-items-center social-login-link" href="#"><i class="fa fa-facebook" style="margin-left:0px;padding-right:20px;padding-left:22px;width:56px;"></i>SignUp with Facebook</a></div>
                        <div class="gp-login box-shadow"><a class="d-flex flex-row align-items-center social-login-link" style="margin-bottom:10px;" href="#"><i class="fa fa-google" style="color:rgb(255,255,255);width:56px;"></i>SignUp with Google+</a></div>
                    </div>
                    <div class="d-flex flex-row align-items-center login-box-seperator-container">
                        <div class="login-box-seperator"></div>
                        <div class="login-box-seperator-text">
                            <p style="margin-bottom:0px;padding-left:10px;padding-right:10px;font-weight:400;color:rgb(201,201,201);">or</p>
                        </div>
                        <div class="login-box-seperator"></div>
                    </div>
                    <div class="email-login" style="background-color:#ffffff;">
                        <input type="email" class="email-imput form-control" style="margin-top:10px;" required="" placeholder="Email" name="s-eml">
                        <input type="password" class="password-input form-control" style="margin-top:10px;" required="" placeholder="Password" minlength="6" name="s-pas">
                        <input type="password" class="password-input form-control" style="margin-top:10px;" required="" placeholder="Confirm Password" minlength="6" name="s-pasC">
                    </div>
                    <div class="submit-row" style="margin-bottom:8px;padding-top:0px;">
                        <button class="btn btn-warning btn-block box-shadow submit-id-submit" id="submit-signup" type="submit" name="submit-signup">Sign Up</button>
                    </div>
                    <div id="login-box-footer" style="padding:10px 20px;padding-bottom:23px;padding-top:18px;">
                        <p style="margin-bottom:0px;">Already you have an account?<a id="login-link" class="register-link" href="#">Login!</a></p>
                    </div>
                </div><!-- End: signUp div -->
            </form>
        </div>
    </section><!-- End: signUp section -->

    <!-- Start: Footer Dark -->
    <footer class="footer-dark">
        <div class="container">
            <div class="row">
                <!-- Start: Services -->
                <div class="col-sm-6 col-md-3 item">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="#">Open 24/7</a></li>
                        <li><a href="#">Contact : +880***</a></li>
                        <li><a href="#">stf@main.com</a></li>
                    </ul>
                </div><!-- End: Services -->
                <!-- Start: About -->
                <div class="col-sm-6 col-md-3 item">
                    <h3>About</h3>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Our Chef</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div><!-- End: About -->
                <!-- Start: Footer Text -->
                <div class="col-md-6 item text">
                    <h3>S T F - Your Choice, Our Responsibility</h3>
                    <p>Praesent sed lobortis mi. Suspendisse vel placerat ligula. Vivamus ac sem lacus. Ut vehicula rhoncus elementum. Etiam quis tristique lectus. Aliquam in arcu eget velit pulvinar dictum vel in justo.</p>
                </div><!-- End: Footer Text -->
                <!-- Start: Social Icons -->
                <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div><!-- End: Social Icons -->
            </div><!-- Start: Copyright -->
            <p class="copyright">STF © 2021</p><!-- End: Copyright -->
        </div>
    </footer><!-- End: Footer Dark --><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var el = document.getElementById('register-link');
    el.onclick = showFoo;

    var el2 = document.getElementById('login-link');
    el2.onclick = showFoo2;

    function showFoo() {
        document.getElementById("signup-display").style.display = "block";
        console.log("good");
        document.getElementById("login-display").style.display = "none";
    }
    function showFoo2() {
        document.getElementById("login-display").style.display = "block";
        document.getElementById("signup-display").style.display = "none";
        console.log("good2");
    }
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>