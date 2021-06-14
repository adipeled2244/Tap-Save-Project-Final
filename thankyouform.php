<?php
    include 'db.php';
    session_start();
?>

<?php 

    if(isset($_GET['state'])){
    $offerName     = mysqli_real_escape_string($connection, $_GET['itemname']);
    $offerPrice      = mysqli_real_escape_string($connection, $_GET['price']);
    $offerQuantity        = mysqli_real_escape_string($connection, $_GET['Quantity']);
    $offerDescription     = mysqli_real_escape_string($connection, $_GET['description']);
    $collectTime      = mysqli_real_escape_string($connection, $_GET['time']);
    $closeTime        = mysqli_real_escape_string($connection, $_GET['datecollect']);
    $offerUrl      = mysqli_real_escape_string($connection, $_GET['picture']);
    $offerType        = mysqli_real_escape_string($connection, $_GET['optional']);    
    $state        = $_GET['state'];
    $prodId        = $_GET['prodId'];

    //SET: insert/update data in DB
    if ($state == "insert") {
        $query1 = "INSERT INTO offers_221 (
            offer_id,
            offer_name,
            offer_quantity,
            price_per_unit,
            offer_description,
            type_food,
            collect_time,
            close_time,
            offer_url,
            offer_status,
            user_id_creator
            )
            VALUES (
            NULL, '$offerName', '$offerQuantity', '$offerPrice', '$offerDescription', '$offerType', '$collectTime', '$closeTime', '$offerUrl', 'open', ".$_SESSION["user_id"]."
            )";

        $result1 = mysqli_query($connection, $query1);
   
        if(!$result1) {
            die("DB query failed.");
        }

            $query2 = "INSERT INTO studDB21a.offersUsers_221 (
                user_id ,
                offer_id
                )
            VALUES (
                ".$_SESSION["user_id"].", ".mysqli_insert_id($connection)."
                )";
            
        $result2 = mysqli_query($connection, $query2);

        if(!$result2) {
            die("DB query failed.");
        }


    }

    if($state =='edit') {
        $query1 = " UPDATE studDB21a.offers_221 SET 
        offer_name = '$offerName',
        offer_quantity = '$offerQuantity',
        price_per_unit = '$offerPrice',
        offer_description = '$offerDescription',
        type_food = '$offerType',
        collect_time = '$collectTime',
        close_time = '$closeTime',
        offer_url = '$offerUrl',
        offer_status = 'open',
        user_id_creator = '".$_SESSION["user_id"]."' WHERE offers_221.offer_id ='$prodId';";    

    $result1 = mysqli_query($connection, $query1);
   
        if(!$result1) {
            die("DB query failed.");
        }
    }
}

else {

    $buy_quantity = $_GET["quantity"];
    $full_quantity       = $_GET['fullquantity'];
    $how_much_left_quantity= $full_quantity- $buy_quantity;
    $prodid= $_GET["prodid"]; 

    if($how_much_left_quantity==0){

        $query_close_sale = " UPDATE studDB21a.offers_221 SET 
        offer_status = 'close'  
         WHERE offers_221.offer_id ='$prodid';";  

         $close_sale = mysqli_query($connection, $query_close_sale);
        if(!$close_sale) {
             die("DB query failed.");
            }  
        }

        $query_buying = " UPDATE studDB21a.offers_221 SET 
        offer_quantity = '$how_much_left_quantity'  
         WHERE offers_221.offer_id ='$prodid';";    

    $result_buying = mysqli_query($connection, $query_buying);
   
    if(!$result_buying) {
        die("DB query failed.");
    }
    }
?>



<!DOCTYPE html>
<html lang="en">


<head>
    <title>New Offer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Tap & Save</title>
    <link rel="stylesheet" href="includes/css/style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
</head>


<body id="php">
    <header>
        <nav>
            <div class="menu-icon">
                <span class="fas fa-bars"></span></div>
            <a href="index.php" id="logo"> </a>
            <ul class="nav-items">
                <li><a href="offersList.php">Offers</a></li>
                <?php if($_SESSION["user_type"]=="business") 
                echo "<li><a href='formNewOffer.php'>Add offer</a></li>";
                ?>
                <li><a href="#">Top5</a></li>
            </ul>
            <div class="search-icon">
                <span class="fas fa-search"></span></div>
            <div class="cancel-icon">
                <span class="fas fa-times"></span></div>
            <form action="#">
                <input type="search" class="search-data" placeholder="Search" required>
                <button type="submit" class="fas fa-search"></button>
            </form>

            <a href="profile.php" >
                <img id="profile" src=<?php echo "'" . $_SESSION["user_url"] . "'" ?> alt="User Image">
            </a>
        </nav>

    </header>


    <div aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Tap & Save</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thank You</li>

        </ol>
    </div>

<?php


    echo "<h1>Thank You</h1>";
    echo "<section id=phpForm>";
    if(isset($state) && $state == 'insert'){
    echo "<h2>Thank you for making a new offer and  saving our planet</h2>
        <img src=images/earth.svg alt=Earth title=Earth>
            </section>";
    }
    else if(isset($state) && $state == 'edit'){
    
    echo "<h2>Yours offer has been updated.</h2>
        <img src=images/earth.svg alt=Earth title=Earth>
            </section>";
    }

    else {
        echo "<h2>Thank You for buying from Tap&Save</h2>
        <img src=images/earth.svg alt=Earth title=Earth>
            </section>";
    }
?>

    <footer>
        <span>&copy; Copyright Tap&Save</span>

    </footer>
    <script src="includes/js/NavigationBurger.js" type="text/javascript"></script>

   

</body>

</html>

<?php
    mysqli_close($connection);
?>