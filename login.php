<?php
    include 'db.php';
    include 'config.php';
    session_start();
?>

<?php
    if(isset($_GET["getout"]))
        session_destroy();
?>

<?php
    if(isset($_GET["deleteaccount"])){
    $query_delete="DELETE FROM users_221 WHERE user_id=" . $_SESSION["user_id"] ;
    $result_delete= mysqli_query($connection, $query_delete);

  if(!$result_delete) {
        die("DB query failed.");
    }
    }
?>

<!-- from registration -->
<?php

    if (isset($_GET["state"])) {
        $state  = "register";
    
        $userName     = mysqli_real_escape_string($connection, $_GET['username']);
        $userMail     = mysqli_real_escape_string($connection, $_GET['usermail']);
        $userAddress    = mysqli_real_escape_string($connection, $_GET['useraddress']);
        $userPhone    = mysqli_real_escape_string($connection, $_GET['userphone']);
        $userUrl    = mysqli_real_escape_string($connection, $_GET['userurl']);
        $userPassword   = mysqli_real_escape_string($connection, $_GET['userpass']);
        $userType  = mysqli_real_escape_string($connection, $_GET['usertype']);

        $query_insert = "INSERT INTO studDB21a.users_221 (
        user_id,
        user_name ,
        user_mail ,
        user_address ,
        user_phone ,
        user_url ,
            user_pass ,
            user_type
            )
            VALUES (
            NULL , '$userName', '$userMail', '$userAddress', '$userPhone', '$userUrl', '$userPassword', '$userType'
            )";

    $result_register= mysqli_query($connection,  $query_insert);

    if(!$result_register) {
        die("DB query failed.");
    }

    }



?>

<!-- login for the second time (not first time) -->
<?php

    if(!empty($_GET["Email"])){
        
        $query_login= "SELECT * FROM users_221 WHERE user_mail= '" . $_GET["Email"] . "' and user_pass= '" .$_GET["Password"] ."'"; 
        $result_login = mysqli_query($connection, $query_login);
        if(!$result_login) 
            die("DB query failed.");
            
        else 
            $row_user_login = mysqli_fetch_array($result_login); //there is only 1 item with id=X
        

        if(!is_array( $row_user_login)){
            // fail
            $message= "Invalid Username or Password";
        }
        else
        {
            //success
            session_start();
           $_SESSION["user_id"]=$row_user_login["user_id"];
           $_SESSION["user_type"]=$row_user_login["user_type"];
           $_SESSION["user_url"]=$row_user_login["user_url"];  
  
           mysqli_free_result($result_login);
           mysqli_close($connection);
           header('Location: ' . URL . 'index.php');     
        }
    
    }
?>



<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="includes/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400&display=swap" rel="stylesheet">
</head>

<body id="LoginRegister">
    <div class="main-w3layouts wrapper">
    <div id ="logoRegisterLogin">  </div>
        <div class="main-agileinfo">
            <div class="agileits-top">
            <h1> Login </h1>
                <form action="#" method="GET">  
                    <input class="text email" type="email" name="Email" placeholder="Email" required="">
                    <input class="text email" type="password" name="Password" placeholder="Password" required="">
                    <div class="wthree-text">
                        <label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
                        <div class="clear"> </div>
                    </div>
                    <input type="submit" value="SIGN IN">
                    <div class="error-message"><?php if(isset($message)) echo "&#10008;  ".$message;?></div><br>
                </form>
                <p>Don't have an Account? <a href="register.html"> Register Now!</a></p>
            </div>
        </div>
        <div class="colorlibcopy-agile">
        </div>

        <ul class="colorlib-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>


    <php?
    mysqli_free_result($result_login);
    mysqli_free_result($result_register);
    ?>
</body>

</html>

<?php
 //close DB connection
 mysqli_close($connection);
?>