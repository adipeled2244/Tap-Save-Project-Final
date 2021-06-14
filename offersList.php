<?php
    include 'db.php';
    session_start();
?>
<?php 

if(isset($_GET['deleteItem'])){
    $idItemToDelete = $_GET['deleteItem'];
    $query_delete="DELETE FROM offers_221 WHERE offer_id=" . $idItemToDelete;
    $result_delete= mysqli_query($connection, $query_delete);
    if(!$result_delete) {
        die("DB query failed.");
    }
}

?> 
<?php
 $query = "SELECT *
 FROM offersUsers_221 ou
 INNER JOIN users_221 u ON u.user_id = ou.user_id
 INNER JOIN offers_221 o ON o.offer_id = ou.offer_id
 WHERE offer_status='open'";

 $result = mysqli_query($connection, $query);
 if(!$result) {
    die("DB query failed.");
 }
?>



<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Tap & Save</title>
    <link rel="stylesheet" href="includes/css/style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
</head>


<body id="listpage">
    <header>
        <nav>
            <div class="menu-icon">
                <span class="fas fa-bars"></span>
            </div>
            <a href="index.php" id="logo"> </a>
            <ul class="nav-items">
                <li><a href="offersList.php" id="selected">Offers</a></li>
                <?php if($_SESSION["user_type"]=="business") 
                echo "<li><a href='formNewOffer.php'>Add offer</a></li>";
                ?>
               <li><a href="#">Top5</a></li>

            </ul>
            <div class="search-icon">
                <span class="fas fa-search"></span>
            </div>
            <div class="cancel-icon">
                <span class="fas fa-times"></span>
            </div>
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
            <li class="breadcrumb-item active" aria-current="page">Offers</li>

        </ol>
    </div>


    <h1 id="listItemh1">Offers</h1>
    <main>
        <div id="list1" class="dropdown-check-list" tabindex="100">
            <span class="anchor">Filter list</span>
            <ul id="items" class="items">
                <li><input type="checkbox" id="Kosher" checked /> Kosher </li>
                <li><input type="checkbox" id="Vegetarian" checked> Vegetarian</li>
                <li><input type="checkbox" id="Vegan" checked /> Vegan </li>
                <li><input type="checkbox" id="Gluten-Free" checked /> Gluten free </li>
                <li><input type="checkbox" id="Lactose-Free" checked /> Lactose free </li>
                <li><input type="checkbox" id="Suger-Free" checked /> Suger Free </li>
            </ul>
        </div>
        
        <section class="listOffers">

        <?php
        while($row = mysqli_fetch_assoc($result)) { //results are in associative array. keys are cols names
            $url = $row["offer_url"];
            $name = $row["offer_name"];
            $quantity = $row["offer_quantity"];
            $price = $row["price_per_unit"];
            $description = $row["offer_description"];
            $quantity = $row["offer_quantity"];
            $type = $row["type_food"];
            $status = $row["offer_status"];
            $id = $row["offer_id"];
            $logo = $row["user_url"];
            $creator_id = $row["user_id_creator"];
            
            echo    '<div  class="card '.' '.$type.'">';
            echo        '<a href="object.php?prodId='.$id.'">';
            echo            '<img class="card-img-top" src="'.$url.'" alt="food" title="food">';
            echo        '</a>';
            echo        '<div class="cardTop">';
            echo            '<span class="HowMuchleft">';
            echo                '<span class="iconLefts"></span> &nbsp;&nbsp;'.$quantity.' left';
            echo            '</span>';
            echo            '<img class="card-Resturant-logo" src="'.$logo.'" alt="food" title="food">';
            echo            '<span class="price">';
            echo                '<span class="dollar"></span> &nbsp;&nbsp;'.$price;
            echo            '</span>';
            echo        '</div>';

            echo        '<div class="card-body">';
            echo            '<h5 class="card-title">'.$name.'&nbsp;&nbsp;<b>';
            echo        ($type=='None' ?  " " : $type) .'</b></h5>';

            echo            '<p class="card-text">'.$description.'</p>';
            if($_SESSION["user_id"]==$creator_id)
            {
                echo        '<div class="editDelete">';
                echo            '<a href="formNewOffer.php?prodId='.$id.'" class="edit"></a>';
                echo            "<a href='offersList.php?deleteItem=".$id."' class='delete'></a>";
                echo        '</div>';
            }
           
            echo        '</div>';
            echo    '</div>';
            
        }
        ?>

        </section>

    </main>


    <footer>
        <span>&copy; Copyright Tap&Save</span>
    </footer>


    <script src="includes/js/NavigationBurger.js" type="text/javascript"></script>
    <script src="includes/js/filterFoodByType.js" type="text/javascript"></script>

    <?php
        //release returned data
        mysqli_free_result($result);
    ?>



</body>

</html>

<?php
 //close DB connection
 mysqli_close($connection);
?>
