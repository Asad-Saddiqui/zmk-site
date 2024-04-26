<?php
session_start();
require("./config/config.php");
include('./check_status.php');

if (!isset($_SESSION['adminEmail'])) {
    header("location:../login.php");
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function generateUniqueName1($originalName, $projectName, $i)
{
    return $projectName . '-' . $i . '-' . $originalName;
}

function generateUniqueName($originalName)
{
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    return time() . uniqid() . '-.' . $extension;
}

$error = false;
$success = "";
$extraimages;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define maximum lengths for fields
    $maxProjectNameLength = 100;
    $maxMapUrlLength = 1000;
    $maxAddressLength = 70;
    $maxFeaturesLength = 800;
    $maxDescriptionLength = 4500;
    $floorplans_name="";
    $PricingDocument_name="";
    // Validate and sanitize form inputs
    $projectName = isset($_POST['project_name']) ? test_input($_POST['project_name']) : "";
    $city = isset($_POST['city']) ? $_POST['city'] : "";
    $mapUrl = isset($_POST['map_url']) ? $_POST['map_url'] : "";
    $address = isset($_POST['address']) ? test_input($_POST['address']) : "";
    $features = isset($_POST['features']) ? test_input($_POST['features']) : "";
    $description = isset($_POST['description']) ? test_input($_POST['description']) : "";
    $maplocationtext = isset($_POST['maplocationtext']) ? test_input($_POST['maplocationtext']) : "";
    $AboutNOC = isset($_POST['AboutNOC']) ? test_input($_POST['AboutNOC']) : "";
    $category = isset($_POST['category']) ? test_input($_POST['category']) : "";
    $ListingCategory = isset($_POST['ListingCategory']) ? test_input($_POST['ListingCategory']) : "";
    $extradescription = isset($_POST['extradescription']) ? test_input($_POST['extradescription']) : "";
    $uniqueName = "";
    $extraimages = $_FILES['extraimage']['name'];

    if (strlen($projectName) > $maxProjectNameLength || empty($projectName)) {
        $error = true;
        echo '<script>alert("Enter  project small name")</script>';
    } elseif (strlen($mapUrl) > $maxMapUrlLength || empty($mapUrl)) {
        $error = true;
        echo '<script>alert("Enter valid Map url")</script>';
    } elseif (strlen($city) > 40 || empty($city)) {
        $error = true;
        echo '<script>alert("Enter  city name  less the 40 char")</script>';
    } elseif (strlen($address) > $maxAddressLength || empty($address)) {
        $error = true;
        echo '<script>alert("Enter  address name  less then ' . $maxAddressLength . 'char")</script>';
    } elseif (strlen($features) > $maxFeaturesLength || empty($features)) {
        $error = true;
        echo '<script>alert("Enter  Features   less then ' . $maxFeaturesLength . 'char")</script>';
    } elseif (strlen($extradescription) > 4500 || empty($extradescription)) {
        $error = true;
        echo '<script>alert("Enter  features and ammenities   less then ' . 4500 . 'char")</script>';
    } elseif (strlen($maplocationtext) > 4500 || empty($maplocationtext)) {
        $error = true;
        echo '<script>alert("Map Location Points   less then ' . 4500 . 'char")</script>';
    } elseif (strlen($description) > $maxDescriptionLength || empty($description)) {
        $error = true;
        echo '<script>alert("Enter  Description   less then ' . $maxDescriptionLength . 'char")</script>';
    } elseif (strlen($AboutNOC) > $maxDescriptionLength) {
        $error = true;
        echo '<script>alert("Enter  About NOC    less then ' . $maxDescriptionLength . 'char")</script>';
    } elseif (strlen($ListingCategory) > 50 || empty($ListingCategory)) {
        $error = true;
        echo '<script>alert("Select  listing cateory less then ' . 50 . 'char")</script>';
    } elseif (strlen($category) > 50 || empty($category)) {
        $error = true;
        echo '<script>alert("Select  cateory less then ' . 50 . 'char")</script>';
    } else {
        // Check if project image is uploaded
        $file_name = $_FILES['project_image']['name'];
        $NocRelatedImage_name = $_FILES['NocRelatedImage']['name'];
        $maplocatioimage_name = $_FILES['maplocatioimage']['name'];
        $ownerimg_name = $_FILES['ownerimg']['name'];

        $extraimages = $_FILES['extraimage']['name'];
        $extraimages_type = $_FILES['extraimage']['type'];
        $extraimages_size = $_FILES['extraimage']['size'];
        $extraimages_tmp_name = $_FILES['extraimage']['tmp_name'];

        $maplocatioimage_tmp_name = $_FILES['maplocatioimage']['tmp_name'];
        $ownerimg_tmp_name = $_FILES['ownerimg']['tmp_name'];

        $NocRelatedImage_tmp_name = $_FILES['NocRelatedImage']['tmp_name'];
        $file_tmp_name = $_FILES['project_image']['tmp_name'];

        $NocRelatedImage_size = $_FILES['NocRelatedImage']['size'];
        $file_size = $_FILES['project_image']['size'];

        $maplocatioimage_size = $_FILES['maplocatioimage']['size'];
        $ownerimg_size = $_FILES['maplocatioimage']['size'];

        $maplocatioimage_type = $_FILES['maplocatioimage']['type'];
        $ownerimg_type = $_FILES['maplocatioimage']['type'];

        $NocRelatedImagetype = $_FILES['NocRelatedImage']['type'];
        $file_type = $_FILES['project_image']['type'];

        // Define maximum file size (5MB)
        $max_file_size = 7 * 1024 * 1024;

        // Define allowed file types
        $allowed_types = array('image/jpeg', 'image/png', 'image/jpg');

        // Check file size
        if ($file_size > $max_file_size) {
            $error = true;
            echo '<script>alert("Project image size exceeds maximum limit (7MB).")</script>';
        } elseif ($NocRelatedImage_size > $max_file_size) {
            $error = true;
            echo '<script>alert("NOC File size exceeds maximum limit (7MB).")</script>';
        } elseif ($maplocatioimage_size > $max_file_size) {
            $error = true;
            echo '<script>alert("Map Image size exceeds maximum limit (7MB).")</script>';
        } elseif ($ownerimg_size > $max_file_size) {
            $error = true;
            echo '<script>alert("Owner img size exceeds maximum limit (7MB).")</script>';
        } else {
            if (!in_array($file_type, $allowed_types)) {
                $error = true;
                echo '<script>alert("Project image Invalid  type. Supported formats: JPG, JPEG, PNG.")</script>';
            } elseif (!in_array($maplocatioimage_type, $allowed_types)) {
                $error = true;
                echo '<script>alert("Invalid Map Location  file. Supported formats: JPG, JPEG, PNG.")</script>';
            } elseif (!in_array($ownerimg_type, $allowed_types)) {
                $error = true;
                echo '<script>alert("Invalid owner img  file. Supported formats: JPG, JPEG, PNG.")</script>';
            } elseif (!in_array($NocRelatedImagetype, $allowed_types)) {
                $error = true;
                echo '<script>alert("Invalid  NOC Image file type. Supported formats: JPG, JPEG, PNG.")</script>';
            } else {
                if (empty($_FILES['extraimage']['name'][0])) {
                    $error = true;
                    echo '<script>alert("Please Upload Gallery Images")</script>';
                }
                // Check if pricing file is uploaded
                $FloorplansName = "";
                $PricingDocumentName = "";
                $PricingDocumentNamePath = "";
                $FloorplansPath = "";
                if ($_FILES["PricingDocument"]["error"] == UPLOAD_ERR_OK) {
                    $PricingDocumenttype = $_FILES['PricingDocument']['type'];
                    $PricingDocumentsize = $_FILES['PricingDocument']['size'];
                    $PricingDocumentallowed_types = array('application/pdf');
                    $PricingDocument_name = $_FILES['PricingDocument']['name'];
                    $PricingDocumenttmp_name = $_FILES['PricingDocument']['tmp_name'];
                    if (!in_array($PricingDocumenttype, $PricingDocumentallowed_types)) {
                        $error = true;
                        echo '<script>alert("Invalid Pricing  file. Supported formats: JPG, JPEG, PNG.")</script>';
                    }
                    $PricingDocumentName = generateUniqueName($PricingDocument_name);
                    $PricingDocumentNamePath = './uploads/' . $PricingDocumentName; // C
                } else {
                    $PricingDocumentName = "";
                    // Pricing file not uploaded
                    // Handle accordingly (e.g., show error message or proceed with default action)
                }
                if ($_FILES["floorplans"]["error"] == UPLOAD_ERR_OK) {
                    $floorplanstype = $_FILES['floorplans']['type'];
                    $floorplanssize = $_FILES['floorplans']['size'];
                    $floorplansallowed_types = array('application/pdf');
                    $floorplans_name = $_FILES['floorplans']['name'];
                    $floorplanstmp_name = $_FILES['floorplans']['tmp_name'];
                    if (!in_array($floorplanstype, $floorplansallowed_types)) {
                        $error = true;
                        echo '<script>alert("Invalid Floor Plan  file. Supported formats: JPG, JPEG, PNG.")</script>';
                    }
                    $FloorplansName = generateUniqueName($floorplans_name);
                    $FloorplansPath = './uploads/' . $FloorplansName; // Change this path as needed
                    // Move the uploaded file to desired directory
                } else {
                    $FloorplansName = "";
                }
                if (!$error) {
                    $totalFiles = count($_FILES['extraimage']['name']);
                    $namesImages = [];
                    $imagePaths = [];
                    $maxImages = 4;
                    $maxSize = 7 * 1024 * 1024;
                    $totalFiles = count($_FILES['extraimage']['name']);
                    for ($i = 0; $i < $totalFiles; $i++) {
                        $originalName = $_FILES['extraimage']['name'][$i];
                        $tmpName = $_FILES['extraimage']['tmp_name'][$i];
                        $size = $_FILES['extraimage']['size'][$i];
                        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                        if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                            // Skip the current file if it has an invalid format
                            continue;
                        }
                        if ($size > $maxSize) {
                            // Skip the current file if it exceeds the maximum size
                            continue;
                        }
                        $uniqueName_ = generateUniqueName1($originalName, $projectName, $i);
                        $namesImages[] = $uniqueName_;
                        $imagePaths[] = $tmpName;
                        if (count($imagePaths) >= $maxImages) {
                            // Stop processing after reaching the maximum number of images
                            break;
                        }
                    }
                    $serializedArray = json_encode($namesImages);
                    $NocRelatedImage_uique = generateUniqueName($NocRelatedImage_name);
                    $uniqueName = generateUniqueName($file_name);

                    $ownerimgu = generateUniqueName($ownerimg_name);
                    $maplocatioimageu = generateUniqueName($maplocatioimage_name);
                    $maplocatioimage_Path = './uploads/' . $maplocatioimageu; // Change this path as needed
                    $ownerimg_Path = './uploads/' . $ownerimgu; // Change this path as needed

                    $NocRelatedImage_Path = './uploads/' . $NocRelatedImage_uique; // Change this path as needed
                    $targetPath = './uploads/' . $uniqueName; // Change this path as needed

                    if (count($imagePaths) > 0) {
                        $mysqli_ = mysqli_query($con, "SELECT * FROM projects where project_name='$projectName'");
                        $num = mysqli_num_rows($mysqli_);
                        if ($num == 1) {
                            echo '<script>alert("Project Already Exist")</script>';
                        } else {
                            $query = "INSERT INTO `projects` (`project_id`, `project_name`, `map_url`, `address`, `features`, `description`, `category`, `project_image`, `created_at`, `ListingCategory`, `PricingDocument`, `AboutNOC`, `Noc Related Image :`, `FacilitiesandAmenties`, `RequireDocuments`,`city`,`maplocationimg`,`ownerimge`) 
                                        VALUES (NULL, '$projectName', '$mapUrl', '$address', '$features', '$description', '$category', '$uniqueName', current_timestamp(), '$ListingCategory', '$PricingDocumentName', '$AboutNOC', '$NocRelatedImage_uique', '$extradescription', '$serializedArray','$city','$maplocatioimageu','$ownerimgu')";
                            if (mysqli_query($con, $query)) {
                                $inserted_id = mysqli_insert_id($con);
                                $query1 = "INSERT INTO `projectsextends` (`eid`, `maplocationtext`, `floorplan`, `porEid`) VALUES (NULL, '$maplocationtext', '$FloorplansName', '$inserted_id')";
                                mysqli_query($con, $query1);
                                for ($i = 0; $i < count($imagePaths); $i++) {
                                    $targetPath_ = './uploads/' . $namesImages[$i];
                                    move_uploaded_file($imagePaths[$i], $targetPath_);
                                }
                                move_uploaded_file($ownerimg_tmp_name, $ownerimg_Path);
                                if($floorplans_name){

                                    move_uploaded_file($floorplanstmp_name, $FloorplansPath);
                                }
                                if($PricingDocument_name){

                                    move_uploaded_file($PricingDocumenttmp_name, $PricingDocumentNamePath);
                                }
                                move_uploaded_file($maplocatioimage_tmp_name, $maplocatioimage_Path);
                                move_uploaded_file($NocRelatedImage_tmp_name, $NocRelatedImage_Path);
                                if (move_uploaded_file($file_tmp_name, $targetPath)) {
                                    echo '<script>alert("Project Added Successfuly")</script>';
                                }
                            }
                        }
                    } else {
                        echo '<script>alert("Select atleast 1 Gallery  image")</script>';
                    }
                }
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Project</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

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
    /* scrollbar-color: #EB1616 #191C24; */
}

/* Chrome, Edge, and Safari */
*::-webkit-scrollbar {
    width: 16px;
}

*::-webkit-scrollbar-track {
    background: white;
}

*::-webkit-scrollbar-thumb {
    background-color: #ffc107;
    border-radius: 10px;
    border: 3px solid #191C24;
    height: 50px;
}

/* *{
            overflow-x: hidden;
        } */
</style>

<style>
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
    border-bottom: 2px solid green;
    /* cursor: pointer; */
}

.btnsecondary1Common {
    background-color: #e8e8e8;
    color: #00ae00;
    border: 2px solid #00ae00;
    border-radius: 15px;
    padding: 3px;
    cursor: pointer;
}

.btn-check1:checked+.btnsecondary1 {
    background-color: #e8e8e8;
    color: #00ae00;
    border: 2px solid #00ae00;
    border-radius: 15px;
    padding: 3px;
    cursor: pointer;
}

.border1 {
    border: 1px solid white;
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

.text-white {
    color: white;
}

input {
    background-color: #191C24;
}
</style>

<body>

    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        <?php
        include("./common/sidebar.php");
        ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content " style="background-color:#e9ecef">
            <!-- Navbar Start -->
            <?php
            include("./common/navbar.php");
            ?>

            <div class="container-fluid  pt-4">
                <div class="bg-white rounded-top p-4">
                    <h2 class="text-center m-2 text-dark"> List Your Project</h2>
                   
                    <hr>
                    <div class="container  col-sm-12 col-md-12 col-lg-12">
                        <h2 class="text-dark"><?php
                                                echo $success; ?></h2>
                        <style>
                        #input {
                            background-color: #13151c;
                            height: 60px;
                            border: none;
                            border: 3px solid green;
                            border-radius: 0px;
                        }

                        #exampleFormControlTextarea {
                            background-color: #13151c;
                            height: 100px;
                            border: none;
                            border: 3px solid green;
                            border-radius: 0px;
                            resize: none;
                        }

                        #exampleFormControlTextarea2,
                        #exampleFormControlTextarea3 {
                            background-color: #13151c;
                            height: 300px;
                            border: none;
                            border: 1px solid green;
                            border-radius: 0px;
                            resize: none;
                        }

                        #exampleFormControlTextarea1:focus,
                        #exampleFormControlTextarea2:focus,
                        #input:focus {
                            background-color: #13152c;
                        }
                        </style>
                        <form method="post" enctype="multipart/form-data">

                            <div class=" row col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group my-2  col-sm-12 col-md-6 col-lg-6 mr-1">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">Project Name :</label>
                                    <input type="text" class="form-control  bg-white " id="input" name="project_name"
                                        style="border-radius:0px" id="exampleFormControlInput1"
                                        placeholder="Enter project name">
                                </div>
                                <div class="form-group my-2  col-sm-12 col-md-6 col-lg-6 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">Project Image</label>
                                    <input type="file" class="form-control  bg-white " name="project_image" id="input"
                                        id="exampleFormControlInput1" style="height: 60px;">
                                </div>
                                <div class="form-group my-2   col-sm-12 col-md-6 col-lg-6 mr-1">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">Category</label>
                                    <select class="form-control  bg-white " name="category" id="input">
                                        <option value="Sale">Sale</option>
                                        <option value="Rent">Rent</option>
                                    </select>
                                </div>
                                <div class="form-group my-2   col-sm-12 col-md-6 col-lg-6 mr-1">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">Listing Category</label>
                                    <select class="form-control  bg-white " name="ListingCategory" id="input">
                                        <option value="Society">Society</option>
                                        <option value="Project">Project</option>
                                    </select>
                                </div>
                                <div class="form-group my-2  col-sm-12 col-md-6 col-lg-6 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">City</label>
                                    <input type="text" class="form-control  bg-white" id="input" name="city"
                                        id="exampleFormControlInput1" maxlength="300" placeholder="Enter Map Location">
                                </div>
                                <div class="form-group my-2  col-sm-12 col-md-6 col-lg-6 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">Map URL</label>
                                    <input type="url" class="form-control  bg-white" id="input" name="map_url"
                                        id="exampleFormControlInput1" maxlength="300" placeholder="Enter Map Location">
                                </div>
                                <div class="form-group my-2  col-sm-12 col-md-12 col-lg-12 ">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">Address</label>
                                    <input type="text " class="form-control  bg-white " id="input" name="address"
                                        id="exampleFormControlInput1" maxlength="70"
                                        placeholder="Enter Address less then 80 characters">
                                </div>
                                <div class="form-group  my-3">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlTextarea1">Introduction</label>
                                    <textarea class="form-control   bg-white gb-white text-dark " maxlength="800"
                                        name="features" placeholder="Enter Some Features less then 700 characters"
                                        id="exampleFormControlTextarea" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlTextarea1">Owner and Developer Information</label>
                                 

                                    <textarea class="form-control  bg-white " name="description" maxlength="4500"
                                        placeholder="Enter Some Description less then 4500 characters"
                                        id="" rows="3"></textarea>
                                </div>
                                <div class="form-group my-3  col-sm-12 col-md-12 col-lg-12 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">Owner and developer related Image</label>
                                    <input type="file" class="form-control  bg-white " name="ownerimg" id="input"
                                        id="exampleFormControlInput1" style="height: 60px;">
                                </div>
                                <div class="form-group">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlTextarea1">Nearest Locations</label>
                                    

                                    <textarea class="form-control  bg-white " name="maplocationtext" maxlength="4500"
                                        placeholder="Enter Some Description less then 4500 characters"
                                        id="" rows="7"></textarea>
                                </div>
                                <div class="form-group my-3  col-sm-12 col-md-12 col-lg-12 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">Map Location Image</label>
                                    <input type="file" class="form-control  bg-white " name="maplocatioimage" id="input"
                                        id="exampleFormControlInput1" style="height: 60px;">
                                </div>
                                 
                                <div class="form-group my-3  col-sm-12 col-md-12 col-lg-12 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">Floor Plans</label>
                                    <input type="file" class="form-control  bg-white " name="floorplans" id="input"
                                        id="exampleFormControlInput1" style="height: 60px;">
                                </div>
                                <div class="form-group my-3  col-sm-12 col-md-12 col-lg-12 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">Pricing Plan</label>
                                    <input type="file" class="form-control  bg-white " name="PricingDocument" id="input"
                                        id="exampleFormControlInput1" style="height: 60px;">
                                </div>
                                <div class="form-group my-3">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlTextarea2">About NOC</label>
                                    
                                    <textarea class="form-control  bg-white" name="AboutNOC" maxlength="4500"
                                        placeholder="Enter Some Description less then 4500 characters"
                                        id="" rows="3"></textarea>
                                </div>
                                <div class="form-group my-3  col-sm-12 col-md-12 col-lg-12 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">Noc Related Image :</label>
                                    <input type="file" class="form-control  bg-white " name="NocRelatedImage" id="input"
                                        id="exampleFormControlInput1" style="height: 60px;">
                                </div>
                                <div class="form-group my-3">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlTextarea2">Facilities and Amenties</label>
                                    <p class="alert alert-danger">* Important Please Do Not Remove Below Content
                                        Only
                                        Replace Content or Details</p>

                                    <textarea class="tinymce form-control  bg-white" name="extradescription"
                                        maxlength="4500" placeholder="Enter Some Description less then 4500 characters"
                                        id="exampleFormControlTextarea10" rows="13">
                                        <div class="row col-md-12 col-sm-12 col-lg-12">
                                            <div class="col-md-6 col-sm-12 col-lg-6">
                                                   <h4 style="text-align: left;"><strong><span style="color: #000000;">Facilities and Amenties:</span></strong></h4>
                                                    <hr />
                                                    <p>To add the media or video plugin to your TinyMCE initialization configuration, you need to include it in the <code>plugins</code> option and add a corresponding button to the toolbar. Here's how you can modify your TinyMCE initialization to include the media or video plugin:To add the media or video plugin to your TinyMCE initialization configuration, you need to include it in the <code>plugins</code> option and add a corresponding button to the toolbar. Here's how you can modify your TinyMCE initialization to include the media or video plugin:To add the media or video plugin to your TinyMCE initialization configuration, you need to include it in the <code>plugins</code> option and add a corresponding button to the toolbar. Here's how you can modify your TinyMCE initialization to include the media or video plugin:</p>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-lg-6">
                                            <table  class="table-responsive "style="border-collapse: collapse; width: 100; marin-top:30px" border="1">
                                                    <tbody>
                                                    <tr style="height: 22px;">
                                                    <td style="width: 25%; height: 22px;"><strong>Built in year</strong></td>
                                                    <td style="width: 25%; height: 22px;">03/08/2022</td>
                                                    <td style="width: 25%; height: 22px;">
                                                    <div>
                                                    <div><strong>3rd Party</strong></div>
                                                    </div>
                                                    </td>
                                                    <td style="width: 25%; height: 22px;">NO</td>
                                                    </tr>
                                                    <tr style="height: 22px;">
                                                    <td style="width: 25%; height: 22px;">
                                                    <div>
                                                    <div><strong>Swiming Pool</strong></div>
                                                    </div>
                                                    </td>
                                                    <td style="width: 25%; height: 22px;">NO</td>
                                                    <td style="width: 25%; height: 22px;">
                                                    <div>
                                                    <div><strong>Alivator</strong></div>
                                                    </div>
                                                    </td>
                                                    <td style="width: 25%; height: 22px;">YES</td>
                                                    </tr>
                                                    <tr style="height: 22px;">
                                                    <td style="width: 25%; height: 22px;">
                                                    <div>
                                                    <div><strong>Parking</strong></div>
                                                    </div>
                                                    </td>
                                                    <td style="width: 25%; height: 22px;">YES</td>
                                                    <td style="width: 25%; height: 22px;">
                                                    <div>
                                                    <div><strong>CCTV</strong></div>
                                                    </div>
                                                    </td>
                                                    <td style="width: 25%; height: 22px;">YES</td>
                                                    </tr>
                                                    <tr style="height: 22px;">
                                                    <td style="width: 25%; height: 22px;">
                                                    <div>
                                                    <div><strong>GYM</strong></div>
                                                    </div>
                                                    </td>
                                                    <td style="width: 25%; height: 22px;">YES</td>
                                                    <td style="width: 25%; height: 22px;">
                                                    <div>
                                                    <div><strong>Water Supply</strong></div>
                                                    </div>
                                                    </td>
                                                    <td style="width: 25%; height: 22px;">Yes</td>
                                                    </tr>
                                                    <tr style="height: 22px;">
                                                    <td style="width: 25%; height: 22px;">
                                                    <div>
                                                    <div><strong>Type</strong></div>
                                                    </div>
                                                    </td>
                                                    <td style="width: 25%; height: 22px;">Flat</td>
                                                    <td style="width: 25%; height: 22px;">
                                                    <div>
                                                    <div><strong>Dining Capacity</strong></div>
                                                    </div>
                                                    </td>
                                                    <td style="width: 25%; height: 22px;">YES</td>
                                                    </tr>
                                                    </tbody>
                                                    </table>
                                        </div>
                                        </div>
                                                   
                                                   
                                                    
                                </textarea>
                                </div>
                                <style>
                                     /* CSS for the dotted border and container height */
                                    .image-preview-container {
                                        min-height: 300px;
                                        border: 2px dotted #aaa;
                                        padding: 15px;
                                        overflow-y: auto;
                                        width: 100%;
                                        /* Add scrollbar if content overflows vertically */
                                    }

                                    /* CSS for the uploaded images */
                                    .uploaded-image {
                                        width: 150px;
                                        /* Set the fixed width of the images */
                                        height: 300px;
                                        /* Set the fixed height of the images */
                                        object-fit: cover;
                                        /* Maintain aspect ratio */
                                        margin-right: 10px;
                                        /* Add margin between images */
                                    }
                                </style>
                                <div class="form-group my-3  col-sm-12 col-md-12 col-lg-12 ml-1">
                                    <label class=" btn btn-success mb-2" for="files">Gallery
                                        Images </label>
                                    <input type="file" class="form-control  bg-white " multiple="multiple"
                                        accept="image/jpeg, image/png, image/jpg" id="files" hidden name="extraimage[]"
                                        style="height: 60px;">
                                    <div class="col-lg-12 dropzone image-preview-container">
                                        <div id="imagePreviewContainer" class="mt-3 row"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-3 col-md-4 col-lg-3">
                                    <input type="submit"
                                        style="width: 100%; height:60px;outline:none;background-color:#00ae00;font-size:22px;color:white"
                                        value="Save Project">
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

            </div>

            <!-- Footer Start -->
            <div class="container-fluid  pt-4">
                <div class="bg-white rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Oribit Enterprises Brochure</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="#">Asad Tariq Saddiqui</a>
                            <br />Contact:
                            <a href="#" target="_blank">+92 348 9979762</a>
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
    <script>
    $(document).ready(function() {
        // Initialize TinyMCE on the textarea with the provided ID
        tinymce.init({
            selector: '#exampleFormControlTextarea2', // ID of your textarea
            plugins: 'advlist autolink lists link table charmap print preview hr anchor pagebreak',
            toolbar: 'undo redo | formatselect |  bold italic strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | table | removeformat | code'
        });

        tinymce.init({
            selector: '#exampleFormControlTextarea3', // ID of your textarea
            plugins: 'advlist autolink lists table  link charmap print preview hr anchor pagebreak',
            toolbar: 'undo redo | formatselect | bold italic strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | table | removeformat | code'
        });
        tinymce.init({
            selector: '#exampleFormControlTextarea10', // ID of your textarea
            plugins: 'advlist autolink lists table  link charmap print preview hr anchor pagebreak',
            toolbar: 'undo redo | formatselect | bold italic strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | table | removeformat | code'
        });
        tinymce.init({
            selector: '#floorplans', // ID of your textarea
            plugins: 'advlist autolink lists table  link charmap print preview hr anchor pagebreak',
            toolbar: 'undo redo | formatselect | bold italic strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | table | removeformat | code'
        });
        tinymce.init({
            selector: '#maplocationtext', // ID of your textarea
            plugins: 'advlist autolink lists table  link charmap print preview hr anchor pagebreak',
            toolbar: 'undo redo | formatselect | bold italic strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | table | removeformat | code'
        });
    });
    </script>
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
    <script>
    $(document).ready(function() {
        $('#files').change(function() {
            $('#imagePreviewContainer').empty(); // Clear previous previews

            // Limit the number of selected images to 10
            var maxImages = 8;
            var selectedImages = this.files.length;

            // Check if the number of selected images exceeds the limit
            if (selectedImages > maxImages) {
                alert("You can only select up to 8 images.");
                return;
            }

            // Loop through selected files
            for (let i = 0; i < selectedImages; i++) {
                const file = this.files[i];
                const reader = new FileReader();

                // Check if the file type is valid (JPG, PNG, or JPEG)
                if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                    alert("Please select only JPG, PNG, or JPEG images.");
                    return;
                }

                // Read the image file as a data URL
                reader.readAsDataURL(file);

                // Add an image preview once the file is loaded
                reader.onload = function(e) {
                    $('#imagePreviewContainer').append(
                        '<div class="col-md-3"><img src="' + e.target.result +
                        '" class="img-thumbnail img-preview" style="width: 300px; height: 300px;"></div>'
                    );
                };
            }
        });
    });
    </script>

</body>

</html>