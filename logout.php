<?php
session_start();
if (isset($_SESSION['agentEmail'])) {
    unset($_SESSION['userID']);
    unset($_SESSION['userName']);
    unset($_SESSION['userImg']);
    unset($_SESSION['userEmail']);
    unset($_SESSION['user_Email']);
    unset($_SESSION['agentID']);
    unset($_SESSION['agentName']);
    unset($_SESSION['agentEmail']);
    unset($_SESSION['agentImg']);
} else {
    unset($_SESSION['userID']);
    unset($_SESSION['userName']);
    unset($_SESSION['userEmail']);
    unset($_SESSION['user_Email']);
    unset($_SESSION['userImg']);
}

header('location:login.php');
