

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="includes/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400&display=swap" rel="stylesheet">
    <meta charset="UTF-8">

</head>

<body id="LoginRegister">
    <div class="main-w3layouts wrapper">
        <div id ="logoRegisterLogin">  </div>
        <div class="main-agileinfo">
            <div class="agileits-top">
                <form action="http://se.shenkar.ac.il/students/2020-2021/web1/dev_221/login.php" method="GET">
                <!-- "//localHost/dev_221/login.php" -->
                <h1> SignUp </h1>
                <br>
                    <input class="text" type="text" name="username" placeholder="Username" required="">
                    <input class="text email" type="email" name="usermail" placeholder="Email" required="">
                    <input class="text" type="password" name="userpass" placeholder="Password" required="">
                    <input class="text w3lpass" type="password" name="userpass2" placeholder="Confirm Password" required="">
                    <input class="text" type="text" name="useraddress" placeholder="address" required="">
                    <input class="text email" type="tel" name="userphone" placeholder="phone" required="">
                    <input class="text email" type="text" name="userurl" placeholder="picture" required="">
                    
                    <select class="text email form-select form-select-sm" aria-label=".form-select-sm example" name="usertype">
                    <option value="regular" selected> &nbsp;Regular User &nbsp;&nbsp;</option>
                    <option value="business"> &nbsp;Business User &nbsp;&nbsp;</option>
                    &nbsp;&nbsp;   
                    </select>
                    <br><br>

                 
                    <div class="wthree-text">
                        <label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
                        <div class="clear"> </div>
                    </div>
                    <input type="hidden" name="state" value="register">
                    <input type="submit" value="SIGNUP">
                </form>
                <p>Have an Account? <a href="login.php"> Login Now!</a></p>
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

</body>

</html>
