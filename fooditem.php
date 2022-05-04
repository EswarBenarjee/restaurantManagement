<!DOCTYPE html>

<?php
    include 'conn.php';
    $name = str_replace('-', ' ', $_GET['food']); 
    include 'navbar.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?></title>
    <style>
        body {
            background-color: #F9ED69;
        }
        .food {
            padding: 5vh 5vw;
            margin: 5vh 2vw;
            background-color: white;
            border-radius: 15px;
        }
        .food img {
            height: 80vh;
            width: 112vh;
            border-radius: 25px;
        }
        #name {
            margin-top: 20vh;
        }
        .big {
            font-size: 22px;
        }
        div .submit {
            margin-left: 8vw;
            background: #3498db;
            background-image: -ms-linear-gradient(top, #3498db, #2980b9);
            border-radius: 28px;
            padding: 10px 20px 10px 18px;
            border: none;
            width: 15vw;
            color: white;
        }
        #quantity {
            background: #3498db;
            background-image: -ms-linear-gradient(top, #3498db, #2980b9);
            border-radius: 10px;
            padding: 10px 20px 10px 18px;
            border: none;
            width: 15vw;
            margin-left: 2vw;
        }
        #quantity:hover {
            border: none;
        }
    </style>
</head>
<body>
    <?php
        $food_query = "SELECT * FROM food WHERE name = '".$name."';";
        $food_result = $conn->query($food_query);

        if($food_result->num_rows > 0) {
            while($food_row = $food_result->fetch_assoc()) {

                $max = $food_row['quantity'];
    ?>
    <div class="food row" action="delivery.php">
        <div class="col-md-8">
            <img src="<?php echo $food_row['image']; ?>" alt="">
        </div>
        <div class="col-md-4 big" style="margin-right: 0;">
            <p id="name">Name: <strong> <?php echo $name; ?> </strong> </p> 
            <p>Prize: <strong> Rupees <span id="cost"><?php echo $food_row['cost']; ?></span> per item</strong> </p>
            <p>Quantity <input type="number" id="quantity" onclick="sum()" min="1" max="<?php echo $max; ?>" placeholder="0"></p>
            <p>____________________________________________________</p>
            <p>Total Amount: <strong> Rupees <span id="amount"> 0 </span> </strong> </p>
            
            <br><br>
            <input type="submit" class="submit" value='Pay now'>
        </div>
            </div>
    <?php
            }
        }
        include 'footer.php';
    ?>
</body>

<script type="text/javascript">
    function sum() {
        var cost = parseInt(document.getElementById('cost').innerHTML);
        var quantity = parseInt(document.getElementById('quantity').value);

        var amount = cost * quantity;

        document.getElementById('amount').innerHTML = amount;
    }
</script>

</html>