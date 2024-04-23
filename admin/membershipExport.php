<?php
require("config.php");
if (isset($_POST['membershipexport'])) {
    # code...

// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

// Excel file name for download 
$fileName = "Member ship" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('ID', 'PURCHASE TYPE', 'QUANTITY','UNIT PRICE','DURATION','TRANSACTION ID','TRANSACTION TYPE','CLIENT CARD #','STATUS','AGENCY NAME','AGENCY PHONE #','AGENCY EMAIL','DATE'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $con->query("SELECT purchase_cart.*,user.agency_name,user.company_phone,user.company_email FROM `purchase_cart`,user where user.uid=purchase_cart.agent_id;
"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
      
        $lineData = array($row['cart_id'], $row['cart_type'], $row['cart_quantity'],$row['cart_unit_price'],$row['cart_duration'],$row['trancs_id'],$row['tranc_type'],$row['client_card_no'],$row['cart_status'],$row['agency_name'],$row['company_phone'],$row['company_email'],$row['Date']); 
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
