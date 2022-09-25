<?php
require('connection.php');
if (isset($_SESSION['cid'])) {
    $uinfoquery = "SELECT * FROM customer WHERE CustomerID = '" . $_SESSION['cid'] . "'";
    $runuinfoquery = mysqli_query($connection, $uinfoquery);
    $uinfo = mysqli_fetch_array($runuinfoquery);
} else {
    echo "<script>alert('You need to login first!')</script>";
    echo "<script>location = history.back()</script>";
}
if(isset($_POST['btnedit'])) {
    echo "<script>location = 'update.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <?php include('links.php'); ?>
</head>

<body>
    <?php include('navibar.php'); ?>
    <form action="" method="POST" enctype="multipart/form-data" id="reg_form">
        <h2>User Profile</h2>
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
                <td><input type="submit" name="btnedit" value="Edit"></td>
                <td><input type="button" value="Back" onclick="location = history.back()"></td>
            </tr>
        </table>
    </form>
    <?php include('footer.php'); ?>

    <script>
        $(document).ready(function() {
            $('#reg_form input').attr('readonly', true);
            $('#reg_form #profilepic').attr('disabled', true);
            $('#reg_form select').attr('disabled', true);
            $('#reg_form textarea').attr('readonly', true);
            $('#profilepv').attr('src', '<?php echo $uinfo['ProfilePicture']; ?>')
            $('#gender').val("<?php echo $uinfo['Gender']; ?>").change()
        })

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