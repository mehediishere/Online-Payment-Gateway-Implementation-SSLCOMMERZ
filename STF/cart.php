<?php
    session_start();
    include'db.php';

    $_SESSION['sumTotal'] = 0;

    if(isset($_POST['inc_'])){
        foreach($_SESSION["shopping_cart"] as $keys => $values)  
        {  
            if($values["item_id"] == $_POST["itemId"])  
            {  
                if($values["item_quantity"] <= 4){
                    // echo '<script> alert("'.$_POST['itemId'].' '.$_POST['qty'].'"); </script>';
                    $_SESSION["shopping_cart"][$keys]["item_quantity"]++;
                    //writeMsg();
                }
            }  
        }

    }

    if(isset($_POST['_dec'])){
        foreach($_SESSION["shopping_cart"] as $keys => $values)  
        {  
            if($values["item_id"] == $_POST["itemId"])  
            {  
                if($values["item_quantity"] > 1){
                    // echo '<script> alert("'.$_POST['itemId'].' '.$_POST['qty'].'"); </script>';
                    $_SESSION["shopping_cart"][$keys]["item_quantity"]--;
                    //writeMsg();
                }
            }  
        }

    }

    function writeMsg() {
        foreach($_SESSION["shopping_cart"] as $keys => $values){
            $_SESSION['sumTotal'] += $values["item_price"]*$values["item_quantity"];
        }
        // echo '<script> alert("'.$_SESSION['sumTotal'].'"); </script>';
    }
    if(isset($_SESSION["shopping_cart"])){
        writeMsg();
    }

    if(isset($_POST["remove_item"]))  
    {  
              foreach($_SESSION["shopping_cart"] as $keys => $values)  
              {  
                   if($values["item_id"] == $_POST["product_id"])  
                   {  
                        unset($_SESSION["shopping_cart"][$keys]);   
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
    <link rel="stylesheet" href="./assets/css/cart.css">
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
                    <li class="nav-item"><a class="nav-link scroll" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link scroll" href="index.php#product">Food</a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link active" href="cart.php">Cart&nbsp;<span class="badge badge-secondary"><?php echo $cart_count; ?></span></a></li>
                </ul><i class="fas fa-search" style="color: var(--gray);"></i><input type="search" class="form-control src-nav">
            </div>
        </div>
    </nav>
    <div class="container-fluid" style="margin-top: 6rem;">
        <h2 class="mb-5 text-center">Shopping Cart</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="table-responsive">
                    <?php
                        if(isset($_SESSION["shopping_cart"])){
                    ?>
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th class="text-right">
                                    <span id="amount" class="amount">Amount</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php		
                                foreach ($_SESSION["shopping_cart"] as $product){
                            ?>
                            <tr>
                                <td>
                                    <div class="product-img">
                                        <div class="img-prdct">
                                            <img src="<?php echo $product["item_image"]; ?>" alt="coffee">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p><?php echo $product["item_name"]; ?></p>
                                </td>
                                <td>
                                    <form action="" method="POST">
                                        <div class="button-container">
                                            <input type="hidden" name="itemId" value="<?php echo $product["item_id"]; ?>">
                                            <button class="cart-qty-plus" type="submit" value="+" name="inc_">+</button>
                                            <input type="text" name="qty" min="1" class="qty form-control" value="<?php echo $product["item_quantity"]; ?>" />
                                            <button class="cart-qty-minus" type="submit" value="-" name="_dec">-</button>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <input type="text" value="<?php echo $product["item_price"]; ?>" class="price form-control" disabled>
                                        <form method='POST' action=''>
                                            <input type='hidden' name='product_id' value="<?php echo $product["item_id"]; ?>" />
                                            <button type='submit' class='btn btn-none' name="remove_item"><i class="fas fa-trash" style="color: red;"></i></button>
                                        </form>
                                    </div>
                                </td>
                                <td align="right">$ <span id="amount" class="amount"><?php echo $product["item_price"]*$product["item_quantity"]; ?></span>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <?php
                            }else{
                            echo "<h3>Your cart is empty!</h3>";
                            }
                        ?>
                        <tfoot class="text-right">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div>
                                        <p>Discount (-)</p>
                                        <p>Shipping (+)</p>
                                        <p>Total</p>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <p>0%</p>
                                        <p>0 Tk</p>
                                        <p><?php if(isset($_SESSION['sumTotal']) || !empty($_SESSION['sumTotal'])) echo $_SESSION['sumTotal']; ?> Tk</p>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <form action="checkout.php" method="POST">
                    <div class="text-right d-flex justify-content-end mb-5">
                        <input type="hidden" class="grandTotal" value="<?php echo $_SESSION['sumTotal'];?>" name="grandTotal">
                        <input type="hidden" value="30" name="shippingCost">
                        <button name="submit-totalAmount" class="btn btn-secondary btn-block" type="submit" style="max-width: 200px;">Checkout&nbsp;<i class="far fa-arrow-alt-circle-right"></i></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<!-- <script src="./assets/js/cart.js"></script> -->
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>

</html>