<?php require('connection.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PizzaMarui</title>
    <?php include('links.php') ?>
</head>

<body>
    <?php require('navibar.php') ?>
    <section id="banner_container" title="Welcome to Pizza Marui! Best and Fresh Pizza!">
        <img src="Image/pizzabanner1.png" alt="">
        <img src="Image/pizzabanner2.png" alt="">
        <img src="Image/pizzabanner3.png" alt="">
    </section>
    <h2>About Us</h2>
    <section id="about_us">
        <div class="abt_content">
            <img src="Image/pizza.jpg" alt="">
            <h3>Our Product</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere vitae eius animi incidunt quas est. Dolore enim fugiat possimus, deleniti quaerat fugit aliquam quos deserunt ullam, reiciendis eius accusamus iste.</p>
        </div>
        <div class="abt_right">
            <img src="Image/Hawaiian_Pizza.jpg" alt="">
            <h3>Our Services</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora assumenda ipsam placeat iusto commodi esse nihil eum fuga magnam soluta, impedit ullam possimus. Incidunt, eligendi quisquam architecto eum fugiat vitae?</p>
        </div>
    </section>
    <h2>Location</h2>
    <section id="location">
        <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1909.6509927235954!2d96.1691671408615!3d16.81136834061808!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ecb6e32dddc5%3A0x4ada44a13abf5acf!2sOcean%20Super%20Center!5e0!3m2!1sen!2ssg!4v1657284894343!5m2!1sen!2ssg" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div id="info">
            <table>
                <h3>Shop Location</h3>
                <tr>
                    <td><b>Address</b></td>
                    <td> : <span>Shwe Gone Dai Rd and Banyardala Rd, Ocean Super Center, 1st Floor near elevator, yangon.</span></td>
                </tr>
                <tr>
                    <td><b>Open</b></td>
                    <td> : <span>9am to 8pm (Daily)</span></td>
                </tr>
                <tr>
                    <td><b>Website</b></td>
                    <td> : <a href="index.php" style="color: #dddddd;">www.pizzamarui.com</span></td>
                </tr>
                <tr>
                    <td><b>Phone</b></td>
                    <td> : <span>09-123456789, 09-987654321, 01-654321</span></td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td> : <span>info@pizzamarui.com</span></td>
                </tr>
            </table>
        </div>
    </section>
    <hr>
    <?php include('footer.php'); ?>

    <script>
        window.addEventListener("DOMContentLoaded", function() {

            // Original JavaScript code by Chirp Internet: chirpinternet.eu
            // Please acknowledge use of this code by including this header.

            const stage = document.getElementById("banner_container");
            let fadeComplete = function() {
                stage.appendChild(arr[0]);
            };
            let arr = stage.getElementsByTagName("img");
            for (let i = 0; i < arr.length; i++) {
                arr[i].addEventListener("animationend", fadeComplete);
            }
        });
    </script>
</body>

</html>