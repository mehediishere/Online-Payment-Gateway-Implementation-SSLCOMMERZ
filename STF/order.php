<?php
    session_start();
    include'db.php';
    
    if($_COOKIE['userC'] == null){
        header("location:profile.php");
    }

    if(isset($_POST['logout'])){
        setcookie("userC", '', time() - 86400, '/');
        // unset($_COOKIE['userC']);
        header("location:profile.php");
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
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-bg-color" style="background: rgb(253, 249, 246);">
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
    </nav><!-- Start: order list section -->
    <section style="margin: 4rem 0rem 0rem; min-height:80vh;">
        <div class="container">
            <form action="" method="POST">
                <div class="d-flex justify-content-between">
                    <h5>User : <?php if($_COOKIE['userC'] != null) echo $_COOKIE['userC']; ?></h5> 
                    <button type="submit" name="logout" class="btn btn-info-outline">Log out</button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>#ORDER</th>
                            <th>INVOICE</th>
                            <th>AMOUNT</th>
                            <th>Tran. Id</th>
                            <th>Delivery</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user = $_COOKIE['userC'];
                            $orderSql = "SELECT * FROM `mhorder` WHERE user=$user";
                            $result = mysqli_query($conn, $orderSql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                
                        ?>
                        <tr class="text-center">
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['invoice']; ?></td>
                            <td><?php echo $row['total']; ?></td>
                            <td><?php echo $row['paymentId']; ?></td>
                            <td>On The Way</td>
                        </tr>
                        <?php
                                }
                            } else { echo "No results were found!!? "; }
                            // $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section><!-- End: order list section -->
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
    </footer><!-- End: Footer Dark -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>