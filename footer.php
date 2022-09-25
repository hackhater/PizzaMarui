<?php require('connection.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<footer>
        <section>
            <ul>
                <caption><h4>Naviagtion</h4></caption>
                <li><a href="index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="contactus.php">Contact us</a></li>
            </ul>
            <ul>
                <caption><h4>Account</h4></caption>
                <?php
                    if(isset($_SESSION['cid'])){
                        echo '<li><a href="profile.php">Profile</a></li>';
                        echo '<li><a href="logout.php">Logout</a></li>';
                    }else{
                        echo '<li><a href="login.php">Login</a></li>';
                    }
                ?>
            </ul>
            <ul id="footer_contact">
                <caption><h4>Pizza Marui Contact info</h4></caption>
                <i class="location_icon"></i><li>Shwe Gone Dai Rd and Banyardala Rd, Ocean <br>Super Center, 1st Floor near elevator, yangon.</li>
                <i class="phone_icon"></i><li>09-123456789, 09-987654321, 01-654321</li>
                <i class="email_icon"></i><li>info@pizzamarui.com</li>
            </ul>
        </section>
        <p>&copy; 2022 The Pizza Marui, Myanmar. All Right Reserved. <br> Designed & Developed By <i>Lwin Phyo Aung.</i></p>
    </footer>
</body>
</html>