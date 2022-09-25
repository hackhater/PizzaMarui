<?php
session_start();
if(isset($_SESSION)){
    session_destroy();
    // session_start();

    // unset($_SESSION['cid']);
    // unset($_SESSION['cname']);
    echo "<script>location = history.back()</script>";
}//else{
//     echo "<script>location = history.back()</script>";
// }
?>