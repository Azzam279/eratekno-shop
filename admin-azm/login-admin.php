<?php 
include_once("../fungsi/variable.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo $host."/asset/css/bootstrap.min.css";?>">
    <link rel="shortcut icon" href="<?php echo $host."/image/erateknoshop.png"; ?>">
    <script scr="<?php echo $host."/asset/js/respond.js";?>"></script>
    <style>
/*
 * Specific styles of signin component
 */
/*
 * General styles
 */
body, html {
    height: 100%;
    background-repeat: no-repeat;
    background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
}

.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}

/*
 * Card component
 */
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
    /*background-color: #4d90fe; */
    background-color: rgb(104, 145, 162);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}

.forgot-password {
    color: rgb(104, 145, 162);
}

.forgot-password:hover,
.forgot-password:active,
.forgot-password:focus{
    color: rgb(12, 97, 33);
}
    </style>
</head>
<body>
    <!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    <div class="container">
        <div class="card card-container">
        <?php 
        if (isset($_GET['lupa'])=="lupa_password") {
            if (isset($_POST['cek'])) {
                include_once("../koneksi.php");
                $sql_cek    = mysqli_query($conn,"SELECT*FROM admin WHERE username = '".$_POST['cek_id']."' AND hint_answer = '".$_POST['cek_hint']."'");
                $cek        = mysqli_num_rows($sql_cek);

                if ($cek > 0) {
                    $new_pass = 12345;
                    echo "<div class='alert alert-info'> <b>Password Anda:</b> $new_pass<br>Silakan ubah password Anda setelah Login.</div>";
                    $pass = md5("dg43z".md5("af63s".$new_pass."m3ke0")."m9g3d");
                    mysqli_query($conn,"UPDATE admin SET password = '$pass' WHERE username = '".$_POST['cek_id']."'");
                }else{
                    echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Username atau Jawaban Hint Salah!</b></div>";
                }
            }
            
        ?>
            <center><legend><h3>Lupa Password</h3></legend></center>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?lupa=lupa_password");?>" method="post" class="form-signin">
                <input type="text" class="form-control" name="cek_id" placeholder="Username" required autofocus>
                <select class="form-control" required>
                    <option value="Siapa nama ibu Anda?">Siapa nama ibu Anda?</option>
                    <option value="Siapa nama ayah Anda?">Siapa nama ayah Anda?</option>
                    <option value="Apa binatang peliharaan Anda?">Apa binatang peliharaan Anda?</option>
                    <option value="Apa makanan favorit Anda?">Apa makanan favorit Anda?</option>
                    <option value="Dimana kota Anda lahir?">Dimana kota Anda lahir?</option>
                    <option value="Apa hobby Anda?">Apa hobby Anda?</option>
                </select>
                <input type="text" class="form-control" name="cek_hint" placeholder="Jawaban Hint" style="margin-top:10px;margin-bottom:25px;" required>
                <a href="login-admin.php" class="pull-right">Kembali?</a><br><br>
                <button type="submit" name="cek" value="cek" class="btn btn-success"><span class="glyphicon glyphicon-ok-circle"></span> Cek</button>
                <button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
            </form>
        <?php 
        }else{
        ?>
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="<?php echo $host."/image/avatar_2x.png"; ?>" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="post" action="<?php echo $host."/admin-azm/proses-login-admin.php"; ?>">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" class="form-control" name="id" placeholder="Username" required autofocus>
                <input type="password" id="inputPassword" class="form-control" name="pass" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
            <a href="?lupa=lupa_password" class="forgot-password">
                Lupa password?
            </a>
        <?php
        }
        ?>
        </div><!-- /card-container -->
    </div><!-- /container -->

<script src="<?php echo $host."/asset/js/jquery.js";?>"></script>
<script src="<?php echo $host."/asset/js/bootstrap.min.js";?>"></script>
<script>
$( document ).ready(function() {
    // DOM ready

    // Test data
    /*
     * To test the script you should discomment the function
     * testLocalStorageData and refresh the page. The function
     * will load some test data and the loadProfile
     * will do the changes in the UI
     */
    // testLocalStorageData();
    // Load profile if it exits
    loadProfile();
});

/**
 * Function that gets the data of the profile in case
 * thar it has already saved in localstorage. Only the
 * UI will be update in case that all data is available
 *
 * A not existing key in localstorage return null
 *
 */
function getLocalProfile(callback){
    var profileImgSrc      = localStorage.getItem("PROFILE_IMG_SRC");
    var profileName        = localStorage.getItem("PROFILE_NAME");
    var profileReAuthEmail = localStorage.getItem("PROFILE_REAUTH_EMAIL");

    if(profileName !== null
            && profileReAuthEmail !== null
            && profileImgSrc !== null) {
        callback(profileImgSrc, profileName, profileReAuthEmail);
    }
}

/**
 * Main function that load the profile if exists
 * in localstorage
 */
function loadProfile() {
    if(!supportsHTML5Storage()) { return false; }
    // we have to provide to the callback the basic
    // information to set the profile
    getLocalProfile(function(profileImgSrc, profileName, profileReAuthEmail) {
        //changes in the UI
        $("#profile-img").attr("src",profileImgSrc);
        $("#profile-name").html(profileName);
        $("#reauth-email").html(profileReAuthEmail);
        $("#inputEmail").hide();
        $("#remember").hide();
    });
}

/**
 * function that checks if the browser supports HTML5
 * local storage
 *
 * @returns {boolean}
 */
function supportsHTML5Storage() {
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}

/**
 * Test data. This data will be safe by the web app
 * in the first successful login of a auth user.
 * To Test the scripts, delete the localstorage data
 * and comment this call.
 *
 * @returns {boolean}
 */
function testLocalStorageData() {
    if(!supportsHTML5Storage()) { return false; }
    localStorage.setItem("PROFILE_IMG_SRC", "//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" );
    localStorage.setItem("PROFILE_NAME", "César Izquierdo Tello");
    localStorage.setItem("PROFILE_REAUTH_EMAIL", "oneaccount@gmail.com");
}    
</script>
</body>
</html>