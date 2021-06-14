<?php
    include 'db.php';
    session_start();
?>

<?php 
    if (!isset($_GET["prodId"])) {
        $state  = "insert";
        $title ='Add offer'; 
        $result = 0;
    }

    else{
        $prodId = $_GET["prodId"];
        
        $query     = "SELECT * FROM offers_221 where offer_id=".$prodId;
        $result = mysqli_query($connection, $query);

        if($result) {
            $row     = mysqli_fetch_assoc($result);
            $state     = "edit";
            $title='Edit offer';
        }
        else die("DB query failed.");
    }
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400&display=swap" rel="stylesheet">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <meta charset="UTF-8">
    <title>Tap & Save</title>
    <link rel="stylesheet" href="includes/css/style.css">
</head>


<body id="form">
    <header>
        <nav>
            <div class="menu-icon">
                <span class="fas fa-bars"></span>
            </div>
            <a href="index.php" id="logo"> </a>
            <ul class="nav-items">
                <li><a href="offersList.php">Offers</a></li>
                <?php 
                
                if($_SESSION["user_type"]=="business") {
                    if($title =='Add offer')
                    echo "<li><a href='formNewOffer.php' id='selected'>Add offer</a></li>";

                    else
                    echo "<li><a href='formNewOffer.php'>Add offer</a></li>";
                }
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

            <a href="profile.php">
                <img id="profile" src=<?php echo "'" . $_SESSION["user_url"] . "'" ?> alt="User Image">
            </a>
        </nav>

    </header>


    <div aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Tap & Save</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>

        </ol>
    </div>


    <h1 id="listItemh1"><?php echo $title ?></h1>

    <div class="container">
        <h2 id='title'>My Offer</h2>
        <form class='survey-form' method="get"
            action="http://se.shenkar.ac.il/students/2020-2021/web1/dev_221/thankyouform.php">
            <!-- action="//localHost/Tap/thankyouform.php -->
            <div class='form-input'>
                <label>Item name</label>
                <input type='text' name="itemname" placeholder='e.g.  cheese cake'
                    value="<?php if ($result) echo $row["offer_name"] ?>" class='form-input-size' required />
            </div>

            <div class='form-input'>
                <label>Price for unit
                </label>
                <input type='number' name="price" placeholder='e.g. 20 '
                    value="<?php if ($result) echo $row["price_per_unit"] ?>" min='0' max='10000'
                    class='form-input-size' required />
            </div>

            <div class='form-input'>
                <label>Quantity
                </label>
                <input type='number' name="Quantity" placeholder='e.g. 10 '
                    value="<?php if ($result) echo $row["offer_quantity"] ?>" min='0' max='10000'
                    class='form-input-size' required />
            </div>

            <div class='form-input'>
                <label>Description</label>
                <textarea name="description" placeholder='e.g.  Cheese cake with choclate and nuts' required>
                    <?php if ($result) echo $row["offer_description"] ?> 
                </textarea>
            </div>

            <div class='form-input collect'>
                <label>Collect time</label>
                <input type="datetime-local" name="time" value="<?php if ($result) echo $row["collect_time"] ?>"
                    class='form-input-size' required>
            </div>

            <div class='form-input'>
                <label>Offer close at</label>
                <input type="date" id="closeoffer" value="<?php if ($result) echo $row["close_time"] ?>"
                    name="datecollect">
            </div>

            <div class='form-input file'>
                <label for="exampleFormControlFile1">Picture</label>
                <input type="text" name="picture" class="form-control-file"
                    value="<?php if ($result) echo $row["offer_url"] ?>" id="exampleFormControlFile1" required>
            </div>

            <div class='form-input' class='form-input-size' id="selectType"
                data-selected="<?php echo $row["type_food"];?>">
                <label>Type-food</label>
                <label class="blackFont"><input type='radio' name="optional" class='check-box'
                        value='Kosher'>Kosher</label>
                <label class="blackFont"><input type='radio' name="optional" class='check-box'
                        value='Vegetarian'>Vegetarian</label>
                <label class="blackFont"><input type='radio' name="optional" class='check-box'
                        value='Vegan'>Vegan</label>
                <label class="blackFont"><input type='radio' name="optional" class='check-box'
                        value='Gluten-Free'>Gluten free</label>
                <label class="blackFont"><input type='radio' name="optional" class='check-box'
                        value='Lactose-Free'>Lactose free</label>
                <label class="blackFont"><input type='radio' name="optional" class='check-box' value='Suger-Free'>Suger
                    free</label>
                <label class="blackFont"><input type='radio' name="optional" class='check-box' value='None'>None</label>
            </div>

            <input type="hidden" name="state" value="<?php echo $state;?>">
            <input type="hidden" name="prodId" value="<?php echo $prodId;?>">

            <div class='form-input'>
                <button type='submit' id='submit'>Submit</button>
            </div>

        </form>
    </div>

    <footer>
        <span>&copy; Copyright Tap&Save</span>

    </footer>
    <script src="includes/js/NavigationBurger.js"></script>
    <script src="includes/js/checkedMaker.js"></script>

</body>

</html>

<?php
    mysqli_close($connection);
?>