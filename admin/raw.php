<?php
session_start();
require("config.php");
////code
$notifi = "";
if (!isset($_SESSION['uname'])) {
    header("location:index.php");
}
if (!isset($_GET['notification'])) {
    $notifi = "";
} else {
    # code...
    $notifi = $_GET['notification'];
}
$abcd = 0;
$iserted = "";
$sell1 = "";
$pro_type = "";
$homevalue = "";
$city = "";
$location = "";
$Size_area = "";
$Area_size_in = "";
$total__price = "";
$Price__type = "";
$ins = "";
$payment_adv = "";
$payment_advence_type = "";
$No_installments = "";
$pyment_monthly = "";
$pyment_monthly_type = "";
$rent__areasize = "";
$rentarea__size = "";
$_monthly__rent = "";
$_monthly_rentIn = "";
$_bedroomsOptions = "";
$__bathroom_option = "";

// ---------City Errors ---------
$vaid3 = "";
$msg3 = "";
$error3 = "";
// ---------Location Errors ---------

$vaid4 = "";
$msg4 = "";
$error4 = "";
// ---------Area  Errors---------

$vaid5 = "";
$msg5 = "";
$error5 = "";

// ---------Area  Errors---------
$vaid6 = "";
$msg6 = "";
$error6 = "";
// ---------Area  Errors---------
$vaid7 = "";
$msg7 = "";
$error7 = "";

///............
$vaid8 = "";
$msg8 = "";
$error8 = "";

$vaid9 = "";
$msg9 = "";
$error9 = "";

$vaid10 = "";
$msg10 = "";
$error10 = "";

$vaid11 = "";
$msg11 = "";
$error11 = "";

$vaid12 = "";
$msg12 = "";
$error12 = "";

$vaid13 = "";
$msg13 = "";
$error13 = "";

$vaid14 = "";
$msg14 = "";
$error14 = "";

$vaid15 = "";
$msg15 = "";
$error15 = "";

$vaid16 = "";
$msg16 = "";
$error16 = "";

$vaid17 = "";
$msg17 = "";
$error17 = "";

$vaid18 = "";
$msg18 = "";
$error18 = "";

$vaid19 = "";
$msg19 = "";
$error19 = "";

$vaid24 = "";
$msg24 = "";
$error24 = "";

$image_type_err = "";
$vaid25 = "";
$msg25 = "";
$error25 = "";

$vaid20 = "";
$vaid22 = "";
$vaid23 = "";
$msg20 = "";
$msg22 = "";
$msg23 = "";
$error20 = "";
$error22 = "";
$error23 = "";




$mainarray = [];
$roomarray = [];
$commarray = [];
$Community_Featuresarray = [];
$HealthcareRecreationalarray = [];
$nearby_locationarray = [];
$Featurearray = [];
$plot_features_initarray = [];
$nearbyLocation = [];
$Other_Facilities = [];
$commerical_main = [];
$commericalRoomsArray = [];
$commericalBussinessarray = [];
$commerical_communityarray = [];
$commerical_HealthcareRecreationalarray = [];
$commerical_nearby_locationarray = [];
$commerical_Featurearray = [];
$p__title = "";
$p__description = "";
$images1 = array();
$youtub_ = array();
$__postingAs__a = "";
$__postingEmail = "";
$__postingNumber__ = "";
$__postingLandline__ = "";
$__plateform__ = "";

function test_input1($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submitadd1'])) {
    $youtub_ = $_POST['youtub'];


    if (empty($_POST["city"])) {
        $vaid3 = "is-invalid";
        $msg3 = "Please Enter City";
        $error3 = "invalid-feedback";
    } else {
        $city1 = test_input1($_POST["city"]);
        if (!preg_match("/^[a-zA-Z0-9-' ]*$/", $city1)) {
            $vaid3 = "is-invalid";
            $msg3 = "Only letters ,numbers and white space allowed";
            $error3 = "invalid-feedback";
        } else {
            $city = test_input1($_POST["city"]);
            $vaid3 = "is-valid";
            $msg3 = "Successfully !";
            $error3 = "valid-feedback";
        }
    }







    if (empty($_POST["location"])) {
        $vaid4 = "is-invalid";
        $msg4 = "Please Enter location";
        $error4 = "invalid-feedback";
    } else {
        $location1 = test_input1($_POST["location"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9-' ]*$/", $location1)) {
            $vaid4 = "is-invalid";
            $msg4 = "Only letters ,numbers and white space allowed";
            $error4 = "invalid-feedback";
        } else {
            $location = test_input1($_POST["location"]);
            $vaid4 = "is-valid";
            $msg4 = "Successfully !";
            $error4 = "valid-feedback";
        }
    }















    if (isset($_POST['options1'])) {
        $sell = $_POST['options1'];
        if ($sell === "Sale") {
            $sell1 = $_POST['options1'];
            if (isset($_POST['property_type'])) {
                $pro_type1 = $_POST['property_type'];
                if ($pro_type1 === "Home") {
                    $pro_type = $_POST['property_type'];
                    if (isset($_POST['home_options2'])) {
                        $homevalue = $_POST['home_options2'];
                    }
                    if (isset($_POST['bedrooms_options'])) {
                        $_bedroomsOptions = $_POST['bedrooms_options'];
                    }

                    if (isset($_POST['bath_room_option'])) {
                        $__bathroom_option = $_POST['bath_room_option'];
                    }

                    ///.................hOME AMENITIE array push allement start.................. 

                    include("../home_posting.php");

                    ///.................hOME AMENITIE array push allement end.................. 





                }
                if ($pro_type1 === "Plot") {
                    $pro_type = $_POST['property_type'];
                    if (isset($_POST['plot_option'])) {
                        $homevalue = $_POST['plot_option'];
                    }
                    /// ....................Plot animities array .............
                    include("../plot_posting.php");

                    /// ....................Plot animities array .............

                }
                if ($pro_type1 === "Commercial") {
                    $pro_type = $_POST['property_type'];
                    if (isset($_POST['commercial_option'])) {
                        $homevalue = $_POST['commercial_option'];
                    }
                    if (isset($_POST['bedrooms_options'])) {
                        $_bedroomsOptions = $_POST['bedrooms_options'];
                    }
                    if (isset($_POST['bath_room_option'])) {
                        $__bathroom_option = $_POST['bath_room_option'];
                    }
                    include("../commerical_posting.php");
                }
            }


            if (empty($_POST["area_size"])) {
                $vaid5 = "is-invalid";
                $msg5 = "Enter area size";
                $error5 = "invalid-feedback";
            } else {
                $area_size1 = test_input1($_POST["area_size"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[0-9-,:']*$/", $area_size1)) {
                    $vaid5 = "is-invalid";
                    $msg5 = "Only numbers and white space allowed";
                    $error5 = "invalid-feedback";
                } else {
                    $Size_area = test_input1($_POST["area_size"]);
                    $vaid5 = "is-valid";
                    $msg5 = "Successfully !";
                    $error5 = "valid-feedback";
                }
            }

            if (!empty($_POST['size_in__'])) {
                $Area_size_in = $_POST['size_in__'];
                $vaid6 = "is-valid";
                $msg6 = "Successfully !";
                $error6 = "valid-feedback";
            } else {
                $vaid6 = "is-invalid";
                $msg6 = "Please select value";
                $error6 = "invalid-feedback";
            }

            // /-------------------------------------------
            if (empty($_POST["t_price_"])) {
                $vaid8 = "is-invalid";
                $msg8 = "Enter total price";
                $error8 = "invalid-feedback";
            } else {
                $t_price_1 = test_input1($_POST["t_price_"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[0-9,']*$/", $t_price_1)) {
                    $vaid8 = "is-invalid";
                    $msg8 = "Only numbers  allowed";
                    $error8 = "invalid-feedback";
                } else {
                    $total__price = test_input1($_POST["t_price_"]);
                    $vaid8 = "is-valid";
                    $msg8 = "Successfully !";
                    $error8 = "valid-feedback";
                }
            }

            if (!empty($_POST['Price_t'])) {
                $Price__type = $_POST['Price_t'];
                $vaid7 = "is-valid";
                $msg7 = "Successfully !";
                $error7 = "valid-feedback";
            } else {
                $vaid7 = "is-invalid";
                $msg7 = "Please select value";
                $error7 = "invalid-feedback";
            }
            // ------------------------------------
            if (isset($_POST['installments'])) {
                $ins = $_POST['installments'];
                if ($ins === "Installment available") {
                    $ins = "Yes avalaible";

                    // /-------------------------------------------
                    if (empty($_POST["advance_amount"])) {
                        $vaid9 = "is-invalid";
                        $msg9 = "Enter advance amount";
                        $error9 = "invalid-feedback";
                    } else {
                        $advance_amount1 = test_input1($_POST["advance_amount"]);
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[0-9,']*$/", $advance_amount1)) {
                            $vaid9 = "is-invalid";
                            $msg9 = "Only numbers  allowed";
                            $error9 = "invalid-feedback";
                        } else {
                            $payment_adv = test_input1($_POST["advance_amount"]);
                            $vaid9 = "is-valid";
                            $msg9 = "Successfully !";
                            $error9 = "valid-feedback";
                        }
                    }

                    if (!empty($_POST['advance_amount_type'])) {
                        $payment_advence_type = $_POST['advance_amount_type'];
                        $vaid10 = "is-valid";
                        $msg10 = "Successfully !";
                        $error10 = "valid-feedback";
                    } else {
                        $vaid10 = "is-invalid";
                        $msg10 = "Please select value";
                        $error10 = "invalid-feedback";
                    }
                    // ------------------------------------













                    $n_installment = trim($_POST["n_installment"]);
                    if (strlen($n_installment) > 0) {
                        $No_installments = $n_installment;
                    }
                    if (empty($_POST["n_installment"])) {
                        $vaid13 = "is-invalid";
                        $msg13 = "Enter advance amount";
                        $error13 = "invalid-feedback";
                    } else {
                        $n_installment1 = test_input1($_POST["n_installment"]);
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[0-9']*$/", $n_installment1)) {
                            $vaid13 = "is-invalid";
                            $msg13 = "Only numbers  allowed";
                            $error13 = "invalid-feedback";
                        } else {
                            $No_installments = test_input1($_POST["n_installment"]);
                            $vaid13 = "is-valid";
                            $msg13 = "Successfully !";
                            $error13 = "valid-feedback";
                        }
                    }













                    if (empty($_POST["monthly_amount"])) {
                        $vaid11 = "is-invalid";
                        $msg11 = "Enter monthly amount";
                        $error11 = "invalid-feedback";
                    } else {
                        $monthly_amount1 = test_input1($_POST["monthly_amount"]);
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[0-9,']*$/", $monthly_amount1)) {
                            $vaid11 = "is-invalid";
                            $msg11 = "Only letters ,numbers and white space allowed";
                            $error11 = "invalid-feedback";
                        } else {
                            $pyment_monthly = test_input1($_POST["monthly_amount"]);
                            $vaid11 = "is-valid";
                            $msg11 = "Successfully !";
                            $error11 = "valid-feedback";
                        }
                    }

                    if (!empty($_POST['monthly_amount_type'])) {
                        $pyment_monthly_type = $_POST['monthly_amount_type'];
                        $vaid12 = "is-valid";
                        $msg12 = "Successfully !";
                        $error12 = "valid-feedback";
                    } else {
                        $vaid12 = "is-invalid";
                        $msg12 = "Please select value";
                        $error12 = "invalid-feedback";
                    }
                }
            } else {
                $vaid9 = "";
                $msg9 = "";
                $error9 = "";

                $vaid10 = "";
                $msg10 = "";
                $error10 = "";

                $vaid11 = "";
                $msg11 = "";
                $error11 = "";

                $vaid12 = "";
                $msg12 = "";
                $error12 = "";
                $vaid13 = " ";
                $msg13 = "";
                $error13 = "";
            }
        }


        if ($sell === "Rent") {
            $sell1 = $_POST['options1'];
            if (isset($_POST['property_type'])) {
                $pro_type1 = $_POST['property_type'];
                if ($pro_type1 === "Home") {
                    $pro_type = $_POST['property_type'];

                    if (isset($_POST['home_options2'])) {
                        $homevalue = $_POST['home_options2'];
                    }
                    if (isset($_POST['bedrooms_options'])) {
                        $_bedroomsOptions = $_POST['bedrooms_options'];
                    }
                    if (isset($_POST['bath_room_option'])) {
                        $__bathroom_option = $_POST['bath_room_option'];
                    }
                    include("../home_posting.php");
                }
                if ($pro_type1 === "Plot") {
                    $pro_type = $_POST['property_type'];
                    if (isset($_POST['plot_option'])) {
                        $homevalue = $_POST['plot_option'];
                    }
                    include("../plot_posting.php");
                }
                if ($pro_type1 === "Commercial") {
                    $pro_type = $_POST['property_type'];
                    if (isset($_POST['commercial_option'])) {
                        $homevalue = $_POST['commercial_option'];
                    }
                    if (isset($_POST['bedrooms_options'])) {
                        $_bedroomsOptions = $_POST['bedrooms_options'];
                    }
                    if (isset($_POST['bath_room_option'])) {
                        $__bathroom_option = $_POST['bath_room_option'];
                    }
                    include("../commerical_posting.php");
                }
            }

            if (empty($_POST["rent_area_size"])) {
                $vaid14 = "is-invalid";
                $msg14 = "Enter area size";
                $error14 = "invalid-feedback";
            } else {
                $rent_area_size1 = test_input1($_POST["rent_area_size"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[0-9-,:']*$/", $rent_area_size1)) {
                    $vaid14 = "is-invalid";
                    $msg14 = "Only numbers and white space allowed";
                    $error14 = "invalid-feedback";
                } else {
                    $Size_area = test_input1($_POST["rent_area_size"]);
                    $vaid14 = "is-valid";
                    $msg14 = "Successfully !";
                    $error14 = "valid-feedback";
                }
            }

            if (!empty($_POST['rent_area_size_in'])) {
                $Area_size_in = $_POST['rent_area_size_in'];
                $vaid15 = "is-valid";
                $msg15 = "Successfully !";
                $error15 = "valid-feedback";
            } else {
                $vaid15 = "is-invalid";
                $msg15 = "Please select value";
                $error15 = "invalid-feedback";
            }

            if (empty($_POST["monthly_rent"])) {
                $vaid16 = "is-invalid";
                $msg16 = "Enter monthly rent";
                $error16 = "invalid-feedback";
            } else {
                $monthly_rent1 = test_input1($_POST["monthly_rent"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[0-9-,:']*$/", $monthly_rent1)) {
                    $vaid16 = "is-invalid";
                    $msg16 = "Only numbers and white space allowed";
                    $error16 = "invalid-feedback";
                } else {
                    $total__price = test_input1($_POST["monthly_rent"]);
                    $vaid16 = "is-valid";
                    $msg16 = "Successfully !";
                    $error16 = "valid-feedback";
                }
            }


            if (!empty($_POST['monthly_rent_in'])) {
                $Price__type = $_POST['monthly_rent_in'];
                $vaid17 = "is-valid";
                $msg17 = "Successfully !";
                $error17 = "valid-feedback";
            } else {
                $vaid17 = "is-invalid";
                $msg17 = "Please select value";
                $error17 = "invalid-feedback";
            }
        }
    }
    $p_title_ = $_POST['p_title'];
    // $size_in1 = trim($_POST["size_in"]);
    if (strlen($p_title_) > 0) {
        $p__title = $p_title_;
    }

    // $p__title = "";
    // $p__description = "";
    if (empty($_POST["p_title"])) {
        $vaid18 = "is-invalid";
        $msg18 = "Enter title";
        $error18 = "invalid-feedback";
    } else {
        $p_title1 = test_input1($_POST["p_title"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9-' ]*$/", $p_title1)) {
            $vaid18 = "is-invalid";
            $msg18 = "Only letters, numbers and white space allowed";
            $error18 = "invalid-feedback";
        } else {
            $p__title = test_input1($_POST["p_title"]);
            $vaid18 = "is-valid";
            $msg18 = "Successfully !";
            $error18 = "valid-feedback";
        }
    }

    if (empty($_POST["description"])) {
        $vaid19 = "is-invalid";
        $msg19 = "Enter description";
        $error19 = "invalid-feedback";
    } else {
        $description1 = test_input1($_POST["description"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9- ' ]*$/", $description1)) {
            $vaid19 = "is-invalid";
            $msg19 = "Only letters, numbers and white space allowed";
            $error19 = "invalid-feedback";
        } else {
            $p__description = test_input1($_POST["description"]);
            $vaid19 = "is-valid";
            $msg19 = "Successfully !";
            $error19 = "valid-feedback";
        }
    }






    //   .................Images upload multiple start.......................
    // File upload configuration 
    $targetDir = "../images/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF', 'webp', 'WEBP');
    // $allowTypes = array('mp4','MP$','ogg','OGG'); 
    $fileNames = array_filter($_FILES['imgfiles']['name']);

    if (!empty($fileNames)) {
        foreach ($_FILES['imgfiles']['name'] as $key => $val) {
            // File upload path 
            $fileName = basename($_FILES['imgfiles']['name'][$key]);


            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                if ($abcd < 10) {
                    $abcd = $abcd + 1;
                    // Upload file to server 
                    if (move_uploaded_file($_FILES["imgfiles"]["tmp_name"][$key], $targetFilePath)) {

                        array_push($images1, $fileName);
                        //     $msg25 = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        //     <strong>Success !</strong> Images Selected!

                        // </div>';


                    }
                }
            } else {
                $msg25 = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning !</strong> allow olny "jpg","png","jpeg","gif","JPG" images
                
            </div>';
            }
        }
    } else {
        $msg25 = "Select File to upload";
        $msg25 = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Danger !</strong> Select Images to upload
        
    </div>';
    }
    //   .................Images upload multiple end.......................


    //   .................video upload multiple start.......................
    // File upload configuration 
    // $targetDir = "../videos/";
    //    $allowTypes = array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF','webp','WEBP'); 
    // $allowTypes = array('mp4', 'MP4', 'ogg', 'OGG');
    // $videofile1 = array_filter($_FILES['videofiles']['name']);

    // if (!empty($videofile1)) {
    //     foreach ($_FILES['videofiles']['name'] as $key => $val) {
    //         // File upload path 
    //         $fileName = basename($_FILES['videofiles']['name'][$key]);


    //         $targetFilePath = $targetDir . $fileName;

    //         // Check whether file type is valid 
    //         $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    //         if (in_array($fileType, $allowTypes)) {
    //             // Upload file to server 
    //             if (move_uploaded_file($_FILES["videofiles"]["tmp_name"][$key], $targetFilePath)) {

    //                 array_push($videos1, $fileName);
    //             }
    //         } else {
    //             // $msg25 = "allow olny jpg','png','jpeg','gif','JPG' images";
    //             // $error25 = "invalid-feedback";
    //         }
    //     }
    // } else {
    //     // $vaid19 = "is-invalid";
    //     // $msg25 = "Select File to upload";
    //     // $error25 = "invalid-feedback"; 
    // }
    //   .................Images upload multiple end.......................


    if (empty($_POST["posting_as_a"])) {
        $vaid20 = "is-invalid";
        $msg20 = "Enter title";
        $error20 = "invalid-feedback";
    } else {
        $posting_as_a1 = test_input1($_POST["posting_as_a"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z' ]*$/", $posting_as_a1)) {
            $vaid20 = "is-invalid";
            $msg20 = "Only letters and white space allowed";
            $error20 = "invalid-feedback";
        } else {
            $__postingAs__a = test_input1($_POST["posting_as_a"]);
            $vaid20 = "is-valid";
            $msg20 = "Successfully !";
            $error20 = "valid-feedback";
        }
    }




    if (empty($_POST["posting_email"])) {
        $vaid22 = "is-invalid";
        $msg22 = "Enter email";
        $error22 = "invalid-feedback";
    } else {
        $posting_email1 = test_input1($_POST["posting_email"]);
        // check if e-mail address is well-formed
        if (!filter_var($posting_email1, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $vaid22 = "is-invalid";
            $msg22 = "Invalid email";
            $error22 = "invalid-feedback";
        } else {
            $vaid22 = "is-valid";
            $msg22 = "Success";
            $error22 = "valid-feedback";
            $__postingEmail = $posting_email1;
        }
    }








    if (empty($_POST["posting_number"])) {
        $vaid23 = "is-invalid";
        $msg23 = "Enter posting number";
        $error23 = "invalid-feedback";
    } else {
        $posting_number1 = test_input1($_POST["posting_number"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9']*$/", $posting_number1)) {
            $vaid23 = "is-invalid";
            $msg23 = "Only numbers allowed";
            $error23 = "invalid-feedback";
        } else {
            $__postingNumber__ = test_input1($_POST["posting_number"]);
            $vaid23 = "is-valid";
            $msg23 = "Successfully !";
            $error23 = "valid-feedback";
        }
    }





    if (empty($_POST["posting_landline"])) {
        $vaid24 = "is-invalid";
        $msg24 = "Enter Landline number";
        $error24 = "invalid-feedback";
    } else {
        $posting_landline1 = test_input1($_POST["posting_landline"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9']*$/", $posting_landline1)) {
            $vaid24 = "is-invalid";
            $msg24 = "Only numbers allowed";
            $error24 = "invalid-feedback";
        } else {
            $__postingLandline__ = test_input1($_POST["posting_landline"]);
            $vaid24 = "is-valid";
            $msg24 = "Successfully !";
            $error24 = "valid-feedback";
        }
    }




    if (isset($_POST['plateform'])) {
        $__plateform__ = $_POST['plateform'];
    }

    $mainarray = json_encode($mainarray);
    $mainarray = test_input1($mainarray);

    $roomarray = json_encode($roomarray);
    $roomarray = test_input1($roomarray);

    $commarray = json_encode($commarray);
    $commarray = test_input1($commarray);

    $Community_Featuresarray = json_encode($Community_Featuresarray);
    $Community_Featuresarray = test_input1($Community_Featuresarray);

    $HealthcareRecreationalarray = json_encode($HealthcareRecreationalarray);
    $HealthcareRecreationalarray = test_input1($HealthcareRecreationalarray);

    $nearby_locationarray = json_encode($nearby_locationarray);
    $nearby_locationarray = test_input1($nearby_locationarray);

    $Featurearray = json_encode($Featurearray);
    $Featurearray = test_input1($Featurearray);

    $plot_features_initarray = json_encode($plot_features_initarray);
    $plot_features_initarray = test_input1($plot_features_initarray);

    $nearbyLocation = json_encode($nearbyLocation);
    $nearbyLocation = test_input1($nearbyLocation);

    $Other_Facilities = json_encode($Other_Facilities);
    $Other_Facilities = test_input1($Other_Facilities);

    $commerical_main = json_encode($commerical_main);
    $commerical_main = test_input1($commerical_main);

    $commericalRoomsArray = json_encode($commericalRoomsArray);
    $commericalRoomsArray = test_input1($commericalRoomsArray);

    $commericalBussinessarray = json_encode($commericalBussinessarray);
    $commericalBussinessarray = test_input1($commericalBussinessarray);

    $commerical_communityarray = json_encode($commerical_communityarray);
    $commerical_communityarray = test_input1($commerical_communityarray);

    $commerical_HealthcareRecreationalarray = json_encode($commerical_HealthcareRecreationalarray);
    $commerical_HealthcareRecreationalarray = test_input1($commerical_HealthcareRecreationalarray);

    $commerical_nearby_locationarray = json_encode($commerical_nearby_locationarray);
    $commerical_nearby_locationarray = test_input1($commerical_nearby_locationarray);

    $commerical_Featurearray = json_encode($commerical_Featurearray);
    $commerical_Featurearray = test_input1($commerical_Featurearray);

    $images = json_encode($images1);
    $videos = json_encode($youtub_);
    $ag_id = $_SESSION['uaid'];
    if (
        !empty($city)  & !empty($location) & !empty($Size_area) & !empty($Area_size_in)
        & !empty($total__price) & !empty($Price__type) & !empty($p__title)
        & !empty($p__description) & !empty($__postingAs__a) & !empty($__postingEmail) & !empty($__postingNumber__) & !empty($__postingLandline__) & (strlen($images) > 2) & (strlen($videos) > 4)

    ) {
        # code...

        $sql = "INSERT INTO `property` (`pid`, `propty_purpose`, `propty_type`, `home_value`, `citys`, `location`, 
    `size_area`, `area_size_in_`, `_total_pricce_`, `_price_type`, `install_ment`, `payment_adv`, `payment_adv_type`,
     `number_installment`, `pyment_monthly`, `pyment_monthly_type`, `rent__areasize`, `rentarea__size`, `_monthly__rent`,
      `_monthly_rentIn`, `_bedroomsOptions`, `__bathroom_option`, `mainarray`, `roomarray1`, `commarray`, 
      `Community_Featuresarray`, `HealthcareRecreationalarray`, `nearby_locationarray`, `Featurearray`, 
      `plot_features_initarray`, `nearbyLocation`, `Other_Facilities`, `commerical_main`,
       `commericalRoomsArray`, `commericalBussinessarray`, `commerical_communityarray`,
        `commerical_HealthcareRecreationalarray`, `commerical_nearby_locationarray`,
         `commerical_Featurearray`, `p__title`, `p__description`, `images`, `videos`,
          `__postingAs__a`, `__postingEmail`, `__postingNumber__`, `__postingLandline__`,
           `__plateform__`, `status`, `duration`, `date`,`agent_id`,`user_type`)
            VALUES (NULL, '$sell1', '$pro_type', '$homevalue', '$city', '$location', '$Size_area', '$Area_size_in', '$total__price',
             '$Price__type', '$ins', '$payment_adv', '$payment_advence_type', '$No_installments', '$pyment_monthly', '$pyment_monthly_type', 
             '$rent__areasize', '$rentarea__size', '$_monthly__rent', '$_monthly_rentIn', '$_bedroomsOptions',
              '$__bathroom_option', '$mainarray', '$roomarray', '$commarray', '$Community_Featuresarray', '$HealthcareRecreationalarray',
               '$nearby_locationarray', '$Featurearray', '$plot_features_initarray', '$nearbyLocation', '$Other_Facilities', '$commerical_main',
               '$commericalRoomsArray', '$commericalBussinessarray', '$commerical_communityarray', '$commerical_HealthcareRecreationalarray', '$commerical_nearby_locationarray',
                '$commerical_Featurearray', '$p__title', '$p__description', '$images', '$videos', '$__postingAs__a', '$__postingEmail',
                '$__postingNumber__', '$__postingLandline__', '$__plateform__', 'inactive', '0', current_timestamp(),'$ag_id','admin'); ";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $iserted = 'Data Inserted !';
            header('location:addproperty.php?notification=' . $iserted . '');
            $city = " ";
            $location = " ";
            $Size_area = "";
            $Area_size_in = "";
            $total__price = "";
            $Price__type = "";
            $p__title = "";
            $p__description = "";
            $__postingAs__a = "";
            $__postingEmail = "";
            $__postingNumber__ = "";
            $__postingLandline__ = "";
        }
    } else {
        $iserted = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>warning !</strong>Please Fill  All Fields!
            
         </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Orbit Enterprises</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- datatable linl -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
</head>
<style>
    .dataTables_wrapper .dataTables_length select {
        color: #7b7b7b;
    }
</style>
<style>
    * {
        scrollbar-width: auto;
        scrollbar-color: #EB1616 #191C24;
    }

    /* Chrome, Edge, and Safari */
    *::-webkit-scrollbar {
        width: 16px;
    }

    *::-webkit-scrollbar-track {
        background: #191C24;
    }

    *::-webkit-scrollbar-thumb {
        background-color: #EB1616;
        border-radius: 10px;
        border: 3px solid #191C24;
        height: 50px;
    }

    /* *{
            overflow-x: hidden;
        } */
</style>

<style>
    * {
        scrollbar-width: auto;
        scrollbar-color: #EB1616 #191C24;
    }

    /* Chrome, Edge, and Safari */
    *::-webkit-scrollbar {
        width: 16px;
    }

    *::-webkit-scrollbar-track {
        background: #6C7293;
    }

    *::-webkit-scrollbar-thumb {
        background-color: #6C7293;
        border-radius: 10px;
        border: 3px solid #191C24;
        height: 50px;
    }

    #nav:hover {
        background-color: #d1d1d1;
        ;
    }

    #item:hover {
        background-color: #d1d1d1;
        ;

    }


    #installment1 {
        display: none;
    }

    .btn-check:checked+.btnsecondary {
        color: white;
        ;

        border-color: #000000;
        border-bottom: 2px solid green
    }

    .btn-check1:checked+.btnsecondary1 {
        background-color: #e8e8e8;
        color: #00ae00;

        border: 2px solid #00ae00;
        border-radius: 15px;
        padding: 3px;
    }

    .border1 {
        border: 1px solid black;
        border-radius: 15px;
        padding: 3px;
    }

    .btn-check3:checked+.btnsecondary3 {
        background-color: #e8e8e8;
        color: #00ae00;

        border: 1px solid #00ae00;
        border-radius: 15px;
        padding: 3px;
    }

    .btn-check4:checked+.btnsecondary4 {
        background-color: #e8e8e8;
        color: #00ae00;

        border: 1px solid #00ae00;
        border-radius: 15px;

    }

    .btn-check5:checked+.btnsecondary5 {
        background-color: #e8e8e8;
        color: #00ae00;

        border: 1px solid #00ae00;
        border-radius: 15px;

    }

    .btn-amenities:checked+.amenities {
        background-color: #e8e8e8;
        color: #00ae00;

        border-bottom: 1px solid #00ae00;

    }


    .fade:not(.show) {
        opacity: 1;
    }

    .form-check-input {
        background-color: white;

        width: 24px;
        height: 24px;
    }

    .form-check-input:checked {
        background-color: #178017;
        width: 24px;
        height: 24px;
    }

    .modal-content {
        background-color: #191c24;
    }

    .text-dark {
        color: white;
    }

    input {
        background-color: #191C24;
    }
</style>

<body>

    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <?php
        include("sidebar.php");
        ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php
            include("navbar.php");
            ?>

            <div class="full-row  m-2 rounded bg-secondary">
                <form method="post" enctype="multipart/form-data">

                    <div class="container  rounded">

                        <!--  New Property Form for add a property start -->
                        <div class="container-fluid pt-4 px-4">
                            <div class=" rounded-top p-4 bg-secondary">
                                <div class="row">
                                    <?php
                                    if (!empty($notifi)) {
                                        # code...
                                    ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Success </strong><?php echo $notifi; ?>

                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    // var_dump($plot_features_initarray);
                                    // var_dump($nearbyLocation);
                                    // var_dump($Other_Facilities);
                                    // var_dump($images1);
                                    // var_dump($videos1);

                                    echo $msg25;
                                    echo $iserted;
                                    ?>

                                </div>
                            </div>
                        </div>

                        <div class="container-fluid pt-4 px-4">
                            <div class=" rounded-top p-4 bg-secondary ">
                                <div class="row">


                                    <div class="col-12 col-sm-2 text-center text-sm-start" style="color: white;
                                        font-weight: 900;
                                        font-size:20px;">

                                        Location and Purpose
                                    </div>
                                    <div class="col-12 col-sm-6 text-center text-sm-start">
                                        <i class="fa fa-user me-2"></i> <a href="#" style="color:white;">
                                            Select Purpose</a> <br>



                                        <input type="radio" class="btn-check1" value="Sale" hidden onclick="for_sell()" checked name="options1" id="option5" autocomplete="off">
                                        <label class="btnsecondary1 mx-2 my-2" for="option5" onclick=""><i class="fa fa-home me-2"></i>&nbsp;Sell</label>
                                        <input type="radio" class="btn-check1" hidden onclick="for_rent()" value="Rent" name="options1" id="option4" autocomplete="off">
                                        <label class="btnsecondary1 mx-2 my-2" for="option4" onclick=""> <i class="fa fa-home me-2"></i>&nbsp;Rent</label>
                                        <br>
                                        <br>
                                        <i class="fa fa-building me-2"></i> <a href="#" style="color:white;">
                                            Select Property Type
                                        </a>
                                        <br>
                                        <br>
                                        <input type="radio" class="btn-check" name="property_type" value="Home" id="home_1" autocomplete="off" checked>
                                        <label class="btnsecondary" for="home_1" onclick="myFunction()">&nbsp;Home</label>
                                        <input type="radio" class="btn-check" value="Plot" name="property_type" id="plot_1" autocomplete="off">
                                        <label class="btnsecondary" for="plot_1" onclick="myFunction2()">&nbsp;Plots</label>
                                        <input type="radio" class="btn-check" value="Commercial" name="property_type" id="Commercial_1" autocomplete="off">
                                        <label class="btnsecondary" for="Commercial_1" onclick="myFunction3()">&nbsp;Commercial</label>



                                        <hr>
                                        <div id="home" style="display:block">


                                            <input type="radio" class="btn-check3" hidden checked value="House" name="home_options2" id="option6" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option6" onclick=""> &nbsp;House</label>
                                            <input type="radio" class="btn-check3" hidden value="Flat" name="home_options2" id="option7" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option7" onclick=""> &nbsp;Flat</label>
                                            <input type="radio" class="btn-check3" hidden value="Upper Portion" name="home_options2" id="option8" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option8" onclick=""> &nbsp;Upper Portion</label>
                                            <input type="radio" class="btn-check3" hidden value="Lower Portion" name="home_options2" id="option9" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option9" onclick=""> &nbsp;Lower Portion</label>
                                            <input type="radio" class="btn-check3" hidden value="Farm House" name="home_options2" id="option10" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option10" onclick="">
                                                &nbsp;Farm House</label>
                                            <input type="radio" class="btn-check3" hidden value="Room" name="home_options2" id="option11" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option11" onclick="">
                                                &nbsp;Room</label>
                                            <input type="radio" class="btn-check3" hidden value="Penthouse" name="home_options2" id="option12" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option12" onclick="">
                                                &nbsp;Penthouse</label>



                                        </div>
                                        <div id="plot" style="display:none">

                                            <input type="radio" class="btn-check3" hidden value="Residitional Plot" checked name="plot_option" id="option13" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option13" onclick="">
                                                &nbsp;Residitional
                                                Plot</label>
                                            <input type="radio" class="btn-check3" hidden value="Agricultare Land" name="plot_option" id="option14" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option14" onclick="">
                                                &nbsp;Agricultare
                                                Land</label>
                                            <input type="radio" class="btn-check3" hidden value="Commercial Plot" name="plot_option" id="option14" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option14" onclick="">
                                                &nbsp;Commercial Plot</label>
                                            <input type="radio" class="btn-check3" hidden value="Plot File" name="plot_option" id="option16" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option16" onclick="">
                                                &nbsp;Plot File</label>
                                            <input type="radio" class="btn-check3" hidden value=" Plot Form" name="plot_option" id="option17" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option17" onclick="">
                                                &nbsp;Plot Form</label>


                                            <!-- <button value="Sell" class="btn my-1" style="border:1px solid black;"><i class="fa fa-home me-2" ></i> &nbsp;Penthouse</button> -->
                                        </div>
                                        <div id="comercial" style="display:none">

                                            <input type="radio" class="btn-check3" checked hidden value="Office" name="commercial_option" id="option18" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option18" onclick="">
                                                &nbsp;Office
                                            </label>
                                            <input type="radio" class="btn-check3" hidden value="Shop" name="commercial_option" id="option19" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option19" onclick="">
                                                &nbsp;Shop
                                            </label>
                                            <input type="radio" class="btn-check3" hidden value="Wherehouse" name="commercial_option" id="option20" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option20" onclick="">
                                                &nbsp; Wherehouse</label>
                                            <input type="radio" class="btn-check3" hidden value="Factory" name="commercial_option" id="option21" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option21" onclick="">
                                                &nbsp;Factory</label>
                                            <input type="radio" class="btn-check3" hidden value="Building" name="commercial_option" id="option22" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option22" onclick="">
                                                &nbsp;Building</label>
                                            <input type="radio" class="btn-check3" hidden value="...Other" name="commercial_option" id="option23" autocomplete="off">
                                            <label class="btnsecondary3 border1  mx-1 my-2" for="option23" onclick="">
                                                &nbsp;...Other</label>
                                            <!-- <button value="Sell" class="btn my-1" style="border:1px solid black;"><i class="fa fa-home me-2" ></i> &nbsp;Penthouse</button> -->
                                        </div>
                                        <div class="form-group">
                                            <label for="validationServer011" class="form-label">City</label>
                                            <input type="text" class="form-control <?php echo $vaid3 ?>" name="city" id="validationServer011" value="">
                                            <div class="<?php echo $error3 ?>">
                                                <?php echo $msg3 ?>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="validationServer012" class="form-label">Location</label>
                                            <input type="text" class="form-control <?php echo $vaid4 ?>" name="location" id="validationServer012" value="">
                                            <div class="<?php echo $error4 ?>">
                                                <?php echo $msg4 ?>
                                            </div>

                                        </div>

                                    </div>



                                </div>

                            </div>

                        </div>
                        <!-- For Rent Pricing strt -->

                        <div class="container-fluid pt-4 px-4">
                            <div class=" rounded-top p-4 bg-secondary border">
                                <div id="forrent" style="display:none">
                                    <div class="row">
                                        <div class="col-12 col-sm-2 text-center text-sm-start" style="color: white;">

                                            Price and Area
                                        </div>
                                        <div class="col-12 col-sm-6 text-center row text-sm-start">
                                            <div class="form-group col-lg-8">
                                                <label for="validationServer011" class="form-label">Area Size</label>
                                                <input type="text" class="form-control <?php echo $vaid14 ?>" name="rent_area_size" id="validationServer011" value="">
                                                <div class="<?php echo $error14 ?>">
                                                    <?php echo $msg14 ?>
                                                </div>

                                            </div>

                                            <div class=" form-group col-lg-4 ">
                                                <label for="validationServer06" class="form-label w-100 text-secondary" style="text-align:left;">area size in</label>
                                                <select class="form-select <?php echo $vaid15; ?> " name="rent_area_size_in" id="validationServer06" aria-describedby="validationServer06Feedback">
                                                    <option value="">Choose....</option>
                                                    <option value="Marla">Marla</option>
                                                    <option value="Sq.Ft.">Sq.Ft.</option>
                                                    <option value="Sq.M.">Sq.M.</option>
                                                    <option value="Sq.Yd.">Sq.Yd.</option>
                                                    <option value="Kanal">Kanal</option>

                                                </select>
                                                <div id="validationServer06Feedback" class="<?php echo $error15; ?>  w-100 " style="text-align:left;">
                                                    <?php echo $msg15; ?>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-8">
                                                <label for="validationServer011" class="form-label">Monthly Rent</label>
                                                <input type="text" class="form-control <?php echo $vaid16 ?>" name="monthly_rent" id="validationServer011" value="">
                                                <div class="<?php echo $error16 ?>">
                                                    <?php echo $msg16 ?>
                                                </div>

                                            </div>

                                            <div class=" form-group col-lg-4 ">
                                                <label for="validationServer06" class="form-label w-100 text-secondary" style="text-align:left;">....</label>
                                                <select class="form-select <?php echo $vaid17; ?> " name="monthly_rent_in" id="validationServer06" aria-describedby="validationServer06Feedback">
                                                    <option value="">Choose....</option>
                                                    <option value="Pkr">Pkr</option>


                                                </select>
                                                <div id="validationServer06Feedback" class="<?php echo $error17; ?>  w-100 " style="text-align:left;">
                                                    <?php echo $msg17; ?>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <!-- For Rent Pricing  end -->

                                <!-- For Sell Pricing  start -->

                                <div id="forsell">
                                    <div class="row bg-secondary">
                                        <div class="col-12 col-sm-2 text-center text-sm-start" style="color: white;
                                                    font-weight: 900;
                                                    font-size:20px;">

                                            Price and Area
                                        </div>
                                        <div class="col-12 col-sm-6 text-center text-sm-start">

                                            <div class="form-group row">
                                                <div class="form-group col-lg-8">
                                                    <label for="validationServer013" class="form-label">Area Size</label>
                                                    <input type="text" class="form-control <?php echo $vaid5 ?>" name="area_size" id="validationServer013" value="">
                                                    <div class="<?php echo $error5 ?>">
                                                        <?php echo $msg5 ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 ">
                                                    <label for="validationServer06" class="form-label w-100 text-secondary" style="text-align:left;">area size in</label>
                                                    <select class="form-select <?php echo $vaid6; ?> " name="size_in__" id="validationServer06" aria-describedby="validationServer06Feedback">
                                                        <option value="">Choose....</option>
                                                        <option value="Marla">Marla</option>
                                                        <option value="Sq.Ft.">Sq.Ft.</option>
                                                        <option value="Sq.M.">Sq.M.</option>
                                                        <option value="Sq.Yd.">Sq.Yd.</option>
                                                        <option value="Kanal">Kanal</option>

                                                    </select>
                                                    <div id="validationServer06Feedback" class="<?php echo $error6; ?>  w-100 " style="text-align:left;">
                                                        <?php echo $msg6; ?>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="form-group col-lg-8">
                                                    <label for="validationServer013" class="form-label">Total Price</label>
                                                    <input type="text" class="form-control <?php echo $vaid8 ?>" name="t_price_" id="validationServer013" value="">
                                                    <div class="<?php echo $error8 ?>">
                                                        <?php echo $msg8 ?>
                                                    </div>
                                                </div>


                                                <div class="col-lg-4 ">
                                                    <label for="validationServer07" class="form-label w-100 text-secondary" style="text-align:left;">....</label>
                                                    <select class="form-select <?php echo $vaid7; ?> " name="Price_t" id="validationServer07" aria-describedby="validationServer07Feedback">
                                                        <option value="">Choose....</option>
                                                        <option value="Pkr">Pkr</option>


                                                    </select>
                                                    <div id="validationServer07Feedback" class="<?php echo $error7; ?>  w-100 " style="text-align:left;">
                                                        <?php echo $msg7; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <label class="col-lg-6 col-form-label" style="color: white;
                                                        font-weight: 900;
                                                        font-size:20px;">Installment
                                                available</label>
                                            <div class="form-group row">
                                                <div class="col-lg-9 ">
                                                    Enable if listing is available on installments
                                                    <?php
                                                    // echo $ins; 
                                                    ?>
                                                </div>
                                                <div class="col-lg-3 ">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" value="Installment available" name="installments" onclick="installment()" id="flexSwitchCheckDefault" style="    background-color: #989d98;
                                                                height: 21px;
                                                                width: 44px;">
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="installment1">




                                                <div class="form-group row">
                                                    <div class="form-group col-lg-8">
                                                        <label for="validationServer013" class="form-label">Advance Amount</label>
                                                        <input type="text" class="form-control <?php echo $vaid9 ?>" name="advance_amount" id="validationServer013" value="">
                                                        <div class="<?php echo $error9 ?>">
                                                            <?php echo $msg9 ?>
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-4 ">
                                                        <label for="validationServer07" class="form-label w-100 text-secondary" style="text-align:left;">....</label>
                                                        <select class="form-select <?php echo $vaid10; ?> " name="advance_amount_type" id="validationServer07" aria-describedby="validationServer07Feedback">
                                                            <option value="">Choose....</option>
                                                            <option value="Pkr">Pkr</option>


                                                        </select>
                                                        <div id="validationServer07Feedback" class="<?php echo $error10; ?>  w-100 " style="text-align:left;">
                                                            <?php echo $msg10; ?>
                                                        </div>
                                                    </div>
                                                </div>












                                                <div class="form-group col-lg-8">
                                                    <label for="validationServer013" class="form-label">No. of installment</label>
                                                    <input type="text" class="form-control <?php echo $vaid13 ?>" name="n_installment" id="validationServer013" value="">
                                                    <div class="<?php echo $error13 ?>">
                                                        <?php echo $msg13 ?>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="form-group col-lg-8">
                                                        <label for="validationServer013" class="form-label">Monthly Amount</label>
                                                        <input type="text" class="form-control <?php echo $vaid11 ?>" name="monthly_amount" id="validationServer013" value="">
                                                        <div class="<?php echo $error11 ?>">
                                                            <?php echo $msg11 ?>
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-4 ">
                                                        <label for="validationServer07" class="form-label w-100 text-secondary" style="text-align:left;">....</label>
                                                        <select class="form-select <?php echo $vaid12; ?> " name="monthly_amount_type" id="validationServer07" aria-describedby="validationServer07Feedback">
                                                            <option value="">Choose....</option>
                                                            <option value="Pkr">Pkr</option>


                                                        </select>
                                                        <div id="validationServer07Feedback" class="<?php echo $error12; ?>  w-100 " style="text-align:left;">
                                                            <?php echo $msg12; ?>
                                                        </div>
                                                    </div>




                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                            </div>
                            <!-- For Sell Pricing  end -->

                            <div class="container-fluid pt-4 px-4 ">
                                <div class=" rounded-top p-4 bg-secondary border">
                                    <div class="row">

                                        <div class="col-12 col-sm-2 text-center text-sm-start" style="color: white;
                                        font-weight: 900;
                                        font-size:20px;">
                                            Feature and Amenities
                                        </div>
                                        <div class="col-12 col-sm-6 text-center text-sm-start">
                                            <div id="hide_bed_bath" style="display:<?php echo $home_display ?>">
                                                <div class="form-group">
                                                    <div class="col-lg-3 ">
                                                        <label class="col-lg-3 col-form-label">Bedrooms</label>

                                                    </div>
                                                    <div class="col-lg-8 ">
                                                        <input type="radio" class="btn-check4" hidden value="Studio" name="bedrooms_options" checked id="bedrooms_options9" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="bedrooms_options9" onclick=""> &nbsp;Studio&nbsp;
                                                        </label>
                                                        <input type="radio" class="btn-check4" hidden value="1" name="bedrooms_options" id="option24" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option24" onclick=""> &nbsp;1&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="2" name="bedrooms_options" id="option25" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option25" onclick=""> &nbsp;2&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="3" name="bedrooms_options" id="option26" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option26" onclick=""> &nbsp;3&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="4" name="bedrooms_options" id="option27" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option27" onclick=""> &nbsp;4&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="5" name="bedrooms_options" id="option28" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option28" onclick=""> &nbsp;5&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="6" name="bedrooms_options" id="option29" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option29" onclick=""> &nbsp;6&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="7" name="bedrooms_options" id="option30" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option30" onclick=""> &nbsp;7&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="8" name="bedrooms_options" id="option31" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option31" onclick=""> &nbsp;8&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="9" name="bedrooms_options" id="option32" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option32" onclick=""> &nbsp;9&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="10" name="bedrooms_options" id="option33" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option33" onclick=""> &nbsp;10&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="11" name="bedrooms_options" id="option34" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option34" onclick=""> &nbsp;11&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="12" name="bedrooms_options" id="option35" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option35" onclick=""> &nbsp;12&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="13" name="bedrooms_options" id="option36" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option36" onclick=""> &nbsp;13&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="14" name="bedrooms_options" id="option37" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="option37" onclick=""> &nbsp;14&nbsp; </label>
                                                        <input type="radio" class="btn-check4" hidden value="15+" name="bedrooms_options" id="options38" autocomplete="off">
                                                        <label class="btnsecondary4 border1  mx-1 my-2" for="options38" onclick=""> &nbsp;15+&nbsp;
                                                        </label>





                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-lg-3 ">
                                                        <label class="col-lg-3 col-form-label">Bathrooms</label>

                                                    </div>
                                                    <div class="col-lg-8 ">
                                                        <input type="radio" class="btn-check5" hidden value="1" name="bath_room_option" checked id="option40" autocomplete="off">
                                                        <label class="btnsecondary5 border1  mx-1 my-2" for="option40" onclick=""> &nbsp;1&nbsp; </label>
                                                        <input type="radio" class="btn-check5" hidden value="2" name="bath_room_option" id="option41" autocomplete="off">
                                                        <label class="btnsecondary5 border1  mx-1 my-2" for="option41" onclick=""> &nbsp;2&nbsp; </label>
                                                        <input type="radio" class="btn-check5" hidden value="3" name="bath_room_option" id="options42" autocomplete="off">
                                                        <label class="btnsecondary5 border1  mx-1 my-2" for="options42" onclick=""> &nbsp;3&nbsp; </label>
                                                        <input type="radio" class="btn-check5" hidden value="4" name="bath_room_option" id="options43" autocomplete="off">
                                                        <label class="btnsecondary5 border1  mx-1 my-2" for="options43" onclick=""> &nbsp;4&nbsp; </label>
                                                        <input type="radio" class="btn-check5" hidden value="5" name="bath_room_option" id="option44" autocomplete="off">
                                                        <label class="btnsecondary5 border1  mx-1 my-2" for="option44" onclick=""> &nbsp;5&nbsp; </label>
                                                        <input type="radio" class="btn-check5" hidden value="6+" name="bath_room_option" id="option45" autocomplete="off">
                                                        <label class="btnsecondary5 border1  mx-1 my-2" for="option45" onclick=""> &nbsp;6+&nbsp; </label>


                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Home Amenities  start-->
                                        <?php
                                        include('../Home_amenties.php')
                                        ?>
                                        <!-- Home Amenities end -->
                                        <!-- Plots Amenities -->
                                        <?php include('../plots_ammenities.php') ?>
                                        <!-- Plots Amenities  end-->


                                        <!-- Commerical Amenities start-->
                                        <?php include('../Commerical_amenities.php') ?>
                                        <!-- Commerical Amenities  end-->



                                    </div>

                                </div>

                            </div>
                            <div class="container-fluid pt-4 px-4">
                                <div class=" rounded-top p-4 bg-secondary border" style="background-color:white;">
                                    <div class="row">

                                        <div class="col-12 col-sm-2 text-center text-sm-start" style="color: white;
    font-weight: 900;
    font-size:20px;">
                                            Ad Information
                                        </div>
                                        <div class="col-12 col-sm-6 text-center text-sm-start">


                                            <div class="form-group col-lg-12">
                                                <label for="validationServer013" class="form-label">Title</label>
                                                <input type="text" maxlength="13" class="form-control <?php echo $vaid18 ?>" name="p_title" id="validationServer013" value="">
                                                <div class="<?php echo $error18 ?>">
                                                    <?php echo $msg18 ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 col-form-label" for="validationServer013">Description</label>

                                                <div class="col-lg-12 ">
                                                    <textarea class="form-control bg-secondary <?php echo $vaid19 ?> " name="description" id="validationServer013" rows="3" style="background-color:white; resize:none"></textarea>
                                                    <div class="<?php echo $error19 ?>">
                                                        <?php echo $msg19 ?>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>


                                    </div>

                                </div>

                            </div>

                            <div class="container-fluid pt-4 px-4">
                                <div class=" rounded-top p-4 bg-secondary border" style="background-color:white;">
                                    <div class="row">

                                        <div class="col-12 col-sm-2 text-center text-sm-start" style="color: white;
    font-weight: 900;
    font-size:20px;">
                                            Property Images and Videos
                                        </div>
                                        <div class="col-12 col-sm-6 text-center text-sm-start">
                                            <div class="form-group">
                                                <label class="col-lg-3 col-form-label">Images</label>

                                                <div class="col-lg-7 ">
                                                    <input type="file" hidden class="form-control  bg-secondary my-2  text-dark" name="imgfiles[]" id="files" multiple="multiple" placeholder="Enter Property Title " style="background-color:white;" />
                                                    <label class=" btn btn-success" for="files"> upload images</label>


                                                </div>

                                                <label class="col-lg-3 col-form-label">Video</label>

                                                <div class="col-xl-12" id="dynamic_field">


                                                    <div class="form-group row">
                                                        <label name="add" id="you" class="col-lg-1 bg-secondary " style=" color:red;font-size:40px;"><i class="bi bi bi-youtube"></i></label>
                                                        <div class="col-lg-8">
                                                            <input type="url" class="form-control my-2 bg-secondary text-light" name="youtub[]" placeholder="Add Youtube video link" />
                                                        </div>
                                                        <label name="add" id="add" class="col-lg-1 bg-secondary " style="margin-top:10px;font-size:20px;"><i class="bi bi-plus-circle-fill "></i></label>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>


                                    </div>

                                </div>

                            </div>

                            <div class="container-fluid pt-4 px-4">
                                <div class=" rounded-top p-4 bg-secondary" style="background-color:white;">
                                    <div class="row">

                                        <div class="col-12 col-sm-2 text-center text-sm-start" style="color: white;
    font-weight: 900;
    font-size:20px;">
                                            Contact Information

                                        </div>
                                        <div class="col-12 col-sm-6 text-center text-sm-start">

                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label" for="validationServer013">Posting As</label>

                                                <div class="col-lg-4 ">
                                                    <input type="text" class="form-control my-2 bg-secondary  <?php echo $vaid20 ?> text-light" id="validationServer013" name="posting_as_a" style="background-color:white;" />
                                                    <div class="<?php echo $error20 ?>">
                                                        <?php echo $msg20 ?>
                                                    </div>
                                                </div>
                                                <label class="col-lg-2 col-form-label" for="validationServer014">Email</label>

                                                <div class="col-lg-4 ">
                                                    <input type="email" class="form-control my-2 <?php echo $vaid22 ?>  bg-secondary text-light" name="posting_email" id="validationServer014" style="background-color:white;" />
                                                    <div class="<?php echo $error22 ?>">
                                                        <?php echo $msg22 ?>
                                                    </div>
                                                </div>
                                                <label class="col-lg-2 col-form-label">Mobile </label>

                                                <div class="col-lg-4 ">
                                                    <input type="text" class="form-control my-2 <?php echo $vaid23 ?>  bg-secondary text-light" name="posting_number" id="email" style="background-color:white;" />
                                                    <div class="<?php echo $error23 ?>">
                                                        <?php echo $msg23 ?>
                                                    </div>
                                                </div>
                                                <label class="col-lg-2 col-form-label">landline </label>

                                                <div class="col-lg-4 ">
                                                    <input type="text" class="form-control my-2  <?php echo $vaid24 ?> bg-secondary text-light" name="posting_landline" id="email" style="background-color:white;" />
                                                    <div class="<?php echo $error24 ?>">
                                                        <?php echo $msg24 ?>
                                                    </div>



                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                </div>
                                <div class="container-fluid pt-4 px-4 bg-secondary">
                                    <div class=" rounded-top p-4 bg-secondary">
                                        <div class="row bg-secondary">

                                            <div class="col-12 col-sm-2 text-center text-sm-start" style="color: black;
                                            font-weight: 900;
                                            font-size:20px;">
                                                Platform Selection

                                            </div>
                                            <div class="col-12 col-sm-6 text-center text-sm-start bg-secondary" style="border:2px solid ;background-color:#e7e7e7;">
                                                <div class="form-check d-flex justify-content-start align-items-lg-center">
                                                    <input class="form-check-input" type="checkbox" value="OrbitEnterprise" name="plateform" id="flexCheckChecked" checked>
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        <img src="http://localhost/orbitenterprise/companylogo/abcd.png" alt="" name="" width="60" height="60" srcset="">
                                                    </label>
                                                    <label for="flexCheckChecked" style="color: #007200;
                                                    font-weight: 900;
                                                    font-size: 20px;
                                                    margin-top: 34px;
                                                    letter-spacing: 2px;" name="">OrbitEnterprise</label>
                                                </div>

                                            </div>

                                            <div class="col-12 col-sm-2 text-center text-sm-end" style="color: white;
                                            font-weight: 900;
                                            font-size:20px;">
                                                <input type="submit" class="btn btn-success mt-4" name="submitadd1" value="Submit Add">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                </form>
                <!-- Footer -->

            </div>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Oribit Enterprises Brochure</a>, All Right Reserved.
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <!-- /////////////////////////////////////////// -->

    <script src="js/jquery.min.js"></script>
    <script src="js/tinymce/tinymce.min.js"></script>
    <script src="js/tinymce/init-tinymce.min.js"></script>
    <!-- JavaScript Libraries -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <!-- <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<div class="form-group my-2 row" id="row' + i + '"><label  name="add" id="' + i + '" class="col-lg-1 bg-secondary btn_remove " style="color:red;font-size:40px;"><i class="bi bi bi-youtube"></i></label><div class="col-lg-8"><input type="url" class="form-control my-2 bg-secondary text-light" name="youtub[]"  placeholder="....." /></div><label  name="add" id="' + i + '" class="col-lg-1 bg-secondary btn_remove " style="margin-top:10px;font-size:20px;"><i class="bi bi-file-minus-fill"></i></label></div>');
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        });
    </script>
    <script>
        var forrent = document.getElementById("forrent");
        var forsell = document.getElementById("forsell");

        function for_sell() {
            if (forsell.style.display === "none") {
                forrent.style.display = "none";
                forsell.style.display = "block";
            }

        }

        function for_rent() {
            console.log("kdjsnfkasmndkfaksd")
            if (forrent.style.display === "none") {
                forsell.style.display = "none";
                forrent.style.display = "block";
            }
        }
        var hide_bed_bath = document.getElementById("hide_bed_bath");
        var plotmodels = document.getElementById("plotmodels");
        var homemodel = document.getElementById("homemodel");
        var commericals = document.getElementById("commericals");

        function myFunction() {
            var x = document.getElementById("home");
            var y = document.getElementById("plot");
            var z = document.getElementById("comercial");


            if (x.style.display === "none") {
                x.style.display = "block";
                y.style.display = "none";
                z.style.display = "none";
                hide_bed_bath.style.display = "block";
                plotmodels.style.display = "none";
                commericals.style.display = "none";
                homemodel.style.display = "block";

            } else {
                x.style.display = "block";
                y.style.display = "none";
                z.style.display = "none";
                hide_bed_bath.style.display = "block";
                plotmodels.style.display = "none";
                commericals.style.display = "none";
                homemodel.style.display = "block";

            }
        }

        function myFunction2() {
            var x = document.getElementById("home");
            var y = document.getElementById("plot");
            var z = document.getElementById("comercial");
            if (y.style.display === "none") {
                x.style.display = "none";
                y.style.display = "block";
                z.style.display = "none";
                hide_bed_bath.style.display = "none";
                plotmodels.style.display = "block";
                homemodel.style.display = "none";
                commericals.style.display = "none";

            } else {
                x.style.display = "none";
                y.style.display = "block";
                z.style.display = "none";
                hide_bed_bath.style.display = "none";
                plotmodels.style.display = "block";
                homemodel.style.display = "none";
                commericals.style.display = "none";
            }
        }

        function myFunction3() {
            var x = document.getElementById("home");
            var y = document.getElementById("plot");
            var z = document.getElementById("comercial");
            if (z.style.display === "none") {
                x.style.display = "none";
                y.style.display = "none";
                z.style.display = "block";
                hide_bed_bath.style.display = "block";
                plotmodels.style.display = "none";
                homemodel.style.display = "none";
                commericals.style.display = "block";



            } else {
                x.style.display = "none";
                y.style.display = "none";
                z.style.display = "block";
                hide_bed_bath.style.display = "block";
                plotmodels.style.display = "none";
                homemodel.style.display = "none";
                homemodel.style.display = "block";
            }
        }

        function installment() {
            // console.log("hello check");
            var a = document.getElementById("installment1");
            if (a.style.display === "block") {
                a.style.display = "none";
            } else {
                a.style.display = "block";
            }
        }

        var mainfeature = document.getElementById("mainfeature");
        var room = document.getElementById("room");
        var communication = document.getElementById("commuincation1");
        var nearby_Locations = document.getElementById("nearby_Locations1");
        var community_Features = document.getElementById("community_Features1");
        var healthcare_Recreational = document.getElementById("healthcare_Recreational1");
        var otherfeatures = document.getElementById("otherfeatures");
        var plotmodel = document.getElementById("plotmodel");

        function mainfeatures() {
            if (mainfeature.style.display === "none") {
                mainfeature.style.display = "block";
                room.style.display = "none";
                communication.style.display = "none";
                nearby_Locations.style.display = "none";
                community_Features.style.display = "none";
                healthcare_Recreational.style.display = "none";
                otherfeatures.style.display = "none";

            }
        }

        function rooms() {
            if (room.style.display === "none") {
                mainfeature.style.display = "none";
                room.style.display = "block";
                nearby_Locations.style.display = "none";
                community_Features.style.display = "none";
                healthcare_Recreational.style.display = "none";
                communication.style.display = "none";
                otherfeatures.style.display = "none";
            }


        }

        function comunications() {
            if (communication.style.display === "none") {
                mainfeature.style.display = "none";
                room.style.display = "none";
                nearby_Locations.style.display = "none";
                community_Features.style.display = "none";
                healthcare_Recreational.style.display = "none";
                communication.style.display = "block";
                otherfeatures.style.display = "none";

            }
            console.log("akjsdkajksd coummnication")

        }

        function community_Feature() {
            if (community_Features.style.display === "none") {
                mainfeature.style.display = "none";
                room.style.display = "none";
                nearby_Locations.style.display = "none";
                community_Features.style.display = "block";
                healthcare_Recreational.style.display = "none";
                communication.style.display = "none";
                otherfeatures.style.display = "none";

            }
        }

        function healthcare_Recreationals() {
            if (healthcare_Recreational.style.display === "none") {
                mainfeature.style.display = "none";
                room.style.display = "none";
                nearby_Locations.style.display = "none";
                community_Features.style.display = "none";
                healthcare_Recreational.style.display = "block";
                communication.style.display = "none";
                otherfeatures.style.display = "none";

            }
        }

        function nearby_Location() {
            if (nearby_Locations.style.display === "none") {
                mainfeature.style.display = "none";
                room.style.display = "none";
                nearby_Locations.style.display = "block";
                community_Features.style.display = "none";
                healthcare_Recreational.style.display = "none";
                communication.style.display = "none";
                otherfeatures.style.display = "none";

            }
        }

        function myfeatures() {
            if (otherfeatures.style.display === "none") {
                mainfeature.style.display = "none";
                room.style.display = "none";
                nearby_Locations.style.display = "none";
                community_Features.style.display = "none";
                healthcare_Recreational.style.display = "none";
                communication.style.display = "none";
                otherfeatures.style.display = "block";

            }
        }

        ///

        var plotFeature1 = document.getElementById("plotFeature1");
        var nearbyLocations1 = document.getElementById("nearbyLocations1");
        var otherfeatures1 = document.getElementById("otherfeatures1");

        function plot_Feature() {
            if (plotFeature1.style.display === "none") {

                plotFeature1.style.display = "block";
                nearbyLocations1.style.display = "none";
                otherfeatures1.style.display = "none";

            }
        }

        function nearbyLocations() {
            if (nearbyLocations1.style.display === "none") {

                nearbyLocations1.style.display = "block";
                plotFeature1.style.display = "none";
                otherfeatures1.style.display = "none";

            }
        }

        function plotamenitiesotherfeature() {
            if (otherfeatures1.style.display === "none") {
                console.log("ajskldjasd");
                otherfeatures1.style.display = "block";
                plotFeature1.style.display = "none";
                nearbyLocations1.style.display = "none";

            }
        }

        // ------------Commerical Ammenties-----------------




        var mainfeature1 = document.getElementById("mainfeature1");
        var room1 = document.getElementById("room1");
        var commuincations2 = document.getElementById("commuincations2");
        var community_Feature2 = document.getElementById("community_Feature2");
        var healthcare_Recreational2 = document.getElementById("healthcare_Recreational2");
        var nearby_Location2 = document.getElementById("nearby_Location2");
        var otherfeature23 = document.getElementById("otherfeature23");



        function commericalmainfeature() {
            if (mainfeature1.style.display === "none") {
                mainfeature1.style.display = "block"
                room1.style.display = "none"
                commuincations2.style.display = "none"
                community_Feature2.style.display = "none"
                healthcare_Recreational2.style.display = "none"
                nearby_Location2.style.display = "none"
                otherfeature23.style.display = "none"
            }
        }

        function commericalrooms() {
            if (room1.style.display === "none") {
                room1.style.display = "block"
                mainfeature1.style.display = "none"
                commuincations2.style.display = "none"
                community_Feature2.style.display = "none"
                healthcare_Recreational2.style.display = "none"
                nearby_Location2.style.display = "none"
                otherfeature23.style.display = "none"
            }
        }

        function commericalcomunications() {
            if (commuincations2.style.display === "none") {
                commuincations2.style.display = "block"
                mainfeature1.style.display = "none"
                room1.style.display = "none"
                community_Feature2.style.display = "none"
                healthcare_Recreational2.style.display = "none"
                nearby_Location2.style.display = "none"
                otherfeature23.style.display = "none"
            }
        }

        function commericalcommunity_Feature() {
            if (community_Feature2.style.display === "none") {
                community_Feature2.style.display = "block"
                commuincations2.style.display = "none"
                mainfeature1.style.display = "none"
                room1.style.display = "none"
                healthcare_Recreational2.style.display = "none"
                nearby_Location2.style.display = "none"
                otherfeature23.style.display = "none"
            }

        }

        function commericalhealthcare_Recreationals() {
            if (healthcare_Recreational2.style.display === "none") {
                healthcare_Recreational2.style.display = "block"
                mainfeature1.style.display = "none"
                room1.style.display = "none"
                commuincations2.style.display = "none"
                community_Feature2.style.display = "none"
                nearby_Location2.style.display = "none"
                otherfeature23.style.display = "none"
            }

        }

        function commericalnearby_Location() {
            if (nearby_Location2.style.display === "none") {
                nearby_Location2.style.display = "block"
                mainfeature1.style.display = "none"
                room1.style.display = "none"
                commuincations2.style.display = "none"
                community_Feature2.style.display = "none"
                healthcare_Recreational2.style.display = "none"
                otherfeature23.style.display = "none"
            }
        }

        function commericalmyfeatures() {
            if (otherfeature23.style.display === "none") {
                otherfeature23.style.display = "block"
                community_Feature2.style.display = "none"
                mainfeature1.style.display = "none"
                room1.style.display = "none"
                commuincations2.style.display = "none"
                healthcare_Recreational2.style.display = "none"
                nearby_Location2.style.display = "none"
            }
        }
    </script>

</body>

</html>