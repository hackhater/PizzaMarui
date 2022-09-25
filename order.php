<?php
require('connection.php');

if (isset($_SESSION['cid'])) {
    $cid = $_SESSION['cid'];
    $uinfoquery = "SELECT * FROM customer WHERE CustomerID = '$cid'";
    $runuinfoquery = mysqli_query($connection, $uinfoquery);
    $uinfo = mysqli_fetch_array($runuinfoquery);
} else {
    echo "<script>alert('You need to login first!')</script>";
    echo "<script>location = history.back()</script>";
}

if (!isset($_REQUEST['pid']) && !isset($_POST['btnorder'])) {
    echo "<script>alert('No Pizza Selected! Please try again.')</script>";
    echo "<script>location='PizzaDisplay.php'</script>";
} else {
    $pizzaid = $_REQUEST['pid'];
    $pizzaquery = "SELECT * FROM pizza WHERE PizzaID = '$pizzaid'";
    $runpizzaquery = mysqli_query($connection, $pizzaquery);
    $pizza = mysqli_fetch_array($runpizzaquery);

    if (isset($_POST['btnorder'])) {
        $qty = $_POST['qty'];
        $amt = $_POST['amt'];
        $date = date('Y-m-d');
        $filepath = 'Payment/';
        // $delitype = $_POST['delitype'];
        //     $phone = $_POST['phone'];
        //     $address = $_POST['address'];
        // $paytype = $_POST['paytype'];
        //     $online = $_POST['online'];
        //     $screenshot = $_POST['screenshot'];

        if ($_POST['delitype'] == 'current' && $_POST['paytype'] == 'cod') {
            $delitype = 'current';
            $address = $uinfo['Address'];
            $phone = $uinfo['Phone'];
            $paytype = 'cod';
            $online = 'Cash';
            $screenshot = '';
        } else if ($_POST['delitype'] == 'current' && $_POST['paytype'] == 'online') {
            $delitype = 'current';
            $address = $uinfo['Address'];
            $phone = $uinfo['Phone'];
            $paytype = 'online';
            $online = $_POST['online'];
            $file = $_FILES['screenshot']['name'];
            $screenshot = $filepath . $date . "-" . $file;
            $copy = copy($_FILES['screenshot']['tmp_name'], $screenshot);
            if (!$copy) {
                exit("Problem occur with stroing image! Please try again.");
            }
        } else if ($_POST['delitype'] == 'new' && $_POST['paytype'] == 'cod') {
            $delitype = 'new';
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $paytype = 'cod';
            $online = 'Cash';
            $screenshot = '';
        } else {
            $delitype = 'new';
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $paytype = 'online';
            $online = $_POST['online'];
            $file = $_FILES['screenshot']['name'];
            $screenshot = $filepath . $date . "-" . $file;
            $copy = copy($_FILES['screenshot']['tmp_name'], $screenshot);
            if (!$copy) {
                exit("Problem occur with stroing image! Please try again.");
            }
        }
        $orderquery = "INSERT INTO orders(OrderQty,TotalAmount,OrderDate,PaymentType,Screenshot,DeliveryType,DeliveryAddress,ContactPhone,PizzaID,CustomerID) VALUES('$qty','$amt','$date','$paytype/$online','$screenshot','$delitype','$address','$phone','$pizzaid','$cid')";
        $runorderquery = mysqli_query($connection, $orderquery);
        if ($runorderquery) {
            $totalqty = $pizza['TotalQuantities'] - $qty;
            $pizzaupdate = "UPDATE pizza SET TotalQuantities = '$totalqty' WHERE PizzaID = '$pizzaid'";
            $runpizzaupdate = mysqli_query($connection, $pizzaupdate);
            echo "<script>alert('Order has been made Successfully!')</script>";
            echo "<script>location='menu.php'</script>";
        } else {
            echo "<script>alert('Something went wrong! Please try again.')</script>";
            echo "<script>location='location = history.back()'</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Order</title>
    <?php include('links.php') ?>
</head>

<body>
    <?php include('navibar.php'); ?>
    <section id="pizza-order">
        <h2>Pizza Order</h2>
        <form action="" method="POST" enctype="multipart/form-data" id="order-details">
            <img src="<?php echo $pizza['PizzaPicture'] ?>" alt="">
            <fieldset>
                <legend>Order Details</legend>
                <h3><?php echo $pizza['PizzaName']; ?></h3>
                <table id="pizzainfo">
                    <tr>
                        <td>Size</td>
                        <td class="content">Regular Pizza</td>
                    </tr>
                    <tr>
                        <td>Ingredients</td>
                        <td class="content"><?php echo $pizza['Ingredients']; ?></td>
                    </tr>
                    <tr>
                        <td>Order Qty</td>
                        <td class="content"><select name="qty" id="qty">
                                <?php
                                for ($i = 1; $i <= $pizza['TotalQuantities']; $i++) {
                                    echo '<option value="' . $i . '">' . $i . ' Pizza</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td class="content"><input type="text" id="amt" name="amt" value="#" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly> MMK</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td id="deli-pay">
                            <fieldset id="deli">
                                <legend>Delivery Details</legend>
                                <table>
                                    <tr>
                                        <td>
                                            Delivery Info :
                                            <select name="delitype" id="delitype">
                                                <option value="current">Current info</option>
                                                <option value="new">New info</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="phone_icon"></i><input type="text" id="phone" name="phone" placeholder="09-XXXXXXXXX" maxlength="11" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required></td>
                                    </tr>
                                    <tr>
                                        <td><i class="location_icon"></i><textarea name="address" id="address" placeholder="Street/City" col="20" row="10" required></textarea></td>
                                    </tr>
                                </table>
                            </fieldset>
                            <fieldset id="pay">
                                <legend>Payment Details</legend>
                                <table>
                                    <tr>
                                        <td>
                                            Payment Type :
                                            <select name="paytype" id="paytype">
                                                <option value="cod">Cash on Delivery</option>
                                                <option value="online">Online payment</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="online" id="online">
                                                <option value="Kpay-09123456789">Kpay-09123456789</option>
                                                <option value="AYApay-09123456789">AYApay-09123456789</option>
                                                <option value="CBpay-09123456789">CBpay-09123456789</option>
                                                <option value="Wave-09123456789">Wave-09123456789</option>
                                            </select> :
                                            <input type="file" name="screenshot" id="screenshot">
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="button" value="Back" onclick="location = history.back()"><input type="submit" name="btnorder" value="Order"></td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </section>
    <?php include('footer.php'); ?>

    <script>
        $(document).ready(function() {
            if (<?php echo $pizza['TotalQuantities'] ?> == 0) {
                $('#qty').append('<option value="0">Out of stock</option>')
                $('#qty').val('0')
                $('#qty').attr('disabled', 'true')
                $('#amt').val('0')
                $('#paytype').attr('disabled', 'true')
                $('input[type="submit"]').attr('disabled', 'true');
            } else {
                $('#amt').val('<?php echo $pizza["UnitPrice"] ?>')
            }
            $('#phone').val('<?php echo $uinfo["Phone"] ?>')
            $('#address').val('<?php echo $uinfo["Address"] ?>')
            $('#online').attr('disabled', 'true')
            $('#screenshot').attr('disabled', 'true')
        })

        $('#qty').change(function() {
            let amt = <?php echo $pizza["UnitPrice"] ?> * parseInt(this.value);
            $('#amt').val(`${amt}`)
        })

        $('#delitype').change(function() {
            if (this.value == 'current') {
                $('#phone').val('<?php echo $uinfo["Phone"] ?>')
                $('#address').val('<?php echo $uinfo["Address"] ?>')
            } else {
                // if($('#delitype').val() == 'new') {
                $('#phone').val('');
                $('#address').val('');
            }
        })

        $('#paytype').change(function() {
            if (this.value == "online") {
                $('#online').removeAttr('disabled', 'true')
                $('#screenshot').removeAttr('disabled', 'true')
                $('#screenshot').attr('required', 'true')
            } else {
                // if($('#paytype').val() == "cod") {
                $('#online').attr('disabled', 'true')
                $('#screenshot').attr('disabled', 'true')
                $('#screenshot').removeAttr('required', 'true')
            }
        })
    </script>
</body>

</html>