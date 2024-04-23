<?php
// $con = mysqli_connect("localhost","root","","realestatephp");
if (mysqli_connect_errno())
require("config.php");

if (isset($_POST['bookingpexport'])) {
    # code...

// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

// Excel file name for download 
$fileName = "Projects" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('ID', 'FIRST NAME', 'LAST NAME','FATHER NAME','COUNTRY','CITY','EMAIL','PHONE #','ADDRESS','PROJECT NAME','PROJECT ADDRESS','FLOOR #','COUNTRY','PRICE','MEETING DAY','MEETING PLACE','BOOKING TYPE','BOOKING STATUS','DATE'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $con->query("SELECT *FROM booking;
"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
      
        $lineData = array($row['b_id'], $row['first_name'], $row['last_name'],$row['father_name'],$row['my_country'],$row['my_email'],$row['my_city'],$row['phone_no'],$row['my_address'],$row['proj_name'],$row['proj_address'],$row['proj_f_no'],$row['proj_country'],$row['proj_floor_price'],$row['proj_meeting'],$row['proj_meeting_place'],$row['booking_type'],$row['b_status'],$row['date']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
}
