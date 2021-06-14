<?php
    include 'db.php';
    session_start();
?>
<?php
 $prodId = $_GET["prodId"];
 $query = "SELECT *
 FROM offersUsers_221 ou
 INNER JOIN users_221 u ON u.user_id = ou.user_id
 INNER JOIN offers_221 o ON o.offer_id = ou.offer_id
 WHERE 
    o.offer_id =".$prodId;
 
 $result = mysqli_query($connection, $query);
 if($result) {
 $row = mysqli_fetch_assoc($result); //there is only 1 item with id=X
 }
 else die("DB query failed.");
?>


<?php
 $prodId2 = $_GET["prodId"];

 $queryInterest = "SELECT *
 FROM offersUsers_221 ou
 INNER JOIN users_221 u ON u.user_id = ou.user_id
 INNER JOIN offers_221 o ON o.offer_id = ou.offer_id
 WHERE offer_status='open'";

 $resultInterest = mysqli_query($connection, $queryInterest);
 if(!$resultInterest) {
    die("DB query failed.");
 }
?>


<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <meta charset="UTF-8">
    <title>Tap & Save</title>
    <link rel="stylesheet" href="includes/css/style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
</head>


<body id="object">
    <header>
        <nav>
            <div class="menu-icon">
                <span class="fas fa-bars"></span></div>
            <a href="index.php" id="logo"> </a>
            <ul class="nav-items">
                <li><a href="offersList.php" id="selected">Offers</a></li>
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
            <li class="breadcrumb-item active"> <a href="offersList.php">Offers</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $row["offer_name"]; ?></li>

        </ol>
    </div>


    <h1 id="listItemh1"><?php echo $row["offer_name"]; ?></h1>

    <main>
        <section id="myObject">
            <div class="card">

                <img class="card-img-top" src=<?php echo $row["offer_url"]; ?> alt="food" title="food">
                <div class="cardTop">
                    <img class="card-Resturant-logo" src=<?php echo $row["user_url"]; ?> alt="food" title="food">
                </div>
                <div class="card-body">
                    <section id="flexContainer">
                        <div id="containerItem">
                            <span class="price margin">
                            <span class="dollar"></span> &nbsp;&nbsp; <?php echo $row["price_per_unit"]; ?>
                            </span>

                            <span class="HowMuchleft margin">
                            <span class="iconLefts"></span> &nbsp;&nbsp;<?php echo $row["offer_quantity"]; ?> left
                            </span>

                            <span class="locat margin">
                            <span class="location"></span> &nbsp;&nbsp; <?php echo $row["user_address"]; ?>
                            </span>

                            <span class="TimeOpen margin">
                            <span class="time"></span> &nbsp;&nbsp; <?php $collect = $row["collect_time"]; $collect[10]=' '; echo $collect; ?> &nbsp;
                            </span>

                            <span class="closeTime margin">
                            <span class="sandClock"></span> &nbsp;&nbsp;<?php echo $row["close_time"]; ?>
                            </span>
                        </div>

                        <div id="cardMain">
                            <h5 class="card-title"> <?php echo $row["offer_name"]; ?>&nbsp;&nbsp;<b>
                                <?php echo ($row["type_food"] =='None' ?  " " : $row["type_food"]) ?></b></h5>
                            <p class="card-text"> <?php echo $row["offer_description"]; ?></p>
                        </div>
                    
                    </section>
                    <section id="buy">
                        <form method="GET" action="thankyouform.php" >
                        <div class="input-group">
                            <input type="button" value="-" class="button-minus" data-field="quantity">
                            <input type="number" step="1" max="<?php echo $row["offer_quantity"];?>" value="1" name="quantity" class="quantity-field">
                            <input type="button" value="+" max="3" class="button-plus" data-field="quantity">
                            <input type="hidden" name="fullquantity" value="<?php echo $row["offer_quantity"];?>">
                            <input type="hidden" name="prodid" value="<?php echo  $prodId ;?>">

                            <button  type="submit" class="btn-floating btn-lg btn-default"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                        </form>
                    </section>

                </div>
            </div>

        </section>
        <hr class="hrObject">
        <section id="AllInterst">

            <?php
                $counter = 0;
                while($counter<4 && $rowInterest = mysqli_fetch_assoc($resultInterest)){
                echo '<section class="interstYouPack">';
                echo  '<a href="object.php?prodId='.$rowInterest["offer_id"].'">';
                echo        '<div class="containerInterst">';
                echo            '<img class="biggerPic" src="'.$rowInterest["offer_url"].'" alt="food" title="food">';
                echo        '</div>';
                echo        '<img class="card-img-top" src="'.$rowInterest["user_url"].'" alt="food" title="food">';
                echo    '</a>';
                echo'</section>';
                $counter++; 
                }
            ?>
        </section>
     </main>

    <footer>
        <span>&copy; Copyright Tap&Save</span>
    </footer>

    <script src="includes/js/NavigationBurger.js">
    </script>
    <script src="includes/js/buyAction.js"></script>

    <?php
        mysqli_free_result($resultInterest);
    ?>

    <?php
        mysqli_free_result($result);
    ?>


</body>

</html>

<?php
    mysqli_close($connection);
?>