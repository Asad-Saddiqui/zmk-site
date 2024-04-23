<?php
session_start();
require('../admin/config/config.php');

include('./validateUser.php');
if (!isset($_SESSION['agentEmail'])) {
    header("location:../login.php");
}
$validate = validate($_SESSION['agentEmail'], $_SESSION['agentID'], $con);
if ($validate !== true) {
    header("location:../login.php");
}

if ($_SERVER['REQUEST_METHOD'] = 'POST') {

    if (isset($_POST['submit'])) {
        if (isset($_SESSION['cart'])) {

            $myitem = array_column($_SESSION['cart'], 'id');
            if (in_array($_POST['id'], $myitem)) {
                header('location:membership.php');
            } else {
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count] = array(
                    'name' => $_POST['name'],
                    'price' => $_POST['price'],
                    'duration' => $_POST['duration'],
                    'quantity' => $_POST['quantity'],
                    'totalprice_' => $_POST['quantity'] * $_POST['price'],
                    'id' => $_POST['id']
                );
                header('location:membership.php');
            }
        } else {
            $_SESSION['cart'][0] = array(
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'duration' => $_POST['duration'],
                'quantity' => $_POST['quantity'],
                'totalprice_' => $_POST['quantity'] * $_POST['price'],
                'id' => $_POST['id']
            );
            header('location:membership.php');
        }
    }
    if (isset($_POST['remove'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['id'] === $_POST['id_remove']) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                header('location:membership.php');
            }
        }
    }
    if (isset($_POST['mode_quantity'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['id'] === $_POST['id_remove']) {
                $_SESSION['cart'][$key]['quantity'] = $_POST['mode_quantity'];
                $_SESSION['cart'][$key]['totalprice_'] = $_POST['mode_quantity'] * $_SESSION['cart'][$key]['price'];

                header('location:membership.php');
            }
        }
    }
    function test_input1($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_POST['makepurchase'])) {
        $PRICE = test_input1($_POST['PRICE']);
        $ACTYPE = test_input1($_POST['ACTYPE']);
        $TID = test_input1($_POST['TID']);
        if (!empty($PRICE) && !empty($ACTYPE) && !empty($TID)) {
            $uid = $_SESSION['agentID'];
            $sqlQuery = "INSERT INTO `purchasecart` (`id`, `uid`, `varify`, `date`, `price`, 
            `cardnumber`, `transectionID`) 
            VALUES (NULL, '$uid', '0', current_timestamp(), '$PRICE', '$ACTYPE', '$TID')";
            $result = mysqli_query($con, $sqlQuery);
            $iserted_id = mysqli_insert_id($con);
            foreach ($_SESSION['cart'] as $key => $value) {
                $Quantity = $value['quantity'];
                $cid = $value['id'];

                $query__0 = "SELECT * FROM oder WHERE cid = '$cid' and uid='$uid'";
                $sqlRes = mysqli_query($con, $query__0);
                $sql_row = mysqli_num_rows($sqlRes);
                // if ($sql_row ===1 ) {
                //     $sql_row_ = mysqli_fetch_assoc($sqlRes);
                //     $quantity = $sql_row_['varify'] + $Quantity;
                //     $cartprice = $value['totalprice_'];
                //     $sqlcard = "UPDATE `oder` SET `varify` = '$quantity' WHERE `oder`.`cid` = '$cid' AND uid='$uid'";
                //     $res = mysqli_query($con, $sqlcard);
                //     if ($res) {
                //         unset($_SESSION['cart']);
                //         header('location:membership.php');
                //     }
                // } else {
                $cartprice = $value['totalprice_'];
                $sqlcard = "INSERT INTO `oder` (`id`, `uid`, `purchaseID`, `Totalprice`, `Quantity`, `cid`, `varify`, `date`)
                    VALUES (NULL, '$uid', '$iserted_id', '$cartprice', '0', '$cid', '$Quantity', current_timestamp());";
                $res = mysqli_query($con, $sqlcard);
                if ($res) {
                    unset($_SESSION['cart']);
                    header('location:membership.php');
                    // }
                }
            }
        } else {
            header('location:membership.php');
        }
    }
    
    if (isset($_POST['freetrial'])) {
        
                $uid = $_SESSION['agentID'];
                $sqlQuery = "INSERT INTO `purchasecart` (`id`, `uid`, `varify`, `date`, `price`, 
                    `cardnumber`, `transectionID`) 
                    VALUES (NULL, '$uid', '0', current_timestamp(), '0', '0', 'Free')";
                $result = mysqli_query($con, $sqlQuery);
                $iserted_id = mysqli_insert_id($con);
                
                 $query_trial = "SELECT * FROM trial WHERE uid = '$uid'";
                    $sqlRestrial = mysqli_query($con, $query_trial);
                $sql_row = mysqli_num_rows($sqlRestrial);
              
                if($sql_row<5){
                    $remaim=5-(int)$sql_row;
                   $cartItems = array_slice($_SESSION['cart'], 0, $remaim);
                  foreach ($cartItems as $key => $value) {
                    $cid = $value['id'];
                     mysqli_query($con,"INSERT INTO `trial` (`trid`, `uid`, `cid`, `date`) VALUES (NULL, '$uid', '$cid', current_timestamp());");
                    $Quantity = $value['quantity'];
                    $query__0 = "SELECT * FROM oder WHERE cid = '$cid' and uid='$uid'";
                    $sqlRes = mysqli_query($con, $query__0);
                    $sql_row = mysqli_num_rows($sqlRes);
                   
                    $cartprice = $value['totalprice_'];
                    $sqlcard = "INSERT INTO `oder` (`id`, `uid`, `purchaseID`, `Totalprice`, `Quantity`, `cid`, `varify`, `date`)
                        VALUES (NULL, '$uid', '$iserted_id', 'Free', '1', '$cid', '0', current_timestamp());";
                    $res = mysqli_query($con, $sqlcard);
                    if ($res) {
                        unset($_SESSION['cart']);
                        header('location:membership.php');
                        
                    }
                } 
            }else{
                 header('location:membership.php');
            }
            
        
    }


}
