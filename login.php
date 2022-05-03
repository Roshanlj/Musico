
<style>
    .rem-box {
    position: absolute;
        bottom: -40px;
        left: -4px;
}

.rem {
    font-family: Outfit;
    font-style: normal;
    font-weight: normal;
    font-size: 18px;
    line-height: 30px;
    position: absolute;
    left: 26px;
    bottom: -45px;
}

.forgot {
    font-family: Outfit;
    font-style: normal;
    font-weight: normal;
    font-size: 18px;
    line-height: 30px;
    position: absolute;
    left: -4px;
    bottom: -150px;
    color:  #1FD082;
}

.error {
    font-family: Outfit;
    font-style: normal;
    font-weight: normal;
    font-size: 18px;
    line-height: 30px;
    position: absolute;
    width: 300px;
    left: 0px;
    bottom: 210px;
    color: red;
}
</style>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet">
</head>
<body>
    <header></header>
    <rect></rect>
    <logo>MUSICO</logo>
    <img src="img2.svg">
    <t1>Login</t1>
    <t2>Get started and enjoy</t2>
    <form name="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <t3>Email</t3>
    <div class="input1">
        <input type="text" name="email" placeholder="Your Email" id="email">
    </div>
    <t4>Password</t4>
    <div class="input2">
        <input type="password" name="passw" placeholder="Your Password" id="passw">
        <br><input type="checkbox" name="remember" class="rem-box">
        <div class="rem">Remember Me</div>
        <a href="forgot.php">
        <div class="forgot">Forgot Password?</div></a>





        <div class="error">
        <?php  
if(isset($_POST["submit"])){  
  
if(!empty($_POST['email']) && !empty($_POST['passw'])) {  
    $email=$_POST['email'];  
    $password=$_POST['passw'];  
  
    include("config.php"); 
  
    $query=mysqli_query($conn,"SELECT * FROM signup WHERE email='".$email."' AND passw='".$password."'");  
    $numrows=mysqli_num_rows($query);  
    if($numrows!=0)  
    {  
    while($row=mysqli_fetch_assoc($query))  
    {  
    $dbemail=$row['email'];  
    $dbpassword=$row['passw'];  
    }  
  
    if($email == $dbemail && $password == $dbpassword)  
    {
        if(isset($_POST['remember'])){
            setcookie('email', $email,time()+60*60*7);
            setcookie('password', $password,time()+60*60*7);
        }
    session_start();  
    $_SESSION['email']=$email;  
  
    /* Redirect browser */  
    header("Location: index.php");  
    }  
    } else {  
    echo "Invalid email or password!";  
    }  
  
} else {  
    echo "All fields are required!";  
}  
}  
?>
        </div>







    </div>
    <input type="submit" name="submit" class="button" onclick="ValidateEmail(document.form1.email),ValidatePassw(document.form1.passw)">Submit</input>
</input>
</form>
    
    <script>
function ValidateEmail(inputText)
   {
   var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
   if(inputText.value.match(mailformat))
   {
   document.form1.email.focus();
   return true;
   }
   else
   {
   alert("You have entered an invalid email address!");
   document.form1.email.focus();
   return false;
   }
   }
   
   function ValidatePassw(inputtxt)
   {
       var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;
   if(inputtxt.value.match(passw)) 
   { 
   return true;
   }
   else
   { 
   alert('Please have a password with atleast 8 characters and one uppercase letter and one number')
   document.form1.passw.focus();
   return false;
   }
   }
   
    </script>



    <?php 
    if(isset($_COOKIE['email']) and isset($_COOKIE['password'])){
        $email = $_COOKIE['email'];
        $password = $_COOKIE['password'];
        ?>

    <script>
        document.getElementById('email').value = $email;
        document.getElementById('password').value = $password;
        alert('email')
    </script>

<?php
    }

?>

</body>
</html>


