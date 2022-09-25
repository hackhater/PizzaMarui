<?php require('connection.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <div id="navi">
        <a href="index.php"><img src="Image\pizza_logo.png" alt="PizzaLogo" id="logo"></a>
        <a href="index.php"  id="logo"><h2 style="text-decoration: none;">Pizza Marui</h2></a>
        <?php
            if(isset($_SESSION['cid'])){
                echo '<a href="logout.php" class="user">Logout</a>';
                echo '<a href="profile.php" class="user"><i class="profile_icon"></i>' . $_SESSION["cname"] . '</a>';
            }else{
                echo '<a href="login.php" id="login">Login</a>';
            }
        ?>
        <a href="contactus.php" class="menu">Contact us</a>
        <a href="menu.php" class="menu">Menu</a>
        <a href="index.php" class="menu">Home</a>
    </div>
    <script>
        $(document).ready(function() {
            $(".profile_icon").attr({style: "content:url(<?php echo $_SESSION['cprofile']; ?>)" })
        })
    </script>
</body>
</html>