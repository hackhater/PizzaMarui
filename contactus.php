<?php
require('connection.php');
if (isset($_SESSION['cid'])) {
    $uinfoquery = "SELECT * FROM customer WHERE CustomerID = '" . $_SESSION['cid'] . "'";
    $runuinfoquery = mysqli_query($connection, $uinfoquery);
    $uinfo = mysqli_fetch_array($runuinfoquery);
}
if (isset($_POST['btnsubmit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $contactusquery = "INSERT INTO contactus(Name,Email,Phone,Message) VALUES('$name','$email','$phone','$message')";
    $runcontactusquery = mysqli_query($connection, $contactusquery);
    if ($runcontactusquery) {
        echo "<script>alert('We have received your message! Thank you for contacting us.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <?php include('links.php'); ?>
</head>

<body>
    <?php include('navibar.php'); ?>
    <form action="" method="POST" id="reg_form">
        <h2>Contact Us</h2>
        <fieldset style="border: 0; border-color: none;">
            <table>
                <tr>
                    <td class="txtleft">Name</td>
                    <td><input type="text" placeholder="Eg: John" name="name" value="<?php echo $uinfo['CustomerName']; ?>" required></td>
                </tr>
                <tr>
                    <td class="txtleft">Email</td>
                    <td><input type="email" name="email" placeholder="example@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please Enter Valid Email Id" value="<?php echo $uinfo['Email']; ?>" required></td>
                </tr>
                <tr>
                    <td class="txtleft">Phone</td>
                    <td><input type="text" placeholder="09-XXXXXXXXX" name="phone" maxlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $uinfo['Phone']; ?>" required></td>
                </tr>
                <tr>
                    <td class="txtleft">Message</td>
                    <td><textarea name="message" placeholder="Write your message here!" col="50" row="30" style="height: 80px;" required></textarea></td>
                </tr>
            </table>
        </fieldset>
        <table>
            <tr>
                <td><input type="submit" name="btnsubmit" value="Submit"></td>
                <td><input type="button" value="back" onclick="location = history.back()"></td>
            </tr>
        </table>
    </form>
    <?php include('footer.php'); ?>
</body>

</html>