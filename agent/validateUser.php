<?php


function validate($email, $id, $con)
{
    $sqli = mysqli_query($con, "SELECT * FROM user WHERE email='$email' and  role ='agent'and id =$id");
    $numrows = mysqli_num_rows($sqli);
    if ($numrows === 1) {
        return true;
    } else {
        return false;
    }
}
