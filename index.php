<?php
    include 'conn.php';
    include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
</head>
<style>
    body{
        background-color: #F9ED69; 
    }
    .welcome {
        margin: 10vh 2vw;
        text-align: center;
    }
    footer {
        text-align: center;
    }
    .food img {
        position: relative;
        right: 0.2vw;
        height: 200px;
        width: 300px;
        border-radius: 25px;
    }
    @media only screen and (min-width: 950px) {
        .col-md-3 {
            border-radius: 25px;
            background: white;
            margin: 1vh 0.5vw;
            padding: 5vh 5vw;
            width: 32.1%;
        }
    }
    @media only screen and (max-width: 950px) {
        .col-md-3 {
            border-radius: 25px;
            background: white;
            margin: 2vh 2vw;
            padding: 5vh 5vw;
            width: 95%;
        }
    }

    .btn {
        background: #3498db;
        background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
        background-image: -moz-linear-gradient(top, #3498db, #2980b9);
        background-image: -ms-linear-gradient(top, #3498db, #2980b9);
        background-image: -o-linear-gradient(top, #3498db, #2980b9);
        background-image: linear-gradient(to bottom, #3498db, #2980b9);
        -webkit-border-radius: 28;
        -moz-border-radius: 28;
        border-radius: 28px;
        font-family: Arial;
        text-decoration: none;
        position: relative;
        bottom: 0.3vw;
    }

    .btn:hover {
        background: #3cb0fd;
        background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
        background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
        background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
        background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
        background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
        text-decoration: none;
        color: blue;
    }

    .btn1 {
        border-radius: 28px;
        font-family: Arial;
        text-decoration: none;  
    }

    a {
        text-decoration: none;
        color: white;
    }
</style>
<body class="container">
    <?php
        $mail = $_POST['mail'];
        $pwd = $_POST['pwd'];

        $check_query = "SELECT * FROM users WHERE mail='".$mail."' AND password='".$pwd."';";
        $check_result = $conn->query($check_query);
        
        if($check_result->num_rows > 0) {
        ?>

            <div class="welcome">
                <h2 style="color: red;">Welcome to Restaurant!</h2>
                <h3 style="color: blue;">Experience the best taste.</h3>
            </div>

            <?php
                $food_query = "SELECT * FROM food;";
                $food_result = $conn->query($food_query);
            ?>
                <div class="row">
            <?php
                if($food_result->num_rows > 0) {
                    while($food_row = $food_result->fetch_assoc()) {

                        $name  = str_replace(' ', '-', $food_row['name']);
                        $link = "fooditem.php?food=" . $name;
                    ?>    

                        <div class="col-md-3 food">
                            <img src="<?php echo $food_row['image']; ?>" alt="">
                            <p> <strong> <center> <?php echo $food_row['name']; ?> </center> </strong> </p>
                            <div class="row">
                                <div class="col-md-6 btn1"> Cost: Rs. <?php echo $food_row['cost']; ?> </div>
                                <div class="col-md-6 btn"> <a href="<?php echo $link; ?>" style="text-decoration: none;"> Order now </a> </div>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
                </div>
        <?php
        } else {
            echo "Hello Hacker!";
        }
    ?>
</body>
<?php
    include 'footer.php';
?>

</html>