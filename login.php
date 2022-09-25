<?php
require('connection.php');
if (isset($_SESSION)) {
    session_start();
    ini_set('session.cookie_secure', '0');
}

if (isset($_SESSION['cid'])) {
    echo "<script>alert('You are already logged in!');</script>";
    echo "<script>location = history.back()</script>";
}
if (isset($_POST['btnlogin'])) {
    $validatelogin = "SELECT * FROM customer WHERE Email = '" . $_POST['username'] . "' AND Password = '" . $_POST['password'] . "'";
    $runlogin = mysqli_query($connection, $validatelogin);
    $row = mysqli_num_rows($runlogin);
    if ($row > 0) {
        $data = mysqli_fetch_array($runlogin);
        $_SESSION['cid'] = $data['CustomerID'];
        $_SESSION['cname'] = $data['CustomerName'];
        $_SESSION['cprofile'] = $data['ProfilePicture'];
        echo "<script>window.location.replace('index.php')</script>";
    } else {
        echo "<script>alert('Username or Password incorrect! Please try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include('links.php') ?>
</head>

<body>
    <?php require('navibar.php') ?>
    <form action="" method="POST" id="login_form">
        <h2>Welcome Back!</h2>
        <table>
            <tr>
                <td colspan="2" class="txtleft">Username :<br><input type="email" name="username" placeholder="example@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please Enter Valid Email Id" required></td>
            </tr>
            <tr>
                <td colspan="2" class="txtleft">Password :<br><input type="password" name="password" placeholder="*****" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[#?!@$%^&*-\]\[]).{8,}" title="Must contain at least one number, one special character, one uppercase, lowercase letter and at least 8 or more characters" required></td>
            </tr>
            <tr>
                <td><input type="submit" name="btnlogin" value="Login"></td>
                <td><input type="button" value="Register" onclick="location.href='register.php'"></td>
            </tr>
        </table>
    </form>
    <?php include('footer.php'); ?>
</body>

</html>