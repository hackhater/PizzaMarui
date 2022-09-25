<?php
require('connection.php');

if (isset($_SESSION['$cid'])) {
    $uinfoquery = "SELECT * FROM customer WHERE CustomerID = '" . $_SESSION['cid'] . "'";
    $runuinfoquery = mysqli_query($connection, $uinfoquery);
    $uinfo = mysqli_fetch_array($runuinfoquery);
} else {
    echo "<script>alert('You need to login first!')</script>";
    echo "<script>location = history.back()</script>";
}

if (isset($_POST['btnupdate'])) {
    $email = $_POST['email'];
    $password = $_POST['confirmpassword'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $todaydate = date('Y-m-d');
    if ($todaydate - $dob >= 18) {
        $filepath = "Profile/";
        if (!isset($_POST['profilepic'])) {
            $profile = $uinfo['ProfilePicture'];
        } else {
            $filename = $_FILES['profilepic']['name'];
            $profile = $filepath . "" . $filename;
            $copy = copy($_FILES['profilepic']['tmp_name'], $profile);
            if (!$copy) {
                exit("Problem occur in image store! Please try again!");
            }
        }
        $updatequery = "UPDATE customer SET CustomerName = '$name',Email = '$email',Password = '$password',DateOfBirth = '$dob',Phone = '$phone',Gender = '$gender',ProfilePicture = '$profile',Address = '$address' WHERE CustomerID = '" . $_SESSION['cid'] . "'";
        echo $runupdate = mysqli_query($connection, $updatequery);
        echo "<script>alert('<?php echo isset($runupdate) ?>')</script>";
        if ($runupdate) {
            echo "<script>alert('User Account Information Updated Successfully!')</script>";
            echo "<script>location = 'profile.php'</script>";
        } else {
            echo "<script>alert('Something went wrong! Please try again!')</script>";
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
    <title>Update</title>
    <?php include('links.php') ?>
    <style>

    </style>
</head>

<body>
    <?php require('navibar.php'); ?>
    <form action="" method="POST" enctype="multipart/form-data" id="reg_form">
        <h2>Edit Profile</h2>
        <fieldset>
            <legend>Account info</legend>
            <table>
                <tr>
                    <td class="txtleft">Email</td>
                    <td><input type="email" name="email" placeholder="example@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please Enter Valid Email Id" value="<?php echo $uinfo['Email']; ?>" required readonly></td>
                </tr>
                <tr>
                    <td class="txtleft">Password</td>
                    <td><input type="password" name="password" id="password" placeholder="*****" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[#?!@$%^&*-\]\[]).{8,}" title="Must contain at least one number, one special character, one uppercase, lowercase letter and at least 8 or more characters" value="<?php echo $uinfo['Password']; ?>" required></td>
                </tr>
                <tr>
                    <td class="txtleft">Confirm Password</td>
                    <td><input type="password" name="confirmpassword" placeholder="*****" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[#?!@$%^&*-\]\[]).{8,}" oninput="check(this)" value="<?php echo $uinfo['Password']; ?>" required></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Personal info</legend>
            <table>
                <tr>
                    <td class="txtleft">Name</td>
                    <td><input type="text" placeholder="Eg: John" name="name" value="<?php echo $uinfo['CustomerName']; ?>" required></td>
                </tr>
                <tr>
                    <td class="txtleft">Birthday</td>
                    <td><input type="date" name="dob" value="<?php echo $uinfo['DateOfBirth']; ?>" required></td>
                </tr>
                <tr>
                    <td class="txtleft">Phone</td>
                    <td><input type="text" placeholder="09-XXXXXXXXX" name="phone" maxlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $uinfo['Phone']; ?>" required></td>
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
                    <td><img src="#" id="profilepv"><input type="file" name="profilepic" id="profilepic"></td>
                </tr>
                <tr>
                    <td class="txtleft">Address</td>
                    <td><textarea name="address" placeholder="Street/City" col="20" row="10" required><?php echo $uinfo['Address']; ?></textarea></td>
                </tr>
            </table>
        </fieldset>
        <table>
            <tr>
                <td><input type="submit" name="btnupdate" value="Update"></td>
                <td><input type="button" value="Back" onclick="location.href='profile.php'"></td>
            </tr>
        </table>
    </form>
    <?php include('footer.php'); ?>

    <script>
        $(document).ready(function() {
            $('#profilepv').attr('src', '<?php echo $uinfo['ProfilePicture']; ?>')
            $('#gender').val("<?php echo $uinfo['Gender']; ?>").change()
        })
    </script>

    <script language='javascript' type='text/javascript'>

        function check(input) {
            if (input.value != document.getElementById('password').value) {
                input.setCustomValidity('Password Does Not Match.');
            } else {
                // input is valid -- reset the error message
                input.setCustomValidity('');
            }
        }

        const profilepic = document.getElementById('profilepic')
        const profilepv = document.getElementById('profilepv')
        profilepic.addEventListener('change', function() {
            let [file] = profilepic.files
            if (file) {
                profilepv.src = URL.createObjectURL(file);
            }
        })
    </script>
</body>

</html>