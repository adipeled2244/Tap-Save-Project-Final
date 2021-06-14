<?php
    include 'db.php';
    session_start();
?>

<?php

 $query = "SELECT *
 FROM users_221 WHERE users_221.user_id =".$_SESSION['user_id'].";";  

 $result = mysqli_query($connection, $query);
 if(!$result) {
    die("DB query failed.");
 }
 $row = mysqli_fetch_assoc($result); 
 $state = "edit";
?>



<!DOCTYPE html>
<html>


<head>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Tap & Save</title>
    <link rel="stylesheet" href="includes/css/style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
</head>


<body id="edit">
    <header>
        <nav>
            <div class="menu-icon">
                <span class="fas fa-bars"></span>
            </div>
            <a href="index.php" id="logo"> </a>
            <ul class="nav-items">
                <li><a href="offersList.php" >Offers</a></li>
                <?php 
                if($_SESSION["user_type"]=="business") {
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
            <a href="profile.php" >
                <img id="profile" src=<?php echo "'" . $_SESSION["user_url"] . "'" ?> alt="User Image">
            </a>
        </nav>

    </header>

    <div aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Tap & Save</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit profile</li>

        </ol>
    </div>


    <h1 id="listItemh1">Edit Profile</h1>

    <main id="edit">
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card bg-light">
                        <div class="card-body ">
                            <div class="d-flex flex-column align-items-center text-center bg-light">
                            <img src=<?php echo $row["user_url"]; ?> alt="pic" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4><?php echo $row["user_name"]; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3 ">
                <ul class="list-group list-group-flush ">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap bg-light">
                    <h6 class="mb-0">My favorite food:</h6>
                    <span class="text-secondary" id="favorite1" data-id =<?php echo "'" . $_SESSION["user_id"] . "'" ?>></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap bg-light">
                    <h6 class="mb-0">My favorite resturant:</h6>
                    <span class="text-secondary" id="favorite2"></span>
                  </li>
                
                </ul>
              </div>
                </div>

                
                <div class="col-lg-8">
                    <div class="card" >
                        <form action="http://se.shenkar.ac.il/students/2020-2021/web1/dev_221/profile.php" method="GET">
                        <!-- //localHost/dev_221/profile.php  -->
                            <div class="card-body bg-light" >
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">User Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="username" class="form-control" value="<?php echo $row["user_name"] ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="usermail" class="form-control" value="<?php echo $row["user_mail"] ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="userphone" class="form-control" value="<?php echo $row["user_phone"] ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="useraddress" class="form-control" value="<?php echo $row["user_address"] ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Picture</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="userurl" class="form-control" value="<?php echo $row["user_url"] ?>">
                                    </div>
                                </div>

                                
                                <input type="hidden" name="state" value="edit">

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Save Changes">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



     


    <footer>
        <span>&copy; Copyright Tap&Save</span>
    </footer>


    <script src="includes/js/NavigationBurger.js" type="text/javascript"></script>
    <script src="includes/js/getFromJson.js" type="text/javascript"></script>


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