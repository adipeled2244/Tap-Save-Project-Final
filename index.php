<?php
include 'db.php';
include 'config.php';
?>

 <?php
session_start();
if (!isset($_SESSION["user_id"]))
    header('Location: ' . URL . 'login.php');  
?>



<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <meta charset="UTF-8">
    <title>Tap & Save</title>
    <link rel="stylesheet" href="includes/css/style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" 
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" 
        crossorigin="anonymous">
    </script>
    <script src="includes/jquerynew/dist/jquery-type-char.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400&display=swap" rel="stylesheet">

</head>

<body id="homepage">
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

    <div class="containerTextTitle">        
    </div>
    
    <main>
        <a class="freeFoodImg" href=" # ">Free Food</a>
        <a class="cheapFoodImg" href="offersList.php">Cheap Food</a>
    </main>

    <section id="circles">
        <div class="col">
            <div class="imageBackground  col1"></div><span>10,000 Donations</span>
        </div>

        <div class="col">
            <div class="imageBackground col2"></div><span>20,000 Business help</span>
        </div>

        <div class="col">
            <div class="imageBackground col3"></div><span>20,000 Meals saved</span>
        </div>

        <div class="col">
            <div class="imageBackground col4"></div><span>50,000 Download app</span>
        </div>


    </section>

    <footer>
        <span>&copy; Copyright Tap&Save</span>
    </footer>
    <script src="includes/js/textAnimation.js"></script>
    <script src="includes/js/NavigationBurger.js"></script>
    
</body>

</html>