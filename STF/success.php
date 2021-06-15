<?php
    include'db.php';

    $cartProduct = json_decode($_COOKIE['shopping_cartC'], true);
    $sumTotal = json_decode($_COOKIE['sumTotalC'],true);
    // $user = json_decode($_COOKIE['userC'],true);
    $user = $_GET['us'];
    if(isset($cartProduct) && isset($sumTotal) && isset($user)){

        $val_id=urlencode($_POST['val_id']);
        $store_id=urlencode("mhltd60c346c4d6fee");
        $store_passwd=urlencode("mhltd60c346c4d6fee@ssl");
        $requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");
        
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $requested_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC
        
        $result = curl_exec($handle);
        
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        
        if($code == 200 && !( curl_errno($handle)))
        {
        
            # TO CONVERT AS ARRAY
            # $result = json_decode($result, true);
            # $status = $result['status'];
        
            # TO CONVERT AS OBJECT
            $result = json_decode($result);
        
            # TRANSACTION INFO
            $status = $result->status;
            $tran_date = $result->tran_date;
            $tran_id = $result->tran_id;
            $val_id = $result->val_id;
            $amount = $result->amount;
            $store_amount = $result->store_amount;
            $bank_tran_id = $result->bank_tran_id;
            $card_type = $result->card_type;
        
            # EMI INFO
            $emi_instalment = $result->emi_instalment;
            $emi_amount = $result->emi_amount;
            $emi_description = $result->emi_description;
            $emi_issuer = $result->emi_issuer;
        
            # ISSUER INFO
            $card_no = $result->card_no;
            $card_issuer = $result->card_issuer;
            $card_brand = $result->card_brand;
            $card_issuer_country = $result->card_issuer_country;
            $card_issuer_country_code = $result->card_issuer_country_code;
        
            # API AUTHENTICATION
            $APIConnect = $result->APIConnect;
            $validated_on = $result->validated_on;
            $gw_version = $result->gw_version;

        } else {  
            echo "Failed to connect with SSLCOMMERZ";
            return;
        }

        // **********************************************

        echo ".$status.' '.$tran_id.";
        echo "<br>";
        print_r($cartProduct);
        echo "<br>";
        echo $user;
        echo "<br>";
        foreach($cartProduct as $pr){
            
            print_r($pr["item_name"]);
            echo "<br>";
        }

        $invoice = mt_rand(1,99999);
        if(isset($cartProduct) && isset($user)){
            foreach ($cartProduct as $product)
            {
                $orderSQL = "INSERT INTO mhorder(invoice, user, item_id, quantity, total, paymentId) VALUES ('$invoice', '$user', '$product[item_id]', '$product[item_quantity]', '$sumTotal', '$tran_id')";
                
                if(mysqli_query($conn, $orderSQL))
                {
                    header("location:order.php");
                    // echo '<script> alert("Alhamdulillah"); </script>';
                }
                else
                {
                    echo '<script> alert("Something went wrong!!"); </script>';
                }
            }
            // setcookie("shopping_cartC", "", time() - 86400, '');
            // setcookie("userC", $_SESSION["user"], time() + 86400);
            // setcookie("sumTotalC", "", time() - 86400, '');
            if(isset($_SESSION["shopping_cart"])){
                echo '<script> alert("Session still there"); </script>';
            }
            header("location:order.php");
        }else
        {
            echo '<script> alert("Order Not Inserted!!"); </script>';
            // header("location:cart.php");
        }
    }else{
        echo "<br>";
        print_r($cartProduct);
        echo "<br>";
        echo $user;
        echo "<br>";
        foreach($cartProduct as $pr){
            
            print_r($pr["item_name"]);
            echo "<br>";
        }
    }

        // *********************************************************
?>