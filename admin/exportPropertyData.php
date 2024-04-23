<?php
require("config.php");
if (isset($_POST['export'])) {
    # code...

// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

// Excel file name for download 
$fileName = "Properties" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('ID', 'PROPERTY PURPOSE', 'PROPERTY TYPE','CATEGORY','CITY','LOCATION','AREA SIZE','AREA SIZE IN','TOTAL PRICE','PRICE IN','INSTALLMEN','ADVANCE PAYMENT','NO OF INSTALLMENT','PAYMENT MONTHLY','BEDROOMS','BATHROOMS','TITLE','DESCRIPTION','POSTED BY','EMAIL','WHATSAPP NUMBER','LANDLINE NO','PLATEFORM','STATUS','DURATION','DATE','LISTING TYPE','USER TYPE'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $con->query("SELECT * FROM property"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
      
        $lineData = array($row['pid'], $row['propty_purpose'], $row['propty_type'],$row['home_value'],$row['citys'],$row['location'],$row['size_area'],$row['area_size_in_'],$row['_total_pricce_'],$row['_price_type'],$row['install_ment'],$row['payment_adv'],$row['number_installment'],$row['pyment_monthly'],$row['_bedroomsOptions'],$row['__bathroom_option'],$row['p__title'],$row['p__description'],$row['__postingAs__a'],$row['__postingEmail'],$row['__postingNumber__'],$row['__postingLandline__'],$row['__plateform__'],$row['status'],$row['duration'],$row['date'],$row['listing_type'],$row['user_type']); 
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
