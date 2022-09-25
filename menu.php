<?php
require('connection.php');
$pizzaquery = "SELECT * FROM pizza";
$runpizzaquery = mysqli_query($connection, $pizzaquery);
$rowcount = mysqli_num_rows($runpizzaquery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Menu</title>
    <?php include('links.php') ?>
</head>

<body>
    <?php include('navibar.php'); ?>
    <div id="menu">
        <h2>Pizza Menu</h2>
        <section id="items">
            <?php
            for ($i = 0; $i < $rowcount; $i++) {
                $data = mysqli_fetch_array($runpizzaquery);
                echo '<div>';
                echo '<img src="' . $data["PizzaPicture"] . '">';
                echo '<h3>' . $data["PizzaName"] . '</h3>';
                echo '<table>';
                echo '<tr><td>Size</td><td> : Regular Size</td></tr>';
                echo '<tr><td>Price</td><td> : ' . $data['UnitPrice'] . ' MMK</td></tr>';
                echo '</table>';
                echo '<a href="order.php?pid=' . $data['PizzaID'] . '" id="btnmore">More Detail</a>';
                echo '</div>';
            }
            ?>
        </section>
    </div>
    <?php include('footer.php') ?>
</body>

</html>