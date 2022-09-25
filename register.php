<?php
require('connection.php');
if (isset($_SESSION['cid'])) {
    echo "<script>alert('You are already logged in!');</script>";
    echo "<script>location = history.back()</script>";
}
if (isset($_POST['btnregister'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $profile = $_FILES['profilepic']['name'];
    $address = $_POST['address'];
    $todaydate = date('Y-m-d');

    if ($todaydate - $dob >= 18) {
        $emailvalidation = "SELECT * FROM customer WHERE Email = '$email'";
        $runemailvalidation = mysqli_query($connection, $emailvalidation);
        $emailstatus = mysqli_num_rows($runemailvalidation);
        if (!$emailstatus) {
            $filepath = "Profile/";
            if ($profile) { // Profile Copy to server
                $filename = $filepath . "" . $profile;
                $copy = copy($_FILES['profilepic']['tmp_name'], $filename);
                if (!$copy) {
                    exit("Problem occur in image store! Please try again!");
                }
            }
            $insertquery = "INSERT INTO customer(CustomerName,Email,Password,DateOfBirth,Phone,Gender,ProfilePicture,Address) VALUES('$name','$email','$password','$dob','$phone','$gender','$filename','$address')";
            $runinsert = mysqli_query($connection, $insertquery);
            if ($runinsert) {
                echo "<script>alert('User Account Successfully Created.')</script>";
                echo "<script>location = 'login.php'</script>";
            } else {
                echo "<script>alert('Something went wrong! Please try again!')</script>";
            }
        } else {
            echo "<script>alert('Email already registered!');</script>";
        }
    } else {
        echo "<script>alert('You must be at least 18 years old to create account!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Registration</title>
    <?php include('links.php') ?>
</head>

<body>
    <?php require('navibar.php') ?>
    <form action="" method="POST" enctype="multipart/form-data" id="reg_form">
        <h2>Account Registration</h2>
        <fieldset>
            <legend>Account info</legend>
            <table>
                <tr>
                    <td class="txtleft">Email</td>
                    <td><input type="email" name="email" placeholder="example@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please Enter Valid Email Id" required></td>
                </tr>
                <tr>
                    <td class="txtleft">Password</td>
                    <td><input type="password" name="password" placeholder="*****" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[#?!@$%^&*-\]\[]).{8,}" title="Must contain at least one number, one special character, one uppercase, lowercase letter and at least 8 or more characters" required></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Personal info</legend>
            <table>
                <tr>
                    <td class="txtleft">Name</td>
                    <td><input type="text" placeholder="Eg: John" name="name" required></td>
                </tr>
                <tr>
                    <td class="txtleft">Birthday</td>
                    <td><input type="date" name="dob" required></td>
                </tr>
                <tr>
                    <td class="txtleft">Phone</td>
                    <td><input type="text" placeholder="09-XXXXXXXXX" name="phone" maxlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required></td>
                </tr>
                <tr>
                    <td class="txtleft">Gender</td>
                    <td>
                        <select id="gender" name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="txtleft">Profile Pic</td>
                    <td><input type="file" name="profilepic" required></td>
                </tr>
                <tr>
                    <td class="txtleft">Address</td>
                    <td><textarea name="address" placeholder="Street/City" col="20" row="10" required></textarea></td>
                </tr>
            </table>
        </fieldset>
        <table>
            <tr>
                <td><input type="submit" name="btnregister" value="Register"></td>
                <td><input type="button" value="Back" onclick="location.href='login.php'"></td>
            </tr>
        </table>
    </form>
    <?php include('footer.php'); ?>
</body>

</html>