<style>
.forgot {
    font-family: Outfit;
    font-style: normal;
    font-weight: normal;
    font-size: 30px;
    line-height: 30px;
    position: absolute;
    left: 900px;
    bottom: 90px;
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
    left: 893px;
    top: 270px;
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
    <header style="background: #d84d4d;"></header>
    <rect></rect>
    <logo>MUSICO</logo>
    <img src="img2.svg">
    <t1>Forgot?</t1>
    <t2>Note down your password somewhere :(</t2>
    <form name="forgot-from" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <t3>Email</t3>
    <div class="input1">
        <input type="text" name="email" placeholder="Your Email" id="email">
    </div>
    <t4 style="width: auto">New Password</t4>
    <div class="input2">
        <input type="password" name="passw" placeholder="New Password" id="passw">
    </div>
    <a href="login.php">
        <div class="forgot">Login</div></a>
        <div class="error">
        <?php  
if(isset($_POST["submit"])){  
  
if(!empty($_POST['email']) && !empty($_POST['passw'])) {  
    $email=$_POST['email'];  
    $password=$_POST['passw'];  
  
    include("config.php"); 
  
    $query=mysqli_query($conn,"SELECT * FROM signup WHERE email='".$email."'");  
    $numrows=mysqli_num_rows($query);  
    if($numrows!=0)  
    {  
    while($row=mysqli_fetch_assoc($query))  
    {  
    $dbemail=$row['email'];  
    }  
  
    if($email == $dbemail)  
    {
        $qs = "UPDATE signup SET passw='".$password."' WHERE email = '$email'";
        mysqli_query($conn,$qs);
    echo "Password changed Successfully";
    }  
    } else {  
    echo "Invalid email!";  
    }  
  
} else {  
    echo "All fields are required!";  
}  
}  
?>
        </div>
    <input type="submit" name="submit" value="Change" class="button" onclick="ValidateEmail(document.forgot-form.email),ValidatePassw(document.forgot-form.passw)"></input>
</input>
</form>

<script>
function ValidateEmail(inputText)
   {
   var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
   if(inputText.value.match(mailformat))
   {
   document.forgot-form.email.focus();
   return true;
   }
   else
   {
   alert("You have entered an invalid email address!");
   document.forgot-form.email.focus();
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
   document.forgot-form.passw.focus();
   return false;
   }
   }
   
    </script>


    <script>
        document.getElementById('email').value = $email;
        document.getElementById('password').value = $password;
        alert('email')
    </script>

</body>
</html>