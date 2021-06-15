<?php
        session_start();
        // session_destroy();
        include'db.php';

        $status = 0;
        if(isset($_POST["add_to_cart"]))  
        {
            $result = mysqli_query($conn,"SELECT `image` FROM `coffee` WHERE `id`='$_POST[idx_id]'");
            $row = mysqli_fetch_assoc($result);
            $image = "assets/img/Coffee/".$row['image']; 

             if(isset($_SESSION["shopping_cart"]))  
             {  
                  $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
                  if(!in_array($_POST["idx_id"], $item_array_id))  
                  {  
                       $count = count($_SESSION["shopping_cart"]);
                       $item_array = array(  
                            'item_id' => $_POST["idx_id"],  
                            'item_name' => $_POST["idx_name"],  
                            'item_price' => $_POST["idx_price"],  
                            'item_image' => $image,
                            'item_quantity' => $_POST["idx_quantity"]
                       );  
                       $_SESSION["shopping_cart"][$count] = $item_array;  
                  }  
                  else  
                  {  
                       // echo '<script>alert("Item Already Added")</script>';
                    //    echo '<script>window.location="index.php"</script>';  
                  }
                  header("location:index.php#product");  
             }  
             else  
             {  
                  $item_array = array(  
                       'item_id' => $_POST["idx_id"],  
                       'item_name' => $_POST["idx_name"],  
                       'item_price' => $_POST["idx_price"], 
                       'item_image' => $image, 
                       'item_quantity' => $_POST["idx_quantity"]  
                  );  
                  $_SESSION["shopping_cart"][0] = $item_array;
                  header("location:index.php#product");  
             }  
        }

        if(!empty($_SESSION["shopping_cart"])) {
            $cart_count = count(array_keys($_SESSION["shopping_cart"]));
        }else{
            $cart_count = 0;
        } 

        echo ' <script> function(){ myFun();}; </script> ';
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
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
</head>

<body style="overflow-y: visible;">
    <script>
            if(Cookies.get('categoryTrack') == null || Cookies.get('categoryTrack') == 0){
                Cookies.set('categoryTrack', '1')
            }
    </script>
    <script>
        <?php if($status == 1){ ?>
            Swal.fire({
                // position: 'top-end',
                icon: 'info',
                title: 'Item Already Added',
                showConfirmButton: false,
                timer: 1500
            })
        <?php
            $status = 0; 
            } 
        ?>
    </script>
    <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-bg-color" style="background: rgb(253, 249, 246);">
        <div class="container"><a class="navbar-brand" href="#">S T F</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ml-auto mr-2" id="nav">
                    <li class="nav-item"><a id="hm" class="nav-link active scroll" href="#home">Home</a></li>
                    <li class="nav-item"><a id="fd" class="nav-link scroll" href="#product">Food</a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.php">Cart&nbsp;<span class="badge badge-secondary"><?php echo $cart_count; ?></span></a></li>
                </ul><i class="fas fa-search" style="color: var(--gray);"></i><input type="search" class="form-control src-nav">
            </div>
        </div>
    </nav>
    <!-- Start: Intro -->
    <section id="home" class="intro-section">
        <div class="bgs" style="background-color: rgba(69,69,69,0.5);min-height: 100vh;">
            <div class="container">
                <div class="center-position">
                    <h1 class="text-center" style="color: var(--light);"><strong>Best Quality &amp; Tasty Food</strong><br></h1>
                    <h5 class="text-center" style="color: var(--light);">Your Choice, Our Responsibility</h5>
                    <form>
                        <div class="input-group">
                            <!-- <div class="input-group-prepend">
                                <select class="form-control">
                                    <option value="lo" selected="">Location</option>
                                    <option value="mr">Mirpur</option>
                                    <option value="ut">Uttara</option>
                                    <option value="nk">Noakhali</option>
                                </select>
                            </div> -->
                            <input class="form-control" type="search" style="border-bottom: 5px;">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div><div class="arrow">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </section><!-- End: Intro -->


    <!-- Start: product coffee -->
    <section id="product" style="background: rgb(253,249,246);">
        <div class="container pt-5">
            <h1 style="color: var(--gray-dark);text-align: center;">Our Specialty</h1>
            <h3 style="color: var(--gray-dark);text-align: center;">'A Little Taste of Something More Exotic'</h3><!-- Start: list category till MD -->
            <ul class="list-unstyled d-flex justify-content-center link-nav">
                <li id="li1" class="food-category-active mr-3"><a id="coffeeMenu" class="scroll" href="#product">
                        <div class="food-category-square-Bg"></div>
                        <div class="food-category-round-Bg"><img class="food-category-img mt-4" src="assets/img/Food%20Category/coffee.png" alt="coffee"></div>
                    </a></li>
                <li id="li2" class="mr-3"><a id="juiceMenu" class="scroll" href="#product">
                        <div class="food-category-square-Bg"></div>
                        <div class="food-category-round-Bg"><img class="food-category-img mt-4" src="assets/img/Food%20Category/juice.png" alt="juice"></div>
                    </a></li>
                <li id="li3" class="mr-3"><a id="saladMenu" class="scroll" href="#product">
                        <div class="food-category-square-Bg"></div>
                        <div class="food-category-round-Bg"><img class="food-category-img mt-4" src="assets/img/Food%20Category/salad.png" alt="salad"></div>
                    </a></li>
                <li id="li4" class="mr-3"><a id="chickenMenu" href="#product">
                        <div class="food-category-square-Bg"></div>
                        <div class="food-category-round-Bg"><img class="food-category-img mt-4" src="assets/img/Food%20Category/chicken.png" alt="chicken"></div>
                    </a></li>
                <li id="li5" class="mr-3"><a id="burgerMenu" href="#product">
                        <div class="food-category-square-Bg"></div>
                        <div class="food-category-round-Bg"><img class="food-category-img mt-4" src="assets/img/Food%20Category/burger.png" alt="burger"></div>
                    </a></li>
                <li id="li6"><a id="pizzaMenu" href="#product">
                        <div class="food-category-square-Bg"></div>
                        <div class="food-category-round-Bg"><img class="food-category-img mt-4" src="assets/img/Food%20Category/pizza.png" alt="pizza"></div>
                    </a></li>
            </ul><!-- End: list category till MD -->
            <!-- Start: coffee row -->
            <div class="row mt-5" id="coffeeRow">
                <?php
                    $getCoffeeQuery = "SELECT * FROM coffee";
                    $result = mysqli_query($conn, $getCoffeeQuery);
                    $n = 1;
                    if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                        if ($n<9) {
                            $image = "assets/img/Coffee/".$row['image'];
                ?>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-3 mt-2">
                        <div class="card" style="color: var(--gray-dark);">
                            <form action="" method="POST">
                                <div class="card-body"><img class="img-fluid" src="<?php echo $image; ?>" alt="coffee">
                                    <input type="hidden" name="idx_id" value="<?php echo $row['id'] ?>">    
                                    <input type="hidden" name="idx_name" value="<?php echo $row['name'] ?>">
                                    <input type="hidden" name="idx_price" value="<?php echo $row['price'] ?>">
                                    <h4 class="card-title"><?php echo $row['name'] ?></h4>
                                    <h6 class="card-title" style="text-align: center;">Tk. <?php echo $row['price'] ?></h6>
                                    <span class="d-flex">
                                        <input name="idx_quantity" type="text" class="form-control" value="1" style="max-width: 60px;">
                                        <button class="btn btn-secondary btn-block" type="submit" name="add_to_cart">ADD</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                        }
                        $n++;
                    }
                    } else {
                    echo "0 results";
                    }
                ?>
            </div><!-- End: coffee row -->
            <!-- Start: juice row -->
            <div class="row mt-5" id="juiceRow">
                <div class="col">
                    <div style="min-height: 200px;">
                        <h1 style="margin-top: 10%;text-align: center;">COMING SOON!!</h1>
                    </div>
                </div>
            </div><!-- End: juice row -->
            <!-- Start: salad row -->
            <div class="row mt-5" id="saladRow">
                <div class="col">
                    <div style="min-height: 200px;">
                        <h1 style="margin-top: 10%;text-align: center;">COMING SOON!!</h1>
                    </div>
                </div>
            </div><!-- End: salad row -->
            <!-- Start: chicken row -->
            <div class="row mt-5" id="chickenRow">
                <div class="col">
                    <div style="min-height: 200px;">
                        <h1 style="margin-top: 10%;text-align: center;">COMING SOON!!</h1>
                    </div>
                </div>
            </div><!-- End: chicken row -->
            <!-- Start: chicken row -->
            <div class="row mt-5" id="burgerRow">
                <div class="col">
                    <div style="min-height: 200px;">
                        <h1 style="margin-top: 10%;text-align: center;">COMING SOON!!</h1>
                    </div>
                </div>
            </div><!-- End: chicken row -->
            <!-- Start: chicken row -->
            <div class="row mt-5" id="pizzaRow">
                <div class="col">
                    <div style="min-height: 200px;">
                        <h1 style="margin-top: 10%;text-align: center;">COMING SOON!!</h1>
                    </div>
                </div>
            </div><!-- End: chicken row -->
        </div>
    </section><!-- End: product coffee -->


    <!-- Start: how it works -->
    <section style="background: rgb(253,249,246);">
        <div class="container" style="padding-top: 5rem;padding-bottom: 5rem;">
            <h3 class="mb-3" style="text-align: center;color: var(--orange);">How It Works</h3>
            <div class="row">
                <div class="col">
                    <div class="card" style="border: none;">
                        <div class="card-body" style="text-align: center;"><i class="fas fa-search htw-icon"></i>
                            <h4 class="card-title">Choose<br></h4>
                            <p class="card-text" style="text-align: center;">Choose a variety of food items from each food menu to ensure intake of.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="border: none;">
                        <div class="card-body" style="text-align: center;"><i class="far fa-credit-card htw-icon"></i>
                            <h4 class="card-title">Order<br></h4>
                            <p class="card-text" style="text-align: center;">Order your desired and tasty food items and pay online or offline.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="border: none;">
                        <div class="card-body" style="text-align: center;"><i class="fas fa-caravan htw-icon"></i>
                            <h4 class="card-title">Home Delivery<br></h4>
                            <p class="card-text" style="text-align: center;">Everything you order at Menorah will be delivered quickly to your door.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End: how it works -->


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
    <script type="text/javascript" src="vanilla-tilt.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="scroll.js"></script>
    <script>
        $('.link-nav li').click(function() {
            $(this).addClass('food-category-active').siblings().removeClass('food-category-active');
        });
    </script>
    <script>
        $(document).ready(function(){
            switch(Cookies.get('categoryTrack')){
                case '1':
                    $('.link-nav li#li1').addClass('food-category-active').siblings().removeClass('food-category-active');
                    break;
                case '2':
                    $('.link-nav li#li2').addClass('food-category-active').siblings().removeClass('food-category-active');
                    break;
                case '3':
                    $('.link-nav li#li3').addClass('food-category-active').siblings().removeClass('food-category-active');
                    break;
                case '4':
                    $('.link-nav li#li4').addClass('food-category-active').siblings().removeClass('food-category-active');
                    break;
                case '5':
                    $('.link-nav li#li5').addClass('food-category-active').siblings().removeClass('food-category-active');
                    break;
                case '6':
                    $('.link-nav li#li6').addClass('food-category-active').siblings().removeClass('food-category-active');
                    break;
                default:
                    break;
            }
        });
    </script>
    <script>
        $(document).ready(function(){
            $("#hm").click(function(){
                $("#fd").removeClass("active");
                $("#hm").addClass("active");
            });
            $("#fd").click(function(){
                $("#hm").removeClass("active");
                $("#fd").addClass("active");
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            myFun();    
        });

        $(document).ready(function(){
            $("#coffeeMenu").click(function(){
                Cookies.set('categoryTrack', '1');
                myFun();
            });

            $("#juiceMenu").click(function(){
                Cookies.set('categoryTrack', '2');
                myFun();
            });

            $("#saladMenu").click(function(){
                Cookies.set('categoryTrack', '3');
                myFun();
            });

            $("#chickenMenu").click(function(){
                Cookies.set('categoryTrack', '4');
                myFun();
            });

            $("#burgerMenu").click(function(){
                Cookies.set('categoryTrack', '5');
                myFun();
            });

            $("#pizzaMenu").click(function(){
                Cookies.set('categoryTrack', '6');
                myFun();
            });
        });

        function myFun(){
            switch(Cookies.get('categoryTrack')){
                case '1': 
                    $("#coffeeRow").show();
                    $("#juiceRow, #saladRow, #chickenRow, #burgerRow, #pizzaRow").hide();
                    break;
                case '2':
                    $("#juiceRow").show();
                    $("#coffeeRow, #saladRow, #chickenRow, #burgerRow, #pizzaRow").hide();
                    break;
                case '3':
                    $("#saladRow").show();
                    $("#coffeeRow, #juiceRow, #chickenRow, #burgerRow, #pizzaRow").hide();
                    break;
                case '4':
                    $("#chickenRow").show();
                    $("#coffeeRow, #juiceRow, #saladRow, #burgerRow, #pizzaRow").hide();
                    break;
                case '5':
                    $("#burgerRow").show();
                    $("#coffeeRow, #juiceRow, #saladRow, #chickenRow, #pizzaRow").hide();
                    break;
                case '6':
                    $("#pizzaRow").show();
                    $("#coffeeRow, #juiceRow, #saladRow, #chickenRow, #burgerRow").hide();
                    break;
                default:
                    break;
            }
        }

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>