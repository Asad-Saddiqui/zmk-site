<?php
session_start();
require("./config/config.php");
include('./check_status.php');

if (!isset($_SESSION['adminEmail'])) {
    header("location:../login.php");
}

$id = $_GET['id'];
if (!is_numeric($id)) {
    header("location:projectlist.php");
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function generateUniqueName($originalName)
{
    return time() . uniqid() . '-' . $originalName;
}
function generateUniqueName1($originalName,$i)
{
    return time() . uniqid() . '-'.$i.'-' . $originalName;
}

$error = "";
$success = "";

$mysqli_i = mysqli_query($con, "SELECT * FROM projects where project_id=$id");
$num = mysqli_num_rows($mysqli_i);
$mysqli_i_ = mysqli_query($con, "SELECT * FROM projectsextends where porEid=$id");
$rows_ = mysqli_fetch_assoc($mysqli_i);
$rows__ = mysqli_fetch_assoc($mysqli_i_);
if ($num !== 1) {
    header("location:projectlist.php");
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define maximum lengths for fields
    $maxProjectNameLength = 100;
    $maxMapUrlLength = 300;
    $maxAddressLength = 70;
    $maxFeaturesLength = 800;
    $maxDescriptionLength = 4500;

    // Validate and sanitize form inputs
    $projectName = isset($_POST['project_name']) ? test_input($_POST['project_name']) : "";
    $city = isset($_POST['city']) ? test_input($_POST['city']) : "";
    $mapUrl = isset($_POST['map_url']) ? $_POST['map_url'] : "";
    $address = isset($_POST['address']) ? test_input($_POST['address']) : "";
    $features = isset($_POST['features']) ? test_input($_POST['features']) : "";
    $description = isset($_POST['description']) ? test_input($_POST['description']) : "";
    $AboutNOC = isset($_POST['AboutNOC']) ? test_input($_POST['AboutNOC']) : "";
    $category = isset($_POST['category']) ? test_input($_POST['category']) : "";
    $ListingCategory = isset($_POST['ListingCategory']) ? test_input($_POST['ListingCategory']) : "";
    $extradescription = isset($_POST['extradescription']) ? test_input($_POST['extradescription']) : "";
    $maplocationtext = isset($_POST['maplocationtext']) ? test_input($_POST['maplocationtext']) : "";
    $floorplans = isset($_POST['floorplans']) ? test_input($_POST['floorplans']) : "";

    $uniqueName = "";

    if (strlen($projectName) > $maxProjectNameLength || empty($projectName)) {
        $error = "Project name is too long | OR |Empty";
    } elseif (strlen($mapUrl) > $maxMapUrlLength || empty($mapUrl)) {
        $error = "Map URL is too long. | OR |Empty";
    } elseif (strlen($city) > 40 || empty($city)) {
        $error = "Map City is too long. | OR |Empty";
    } elseif (strlen($address) > $maxAddressLength || empty($address)) {
        $error = "Address is too long. | OR |Empty";
    } elseif (strlen($features) > $maxFeaturesLength || empty($features)) {
        $error = "Features are too long. | OR |Empty";
    } elseif (strlen($extradescription) > 4500 || empty($extradescription)) {
        $error = "Description is too long. | OR |Empty";
    } elseif (strlen($description) > $maxDescriptionLength || empty($description)) {
        $error = "Description is too long. | OR |Empty";
    }elseif (strlen($maplocationtext) > $maxDescriptionLength || empty($description)) {
        $error = "Map location text is too long. | OR |Empty";
    } elseif (strlen($floorplans) > $maxDescriptionLength || empty($description)) {
        $error = "Floor plans is too long. | OR |Empty";
    } elseif (strlen($AboutNOC) > $maxDescriptionLength || empty($AboutNOC)) {
        $error = "NOC is too long. | OR |Empty";
    } elseif (strlen($ListingCategory) > 50 || empty($ListingCategory)) {
        $error = "Listing Category is too long. | OR |Empty";
    } elseif (strlen($category) > 50 || empty($category)) {
        $error = "Category is too long. | OR |Empty";
    } else {

        $max_file_size = 7 * 1024 * 1024;
        $img1 = handleFileUpload('project_image', $max_file_size, array('image/jpeg', 'image/png', 'image/jpg'), $rows_['project_image']);
        $img2 = handleFileUpload('NocRelatedImage', $max_file_size, array('image/jpeg', 'image/png', 'image/jpg'), $rows_['Noc Related Image :']);
        $pdf1 = handleFileUpload('PricingDocument', $max_file_size, array('application/pdf'), $rows_['PricingDocument']);
        $ownerimg = handleFileUpload('ownerimg', $max_file_size, array('image/jpeg', 'image/png', 'image/jpg'), $rows_['ownerimge']);
        $maplocatioimage = handleFileUpload('maplocatioimage', $max_file_size, array('image/jpeg', 'image/png', 'image/jpg'), $rows_['maplocationimg']);
        $pdf2 = handleFileUpload2('extraimage', $max_file_size, array('image/jpeg', 'image/png', 'image/jpg'), $rows_['RequireDocuments']);

        if ($img1 && $img2 && $pdf1 && $pdf2 && $ownerimg && $maplocatioimage) {
            $mysqli_ = mysqli_query($con, "SELECT * FROM projects where project_name='$projectName'");
            $num = mysqli_num_rows($mysqli_);
            $numRow = mysqli_fetch_assoc($mysqli_);
            $sqli = "";
            if ($num == 1) {
                if ($projectName === (string)$numRow['project_name']) {
                    $sqli = "UPDATE `projects` SET 
                    `project_name`='$projectName', 
                    `map_url`='$mapUrl', 
                    `address`='$address',
                    `features`='$features',
                    `description`='$description', 
                    `category`='$category', 
                    `project_image`='$img1',
                    `ListingCategory`='$ListingCategory', 
                    `PricingDocument`='$pdf1', 
                    `AboutNOC`='$AboutNOC', 
                    `Noc Related Image :`='$img2', 
                    `FacilitiesandAmenties`='$extradescription', 
                    `RequireDocuments`='$pdf2',
                    `RequireDocuments`='$pdf2',
                    `city`='$city',
                    `maplocationimg`='$maplocatioimage',
                    `ownerimge`='$ownerimg'
                     WHERE project_id=$id";
                }else{
                    $proj=(string)$numRow['project_name'];
                     $sqli = "UPDATE `projects` SET 
                    `project_name`='$proj', 
                    `map_url`='$mapUrl', 
                    `address`='$address',
                    `features`='$features',
                    `description`='$description', 
                    `category`='$category', 
                    `project_image`='$img1',
                    `ListingCategory`='$ListingCategory', 
                    `PricingDocument`='$pdf1', 
                    `AboutNOC`='$AboutNOC', 
                    `Noc Related Image :`='$img2', 
                    `FacilitiesandAmenties`='$extradescription', 
                    `RequireDocuments`='$pdf2',
                    `city`='$city',
                    `maplocationimg`='$maplocatioimage',
                    `ownerimge`='$ownerimg'
                     WHERE project_id=$id";
                }
            } else {
                $sqli = "UPDATE `projects` SET 
                    `project_name`='$projectName', 
                    `map_url`='$mapUrl', 
                    `address`='$address',
                    `features`='$features',
                    `description`='$description', 
                    `category`='$category', 
                    `project_image`='$img1',
                    `ListingCategory`='$ListingCategory', 
                    `PricingDocument`='$pdf1', 
                    `AboutNOC`='$AboutNOC', 
                    `Noc Related Image :`='$img2', 
                    `FacilitiesandAmenties`='$extradescription', 
                    `RequireDocuments`='$pdf2',
                    `city`='$city',
                    `maplocationimg`='$maplocatioimage',
                    `ownerimge`='$ownerimg'
                     WHERE project_id=$id";
            }
            if (mysqli_query($con, $sqli)) {
                 if(mysqli_query($con, "UPDATE `projectsextends` SET `maplocationtext` = '$maplocationtext', `floorplan` = '$floorplans' WHERE `projectsextends`.`porEid` = $id;")){
                     echo '<script>alert("Project Updated Successfuly")</script>';
                 }
            } else {
                $error = "Error: " . mysqli_error($con);
            }
        } else {
            $error = "Please upload correct files.";
        }
    }

    if (!empty($error)) {
        echo '<script>alert("' . $error . '")</script>';
    }
}
                function handleFileUpload2($fileInputName, $maxFileSize, $allowedTypes, $unlinkname)
                { 
                        $namesImages = [];
                        $imagePaths = [];
                        $maxImages = 4;
                        $maxSize = 7 * 1024 * 1024;
                        
                        $totalFiles = count($_FILES[$fileInputName]['name']);
                        if($totalFiles>0){
                            for ($i = 0; $i < $totalFiles; $i++) {
                                $originalName = $_FILES[$fileInputName]['name'][$i];
                                $tmpName = $_FILES[$fileInputName]['tmp_name'][$i];
                                $size = $_FILES[$fileInputName]['size'][$i];
                                $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                                if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                                    // Skip the current file if it has an invalid format
                                    continue;
                                }
                                if ($size > $maxSize) {
                                    // Skip the current file if it exceeds the maximum size
                                    continue;
                                }
                                $uniqueName_ = generateUniqueName1($originalName, $i);
                                $namesImages[] = $uniqueName_;
                                $imagePaths[] = $tmpName;
                                $uploadPath = './uploads/' . $uniqueName_ ; // Change this path as needed
                                move_uploaded_file($tmpName, $uploadPath);
                                if (count($imagePaths) >= $maxImages) {
                                    // Stop processing after reaching the maximum number of images
                                    break;
                                }
                            }
                            if(count($imagePaths)>0){
                             $json_encode = json_encode($namesImages);
                              $array = json_decode($unlinkname);
                              var_dump($array);
                               for ($i=0; $i <count($array) ; $i++) { 
                                $path = './uploads/' . $array[$i];
                                if (file_exists($path)) {
                                    unlink($path);
                                }
                               }
                             return $json_encode;

                            }else{
                                return $unlinkname;
                            }
                       
                       
                        }else{
                            return $unlinkname;
                        }
                }
                    function handleFileUpload($fileInputName, $maxFileSize, $allowedTypes, $unlinename)
                    {
                        global $error;
                        $file = $_FILES[$fileInputName];
                        if (!empty($file['name'])) {
                            $file_name = $file['name'];
                            $file_tmp_name = $file['tmp_name'];
                            $file_size = $file['size'];
                            $file_type = $file['type'];
                            if ($file_size > $maxFileSize) {
                                echo '<script>alert("File Size is too long")</script>';
                                return $unlinename;
                            }
                            if (!in_array($file_type, $allowedTypes)) {
                                $error = "Invalid file type for $fileInputName. Supported formats: .$allowedTypes.";
                                echo '<script>alert(" '.$error.'")</script>';
                                return $unlinename;
                            }
                            $uniqueName = generateUniqueName($file_name);
                            $uploadPath = './uploads/' . $uniqueName; // Change this path as needed
                            if (move_uploaded_file($file_tmp_name, $uploadPath)) {
                                if ($unlinename) {
                                    $path = './uploads/' . $unlinename;
                                    if (file_exists($path)) {
                                        unlink($path);
                                    }
                                }

                                return $uniqueName;
                            } else {
                                // $error = "Failed to upload file.";
                                return $unlinename;
                            }
                        }
                        return $unlinename;
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
                        <h2 class="text-dark"><?php echo $error;
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
                                    <label style="color:black; font-size:20px; font-weight:bold" for="exampleFormControlInput1 col-md-">Project Name :</label>
                                    <input type="text" class="form-control  bg-white " id="input" value="<?php echo htmlspecialchars($rows_['project_name']) ?>" name="project_name" style="border-radius:0px" id="exampleFormControlInput1" placeholder="Enter project name">
                                </div>
                                <div class="form-group my-2  col-sm-12 col-md-6 col-lg-6 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold" for="exampleFormControlInput1 col-md-">Project Image</label>
                                    <input type="file" class="form-control  bg-white " name="project_image" id="input" id="exampleFormControlInput1" style="height: 60px;">
                                </div>
                                <div class="form-group my-2   col-sm-12 col-md-6 col-lg-6 mr-1">
                                    <label style="color:black; font-size:20px; font-weight:bold" for="exampleFormControlInput1 col-md-">Category</label>
                                    <select class="form-control  bg-white " name="category" id="input">
                                        <option value="Sale" <?php $type = (string)$rows_['category'];
                                                                if ($type === "Sale") {
                                                                ?> selected <?php }
                                                                            ?>>Sale</option>
                                        <option value="Rent" <?php $type = (string)$rows_['category'];
                                                                if ($type === "Rent") {
                                                                ?> selected <?php }
                                                                            ?>>Rent</option>
                                    </select>
                                </div>
                                <div class="form-group my-2   col-sm-12 col-md-6 col-lg-6 mr-1">
                                    <label style="color:black; font-size:20px; font-weight:bold" for="exampleFormControlInput1 col-md-">Listing Category</label>
                                    <select class="form-control  bg-white " name="ListingCategory" id="input">
                                        <option value="Society" <?php $type = (string)$rows_['ListingCategory'];
                                                                if ($type === "Society") {
                                                                ?> selected <?php }
                                                                            ?>>Society</option>
                                        <option value="Project" <?php $type = (string)$rows_['ListingCategory'];
                                                                if ($type === "Project") {
                                                                ?> selected <?php }
                                                                            ?>>Project</option>
                                    </select>
                                </div>
                                <div class="form-group my-2  col-sm-12 col-md-6 col-lg-6 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold" for="exampleFormControlInput1 col-md-">City</label>
                                    <input type="text" class="form-control  bg-white" id="input" value="<?php echo htmlspecialchars($rows_['city']) ?>" name="city" id="exampleFormControlInput1" maxlength="300" placeholder="Enter Map Location">
                                </div>
                                <div class="form-group my-2  col-sm-12 col-md-6 col-lg-6 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold" for="exampleFormControlInput1 col-md-">Map URL</label>
                                    <input type="url" class="form-control  bg-white" id="input" value="<?php echo $rows_['map_url'] ?>" name="map_url" id="exampleFormControlInput1" maxlength="300" placeholder="Enter Map Location">
                                </div>
                                <div class="form-group my-2  col-sm-12 col-md-12 col-lg-12 ">
                                    <label style="color:black; font-size:20px; font-weight:bold" for="exampleFormControlInput1 col-md-">Address</label>
                                    <input type="text " class="form-control  bg-white " value="<?php echo htmlspecialchars($rows_['address']) ?>" id="input" name="address" id="exampleFormControlInput1" maxlength="70" placeholder="Enter Address less then 80 characters">
                                </div>
                                <div class="form-group  my-3">
                                    <label style="color:black; font-size:20px; font-weight:bold" for="exampleFormControlTextarea1">Introduction</label>
                                    <textarea class="form-control   bg-white gb-white text-dark " maxlength="800" name="features" placeholder="Enter Some Features less then 700 characters" id="exampleFormControlTextarea" rows="3"><?php echo $rows_['features'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label style="color:black; font-size:20px; font-weight:bold" for="exampleFormControlTextarea1">Owner and Developer Information</label>
                                    <p class="alert alert-danger">* Important Please Do Not Remove Below Content Only Replace Content or Details</p>

                                    <textarea class="form-control  bg-white " name="description" maxlength="4500" placeholder="Enter Some Description less then 4500 characters" id="exampleFormControlTextarea2" rows="3"><?php echo $rows_['description'] ?></textarea>
                                </div>
                                 <div class="form-group my-3  col-sm-12 col-md-12 col-lg-12 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">Owner and developer related Image</label>
                                    <input type="file" class="form-control  bg-white " name="ownerimg" id="input"
                                        id="exampleFormControlInput1" style="height: 60px;">
                                </div>
                                <div class="form-group">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlTextarea1">Map location Points</label>
                                    <p class="alert alert-danger">* Important Please Do Not Remove Below Content
                                        Only
                                        Replace Content or Details</p>

                                    <textarea class="form-control  bg-white " name="maplocationtext" maxlength="4500"
                                        placeholder="Enter Some Description less then 4500 characters"
                                        id="maplocationtext" rows="7"><?php echo $rows__['maplocationtext'] ?></textarea>
                                </div>
                                <div class="form-group my-3  col-sm-12 col-md-12 col-lg-12 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlInput1 col-md-">Map Location Image</label>
                                    <input type="file" class="form-control  bg-white " name="maplocatioimage" id="input"
                                        id="exampleFormControlInput1" style="height: 60px;">
                                </div>
                                 <div class="form-group">
                                    <label style="color:black; font-size:20px; font-weight:bold"
                                        for="exampleFormControlTextarea1">Floor Plans</label>
                                    <p class="alert alert-danger">* Important Please Do Not Remove Below Content
                                        Only
                                        Replace Content or Details</p>

                                    <textarea class="form-control  bg-white " name="floorplans" maxlength="4500"
                                        placeholder="Enter Some Description less then 4500 characters"
                                        id="floorplans" rows="7"><?php echo $rows__['floorplan'] ?></textarea>
                                </div>
                                <div class="form-group my-3  col-sm-12 col-md-12 col-lg-12 ml-1">
                                    
                                    <label style="color:black; font-size:20px; font-weight:bold" for="exampleFormControlInput1 col-md-">Pricing Document</label>
                                    <input type="file" class="form-control  bg-white " name="PricingDocument" id="input" id="exampleFormControlInput1" style="height: 60px;">
                                </div>
                                <div class="form-group my-3">
                                    <label style="color:black; font-size:20px; font-weight:bold" for="exampleFormControlTextarea2">About NOC</label>
                                    <p class="alert alert-danger">* Important Please Do Not Remove Below Content Only Replace Content or Details</p>
                                    <textarea class="form-control  bg-white" name="AboutNOC" maxlength="4500" placeholder="Enter Some Description less then 4500 characters" id="exampleFormControlTextarea3" rows="3"><?php echo $rows_['AboutNOC'] ?></textarea>
                                </div>
                                <div class="form-group my-3  col-sm-12 col-md-12 col-lg-12 ml-1">
                                    <label style="color:black; font-size:20px; font-weight:bold" for="exampleFormControlInput1 col-md-">Noc Related Image :</label>
                                    <input type="file" class="form-control  bg-white " name="NocRelatedImage" id="input" id="exampleFormControlInput1" style="height: 60px;">
                                </div>
                                <div class="form-group my-3">
                                    <label style="color:black; font-size:20px; font-weight:bold" for="exampleFormControlTextarea2">Facilities and Amenties</label>
                                    <p class="alert alert-danger">* Important Please Do Not Remove Below Content Only Replace Content or Details</p>

                                    <textarea class="tinymce form-control  bg-white" name="extradescription" maxlength="4500" placeholder="Enter Some Description less then 4500 characters" id="exampleFormControlTextarea10" rows="13"><?php echo $rows_['FacilitiesandAmenties']; ?></textarea>
                                </div>
                               
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
                                    <input type="submit" style="width: 100%; height:60px;outline:none;background-color:#00ae00;font-size:22px;color:white" value="Save Project">
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
    <!-- <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->


<script>
    $(document).ready(function() {
        $('#files').change(function() {
            $('#imagePreviewContainer').empty(); // Clear previous previews

            // Limit the number of selected images to 10
            var maxImages = 4;
            var selectedImages = this.files.length;

            // Check if the number of selected images exceeds the limit
            if (selectedImages > maxImages) {
                alert("You can only select up to 10 images.");
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