<?php
session_start();
require("./config/config.php");
include('./check_status.php');

// Validate session
if (!isset($_SESSION['adminEmail'])) {
    header("location:index.php");
    exit(); // Stop script execution after redirecting
}
$pid = $_GET['PID'];
if (!$pid || !is_numeric($pid)) {
    header("location:-view-pro.php");
}

// Function to generate a unique name for each image
function generateUniqueName($originalName)
{
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
    return time() . uniqid() . '-property-images.' . $extension;
}


$error = "";

function embedYouTubeVideo($url)
{
    // Regular expression patterns to match YouTube video URLs
    $regularPattern = '/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
    $shortsPattern = '/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/shorts\/)([a-zA-Z0-9_-]{11})/';

    // Check if the URL matches the regular pattern
    if (preg_match($regularPattern, $url, $matches)) {
        // Extract video ID
        $videoId = $matches[1];
        // Embed regular YouTube video
        return '<iframe width="100%" height="450" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allowfullscreen></iframe>';
    }
    // Check if the URL matches the shorts pattern
    elseif (preg_match($shortsPattern, $url, $matches)) {
        // Extract video ID
        $videoId = $matches[1];
        // Embed shorts video
        return '<iframe width="100%" height="450" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allowfullscreen></iframe>';
    } else {
        // Invalid YouTube URL
        return null;
    }
}



$imagePaths = [];
$pid = $_GET['PID'];
$imgError = "";
$validYoutubeUrls = [];
if ($pid) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $youtubeUrls = $_POST['youtub'];
        $erroOccure=false;
        if(empty($_FILES['imgfiles']['name'][0]) && empty(trim($youtubeUrls)) ){
        $erroOccure=true;
        echo '<script>alert("Please Upload Image and youtube video Link")</script>';
        }
       if(!$erroOccure){
            if(empty($_FILES['imgfiles']['name'][0]) ){
            $erroOccure=false;
            echo '<script>alert("Please Upload Image")</script>';
            }
            if(!$erroOccure){
                // if(empty(trim($youtubeUrls)) ){
                //     $erroOccure=false;
                //     echo '<script>alert("Please Enter youtube video Link")</script>';
                // }
                if(!$erroOccure){
                        $totalFiles = count($_FILES['imgfiles']['name']);
                        $namesImages=[] ;
                        $imagePaths=[];
                         $maxImages = 10;
                      $maxSize = 5 * 1024 * 1024; // 2 MB in bytes
                        for ($i = 0; $i < $totalFiles; $i++) {
                            $originalName = $_FILES['imgfiles']['name'][$i];
                            $tmpName = $_FILES['imgfiles']['tmp_name'][$i];
                            $size = $_FILES['imgfiles']['size'][$i];
                            $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                            if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                                // Skip the current file if it has an invalid format
                                continue;
                            }
                            if ($size > $maxSize) {
                                // Skip the current file if it exceeds the maximum size
                                continue;
                            }
                            $uniqueName = generateUniqueName($originalName);
                            $namesImages[] = $uniqueName;
                            $imagePaths[] = $tmpName;
                            if (count($imagePaths) >= $maxImages) {
                                // Stop processing after reaching the maximum number of images
                                break;
                            }
                        }
                        if(count($imagePaths)>0){
                          if (!$youtubeUrls ||  ($youtubeUrls && $ebedurl=embedYouTubeVideo($youtubeUrls))) {
                              
                                $validYoutubeUrls=$youtubeUrls?$ebedurl:"";
                                $images = "SELECT * FROM propertyimages WHERE pid=$pid;";
                                    $result_ = mysqli_query($con, $images);
                                    $imageFolder = "./uploads/";
                                    if ($result_) {
                                        while ($row = mysqli_fetch_assoc($result_)) {
                                            $imageName = $row['name'];
                                            $imagePath = $imageFolder . $imageName;
                                            unlink($imagePath);
                                        }
                                    }
                                    mysqli_query($con,"DELETE FROM propertyimages WHERE pid=$pid");
                                      $sql = "DELETE FROM `url` WHERE `url`.`pid` =$pid";
                                     $con->query($sql);
                                    for ($i=0; $i < count($imagePaths) ; $i++) { 
                                        $targetPath = './uploads/' . $namesImages[$i];
                                        
                                        $uid = 1;
                                        $path =$namesImages[$i];
                                            $sql = "INSERT INTO `propertyimages` (`imgId`, `name`, `pid`, `uid`) VALUES (NULL, '$path', $pid, $uid);";
                                            $con->query($sql); 
                                        move_uploaded_file($imagePaths[$i], $targetPath);
                                    }
                             $uid = 1;
                            $sql = "INSERT INTO `url` (`urlid`, `url`, `pid`, `uid`) VALUES (NULL, '$validYoutubeUrls', '$pid', '$uid');";
                            $con->query($sql);
                            propertyStatus($con, $pid, "UPDATE `complete` SET `4` = '1' WHERE `pid`=$pid ;");
                            header("location:-add-pro-info.php?PID=$pid");

                            }else{
                                 echo '<script>alert("Invalid Youtube Link")</script>';
                            }
                            
                        }else{
                        echo '<script>alert("Select atleast with valid image")</script>';

                        }
                         
                }
                   
                  
                
            }

    


       }
    }
} else {
    header("location:_addproperty.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Area-Price-Rent</title>
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

.mce-container-body {
    background: #111;
    color: #35ff00;
}

.mce-container {
    display: block;
    background-color: green;
}
</style>
<style>
/* CSS for image previews */
#imagePreviewContainer {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
}

.img-preview {
    width: 150px;
    height: 150px;
    margin: 5px;
    object-fit: cover;
}
</style>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <?php
        include("./common/sidebar.php");
        ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content "style="background-color:#e9ecef">
            <!-- Navbar Start -->
            <?php
            include("./common/navbar.php");
            ?>
            <div class="full-row  border  rounded bg-white" style="margin-top: 50px; margin-left: 25px; margin-right: 25px;">
                <form method="post" enctype="multipart/form-data">
                    <div class="d-flex justify-content-between">
                        <h2 class="mt-2 pt-2 text-center text-dark">Property Listing</h2>
                        <h2 class="mt-2 text-center  border border-info p-3 text-info " style="border-radius: 50%;">4
                        </h2>
                    </div>
                    <h2 class="mt-2 pt-2 text-center text-dark"><?php echo $error;
                                                                echo $imgError; ?></h2>

                    <style>
                    /* CSS for the dotted border and container height */
                    .image-preview-container {
                        min-height: 300px;
                        border: 2px dotted #aaa;
                        padding: 15px;
                        overflow-y: auto;
                        /* Add scrollbar if content overflows vertically */
                    }

                    /* CSS for the uploaded images */
                    .uploaded-image {
                        width: 150px;
                        /* Set the fixed width of the images */
                        height: 150px;
                        /* Set the fixed height of the images */
                        object-fit: cover;
                        /* Maintain aspect ratio */
                        margin-right: 10px;
                        /* Add margin between images */
                    }
                    </style>

                    <!-- HTML with modified container and image display -->
                    <div class="container rounded">
                        <div class="rounded-top p-4 bg-white " style="background-color:white;">
                            <div class="row row col-md-12  col-sm-12 col-lg-12">
                                <div class="col-lg-2 col-sm-12 col-md-3 text-center text-sm-start"
                                    style="color: dark; font-weight: 900; font-size:20px;">
                                    Property Images and Videos
                                </div>
                                <div class="col-lg-9 col-sm-12 col-md-8 text-center text-sm-start">
                                    <div class="form-group">
                                        <input type="file" hidden class="form-control bg-white my-2 text-dark"
                                            name="imgfiles[]" id="files" multiple="multiple"
                                            accept="image/jpeg, image/png, image/jpg" placeholder="Enter Property Title"
                                            style="background-color:white;" />

                                        <label class="btn btn-success my-2" for="files">Upload Images</label>
                                        <div class="col-lg-12 dropzone image-preview-container">
                                            <!-- Modified file input with drag and drop container -->

                                            <div id="imagePreviewContainer" class="mt-3 row"></div>
                                            <!-- Container for image previews -->
                                        </div>

                                        <label class="col-lg-3 col-form-label">Video</label>

                                        <div class="col-xl-12" id="dynamic_field">
                                            <div class="form-group row">
                                                <label name="add" id="you" class="col-lg-1 bg-white "
                                                    style="color:red;font-size:40px;"><i
                                                        class="bi bi bi-youtube"></i></label>
                                                <div class="col-lg-8">
                                                    <input type="url" class="form-control my-2 bg-white text-light"
                                                        name="youtub" placeholder="Add Youtube video link" />
                                                </div>
                                            </div>
                                        </div>
                                         <div class="row col-md-12 col-sm-12 col-lg-12 mt-2 bg-white ">
                                            <div class="col-md-4 col-sm-4 col-lg-4 "
                                                style="color: white; font-weight: 900; font-size:20px;">
                                                <input type="submit" class="btn btn-outline-info  text-center"
                                                    onclick="customButtonClick()" name="next" style="width: 150px;"
                                                    value="Next">
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-lg-4 text-center "
                                                style="color: white; font-weight: 900; font-size:20px;">
                                                <button class="btn btn-outline-danger"> <a
                                                        href="-add-pro-info.php?PID=<?php echo $pid; ?>">Skip</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>


                    <br>
                    <br>
                    <br>
                </form>
            </div>
            
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <!-- /////////////////////////////////////////// -->


    <!-- JavaScript Libraries -->
    <script src="assets/plugins/tinymce/tinymce.min.js"></script>
    <script src="assets/plugins/tinymce/init-tinymce.min.js"></script>
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
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<div class="form-group my-2 row" id="row' + i +
                '"><label  name="add" id="' + i +
                '" class="col-lg-1 bg-white btn_remove " style="color:red;font-size:40px;"><i class="bi bi bi-youtube"></i></label><div class="col-lg-8"><input type="url" class="form-control my-2 bg-white text-light" name="youtub[]"  placeholder="....." /></div><label  name="add" id="' +
                i +
                '" class="col-lg-1 bg-white btn_remove " style="margin-top:10px;font-size:20px;"><i class="bi bi-file-minus-fill"></i></label></div>'
                );
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

    });
    </script>
    <script>
    $(document).ready(function() {
        $('#files').change(function() {
            $('#imagePreviewContainer').empty(); // Clear previous previews

            // Limit the number of selected images to 10
            var maxImages = 10;
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
                        '" class="img-thumbnail img-preview" style="width: 300px; height: 100px;"></div>'
                    );
                };
            }
        });
    });
    </script>

</body>

</html>